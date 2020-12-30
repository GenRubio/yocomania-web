
Filters = {};

let createCanvas = function(width, height) {
    let c = document.createElement("canvas");
    c.width = width;
    c.height = height;
    c.style.display = "none";
    //temporary add to document to get this work (getImageData, etc.)
    document.body.appendChild(c);
    document.body.removeChild(c);
    return c;
};

Filters._premultiply = function(data) {
    let len = data.length;
    for (let i = 0; i < len; i += 4) {
        let f = data[i + 3] * 0.003921569;
        data[i] = Math.round(data[i] * f);
        data[i + 1] = Math.round(data[i + 1] * f);
        data[i + 2] = Math.round(data[i + 2] * f);
    }
};

Filters._unpremultiply = function(data) {
    let len = data.length;
    for (let i = 0; i < len; i += 4) {
        let a = data[i + 3];
        if (a == 0 || a == 255) {
            continue;
        }
        let f = 255 / a;
        let r = (data[i] * f);
        let g = (data[i + 1] * f);
        let b = (data[i + 2] * f);
        if (r > 255) {
            r = 255;
        }
        if (g > 255) {
            g = 255;
        }
        if (b > 255) {
            b = 255;
        }

        data[i] = r;
        data[i + 1] = g;
        data[i + 2] = b;
    }
};


Filters._boxBlurHorizontal = function(pixels, mask, w, h, radius, maskType) {
    let index = 0;
    let newColors = [];

    for (let y = 0; y < h; y++) {
        let hits = 0;
        let r = 0;
        let g = 0;
        let b = 0;
        let a = 0;
        for (let x = -radius * 4; x < w * 4; x += 4) {
            let oldPixel = x - radius * 4 - 4;
            if (oldPixel >= 0) {
                if ((maskType == 0) || (maskType == 1 && mask[index + oldPixel + 3] > 0) || (maskType ==
                        2 && mask[index + oldPixel + 3] < 255)) {
                    a -= pixels[index + oldPixel + 3];
                    r -= pixels[index + oldPixel];
                    g -= pixels[index + oldPixel + 1];
                    b -= pixels[index + oldPixel + 2];
                    hits--;
                }
            }

            let newPixel = x + radius * 4;
            if (newPixel < w * 4) {
                if ((maskType == 0) || (maskType == 1 && mask[index + newPixel + 3] > 0) || (maskType ==
                        2 && mask[index + newPixel + 3] < 255)) {
                    a += pixels[index + newPixel + 3];
                    r += pixels[index + newPixel];
                    g += pixels[index + newPixel + 1];
                    b += pixels[index + newPixel + 2];
                    hits++;
                }
            }

            if (x >= 0) {
                if ((maskType == 0) || (maskType == 1 && mask[index + x + 3] > 0) || (maskType == 2 && mask[
                        index + x + 3] < 255)) {
                    if (hits == 0) {
                        newColors[x] = 0;
                        newColors[x + 1] = 0;
                        newColors[x + 2] = 0;
                        newColors[x + 3] = 0;
                    } else {
                        newColors[x] = Math.round(r / hits);
                        newColors[x + 1] = Math.round(g / hits);
                        newColors[x + 2] = Math.round(b / hits);
                        newColors[x + 3] = Math.round(a / hits);

                    }
                } else {
                    newColors[x] = 0;
                    newColors[x + 1] = 0;
                    newColors[x + 2] = 0;
                    newColors[x + 3] = 0;
                }
            }
        }
        for (let p = 0; p < w * 4; p += 4) {
            pixels[index + p] = newColors[p];
            pixels[index + p + 1] = newColors[p + 1];
            pixels[index + p + 2] = newColors[p + 2];
            pixels[index + p + 3] = newColors[p + 3];
        }

        index += w * 4;
    }
};

Filters._boxBlurVertical = function(pixels, mask, w, h, radius, maskType) {
    let newColors = [];
    let oldPixelOffset = -(radius + 1) * w * 4;
    let newPixelOffset = (radius) * w * 4;

    for (let x = 0; x < w * 4; x += 4) {
        let hits = 0;
        let r = 0;
        let g = 0;
        let b = 0;
        let a = 0;
        let index = -radius * w * 4 + x;
        for (let y = -radius; y < h; y++) {
            let oldPixel = y - radius - 1;
            if (oldPixel >= 0) {
                if ((maskType == 0) || (maskType == 1 && mask[index + oldPixelOffset + 3] > 0) || (
                        maskType == 2 && mask[index + oldPixelOffset + 3] < 255)) {
                    a -= pixels[index + oldPixelOffset + 3];
                    r -= pixels[index + oldPixelOffset];
                    g -= pixels[index + oldPixelOffset + 1];
                    b -= pixels[index + oldPixelOffset + 2];
                    hits--;
                }

            }

            let newPixel = y + radius;
            if (newPixel < h) {
                if ((maskType == 0) || (maskType == 1 && mask[index + newPixelOffset + 3] > 0) || (
                        maskType == 2 && mask[index + newPixelOffset + 3] < 255)) {
                    a += pixels[index + newPixelOffset + 3];
                    r += pixels[index + newPixelOffset];
                    g += pixels[index + newPixelOffset + 1];
                    b += pixels[index + newPixelOffset + 2];
                    hits++;
                }
            }

            if (y >= 0) {
                if ((maskType == 0) || (maskType == 1 && mask[y * w * 4 + x + 3] > 0) || (maskType == 2 &&
                        mask[y * w * 4 + x + 3] < 255)) {
                    if (hits == 0) {
                        newColors[4 * y] = 0;
                        newColors[4 * y + 1] = 0;
                        newColors[4 * y + 2] = 0;
                        newColors[4 * y + 3] = 0;
                    } else {
                        newColors[4 * y] = Math.round(r / hits);
                        newColors[4 * y + 1] = Math.round(g / hits);
                        newColors[4 * y + 2] = Math.round(b / hits);
                        newColors[4 * y + 3] = Math.round(a / hits);
                    }
                } else {
                    newColors[4 * y] = 0;
                    newColors[4 * y + 1] = 0;
                    newColors[4 * y + 2] = 0;
                    newColors[4 * y + 3] = 0;
                }
            }

            index += w * 4;
        }

        for (let y = 0; y < h; y++) {
            pixels[y * w * 4 + x] = newColors[4 * y];
            pixels[y * w * 4 + x + 1] = newColors[4 * y + 1];
            pixels[y * w * 4 + x + 2] = newColors[4 * y + 2];
            pixels[y * w * 4 + x + 3] = newColors[4 * y + 3];
        }
    }
};


Filters.blur = function(canvas, ctx, hRadius, vRadius, iterations, mask, maskType) {
    let imgData = ctx.getImageData(0, 0, canvas.width, canvas.height);
    let data = imgData.data;
    Filters._premultiply(data);
    for (let i = 0; i < iterations; i++) {
        Filters._boxBlurHorizontal(data, mask, canvas.width, canvas.height, Math.floor(hRadius / 2),
            maskType);
        Filters._boxBlurVertical(data, mask, canvas.width, canvas.height, Math.floor(vRadius / 2),
            maskType);
    }

    Filters._unpremultiply(data);

    let width = canvas.width;
    let height = canvas.height;
    let retCanvas = createCanvas(width, height);
    let retImg = retCanvas.getContext("2d");
    retImg.putImageData(imgData, 0, 0);
    return retCanvas;
}

Filters._moveRGB = function(width, height, rgb, deltaX, deltaY, fill) {
    let img = createCanvas(width, height);

    let ig = img.getContext("2d");

    Filters._setRGB(ig, 0, 0, width, height, rgb);
    let retImg = createCanvas(width, height);
    retImg.width = width;
    retImg.heigth = height;
    let g = retImg.getContext("2d");
    g.fillStyle = fill;
    g.globalCompositeOperation = "copy";
    g.fillRect(0, 0, width, height);
    g.drawImage(img, deltaX, deltaY);
    return g.getImageData(0, 0, width, height).data;
};


Filters.FULL = 1;
Filters.INNER = 2;
Filters.OUTER = 3;

Filters._setRGB = function(ctx, x, y, width, height, data) {
    let id = ctx.createImageData(width, height);
    for (let i = 0; i < data.length; i++) {
        id.data[i] = data[i];
    }
    ctx.putImageData(id, x, y);
};

Filters.gradientGlow = function(srcCanvas, src, blurX, blurY, angle, distance, colors, ratios, type, iterations,
    strength, knockout) {
    let width = canvas.width;
    let height = canvas.height;
    let retCanvas = createCanvas(width, height);
    let retImg = retCanvas.getContext("2d");

    let gradCanvas = createCanvas(256, 1);

    let gradient = gradCanvas.getContext("2d");
    let grd = ctx.createLinearGradient(0, 0, 255, 0);
    for (let s = 0; s < colors.length; s++) {
        let v = "rgba(" + colors[s][0] + "," + colors[s][1] + "," + colors[s][2] + "," + colors[s][3] + ")";
        grd.addColorStop(ratios[s], v);
    }
    gradient.fillStyle = grd;
    gradient.fillRect(0, 0, 256, 1);
    let gradientPixels = gradient.getImageData(0, 0, gradCanvas.width, gradCanvas.height).data;

    let angleRad = angle / 180 * Math.PI;
    let moveX = (distance * Math.cos(angleRad));
    let moveY = (distance * Math.sin(angleRad));
    let srcPixels = src.getImageData(0, 0, width, height).data;
    let shadow = [];
    for (let i = 0; i < srcPixels.length; i += 4) {
        let alpha = srcPixels[i + 3];
        shadow[i] = 0;
        shadow[i + 1] = 0;
        shadow[i + 2] = 0;
        shadow[i + 3] = Math.round(alpha * strength);
    }
    let colorAlpha = "rgba(0,0,0,0)";
    shadow = Filters._moveRGB(width, height, shadow, moveX, moveY, colorAlpha);

    Filters._setRGB(retImg, 0, 0, width, height, shadow);

    let maskType = 0;
    if (type == Filters.INNER) {
        maskType = 1;
    }
    if (type == Filters.OUTER) {
        maskType = 2;
    }


    retCanvas = Filters.blur(retCanvas, retCanvas.getContext("2d"), blurX, blurY, iterations, srcPixels,
        maskType);
    retImg = retCanvas.getContext("2d");
    shadow = retImg.getImageData(0, 0, width, height).data;

    if (maskType != 0) {
        for (let i = 0; i < srcPixels.length; i += 4) {
            if ((maskType == 1 && srcPixels[i + 3] == 0) || (maskType == 2 && srcPixels[i + 3] == 255)) {
                shadow[i] = 0;
                shadow[i + 1] = 0;
                shadow[i + 2] = 0;
                shadow[i + 3] = 0;
            }
        }
    }





    for (let i = 0; i < shadow.length; i += 4) {
        let a = shadow[i + 3];
        shadow[i] = gradientPixels[a * 4];
        shadow[i + 1] = gradientPixels[a * 4 + 1];
        shadow[i + 2] = gradientPixels[a * 4 + 2];
        shadow[i + 3] = gradientPixels[a * 4 + 3];
    }

    Filters._setRGB(retImg, 0, 0, width, height, shadow);

    if (!knockout) {
        retImg.globalCompositeOperation = "destination-over";
        retImg.drawImage(srcCanvas, 0, 0);
    }

    return retCanvas;
};




Filters.dropShadow = function(canvas, src, blurX, blurY, angle, distance, color, inner, iterations, strength,
    knockout) {
    var width = canvas.width;
    var height = canvas.height;
    var srcPixels = src.getImageData(0, 0, width, height).data;
    var shadow = [];
    for (var i = 0; i < srcPixels.length; i += 4) {
        var alpha = srcPixels[i + 3];
        if (inner) {
            alpha = 255 - alpha;
        }
        shadow[i] = color[0];
        shadow[i + 1] = color[1];
        shadow[i + 2] = color[2];
        var sa = color[3] * alpha * strength;
        if (sa > 255)
            sa = 255;
        shadow[i + 3] = Math.round(sa);
    }
    var colorFirst = "#000000";
    var colorAlpha = "rgba(0,0,0,0)";
    var angleRad = angle / 180 * Math.PI;
    var moveX = (distance * Math.cos(angleRad));
    var moveY = (distance * Math.sin(angleRad));
    shadow = Filters._moveRGB(width, height, shadow, moveX, moveY, inner ? colorFirst : colorAlpha);


    var retCanvas = createCanvas(canvas.width, canvas.height);
    Filters._setRGB(retCanvas.getContext("2d"), 0, 0, width, height, shadow);
    if (blurX > 0 || blurY > 0) {
        retCanvas = Filters.blur(retCanvas, retCanvas.getContext("2d"), blurX, blurY, iterations, null, 0);
    }
    shadow = retCanvas.getContext("2d").getImageData(0, 0, width, height).data;

    var srcPixels = src.getImageData(0, 0, width, height).data;
    for (var i = 0; i < shadow.length; i += 4) {
        var mask = srcPixels[i + 3];
        if (!inner) {
            mask = 255 - mask;
        }
        shadow[i + 3] = mask * shadow[i + 3] / 255;
    }
    Filters._setRGB(retCanvas.getContext("2d"), 0, 0, width, height, shadow);

    if (!knockout) {
        var g = retCanvas.getContext("2d");
        g.globalCompositeOperation = "destination-over";
        g.drawImage(canvas, 0, 0);
    }

    return retCanvas;
};

Filters._cut = function(a, min, max) {
    if (a > max)
        a = max;
    if (a < min)
        a = min;
    return a;
}

Filters.gradientBevel = function(canvas, src, colors, ratios, blurX, blurY, strength, type, angle, distance,
    knockout, iterations) {
    var width = canvas.width;
    var height = canvas.height;
    var retImg = createCanvas(width, height);
    var srcPixels = src.getImageData(0, 0, width, height).data;

    var gradient = createCanvas(512, 1);
    var gg = gradient.getContext("2d");

    var grd = ctx.createLinearGradient(0, 0, 511, 0);
    for (var s = 0; s < colors.length; s++) {
        var v = "rgba(" + colors[s][0] + "," + colors[s][1] + "," + colors[s][2] + "," + colors[s][3] + ")";
        grd.addColorStop(ratios[s], v);
    }
    gg.fillStyle = grd;
    gg.globalCompositeOperation = "copy";
    gg.fillRect(0, 0, gradient.width, gradient.height);
    var gradientPixels = gg.getImageData(0, 0, gradient.width, gradient.height).data;


    if (type != Filters.OUTER) {
        var hilightIm = Filters.dropShadow(canvas, src, 0, 0, angle, distance, [255, 0, 0, 1], true,
            iterations, strength, true);
        var shadowIm = Filters.dropShadow(canvas, src, 0, 0, angle + 180, distance, [0, 0, 255, 1], true,
            iterations, strength, true);
        var h2 = createCanvas(width, height);
        var s2 = createCanvas(width, height);
        var hc = h2.getContext("2d");
        var sc = s2.getContext("2d");
        hc.drawImage(hilightIm, 0, 0);
        hc.globalCompositeOperation = "destination-out";
        hc.drawImage(shadowIm, 0, 0);

        sc.drawImage(shadowIm, 0, 0);
        sc.globalCompositeOperation = "destination-out";
        sc.drawImage(hilightIm, 0, 0);
        var shadowInner = s2;
        var hilightInner = h2;
    }
    if (type != Filters.INNER) {
        var hilightIm = Filters.dropShadow(canvas, src, 0, 0, angle + 180, distance, [255, 0, 0, 1], false,
            iterations, strength, true);
        var shadowIm = Filters.dropShadow(canvas, src, 0, 0, angle, distance, [0, 0, 255, 1], false,
            iterations, strength, true);
        var h2 = createCanvas(width, height);
        var s2 = createCanvas(width, height);
        var hc = h2.getContext("2d");
        var sc = s2.getContext("2d");
        hc.drawImage(hilightIm, 0, 0);
        hc.globalCompositeOperation = "destination-out";
        hc.drawImage(shadowIm, 0, 0);

        sc.drawImage(shadowIm, 0, 0);
        sc.globalCompositeOperation = "destination-out";
        sc.drawImage(hilightIm, 0, 0);
        var shadowOuter = s2;
        var hilightOuter = h2;
    }

    var hilightIm;
    var shadowIm;
    switch (type) {
        case Filters.OUTER:
            hilightIm = hilightOuter;
            shadowIm = shadowOuter;
            break;
        case Filters.INNER:
            hilightIm = hilightInner;
            shadowIm = shadowInner;
            break;
        case Filters.FULL:
            hilightIm = hilightInner;
            shadowIm = shadowInner;
            var hc = hilightIm.getContext("2d");
            hc.globalCompositeOperation = "source-over";
            hc.drawImage(hilightOuter, 0, 0);
            var sc = shadowIm.getContext("2d");
            sc.globalCompositeOperation = "source-over";
            sc.drawImage(shadowOuter, 0, 0);
            break;
    }

    var maskType = 0;
    if (type == Filters.INNER) {
        maskType = 1;
    }
    if (type == Filters.OUTER) {
        maskType = 2;
    }

    var retc = retImg.getContext("2d");
    retc.fillStyle = "#000000";
    retc.fillRect(0, 0, width, height);
    retc.drawImage(shadowIm, 0, 0);
    retc.drawImage(hilightIm, 0, 0);

    retImg = Filters.blur(retImg, retImg.getContext("2d"), blurX, blurY, iterations, srcPixels, maskType);
    var ret = retImg.getContext("2d").getImageData(0, 0, width, height).data;

    for (var i = 0; i < srcPixels.length; i += 4) {
        var ah = ret[i] * strength;
        var as = ret[i + 2] * strength;
        var ra = Filters._cut(ah - as, -255, 255);
        ret[i] = gradientPixels[4 * (255 + ra)];
        ret[i + 1] = gradientPixels[4 * (255 + ra) + 1];
        ret[i + 2] = gradientPixels[4 * (255 + ra) + 2];
        ret[i + 3] = gradientPixels[4 * (255 + ra) + 3];
    }
    Filters._setRGB(retImg.getContext("2d"), 0, 0, width, height, ret);


    if (!knockout) {
        var g = retImg.getContext("2d");
        g.globalCompositeOperation = "destination-over";
        g.drawImage(canvas, 0, 0);
    }
    return retImg;
}
Filters.bevel = function(canvas, src, blurX, blurY, strength, type, highlightColor, shadowColor, angle,
    distance, knockout, iterations) {
    return Filters.gradientBevel(canvas, src, [
            shadowColor,
            [shadowColor[0], shadowColor[1], shadowColor[2], 0],
            [highlightColor[0], highlightColor[1], highlightColor[2], 0],
            highlightColor
        ], [0, 127 / 255, 128 / 255, 1], blurX, blurY, strength, type, angle, distance, knockout,
        iterations);
}




//http://www.html5rocks.com/en/tutorials/canvas/imagefilters/
Filters.convolution = function(canvas, ctx, weights, opaque) {
    var pixels = ctx.getImageData(0, 0, canvas.width, canvas.height);
    var side = Math.round(Math.sqrt(weights.length));
    var halfSide = Math.floor(side / 2);
    var src = pixels.data;
    var sw = pixels.width;
    var sh = pixels.height;
    // pad output by the convolution matrix
    var w = sw;
    var h = sh;
    var outCanvas = createCanvas(w, h);
    var outCtx = outCanvas.getContext("2d");
    var output = outCtx.getImageData(0, 0, w, h);
    var dst = output.data;
    // go through the destination image pixels
    var alphaFac = opaque ? 1 : 0;
    for (var y = 0; y < h; y++) {
        for (var x = 0; x < w; x++) {
            var sy = y;
            var sx = x;
            var dstOff = (y * w + x) * 4;
            // calculate the weighed sum of the source image pixels that
            // fall under the convolution matrix
            var r = 0,
                g = 0,
                b = 0,
                a = 0;
            for (var cy = 0; cy < side; cy++) {
                for (var cx = 0; cx < side; cx++) {
                    var scy = sy + cy - halfSide;
                    var scx = sx + cx - halfSide;
                    if (scy >= 0 && scy < sh && scx >= 0 && scx < sw) {
                        var srcOff = (scy * sw + scx) * 4;
                        var wt = weights[cy * side + cx];
                        r += src[srcOff] * wt;
                        g += src[srcOff + 1] * wt;
                        b += src[srcOff + 2] * wt;
                        a += src[srcOff + 3] * wt;
                    }
                }
            }
            dst[dstOff] = r;
            dst[dstOff + 1] = g;
            dst[dstOff + 2] = b;
            dst[dstOff + 3] = a + alphaFac * (255 - a);
        }
    }
    outCtx.putImageData(output, 0, 0);
    return outCanvas;
};

Filters.colorMatrix = function(canvas, ctx, m) {
    var pixels = ctx.getImageData(0, 0, canvas.width, canvas.height);

    var data = pixels.data;
    for (var i = 0; i < data.length; i += 4) {
        var r = i;
        var g = i + 1;
        var b = i + 2;
        var a = i + 3;

        var oR = data[r];
        var oG = data[g];
        var oB = data[b];
        var oA = data[a];

        data[r] = (m[0] * oR) + (m[1] * oG) + (m[2] * oB) + (m[3] * oA) + m[4];
        data[g] = (m[5] * oR) + (m[6] * oG) + (m[7] * oB) + (m[8] * oA) + m[9];
        data[b] = (m[10] * oR) + (m[11] * oG) + (m[12] * oB) + (m[13] * oA) + m[14];
        data[a] = (m[15] * oR) + (m[16] * oG) + (m[17] * oB) + (m[18] * oA) + m[19];
    }
    var outCanvas = createCanvas(canvas.width, canvas.height);
    var outCtx = outCanvas.getContext("2d");
    outCtx.putImageData(pixels, 0, 0);
    return outCanvas;
};


Filters.glow = function(canvas, src, blurX, blurY, strength, color, inner, knockout, iterations) {
    return Filters.dropShadow(canvas, src, blurX, blurY, 45, 0, color, inner, iterations, strength,
        knockout);
};


var BlendModes = {};

BlendModes._cut = function(v) {
    if (v < 0)
        v = 0;
    if (v > 255)
        v = 255;
    return v;
};

BlendModes.normal = function(src, dst, result, pos) {
    var am = (255 - src[pos + 3]) / 255;
    result[pos] = this._cut(src[pos] * src[pos + 3] / 255 + dst[pos] * dst[pos + 3] / 255 * am);
    result[pos + 1] = this._cut(src[pos + 1] * src[pos + 3] / 255 + dst[pos + 1] * dst[pos + 3] / 255 * am);
    result[pos + 2] = this._cut(src[pos + 2] * src[pos + 3] / 255 + dst[pos + 2] * dst[pos + 3] / 255 * am);
    result[pos + 3] = this._cut(src[pos + 3] + dst[pos + 3] * am);
};

BlendModes.layer = function(src, dst, result, pos) {
    BlendModes.normal(src, dst, result, pos);
};

BlendModes.multiply = function(src, dst, result, pos) {
    result[pos + 0] = (src[pos + 0] * dst[pos + 0]) >> 8;
    result[pos + 1] = (src[pos + 1] * dst[pos + 1]) >> 8;
    result[pos + 2] = (src[pos + 2] * dst[pos + 2]) >> 8;
    result[pos + 3] = Math.min(255, src[pos + 3] + dst[pos + 3] - (src[pos + 3] * dst[pos + 3]) / 255);
};

BlendModes.screen = function(src, dst, result, pos) {
    result[pos + 0] = 255 - ((255 - src[pos + 0]) * (255 - dst[pos + 0]) >> 8);
    result[pos + 1] = 255 - ((255 - src[pos + 1]) * (255 - dst[pos + 1]) >> 8);
    result[pos + 2] = 255 - ((255 - src[pos + 2]) * (255 - dst[pos + 2]) >> 8);
    result[pos + 3] = Math.min(255, src[pos + 3] + dst[pos + 3] - (src[pos + 3] * dst[pos + 3]) / 255);
};

BlendModes.lighten = function(src, dst, result, pos) {
    result[pos + 0] = Math.max(src[pos + 0], dst[pos + 0]);
    result[pos + 1] = Math.max(src[pos + 1], dst[pos + 1]);
    result[pos + 2] = Math.max(src[pos + 2], dst[pos + 2]);
    result[pos + 3] = Math.min(255, src[pos + 3] + dst[pos + 3] - (src[pos + 3] * dst[pos + 3]) / 255);
};

BlendModes.darken = function(src, dst, result, pos) {
    result[pos + 0] = Math.min(src[pos + 0], dst[pos + 0]);
    result[pos + 1] = Math.min(src[pos + 1], dst[pos + 1]);
    result[pos + 2] = Math.min(src[pos + 2], dst[pos + 2]);
    result[pos + 3] = Math.min(255, src[pos + 3] + dst[pos + 3] - (src[pos + 3] * dst[pos + 3]) / 255);
};

BlendModes.difference = function(src, dst, result, pos) {
    result[pos + 0] = Math.abs(dst[pos + 0] - src[pos + 0]);
    result[pos + 1] = Math.abs(dst[pos + 1] - src[pos + 1]);
    result[pos + 2] = Math.abs(dst[pos + 2] - src[pos + 2]);
    result[pos + 3] = Math.min(255, src[pos + 3] + dst[pos + 3] - (src[pos + 3] * dst[pos + 3]) / 255);
};

BlendModes.add = function(src, dst, result, pos) {
    result[pos + 0] = Math.min(255, src[pos + 0] + dst[pos + 0]);
    result[pos + 1] = Math.min(255, src[pos + 1] + dst[pos + 1]);
    result[pos + 2] = Math.min(255, src[pos + 2] + dst[pos + 2]);
    result[pos + 3] = Math.min(255, src[pos + 3] + dst[pos + 3]);
};

BlendModes.subtract = function(src, dst, result, pos) {
    result[pos + 0] = Math.max(0, src[pos + 0] + dst[pos + 0] - 256);
    result[pos + 1] = Math.max(0, src[pos + 1] + dst[pos + 1] - 256);
    result[pos + 2] = Math.max(0, src[pos + 2] + dst[pos + 2] - 256);
    result[pos + 3] = Math.min(255, src[pos + 3] + dst[pos + 3] - (src[pos + 3] * dst[pos + 3]) / 255);
};

BlendModes.invert = function(src, dst, result, pos) {
    result[pos + 0] = 255 - dst[pos + 0];
    result[pos + 1] = 255 - dst[pos + 1];
    result[pos + 2] = 255 - dst[pos + 2];
    result[pos + 3] = src[pos + 3];
};

BlendModes.alpha = function(src, dst, result, pos) {
    result[pos + 0] = src[pos + 0];
    result[pos + 1] = src[pos + 1];
    result[pos + 2] = src[pos + 2];
    result[pos + 3] = dst[pos + 3]; //?
};

BlendModes.erase = function(src, dst, result, pos) {
    result[pos + 0] = src[pos + 0];
    result[pos + 1] = src[pos + 1];
    result[pos + 2] = src[pos + 2];
    result[pos + 3] = 255 - dst[pos + 3]; //?
};

BlendModes.overlay = function(src, dst, result, pos) {
    result[pos + 0] = dst[pos + 0] < 128 ? dst[pos + 0] * src[pos + 0] >> 7 :
        255 - ((255 - dst[pos + 0]) * (255 - src[pos + 0]) >> 7);
    result[pos + 1] = dst[pos + 1] < 128 ? dst[pos + 1] * src[pos + 1] >> 7 :
        255 - ((255 - dst[pos + 1]) * (255 - src[pos + 1]) >> 7);
    result[pos + 2] = dst[pos + 2] < 128 ? dst[pos + 2] * src[pos + 2] >> 7 :
        255 - ((255 - dst[pos + 2]) * (255 - src[pos + 2]) >> 7);
    result[pos + 3] = Math.min(255, src[pos + 3] + dst[pos + 3] - (src[pos + 3] * dst[pos + 3]) / 255);
};

BlendModes.hardlight = function(src, dst, result, pos) {
    result[pos + 0] = src[pos + 0] < 128 ? dst[pos + 0] * src[pos + 0] >> 7 :
        255 - ((255 - src[pos + 0]) * (255 - dst[pos + 0]) >> 7);
    result[pos + 1] = src[pos + 1] < 128 ? dst[pos + 1] * src[pos + 1] >> 7 :
        255 - ((255 - src[pos + 1]) * (255 - dst[pos + 1]) >> 7);
    result[pos + 2] = src[pos + 2] < 128 ? dst[pos + 2] * src[pos + 2] >> 7 :
        255 - ((255 - src[pos + 2]) * (255 - dst[pos + 2]) >> 7);
    result[pos + 3] = Math.min(255, src[pos + 3] + dst[pos + 3] - (src[pos + 3] * dst[pos + 3]) / 255);
};

BlendModes._list = [
    BlendModes.normal,
    BlendModes.normal,
    BlendModes.layer,
    BlendModes.multiply,
    BlendModes.screen,
    BlendModes.lighten,
    BlendModes.darken,
    BlendModes.difference,
    BlendModes.add,
    BlendModes.subtract,
    BlendModes.invert,
    BlendModes.alpha,
    BlendModes.erase,
    BlendModes.overlay,
    BlendModes.hardlight
];

BlendModes.blendData = function(srcPixel, dstPixel, retData, modeIndex) {
    var result = [];
    var retPixel = [];
    var alpha = 1.0;
    for (var i = 0; i < retData.length; i += 4) {
        this._list[modeIndex](srcPixel, dstPixel, result, i);

        retPixel[i + 0] = this._cut(dstPixel[i + 0] + (result[i + 0] - dstPixel[i + 0]) * alpha);
        retPixel[i + 1] = this._cut(dstPixel[i + 1] + (result[i + 1] - dstPixel[i + 1]) * alpha);
        retPixel[i + 2] = this._cut(dstPixel[i + 2] + (result[i + 2] - dstPixel[i + 2]) * alpha);
        retPixel[i + 3] = this._cut(dstPixel[i + 3] + (result[i + 3] - dstPixel[i + 3]) * alpha);

        var af = srcPixel[i + 3] / 255;
        retData[i + 0] = this._cut((1 - af) * dstPixel[i + 0] + af * retPixel[i + 0]);
        retData[i + 1] = this._cut((1 - af) * dstPixel[i + 1] + af * retPixel[i + 1]);
        retData[i + 2] = this._cut((1 - af) * dstPixel[i + 2] + af * retPixel[i + 2]);
        retData[i + 3] = this._cut((1 - af) * dstPixel[i + 3] + af * retPixel[i + 3]);
    }
};

BlendModes.blendCanvas = function(src, dst, result, modeIndex) {
    var width = src.width;
    var height = src.height;
    var rctx = result.getContext("2d");
    var sctx = src.getContext("2d");
    var dctx = dst.getContext("2d");
    var ridata = rctx.getImageData(0, 0, width, height);
    var sidata = sctx.getImageData(0, 0, width, height);
    var didata = dctx.getImageData(0, 0, width, height);

    this.blendData(sidata.data, didata.data, ridata.data, modeIndex);
    rctx.putImageData(ridata, 0, 0);
};


function concatMatrix(m1, m2) {
    var result = [1, 0, 0, 1, 0, 0];
    var scaleX = 0;
    var rotateSkew0 = 1;
    var rotateSkew1 = 2;
    var scaleY = 3;
    var translateX = 4;
    var translateY = 5;

    result[scaleX] = m2[scaleX] * m1[scaleX] + m2[rotateSkew1] * m1[rotateSkew0];
    result[rotateSkew0] = m2[rotateSkew0] * m1[scaleX] + m2[scaleY] * m1[rotateSkew0];
    result[rotateSkew1] = m2[scaleX] * m1[rotateSkew1] + m2[rotateSkew1] * m1[scaleY];
    result[scaleY] = m2[rotateSkew0] * m1[rotateSkew1] + m2[scaleY] * m1[scaleY];
    result[translateX] = m2[scaleX] * m1[translateX] + m2[rotateSkew1] * m1[translateY] + m2[translateX];
    result[translateY] = m2[rotateSkew0] * m1[translateX] + m2[scaleY] * m1[translateY] + m2[translateY];

    return result;
}


var enhanceContext = function(context) {
    var m = [1, 0, 0, 1, 0, 0];
    context._matrix = m;

    //the stack of saved matrices
    context._savedMatrices = [m]; //[[m]];

    var super_ = context.__proto__;
    context.__proto__ = ({
        save: function() {
            this._savedMatrices.push(this._matrix); //.slice()
            super_.save.call(this);
        },
        //if the stack of matrices we're managing doesn't have a saved matrix,
        //we won't even call the context's original `restore` method.
        restore: function() {
            if (this._savedMatrices.length == 0)
                return;
            super_.restore.call(this);
            this._matrix = this._savedMatrices.pop();
        },
        scale: function(x, y) {
            super_.scale.call(this, x, y);
        },
        rotate: function(theta) {
            super_.rotate.call(this, theta);
        },
        translate: function(x, y) {
            super_.translate.call(this, x, y);
        },
        transform: function(a, b, c, d, e, f) {
            this._matrix = concatMatrix([a, b, c, d, e, f], this._matrix);
            super_.transform.call(this, a, b, c, d, e, f);
        },
        setTransform: function(a, b, c, d, e, f) {
            this._matrix = [a, b, c, d, e, f];
            super_.setTransform.call(this, a, b, c, d, e, f);
        },
        resetTransform: function() {
            super_.resetTransform.call(this);
        },
        applyTransforms: function(m) {
            this.setTransform(m[0], m[1], m[2], m[3], m[4], m[5])
        },
        applyTransformToPoint: function(p) {
            var ret = {};
            ret.x = this._matrix[0] * p.x + this._matrix[2] * p.y + this._matrix[4];
            ret.y = this._matrix[1] * p.x + this._matrix[3] * p.y + this._matrix[5];
            return ret;
        },
        __proto__: super_
    });

    return context;
};
var cxform = function(r_add, g_add, b_add, a_add, r_mult, g_mult, b_mult, a_mult) {
    this.r_add = r_add;
    this.g_add = g_add;
    this.b_add = b_add;
    this.a_add = a_add;
    this.r_mult = r_mult;
    this.g_mult = g_mult;
    this.b_mult = b_mult;
    this.a_mult = a_mult;
    this._cut = function(v, min, max) {
        if (v < min)
            v = min;
        if (v > max)
            v = max;
        return v;
    };
    this.apply = function(c) {
        var d = c;
        d[0] = this._cut(Math.round(d[0] * this.r_mult / 255 + this.r_add), 0, 255);
        d[1] = this._cut(Math.round(d[1] * this.g_mult / 255 + this.g_add), 0, 255);
        d[2] = this._cut(Math.round(d[2] * this.b_mult / 255 + this.b_add), 0, 255);
        d[3] = this._cut(d[3] * this.a_mult / 255 + this.a_add / 255, 0, 1);
        return d;
    };
    this.applyToImage = function(fimg) {
        if (this.isEmpty()) {
            return fimg
        };
        var icanvas = createCanvas(fimg.width, fimg.height);
        var ictx = icanvas.getContext("2d");
        ictx.drawImage(fimg, 0, 0);
        var imdata = ictx.getImageData(0, 0, icanvas.width, icanvas.height);
        var idata = imdata.data;
        for (var i = 0; i < idata.length; i += 4) {
            var c = this.apply([idata[i], idata[i + 1], idata[i + 2], idata[i + 3] / 255]);
            idata[i] = c[0];
            idata[i + 1] = c[1];
            idata[i + 2] = c[2];
            idata[i + 3] = Math.round(c[3] * 255);
        }
        ictx.putImageData(imdata, 0, 0);
        return icanvas;
    };
    this.merge = function(cx) {
        return new cxform(this.r_add + cx.r_add, this.g_add + cx.g_add, this.b_add + cx.b_add, this
            .a_add + cx.a_add, this.r_mult * cx.r_mult / 255, this.g_mult * cx.g_mult / 255, this
            .b_mult * cx.b_mult / 255, this.a_mult * cx.a_mult / 255);
    };
    this.isEmpty = function() {
        return this.r_add == 0 && this.g_add == 0 && this.b_add == 0 && this.a_add == 0 && this
            .r_mult == 255 && this.g_mult == 255 && this.b_mult == 255 && this.a_mult == 255;
    };
};

var place = function(obj, canvas, ctx, matrix, ctrans, blendMode, frame, ratio, time) {
    ctx.save();
    ctx.transform(matrix[0], matrix[1], matrix[2], matrix[3], matrix[4], matrix[5]);
    if (blendMode > 1) {
        var oldctx = ctx;
        var ncanvas = createCanvas(canvas.width, canvas.height);
        ctx = ncanvas.getContext("2d");
        enhanceContext(ctx);
        ctx.applyTransforms(oldctx._matrix);
    }
    if (blendMode > 1) {
        eval(obj + "(ctx,new cxform(0,0,0,0,255,255,255,255),frame,ratio,time);");
    } else {
        eval(obj + "(ctx,ctrans,frame,ratio,time);");
    }
    if (blendMode > 1) {
        BlendModes.blendCanvas(ctrans.applyToImage(ncanvas), canvas, canvas, blendMode);
        ctx = oldctx;
    }
    ctx.restore();
}
var tocolor = function(c) {
    var r = "rgba(" + c[0] + "," + c[1] + "," + c[2] + "," + c[3] + ")";
    return r;
};


var startWidth = 0;
var startHeight = 0;
var dragWidth = false;
var dragHeight = false;

function initDragWidth(e) {
    dragWidth = true;
    dragHeight = false;
    initDrag(e);
}

function initDragHeight(e) {
    dragWidth = false;
    dragHeight = true;
    initDrag(e);
}

function initDragBoth(e) {
    dragWidth = true;
    dragHeight = true;
    initDrag(e);
}

function initDrag(e) {
    startX = e.clientX;
    startY = e.clientY;
    startWidth = canvas.width;
    startHeight = canvas.height;
    document.documentElement.addEventListener('mousemove', doDrag, false);
    document.documentElement.addEventListener('mouseup', stopDrag, false);
}

function doDrag(e) {
    if (dragWidth) {
        canvas.width = (startWidth + e.clientX - startX);
        canvas.height = canvas.width * originalHeight / originalWidth;
    } else if (dragHeight) {
        canvas.height = (startHeight + e.clientY - startY);
        canvas.width = canvas.height * originalWidth / originalHeight;
    }
    drawFrame();
}

function stopDrag(e) {
    document.documentElement.removeEventListener('mousemove', doDrag, false);
    document.documentElement.removeEventListener('mouseup', stopDrag, false);
}


function drawMorphPath(ctx, p, ratio, doStroke, scaleMode) {
    var parts = p.split(" ");
    var len = parts.length;
    if (doStroke) {
        for (var i = 0; i < len; i++) {
            switch (parts[i]) {
                case '':
                    break;
                case 'L':
                case 'M':
                case 'Q':
                    break;
                default:
                    var k = ctx.applyTransformToPoint({
                        x: parts[i],
                        y: parts[i + 2]
                    });
                    parts[i] = k.x;
                    parts[i + 2] = k.y;
                    k = ctx.applyTransformToPoint({
                        x: parts[i + 1],
                        y: parts[i + 3]
                    });
                    parts[i + 1] = k.x;
                    parts[i + 3] = k.y;
                    i += 3;
            }
        }

        switch (scaleMode) {
            case "NONE":
                break;
            case "NORMAL":
                ctx.lineWidth *= 20 * Math.max(ctx._matrix[0], ctx._matrix[3]);
                break;
            case "VERTICAL":
                ctx.lineWidth *= 20 * ctx._matrix[3];
                break;
            case "HORIZONTAL":
                ctx.lineWidth *= 20 * ctx._matrix[0];
                break;
        }

        ctx.save();
        ctx.setTransform(1, 0, 0, 1, 0, 0);
    }
    ctx.beginPath();
    var drawCommand = "";
    for (var i = 0; i < len; i++) {
        switch (parts[i]) {
            case 'L':
            case 'M':
            case 'Q':
                drawCommand = parts[i];
                break;
            default:
                switch (drawCommand) {
                    case 'L':
                        ctx.lineTo(useRatio(parts[i], parts[i + 1], ratio), useRatio(parts[i + 2], parts[i + 3],
                            ratio));
                        i += 3;
                        break;
                    case 'M':
                        ctx.moveTo(useRatio(parts[i], parts[i + 1], ratio), useRatio(parts[i + 2], parts[i + 3],
                            ratio));
                        i += 3;
                        break;
                    case 'Q':
                        ctx.quadraticCurveTo(useRatio(parts[i], parts[i + 1], ratio), useRatio(parts[i + 2],
                                parts[i + 3], ratio),
                            useRatio(parts[i + 4], parts[i + 5], ratio), useRatio(parts[i + 6], parts[i +
                                7], ratio));
                        i += 7;
                        break;
                }
                break;
        }
    }
    if (doStroke) {
        ctx.stroke();
        ctx.restore();
    }
}

function useRatio(v1, v2, ratio) {
    return v1 * 1 + (v2 - v1) * ratio / 65535;
}

function drawPath(ctx, p, doStroke, scaleMode) {
    var parts = p.split(" ");
    var len = parts.length;
    if (doStroke) {
        for (var i = 0; i < len; i++) {
            switch (parts[i]) {
                case 'L':
                case 'M':
                case 'Q':
                case 'Z':
                    break;
                default:
                    var k = ctx.applyTransformToPoint({
                        x: parts[i],
                        y: parts[i + 1]
                    });
                    parts[i] = k.x;
                    parts[i + 1] = k.y;
                    i++;
            }
        }

        switch (scaleMode) {
            case "NONE":
                break;
            case "NORMAL":
                ctx.lineWidth *= 20 * Math.max(ctx._matrix[0], ctx._matrix[3]);
                break;
            case "VERTICAL":
                ctx.lineWidth *= 20 * ctx._matrix[3];
                break;
            case "HORIZONTAL":
                ctx.lineWidth *= 20 * ctx._matrix[0];
                break;
        }

        ctx.save();
        ctx.setTransform(1, 0, 0, 1, 0, 0);
    }
    ctx.beginPath();
    var drawCommand = "";
    for (var i = 0; i < len; i++) {
        switch (parts[i]) {
            case 'L':
            case 'M':
            case 'Q':
                drawCommand = parts[i];
                break;
            case 'Z':
                ctx.closePath();
                break;
            default:
                switch (drawCommand) {
                    case 'L':
                        ctx.lineTo(parts[i], parts[i + 1]);
                        i++;
                        break;
                    case 'M':
                        ctx.moveTo(parts[i], parts[i + 1]);
                        i++;
                        break;
                    case 'Q':
                        ctx.quadraticCurveTo(parts[i], parts[i + 1], parts[i + 2], parts[i + 3]);
                        i += 3;
                        break;
                }
                break;
        }
    }
    if (doStroke) {
        ctx.stroke();
        ctx.restore();
    }
}


var canvas = document.getElementById("myCanvas");
var ctx = canvas.getContext("2d");
enhanceContext(ctx);
var ctrans = new cxform(0, 0, 0, 0, 255, 255, 255, 255);

function shape286(ctx, ctrans, frame, ratio, time) {
    var pathData =
        "M 169 -79 Q 237 -52 237 -15 237 21 169 49 101 76 5 76 -91 76 -159 49 -226 21 -226 -15 -226 -52 -159 -79 -91 -105 5 -105 101 -105 169 -79";
    ctx.fillStyle = tocolor(ctrans.apply([0, 0, 0, 0.4]));
    drawPath(ctx, pathData, false);
    ctx.fill("evenodd");
    var pathData =
        "M 169 -79 Q 101 -105 5 -105 -91 -105 -159 -79 -226 -52 -226 -15 -226 21 -159 49 -91 76 5 76 101 76 169 49 237 21 237 -15 237 -52 169 -79 M 278 -114 Q 391 -69 391 -6 391 58 278 104 164 149 2 149 -159 149 -273 104 -388 58 -388 -6 -388 -69 -273 -114 -159 -160 2 -160 164 -160 278 -114";
    ctx.fillStyle = tocolor(ctrans.apply([0, 0, 0, 0.2]));
    drawPath(ctx, pathData, false);
    ctx.fill("evenodd");
}

function shape287(ctx, ctrans, frame, ratio, time) {
    var pathData =
        "M 609 106 L 779 29 Q 773 76 818 112 L 731 128 731 190 Q 645 173 609 106 M 110 61 L 213 125 87 177 110 61 Q 66 143 0 141 L 7 0 110 61";
    ctx.fillStyle = tocolor(ctrans.apply([102, 51, 0, 1]));
    drawPath(ctx, pathData, false);
    ctx.fill("evenodd");
}

function sprite288(ctx, ctrans, frame, ratio, time) {
    var clips = [];
    var frame_cnt = 1;
    frame = frame % frame_cnt;
    switch (frame) {
        case 0:
            place("shape287", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
            break;
    }
}

function shape289(ctx, ctrans, frame, ratio, time) {
    var pathData =
        "M 609 106 L 779 29 Q 773 76 818 112 L 731 128 731 190 Q 645 173 609 106 M 213 125 L 87 177 110 61 Q 66 143 0 141 L 7 0 110 61 213 125";
    var scaleMode = "NORMAL";
    ctx.strokeStyle = tocolor(ctrans.apply([0, 0, 0, 1]));
    ctx.lineWidth = 1.8;
    ctx.lineCap = "round";
    ctx.lineJoin = "round";
    drawPath(ctx, pathData, true, scaleMode);

}

function sprite290(ctx, ctrans, frame, ratio, time) {
    var clips = [];
    var frame_cnt = 1;
    frame = frame % frame_cnt;
    switch (frame) {
        case 0:
            place("sprite288", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape289", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
            break;
    }
}

function shape291(ctx, ctrans, frame, ratio, time) {
    var pathData =
        "M 101 111 L 101 114 Q 103 133 78 149 54 165 19 168 -16 171 -43 159 -69 149 -71 130 L -71 127 -70 127 94 110 101 111";
    ctx.fillStyle = tocolor(ctrans.apply([0, 0, 0, 1]));
    drawPath(ctx, pathData, false);
    ctx.fill("evenodd");
    var pathData =
        "M -71 122 L -73 77 -81 -126 Q -82 -143 -63 -155 -42 -168 -11 -171 L 42 -165 Q 63 -155 66 -140 L 67 -137 67 -133 94 61 101 109 94 110 -70 127 -71 122 M -73 77 L 94 61 -73 77";
    ctx.fillStyle = tocolor(ctrans.apply([255, 255, 255, 1]));
    drawPath(ctx, pathData, false);
    ctx.fill("evenodd");
    var pathData =
        "M -71 122 L -73 77 -81 -126 Q -82 -143 -63 -155 -42 -168 -11 -171 L 42 -165 Q 63 -155 66 -140 L 67 -137 67 -133 94 61 101 109 101 111 101 114 Q 103 133 78 149 54 165 19 168 -16 171 -43 159 -69 149 -71 130 L -71 127 -71 122 M -70 127 L 94 110 M -70 127 L -71 127 M 94 61 L -73 77";
    var scaleMode = "NORMAL";
    ctx.strokeStyle = tocolor(ctrans.apply([0, 0, 0, 1]));
    ctx.lineWidth = 1.8;
    ctx.lineCap = "round";
    ctx.lineJoin = "round";
    drawPath(ctx, pathData, true, scaleMode);

}

function sprite292(ctx, ctrans, frame, ratio, time) {
    var clips = [];
    var frame_cnt = 1;
    frame = frame % frame_cnt;
    switch (frame) {
        case 0:
            place("shape291", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
            break;
    }
}

function shape293(ctx, ctrans, frame, ratio, time) {
    var pathData = "M 0 258 Q -2 137 40 0 L 241 54 241 271 37 265 0 258";
    ctx.fillStyle = tocolor(ctrans.apply([51, 51, 51, 1]));
    drawPath(ctx, pathData, false);
    ctx.fill("evenodd");
}

function sprite294(ctx, ctrans, frame, ratio, time) {
    var clips = [];
    var frame_cnt = 1;
    frame = frame % frame_cnt;
    switch (frame) {
        case 0:
            place("shape293", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
            break;
    }
}

function shape295(ctx, ctrans, frame, ratio, time) {
    var pathData = "M 52 265 L 15 258 Q 13 137 55 0 L 93 11 52 265";
    ctx.fillStyle = tocolor(ctrans.apply([89, 89, 89, 0.49803922]));
    drawPath(ctx, pathData, false);
    ctx.fill("evenodd");
    var pathData = "M 256 271 L 52 265 14 261 15 258 Q 13 137 55 0 L 256 54 256 271 Z";
    var scaleMode = "NORMAL";
    ctx.strokeStyle = tocolor(ctrans.apply([0, 0, 0, 1]));
    ctx.lineWidth = 1.5;
    ctx.lineCap = "round";
    ctx.lineJoin = "round";
    drawPath(ctx, pathData, true, scaleMode);

}

function sprite296(ctx, ctrans, frame, ratio, time) {
    var clips = [];
    var frame_cnt = 1;
    frame = frame % frame_cnt;
    switch (frame) {
        case 0:
            place("sprite294", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 15.0, 0.0], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("shape295", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
            break;
    }
}

function shape297(ctx, ctrans, frame, ratio, time) {
    var pathData = "M 155 111 Q 126 131 101 130 40 127 0 0";
    var scaleMode = "NORMAL";
    ctx.strokeStyle = tocolor(ctrans.apply([0, 0, 0, 1]));
    ctx.lineWidth = 1.8;
    ctx.lineCap = "round";
    ctx.lineJoin = "round";
    drawPath(ctx, pathData, true, scaleMode);

}

function shape298(ctx, ctrans, frame, ratio, time) {
    var pathData = "M 353 115 Q 298 172 199 183 L 193 184 164 185 Q 80 183 0 108 L 168 0 353 115";
    ctx.fillStyle = tocolor(ctrans.apply([102, 102, 0, 1]));
    drawPath(ctx, pathData, false);
    ctx.fill("evenodd");
}

function sprite299(ctx, ctrans, frame, ratio, time) {
    var clips = [];
    var frame_cnt = 1;
    frame = frame % frame_cnt;
    switch (frame) {
        case 0:
            place("shape298", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
            break;
    }
}

function shape300(ctx, ctrans, frame, ratio, time) {
    var pathData =
        "M 402 7 L 441 303 Q 343 354 247 361 L 248 75 Q 347 64 402 7 M 49 0 Q 129 75 213 77 L 213 361 Q 105 359 0 298 L 51 9 49 0";
    ctx.fillStyle = tocolor(ctrans.apply([255, 51, 0, 1]));
    drawPath(ctx, pathData, false);
    ctx.fill("evenodd");
}

function sprite301(ctx, ctrans, frame, ratio, time) {
    var clips = [];
    var frame_cnt = 1;
    frame = frame % frame_cnt;
    switch (frame) {
        case 0:
            place("shape300", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
            break;
    }
}

function shape302(ctx, ctrans, frame, ratio, time) {
    var pathData = "M 410 1 L 410 0 410 1";
    ctx.fillStyle = tocolor(ctrans.apply([153, 204, 0, 1]));
    drawPath(ctx, pathData, false);
    ctx.fill("evenodd");
    var pathData =
        "M 449 297 L 454 340 Q 241 448 0 339 L 8 292 Q 113 353 221 355 L 221 71 250 70 256 70 255 355 Q 351 348 449 297";
    ctx.fillStyle = tocolor(ctrans.apply([0, 0, 0, 1]));
    drawPath(ctx, pathData, false);
    ctx.fill("evenodd");
    var pathData =
        "M 221 71 Q 137 69 57 -6 L 225 -114 410 1 410 0 410 1 449 297 454 340 Q 241 448 0 339 L 8 292 59 3 M 250 70 L 221 71 M 410 1 Q 355 58 256 69 L 256 70";
    var scaleMode = "NORMAL";
    ctx.strokeStyle = tocolor(ctrans.apply([0, 0, 0, 1]));
    ctx.lineWidth = 1.8;
    ctx.lineCap = "round";
    ctx.lineJoin = "round";
    drawPath(ctx, pathData, true, scaleMode);

}

function sprite303(ctx, ctrans, frame, ratio, time) {
    var clips = [];
    var frame_cnt = 1;
    frame = frame % frame_cnt;
    switch (frame) {
        case 0:
            place("sprite299", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 57.0, -114.0], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite301", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 8.0, -6.0], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("shape302", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
            break;
    }
}

function shape304(ctx, ctrans, frame, ratio, time) {
    var pathData = "M 1090 540 Q 937 825 535 864 27 781 0 536 L 0 161 493 0 1107 188 1090 540";
    ctx.fillStyle = tocolor(ctrans.apply([153, 102, 51, 1]));
    drawPath(ctx, pathData, false);
    ctx.fill("evenodd");
}

function sprite305(ctx, ctrans, frame, ratio, time) {
    var clips = [];
    var frame_cnt = 1;
    frame = frame % frame_cnt;
    switch (frame) {
        case 0:
            place("shape304", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
            break;
    }
}

function shape306(ctx, ctrans, frame, ratio, time) {
    var pathData = "M 1090 540 Q 937 825 535 864 27 781 0 536 L 0 161 493 0 1107 188 1090 540 Z";
    var scaleMode = "NORMAL";
    ctx.strokeStyle = tocolor(ctrans.apply([0, 0, 0, 1]));
    ctx.lineWidth = 1.8;
    ctx.lineCap = "round";
    ctx.lineJoin = "round";
    drawPath(ctx, pathData, true, scaleMode);

}

function sprite307(ctx, ctrans, frame, ratio, time) {
    var clips = [];
    var frame_cnt = 1;
    frame = frame % frame_cnt;
    switch (frame) {
        case 0:
            place("sprite305", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape306", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
            break;
    }
}

function shape308(ctx, ctrans, frame, ratio, time) {
    var pathData = "M 214 72 L 1 72 Q -7 2 96 0 206 -3 214 72";
    ctx.fillStyle = tocolor(ctrans.apply([102, 51, 0, 1]));
    drawPath(ctx, pathData, false);
    ctx.fill("evenodd");
}

function sprite309(ctx, ctrans, frame, ratio, time) {
    var clips = [];
    var frame_cnt = 1;
    frame = frame % frame_cnt;
    switch (frame) {
        case 0:
            place("shape308", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
            break;
    }
}

function shape310(ctx, ctrans, frame, ratio, time) {
    var pathData = "M 214 72 Q 206 -3 96 0 -7 2 1 72 L 214 72 Z";
    var scaleMode = "NORMAL";
    ctx.strokeStyle = tocolor(ctrans.apply([0, 0, 0, 1]));
    ctx.lineWidth = 1.5;
    ctx.lineCap = "round";
    ctx.lineJoin = "round";
    drawPath(ctx, pathData, true, scaleMode);

}

function sprite311(ctx, ctrans, frame, ratio, time) {
    var clips = [];
    var frame_cnt = 1;
    frame = frame % frame_cnt;
    switch (frame) {
        case 0:
            place("sprite309", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape310", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
            break;
    }
}

function shape312(ctx, ctrans, frame, ratio, time) {
    var pathData = "M 0 0 L 212 0 Q 230 121 120 154 9 166 0 0";
    ctx.fillStyle = tocolor(ctrans.apply([255, 255, 255, 1]));
    drawPath(ctx, pathData, false);
    ctx.fill("evenodd");
}

function shape313(ctx, ctrans, frame, ratio, time) {
    var pathData =
        "M 85 3 Q 100 18 100 39 100 60 85 74 71 89 50 89 29 89 14 74 0 60 0 39 0 18 14 3 L 18 0 82 0 85 3";
    ctx.fillStyle = tocolor(ctrans.apply([0, 153, 51, 1]));
    drawPath(ctx, pathData, false);
    ctx.fill("evenodd");
}

function sprite314(ctx, ctrans, frame, ratio, time) {
    var clips = [];
    var frame_cnt = 1;
    frame = frame % frame_cnt;
    switch (frame) {
        case 0:
            place("shape313", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
            break;
    }
}

function shape315(ctx, ctrans, frame, ratio, time) {
    var pathData = "M 120 154 Q 230 121 212 0 L 0 0 Q 9 166 120 154 Z";
    var scaleMode = "NORMAL";
    ctx.strokeStyle = tocolor(ctrans.apply([0, 0, 0, 1]));
    ctx.lineWidth = 1.8;
    ctx.lineCap = "round";
    ctx.lineJoin = "round";
    drawPath(ctx, pathData, true, scaleMode);

}

function sprite316(ctx, ctrans, frame, ratio, time) {
    var clips = [];
    var frame_cnt = 1;
    frame = frame % frame_cnt;
    switch (frame) {
        case 0:
            place("shape312", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite314", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 86.0, 6.0], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("shape315", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
            break;
    }
}

function shape317(ctx, ctrans, frame, ratio, time) {
    var pathData =
        "M 197 1101 L 197 1246 Q 98 1205 20 1127 L 23 972 Q 105 1064 197 1101 M 828 179 Q 1128 325 1154 573 L 1156 604 1184 904 Q 1077 989 979 1000 L 1015 826 915 929 Q 900 905 890 878 869 820 873 752 857 837 787 878 L 776 884 561 765 603 951 Q 541 919 485 878 400 815 329 729 L 326 874 Q 227 835 155 732 153 808 173 878 L 184 913 7 803 Q -55 280 409 159 484 141 555 137 L 551 3 Q 649 10 696 143 L 754 0 Q 840 71 828 179 M 959 1101 Q 1051 1064 1133 972 L 1136 1127 Q 1058 1205 959 1246 L 959 1101";
    ctx.fillStyle = tocolor(ctrans.apply([102, 51, 0, 1]));
    drawPath(ctx, pathData, false);
    ctx.fill("evenodd");
}

function sprite318(ctx, ctrans, frame, ratio, time) {
    var clips = [];
    var frame_cnt = 1;
    frame = frame % frame_cnt;
    switch (frame) {
        case 0:
            place("shape317", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
            break;
    }
}

function shape319(ctx, ctrans, frame, ratio, time) {
    var pathData =
        "M 1154 573 Q 1128 325 828 179 840 71 754 0 L 696 143 Q 649 10 551 3 L 555 137 Q 484 141 409 159 -55 280 7 803 L 184 913 173 878 Q 153 808 155 732 227 835 326 874 L 329 729 Q 400 815 485 878 541 919 603 951 L 561 765 776 884 787 878 Q 857 837 873 752 869 820 890 878 900 905 915 929 L 1015 826 979 1000 Q 1077 989 1184 904 L 1156 604 1154 573 M 197 1246 L 197 1101 Q 105 1064 23 972 L 20 1127 Q 98 1205 197 1246 M 959 1246 L 959 1101 Q 1051 1064 1133 972 L 1136 1127 Q 1058 1205 959 1246";
    var scaleMode = "NORMAL";
    ctx.strokeStyle = tocolor(ctrans.apply([0, 0, 0, 1]));
    ctx.lineWidth = 1.8;
    ctx.lineCap = "round";
    ctx.lineJoin = "round";
    drawPath(ctx, pathData, true, scaleMode);

}

function sprite320(ctx, ctrans, frame, ratio, time) {
    var clips = [];
    var frame_cnt = 1;
    frame = frame % frame_cnt;
    switch (frame) {
        case 0:
            place("sprite318", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape319", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
            break;
    }
}

function shape321(ctx, ctrans, frame, ratio, time) {
    var pathData =
        "M 1426 560 Q 1482 575 1520 607 1424 833 1475 1038 1444 1060 1406 1072 1316 1056 1330 803 1340 636 1426 560 M 1332 531 Q 1267 44 763 49 259 53 187 523 161 517 131 531 198 -6 763 0 1328 6 1390 539 1358 524 1332 531 M 94 552 Q 180 628 190 795 204 1048 114 1064 76 1052 45 1030 96 825 0 599 38 567 94 552";
    ctx.fillStyle = tocolor(ctrans.apply([0, 51, 51, 1]));
    drawPath(ctx, pathData, false);
    ctx.fill("evenodd");
}

function sprite322(ctx, ctrans, frame, ratio, time) {
    var clips = [];
    var frame_cnt = 1;
    frame = frame % frame_cnt;
    switch (frame) {
        case 0:
            place("shape321", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
            break;
    }
}

function shape323(ctx, ctrans, frame, ratio, time) {
    var pathData =
        "M 261 523 Q 326 538 352 687 373 821 358 954 345 1069 281 1111 229 1144 188 1064 278 1048 264 795 254 628 168 552 L 205 531 Q 235 517 261 523 M 1464 539 Q 1481 546 1500 560 1414 636 1404 803 1390 1056 1480 1072 1439 1152 1387 1119 1323 1077 1310 962 1295 829 1316 695 1341 547 1406 531 1432 524 1464 539";
    ctx.fillStyle = tocolor(ctrans.apply([51, 51, 51, 1]));
    drawPath(ctx, pathData, false);
    ctx.fill("evenodd");
    var pathData =
        "M 119 1030 Q 33 970 1 838 -11 673 74 599 170 825 119 1030 M 1594 607 Q 1679 681 1667 846 1635 978 1549 1038 1498 833 1594 607";
    ctx.fillStyle = tocolor(ctrans.apply([0, 0, 0, 1]));
    drawPath(ctx, pathData, false);
    ctx.fill("evenodd");
    var pathData =
        "M 1406 531 Q 1341 44 837 49 333 53 261 523 326 538 352 687 373 821 358 954 345 1069 281 1111 229 1144 188 1064 150 1052 119 1030 33 970 1 838 -11 673 74 599 112 567 168 552 L 205 531 Q 272 -6 837 0 1402 6 1464 539 1481 546 1500 560 1556 575 1594 607 1679 681 1667 846 1635 978 1549 1038 1518 1060 1480 1072 1439 1152 1387 1119 1323 1077 1310 962 1295 829 1316 695 1341 547 1406 531 1432 524 1464 539 M 1500 560 Q 1414 636 1404 803 1390 1056 1480 1072 M 261 523 Q 235 517 205 531 M 168 552 Q 254 628 264 795 278 1048 188 1064 M 74 599 Q 170 825 119 1030 M 1549 1038 Q 1498 833 1594 607";
    var scaleMode = "NORMAL";
    ctx.strokeStyle = tocolor(ctrans.apply([0, 0, 0, 1]));
    ctx.lineWidth = 1.8;
    ctx.lineCap = "round";
    ctx.lineJoin = "round";
    drawPath(ctx, pathData, true, scaleMode);

}

function sprite324(ctx, ctrans, frame, ratio, time) {
    var clips = [];
    var frame_cnt = 1;
    frame = frame % frame_cnt;
    switch (frame) {
        case 0:
            place("sprite322", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 74.0, 0.0], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("shape323", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
            break;
    }
}

function morphshape325(ctx, ctrans, frame, ratio, time) {
    var pathData =
        "M 0 -36 24 31 Q 0 -36 42 54 12 -12 54 70 25 14 67 87 43 50 67 87 61 86 67 87 73 110 54 70 86 136 42 54 86 136 24 31 82 136 12 14 79 122 0 -1 L 7 -22 0 -1 Q 0 -36 11 14 0 -36 24 31";
    ctx.fillStyle = tocolor(ctrans.apply([Math.round(0 + ratio * (0) / 65535), Math.round(0 + ratio * (0) /
        65535), Math.round(0 + ratio * (1) / 65535), ((Math.round(255 + ratio * (0) / 65535)) /
        255)]));
    drawMorphPath(ctx, pathData, ratio, false);

    ctx.fill("evenodd");
    var pathData =
        "M 0 -36 24 31 Q 0 -36 11 14 7 -22 0 -1 L 79 122 0 -1 Q 82 136 12 14 86 136 24 31 86 136 42 54 73 110 54 70 61 86 67 87 43 50 67 87 25 14 67 87 12 -12 54 70 0 -36 42 54 0 -36 24 31";
    var scaleMode = "NORMAL";
    ctx.strokeStyle = tocolor(ctrans.apply([Math.round(0 + ratio * (0) / 65535), Math.round(0 + ratio * (0) /
        65535), Math.round(0 + ratio * (1) / 65535), ((Math.round(0 + ratio * (0) / 65535)) /
        255)]));
    ctx.lineWidth = 0.0 + ratio * (0) / 65535;
    ctx.lineCap = "round";
    ctx.lineJoin = "round";
    drawMorphPath(ctx, pathData, ratio, true, scaleMode);

}

function shape326(ctx, ctrans, frame, ratio, time) {
    var pathData = "M 10 2 L 132 75 130 77 109 92 Q 78 104 48 92 16 78 4 48 -5 26 4 1 L 5 0 10 2";
    ctx.fillStyle = tocolor(ctrans.apply([153, 102, 51, 1]));
    drawPath(ctx, pathData, false);
    ctx.fill("evenodd");
}

function sprite327(ctx, ctrans, frame, ratio, time) {
    var clips = [];
    var frame_cnt = 1;
    frame = frame % frame_cnt;
    switch (frame) {
        case 0:
            place("shape326", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
            break;
    }
}

function shape328(ctx, ctrans, frame, ratio, time) {
    var pathData = "M 44 257 L 8 234 0 230 43 146 Q 109 22 131 9 148 -2 164 1 L 162 11 44 257";
    ctx.fillStyle = tocolor(ctrans.apply([102, 102, 0, 1]));
    drawPath(ctx, pathData, false);
    ctx.fill("evenodd");
}

function sprite329(ctx, ctrans, frame, ratio, time) {
    var clips = [];
    var frame_cnt = 1;
    frame = frame % frame_cnt;
    switch (frame) {
        case 0:
            place("shape328", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
            break;
    }
}

function shape330(ctx, ctrans, frame, ratio, time) {
    var pathData = "M 0 254 L 118 8 129 0 Q 149 9 154 34 160 59 120 194 L 83 307 0 254";
    ctx.fillStyle = tocolor(ctrans.apply([255, 51, 0, 1]));
    drawPath(ctx, pathData, false);
    ctx.fill("evenodd");
}

function sprite331(ctx, ctrans, frame, ratio, time) {
    var clips = [];
    var frame_cnt = 1;
    frame = frame % frame_cnt;
    switch (frame) {
        case 0:
            place("shape330", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
            break;
    }
}

function shape332(ctx, ctrans, frame, ratio, time) {
    var pathData = "M -87 45 L -79 49 40 125 37 132 20 163 14 159 -102 90 -107 88 -102 75 -87 45";
    ctx.fillStyle = tocolor(ctrans.apply([0, 0, 0, 1]));
    drawPath(ctx, pathData, false);
    ctx.fill("evenodd");
    var pathData =
        "M 40 125 L 77 12 Q 117 -123 111 -148 106 -173 86 -182 L 77 -184 Q 61 -187 44 -176 22 -163 -44 -39 L -87 45 M 40 125 L 37 132 20 163 18 165 -3 180 Q -34 192 -64 180 -96 166 -108 136 -117 114 -108 89 L -107 88 -102 75 -87 45";
    var scaleMode = "NORMAL";
    ctx.strokeStyle = tocolor(ctrans.apply([0, 0, 0, 1]));
    ctx.lineWidth = 1.8;
    ctx.lineCap = "round";
    ctx.lineJoin = "round";
    drawPath(ctx, pathData, true, scaleMode);

    var pathData = "M -79 49 L 40 125 M -102 90 L 14 159";
    var scaleMode = "NORMAL";
    ctx.strokeStyle = tocolor(ctrans.apply([0, 0, 0, 1]));
    ctx.lineWidth = 1.5;
    ctx.lineCap = "round";
    ctx.lineJoin = "round";
    drawPath(ctx, pathData, true, scaleMode);

}

function sprite333(ctx, ctrans, frame, ratio, time) {
    var clips = [];
    var frame_cnt = 1;
    frame = frame % frame_cnt;
    switch (frame) {
        case 0:
            place("sprite327", canvas, ctx, [1.0, 0.0, 0.0, 1.0, -112.0, 88.0], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite329", canvas, ctx, [1.0, 0.0, 0.0, 1.0, -87.0, -185.0], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite331", canvas, ctx, [1.0, 0.0, 0.0, 1.0, -43.0, -182.0], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("shape332", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
            break;
    }
}

function shape334(ctx, ctrans, frame, ratio, time) {
    var pathData = "M 1095 2 L 1095 10 1095 2";
    ctx.fillStyle = tocolor(ctrans.apply([153, 102, 51, 1]));
    drawPath(ctx, pathData, false);
    ctx.fill("evenodd");
    var pathData =
        "M 1095 10 L 1095 2 1117 0 Q 1175 73 1099 116 L 1088 104 Q 1133 58 1095 10 M 1035 101 L 1038 107 Q 1010 168 943 194 L 920 181 925 170 Q 981 149 998 101 L 1035 101 M 354 380 Q 351 475 426 484 L 419 494 417 496 422 499 451 508 429 505 Q 324 482 328 391 L 354 380 M 150 651 L 146 651 Q 125 647 97 630 44 580 22 473 -32 212 44 223 146 271 215 199 279 86 353 89 407 96 374 138 L 335 171 Q 302 236 365 285 L 327 301 316 305 Q 312 228 272 263 240 321 163 294 63 278 72 338 L 115 433 Q 168 498 147 570 127 606 149 636 L 150 651";
    ctx.fillStyle = tocolor(ctrans.apply([0, 0, 0, 1]));
    drawPath(ctx, pathData, false);
    ctx.fill("evenodd");
    var pathData =
        "M 407 356 L 354 380 328 391 Q 324 482 429 505 L 444 523 444 533 Q 440 543 428 551 L 404 560 Q 350 575 307 546 L 306 546 Q 269 538 236 572 L 190 636 Q 175 654 150 651 L 149 636 Q 127 606 147 570 168 498 115 433 L 72 338 Q 63 278 163 294 240 321 272 263 312 228 316 305 L 327 301 365 285 374 285 327 301 374 285 383 284 403 346 407 356 M 419 494 L 451 508 422 499 417 496 419 494 M 404 560 L 444 533 404 560 M 183 459 L 153 375 183 459 M 234 436 L 204 352 234 436 M 284 414 L 254 330 284 414";
    ctx.fillStyle = tocolor(ctrans.apply([0, 102, 204, 1]));
    drawPath(ctx, pathData, false);
    ctx.fill("evenodd");
    var pathData =
        "M 1095 2 L 1095 10 Q 1133 58 1088 104 L 1084 107 1076 115 1038 107 1035 101 998 101 Q 981 149 925 170 L 920 181 864 150 858 153 762 196 670 238 600 269 517 307 458 333 407 356 403 346 383 284 380 278 433 254 486 230 571 191 641 159 732 117 829 72 860 23 1095 2 M 762 196 L 732 117 762 196 M 670 238 L 641 159 670 238 M 833 87 L 858 153 833 87 M 517 307 L 486 230 517 307 M 571 191 L 600 269 571 191 M 433 254 L 458 333 433 254";
    ctx.fillStyle = tocolor(ctrans.apply([153, 204, 102, 1]));
    drawPath(ctx, pathData, false);
    ctx.fill("evenodd");
    var pathData =
        "M 1095 10 Q 1133 58 1088 104 M 1076 115 L 1084 107 1088 104 M 925 170 Q 981 149 998 101 L 1035 101";
    var scaleMode = "NORMAL";
    ctx.strokeStyle = tocolor(ctrans.apply([0, 0, 0, 1]));
    ctx.lineWidth = 1.0;
    ctx.lineCap = "round";
    ctx.lineJoin = "round";
    drawPath(ctx, pathData, true, scaleMode);

    var pathData =
        "M 1099 116 Q 1175 73 1117 0 L 1095 2 M 1038 107 L 1076 115 1094 118 1099 116 M 380 278 L 433 254 486 230 571 191 641 159 732 117 829 72 860 23 1095 2 M 920 181 L 864 150 858 153 762 196 670 238 600 269 517 307 458 333 407 356 354 380 Q 351 475 426 484 469 508 444 533 440 543 428 551 L 404 560 Q 350 575 307 546 L 306 546 Q 269 538 236 572 L 190 636 Q 175 654 150 651 L 146 651 Q 125 647 97 630 44 580 22 473 -32 212 44 223 146 271 215 199 279 86 353 89 407 96 374 138 L 335 171 Q 302 236 365 285 L 380 278 M 1038 107 Q 1010 168 943 194 L 920 181 M 444 533 L 404 560 M 153 375 L 183 459 M 327 301 L 374 285 M 354 380 L 328 391 M 254 330 L 284 414 M 204 352 L 234 436";
    var scaleMode = "NORMAL";
    ctx.strokeStyle = tocolor(ctrans.apply([0, 0, 0, 1]));
    ctx.lineWidth = 1.5;
    ctx.lineCap = "round";
    ctx.lineJoin = "round";
    drawPath(ctx, pathData, true, scaleMode);

    var pathData =
        "M 383 284 L 403 346 M 858 153 L 833 87 M 641 159 L 670 238 M 732 117 L 762 196 M 458 333 L 433 254 M 600 269 L 571 191 M 486 230 L 517 307";
    var scaleMode = "NORMAL";
    ctx.strokeStyle = tocolor(ctrans.apply([0, 0, 0, 1]));
    ctx.lineWidth = 0.5;
    ctx.lineCap = "round";
    ctx.lineJoin = "round";
    drawPath(ctx, pathData, true, scaleMode);

}

function sprite335(ctx, ctrans, frame, ratio, time) {
    var clips = [];
    var frame_cnt = 1;
    frame = frame % frame_cnt;
    switch (frame) {
        case 0:
            place("shape334", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
            break;
    }
}

function shape336(ctx, ctrans, frame, ratio, time) {
    var pathData =
        "M 150 150 Q 124 176 88 176 52 176 26 150 0 124 0 88 0 52 26 26 52 0 88 0 124 0 150 26 176 52 176 88 176 124 150 150";
    ctx.fillStyle = tocolor(ctrans.apply([153, 102, 51, 1]));
    drawPath(ctx, pathData, false);
    ctx.fill("evenodd");
}

function sprite337(ctx, ctrans, frame, ratio, time) {
    var clips = [];
    var frame_cnt = 1;
    frame = frame % frame_cnt;
    switch (frame) {
        case 0:
            place("shape336", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
            break;
    }
}

function shape338(ctx, ctrans, frame, ratio, time) {
    var pathData =
        "M 150 150 Q 124 176 88 176 52 176 26 150 0 124 0 88 0 52 26 26 52 0 88 0 124 0 150 26 176 52 176 88 176 124 150 150 Z";
    var scaleMode = "NORMAL";
    ctx.strokeStyle = tocolor(ctrans.apply([0, 0, 0, 1]));
    ctx.lineWidth = 1.8;
    ctx.lineCap = "round";
    ctx.lineJoin = "round";
    drawPath(ctx, pathData, true, scaleMode);

}

function sprite339(ctx, ctrans, frame, ratio, time) {
    var clips = [];
    var frame_cnt = 1;
    frame = frame % frame_cnt;
    switch (frame) {
        case 0:
            place("sprite337", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape338", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
            break;
    }
}

function shape340(ctx, ctrans, frame, ratio, time) {
    var pathData = "M 144 0 Q 163 10 172 26 105 147 0 152 L 1 96 Q 89 103 144 0";
    ctx.fillStyle = tocolor(ctrans.apply([102, 102, 0, 1]));
    drawPath(ctx, pathData, false);
    ctx.fill("evenodd");
}

function sprite341(ctx, ctrans, frame, ratio, time) {
    var clips = [];
    var frame_cnt = 1;
    frame = frame % frame_cnt;
    switch (frame) {
        case 0:
            place("shape340", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
            break;
    }
}

function shape342(ctx, ctrans, frame, ratio, time) {
    var pathData = "M 2 122 Q -4 86 4 53 10 20 79 0 L 89 0 89 85 75 158 Q 8 157 2 122";
    ctx.fillStyle = tocolor(ctrans.apply([153, 102, 51, 1]));
    drawPath(ctx, pathData, false);
    ctx.fill("evenodd");
}

function sprite343(ctx, ctrans, frame, ratio, time) {
    var clips = [];
    var frame_cnt = 1;
    frame = frame % frame_cnt;
    switch (frame) {
        case 0:
            place("shape342", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
            break;
    }
}

function shape344(ctx, ctrans, frame, ratio, time) {
    var pathData =
        "M 14 75 Q 71 63 133 0 L 158 10 Q 103 113 15 106 L 14 75 M 175 130 Q 109 234 0 235 L 14 162 Q 119 157 186 36 205 70 175 130";
    ctx.fillStyle = tocolor(ctrans.apply([255, 51, 0, 1]));
    drawPath(ctx, pathData, false);
    ctx.fill("evenodd");
}

function sprite345(ctx, ctrans, frame, ratio, time) {
    var clips = [];
    var frame_cnt = 1;
    frame = frame % frame_cnt;
    switch (frame) {
        case 0:
            place("shape344", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
            break;
    }
}

function shape346(ctx, ctrans, frame, ratio, time) {
    var pathData =
        "M 21 101 Q -48 121 -54 154 -62 187 -56 223 -50 258 17 259 L 31 186 31 99 Q 88 87 150 24 L 175 34 Q 194 44 203 60 222 94 192 154 126 258 17 259";
    var scaleMode = "NORMAL";
    ctx.strokeStyle = tocolor(ctrans.apply([0, 0, 0, 1]));
    ctx.lineWidth = 1.8;
    ctx.lineCap = "round";
    ctx.lineJoin = "round";
    drawPath(ctx, pathData, true, scaleMode);

}

function sprite347(ctx, ctrans, frame, ratio, time) {
    var clips = [];
    var frame_cnt = 1;
    frame = frame % frame_cnt;
    switch (frame) {
        case 0:
            place("sprite341", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 31.0, 34.0], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite343", canvas, ctx, [1.0, 0.0, 0.0, 1.0, -58.0, 101.0], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite345", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 17.0, 24.0], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("shape346", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
            break;
    }
}

function shape348(ctx, ctrans, frame, ratio, time) {
    var pathData = "M 0 279 L 36 15 31 5 42 1 47 11 56 0 Q 67 2 76 10 L 34 291 0 279";
    ctx.fillStyle = tocolor(ctrans.apply([102, 102, 0, 1]));
    drawPath(ctx, pathData, false);
    ctx.fill("evenodd");
}

function sprite349(ctx, ctrans, frame, ratio, time) {
    var clips = [];
    var frame_cnt = 1;
    frame = frame % frame_cnt;
    switch (frame) {
        case 0:
            place("shape348", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
            break;
    }
}

function shape350(ctx, ctrans, frame, ratio, time) {
    var pathData = "M 5 0 L 142 39 141 41 125 62 Q 98 81 66 78 31 72 12 46 -2 27 0 1 L 1 0 5 0";
    ctx.fillStyle = tocolor(ctrans.apply([153, 102, 51, 1]));
    drawPath(ctx, pathData, false);
    ctx.fill("evenodd");
}

function sprite351(ctx, ctrans, frame, ratio, time) {
    var clips = [];
    var frame_cnt = 1;
    frame = frame % frame_cnt;
    switch (frame) {
        case 0:
            place("shape350", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
            break;
    }
}

function shape352(ctx, ctrans, frame, ratio, time) {
    var pathData =
        "M 19 166 Q 51 30 69 12 L 83 0 88 10 52 274 9 260 0 258 19 166 M 128 5 L 141 21 Q 153 44 149 185 L 143 304 86 286 128 5";
    ctx.fillStyle = tocolor(ctrans.apply([255, 51, 0, 1]));
    drawPath(ctx, pathData, false);
    ctx.fill("evenodd");
}

function sprite353(ctx, ctrans, frame, ratio, time) {
    var clips = [];
    var frame_cnt = 1;
    frame = frame % frame_cnt;
    switch (frame) {
        case 0:
            place("shape352", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
            break;
    }
}

function shape354(ctx, ctrans, frame, ratio, time) {
    var pathData = "M -54 41 L -45 42 89 86 88 93 79 127 73 125 -58 88 -62 88 -62 73 -54 41";
    ctx.fillStyle = tocolor(ctrans.apply([0, 0, 0, 1]));
    drawPath(ctx, pathData, false);
    ctx.fill("evenodd");
    var pathData =
        "M 89 86 L 95 -33 Q 99 -174 87 -197 L 74 -213 54 -223 44 -223 40 -222 29 -218 15 -206 Q -3 -188 -35 -52 L -54 40 -54 41 M 89 86 L 88 93 79 127 78 129 62 150 Q 35 169 3 166 -32 160 -51 134 -65 115 -63 89 L -62 88 -62 73 -54 41";
    var scaleMode = "NORMAL";
    ctx.strokeStyle = tocolor(ctrans.apply([0, 0, 0, 1]));
    ctx.lineWidth = 1.8;
    ctx.lineCap = "round";
    ctx.lineJoin = "round";
    drawPath(ctx, pathData, true, scaleMode);

    var pathData = "M -45 42 L 89 86 M 73 125 L -58 88";
    var scaleMode = "NORMAL";
    ctx.strokeStyle = tocolor(ctrans.apply([0, 0, 0, 1]));
    ctx.lineWidth = 1.5;
    ctx.lineCap = "round";
    ctx.lineJoin = "round";
    drawPath(ctx, pathData, true, scaleMode);

}

function sprite355(ctx, ctrans, frame, ratio, time) {
    var clips = [];
    var frame_cnt = 1;
    frame = frame % frame_cnt;
    switch (frame) {
        case 0:
            place("sprite349", canvas, ctx, [1.0, 0.0, 0.0, 1.0, -2.0, -223.0], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite351", canvas, ctx, [1.0, 0.0, 0.0, 1.0, -63.0, 88.0], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite353", canvas, ctx, [1.0, 0.0, 0.0, 1.0, -54.0, -218.0], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("shape354", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
            break;
    }
}

function shape356(ctx, ctrans, frame, ratio, time) {
    var pathData = "M 227 38 L 23 42 Q 106 -57 227 38";
    ctx.fillStyle = tocolor(ctrans.apply([255, 255, 255, 1]));
    drawPath(ctx, pathData, false);
    ctx.fill("evenodd");
}

function shape357(ctx, ctrans, frame, ratio, time) {
    var pathData = "M 0 15 Q 0 7 3 0 L 92 0 94 15 Q 94 34 80 48 66 62 47 62 28 62 14 48 0 34 0 15";
    ctx.fillStyle = tocolor(ctrans.apply([0, 153, 51, 1]));
    drawPath(ctx, pathData, false);
    ctx.fill("evenodd");
}

function sprite358(ctx, ctrans, frame, ratio, time) {
    var clips = [];
    var frame_cnt = 1;
    frame = frame % frame_cnt;
    switch (frame) {
        case 0:
            place("shape357", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
            break;
    }
}

function shape359(ctx, ctrans, frame, ratio, time) {
    var pathData = "M 23 42 Q 106 -57 227 42";
    var scaleMode = "NORMAL";
    ctx.strokeStyle = tocolor(ctrans.apply([0, 0, 0, 1]));
    ctx.lineWidth = 1.5;
    ctx.lineCap = "round";
    ctx.lineJoin = "round";
    drawPath(ctx, pathData, true, scaleMode);

    var pathData = "M 25 48 L 231 49";
    var scaleMode = "NORMAL";
    ctx.strokeStyle = tocolor(ctrans.apply([0, 0, 0, 1]));
    ctx.lineWidth = 1.2;
    ctx.lineCap = "round";
    ctx.lineJoin = "round";
    drawPath(ctx, pathData, true, scaleMode);

}

function sprite360(ctx, ctrans, frame, ratio, time) {
    var clips = [];
    var frame_cnt = 1;
    frame = frame % frame_cnt;
    switch (frame) {
        case 0:
            place("shape356", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite358", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 74.0, -4.0], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("shape359", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
            break;
    }
}

function shape361(ctx, ctrans, frame, ratio, time) {
    var pathData = "M -92 -816 Q -144 -913 -293 -895";
    var scaleMode = "NORMAL";
    ctx.strokeStyle = tocolor(ctrans.apply([0, 0, 0, 1]));
    ctx.lineWidth = 1.5;
    ctx.lineCap = "round";
    ctx.lineJoin = "round";
    drawPath(ctx, pathData, true, scaleMode);

}

function shape362(ctx, ctrans, frame, ratio, time) {
    var pathData = "M 109 -812 Q 182 -918 306 -908";
    var scaleMode = "NORMAL";
    ctx.strokeStyle = tocolor(ctrans.apply([0, 0, 0, 1]));
    ctx.lineWidth = 1.5;
    ctx.lineCap = "round";
    ctx.lineJoin = "round";
    drawPath(ctx, pathData, true, scaleMode);

}

function sprite363(ctx, ctrans, frame, ratio, time) {
    var clips = [];
    var frame_cnt = 1;
    frame = frame % frame_cnt;
    switch (frame) {
        case 0:
            place("shape350", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
            break;
    }
}

function shape364(ctx, ctrans, frame, ratio, time) {
    var pathData =
        "M 19 172 Q 51 36 69 18 L 83 6 94 2 98 1 108 1 Q 119 3 128 11 L 141 27 Q 153 50 149 191 L 143 310 9 266 0 264 19 172";
    ctx.fillStyle = tocolor(ctrans.apply([255, 51, 0, 1]));
    drawPath(ctx, pathData, false);
    ctx.fill("evenodd");
}

function sprite365(ctx, ctrans, frame, ratio, time) {
    var clips = [];
    var frame_cnt = 1;
    frame = frame % frame_cnt;
    switch (frame) {
        case 0:
            place("shape364", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
            break;
    }
}

function shape366(ctx, ctrans, frame, ratio, time) {
    var pathData = "M -54 41 L -45 42 89 86 88 93 79 127 73 125 -58 88 -62 88 -62 73 -54 41";
    ctx.fillStyle = tocolor(ctrans.apply([0, 0, 0, 1]));
    drawPath(ctx, pathData, false);
    ctx.fill("evenodd");
    var pathData =
        "M 89 86 L 95 -33 Q 99 -174 87 -197 L 74 -213 54 -223 44 -223 40 -222 29 -218 15 -206 Q -3 -188 -35 -52 L -54 40 -54 41 M 89 86 L 88 93 79 127 78 129 62 150 Q 35 169 3 166 -32 160 -51 134 -65 115 -63 89 L -62 88 -62 73 -54 41";
    var scaleMode = "NORMAL";
    ctx.strokeStyle = tocolor(ctrans.apply([0, 0, 0, 1]));
    ctx.lineWidth = 1.8;
    ctx.lineCap = "round";
    ctx.lineJoin = "round";
    drawPath(ctx, pathData, true, scaleMode);

    var pathData = "M -45 42 L 89 86 M -58 88 L 73 125";
    var scaleMode = "NORMAL";
    ctx.strokeStyle = tocolor(ctrans.apply([0, 0, 0, 1]));
    ctx.lineWidth = 1.5;
    ctx.lineCap = "round";
    ctx.lineJoin = "round";
    drawPath(ctx, pathData, true, scaleMode);

}

function sprite367(ctx, ctrans, frame, ratio, time) {
    var clips = [];
    var frame_cnt = 1;
    frame = frame % frame_cnt;
    switch (frame) {
        case 0:
            place("sprite363", canvas, ctx, [1.0, 0.0, 0.0, 1.0, -63.0, 88.0], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite365", canvas, ctx, [1.0, 0.0, 0.0, 1.0, -54.0, -224.0], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("shape366", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
            break;
    }
}

function shape368(ctx, ctrans, frame, ratio, time) {
    var pathData = "M 1206 298 Q 1147 604 868 725 580 828 320 725 44 642 0 313 L 128 0 890 59 1206 298";
    ctx.fillStyle = tocolor(ctrans.apply([153, 102, 51, 1]));
    drawPath(ctx, pathData, false);
    ctx.fill("evenodd");
}

function sprite369(ctx, ctrans, frame, ratio, time) {
    var clips = [];
    var frame_cnt = 1;
    frame = frame % frame_cnt;
    switch (frame) {
        case 0:
            place("shape368", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
            break;
    }
}

function shape370(ctx, ctrans, frame, ratio, time) {
    var pathData = "M 1206 298 L 890 59 128 0 0 313 Q 44 642 320 725 580 828 868 725 1147 604 1206 298 Z";
    var scaleMode = "NORMAL";
    ctx.strokeStyle = tocolor(ctrans.apply([0, 0, 0, 1]));
    ctx.lineWidth = 1.8;
    ctx.lineCap = "round";
    ctx.lineJoin = "round";
    drawPath(ctx, pathData, true, scaleMode);

}

function sprite371(ctx, ctrans, frame, ratio, time) {
    var clips = [];
    var frame_cnt = 1;
    frame = frame % frame_cnt;
    switch (frame) {
        case 0:
            place("sprite369", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape370", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
            break;
    }
}

function shape372(ctx, ctrans, frame, ratio, time) {
    var pathData = "M 168 117 Q 106 82 0 72 15 -1 108 0 175 41 168 117";
    ctx.fillStyle = tocolor(ctrans.apply([102, 51, 0, 1]));
    drawPath(ctx, pathData, false);
    ctx.fill("evenodd");
}

function sprite373(ctx, ctrans, frame, ratio, time) {
    var clips = [];
    var frame_cnt = 1;
    frame = frame % frame_cnt;
    switch (frame) {
        case 0:
            place("shape372", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
            break;
    }
}

function shape374(ctx, ctrans, frame, ratio, time) {
    var pathData = "M 168 117 Q 175 41 108 0 15 -1 0 72 106 82 168 117 Z";
    var scaleMode = "NORMAL";
    ctx.strokeStyle = tocolor(ctrans.apply([0, 0, 0, 1]));
    ctx.lineWidth = 1.8;
    ctx.lineCap = "round";
    ctx.lineJoin = "round";
    drawPath(ctx, pathData, true, scaleMode);

}

function sprite375(ctx, ctrans, frame, ratio, time) {
    var clips = [];
    var frame_cnt = 1;
    frame = frame % frame_cnt;
    switch (frame) {
        case 0:
            place("sprite373", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape374", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
            break;
    }
}

function shape376(ctx, ctrans, frame, ratio, time) {
    var pathData = "M -189 -533 L -200 -553 -215 -571 -218 -575 -227 -582 Q -279 -624 -362 -600";
    var scaleMode = "NORMAL";
    ctx.strokeStyle = tocolor(ctrans.apply([0, 0, 0, 1]));
    ctx.lineWidth = 1.8;
    ctx.lineCap = "round";
    ctx.lineJoin = "round";
    drawPath(ctx, pathData, true, scaleMode);

}

function shape377(ctx, ctrans, frame, ratio, time) {
    var pathData = "M 84 -571 L 92 -582 111 -604 115 -609 123 -618 Q 176 -667 250 -670";
    var scaleMode = "NORMAL";
    ctx.strokeStyle = tocolor(ctrans.apply([0, 0, 0, 1]));
    ctx.lineWidth = 1.8;
    ctx.lineCap = "round";
    ctx.lineJoin = "round";
    drawPath(ctx, pathData, true, scaleMode);

}

function shape378(ctx, ctrans, frame, ratio, time) {
    var pathData =
        "M 1238 604 Q 1263 956 1058 1127 L 1076 935 955 1024 951 843 841 994 690 843 Q 653 959 664 1075 540 1007 440 865 L 392 1027 Q 316 982 267 880 L 256 1068 160 957 160 1138 Q 24 950 5 755 -14 560 43 382 99 204 377 60 673 -80 925 104 1231 265 1238 604";
    ctx.fillStyle = tocolor(ctrans.apply([102, 51, 0, 1]));
    drawPath(ctx, pathData, false);
    ctx.fill("evenodd");
}

function sprite379(ctx, ctrans, frame, ratio, time) {
    var clips = [];
    var frame_cnt = 1;
    frame = frame % frame_cnt;
    switch (frame) {
        case 0:
            place("shape378", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
            break;
    }
}

function shape380(ctx, ctrans, frame, ratio, time) {
    var pathData =
        "M 1238 604 Q 1263 956 1058 1127 L 1076 935 955 1024 951 843 841 994 690 843 Q 653 959 664 1075 540 1007 440 865 L 392 1027 Q 316 982 267 880 L 256 1068 160 957 160 1138 Q 24 950 5 755 -14 560 43 382 99 204 377 60 673 -80 925 104 1231 265 1238 604 Z";
    var scaleMode = "NORMAL";
    ctx.strokeStyle = tocolor(ctrans.apply([0, 0, 0, 1]));
    ctx.lineWidth = 1.8;
    ctx.lineCap = "round";
    ctx.lineJoin = "round";
    drawPath(ctx, pathData, true, scaleMode);

}

function sprite381(ctx, ctrans, frame, ratio, time) {
    var clips = [];
    var frame_cnt = 1;
    frame = frame % frame_cnt;
    switch (frame) {
        case 0:
            place("sprite379", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape380", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
            break;
    }
}

function shape382(ctx, ctrans, frame, ratio, time) {
    var pathData =
        "M 1340 266 L 1344 270 Q 1341 325 1300 391 1260 348 1217 312 1027 157 767 141 472 142 331 289 285 336 255 399 197 344 204 263 243 215 285 177 436 35 612 16 961 -53 1238 171 1290 213 1340 266 M 1449 284 Q 1514 308 1547 373 1481 396 1472 586 1464 731 1502 804 1461 850 1402 870 1352 558 1449 284 M 98 284 Q 195 558 145 870 86 850 45 804 83 731 75 586 66 396 0 373 33 308 98 284";
    ctx.fillStyle = tocolor(ctrans.apply([0, 51, 51, 1]));
    drawPath(ctx, pathData, false);
    ctx.fill("evenodd");
}

function sprite383(ctx, ctrans, frame, ratio, time) {
    var clips = [];
    var frame_cnt = 1;
    frame = frame % frame_cnt;
    switch (frame) {
        case 0:
            place("shape382", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
            break;
    }
}

function shape384(ctx, ctrans, frame, ratio, time) {
    var pathData =
        "M 1331 399 L 1339 391 Q 1380 325 1383 270 L 1379 266 Q 1422 191 1503 244 L 1488 284 Q 1391 558 1441 870 1425 944 1342 906 1270 631 1331 399 M 294 399 Q 355 631 283 906 200 944 184 870 234 558 137 284 L 122 244 Q 203 191 243 263 236 344 294 399";
    ctx.fillStyle = tocolor(ctrans.apply([51, 51, 51, 1]));
    drawPath(ctx, pathData, false);
    ctx.fill("evenodd");
    var pathData =
        "M 84 804 Q 17 730 0 586 -2 450 39 373 105 396 114 586 122 731 84 804 M 1586 373 Q 1627 450 1625 586 1608 730 1541 804 1503 731 1511 586 1520 396 1586 373";
    ctx.fillStyle = tocolor(ctrans.apply([0, 0, 0, 1]));
    drawPath(ctx, pathData, false);
    ctx.fill("evenodd");
    var pathData =
        "M 1339 391 Q 1299 348 1256 312 1066 157 806 141 511 142 370 289 324 336 294 399 355 631 283 906 200 944 184 870 125 850 84 804 17 730 0 586 -2 450 39 373 72 308 137 284 L 122 244 Q 203 191 243 263 282 215 324 177 475 35 651 16 1000 -53 1277 171 1329 213 1379 266 1422 191 1503 244 L 1488 284 Q 1553 308 1586 373 1627 450 1625 586 1608 730 1541 804 1500 850 1441 870 1425 944 1342 906 1270 631 1331 399 M 1379 266 L 1383 270 Q 1380 325 1339 391 M 1256 312 Q 1294 248 1267 183 M 1586 373 Q 1520 396 1511 586 1503 731 1541 804 M 1441 870 Q 1391 558 1488 284 M 294 399 Q 236 344 243 263 M 324 177 Q 306 240 370 289 M 39 373 Q 105 396 114 586 122 731 84 804 M 137 284 Q 234 558 184 870";
    var scaleMode = "NORMAL";
    ctx.strokeStyle = tocolor(ctrans.apply([0, 0, 0, 1]));
    ctx.lineWidth = 1.8;
    ctx.lineCap = "round";
    ctx.lineJoin = "round";
    drawPath(ctx, pathData, true, scaleMode);

}

function sprite385(ctx, ctrans, frame, ratio, time) {
    var clips = [];
    var frame_cnt = 1;
    frame = frame % frame_cnt;
    switch (frame) {
        case 0:
            place("sprite383", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 39.0, 0.0], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("shape384", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
            break;
    }
}

function shape386(ctx, ctrans, frame, ratio, time) {
    var pathData = "M 1 4 L 116 0 Q 125 49 156 83 78 108 56 155 -5 108 1 4";
    ctx.fillStyle = tocolor(ctrans.apply([255, 51, 0, 1]));
    drawPath(ctx, pathData, false);
    ctx.fill("evenodd");
}

function sprite387(ctx, ctrans, frame, ratio, time) {
    var clips = [];
    var frame_cnt = 1;
    frame = frame % frame_cnt;
    switch (frame) {
        case 0:
            place("shape386", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
            break;
    }
}

function shape388(ctx, ctrans, frame, ratio, time) {
    var pathData = "M 85 151 L 81 159 Q 71 186 77 218 L 59 207 Q -18 125 5 3 L 5 2 30 0 Q 24 104 85 151";
    ctx.fillStyle = tocolor(ctrans.apply([102, 102, 0, 1]));
    drawPath(ctx, pathData, false);
    ctx.fill("evenodd");
}

function sprite389(ctx, ctrans, frame, ratio, time) {
    var clips = [];
    var frame_cnt = 1;
    frame = frame % frame_cnt;
    switch (frame) {
        case 0:
            place("shape388", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
            break;
    }
}

function sprite390(ctx, ctrans, frame, ratio, time) {
    var clips = [];
    var frame_cnt = 1;
    frame = frame % frame_cnt;
    switch (frame) {
        case 0:
            place("sprite389", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, (0 + time) % 1, 0, time);
            break;
    }
}

function shape391(ctx, ctrans, frame, ratio, time) {
    var pathData = "M 2 139 Q -4 107 6 80 L 10 72 Q 32 25 110 0 L 115 5 Q 171 80 124 133 65 173 2 139";
    ctx.fillStyle = tocolor(ctrans.apply([153, 102, 51, 1]));
    drawPath(ctx, pathData, false);
    ctx.fill("evenodd");
}

function sprite392(ctx, ctrans, frame, ratio, time) {
    var clips = [];
    var frame_cnt = 1;
    frame = frame % frame_cnt;
    switch (frame) {
        case 0:
            place("shape391", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
            break;
    }
}

function shape393(ctx, ctrans, frame, ratio, time) {
    var pathData = "M -61 -68 L -86 -66 -85 -72 -60 -81 -61 -68";
    ctx.fillStyle = tocolor(ctrans.apply([102, 102, 0, 1]));
    drawPath(ctx, pathData, false);
    ctx.fill("evenodd");
    var pathData =
        "M -86 -66 L -61 -68 M -86 -66 L -86 -65 Q -109 57 -32 139 L -14 150 Q -20 118 -10 91 L -6 83 Q 16 36 94 11 63 -23 54 -72 L -61 -68 M 94 11 L 99 16 Q 155 91 108 144 49 184 -14 150";
    var scaleMode = "NORMAL";
    ctx.strokeStyle = tocolor(ctrans.apply([0, 0, 0, 1]));
    ctx.lineWidth = 1.8;
    ctx.lineCap = "round";
    ctx.lineJoin = "round";
    drawPath(ctx, pathData, true, scaleMode);

}

function sprite394(ctx, ctrans, frame, ratio, time) {
    var clips = [];
    var frame_cnt = 1;
    frame = frame % frame_cnt;
    switch (frame) {
        case 0:
            place("sprite387", canvas, ctx, [1.0, 0.0, 0.0, 1.0, -62.0, -72.0], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite390", canvas, ctx, [1.0, 0.0, 0.0, 1.0, -91.0, -68.0], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite392", canvas, ctx, [1.0, 0.0, 0.0, 1.0, -16.0, 11.0], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("shape393", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
            break;
    }
}

function shape395(ctx, ctrans, frame, ratio, time) {
    var pathData = "M 85 244 L 81 252 Q 71 279 77 311 L 59 300 Q -46 188 35 0 L 40 2 44 3 Q 0 178 85 244";
    ctx.fillStyle = tocolor(ctrans.apply([102, 102, 0, 1]));
    drawPath(ctx, pathData, false);
    ctx.fill("evenodd");
}

function sprite396(ctx, ctrans, frame, ratio, time) {
    var clips = [];
    var frame_cnt = 1;
    frame = frame % frame_cnt;
    switch (frame) {
        case 0:
            place("shape395", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
            break;
    }
}

function sprite397(ctx, ctrans, frame, ratio, time) {
    var clips = [];
    var frame_cnt = 1;
    frame = frame % frame_cnt;
    switch (frame) {
        case 0:
            place("shape391", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
            break;
    }
}

function shape398(ctx, ctrans, frame, ratio, time) {
    var pathData = "M 56 249 Q -29 183 15 8 L 114 0 Q 99 115 156 177 78 202 56 249";
    ctx.fillStyle = tocolor(ctrans.apply([255, 51, 0, 1]));
    drawPath(ctx, pathData, false);
    ctx.fill("evenodd");
}

function sprite399(ctx, ctrans, frame, ratio, time) {
    var clips = [];
    var frame_cnt = 1;
    frame = frame % frame_cnt;
    switch (frame) {
        case 0:
            place("shape398", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
            break;
    }
}

function shape400(ctx, ctrans, frame, ratio, time) {
    var pathData =
        "M -56 -161 Q -137 27 -32 139 L -14 150 Q -20 118 -10 91 L -6 83 Q 16 36 94 11 37 -51 52 -166 L -47 -158 M 94 11 L 99 16 Q 155 91 108 144 49 184 -14 150";
    var scaleMode = "NORMAL";
    ctx.strokeStyle = tocolor(ctrans.apply([0, 0, 0, 1]));
    ctx.lineWidth = 1.8;
    ctx.lineCap = "round";
    ctx.lineJoin = "round";
    drawPath(ctx, pathData, true, scaleMode);

}

function sprite401(ctx, ctrans, frame, ratio, time) {
    var clips = [];
    var frame_cnt = 1;
    frame = frame % frame_cnt;
    switch (frame) {
        case 0:
            place("sprite396", canvas, ctx, [1.0, 0.0, 0.0, 1.0, -91.0, -161.0], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite397", canvas, ctx, [1.0, 0.0, 0.0, 1.0, -16.0, 11.0], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite399", canvas, ctx, [1.0, 0.0, 0.0, 1.0, -62.0, -166.0], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("shape400", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
            break;
    }
}

function shape402(ctx, ctrans, frame, ratio, time) {
    var pathData = "M -185 -522 L -195 -543 -209 -561 -212 -566 -221 -573 Q -271 -617 -355 -596";
    var scaleMode = "NORMAL";
    ctx.strokeStyle = tocolor(ctrans.apply([0, 0, 0, 1]));
    ctx.lineWidth = 1.8;
    ctx.lineCap = "round";
    ctx.lineJoin = "round";
    drawPath(ctx, pathData, true, scaleMode);

}

function shape403(ctx, ctrans, frame, ratio, time) {
    var pathData = "M 90 -550 L 98 -560 118 -582 122 -586 130 -595 Q 185 -642 260 -642";
    var scaleMode = "NORMAL";
    ctx.strokeStyle = tocolor(ctrans.apply([0, 0, 0, 1]));
    ctx.lineWidth = 1.8;
    ctx.lineCap = "round";
    ctx.lineJoin = "round";
    drawPath(ctx, pathData, true, scaleMode);

}

function shape404(ctx, ctrans, frame, ratio, time) {
    var pathData =
        "M 601 79 L 609 75 Q 549 108 487 125 L 578 24 601 79 M 468 130 Q 397 147 327 152 L 138 143 Q 127 79 162 4 220 136 326 145 L 464 0 468 130 M 16 20 L 124 140 Q 67 129 13 106 L 0 102 16 20";
    ctx.fillStyle = tocolor(ctrans.apply([153, 102, 51, 1]));
    drawPath(ctx, pathData, false);
    ctx.fill("evenodd");
}

function sprite405(ctx, ctrans, frame, ratio, time) {
    var clips = [];
    var frame_cnt = 1;
    frame = frame % frame_cnt;
    switch (frame) {
        case 0:
            place("shape404", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
            break;
    }
}

function shape406(ctx, ctrans, frame, ratio, time) {
    var pathData =
        "M 1268 632 Q 1237 1055 955 1204 L 950 1206 942 1210 919 1155 828 1256 809 1261 805 1131 667 1276 Q 561 1267 503 1135 468 1210 479 1274 L 465 1271 357 1151 341 1233 Q 194 1211 47 1017 -27 719 15 385 129 154 344 63 699 -91 993 129 1190 296 1268 632";
    ctx.fillStyle = tocolor(ctrans.apply([102, 51, 0, 1]));
    drawPath(ctx, pathData, false);
    ctx.fill("evenodd");
}

function sprite407(ctx, ctrans, frame, ratio, time) {
    var clips = [];
    var frame_cnt = 1;
    frame = frame % frame_cnt;
    switch (frame) {
        case 0:
            place("shape406", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
            break;
    }
}

function shape408(ctx, ctrans, frame, ratio, time) {
    var pathData =
        "M 354 1237 Q 408 1260 465 1271 L 357 1151 341 1233 Q 194 1211 47 1017 -27 719 15 385 129 154 344 63 699 -91 993 129 1190 296 1268 632 1237 1055 955 1204 L 950 1206 Q 890 1239 828 1256 L 809 1276 809 1261 668 1283 479 1274 483 1292 465 1271 479 1274 Q 468 1210 503 1135 561 1267 667 1276 L 805 1131 809 1261 828 1256 919 1155 942 1210 950 1206";
    var scaleMode = "NORMAL";
    ctx.strokeStyle = tocolor(ctrans.apply([0, 0, 0, 1]));
    ctx.lineWidth = 1.8;
    ctx.lineCap = "round";
    ctx.lineJoin = "round";
    drawPath(ctx, pathData, true, scaleMode);

}

function sprite409(ctx, ctrans, frame, ratio, time) {
    var clips = [];
    var frame_cnt = 1;
    frame = frame % frame_cnt;
    switch (frame) {
        case 0:
            place("sprite405", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 341.0, 1131.0], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite407", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape408", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
            break;
    }
}

function shape410(ctx, ctrans, frame, ratio, time) {
    var pathData =
        "M 1265 371 L 283 362 Q 285 276 272 195 L 363 177 Q 861 87 1213 216 L 1270 238 Q 1262 303 1265 371 M 1472 302 Q 1464 447 1502 520 1461 566 1402 586 1352 274 1449 0 1514 24 1547 89 1481 112 1472 302 M 145 586 Q 86 566 45 520 83 447 75 302 66 112 0 89 33 24 98 0 195 274 145 586";
    ctx.fillStyle = tocolor(ctrans.apply([0, 51, 51, 1]));
    drawPath(ctx, pathData, false);
    ctx.fill("evenodd");
}

function sprite411(ctx, ctrans, frame, ratio, time) {
    var clips = [];
    var frame_cnt = 1;
    frame = frame % frame_cnt;
    switch (frame) {
        case 0:
            place("shape410", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
            break;
    }
}

function shape412(ctx, ctrans, frame, ratio, time) {
    var pathData =
        "M 1441 648 Q 1425 722 1342 684 1308 554 1304 433 1301 365 1309 300 1315 237 1331 177 1352 105 1379 44 1422 -31 1503 22 L 1488 62 Q 1391 336 1441 648 M 322 424 Q 318 549 283 684 200 722 184 648 234 336 137 62 L 122 22 Q 203 -31 243 41 281 107 294 177 L 311 257 Q 324 338 322 424";
    ctx.fillStyle = tocolor(ctrans.apply([51, 51, 51, 1]));
    drawPath(ctx, pathData, false);
    ctx.fill("evenodd");
    var pathData =
        "M 1586 151 Q 1627 228 1625 364 1608 508 1541 582 1503 509 1511 364 1520 174 1586 151 M 84 582 Q 17 508 0 364 -2 228 39 151 105 174 114 364 122 509 84 582";
    ctx.fillStyle = tocolor(ctrans.apply([0, 0, 0, 1]));
    drawPath(ctx, pathData, false);
    ctx.fill("evenodd");
    var pathData =
        "M 1488 62 Q 1553 86 1586 151 1627 228 1625 364 1608 508 1541 582 1500 628 1441 648 1425 722 1342 684 1308 554 1304 433 L 1239 433 401 425 322 424 Q 318 549 283 684 200 722 184 648 125 628 84 582 17 508 0 364 -2 228 39 151 72 86 137 62 L 122 22 Q 203 -31 243 41 281 107 294 177 L 311 257 402 239 Q 900 149 1252 278 L 1309 300 Q 1315 237 1331 177 1352 105 1379 44 1422 -31 1503 22 L 1488 62 Q 1391 336 1441 648 M 1309 300 Q 1301 365 1304 433 M 1252 278 L 1239 433 M 1586 151 Q 1520 174 1511 364 1503 509 1541 582 M 322 424 Q 324 338 311 257 M 39 151 Q 105 174 114 364 122 509 84 582 M 401 425 L 402 239 M 137 62 Q 234 336 184 648";
    var scaleMode = "NORMAL";
    ctx.strokeStyle = tocolor(ctrans.apply([0, 0, 0, 1]));
    ctx.lineWidth = 1.8;
    ctx.lineCap = "round";
    ctx.lineJoin = "round";
    drawPath(ctx, pathData, true, scaleMode);

}

function sprite413(ctx, ctrans, frame, ratio, time) {
    var clips = [];
    var frame_cnt = 1;
    frame = frame % frame_cnt;
    switch (frame) {
        case 0:
            place("sprite411", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 39.0, 62.0], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("shape412", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
            break;
    }
}

function shape414(ctx, ctrans, frame, ratio, time) {
    var pathData = "M -137 -616 L -149 -643 -173 -675 -203 -697 Q -245 -717 -305 -706";
    var scaleMode = "NORMAL";
    ctx.strokeStyle = tocolor(ctrans.apply([0, 0, 0, 1]));
    ctx.lineWidth = 1.8;
    ctx.lineCap = "round";
    ctx.lineJoin = "round";
    drawPath(ctx, pathData, true, scaleMode);

}

function shape415(ctx, ctrans, frame, ratio, time) {
    var pathData = "M 136 -633 L 145 -643 179 -675 215 -697 Q 259 -717 311 -714";
    var scaleMode = "NORMAL";
    ctx.strokeStyle = tocolor(ctrans.apply([0, 0, 0, 1]));
    ctx.lineWidth = 1.8;
    ctx.lineCap = "round";
    ctx.lineJoin = "round";
    drawPath(ctx, pathData, true, scaleMode);

}

function shape416(ctx, ctrans, frame, ratio, time) {
    var pathData =
        "M 1174 473 Q 1190 674 1126 890 957 1124 626 1101 297 1134 74 887 -39 763 21 575 L 66 251 312 0 749 0 1059 159 1174 473";
    ctx.fillStyle = tocolor(ctrans.apply([153, 102, 51, 1]));
    drawPath(ctx, pathData, false);
    ctx.fill("evenodd");
}

function sprite417(ctx, ctrans, frame, ratio, time) {
    var clips = [];
    var frame_cnt = 1;
    frame = frame % frame_cnt;
    switch (frame) {
        case 0:
            place("shape416", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
            break;
    }
}

function shape418(ctx, ctrans, frame, ratio, time) {
    var pathData =
        "M 1174 473 Q 1190 674 1126 890 957 1124 626 1101 297 1134 74 887 -39 763 21 575 L 66 251 312 0 749 0 1059 159 1174 473 Z";
    var scaleMode = "NORMAL";
    ctx.strokeStyle = tocolor(ctrans.apply([0, 0, 0, 1]));
    ctx.lineWidth = 1.8;
    ctx.lineCap = "round";
    ctx.lineJoin = "round";
    drawPath(ctx, pathData, true, scaleMode);

}

function sprite419(ctx, ctrans, frame, ratio, time) {
    var clips = [];
    var frame_cnt = 1;
    frame = frame % frame_cnt;
    switch (frame) {
        case 0:
            place("sprite417", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape418", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
            break;
    }
}

function shape420(ctx, ctrans, frame, ratio, time) {
    var pathData = "M 421 -2040 Q 267 -2218 189 -2040";
    var scaleMode = "NORMAL";
    ctx.strokeStyle = tocolor(ctrans.apply([0, 0, 0, 1]));
    ctx.lineWidth = 1.8;
    ctx.lineCap = "round";
    ctx.lineJoin = "round";
    drawPath(ctx, pathData, true, scaleMode);

}

function shape421(ctx, ctrans, frame, ratio, time) {
    var pathData = "M 120 -1118 Q 274 -1296 352 -1118";
    var scaleMode = "NORMAL";
    ctx.strokeStyle = tocolor(ctrans.apply([0, 0, 0, 1]));
    ctx.lineWidth = 1.8;
    ctx.lineCap = "round";
    ctx.lineJoin = "round";
    drawPath(ctx, pathData, true, scaleMode);

}

function shape422(ctx, ctrans, frame, ratio, time) {
    var pathData =
        "M 1046 733 L 1127 561 997 578 1049 373 868 487 712 279 634 490 423 289 365 484 173 380 277 607 Q 186 609 95 506 L 173 763 27 763 Q -10 669 4 548 77 66 589 0 1118 2 1182 561 1205 724 1046 733";
    ctx.fillStyle = tocolor(ctrans.apply([102, 51, 0, 1]));
    drawPath(ctx, pathData, false);
    ctx.fill("evenodd");
}

function sprite423(ctx, ctrans, frame, ratio, time) {
    var clips = [];
    var frame_cnt = 1;
    frame = frame % frame_cnt;
    switch (frame) {
        case 0:
            place("shape422", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
            break;
    }
}

function shape424(ctx, ctrans, frame, ratio, time) {
    var pathData =
        "M 1046 733 L 1127 561 997 578 1049 373 868 487 712 279 634 490 423 289 365 484 173 380 277 607 Q 186 609 95 506 L 173 763 27 763 Q -10 669 4 548 77 66 589 0 1118 2 1182 561 1205 724 1046 733 Z";
    var scaleMode = "NORMAL";
    ctx.strokeStyle = tocolor(ctrans.apply([0, 0, 0, 1]));
    ctx.lineWidth = 1.8;
    ctx.lineCap = "round";
    ctx.lineJoin = "round";
    drawPath(ctx, pathData, true, scaleMode);

}

function sprite425(ctx, ctrans, frame, ratio, time) {
    var clips = [];
    var frame_cnt = 1;
    frame = frame % frame_cnt;
    switch (frame) {
        case 0:
            place("sprite423", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape424", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
            break;
    }
}

function shape426(ctx, ctrans, frame, ratio, time) {
    var pathData =
        "M 1481 921 Q 1450 943 1412 955 1322 939 1336 686 1346 519 1432 443 1488 458 1526 490 1430 716 1481 921 M 1182 0 Q 1362 134 1396 422 1364 407 1338 414 1308 187 1182 0 M 363 24 Q 222 215 187 447 161 441 131 455 169 154 363 24 M 45 954 Q 96 749 0 523 38 491 94 476 180 552 190 719 204 972 114 988 76 976 45 954";
    ctx.fillStyle = tocolor(ctrans.apply([0, 51, 51, 1]));
    drawPath(ctx, pathData, false);
    ctx.fill("evenodd");
}

function sprite427(ctx, ctrans, frame, ratio, time) {
    var clips = [];
    var frame_cnt = 1;
    frame = frame % frame_cnt;
    switch (frame) {
        case 0:
            place("shape426", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
            break;
    }
}

function shape428(ctx, ctrans, frame, ratio, time) {
    var pathData =
        "M 1394 490 Q 1420 483 1452 498 L 1488 519 Q 1402 595 1392 762 1378 1015 1468 1031 1427 1111 1375 1078 1311 1036 1298 921 1283 788 1304 654 1329 506 1394 490 M 246 795 Q 236 628 150 552 169 538 187 531 217 517 243 523 308 538 334 687 355 821 340 954 327 1069 263 1111 211 1144 170 1064 260 1048 246 795";
    ctx.fillStyle = tocolor(ctrans.apply([51, 51, 51, 1]));
    drawPath(ctx, pathData, false);
    ctx.fill("evenodd");
    var pathData =
        "M 101 1030 Q 15 970 -17 838 -29 673 56 599 152 825 101 1030 M 1537 997 Q 1486 792 1582 566 1667 640 1655 805 1623 937 1537 997";
    ctx.fillStyle = tocolor(ctrans.apply([0, 0, 0, 1]));
    drawPath(ctx, pathData, false);
    ctx.fill("evenodd");
    var pathData =
        "M 1394 490 Q 1420 483 1452 498 1418 210 1238 76 1364 263 1394 490 1329 506 1304 654 1283 788 1298 921 1311 1036 1375 1078 1427 1111 1468 1031 1378 1015 1392 762 1402 595 1488 519 L 1452 498 M 1582 566 Q 1544 534 1488 519 M 246 795 Q 260 1048 170 1064 211 1144 263 1111 327 1069 340 954 355 821 334 687 308 538 243 523 217 517 187 531 169 538 150 552 236 628 246 795 M 187 531 Q 225 230 419 100 278 291 243 523 M 56 599 Q 94 567 150 552 M 170 1064 Q 132 1052 101 1030 15 970 -17 838 -29 673 56 599 152 825 101 1030 M 1468 1031 Q 1506 1019 1537 997 1486 792 1582 566 1667 640 1655 805 1623 937 1537 997";
    var scaleMode = "NORMAL";
    ctx.strokeStyle = tocolor(ctrans.apply([0, 0, 0, 1]));
    ctx.lineWidth = 1.8;
    ctx.lineCap = "round";
    ctx.lineJoin = "round";
    drawPath(ctx, pathData, true, scaleMode);

}

function sprite429(ctx, ctrans, frame, ratio, time) {
    var clips = [];
    var frame_cnt = 1;
    frame = frame % frame_cnt;
    switch (frame) {
        case 0:
            place("sprite427", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 56.0, 76.0], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("shape428", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
            break;
    }
}

function shape430(ctx, ctrans, frame, ratio, time) {
    var pathData =
        "M 61 -959 Q 61 -947 52 -938 43 -929 31 -929 19 -929 10 -938 1 -947 1 -959 1 -971 10 -980 19 -989 31 -989 43 -989 52 -980 61 -971 61 -959";
    ctx.fillStyle = tocolor(ctrans.apply([0, 0, 0, 1]));
    drawPath(ctx, pathData, false);
    ctx.fill("evenodd");
}

function morphshape431(ctx, ctrans, frame, ratio, time) {
    var pathData = "M -291 -291 -1140 -2040 Q -213 -213 -1318 -2218 -59 -59 -1140 -2040";
    var scaleMode = "NORMAL";
    ctx.strokeStyle = tocolor(ctrans.apply([Math.round(0 + ratio * (0) / 65535), Math.round(0 + ratio * (0) /
        65535), Math.round(0 + ratio * (1) / 65535), ((Math.round(255 + ratio * (0) / 65535)) /
        255)]));
    ctx.lineWidth = 1.8 + ratio * (0) / 65535;
    ctx.lineCap = "round";
    ctx.lineJoin = "round";
    drawMorphPath(ctx, pathData, ratio, true, scaleMode);

}

function morphshape432(ctx, ctrans, frame, ratio, time) {
    var pathData = "M 189 189 -1140 -2040 Q 267 267 -1318 -2218 421 421 -1140 -2040";
    var scaleMode = "NORMAL";
    ctx.strokeStyle = tocolor(ctrans.apply([Math.round(0 + ratio * (0) / 65535), Math.round(0 + ratio * (0) /
        65535), Math.round(0 + ratio * (1) / 65535), ((Math.round(255 + ratio * (0) / 65535)) /
        255)]));
    ctx.lineWidth = 1.8 + ratio * (0) / 65535;
    ctx.lineCap = "round";
    ctx.lineJoin = "round";
    drawMorphPath(ctx, pathData, ratio, true, scaleMode);

}

function morphshape433(ctx, ctrans, frame, ratio, time) {
    var pathData =
        "M 1 -95 -981 -1874 L 1 -95 -977 -1874 Q 2 -97 -970 -1842 6 -79 -964 -1822 8 -70 -962 -1811 10 -54 -960 -1803 L 10 -52 -960 -1801 Q 19 -6 -951 -1768 31 45 -951 -1764 42 79 -951 -1768 50 112 -958 -1772 L 52 122 -960 -1773 Q 55 140 -964 -1778 58 154 -967 -1794 60 169 -973 -1811 61 180 -979 -1838 L 61 183 -981 -1845 Q 59 194 -988 -1874 58 176 -994 -1889 L 52 148 -1002 -1891 43 100 -1008 -1884 31 45 -1011 -1882 Q 24 18 -1009 -1885 17 -6 -1007 -1896 L 10 -30 -1002 -1909 6 -54 -997 -1921 Q 3 -89 -989 -1934 1 -95 -981 -1874";
    ctx.fillStyle = tocolor(ctrans.apply([Math.round(0 + ratio * (0) / 65535), Math.round(0 + ratio * (0) /
        65535), Math.round(0 + ratio * (1) / 65535), ((Math.round(255 + ratio * (0) / 65535)) /
        255)]));
    drawMorphPath(ctx, pathData, ratio, false);

    ctx.fill("evenodd");
    var pathData =
        "M 1 -95 -981 -1874 Q 3 -89 -989 -1934 6 -54 -997 -1921 L 10 -30 -1002 -1909 17 -6 -1007 -1896 Q 24 18 -1009 -1885 31 45 -1011 -1882 L 43 100 -1008 -1884 52 148 -1002 -1891 58 176 -994 -1889 Q 59 194 -988 -1874 61 183 -981 -1845 L 61 180 -979 -1838 Q 60 169 -973 -1811 58 154 -967 -1794 55 140 -964 -1778 52 122 -960 -1773 L 50 112 -958 -1772 Q 42 79 -951 -1768 31 45 -951 -1764 19 -6 -951 -1768 10 -52 -960 -1801 L 10 -54 -960 -1803 Q 8 -70 -962 -1811 6 -79 -964 -1822 2 -97 -970 -1842 1 -95 -977 -1874 L 1 -95 -981 -1874";
    var scaleMode = "NORMAL";
    ctx.strokeStyle = tocolor(ctrans.apply([Math.round(0 + ratio * (0) / 65535), Math.round(0 + ratio * (0) /
        65535), Math.round(0 + ratio * (1) / 65535), ((Math.round(0 + ratio * (0) / 65535)) /
        255)]));
    ctx.lineWidth = 0.0 + ratio * (0) / 65535;
    ctx.lineCap = "round";
    ctx.lineJoin = "round";
    drawMorphPath(ctx, pathData, ratio, true, scaleMode);

}

function shape434(ctx, ctrans, frame, ratio, time) {
    var pathData =
        "M 180 -1838 Q 169 -1811 154 -1794 136 -1774 112 -1772 22 -1746 -54 -1803 -70 -1811 -79 -1822 -97 -1842 -95 -1874 -89 -1934 -54 -1921 L -6 -1896 Q 42 -1874 100 -1884 L 176 -1889 Q 196 -1872 180 -1838";
    ctx.fillStyle = tocolor(ctrans.apply([0, 0, 0, 1]));
    drawPath(ctx, pathData, false);
    ctx.fill("evenodd");
}

function morphshape435(ctx, ctrans, frame, ratio, time) {
    var pathData = "M -267 -299 -2065 -1426 Q -169 -212 -2233 -1599 -37 -69 -2039 -1413";
    var scaleMode = "NORMAL";
    ctx.strokeStyle = tocolor(ctrans.apply([Math.round(0 + ratio * (0) / 65535), Math.round(0 + ratio * (0) /
        65535), Math.round(0 + ratio * (1) / 65535), ((Math.round(255 + ratio * (0) / 65535)) /
        255)]));
    ctx.lineWidth = 1.8 + ratio * (0) / 65535;
    ctx.lineCap = "round";
    ctx.lineJoin = "round";
    drawMorphPath(ctx, pathData, ratio, true, scaleMode);

}

function morphshape436(ctx, ctrans, frame, ratio, time) {
    var pathData = "M 209 178 -2011 -1400 Q 308 268 -2178 -1572 440 410 -1985 -1386";
    var scaleMode = "NORMAL";
    ctx.strokeStyle = tocolor(ctrans.apply([Math.round(0 + ratio * (0) / 65535), Math.round(0 + ratio * (0) /
        65535), Math.round(0 + ratio * (1) / 65535), ((Math.round(255 + ratio * (0) / 65535)) /
        255)]));
    ctx.lineWidth = 1.8 + ratio * (0) / 65535;
    ctx.lineCap = "round";
    ctx.lineJoin = "round";
    drawMorphPath(ctx, pathData, ratio, true, scaleMode);

}

function morphshape437(ctx, ctrans, frame, ratio, time) {
    var pathData =
        "M -95 -117 -1874 -1245 L -95 -117 -1869 -1245 -95 -117 -1869 -1244 -94 -115 -1855 -1229 Q -91 -112 -1836 -1211 -79 -101 -1822 -1198 L -77 -101 -1820 -1198 -73 -97 -1816 -1193 -73 -96 -1816 -1193 Q -65 -87 -1808 -1186 -54 -79 -1803 -1180 L -54 -79 -1803 -1180 -54 -78 -1803 -1180 -46 -72 -1795 -1176 -44 -70 -1795 -1176 Q 28 4 -1748 -1128 112 85 -1772 -1153 L 116 87 -1772 -1153 127 97 -1775 -1156 Q 142 116 -1780 -1159 154 129 -1794 -1173 L 155 131 -1796 -1175 159 136 -1800 -1180 169 146 -1815 -1196 180 157 -1836 -1218 180 158 -1838 -1220 185 160 -1846 -1226 185 160 -1848 -1228 185 161 -1850 -1229 Q 192 171 -1872 -1255 179 158 -1886 -1270 L 176 156 -1889 -1272 176 152 -1889 -1275 176 151 -1889 -1277 107 82 -1886 -1269 100 76 -1884 -1267 100 76 -1884 -1267 Q 44 26 -1874 -1269 -2 -24 -1894 -1271 L -4 -27 -1896 -1272 -6 -28 -1896 -1272 -8 -32 -1898 -1274 -50 -74 -1919 -1293 -54 -78 -1921 -1295 -56 -80 -1921 -1295 Q -89 -114 -1933 -1304 -95 -117 -1874 -1245";
    ctx.fillStyle = tocolor(ctrans.apply([Math.round(0 + ratio * (0) / 65535), Math.round(0 + ratio * (0) /
        65535), Math.round(0 + ratio * (1) / 65535), ((Math.round(255 + ratio * (0) / 65535)) /
        255)]));
    drawMorphPath(ctx, pathData, ratio, false);

    ctx.fill("evenodd");
    var pathData =
        "M -95 -117 -1874 -1245 Q -89 -114 -1933 -1304 -56 -80 -1921 -1295 L -54 -78 -1921 -1295 -50 -74 -1919 -1293 -8 -32 -1898 -1274 -6 -28 -1896 -1272 -4 -27 -1896 -1272 -2 -24 -1894 -1271 Q 44 26 -1874 -1269 100 76 -1884 -1267 L 100 76 -1884 -1267 107 82 -1886 -1269 176 151 -1889 -1277 176 152 -1889 -1275 176 156 -1889 -1272 179 158 -1886 -1270 Q 192 171 -1872 -1255 185 161 -1850 -1229 L 185 160 -1848 -1228 185 160 -1846 -1226 180 158 -1838 -1220 180 157 -1836 -1218 169 146 -1815 -1196 159 136 -1800 -1180 155 131 -1796 -1175 154 129 -1794 -1173 Q 142 116 -1780 -1159 127 97 -1775 -1156 L 116 87 -1772 -1153 112 85 -1772 -1153 Q 28 4 -1748 -1128 -44 -70 -1795 -1176 L -46 -72 -1795 -1176 -54 -78 -1803 -1180 -54 -79 -1803 -1180 -54 -79 -1803 -1180 Q -65 -87 -1808 -1186 -73 -96 -1816 -1193 L -73 -97 -1816 -1193 -77 -101 -1820 -1198 -79 -101 -1822 -1198 Q -91 -112 -1836 -1211 -94 -115 -1855 -1229 L -95 -117 -1869 -1244 -95 -117 -1869 -1245 -95 -117 -1874 -1245";
    var scaleMode = "NORMAL";
    ctx.strokeStyle = tocolor(ctrans.apply([Math.round(0 + ratio * (0) / 65535), Math.round(0 + ratio * (0) /
        65535), Math.round(0 + ratio * (1) / 65535), ((Math.round(0 + ratio * (0) / 65535)) /
        255)]));
    ctx.lineWidth = 0.0 + ratio * (0) / 65535;
    ctx.lineCap = "round";
    ctx.lineJoin = "round";
    drawMorphPath(ctx, pathData, ratio, true, scaleMode);

}

function shape438(ctx, ctrans, frame, ratio, time) {
    var pathData = "M -299 -1426 Q -212 -1599 -69 -1413";
    var scaleMode = "NORMAL";
    ctx.strokeStyle = tocolor(ctrans.apply([0, 0, 0, 1]));
    ctx.lineWidth = 1.8;
    ctx.lineCap = "round";
    ctx.lineJoin = "round";
    drawPath(ctx, pathData, true, scaleMode);

}

function shape439(ctx, ctrans, frame, ratio, time) {
    var pathData = "M 178 -1400 Q 268 -1572 410 -1386";
    var scaleMode = "NORMAL";
    ctx.strokeStyle = tocolor(ctrans.apply([0, 0, 0, 1]));
    ctx.lineWidth = 1.8;
    ctx.lineCap = "round";
    ctx.lineJoin = "round";
    drawPath(ctx, pathData, true, scaleMode);

}

function shape440(ctx, ctrans, frame, ratio, time) {
    var pathData =
        "M 152 -1275 L 158 -1270 Q 171 -1255 161 -1229 L 160 -1228 160 -1226 157 -1218 146 -1196 136 -1180 131 -1175 Q 117 -1159 97 -1156 L 87 -1153 Q 5 -1127 -70 -1176 L -72 -1176 -78 -1180 -79 -1180 -96 -1193 -97 -1193 -101 -1198 Q -112 -1211 -115 -1229 L -117 -1244 -117 -1245 Q -114 -1304 -80 -1295 L -78 -1295 -74 -1293 -32 -1274 -27 -1272 -24 -1271 76 -1267 82 -1269 151 -1277 152 -1275";
    ctx.fillStyle = tocolor(ctrans.apply([0, 0, 0, 1]));
    drawPath(ctx, pathData, false);
    ctx.fill("evenodd");
}

function shape441(ctx, ctrans, frame, ratio, time) {
    var pathData = "M -338 -1251 Q -254 -1426 -108 -1243";
    var scaleMode = "NORMAL";
    ctx.strokeStyle = tocolor(ctrans.apply([0, 0, 0, 1]));
    ctx.lineWidth = 1.8;
    ctx.lineCap = "round";
    ctx.lineJoin = "round";
    drawPath(ctx, pathData, true, scaleMode);

}

function shape442(ctx, ctrans, frame, ratio, time) {
    var pathData = "M 139 -1234 Q 226 -1408 372 -1225";
    var scaleMode = "NORMAL";
    ctx.strokeStyle = tocolor(ctrans.apply([0, 0, 0, 1]));
    ctx.lineWidth = 1.8;
    ctx.lineCap = "round";
    ctx.lineJoin = "round";
    drawPath(ctx, pathData, true, scaleMode);

}

function shape443(ctx, ctrans, frame, ratio, time) {
    var pathData =
        "M 123 -1055 L 122 -1053 112 -1030 102 -1014 98 -1009 Q 84 -992 64 -989 L 54 -985 Q -28 -958 -104 -1005 L -112 -1009 -113 -1010 -131 -1022 -136 -1027 -150 -1055 -153 -1074 Q -151 -1133 -116 -1125 L -110 -1123 -68 -1104 -60 -1101 Q -13 -1086 40 -1099 L 46 -1101 Q 94 -1114 114 -1111 L 122 -1105 Q 135 -1090 125 -1061 L 123 -1055";
    ctx.fillStyle = tocolor(ctrans.apply([0, 0, 0, 1]));
    drawPath(ctx, pathData, false);
    ctx.fill("evenodd");
}

function morphshape444(ctx, ctrans, frame, ratio, time) {
    var pathData =
        "M -347 -305 -590 -706 Q -287 -245 -608 -717 -244 -203 -591 -697 L -210 -173 -571 -675 -185 -149 -544 -643 -171 -137 -519 -616";
    var scaleMode = "NORMAL";
    ctx.strokeStyle = tocolor(ctrans.apply([Math.round(0 + ratio * (0) / 65535), Math.round(0 + ratio * (0) /
        65535), Math.round(0 + ratio * (1) / 65535), ((Math.round(255 + ratio * (0) / 65535)) /
        255)]));
    ctx.lineWidth = 1.8 + ratio * (0) / 65535;
    ctx.lineCap = "round";
    ctx.lineJoin = "round";
    drawMorphPath(ctx, pathData, ratio, true, scaleMode);

}

function morphshape445(ctx, ctrans, frame, ratio, time) {
    var pathData =
        "M 100 136 -564 -633 L 108 145 -575 -643 138 179 -610 -675 168 215 -634 -697 Q 211 259 -661 -717 265 311 -662 -714";
    var scaleMode = "NORMAL";
    ctx.strokeStyle = tocolor(ctrans.apply([Math.round(0 + ratio * (0) / 65535), Math.round(0 + ratio * (0) /
        65535), Math.round(0 + ratio * (1) / 65535), ((Math.round(255 + ratio * (0) / 65535)) /
        255)]));
    ctx.lineWidth = 1.8 + ratio * (0) / 65535;
    ctx.lineCap = "round";
    ctx.lineJoin = "round";
    drawMorphPath(ctx, pathData, ratio, true, scaleMode);

}

function sprite446(ctx, ctrans, frame, ratio, time) {
    ctx.save();
    ctx.transform(1, 0, 0, 1, 48.9, 143.45);
    var clips = [];
    var frame_cnt = 102;
    frame = frame % frame_cnt;
    switch (frame) {
        case 0:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -21.9, -38.0], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.049999237060546875, -2.13623046875E-5, -2.13623046875E-5,
                0.049999237060546875, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04984130859375, -0.00331268310546875, 0.00331268310546875,
                0.04984130859375, 3.15, -13.5
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite307", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -27.3, -72.25], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite311", canvas, ctx, [0.0472076416015625, -0.01631927490234375, 0.01631927490234375,
                0.0472076416015625, -18.05, -50.5
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite316", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -17.2, -46.6], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite311", canvas, ctx, [0.0465362548828125, 0.0181304931640625, -0.0181304931640625,
                0.0465362548828125, 5.9, -54.65
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite316", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 4.25, -46.85], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite320", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -29.15, -97.35], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite324", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -41.9, -92.8], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("morphshape325", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -2.7, -35.7], ctrans, 1, 0, 0, time);
            place("sprite333", canvas, ctx, [-0.0435150146484375, 0.023632049560546875, 0.023632049560546875,
                0.0435150146484375, 17.15, -23.65
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite335", canvas, ctx, [0.04943389892578125, 0.001647186279296875, -0.001647186279296875,
                0.04943389892578125, -16.3, -31.6
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite339", canvas, ctx, [0.02134246826171875, 0.04508056640625, -0.045079803466796874,
                0.021343231201171875, 24.3, -25.7
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite347", canvas, ctx, [-0.04101409912109375, -0.028243255615234376, -0.028243255615234376,
                0.04101409912109375, -1.15, -24.85
            ], ctrans, 1, (0 + time) % 1, 0, time);
            break;
        case 1:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.049997711181640626, 2.349853515625E-4, -2.349853515625E-4,
                0.049997711181640626, -22.0, -37.75
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.049715423583984376, 0.00501861572265625, -0.00501861572265625,
                0.049715423583984376, 6.7, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.049715423583984376, 0.00501861572265625, -0.00501861572265625,
                0.049715423583984376, -6.75, -8.35
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.04999847412109375, -5.340576171875E-6, -5.340576171875E-6,
                0.04999847412109375, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.049832916259765624, -0.003278350830078125, 0.003278350830078125,
                0.049832916259765624, 3.1, -13.45
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite307", canvas, ctx, [0.049997711181640626, 2.349853515625E-4, -2.349853515625E-4,
                0.049997711181640626, -27.2, -71.95
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite311", canvas, ctx, [0.047296905517578126, -0.015898895263671876, 0.015898895263671876,
                0.047296905517578126, -18.05, -50.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite316", canvas, ctx, [0.049997711181640626, 2.349853515625E-4, -2.349853515625E-4,
                0.049997711181640626, -17.3, -46.35
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite311", canvas, ctx, [0.04639739990234375, 0.018326568603515624, -0.018326568603515624,
                0.04639739990234375, 5.9, -54.2
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite316", canvas, ctx, [0.049997711181640626, 2.349853515625E-4, -2.349853515625E-4,
                0.049997711181640626, 4.15, -46.5
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite320", canvas, ctx, [0.049997711181640626, 2.349853515625E-4, -2.349853515625E-4,
                0.049997711181640626, -29.0, -97.15
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite324", canvas, ctx, [0.049997711181640626, 2.349853515625E-4, -2.349853515625E-4,
                0.049997711181640626, -41.75, -92.65
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("morphshape325", canvas, ctx, [0.049997711181640626, 2.349853515625E-4, -2.349853515625E-4,
                0.049997711181640626, -2.85, -35.35
            ], ctrans, 1, 0, 13107, time);
            place("sprite333", canvas, ctx, [-0.043437957763671875, 0.02362823486328125, 0.02362823486328125,
                0.043437957763671875, 17.25, -23.45
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite335", canvas, ctx, [0.0494537353515625, 4.364013671875E-4, -4.364013671875E-4,
                0.0494537353515625, -16.6, -30.9
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite339", canvas, ctx, [0.021292877197265626, 0.04503326416015625, -0.04503326416015625,
                0.02129364013671875, 24.15, -25.9
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite347", canvas, ctx, [-0.03934402465820312, -0.030307769775390625, -0.030307769775390625,
                0.03934402465820312, -1.15, -24.2
            ], ctrans, 1, (0 + time) % 1, 0, time);
            break;
        case 2:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.04999465942382812, 4.69970703125E-4, -4.69970703125E-4,
                0.04999465942382812, -22.2, -37.5
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.049715423583984376, 0.00501861572265625, -0.00501861572265625,
                0.049715423583984376, 6.7, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.049715423583984376, 0.00501861572265625, -0.00501861572265625,
                0.049715423583984376, -6.75, -8.35
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.04999847412109375, -5.340576171875E-6, -5.340576171875E-6,
                0.04999847412109375, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.049832916259765624, -0.003278350830078125, 0.003278350830078125,
                0.049832916259765624, 3.1, -13.45
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite307", canvas, ctx, [0.04999465942382812, 4.69970703125E-4, -4.69970703125E-4,
                0.04999465942382812, -27.1, -71.65
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite311", canvas, ctx, [0.0473724365234375, -0.0156768798828125, 0.0156768798828125,
                0.0473724365234375, -18.1, -50.1
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite316", canvas, ctx, [0.04999465942382812, 4.69970703125E-4, -4.69970703125E-4,
                0.04999465942382812, -17.4, -46.1
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite311", canvas, ctx, [0.04630966186523437, 0.01854400634765625, -0.01854400634765625,
                0.04630966186523437, 5.85, -53.75
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite316", canvas, ctx, [0.04999465942382812, 4.69970703125E-4, -4.69970703125E-4,
                0.04999465942382812, 4.1, -46.1
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite320", canvas, ctx, [0.04999465942382812, 4.69970703125E-4, -4.69970703125E-4,
                0.04999465942382812, -28.8, -96.9
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite324", canvas, ctx, [0.04999465942382812, 4.69970703125E-4, -4.69970703125E-4,
                0.04999465942382812, -41.65, -92.5
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("morphshape325", canvas, ctx, [0.04999465942382812, 4.69970703125E-4, -4.69970703125E-4,
                0.04999465942382812, -3.0, -35.05
            ], ctrans, 1, 0, 26214, time);
            place("sprite333", canvas, ctx, [-0.043437957763671875, 0.02362823486328125, 0.02362823486328125,
                0.043437957763671875, 17.25, -23.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite335", canvas, ctx, [0.04944610595703125, -6.7138671875E-4, 6.7138671875E-4,
                0.04944610595703125, -16.95, -30.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite339", canvas, ctx, [0.021292877197265626, 0.04503326416015625, -0.04503326416015625,
                0.02129364013671875, 23.95, -26.15
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite347", canvas, ctx, [-0.0376434326171875, -0.03231124877929688, -0.03231124877929688,
                0.0376434326171875, -1.15, -23.5
            ], ctrans, 1, (0 + time) % 1, 0, time);
            break;
        case 3:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.049990081787109376, 7.04193115234375E-4, -7.04193115234375E-4,
                0.049990081787109376, -22.3, -37.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.049715423583984376, 0.00501861572265625, -0.00501861572265625,
                0.049715423583984376, 6.7, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.049715423583984376, 0.00501861572265625, -0.00501861572265625,
                0.049715423583984376, -6.75, -8.35
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.04999847412109375, -5.340576171875E-6, -5.340576171875E-6,
                0.04999847412109375, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.049832916259765624, -0.003278350830078125, 0.003278350830078125,
                0.049832916259765624, 3.1, -13.45
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite307", canvas, ctx, [0.049990081787109376, 7.04193115234375E-4, -7.04193115234375E-4,
                0.049990081787109376, -27.0, -71.35
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite311", canvas, ctx, [0.047444915771484374, -0.0154541015625, 0.0154541015625,
                0.047444915771484374, -18.1, -49.85
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite316", canvas, ctx, [0.049990081787109376, 7.04193115234375E-4, -7.04193115234375E-4,
                0.049990081787109376, -17.5, -45.85
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite311", canvas, ctx, [0.04615859985351563, 0.018914031982421874, -0.018914031982421874,
                0.04615859985351563, 5.85, -53.35
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite316", canvas, ctx, [0.049990081787109376, 7.04193115234375E-4, -7.04193115234375E-4,
                0.049990081787109376, 3.95, -45.75
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite320", canvas, ctx, [0.049990081787109376, 7.04193115234375E-4, -7.04193115234375E-4,
                0.049990081787109376, -28.7, -96.7
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite324", canvas, ctx, [0.049990081787109376, 7.04193115234375E-4, -7.04193115234375E-4,
                0.049990081787109376, -41.5, -92.35
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("morphshape325", canvas, ctx, [0.049990081787109376, 7.04193115234375E-4, -
                7.04193115234375E-4, 0.049990081787109376, -3.2, -34.75
            ], ctrans, 1, 0, 39322, time);
            place("sprite333", canvas, ctx, [-0.043437957763671875, 0.02362823486328125, 0.02362823486328125,
                0.043437957763671875, 17.2, -23.2
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite335", canvas, ctx, [0.049410247802734376, -0.0017791748046875, 0.0017791748046875,
                0.049410247802734376, -17.15, -29.55
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite339", canvas, ctx, [0.021292877197265626, 0.04503326416015625, -0.04503326416015625,
                0.02129364013671875, 23.8, -26.45
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite347", canvas, ctx, [-0.035799407958984376, -0.03438262939453125, -0.03438262939453125,
                0.035799407958984376, -1.05, -22.9
            ], ctrans, 1, (0 + time) % 1, 0, time);
            break;
        case 4:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -22.5, -37.1
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.049999237060546875, -2.13623046875E-5, -2.13623046875E-5,
                0.049999237060546875, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04984130859375, -0.00331268310546875, 0.00331268310546875,
                0.04984130859375, 3.15, -13.5
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite307", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -27.1, -71.5
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite311", canvas, ctx, [0.047563934326171876, -0.01523895263671875, 0.01523895263671875,
                0.047563934326171876, -18.35, -49.5
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite316", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -17.6, -45.6
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite311", canvas, ctx, [0.0461090087890625, 0.01918487548828125, -0.01918487548828125,
                0.0461090087890625, 5.7, -53.15
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite316", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, 3.85, -45.35
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite320", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -28.4, -96.65
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite324", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -41.25, -92.35
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("morphshape325", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -3.35, -34.4
            ], ctrans, 1, 0, 0, time);
            place("sprite333", canvas, ctx, [-0.043437957763671875, 0.02362823486328125, 0.02362823486328125,
                0.043437957763671875, 17.2, -23.05
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite335", canvas, ctx, [0.04934616088867187, -0.0031341552734375, 0.0031341552734375,
                0.04934616088867187, -17.8, -28.85
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite339", canvas, ctx, [0.02134246826171875, 0.04508056640625, -0.045079803466796874,
                0.021343231201171875, 23.6, -26.75
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite355", canvas, ctx, [0.049883270263671876, 5.8746337890625E-4, -5.8746337890625E-4,
                0.049883270263671876, -11.5, -17.1
            ], ctrans, 1, (0 + time) % 1, 4, time);
            break;
        case 5:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -22.85, -37.45
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.049999237060546875, -2.13623046875E-5, -2.13623046875E-5,
                0.049999237060546875, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04984130859375, -0.00331268310546875, 0.00331268310546875,
                0.04984130859375, 3.15, -13.5
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite307", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -27.45, -71.85
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite311", canvas, ctx, [0.047563934326171876, -0.01523895263671875, 0.01523895263671875,
                0.047563934326171876, -18.7, -49.85
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite360", canvas, ctx, [-0.047149658203125, -0.016485595703125, -0.016485595703125,
                0.047149658203125, -5.4, -41.7
            ], ctrans, 1, (0 + time) % 1, 5, time);
            place("sprite311", canvas, ctx, [0.0461090087890625, 0.01918487548828125, -0.01918487548828125,
                0.0461090087890625, 5.35, -53.5
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite360", canvas, ctx, [0.047149658203125, -0.016485595703125, 0.016485595703125,
                0.047149658203125, 3.1, -41.7
            ], ctrans, 1, (0 + time) % 1, 5, time);
            place("sprite320", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -28.75, -97.0
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite324", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -41.6, -92.7
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("morphshape325", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -3.7, -34.75
            ], ctrans, 1, 0, 0, time);
            place("sprite333", canvas, ctx, [-0.0435150146484375, 0.023632049560546875, 0.023632049560546875,
                0.0435150146484375, 17.15, -22.95
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite335", canvas, ctx, [0.049410247802734376, 0.001399993896484375, -0.001399993896484375,
                0.049410247802734376, -16.3, -31.5
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite339", canvas, ctx, [0.02134246826171875, 0.04508056640625, -0.045079803466796874,
                0.021343231201171875, 23.6, -24.65
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite355", canvas, ctx, [0.049883270263671876, 5.8746337890625E-4, -5.8746337890625E-4,
                0.049883270263671876, -11.5, -16.4
            ], ctrans, 1, (0 + time) % 1, 4, time);
            break;
        case 6:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -22.85, -37.45
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.049999237060546875, -2.13623046875E-5, -2.13623046875E-5,
                0.049999237060546875, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04984130859375, -0.00331268310546875, 0.00331268310546875,
                0.04984130859375, 3.15, -13.5
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite307", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -27.45, -71.85
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite311", canvas, ctx, [0.047563934326171876, -0.01523895263671875, 0.01523895263671875,
                0.047563934326171876, -18.7, -49.85
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite360", canvas, ctx, [-0.047149658203125, -0.016485595703125, -0.016485595703125,
                0.047149658203125, -5.4, -41.7
            ], ctrans, 1, (0 + time) % 1, 5, time);
            place("sprite311", canvas, ctx, [0.0461090087890625, 0.01918487548828125, -0.01918487548828125,
                0.0461090087890625, 5.35, -53.5
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite360", canvas, ctx, [0.047149658203125, -0.016485595703125, 0.016485595703125,
                0.047149658203125, 3.1, -41.7
            ], ctrans, 1, (0 + time) % 1, 5, time);
            place("sprite320", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -28.75, -97.0
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite324", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -41.6, -92.7
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("morphshape325", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -3.7, -34.75
            ], ctrans, 1, 0, 0, time);
            place("sprite333", canvas, ctx, [-0.0435150146484375, 0.023632049560546875, 0.023632049560546875,
                0.0435150146484375, 17.15, -22.95
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite335", canvas, ctx, [0.049410247802734376, 0.001399993896484375, -0.001399993896484375,
                0.049410247802734376, -16.3, -31.5
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite339", canvas, ctx, [0.02134246826171875, 0.04508056640625, -0.045079803466796874,
                0.021343231201171875, 23.6, -24.65
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite355", canvas, ctx, [0.049883270263671876, 5.8746337890625E-4, -5.8746337890625E-4,
                0.049883270263671876, -11.5, -16.4
            ], ctrans, 1, (0 + time) % 1, 4, time);
            break;
        case 7:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -22.85, -37.45
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.049999237060546875, -2.13623046875E-5, -2.13623046875E-5,
                0.049999237060546875, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04984130859375, -0.00331268310546875, 0.00331268310546875,
                0.04984130859375, 3.15, -13.5
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite307", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -27.45, -71.85
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite311", canvas, ctx, [0.047563934326171876, -0.01523895263671875, 0.01523895263671875,
                0.047563934326171876, -18.7, -49.85
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite360", canvas, ctx, [-0.047149658203125, -0.016485595703125, -0.016485595703125,
                0.047149658203125, -5.4, -41.7
            ], ctrans, 1, (0 + time) % 1, 5, time);
            place("sprite311", canvas, ctx, [0.0461090087890625, 0.01918487548828125, -0.01918487548828125,
                0.0461090087890625, 5.35, -53.5
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite360", canvas, ctx, [0.047149658203125, -0.016485595703125, 0.016485595703125,
                0.047149658203125, 3.1, -41.7
            ], ctrans, 1, (0 + time) % 1, 5, time);
            place("sprite320", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -28.75, -97.0
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite324", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -41.6, -92.7
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("morphshape325", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -3.7, -34.75
            ], ctrans, 1, 0, 0, time);
            place("sprite333", canvas, ctx, [-0.0435150146484375, 0.023632049560546875, 0.023632049560546875,
                0.0435150146484375, 17.15, -22.95
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite335", canvas, ctx, [0.049410247802734376, 0.001399993896484375, -0.001399993896484375,
                0.049410247802734376, -16.3, -31.5
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite339", canvas, ctx, [0.02134246826171875, 0.04508056640625, -0.045079803466796874,
                0.021343231201171875, 23.6, -24.65
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite355", canvas, ctx, [0.049883270263671876, 5.8746337890625E-4, -5.8746337890625E-4,
                0.049883270263671876, -11.5, -16.4
            ], ctrans, 1, (0 + time) % 1, 4, time);
            break;
        case 8:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -22.85, -37.45
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.049999237060546875, -2.13623046875E-5, -2.13623046875E-5,
                0.049999237060546875, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04984130859375, -0.00331268310546875, 0.00331268310546875,
                0.04984130859375, 3.15, -13.5
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite307", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -27.45, -71.85
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite311", canvas, ctx, [0.047563934326171876, -0.01523895263671875, 0.01523895263671875,
                0.047563934326171876, -18.7, -49.85
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite360", canvas, ctx, [-0.047149658203125, -0.016485595703125, -0.016485595703125,
                0.047149658203125, -5.4, -41.7
            ], ctrans, 1, (0 + time) % 1, 5, time);
            place("sprite311", canvas, ctx, [0.0461090087890625, 0.01918487548828125, -0.01918487548828125,
                0.0461090087890625, 5.35, -53.5
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite360", canvas, ctx, [0.047149658203125, -0.016485595703125, 0.016485595703125,
                0.047149658203125, 3.1, -41.7
            ], ctrans, 1, (0 + time) % 1, 5, time);
            place("sprite320", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -28.75, -97.0
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite324", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -41.6, -92.7
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("morphshape325", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -3.7, -34.75
            ], ctrans, 1, 0, 0, time);
            place("sprite333", canvas, ctx, [-0.0435150146484375, 0.023632049560546875, 0.023632049560546875,
                0.0435150146484375, 17.15, -22.95
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite335", canvas, ctx, [0.049410247802734376, 0.001399993896484375, -0.001399993896484375,
                0.049410247802734376, -16.3, -31.5
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite339", canvas, ctx, [0.02134246826171875, 0.04508056640625, -0.045079803466796874,
                0.021343231201171875, 23.6, -24.65
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite355", canvas, ctx, [0.049883270263671876, 5.8746337890625E-4, -5.8746337890625E-4,
                0.049883270263671876, -11.5, -16.4
            ], ctrans, 1, (0 + time) % 1, 4, time);
            break;
        case 9:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -22.5, -37.1
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.049999237060546875, -2.13623046875E-5, -2.13623046875E-5,
                0.049999237060546875, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04984130859375, -0.00331268310546875, 0.00331268310546875,
                0.04984130859375, 3.15, -13.5
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite307", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -27.1, -71.5
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite311", canvas, ctx, [0.047563934326171876, -0.01523895263671875, 0.01523895263671875,
                0.047563934326171876, -18.35, -49.5
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite316", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -17.6, -45.6
            ], ctrans, 1, (0 + time) % 1, 9, time);
            place("sprite311", canvas, ctx, [0.0461090087890625, 0.01918487548828125, -0.01918487548828125,
                0.0461090087890625, 5.7, -53.15
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite316", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, 3.85, -45.35
            ], ctrans, 1, (0 + time) % 1, 9, time);
            place("sprite320", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -28.4, -96.65
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite324", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -41.25, -92.35
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("morphshape325", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -3.35, -34.4
            ], ctrans, 1, 0, 0, time);
            place("sprite333", canvas, ctx, [-0.043437957763671875, 0.02362823486328125, 0.02362823486328125,
                0.043437957763671875, 17.25, -23.15
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite335", canvas, ctx, [0.04934616088867187, -0.0031341552734375, 0.0031341552734375,
                0.04934616088867187, -17.8, -28.85
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite339", canvas, ctx, [0.02134246826171875, 0.04508056640625, -0.045079803466796874,
                0.021343231201171875, 23.6, -26.75
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite355", canvas, ctx, [0.049883270263671876, 5.8746337890625E-4, -5.8746337890625E-4,
                0.049883270263671876, -11.5, -17.1
            ], ctrans, 1, (0 + time) % 1, 4, time);
            break;
        case 10:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.04999465942382812, 4.69970703125E-4, -4.69970703125E-4,
                0.04999465942382812, -22.2, -37.45
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.049715423583984376, 0.00501861572265625, -0.00501861572265625,
                0.049715423583984376, 6.7, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.049715423583984376, 0.00501861572265625, -0.00501861572265625,
                0.049715423583984376, -6.75, -8.35
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.04999847412109375, -5.340576171875E-6, -5.340576171875E-6,
                0.04999847412109375, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.049832916259765624, -0.003278350830078125, 0.003278350830078125,
                0.049832916259765624, 3.1, -13.45
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite307", canvas, ctx, [0.04999465942382812, 4.69970703125E-4, -4.69970703125E-4,
                0.04999465942382812, -27.4, -72.0
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite311", canvas, ctx, [0.0473724365234375, -0.0156768798828125, 0.0156768798828125,
                0.0473724365234375, -18.3, -49.95
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite316", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -17.6, -45.6
            ], ctrans, 1, (0 + time) % 1, 9, time);
            place("sprite311", canvas, ctx, [0.0463104248046875, 0.018544769287109374, -0.018544769287109374,
                0.0463104248046875, 5.75, -54.05
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite316", canvas, ctx, [0.049993896484375, 4.69970703125E-4, -4.69970703125E-4,
                0.049993896484375, 4.0, -46.1
            ], ctrans, 1, (0 + time) % 1, 9, time);
            place("sprite320", canvas, ctx, [0.04999465942382812, 4.69970703125E-4, -4.69970703125E-4,
                0.04999465942382812, -28.8, -96.95
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite324", canvas, ctx, [0.04999465942382812, 4.69970703125E-4, -4.69970703125E-4,
                0.04999465942382812, -41.65, -92.5
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("morphshape325", canvas, ctx, [0.04999465942382812, 4.69970703125E-4, -4.69970703125E-4,
                0.04999465942382812, -3.0, -35.05
            ], ctrans, 1, 0, 13107, time);
            place("sprite333", canvas, ctx, [-0.043437957763671875, 0.02362823486328125, 0.02362823486328125,
                0.043437957763671875, 17.3, -23.35
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite335", canvas, ctx, [0.04944610595703125, -6.72149658203125E-4, 6.72149658203125E-4,
                0.04944610595703125, -17.2, -30.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite339", canvas, ctx, [0.021292877197265626, 0.04503326416015625, -0.04503326416015625,
                0.02129364013671875, 23.9, -26.15
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite347", canvas, ctx, [-0.035799407958984376, -0.03438262939453125, -0.03438262939453125,
                0.035799407958984376, -1.05, -22.9
            ], ctrans, 1, (0 + time) % 1, 10, time);
            break;
        case 11:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -21.9, -38.0], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.049999237060546875, -2.13623046875E-5, -2.13623046875E-5,
                0.049999237060546875, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04984130859375, -0.00331268310546875, 0.00331268310546875,
                0.04984130859375, 3.15, -13.5
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite307", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -27.3, -72.25], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite311", canvas, ctx, [0.0472076416015625, -0.01631927490234375, 0.01631927490234375,
                0.0472076416015625, -18.05, -50.5
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape361", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite311", canvas, ctx, [0.0465362548828125, 0.0181304931640625, -0.0181304931640625,
                0.0465362548828125, 5.9, -54.65
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape362", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite320", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -29.15, -97.35], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite324", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -41.9, -92.8], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("morphshape325", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -2.7, -35.7], ctrans, 1, 0, 0, time);
            place("sprite333", canvas, ctx, [-0.0435150146484375, 0.023632049560546875, 0.023632049560546875,
                0.0435150146484375, 17.15, -23.65
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite335", canvas, ctx, [0.04943389892578125, 0.001647186279296875, -0.001647186279296875,
                0.04943389892578125, -16.3, -31.6
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite339", canvas, ctx, [0.02134246826171875, 0.04508056640625, -0.045079803466796874,
                0.021343231201171875, 24.3, -25.7
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite347", canvas, ctx, [-0.04101409912109375, -0.028243255615234376, -0.028243255615234376,
                0.04101409912109375, -1.15, -24.85
            ], ctrans, 1, (0 + time) % 1, 10, time);
            break;
        case 12:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -21.9, -38.0], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.049999237060546875, -2.13623046875E-5, -2.13623046875E-5,
                0.049999237060546875, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04984130859375, -0.00331268310546875, 0.00331268310546875,
                0.04984130859375, 3.15, -13.5
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite307", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -27.3, -72.25], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite311", canvas, ctx, [0.0472076416015625, -0.01631927490234375, 0.01631927490234375,
                0.0472076416015625, -18.05, -50.5
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite316", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -17.2, -46.6], ctrans, 1, (0 + time) % 1, 12,
                time);
            place("sprite311", canvas, ctx, [0.0465362548828125, 0.0181304931640625, -0.0181304931640625,
                0.0465362548828125, 5.9, -54.65
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite316", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 4.25, -46.85], ctrans, 1, (0 + time) % 1, 12,
                time);
            place("sprite320", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -29.15, -97.35], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite324", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -41.9, -92.8], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("morphshape325", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -2.7, -35.7], ctrans, 1, 0, 0, time);
            place("sprite333", canvas, ctx, [-0.0435150146484375, 0.023632049560546875, 0.023632049560546875,
                0.0435150146484375, 17.15, -23.65
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite335", canvas, ctx, [0.04943389892578125, 0.001647186279296875, -0.001647186279296875,
                0.04943389892578125, -16.3, -31.6
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite339", canvas, ctx, [0.02134246826171875, 0.04508056640625, -0.045079803466796874,
                0.021343231201171875, 24.3, -25.7
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite347", canvas, ctx, [-0.04101409912109375, -0.028243255615234376, -0.028243255615234376,
                0.04101409912109375, -1.15, -24.85
            ], ctrans, 1, (0 + time) % 1, 10, time);
            break;
        case 13:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.04999465942382812, 4.69970703125E-4, -4.69970703125E-4,
                0.04999465942382812, -22.2, -37.5
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.049715423583984376, 0.00501861572265625, -0.00501861572265625,
                0.049715423583984376, 6.7, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.049715423583984376, 0.00501861572265625, -0.00501861572265625,
                0.049715423583984376, -6.75, -8.35
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.04999847412109375, -5.340576171875E-6, -5.340576171875E-6,
                0.04999847412109375, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.049832916259765624, -0.003278350830078125, 0.003278350830078125,
                0.049832916259765624, 3.1, -13.45
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite307", canvas, ctx, [0.04999465942382812, 4.69970703125E-4, -4.69970703125E-4,
                0.04999465942382812, -27.1, -71.65
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite311", canvas, ctx, [0.0473724365234375, -0.0156768798828125, 0.0156768798828125,
                0.0473724365234375, -18.1, -50.1
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite316", canvas, ctx, [0.04999465942382812, 4.69970703125E-4, -4.69970703125E-4,
                0.04999465942382812, -17.4, -46.1
            ], ctrans, 1, (0 + time) % 1, 12, time);
            place("sprite311", canvas, ctx, [0.04630966186523437, 0.01854400634765625, -0.01854400634765625,
                0.04630966186523437, 5.85, -53.75
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite316", canvas, ctx, [0.04999465942382812, 4.69970703125E-4, -4.69970703125E-4,
                0.04999465942382812, 4.1, -46.1
            ], ctrans, 1, (0 + time) % 1, 12, time);
            place("sprite320", canvas, ctx, [0.04999465942382812, 4.69970703125E-4, -4.69970703125E-4,
                0.04999465942382812, -28.8, -96.9
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite324", canvas, ctx, [0.04999465942382812, 4.69970703125E-4, -4.69970703125E-4,
                0.04999465942382812, -41.65, -92.5
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("morphshape325", canvas, ctx, [0.04999465942382812, 4.69970703125E-4, -4.69970703125E-4,
                0.04999465942382812, -3.0, -35.05
            ], ctrans, 1, 0, 13107, time);
            place("sprite333", canvas, ctx, [-0.043437957763671875, 0.02362823486328125, 0.02362823486328125,
                0.043437957763671875, 17.25, -23.35
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite335", canvas, ctx, [0.04944610595703125, -6.7138671875E-4, 6.7138671875E-4,
                0.04944610595703125, -16.95, -30.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite339", canvas, ctx, [0.021292877197265626, 0.04503326416015625, -0.04503326416015625,
                0.02129364013671875, 23.95, -26.15
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite347", canvas, ctx, [-0.035799407958984376, -0.03438262939453125, -0.03438262939453125,
                0.035799407958984376, -1.05, -22.9
            ], ctrans, 1, (0 + time) % 1, 10, time);
            break;
        case 14:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -22.5, -37.1
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.049999237060546875, -2.13623046875E-5, -2.13623046875E-5,
                0.049999237060546875, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04984130859375, -0.00331268310546875, 0.00331268310546875,
                0.04984130859375, 3.15, -13.5
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite307", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -27.1, -71.5
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite311", canvas, ctx, [0.047563934326171876, -0.01523895263671875, 0.01523895263671875,
                0.047563934326171876, -18.35, -49.5
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite316", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -17.6, -45.6
            ], ctrans, 1, (0 + time) % 1, 12, time);
            place("sprite311", canvas, ctx, [0.0461090087890625, 0.01918487548828125, -0.01918487548828125,
                0.0461090087890625, 5.7, -53.15
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite316", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, 3.85, -45.35
            ], ctrans, 1, (0 + time) % 1, 12, time);
            place("sprite320", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -28.4, -96.65
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite324", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -41.25, -92.35
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("morphshape325", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -3.35, -34.4
            ], ctrans, 1, 0, 0, time);
            place("sprite333", canvas, ctx, [-0.043437957763671875, 0.02362823486328125, 0.02362823486328125,
                0.043437957763671875, 17.2, -23.15
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite335", canvas, ctx, [0.04934616088867187, -0.0031341552734375, 0.0031341552734375,
                0.04934616088867187, -17.8, -28.85
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite339", canvas, ctx, [0.02134246826171875, 0.04508056640625, -0.045079803466796874,
                0.021343231201171875, 23.6, -26.75
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite355", canvas, ctx, [0.049883270263671876, 5.8746337890625E-4, -5.8746337890625E-4,
                0.049883270263671876, -11.5, -17.1
            ], ctrans, 1, (0 + time) % 1, 14, time);
            break;
        case 15:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -22.85, -37.45
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.049999237060546875, -2.13623046875E-5, -2.13623046875E-5,
                0.049999237060546875, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04984130859375, -0.00331268310546875, 0.00331268310546875,
                0.04984130859375, 3.15, -13.5
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite307", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -27.45, -71.85
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite311", canvas, ctx, [0.047563934326171876, -0.01523895263671875, 0.01523895263671875,
                0.047563934326171876, -18.7, -49.85
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite360", canvas, ctx, [-0.047149658203125, -0.016485595703125, -0.016485595703125,
                0.047149658203125, -5.4, -41.7
            ], ctrans, 1, (0 + time) % 1, 15, time);
            place("sprite311", canvas, ctx, [0.0461090087890625, 0.01918487548828125, -0.01918487548828125,
                0.0461090087890625, 5.35, -53.5
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite360", canvas, ctx, [0.047149658203125, -0.016485595703125, 0.016485595703125,
                0.047149658203125, 3.1, -41.7
            ], ctrans, 1, (0 + time) % 1, 15, time);
            place("sprite320", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -28.75, -97.0
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite324", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -41.6, -92.7
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("morphshape325", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -3.7, -34.75
            ], ctrans, 1, 0, 0, time);
            place("sprite333", canvas, ctx, [-0.0435150146484375, 0.023632049560546875, 0.023632049560546875,
                0.0435150146484375, 17.15, -22.95
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite335", canvas, ctx, [0.049410247802734376, 0.001399993896484375, -0.001399993896484375,
                0.049410247802734376, -16.3, -31.5
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite339", canvas, ctx, [0.02134246826171875, 0.04508056640625, -0.045079803466796874,
                0.021343231201171875, 23.6, -24.65
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite355", canvas, ctx, [0.049883270263671876, 5.8746337890625E-4, -5.8746337890625E-4,
                0.049883270263671876, -11.5, -16.4
            ], ctrans, 1, (0 + time) % 1, 14, time);
            break;
        case 16:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -22.85, -37.45
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.049999237060546875, -2.13623046875E-5, -2.13623046875E-5,
                0.049999237060546875, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04984130859375, -0.00331268310546875, 0.00331268310546875,
                0.04984130859375, 3.15, -13.5
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite307", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -27.45, -71.85
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite311", canvas, ctx, [0.047563934326171876, -0.01523895263671875, 0.01523895263671875,
                0.047563934326171876, -18.7, -49.85
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite360", canvas, ctx, [-0.047149658203125, -0.016485595703125, -0.016485595703125,
                0.047149658203125, -5.4, -41.7
            ], ctrans, 1, (0 + time) % 1, 15, time);
            place("sprite311", canvas, ctx, [0.0461090087890625, 0.01918487548828125, -0.01918487548828125,
                0.0461090087890625, 5.35, -53.5
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite360", canvas, ctx, [0.047149658203125, -0.016485595703125, 0.016485595703125,
                0.047149658203125, 3.1, -41.7
            ], ctrans, 1, (0 + time) % 1, 15, time);
            place("sprite320", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -28.75, -97.0
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite324", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -41.6, -92.7
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("morphshape325", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -3.7, -34.75
            ], ctrans, 1, 0, 0, time);
            place("sprite333", canvas, ctx, [-0.0435150146484375, 0.023632049560546875, 0.023632049560546875,
                0.0435150146484375, 17.15, -22.95
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite335", canvas, ctx, [0.049410247802734376, 0.001399993896484375, -0.001399993896484375,
                0.049410247802734376, -16.3, -31.5
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite339", canvas, ctx, [0.02134246826171875, 0.04508056640625, -0.045079803466796874,
                0.021343231201171875, 23.6, -24.65
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite355", canvas, ctx, [0.049883270263671876, 5.8746337890625E-4, -5.8746337890625E-4,
                0.049883270263671876, -11.5, -16.4
            ], ctrans, 1, (0 + time) % 1, 14, time);
            break;
        case 17:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -22.85, -37.45
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.049999237060546875, -2.13623046875E-5, -2.13623046875E-5,
                0.049999237060546875, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04984130859375, -0.00331268310546875, 0.00331268310546875,
                0.04984130859375, 3.15, -13.5
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite307", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -27.45, -71.85
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite311", canvas, ctx, [0.047563934326171876, -0.01523895263671875, 0.01523895263671875,
                0.047563934326171876, -18.7, -49.85
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite360", canvas, ctx, [-0.047149658203125, -0.016485595703125, -0.016485595703125,
                0.047149658203125, -5.4, -41.7
            ], ctrans, 1, (0 + time) % 1, 15, time);
            place("sprite311", canvas, ctx, [0.0461090087890625, 0.01918487548828125, -0.01918487548828125,
                0.0461090087890625, 5.35, -53.5
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite360", canvas, ctx, [0.047149658203125, -0.016485595703125, 0.016485595703125,
                0.047149658203125, 3.1, -41.7
            ], ctrans, 1, (0 + time) % 1, 15, time);
            place("sprite320", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -28.75, -97.0
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite324", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -41.6, -92.7
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("morphshape325", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -3.7, -34.75
            ], ctrans, 1, 0, 0, time);
            place("sprite333", canvas, ctx, [-0.0435150146484375, 0.023632049560546875, 0.023632049560546875,
                0.0435150146484375, 17.15, -22.95
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite335", canvas, ctx, [0.049410247802734376, 0.001399993896484375, -0.001399993896484375,
                0.049410247802734376, -16.3, -31.5
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite339", canvas, ctx, [0.02134246826171875, 0.04508056640625, -0.045079803466796874,
                0.021343231201171875, 23.6, -24.65
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite355", canvas, ctx, [0.049883270263671876, 5.8746337890625E-4, -5.8746337890625E-4,
                0.049883270263671876, -11.5, -16.4
            ], ctrans, 1, (0 + time) % 1, 14, time);
            break;
        case 18:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -22.85, -37.45
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.049999237060546875, -2.13623046875E-5, -2.13623046875E-5,
                0.049999237060546875, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04984130859375, -0.00331268310546875, 0.00331268310546875,
                0.04984130859375, 3.15, -13.5
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite307", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -27.45, -71.85
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite311", canvas, ctx, [0.047563934326171876, -0.01523895263671875, 0.01523895263671875,
                0.047563934326171876, -18.7, -49.85
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite360", canvas, ctx, [-0.047149658203125, -0.016485595703125, -0.016485595703125,
                0.047149658203125, -5.4, -41.7
            ], ctrans, 1, (0 + time) % 1, 15, time);
            place("sprite311", canvas, ctx, [0.0461090087890625, 0.01918487548828125, -0.01918487548828125,
                0.0461090087890625, 5.35, -53.5
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite360", canvas, ctx, [0.047149658203125, -0.016485595703125, 0.016485595703125,
                0.047149658203125, 3.1, -41.7
            ], ctrans, 1, (0 + time) % 1, 15, time);
            place("sprite320", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -28.75, -97.0
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite324", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -41.6, -92.7
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("morphshape325", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -3.7, -34.75
            ], ctrans, 1, 0, 0, time);
            place("sprite333", canvas, ctx, [-0.0435150146484375, 0.023632049560546875, 0.023632049560546875,
                0.0435150146484375, 17.15, -22.95
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite335", canvas, ctx, [0.049410247802734376, 0.001399993896484375, -0.001399993896484375,
                0.049410247802734376, -16.3, -31.5
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite339", canvas, ctx, [0.02134246826171875, 0.04508056640625, -0.045079803466796874,
                0.021343231201171875, 23.6, -24.65
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite355", canvas, ctx, [0.049883270263671876, 5.8746337890625E-4, -5.8746337890625E-4,
                0.049883270263671876, -11.5, -16.4
            ], ctrans, 1, (0 + time) % 1, 14, time);
            break;
        case 19:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -22.5, -37.1
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.049999237060546875, -2.13623046875E-5, -2.13623046875E-5,
                0.049999237060546875, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04984130859375, -0.00331268310546875, 0.00331268310546875,
                0.04984130859375, 3.15, -13.5
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite307", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -27.1, -71.5
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite311", canvas, ctx, [0.047563934326171876, -0.01523895263671875, 0.01523895263671875,
                0.047563934326171876, -18.35, -49.5
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite316", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -17.6, -45.6
            ], ctrans, 1, (0 + time) % 1, 19, time);
            place("sprite311", canvas, ctx, [0.0461090087890625, 0.01918487548828125, -0.01918487548828125,
                0.0461090087890625, 5.7, -53.15
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite316", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, 3.85, -45.35
            ], ctrans, 1, (0 + time) % 1, 19, time);
            place("sprite320", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -28.4, -96.65
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite324", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -41.25, -92.35
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("morphshape325", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -3.35, -34.4
            ], ctrans, 1, 0, 0, time);
            place("sprite333", canvas, ctx, [-0.043437957763671875, 0.02362823486328125, 0.02362823486328125,
                0.043437957763671875, 17.3, -23.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite335", canvas, ctx, [0.04934616088867187, -0.0031341552734375, 0.0031341552734375,
                0.04934616088867187, -17.8, -28.85
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite339", canvas, ctx, [0.02134246826171875, 0.04508056640625, -0.045079803466796874,
                0.021343231201171875, 23.6, -26.75
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite355", canvas, ctx, [0.049883270263671876, 5.8746337890625E-4, -5.8746337890625E-4,
                0.049883270263671876, -11.5, -17.1
            ], ctrans, 1, (0 + time) % 1, 14, time);
            break;
        case 20:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -21.9, -38.0], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.049999237060546875, -2.13623046875E-5, -2.13623046875E-5,
                0.049999237060546875, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04984130859375, -0.00331268310546875, 0.00331268310546875,
                0.04984130859375, 3.15, -13.5
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite307", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -27.3, -72.25], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite311", canvas, ctx, [0.0472076416015625, -0.01631927490234375, 0.01631927490234375,
                0.0472076416015625, -18.05, -50.5
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite316", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -17.2, -46.6], ctrans, 1, (0 + time) % 1, 19,
                time);
            place("sprite311", canvas, ctx, [0.0465362548828125, 0.0181304931640625, -0.0181304931640625,
                0.0465362548828125, 5.9, -54.65
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite316", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 4.25, -46.85], ctrans, 1, (0 + time) % 1, 19,
                time);
            place("sprite320", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -29.15, -97.35], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite324", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -41.9, -92.8], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("morphshape325", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -2.7, -35.7], ctrans, 1, 0, 0, time);
            place("sprite333", canvas, ctx, [-0.0435150146484375, 0.023632049560546875, 0.023632049560546875,
                0.0435150146484375, 17.15, -23.65
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite335", canvas, ctx, [0.04943389892578125, 0.001647186279296875, -0.001647186279296875,
                0.04943389892578125, -16.3, -31.6
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite339", canvas, ctx, [0.02134246826171875, 0.04508056640625, -0.045079803466796874,
                0.021343231201171875, 24.3, -25.7
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite347", canvas, ctx, [-0.04101409912109375, -0.028243255615234376, -0.028243255615234376,
                0.04101409912109375, -1.15, -24.85
            ], ctrans, 1, (0 + time) % 1, 20, time);
            break;
        case 21:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -21.9, -38.0], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.049999237060546875, -2.13623046875E-5, -2.13623046875E-5,
                0.049999237060546875, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04984130859375, -0.00331268310546875, 0.00331268310546875,
                0.04984130859375, 3.15, -13.5
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite307", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -27.3, -72.25], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite311", canvas, ctx, [0.0472076416015625, -0.01631927490234375, 0.01631927490234375,
                0.0472076416015625, -18.05, -50.5
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite316", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -17.2, -46.6], ctrans, 1, (0 + time) % 1, 19,
                time);
            place("sprite311", canvas, ctx, [0.0465362548828125, 0.0181304931640625, -0.0181304931640625,
                0.0465362548828125, 5.9, -54.65
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite316", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 4.25, -46.85], ctrans, 1, (0 + time) % 1, 19,
                time);
            place("sprite320", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -29.15, -97.35], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite324", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -41.9, -92.8], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("morphshape325", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -2.7, -35.7], ctrans, 1, 0, 0, time);
            place("sprite333", canvas, ctx, [-0.0435150146484375, 0.023632049560546875, 0.023632049560546875,
                0.0435150146484375, 17.15, -23.65
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite335", canvas, ctx, [0.04943389892578125, 0.001647186279296875, -0.001647186279296875,
                0.04943389892578125, -16.3, -31.6
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite339", canvas, ctx, [0.02134246826171875, 0.04508056640625, -0.045079803466796874,
                0.021343231201171875, 24.3, -25.7
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite347", canvas, ctx, [-0.04101409912109375, -0.028243255615234376, -0.028243255615234376,
                0.04101409912109375, -1.15, -24.85
            ], ctrans, 1, (0 + time) % 1, 20, time);
            break;
        case 22:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.049997711181640626, 2.58636474609375E-4, -2.58636474609375E-4,
                0.049997711181640626, -22.1, -37.65
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.049715423583984376, 0.00501861572265625, -0.00501861572265625,
                0.049715423583984376, 6.7, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.049715423583984376, 0.00501861572265625, -0.00501861572265625,
                0.049715423583984376, -6.75, -8.35
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.04999847412109375, -5.340576171875E-6, -5.340576171875E-6,
                0.04999847412109375, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.049832916259765624, -0.003278350830078125, 0.003278350830078125,
                0.049832916259765624, 3.1, -13.45
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite307", canvas, ctx, [0.049997711181640626, 2.58636474609375E-4, -2.58636474609375E-4,
                0.049997711181640626, -27.2, -71.85
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite311", canvas, ctx, [0.0473052978515625, -0.015876007080078126, 0.015876007080078126,
                0.0473052978515625, -18.1, -50.2
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite316", canvas, ctx, [0.049997711181640626, 2.58636474609375E-4, -2.58636474609375E-4,
                0.049997711181640626, -17.3, -46.3
            ], ctrans, 1, (0 + time) % 1, 19, time);
            place("sprite311", canvas, ctx, [0.046389007568359376, 0.01834869384765625, -0.01834869384765625,
                0.046389007568359376, 5.9, -54.05
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite316", canvas, ctx, [0.049997711181640626, 2.58636474609375E-4, -2.58636474609375E-4,
                0.049997711181640626, 4.15, -46.35
            ], ctrans, 1, (0 + time) % 1, 19, time);
            place("sprite320", canvas, ctx, [0.049997711181640626, 2.58636474609375E-4, -2.58636474609375E-4,
                0.049997711181640626, -29.0, -97.05
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite324", canvas, ctx, [0.049997711181640626, 2.58636474609375E-4, -2.58636474609375E-4,
                0.049997711181640626, -41.75, -92.55
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("morphshape325", canvas, ctx, [0.049997711181640626, 2.58636474609375E-4, -
                2.58636474609375E-4, 0.049997711181640626, -2.95, -35.25
            ], ctrans, 1, 0, 13107, time);
            place("sprite333", canvas, ctx, [-0.043437957763671875, 0.02362823486328125, 0.02362823486328125,
                0.043437957763671875, 17.25, -23.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite335", canvas, ctx, [0.04945526123046875, 1.4495849609375E-5, -1.4495849609375E-5,
                0.04945526123046875, -16.75, -30.65
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite339", canvas, ctx, [0.021292877197265626, 0.04503326416015625, -0.04503326416015625,
                0.02129364013671875, 24.05, -26.0
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite347", canvas, ctx, [-0.03850631713867188, -0.03132171630859375, -0.03132171630859375,
                0.03850631713867188, -1.15, -23.85
            ], ctrans, 1, (0 + time) % 1, 20, time);
            break;
        case 23:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.0499908447265625, 6.805419921875E-4, -6.805419921875E-4,
                0.0499908447265625, -22.3, -37.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.049715423583984376, 0.00501861572265625, -0.00501861572265625,
                0.049715423583984376, 6.7, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.049715423583984376, 0.00501861572265625, -0.00501861572265625,
                0.049715423583984376, -6.75, -8.35
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.04999847412109375, -5.340576171875E-6, -5.340576171875E-6,
                0.04999847412109375, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.049832916259765624, -0.003278350830078125, 0.003278350830078125,
                0.049832916259765624, 3.1, -13.45
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite307", canvas, ctx, [0.0499908447265625, 6.805419921875E-4, -6.805419921875E-4,
                0.0499908447265625, -27.0, -71.45
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite311", canvas, ctx, [0.047437286376953124, -0.015476226806640625, 0.015476226806640625,
                0.047437286376953124, -18.1, -49.95
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite316", canvas, ctx, [0.0499908447265625, 6.805419921875E-4, -6.805419921875E-4,
                0.0499908447265625, -17.5, -45.95
            ], ctrans, 1, (0 + time) % 1, 19, time);
            place("sprite311", canvas, ctx, [0.04622955322265625, 0.018741607666015625, -0.018741607666015625,
                0.04622955322265625, 5.85, -53.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite316", canvas, ctx, [0.0499908447265625, 6.805419921875E-4, -6.805419921875E-4,
                0.0499908447265625, 4.0, -45.9
            ], ctrans, 1, (0 + time) % 1, 19, time);
            place("sprite320", canvas, ctx, [0.0499908447265625, 6.805419921875E-4, -6.805419921875E-4,
                0.0499908447265625, -28.65, -96.8
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite324", canvas, ctx, [0.0499908447265625, 6.805419921875E-4, -6.805419921875E-4,
                0.0499908447265625, -41.55, -92.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("morphshape325", canvas, ctx, [0.0499908447265625, 6.805419921875E-4, -6.805419921875E-4,
                0.0499908447265625, -3.1, -34.85
            ], ctrans, 1, 0, 26214, time);
            place("sprite333", canvas, ctx, [-0.043437957763671875, 0.02362823486328125, 0.02362823486328125,
                0.043437957763671875, 17.25, -23.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite335", canvas, ctx, [0.04942169189453125, -0.00151824951171875, 0.00151824951171875,
                0.04942169189453125, -17.1, -29.7
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite339", canvas, ctx, [0.021292877197265626, 0.04503326416015625, -0.04503326416015625,
                0.02129364013671875, 23.85, -26.35
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite347", canvas, ctx, [-0.035799407958984376, -0.03438262939453125, -0.03438262939453125,
                0.035799407958984376, -1.05, -22.9
            ], ctrans, 1, (0 + time) % 1, 20, time);
            break;
        case 24:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -22.5, -37.1
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.049999237060546875, -2.13623046875E-5, -2.13623046875E-5,
                0.049999237060546875, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04984130859375, -0.00331268310546875, 0.00331268310546875,
                0.04984130859375, 3.15, -13.5
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite307", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -27.1, -71.5
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite311", canvas, ctx, [0.047563934326171876, -0.01523895263671875, 0.01523895263671875,
                0.047563934326171876, -18.35, -49.5
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite316", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -17.6, -45.6
            ], ctrans, 1, (0 + time) % 1, 19, time);
            place("sprite311", canvas, ctx, [0.0461090087890625, 0.01918487548828125, -0.01918487548828125,
                0.0461090087890625, 5.7, -53.15
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite316", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, 3.85, -45.35
            ], ctrans, 1, (0 + time) % 1, 19, time);
            place("sprite320", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -28.4, -96.65
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite324", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -41.25, -92.35
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("morphshape325", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -3.35, -34.4
            ], ctrans, 1, 0, 0, time);
            place("sprite333", canvas, ctx, [-0.043437957763671875, 0.02362823486328125, 0.02362823486328125,
                0.043437957763671875, 17.2, -23.1
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite335", canvas, ctx, [0.04934616088867187, -0.0031341552734375, 0.0031341552734375,
                0.04934616088867187, -17.8, -28.85
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite339", canvas, ctx, [0.02134246826171875, 0.04508056640625, -0.045079803466796874,
                0.021343231201171875, 23.6, -26.75
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite355", canvas, ctx, [0.049883270263671876, 5.8746337890625E-4, -5.8746337890625E-4,
                0.049883270263671876, -11.5, -17.1
            ], ctrans, 1, (0 + time) % 1, 24, time);
            break;
        case 25:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -22.85, -37.45
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.049999237060546875, -2.13623046875E-5, -2.13623046875E-5,
                0.049999237060546875, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04984130859375, -0.00331268310546875, 0.00331268310546875,
                0.04984130859375, 3.15, -13.5
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite307", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -27.45, -71.85
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite311", canvas, ctx, [0.047563934326171876, -0.01523895263671875, 0.01523895263671875,
                0.047563934326171876, -18.7, -49.85
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite360", canvas, ctx, [-0.047149658203125, -0.016485595703125, -0.016485595703125,
                0.047149658203125, -5.4, -41.7
            ], ctrans, 1, (0 + time) % 1, 25, time);
            place("sprite311", canvas, ctx, [0.0461090087890625, 0.01918487548828125, -0.01918487548828125,
                0.0461090087890625, 5.35, -53.5
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite360", canvas, ctx, [0.047149658203125, -0.016485595703125, 0.016485595703125,
                0.047149658203125, 3.1, -41.7
            ], ctrans, 1, (0 + time) % 1, 25, time);
            place("sprite320", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -28.75, -97.0
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite324", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -41.6, -92.7
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("morphshape325", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -3.7, -34.75
            ], ctrans, 1, 0, 0, time);
            place("sprite333", canvas, ctx, [-0.0435150146484375, 0.023632049560546875, 0.023632049560546875,
                0.0435150146484375, 17.15, -22.95
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite335", canvas, ctx, [0.049410247802734376, 0.001399993896484375, -0.001399993896484375,
                0.049410247802734376, -16.3, -31.5
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite339", canvas, ctx, [0.02134246826171875, 0.04508056640625, -0.045079803466796874,
                0.021343231201171875, 23.6, -24.65
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite355", canvas, ctx, [0.049883270263671876, 5.8746337890625E-4, -5.8746337890625E-4,
                0.049883270263671876, -11.5, -16.4
            ], ctrans, 1, (0 + time) % 1, 24, time);
            break;
        case 26:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -22.85, -37.45
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.049999237060546875, -2.13623046875E-5, -2.13623046875E-5,
                0.049999237060546875, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04984130859375, -0.00331268310546875, 0.00331268310546875,
                0.04984130859375, 3.15, -13.5
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite307", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -27.45, -71.85
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite311", canvas, ctx, [0.047563934326171876, -0.01523895263671875, 0.01523895263671875,
                0.047563934326171876, -18.7, -49.85
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite360", canvas, ctx, [-0.047149658203125, -0.016485595703125, -0.016485595703125,
                0.047149658203125, -5.4, -41.7
            ], ctrans, 1, (0 + time) % 1, 25, time);
            place("sprite311", canvas, ctx, [0.0461090087890625, 0.01918487548828125, -0.01918487548828125,
                0.0461090087890625, 5.35, -53.5
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite360", canvas, ctx, [0.047149658203125, -0.016485595703125, 0.016485595703125,
                0.047149658203125, 3.1, -41.7
            ], ctrans, 1, (0 + time) % 1, 25, time);
            place("sprite320", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -28.75, -97.0
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite324", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -41.6, -92.7
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("morphshape325", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -3.7, -34.75
            ], ctrans, 1, 0, 0, time);
            place("sprite333", canvas, ctx, [-0.0435150146484375, 0.023632049560546875, 0.023632049560546875,
                0.0435150146484375, 17.15, -22.95
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite335", canvas, ctx, [0.049410247802734376, 0.001399993896484375, -0.001399993896484375,
                0.049410247802734376, -16.3, -31.5
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite339", canvas, ctx, [0.02134246826171875, 0.04508056640625, -0.045079803466796874,
                0.021343231201171875, 23.6, -24.65
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite355", canvas, ctx, [0.049883270263671876, 5.8746337890625E-4, -5.8746337890625E-4,
                0.049883270263671876, -11.5, -16.4
            ], ctrans, 1, (0 + time) % 1, 24, time);
            break;
        case 27:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -22.85, -37.45
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.049999237060546875, -2.13623046875E-5, -2.13623046875E-5,
                0.049999237060546875, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04984130859375, -0.00331268310546875, 0.00331268310546875,
                0.04984130859375, 3.15, -13.5
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite307", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -27.45, -71.85
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite311", canvas, ctx, [0.047563934326171876, -0.01523895263671875, 0.01523895263671875,
                0.047563934326171876, -18.7, -49.85
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite360", canvas, ctx, [-0.047149658203125, -0.016485595703125, -0.016485595703125,
                0.047149658203125, -5.4, -41.7
            ], ctrans, 1, (0 + time) % 1, 25, time);
            place("sprite311", canvas, ctx, [0.0461090087890625, 0.01918487548828125, -0.01918487548828125,
                0.0461090087890625, 5.35, -53.5
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite360", canvas, ctx, [0.047149658203125, -0.016485595703125, 0.016485595703125,
                0.047149658203125, 3.1, -41.7
            ], ctrans, 1, (0 + time) % 1, 25, time);
            place("sprite320", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -28.75, -97.0
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite324", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -41.6, -92.7
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("morphshape325", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -3.7, -34.75
            ], ctrans, 1, 0, 0, time);
            place("sprite333", canvas, ctx, [-0.0435150146484375, 0.023632049560546875, 0.023632049560546875,
                0.0435150146484375, 17.15, -22.95
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite335", canvas, ctx, [0.049410247802734376, 0.001399993896484375, -0.001399993896484375,
                0.049410247802734376, -16.3, -31.5
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite339", canvas, ctx, [0.02134246826171875, 0.04508056640625, -0.045079803466796874,
                0.021343231201171875, 23.6, -24.65
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite355", canvas, ctx, [0.049883270263671876, 5.8746337890625E-4, -5.8746337890625E-4,
                0.049883270263671876, -11.5, -16.4
            ], ctrans, 1, (0 + time) % 1, 24, time);
            break;
        case 28:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -22.85, -37.45
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.049999237060546875, -2.13623046875E-5, -2.13623046875E-5,
                0.049999237060546875, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04984130859375, -0.00331268310546875, 0.00331268310546875,
                0.04984130859375, 3.15, -13.5
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite307", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -27.45, -71.85
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite311", canvas, ctx, [0.047563934326171876, -0.01523895263671875, 0.01523895263671875,
                0.047563934326171876, -18.7, -49.85
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite360", canvas, ctx, [-0.047149658203125, -0.016485595703125, -0.016485595703125,
                0.047149658203125, -5.4, -41.7
            ], ctrans, 1, (0 + time) % 1, 25, time);
            place("sprite311", canvas, ctx, [0.0461090087890625, 0.01918487548828125, -0.01918487548828125,
                0.0461090087890625, 5.35, -53.5
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite360", canvas, ctx, [0.047149658203125, -0.016485595703125, 0.016485595703125,
                0.047149658203125, 3.1, -41.7
            ], ctrans, 1, (0 + time) % 1, 25, time);
            place("sprite320", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -28.75, -97.0
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite324", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -41.6, -92.7
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("morphshape325", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -3.7, -34.75
            ], ctrans, 1, 0, 0, time);
            place("sprite333", canvas, ctx, [-0.0435150146484375, 0.023632049560546875, 0.023632049560546875,
                0.0435150146484375, 17.15, -22.95
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite335", canvas, ctx, [0.049410247802734376, 0.001399993896484375, -0.001399993896484375,
                0.049410247802734376, -16.3, -31.5
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite339", canvas, ctx, [0.02134246826171875, 0.04508056640625, -0.045079803466796874,
                0.021343231201171875, 23.6, -24.65
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite355", canvas, ctx, [0.049883270263671876, 5.8746337890625E-4, -5.8746337890625E-4,
                0.049883270263671876, -11.5, -16.4
            ], ctrans, 1, (0 + time) % 1, 24, time);
            break;
        case 29:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -22.5, -37.1
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.049999237060546875, -2.13623046875E-5, -2.13623046875E-5,
                0.049999237060546875, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04984130859375, -0.00331268310546875, 0.00331268310546875,
                0.04984130859375, 3.15, -13.5
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite307", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -27.1, -71.5
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite311", canvas, ctx, [0.047563934326171876, -0.01523895263671875, 0.01523895263671875,
                0.047563934326171876, -18.35, -49.5
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite316", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -17.6, -45.6
            ], ctrans, 1, (0 + time) % 1, 29, time);
            place("sprite311", canvas, ctx, [0.0461090087890625, 0.01918487548828125, -0.01918487548828125,
                0.0461090087890625, 5.7, -53.15
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite316", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, 3.85, -45.35
            ], ctrans, 1, (0 + time) % 1, 29, time);
            place("sprite320", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -28.4, -96.65
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite324", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -41.25, -92.35
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("morphshape325", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -3.35, -34.4
            ], ctrans, 1, 0, 0, time);
            place("sprite333", canvas, ctx, [-0.043437957763671875, 0.02362823486328125, 0.02362823486328125,
                0.043437957763671875, 17.25, -23.05
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite335", canvas, ctx, [0.04934616088867187, -0.0031341552734375, 0.0031341552734375,
                0.04934616088867187, -17.8, -28.85
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite339", canvas, ctx, [0.02134246826171875, 0.04508056640625, -0.045079803466796874,
                0.021343231201171875, 23.6, -26.75
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite355", canvas, ctx, [0.049883270263671876, 5.8746337890625E-4, -5.8746337890625E-4,
                0.049883270263671876, -11.5, -17.1
            ], ctrans, 1, (0 + time) % 1, 24, time);
            break;
        case 30:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.049990081787109376, 7.04193115234375E-4, -7.04193115234375E-4,
                0.049990081787109376, -22.3, -37.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.049715423583984376, 0.00501861572265625, -0.00501861572265625,
                0.049715423583984376, 6.7, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.049715423583984376, 0.00501861572265625, -0.00501861572265625,
                0.049715423583984376, -6.75, -8.35
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.04999847412109375, -5.340576171875E-6, -5.340576171875E-6,
                0.04999847412109375, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.049832916259765624, -0.003278350830078125, 0.003278350830078125,
                0.049832916259765624, 3.1, -13.45
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite307", canvas, ctx, [0.049990081787109376, 7.04193115234375E-4, -7.04193115234375E-4,
                0.049990081787109376, -27.3, -71.65
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite311", canvas, ctx, [0.0474456787109375, -0.015453338623046875, 0.015453338623046875,
                0.0474456787109375, -18.35, -49.65
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite316", canvas, ctx, [0.049990081787109376, 7.04193115234375E-4, -7.04193115234375E-4,
                0.049990081787109376, -17.5, -45.8
            ], ctrans, 1, (0 + time) % 1, 29, time);
            place("sprite311", canvas, ctx, [0.04615936279296875, 0.018914031982421874, -0.018914031982421874,
                0.04615936279296875, 5.7, -53.6
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite316", canvas, ctx, [0.049990081787109376, 7.04193115234375E-4, -7.04193115234375E-4,
                0.049990081787109376, 3.9, -45.7
            ], ctrans, 1, (0 + time) % 1, 29, time);
            place("sprite320", canvas, ctx, [0.049990081787109376, 7.04193115234375E-4, -7.04193115234375E-4,
                0.049990081787109376, -28.65, -96.75
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite324", canvas, ctx, [0.049990081787109376, 7.04193115234375E-4, -7.04193115234375E-4,
                0.049990081787109376, -41.5, -92.35
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("morphshape325", canvas, ctx, [0.049990081787109376, 7.04193115234375E-4, -
                7.04193115234375E-4, 0.049990081787109376, -3.15, -34.7
            ], ctrans, 1, 0, 13107, time);
            place("sprite333", canvas, ctx, [-0.043437957763671875, 0.02362823486328125, 0.02362823486328125,
                0.043437957763671875, 17.25, -23.2
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite335", canvas, ctx, [0.049410247802734376, -0.0017791748046875, 0.0017791748046875,
                0.049410247802734376, -17.45, -29.65
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite339", canvas, ctx, [0.021292877197265626, 0.04503326416015625, -0.04503326416015625,
                0.02129364013671875, 23.75, -26.45
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite347", canvas, ctx, [-0.035799407958984376, -0.03438262939453125, -0.03438262939453125,
                0.035799407958984376, -1.05, -22.9
            ], ctrans, 1, (0 + time) % 1, 30, time);
            break;
        case 31:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.04999465942382812, 4.69970703125E-4, -4.69970703125E-4,
                0.04999465942382812, -22.2, -37.45
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.049715423583984376, 0.00501861572265625, -0.00501861572265625,
                0.049715423583984376, 6.7, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.049715423583984376, 0.00501861572265625, -0.00501861572265625,
                0.049715423583984376, -6.75, -8.35
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.04999847412109375, -5.340576171875E-6, -5.340576171875E-6,
                0.04999847412109375, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.049832916259765624, -0.003278350830078125, 0.003278350830078125,
                0.049832916259765624, 3.1, -13.45
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite307", canvas, ctx, [0.04999465942382812, 4.69970703125E-4, -4.69970703125E-4,
                0.04999465942382812, -27.4, -72.0
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite311", canvas, ctx, [0.0473724365234375, -0.0156768798828125, 0.0156768798828125,
                0.0473724365234375, -18.3, -49.95
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite316", canvas, ctx, [0.04999465942382812, 4.69970703125E-4, -4.69970703125E-4,
                0.04999465942382812, -17.4, -46.05
            ], ctrans, 1, (0 + time) % 1, 29, time);
            place("sprite311", canvas, ctx, [0.0463104248046875, 0.018544769287109374, -0.018544769287109374,
                0.0463104248046875, 5.75, -54.05
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite316", canvas, ctx, [0.04999465942382812, 4.69970703125E-4, -4.69970703125E-4,
                0.04999465942382812, 4.05, -46.1
            ], ctrans, 1, (0 + time) % 1, 29, time);
            place("sprite320", canvas, ctx, [0.04999465942382812, 4.69970703125E-4, -4.69970703125E-4,
                0.04999465942382812, -28.8, -96.95
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite324", canvas, ctx, [0.04999465942382812, 4.69970703125E-4, -4.69970703125E-4,
                0.04999465942382812, -41.65, -92.5
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("morphshape325", canvas, ctx, [0.04999465942382812, 4.69970703125E-4, -4.69970703125E-4,
                0.04999465942382812, -3.0, -35.05
            ], ctrans, 1, 0, 26214, time);
            place("sprite333", canvas, ctx, [-0.043437957763671875, 0.02362823486328125, 0.02362823486328125,
                0.043437957763671875, 17.3, -23.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite335", canvas, ctx, [0.04944610595703125, -6.72149658203125E-4, 6.72149658203125E-4,
                0.04944610595703125, -17.2, -30.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite339", canvas, ctx, [0.021292877197265626, 0.04503326416015625, -0.04503326416015625,
                0.02129364013671875, 23.9, -26.15
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite347", canvas, ctx, [-0.0376434326171875, -0.03231124877929688, -0.03231124877929688,
                0.0376434326171875, -1.1, -23.55
            ], ctrans, 1, (0 + time) % 1, 30, time);
            break;
        case 32:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.049997711181640626, 2.349853515625E-4, -2.349853515625E-4,
                0.049997711181640626, -22.0, -37.75
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.049715423583984376, 0.00501861572265625, -0.00501861572265625,
                0.049715423583984376, 6.7, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.049715423583984376, 0.00501861572265625, -0.00501861572265625,
                0.049715423583984376, -6.75, -8.35
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.04999847412109375, -5.340576171875E-6, -5.340576171875E-6,
                0.04999847412109375, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.049832916259765624, -0.003278350830078125, 0.003278350830078125,
                0.049832916259765624, 3.1, -13.45
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite307", canvas, ctx, [0.049997711181640626, 2.349853515625E-4, -2.349853515625E-4,
                0.049997711181640626, -27.55, -72.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite311", canvas, ctx, [0.04729766845703125, -0.015899658203125, 0.015899658203125,
                0.04729766845703125, -18.3, -50.05
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite316", canvas, ctx, [0.049997711181640626, 2.349853515625E-4, -2.349853515625E-4,
                0.049997711181640626, -17.25, -46.35
            ], ctrans, 1, (0 + time) % 1, 29, time);
            place("sprite311", canvas, ctx, [0.046398162841796875, 0.01832733154296875, -0.01832733154296875,
                0.046398162841796875, 5.8, -54.5
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite316", canvas, ctx, [0.049997711181640626, 2.349853515625E-4, -2.349853515625E-4,
                0.049997711181640626, 4.15, -46.45
            ], ctrans, 1, (0 + time) % 1, 29, time);
            place("sprite320", canvas, ctx, [0.049997711181640626, 2.349853515625E-4, -2.349853515625E-4,
                0.049997711181640626, -29.0, -97.2
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite324", canvas, ctx, [0.049997711181640626, 2.349853515625E-4, -2.349853515625E-4,
                0.049997711181640626, -41.75, -92.65
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("morphshape325", canvas, ctx, [0.049997711181640626, 2.349853515625E-4, -2.349853515625E-4,
                0.049997711181640626, -2.8, -35.4
            ], ctrans, 1, 0, 39322, time);
            place("sprite333", canvas, ctx, [-0.043437957763671875, 0.02362823486328125, 0.02362823486328125,
                0.043437957763671875, 17.3, -23.45
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite335", canvas, ctx, [0.0494537353515625, 4.35638427734375E-4, -4.35638427734375E-4,
                0.0494537353515625, -16.85, -30.95
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite339", canvas, ctx, [0.021292877197265626, 0.04503326416015625, -0.04503326416015625,
                0.02129364013671875, 24.1, -25.9
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite347", canvas, ctx, [-0.03934478759765625, -0.030307769775390625, -0.030307769775390625,
                0.03934478759765625, -1.15, -24.25
            ], ctrans, 1, (0 + time) % 1, 30, time);
            break;
        case 33:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -21.9, -38.0], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.049999237060546875, -2.13623046875E-5, -2.13623046875E-5,
                0.049999237060546875, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04984130859375, -0.00331268310546875, 0.00331268310546875,
                0.04984130859375, 3.15, -13.5
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite307", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -27.3, -72.25], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite311", canvas, ctx, [0.0472076416015625, -0.01631927490234375, 0.01631927490234375,
                0.0472076416015625, -18.05, -50.5
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite316", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -17.2, -46.6], ctrans, 1, (0 + time) % 1, 29,
                time);
            place("sprite311", canvas, ctx, [0.0465362548828125, 0.0181304931640625, -0.0181304931640625,
                0.0465362548828125, 5.9, -54.65
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite316", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 4.25, -46.85], ctrans, 1, (0 + time) % 1, 29,
                time);
            place("sprite320", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -29.15, -97.35], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite324", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -41.9, -92.8], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("morphshape325", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -2.7, -35.7], ctrans, 1, 0, 0, time);
            place("sprite333", canvas, ctx, [-0.0435150146484375, 0.023632049560546875, 0.023632049560546875,
                0.0435150146484375, 17.15, -23.65
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite335", canvas, ctx, [0.04943389892578125, 0.001647186279296875, -0.001647186279296875,
                0.04943389892578125, -16.3, -31.6
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite339", canvas, ctx, [0.02134246826171875, 0.04508056640625, -0.045079803466796874,
                0.021343231201171875, 24.3, -25.7
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite347", canvas, ctx, [-0.04101409912109375, -0.028243255615234376, -0.028243255615234376,
                0.04101409912109375, -1.15, -24.85
            ], ctrans, 1, (0 + time) % 1, 30, time);
            break;
        case 34:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -23.65, -32.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.049999237060546875, -2.13623046875E-5, -2.13623046875E-5,
                0.049999237060546875, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04984130859375, -0.00331268310546875, 0.00331268310546875,
                0.04984130859375, 3.15, -13.5
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite367", canvas, ctx, [0.03296966552734375, -0.0373687744140625, 0.0373687744140625,
                0.03296966552734375, 10.3, -20.5
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite335", canvas, ctx, [0.0498504638671875, 0.002129364013671875, -0.002129364013671875,
                0.0498504638671875, -23.25, -31.95
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite371", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -35.15, -59.95
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite375", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -19.15, -37.15
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("shape376", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite375", canvas, ctx, [-0.049730682373046876, 0.00501708984375, 0.00501708984375,
                0.049730682373046876, 11.8, -39.8
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("shape377", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite381", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -38.95, -86.2
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite385", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -47.9, -77.55
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite339", canvas, ctx, [0.049657440185546874, 0.005632781982421875, -0.00563201904296875,
                0.049657440185546874, 9.95, -24.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite394", canvas, ctx, [0.04440231323242187, 0.02247314453125, -0.02247314453125,
                0.04440231323242187, -12.4, -19.85
            ], ctrans, 1, (0 + time) % 1, 34, time);
            break;
        case 35:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -23.65, -32.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.049707794189453126, 0.0050140380859375, -0.0050140380859375,
                0.049707794189453126, 6.7, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.049707794189453126, 0.0050140380859375, -0.0050140380859375,
                0.049707794189453126, -6.75, -8.35
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.04999847412109375, -3.0517578125E-6, -3.0517578125E-6,
                0.04999847412109375, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04982833862304688, -0.0032745361328125, 0.0032745361328125,
                0.04982833862304688, 3.05, -13.4
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite367", canvas, ctx, [0.03296966552734375, -0.0373687744140625, 0.0373687744140625,
                0.03296966552734375, 10.3, -20.5
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite335", canvas, ctx, [0.0498504638671875, 0.002129364013671875, -0.002129364013671875,
                0.0498504638671875, -23.25, -31.95
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite371", canvas, ctx, [0.049810791015625, -0.00395050048828125, 0.00395050048828125,
                0.049810791015625, -34.45, -60.2
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite375", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -19.15, -37.15
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("shape376", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite375", canvas, ctx, [-0.049730682373046876, 0.00501708984375, 0.00501708984375,
                0.049730682373046876, 11.8, -39.8
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("shape377", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite381", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -38.95, -86.2
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite385", canvas, ctx, [0.049810791015625, -0.00395050048828125, 0.00395050048828125,
                0.049810791015625, -46.65, -78.2
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite339", canvas, ctx, [0.049657440185546874, 0.005632781982421875, -0.00563201904296875,
                0.049657440185546874, 9.95, -24.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite394", canvas, ctx, [0.04440231323242187, 0.02247314453125, -0.02247314453125,
                0.04440231323242187, -12.4, -19.85
            ], ctrans, 1, (0 + time) % 1, 34, time);
            break;
        case 36:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.049883270263671876, -0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, -23.2, -31.95
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.049715423583984376, 0.00501861572265625, -0.00501861572265625,
                0.049715423583984376, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.049715423583984376, 0.00501861572265625, -0.00501861572265625,
                0.049715423583984376, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.04999847412109375, -5.340576171875E-6, -5.340576171875E-6,
                0.04999847412109375, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04983367919921875, -0.003278350830078125, 0.003278350830078125,
                0.04983367919921875, 3.15, -13.45
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite367", canvas, ctx, [0.03296966552734375, -0.0373687744140625, 0.0373687744140625,
                0.03296966552734375, 10.3, -20.5
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite335", canvas, ctx, [0.0498504638671875, 0.002129364013671875, -0.002129364013671875,
                0.0498504638671875, -23.25, -30.55
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite401", canvas, ctx, [0.04594879150390625, 0.0193206787109375, -0.0193206787109375,
                0.04594879150390625, -14.5, -17.3
            ], ctrans, 1, (0 + time) % 1, 36, time);
            place("sprite371", canvas, ctx, [0.049883270263671876, -0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, -33.6, -60.1
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite375", canvas, ctx, [0.049883270263671876, -0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, -18.55, -37.0
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("shape402", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite375", canvas, ctx, [-0.049883270263671876, 0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, 12.5, -38.45
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("shape403", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite381", canvas, ctx, [0.049883270263671876, -0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, -36.35, -86.8
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite385", canvas, ctx, [0.049883270263671876, -0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, -45.65, -78.5
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite339", canvas, ctx, [0.049657440185546874, 0.005632781982421875, -0.00563201904296875,
                0.049657440185546874, 9.95, -22.9
            ], ctrans, 1, (0 + time) % 1, 0, time);
            break;
        case 37:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -23.65, -32.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.049999237060546875, -2.13623046875E-5, -2.13623046875E-5,
                0.049999237060546875, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04984130859375, -0.00331268310546875, 0.00331268310546875,
                0.04984130859375, 3.15, -13.5
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite367", canvas, ctx, [0.03296966552734375, -0.0373687744140625, 0.0373687744140625,
                0.03296966552734375, 10.3, -20.5
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite335", canvas, ctx, [0.0498504638671875, 0.002129364013671875, -0.002129364013671875,
                0.0498504638671875, -23.25, -31.95
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite371", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -35.15, -59.95
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite375", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -19.15, -37.15
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("shape376", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite375", canvas, ctx, [-0.049730682373046876, 0.00501708984375, 0.00501708984375,
                0.049730682373046876, 11.8, -39.8
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("shape377", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite381", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -38.95, -86.2
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite385", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -47.9, -77.55
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite339", canvas, ctx, [0.049657440185546874, 0.005632781982421875, -0.00563201904296875,
                0.049657440185546874, 9.95, -24.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite394", canvas, ctx, [0.04440231323242187, 0.02247314453125, -0.02247314453125,
                0.04440231323242187, -12.4, -19.85
            ], ctrans, 1, (0 + time) % 1, 37, time);
            break;
        case 38:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -23.65, -32.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.049999237060546875, -2.13623046875E-5, -2.13623046875E-5,
                0.049999237060546875, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04984130859375, -0.00331268310546875, 0.00331268310546875,
                0.04984130859375, 3.15, -13.5
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite367", canvas, ctx, [0.03296966552734375, -0.0373687744140625, 0.0373687744140625,
                0.03296966552734375, 10.3, -20.5
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite335", canvas, ctx, [0.0498504638671875, 0.002129364013671875, -0.002129364013671875,
                0.0498504638671875, -23.25, -31.95
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite371", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -35.15, -59.95
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite375", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -19.15, -37.15
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("shape376", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite375", canvas, ctx, [-0.049730682373046876, 0.00501708984375, 0.00501708984375,
                0.049730682373046876, 11.8, -39.8
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("shape377", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite381", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -38.95, -86.2
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite385", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -47.9, -77.55
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite339", canvas, ctx, [0.049657440185546874, 0.005632781982421875, -0.00563201904296875,
                0.049657440185546874, 9.95, -24.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite394", canvas, ctx, [0.04440231323242187, 0.02247314453125, -0.02247314453125,
                0.04440231323242187, -12.4, -19.85
            ], ctrans, 1, (0 + time) % 1, 37, time);
            break;
        case 39:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.049883270263671876, -0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, -23.2, -31.95
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.049715423583984376, 0.00501861572265625, -0.00501861572265625,
                0.049715423583984376, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.049715423583984376, 0.00501861572265625, -0.00501861572265625,
                0.049715423583984376, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.04999847412109375, -5.340576171875E-6, -5.340576171875E-6,
                0.04999847412109375, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04983367919921875, -0.003278350830078125, 0.003278350830078125,
                0.04983367919921875, 3.15, -13.45
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite367", canvas, ctx, [0.03296966552734375, -0.0373687744140625, 0.0373687744140625,
                0.03296966552734375, 10.3, -20.5
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite335", canvas, ctx, [0.0498504638671875, 0.002129364013671875, -0.002129364013671875,
                0.0498504638671875, -23.25, -30.55
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite401", canvas, ctx, [0.04594879150390625, 0.0193206787109375, -0.0193206787109375,
                0.04594879150390625, -14.5, -17.3
            ], ctrans, 1, (0 + time) % 1, 39, time);
            place("sprite371", canvas, ctx, [0.049883270263671876, -0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, -33.6, -60.1
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite375", canvas, ctx, [0.049883270263671876, -0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, -18.55, -37.0
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("shape402", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite375", canvas, ctx, [-0.049883270263671876, 0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, 12.5, -38.45
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("shape403", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite381", canvas, ctx, [0.049883270263671876, -0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, -36.35, -86.8
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite385", canvas, ctx, [0.049883270263671876, -0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, -45.65, -78.5
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite339", canvas, ctx, [0.049657440185546874, 0.005632781982421875, -0.00563201904296875,
                0.049657440185546874, 9.95, -22.9
            ], ctrans, 1, (0 + time) % 1, 0, time);
            break;
        case 40:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -23.65, -32.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.049999237060546875, -2.13623046875E-5, -2.13623046875E-5,
                0.049999237060546875, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04984130859375, -0.00331268310546875, 0.00331268310546875,
                0.04984130859375, 3.15, -13.5
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite367", canvas, ctx, [0.03296966552734375, -0.0373687744140625, 0.0373687744140625,
                0.03296966552734375, 10.3, -20.5
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite335", canvas, ctx, [0.0498504638671875, 0.002129364013671875, -0.002129364013671875,
                0.0498504638671875, -23.25, -31.95
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite371", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -35.15, -59.95
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite375", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -19.15, -37.15
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("shape376", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite375", canvas, ctx, [-0.049730682373046876, 0.00501708984375, 0.00501708984375,
                0.049730682373046876, 11.8, -39.8
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("shape377", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite381", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -38.95, -86.2
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite385", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -47.9, -77.55
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite339", canvas, ctx, [0.049657440185546874, 0.005632781982421875, -0.00563201904296875,
                0.049657440185546874, 9.95, -24.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite394", canvas, ctx, [0.04440231323242187, 0.02247314453125, -0.02247314453125,
                0.04440231323242187, -12.4, -19.85
            ], ctrans, 1, (0 + time) % 1, 40, time);
            break;
        case 41:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.049883270263671876, -0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, -23.2, -31.95
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.049715423583984376, 0.00501861572265625, -0.00501861572265625,
                0.049715423583984376, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.049715423583984376, 0.00501861572265625, -0.00501861572265625,
                0.049715423583984376, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.04999847412109375, -5.340576171875E-6, -5.340576171875E-6,
                0.04999847412109375, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04983367919921875, -0.003278350830078125, 0.003278350830078125,
                0.04983367919921875, 3.15, -13.45
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite367", canvas, ctx, [0.03296966552734375, -0.0373687744140625, 0.0373687744140625,
                0.03296966552734375, 10.3, -20.5
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite335", canvas, ctx, [0.0498504638671875, 0.002129364013671875, -0.002129364013671875,
                0.0498504638671875, -23.25, -30.55
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite401", canvas, ctx, [0.04594879150390625, 0.0193206787109375, -0.0193206787109375,
                0.04594879150390625, -14.5, -17.3
            ], ctrans, 1, (0 + time) % 1, 41, time);
            place("sprite371", canvas, ctx, [0.049883270263671876, -0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, -33.6, -60.1
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite375", canvas, ctx, [0.049883270263671876, -0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, -18.55, -37.0
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("shape402", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite375", canvas, ctx, [-0.049883270263671876, 0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, 12.5, -38.45
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("shape403", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite381", canvas, ctx, [0.049883270263671876, -0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, -36.35, -86.8
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite385", canvas, ctx, [0.049883270263671876, -0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, -45.65, -78.5
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite339", canvas, ctx, [0.049657440185546874, 0.005632781982421875, -0.00563201904296875,
                0.049657440185546874, 9.95, -22.9
            ], ctrans, 1, (0 + time) % 1, 0, time);
            break;
        case 42:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.049883270263671876, -0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, -23.2, -31.95
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.049715423583984376, 0.00501861572265625, -0.00501861572265625,
                0.049715423583984376, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.049715423583984376, 0.00501861572265625, -0.00501861572265625,
                0.049715423583984376, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.04999847412109375, -5.340576171875E-6, -5.340576171875E-6,
                0.04999847412109375, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04983367919921875, -0.003278350830078125, 0.003278350830078125,
                0.04983367919921875, 3.15, -13.45
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite367", canvas, ctx, [0.03296966552734375, -0.0373687744140625, 0.0373687744140625,
                0.03296966552734375, 10.3, -20.5
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite335", canvas, ctx, [0.0498504638671875, 0.002129364013671875, -0.002129364013671875,
                0.0498504638671875, -23.25, -30.55
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite401", canvas, ctx, [0.04594879150390625, 0.0193206787109375, -0.0193206787109375,
                0.04594879150390625, -14.5, -17.3
            ], ctrans, 1, (0 + time) % 1, 41, time);
            place("sprite371", canvas, ctx, [0.049883270263671876, -0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, -33.6, -60.1
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite375", canvas, ctx, [0.049883270263671876, -0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, -18.55, -37.0
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("shape402", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite375", canvas, ctx, [-0.049883270263671876, 0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, 12.5, -38.45
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("shape403", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite381", canvas, ctx, [0.049883270263671876, -0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, -36.35, -86.8
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite385", canvas, ctx, [0.049883270263671876, -0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, -45.65, -78.5
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite339", canvas, ctx, [0.049657440185546874, 0.005632781982421875, -0.00563201904296875,
                0.049657440185546874, 9.95, -22.9
            ], ctrans, 1, (0 + time) % 1, 0, time);
            break;
        case 43:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.049999237060546875, -2.13623046875E-5, -2.13623046875E-5,
                0.049999237060546875, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04984130859375, -0.00331268310546875, 0.00331268310546875,
                0.04984130859375, 3.15, -13.5
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite367", canvas, ctx, [0.03296966552734375, -0.0373687744140625, 0.0373687744140625,
                0.03296966552734375, 10.3, -17.7
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite335", canvas, ctx, [0.04926910400390625, 0.0080047607421875, -0.0080047607421875,
                0.04926910400390625, -21.0, -31.6
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite401", canvas, ctx, [0.04594879150390625, 0.0193206787109375, -0.0193206787109375,
                0.04594879150390625, -14.5, -17.3
            ], ctrans, 1, (0 + time) % 1, 41, time);
            place("sprite409", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -32.1, -85.6], ctrans, 1, (0 + time) % 1, 43,
                time);
            place("sprite413", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -42.5, -66.5], ctrans, 1, (0 + time) % 1, 43,
                time);
            place("sprite339", canvas, ctx, [0.049657440185546874, 0.005632781982421875, -0.00563201904296875,
                0.049657440185546874, 9.95, -21.5
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite394", canvas, ctx, [0.04719390869140625, 0.01606903076171875, -0.01606903076171875,
                0.04719390869140625, -12.4, -17.75
            ], ctrans, 1, (0 + time) % 1, 43, time);
            break;
        case 44:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.049999237060546875, -2.13623046875E-5, -2.13623046875E-5,
                0.049999237060546875, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04984130859375, -0.00331268310546875, 0.00331268310546875,
                0.04984130859375, 3.15, -13.5
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite367", canvas, ctx, [0.03296966552734375, -0.0373687744140625, 0.0373687744140625,
                0.03296966552734375, 10.3, -17.7
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite335", canvas, ctx, [0.04926910400390625, 0.0080047607421875, -0.0080047607421875,
                0.04926910400390625, -21.0, -31.6
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite401", canvas, ctx, [0.04594879150390625, 0.0193206787109375, -0.0193206787109375,
                0.04594879150390625, -14.5, -17.3
            ], ctrans, 1, (0 + time) % 1, 41, time);
            place("sprite409", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -32.1, -85.6], ctrans, 1, (0 + time) % 1, 43,
                time);
            place("sprite413", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -42.5, -66.5], ctrans, 1, (0 + time) % 1, 43,
                time);
            place("sprite339", canvas, ctx, [0.049657440185546874, 0.005632781982421875, -0.00563201904296875,
                0.049657440185546874, 9.95, -21.5
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite394", canvas, ctx, [0.04719390869140625, 0.01606903076171875, -0.01606903076171875,
                0.04719390869140625, -12.4, -17.75
            ], ctrans, 1, (0 + time) % 1, 43, time);
            break;
        case 45:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -23.65, -32.25
            ], ctrans, 1, (0 + time) % 1, 45, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.049999237060546875, -2.13623046875E-5, -2.13623046875E-5,
                0.049999237060546875, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04984130859375, -0.00331268310546875, 0.00331268310546875,
                0.04984130859375, 3.15, -13.5
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite367", canvas, ctx, [0.03296966552734375, -0.0373687744140625, 0.0373687744140625,
                0.03296966552734375, 10.3, -20.5
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite335", canvas, ctx, [0.0498504638671875, 0.002129364013671875, -0.002129364013671875,
                0.0498504638671875, -23.25, -31.95
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite371", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -35.15, -59.95
            ], ctrans, 1, (0 + time) % 1, 45, time);
            place("sprite375", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -19.15, -37.15
            ], ctrans, 1, (0 + time) % 1, 45, time);
            place("shape376", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite375", canvas, ctx, [-0.049730682373046876, 0.00501708984375, 0.00501708984375,
                0.049730682373046876, 11.8, -39.8
            ], ctrans, 1, (0 + time) % 1, 45, time);
            place("shape377", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite381", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -38.95, -86.2
            ], ctrans, 1, (0 + time) % 1, 45, time);
            place("sprite385", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -47.9, -77.55
            ], ctrans, 1, (0 + time) % 1, 45, time);
            place("sprite339", canvas, ctx, [0.049657440185546874, 0.005632781982421875, -0.00563201904296875,
                0.049657440185546874, 9.95, -24.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite394", canvas, ctx, [0.04440231323242187, 0.02247314453125, -0.02247314453125,
                0.04440231323242187, -12.4, -19.85
            ], ctrans, 1, (0 + time) % 1, 43, time);
            break;
        case 46:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -23.65, -32.25
            ], ctrans, 1, (0 + time) % 1, 45, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.049999237060546875, -2.13623046875E-5, -2.13623046875E-5,
                0.049999237060546875, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04984130859375, -0.00331268310546875, 0.00331268310546875,
                0.04984130859375, 3.15, -13.5
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite367", canvas, ctx, [0.03296966552734375, -0.0373687744140625, 0.0373687744140625,
                0.03296966552734375, 10.3, -20.5
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite335", canvas, ctx, [0.0498504638671875, 0.002129364013671875, -0.002129364013671875,
                0.0498504638671875, -23.25, -31.95
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite371", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -35.15, -59.95
            ], ctrans, 1, (0 + time) % 1, 45, time);
            place("sprite375", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -19.15, -37.15
            ], ctrans, 1, (0 + time) % 1, 45, time);
            place("shape376", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite375", canvas, ctx, [-0.049730682373046876, 0.00501708984375, 0.00501708984375,
                0.049730682373046876, 11.8, -39.8
            ], ctrans, 1, (0 + time) % 1, 45, time);
            place("shape377", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite381", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -38.95, -86.2
            ], ctrans, 1, (0 + time) % 1, 45, time);
            place("sprite385", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -47.9, -77.55
            ], ctrans, 1, (0 + time) % 1, 45, time);
            place("sprite339", canvas, ctx, [0.049657440185546874, 0.005632781982421875, -0.00563201904296875,
                0.049657440185546874, 9.95, -24.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite394", canvas, ctx, [0.04440231323242187, 0.02247314453125, -0.02247314453125,
                0.04440231323242187, -12.4, -19.85
            ], ctrans, 1, (0 + time) % 1, 43, time);
            break;
        case 47:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.049883270263671876, -0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, -23.2, -31.95
            ], ctrans, 1, (0 + time) % 1, 45, time);
            place("sprite292", canvas, ctx, [0.049715423583984376, 0.00501861572265625, -0.00501861572265625,
                0.049715423583984376, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.049715423583984376, 0.00501861572265625, -0.00501861572265625,
                0.049715423583984376, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.04999847412109375, -5.340576171875E-6, -5.340576171875E-6,
                0.04999847412109375, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04983367919921875, -0.003278350830078125, 0.003278350830078125,
                0.04983367919921875, 3.15, -13.45
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite367", canvas, ctx, [0.03296966552734375, -0.0373687744140625, 0.0373687744140625,
                0.03296966552734375, 10.3, -20.5
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite335", canvas, ctx, [0.0498504638671875, 0.002129364013671875, -0.002129364013671875,
                0.0498504638671875, -23.25, -30.55
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite401", canvas, ctx, [0.04594879150390625, 0.0193206787109375, -0.0193206787109375,
                0.04594879150390625, -14.5, -17.3
            ], ctrans, 1, (0 + time) % 1, 47, time);
            place("sprite371", canvas, ctx, [0.049883270263671876, -0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, -33.6, -60.1
            ], ctrans, 1, (0 + time) % 1, 45, time);
            place("sprite375", canvas, ctx, [0.049883270263671876, -0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, -18.55, -37.0
            ], ctrans, 1, (0 + time) % 1, 45, time);
            place("shape402", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite375", canvas, ctx, [-0.049883270263671876, 0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, 12.5, -38.45
            ], ctrans, 1, (0 + time) % 1, 45, time);
            place("shape403", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite381", canvas, ctx, [0.049883270263671876, -0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, -36.35, -86.8
            ], ctrans, 1, (0 + time) % 1, 45, time);
            place("sprite385", canvas, ctx, [0.049883270263671876, -0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, -45.65, -78.5
            ], ctrans, 1, (0 + time) % 1, 45, time);
            place("sprite339", canvas, ctx, [0.049657440185546874, 0.005632781982421875, -0.00563201904296875,
                0.049657440185546874, 9.95, -22.9
            ], ctrans, 1, (0 + time) % 1, 0, time);
            break;
        case 48:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -23.65, -32.25
            ], ctrans, 1, (0 + time) % 1, 45, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.049999237060546875, -2.13623046875E-5, -2.13623046875E-5,
                0.049999237060546875, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04984130859375, -0.00331268310546875, 0.00331268310546875,
                0.04984130859375, 3.15, -13.5
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite367", canvas, ctx, [0.03296966552734375, -0.0373687744140625, 0.0373687744140625,
                0.03296966552734375, 10.3, -20.5
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite335", canvas, ctx, [0.0498504638671875, 0.002129364013671875, -0.002129364013671875,
                0.0498504638671875, -23.25, -31.95
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite371", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -35.15, -59.95
            ], ctrans, 1, (0 + time) % 1, 45, time);
            place("sprite375", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -19.15, -37.15
            ], ctrans, 1, (0 + time) % 1, 45, time);
            place("shape376", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite375", canvas, ctx, [-0.049730682373046876, 0.00501708984375, 0.00501708984375,
                0.049730682373046876, 11.8, -39.8
            ], ctrans, 1, (0 + time) % 1, 45, time);
            place("shape377", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite381", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -38.95, -86.2
            ], ctrans, 1, (0 + time) % 1, 45, time);
            place("sprite385", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -47.9, -77.55
            ], ctrans, 1, (0 + time) % 1, 45, time);
            place("sprite339", canvas, ctx, [0.049657440185546874, 0.005632781982421875, -0.00563201904296875,
                0.049657440185546874, 9.95, -24.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite394", canvas, ctx, [0.04440231323242187, 0.02247314453125, -0.02247314453125,
                0.04440231323242187, -12.4, -19.85
            ], ctrans, 1, (0 + time) % 1, 48, time);
            break;
        case 49:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -23.65, -32.25
            ], ctrans, 1, (0 + time) % 1, 45, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.049999237060546875, -2.13623046875E-5, -2.13623046875E-5,
                0.049999237060546875, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04984130859375, -0.00331268310546875, 0.00331268310546875,
                0.04984130859375, 3.15, -13.5
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite367", canvas, ctx, [0.03296966552734375, -0.0373687744140625, 0.0373687744140625,
                0.03296966552734375, 10.3, -20.5
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite335", canvas, ctx, [0.0498504638671875, 0.002129364013671875, -0.002129364013671875,
                0.0498504638671875, -23.25, -31.95
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite371", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -35.15, -59.95
            ], ctrans, 1, (0 + time) % 1, 45, time);
            place("sprite375", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -19.15, -37.15
            ], ctrans, 1, (0 + time) % 1, 45, time);
            place("shape376", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite375", canvas, ctx, [-0.049730682373046876, 0.00501708984375, 0.00501708984375,
                0.049730682373046876, 11.8, -39.8
            ], ctrans, 1, (0 + time) % 1, 45, time);
            place("shape377", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite381", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -38.95, -86.2
            ], ctrans, 1, (0 + time) % 1, 45, time);
            place("sprite385", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -47.9, -77.55
            ], ctrans, 1, (0 + time) % 1, 45, time);
            place("sprite339", canvas, ctx, [0.049657440185546874, 0.005632781982421875, -0.00563201904296875,
                0.049657440185546874, 9.95, -24.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite394", canvas, ctx, [0.04440231323242187, 0.02247314453125, -0.02247314453125,
                0.04440231323242187, -12.4, -19.85
            ], ctrans, 1, (0 + time) % 1, 48, time);
            break;
        case 50:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.049883270263671876, -0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, -23.2, -31.95
            ], ctrans, 1, (0 + time) % 1, 45, time);
            place("sprite292", canvas, ctx, [0.049715423583984376, 0.00501861572265625, -0.00501861572265625,
                0.049715423583984376, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.049715423583984376, 0.00501861572265625, -0.00501861572265625,
                0.049715423583984376, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.04999847412109375, -5.340576171875E-6, -5.340576171875E-6,
                0.04999847412109375, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04983367919921875, -0.003278350830078125, 0.003278350830078125,
                0.04983367919921875, 3.15, -13.45
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite367", canvas, ctx, [0.03296966552734375, -0.0373687744140625, 0.0373687744140625,
                0.03296966552734375, 10.3, -20.5
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite335", canvas, ctx, [0.0498504638671875, 0.002129364013671875, -0.002129364013671875,
                0.0498504638671875, -23.25, -30.55
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite401", canvas, ctx, [0.04594879150390625, 0.0193206787109375, -0.0193206787109375,
                0.04594879150390625, -14.5, -17.3
            ], ctrans, 1, (0 + time) % 1, 50, time);
            place("sprite371", canvas, ctx, [0.049883270263671876, -0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, -33.6, -60.1
            ], ctrans, 1, (0 + time) % 1, 45, time);
            place("sprite375", canvas, ctx, [0.049883270263671876, -0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, -18.55, -37.0
            ], ctrans, 1, (0 + time) % 1, 45, time);
            place("shape402", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite375", canvas, ctx, [-0.049883270263671876, 0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, 12.5, -38.45
            ], ctrans, 1, (0 + time) % 1, 45, time);
            place("shape403", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite381", canvas, ctx, [0.049883270263671876, -0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, -36.35, -86.8
            ], ctrans, 1, (0 + time) % 1, 45, time);
            place("sprite385", canvas, ctx, [0.049883270263671876, -0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, -45.65, -78.5
            ], ctrans, 1, (0 + time) % 1, 45, time);
            place("sprite339", canvas, ctx, [0.049657440185546874, 0.005632781982421875, -0.00563201904296875,
                0.049657440185546874, 9.95, -22.9
            ], ctrans, 1, (0 + time) % 1, 0, time);
            break;
        case 51:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -23.65, -32.25
            ], ctrans, 1, (0 + time) % 1, 45, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.049999237060546875, -2.13623046875E-5, -2.13623046875E-5,
                0.049999237060546875, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04984130859375, -0.00331268310546875, 0.00331268310546875,
                0.04984130859375, 3.15, -13.5
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite367", canvas, ctx, [0.03296966552734375, -0.0373687744140625, 0.0373687744140625,
                0.03296966552734375, 10.3, -20.5
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite335", canvas, ctx, [0.0498504638671875, 0.002129364013671875, -0.002129364013671875,
                0.0498504638671875, -23.25, -31.95
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite371", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -35.15, -59.95
            ], ctrans, 1, (0 + time) % 1, 45, time);
            place("sprite375", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -19.15, -37.15
            ], ctrans, 1, (0 + time) % 1, 45, time);
            place("shape376", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite375", canvas, ctx, [-0.049730682373046876, 0.00501708984375, 0.00501708984375,
                0.049730682373046876, 11.8, -39.8
            ], ctrans, 1, (0 + time) % 1, 45, time);
            place("shape377", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite381", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -38.95, -86.2
            ], ctrans, 1, (0 + time) % 1, 45, time);
            place("sprite385", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -47.9, -77.55
            ], ctrans, 1, (0 + time) % 1, 45, time);
            place("sprite339", canvas, ctx, [0.049657440185546874, 0.005632781982421875, -0.00563201904296875,
                0.049657440185546874, 9.95, -24.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite394", canvas, ctx, [0.04440231323242187, 0.02247314453125, -0.02247314453125,
                0.04440231323242187, -12.4, -19.85
            ], ctrans, 1, (0 + time) % 1, 51, time);
            break;
        case 52:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.049883270263671876, -0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, -23.2, -31.95
            ], ctrans, 1, (0 + time) % 1, 45, time);
            place("sprite292", canvas, ctx, [0.049715423583984376, 0.00501861572265625, -0.00501861572265625,
                0.049715423583984376, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.049715423583984376, 0.00501861572265625, -0.00501861572265625,
                0.049715423583984376, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.04999847412109375, -5.340576171875E-6, -5.340576171875E-6,
                0.04999847412109375, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04983367919921875, -0.003278350830078125, 0.003278350830078125,
                0.04983367919921875, 3.15, -13.45
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite367", canvas, ctx, [0.03296966552734375, -0.0373687744140625, 0.0373687744140625,
                0.03296966552734375, 10.3, -20.5
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite335", canvas, ctx, [0.0498504638671875, 0.002129364013671875, -0.002129364013671875,
                0.0498504638671875, -23.25, -30.55
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite401", canvas, ctx, [0.04594879150390625, 0.0193206787109375, -0.0193206787109375,
                0.04594879150390625, -14.5, -17.3
            ], ctrans, 1, (0 + time) % 1, 52, time);
            place("sprite371", canvas, ctx, [0.049883270263671876, -0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, -33.6, -60.1
            ], ctrans, 1, (0 + time) % 1, 45, time);
            place("sprite375", canvas, ctx, [0.049883270263671876, -0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, -18.55, -37.0
            ], ctrans, 1, (0 + time) % 1, 45, time);
            place("shape402", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite375", canvas, ctx, [-0.049883270263671876, 0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, 12.5, -38.45
            ], ctrans, 1, (0 + time) % 1, 45, time);
            place("shape403", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite381", canvas, ctx, [0.049883270263671876, -0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, -36.35, -86.8
            ], ctrans, 1, (0 + time) % 1, 45, time);
            place("sprite385", canvas, ctx, [0.049883270263671876, -0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, -45.65, -78.5
            ], ctrans, 1, (0 + time) % 1, 45, time);
            place("sprite339", canvas, ctx, [0.049657440185546874, 0.005632781982421875, -0.00563201904296875,
                0.049657440185546874, 9.95, -22.9
            ], ctrans, 1, (0 + time) % 1, 0, time);
            break;
        case 53:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.049883270263671876, -0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, -23.2, -31.95
            ], ctrans, 1, (0 + time) % 1, 45, time);
            place("sprite292", canvas, ctx, [0.049715423583984376, 0.00501861572265625, -0.00501861572265625,
                0.049715423583984376, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.049715423583984376, 0.00501861572265625, -0.00501861572265625,
                0.049715423583984376, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.04999847412109375, -5.340576171875E-6, -5.340576171875E-6,
                0.04999847412109375, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04983367919921875, -0.003278350830078125, 0.003278350830078125,
                0.04983367919921875, 3.15, -13.45
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite367", canvas, ctx, [0.03296966552734375, -0.0373687744140625, 0.0373687744140625,
                0.03296966552734375, 10.3, -20.5
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite335", canvas, ctx, [0.0498504638671875, 0.002129364013671875, -0.002129364013671875,
                0.0498504638671875, -23.25, -30.55
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite401", canvas, ctx, [0.04594879150390625, 0.0193206787109375, -0.0193206787109375,
                0.04594879150390625, -14.5, -17.3
            ], ctrans, 1, (0 + time) % 1, 52, time);
            place("sprite371", canvas, ctx, [0.049883270263671876, -0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, -33.6, -60.1
            ], ctrans, 1, (0 + time) % 1, 45, time);
            place("sprite375", canvas, ctx, [0.049883270263671876, -0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, -18.55, -37.0
            ], ctrans, 1, (0 + time) % 1, 45, time);
            place("shape402", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite375", canvas, ctx, [-0.049883270263671876, 0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, 12.5, -38.45
            ], ctrans, 1, (0 + time) % 1, 45, time);
            place("shape403", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite381", canvas, ctx, [0.049883270263671876, -0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, -36.35, -86.8
            ], ctrans, 1, (0 + time) % 1, 45, time);
            place("sprite385", canvas, ctx, [0.049883270263671876, -0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, -45.65, -78.5
            ], ctrans, 1, (0 + time) % 1, 45, time);
            place("sprite339", canvas, ctx, [0.049657440185546874, 0.005632781982421875, -0.00563201904296875,
                0.049657440185546874, 9.95, -22.9
            ], ctrans, 1, (0 + time) % 1, 0, time);
            break;
        case 54:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.049999237060546875, -2.13623046875E-5, -2.13623046875E-5,
                0.049999237060546875, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04984130859375, -0.00331268310546875, 0.00331268310546875,
                0.04984130859375, 3.15, -13.5
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite367", canvas, ctx, [0.03296966552734375, -0.0373687744140625, 0.0373687744140625,
                0.03296966552734375, 10.3, -17.7
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite335", canvas, ctx, [0.04926910400390625, 0.0080047607421875, -0.0080047607421875,
                0.04926910400390625, -21.0, -31.6
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite401", canvas, ctx, [0.04594879150390625, 0.0193206787109375, -0.0193206787109375,
                0.04594879150390625, -14.5, -17.3
            ], ctrans, 1, (0 + time) % 1, 52, time);
            place("sprite409", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -32.1, -85.6], ctrans, 1, (0 + time) % 1, 54,
                time);
            place("sprite413", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -42.5, -66.5], ctrans, 1, (0 + time) % 1, 54,
                time);
            place("sprite339", canvas, ctx, [0.049657440185546874, 0.005632781982421875, -0.00563201904296875,
                0.049657440185546874, 9.95, -21.5
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite394", canvas, ctx, [0.04719390869140625, 0.01606903076171875, -0.01606903076171875,
                0.04719390869140625, -12.4, -17.75
            ], ctrans, 1, (0 + time) % 1, 54, time);
            break;
        case 55:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.049999237060546875, -2.13623046875E-5, -2.13623046875E-5,
                0.049999237060546875, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04984130859375, -0.00331268310546875, 0.00331268310546875,
                0.04984130859375, 3.15, -13.5
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite367", canvas, ctx, [0.03296966552734375, -0.0373687744140625, 0.0373687744140625,
                0.03296966552734375, 10.3, -17.7
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite335", canvas, ctx, [0.04926910400390625, 0.0080047607421875, -0.0080047607421875,
                0.04926910400390625, -21.0, -31.6
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite401", canvas, ctx, [0.04594879150390625, 0.0193206787109375, -0.0193206787109375,
                0.04594879150390625, -14.5, -17.3
            ], ctrans, 1, (0 + time) % 1, 52, time);
            place("sprite409", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -32.1, -85.6], ctrans, 1, (0 + time) % 1, 54,
                time);
            place("sprite413", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -42.5, -66.5], ctrans, 1, (0 + time) % 1, 54,
                time);
            place("sprite339", canvas, ctx, [0.049657440185546874, 0.005632781982421875, -0.00563201904296875,
                0.049657440185546874, 9.95, -21.5
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite394", canvas, ctx, [0.04719390869140625, 0.01606903076171875, -0.01606903076171875,
                0.04719390869140625, -12.4, -17.75
            ], ctrans, 1, (0 + time) % 1, 54, time);
            break;
        case 56:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -23.65, -32.25
            ], ctrans, 1, (0 + time) % 1, 56, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.049999237060546875, -2.13623046875E-5, -2.13623046875E-5,
                0.049999237060546875, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04984130859375, -0.00331268310546875, 0.00331268310546875,
                0.04984130859375, 3.15, -13.5
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite367", canvas, ctx, [0.03296966552734375, -0.0373687744140625, 0.0373687744140625,
                0.03296966552734375, 10.3, -20.5
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite335", canvas, ctx, [0.0498504638671875, 0.002129364013671875, -0.002129364013671875,
                0.0498504638671875, -23.25, -31.95
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite371", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -35.15, -59.95
            ], ctrans, 1, (0 + time) % 1, 56, time);
            place("sprite375", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -19.15, -37.15
            ], ctrans, 1, (0 + time) % 1, 56, time);
            place("shape376", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite375", canvas, ctx, [-0.049730682373046876, 0.00501708984375, 0.00501708984375,
                0.049730682373046876, 11.8, -39.8
            ], ctrans, 1, (0 + time) % 1, 56, time);
            place("shape377", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite381", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -38.95, -86.2
            ], ctrans, 1, (0 + time) % 1, 56, time);
            place("sprite385", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -47.9, -77.55
            ], ctrans, 1, (0 + time) % 1, 56, time);
            place("sprite339", canvas, ctx, [0.049657440185546874, 0.005632781982421875, -0.00563201904296875,
                0.049657440185546874, 9.95, -24.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite394", canvas, ctx, [0.04440231323242187, 0.02247314453125, -0.02247314453125,
                0.04440231323242187, -12.4, -19.85
            ], ctrans, 1, (0 + time) % 1, 54, time);
            break;
        case 57:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -23.65, -32.25
            ], ctrans, 1, (0 + time) % 1, 56, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.049999237060546875, -2.13623046875E-5, -2.13623046875E-5,
                0.049999237060546875, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04984130859375, -0.00331268310546875, 0.00331268310546875,
                0.04984130859375, 3.15, -13.5
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite367", canvas, ctx, [0.03296966552734375, -0.0373687744140625, 0.0373687744140625,
                0.03296966552734375, 10.3, -20.5
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite335", canvas, ctx, [0.0498504638671875, 0.002129364013671875, -0.002129364013671875,
                0.0498504638671875, -23.25, -31.95
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite371", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -35.15, -59.95
            ], ctrans, 1, (0 + time) % 1, 56, time);
            place("sprite375", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -19.15, -37.15
            ], ctrans, 1, (0 + time) % 1, 56, time);
            place("shape376", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite375", canvas, ctx, [-0.049730682373046876, 0.00501708984375, 0.00501708984375,
                0.049730682373046876, 11.8, -39.8
            ], ctrans, 1, (0 + time) % 1, 56, time);
            place("shape377", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite381", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -38.95, -86.2
            ], ctrans, 1, (0 + time) % 1, 56, time);
            place("sprite385", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -47.9, -77.55
            ], ctrans, 1, (0 + time) % 1, 56, time);
            place("sprite339", canvas, ctx, [0.049657440185546874, 0.005632781982421875, -0.00563201904296875,
                0.049657440185546874, 9.95, -24.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite394", canvas, ctx, [0.04440231323242187, 0.02247314453125, -0.02247314453125,
                0.04440231323242187, -12.4, -19.85
            ], ctrans, 1, (0 + time) % 1, 54, time);
            break;
        case 58:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.049883270263671876, -0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, -23.2, -31.95
            ], ctrans, 1, (0 + time) % 1, 56, time);
            place("sprite292", canvas, ctx, [0.049715423583984376, 0.00501861572265625, -0.00501861572265625,
                0.049715423583984376, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.049715423583984376, 0.00501861572265625, -0.00501861572265625,
                0.049715423583984376, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.04999847412109375, -5.340576171875E-6, -5.340576171875E-6,
                0.04999847412109375, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04983367919921875, -0.003278350830078125, 0.003278350830078125,
                0.04983367919921875, 3.15, -13.45
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite367", canvas, ctx, [0.03296966552734375, -0.0373687744140625, 0.0373687744140625,
                0.03296966552734375, 10.3, -20.5
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite335", canvas, ctx, [0.0498504638671875, 0.002129364013671875, -0.002129364013671875,
                0.0498504638671875, -23.25, -30.55
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite401", canvas, ctx, [0.04594879150390625, 0.0193206787109375, -0.0193206787109375,
                0.04594879150390625, -14.5, -17.3
            ], ctrans, 1, (0 + time) % 1, 58, time);
            place("sprite371", canvas, ctx, [0.049883270263671876, -0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, -33.6, -60.1
            ], ctrans, 1, (0 + time) % 1, 56, time);
            place("sprite375", canvas, ctx, [0.049883270263671876, -0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, -18.55, -37.0
            ], ctrans, 1, (0 + time) % 1, 56, time);
            place("shape402", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite375", canvas, ctx, [-0.049883270263671876, 0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, 12.5, -38.45
            ], ctrans, 1, (0 + time) % 1, 56, time);
            place("shape403", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite381", canvas, ctx, [0.049883270263671876, -0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, -36.35, -86.8
            ], ctrans, 1, (0 + time) % 1, 56, time);
            place("sprite385", canvas, ctx, [0.049883270263671876, -0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, -45.65, -78.5
            ], ctrans, 1, (0 + time) % 1, 56, time);
            place("sprite339", canvas, ctx, [0.049657440185546874, 0.005632781982421875, -0.00563201904296875,
                0.049657440185546874, 9.95, -22.9
            ], ctrans, 1, (0 + time) % 1, 0, time);
            break;
        case 59:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -23.65, -32.25
            ], ctrans, 1, (0 + time) % 1, 56, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.049999237060546875, -2.13623046875E-5, -2.13623046875E-5,
                0.049999237060546875, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04984130859375, -0.00331268310546875, 0.00331268310546875,
                0.04984130859375, 3.15, -13.5
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite367", canvas, ctx, [0.03296966552734375, -0.0373687744140625, 0.0373687744140625,
                0.03296966552734375, 10.3, -20.5
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite335", canvas, ctx, [0.0498504638671875, 0.002129364013671875, -0.002129364013671875,
                0.0498504638671875, -23.25, -31.95
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite371", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -35.15, -59.95
            ], ctrans, 1, (0 + time) % 1, 56, time);
            place("sprite375", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -19.15, -37.15
            ], ctrans, 1, (0 + time) % 1, 56, time);
            place("shape376", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite375", canvas, ctx, [-0.049730682373046876, 0.00501708984375, 0.00501708984375,
                0.049730682373046876, 11.8, -39.8
            ], ctrans, 1, (0 + time) % 1, 56, time);
            place("shape377", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite381", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -38.95, -86.2
            ], ctrans, 1, (0 + time) % 1, 56, time);
            place("sprite385", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -47.9, -77.55
            ], ctrans, 1, (0 + time) % 1, 56, time);
            place("sprite339", canvas, ctx, [0.049657440185546874, 0.005632781982421875, -0.00563201904296875,
                0.049657440185546874, 9.95, -24.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite394", canvas, ctx, [0.04440231323242187, 0.02247314453125, -0.02247314453125,
                0.04440231323242187, -12.4, -19.85
            ], ctrans, 1, (0 + time) % 1, 59, time);
            break;
        case 60:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -23.65, -32.25
            ], ctrans, 1, (0 + time) % 1, 56, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.049999237060546875, -2.13623046875E-5, -2.13623046875E-5,
                0.049999237060546875, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04984130859375, -0.00331268310546875, 0.00331268310546875,
                0.04984130859375, 3.15, -13.5
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite367", canvas, ctx, [0.03296966552734375, -0.0373687744140625, 0.0373687744140625,
                0.03296966552734375, 10.3, -20.5
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite335", canvas, ctx, [0.0498504638671875, 0.002129364013671875, -0.002129364013671875,
                0.0498504638671875, -23.25, -31.95
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite371", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -35.15, -59.95
            ], ctrans, 1, (0 + time) % 1, 56, time);
            place("sprite375", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -19.15, -37.15
            ], ctrans, 1, (0 + time) % 1, 56, time);
            place("shape376", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite375", canvas, ctx, [-0.049730682373046876, 0.00501708984375, 0.00501708984375,
                0.049730682373046876, 11.8, -39.8
            ], ctrans, 1, (0 + time) % 1, 56, time);
            place("shape377", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite381", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -38.95, -86.2
            ], ctrans, 1, (0 + time) % 1, 56, time);
            place("sprite385", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -47.9, -77.55
            ], ctrans, 1, (0 + time) % 1, 56, time);
            place("sprite339", canvas, ctx, [0.049657440185546874, 0.005632781982421875, -0.00563201904296875,
                0.049657440185546874, 9.95, -24.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite394", canvas, ctx, [0.04440231323242187, 0.02247314453125, -0.02247314453125,
                0.04440231323242187, -12.4, -19.85
            ], ctrans, 1, (0 + time) % 1, 59, time);
            break;
        case 61:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.049883270263671876, -0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, -23.2, -31.95
            ], ctrans, 1, (0 + time) % 1, 56, time);
            place("sprite292", canvas, ctx, [0.049715423583984376, 0.00501861572265625, -0.00501861572265625,
                0.049715423583984376, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.049715423583984376, 0.00501861572265625, -0.00501861572265625,
                0.049715423583984376, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.04999847412109375, -5.340576171875E-6, -5.340576171875E-6,
                0.04999847412109375, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04983367919921875, -0.003278350830078125, 0.003278350830078125,
                0.04983367919921875, 3.15, -13.45
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite367", canvas, ctx, [0.03296966552734375, -0.0373687744140625, 0.0373687744140625,
                0.03296966552734375, 10.3, -20.5
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite335", canvas, ctx, [0.0498504638671875, 0.002129364013671875, -0.002129364013671875,
                0.0498504638671875, -23.25, -30.55
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite401", canvas, ctx, [0.04594879150390625, 0.0193206787109375, -0.0193206787109375,
                0.04594879150390625, -14.5, -17.3
            ], ctrans, 1, (0 + time) % 1, 61, time);
            place("sprite371", canvas, ctx, [0.049883270263671876, -0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, -33.6, -60.1
            ], ctrans, 1, (0 + time) % 1, 56, time);
            place("sprite375", canvas, ctx, [0.049883270263671876, -0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, -18.55, -37.0
            ], ctrans, 1, (0 + time) % 1, 56, time);
            place("shape402", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite375", canvas, ctx, [-0.049883270263671876, 0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, 12.5, -38.45
            ], ctrans, 1, (0 + time) % 1, 56, time);
            place("shape403", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite381", canvas, ctx, [0.049883270263671876, -0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, -36.35, -86.8
            ], ctrans, 1, (0 + time) % 1, 56, time);
            place("sprite385", canvas, ctx, [0.049883270263671876, -0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, -45.65, -78.5
            ], ctrans, 1, (0 + time) % 1, 56, time);
            place("sprite339", canvas, ctx, [0.049657440185546874, 0.005632781982421875, -0.00563201904296875,
                0.049657440185546874, 9.95, -22.9
            ], ctrans, 1, (0 + time) % 1, 0, time);
            break;
        case 62:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -23.65, -32.25
            ], ctrans, 1, (0 + time) % 1, 56, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.049999237060546875, -2.13623046875E-5, -2.13623046875E-5,
                0.049999237060546875, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04984130859375, -0.00331268310546875, 0.00331268310546875,
                0.04984130859375, 3.15, -13.5
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite367", canvas, ctx, [0.03296966552734375, -0.0373687744140625, 0.0373687744140625,
                0.03296966552734375, 10.3, -20.5
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite335", canvas, ctx, [0.0498504638671875, 0.002129364013671875, -0.002129364013671875,
                0.0498504638671875, -23.25, -31.95
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite371", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -35.15, -59.95
            ], ctrans, 1, (0 + time) % 1, 56, time);
            place("sprite375", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -19.15, -37.15
            ], ctrans, 1, (0 + time) % 1, 56, time);
            place("shape376", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite375", canvas, ctx, [-0.049730682373046876, 0.00501708984375, 0.00501708984375,
                0.049730682373046876, 11.8, -39.8
            ], ctrans, 1, (0 + time) % 1, 56, time);
            place("shape377", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite381", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -38.95, -86.2
            ], ctrans, 1, (0 + time) % 1, 56, time);
            place("sprite385", canvas, ctx, [0.049730682373046876, -0.00501708984375, 0.00501708984375,
                0.049730682373046876, -47.9, -77.55
            ], ctrans, 1, (0 + time) % 1, 56, time);
            place("sprite339", canvas, ctx, [0.049657440185546874, 0.005632781982421875, -0.00563201904296875,
                0.049657440185546874, 9.95, -24.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite394", canvas, ctx, [0.04440231323242187, 0.02247314453125, -0.02247314453125,
                0.04440231323242187, -12.4, -19.85
            ], ctrans, 1, (0 + time) % 1, 62, time);
            break;
        case 63:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.049883270263671876, -0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, -23.2, -31.95
            ], ctrans, 1, (0 + time) % 1, 56, time);
            place("sprite292", canvas, ctx, [0.049715423583984376, 0.00501861572265625, -0.00501861572265625,
                0.049715423583984376, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.049715423583984376, 0.00501861572265625, -0.00501861572265625,
                0.049715423583984376, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.04999847412109375, -5.340576171875E-6, -5.340576171875E-6,
                0.04999847412109375, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04983367919921875, -0.003278350830078125, 0.003278350830078125,
                0.04983367919921875, 3.15, -13.45
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite367", canvas, ctx, [0.03296966552734375, -0.0373687744140625, 0.0373687744140625,
                0.03296966552734375, 10.3, -20.5
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite335", canvas, ctx, [0.0498504638671875, 0.002129364013671875, -0.002129364013671875,
                0.0498504638671875, -23.25, -30.55
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite401", canvas, ctx, [0.04594879150390625, 0.0193206787109375, -0.0193206787109375,
                0.04594879150390625, -14.5, -17.3
            ], ctrans, 1, (0 + time) % 1, 63, time);
            place("sprite371", canvas, ctx, [0.049883270263671876, -0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, -33.6, -60.1
            ], ctrans, 1, (0 + time) % 1, 56, time);
            place("sprite375", canvas, ctx, [0.049883270263671876, -0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, -18.55, -37.0
            ], ctrans, 1, (0 + time) % 1, 56, time);
            place("shape402", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite375", canvas, ctx, [-0.049883270263671876, 0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, 12.5, -38.45
            ], ctrans, 1, (0 + time) % 1, 56, time);
            place("shape403", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite381", canvas, ctx, [0.049883270263671876, -0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, -36.35, -86.8
            ], ctrans, 1, (0 + time) % 1, 56, time);
            place("sprite385", canvas, ctx, [0.049883270263671876, -0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, -45.65, -78.5
            ], ctrans, 1, (0 + time) % 1, 56, time);
            place("sprite339", canvas, ctx, [0.049657440185546874, 0.005632781982421875, -0.00563201904296875,
                0.049657440185546874, 9.95, -22.9
            ], ctrans, 1, (0 + time) % 1, 0, time);
            break;
        case 64:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.049883270263671876, -0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, -23.2, -31.95
            ], ctrans, 1, (0 + time) % 1, 56, time);
            place("sprite292", canvas, ctx, [0.049715423583984376, 0.00501861572265625, -0.00501861572265625,
                0.049715423583984376, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.049715423583984376, 0.00501861572265625, -0.00501861572265625,
                0.049715423583984376, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.04999847412109375, -5.340576171875E-6, -5.340576171875E-6,
                0.04999847412109375, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04983367919921875, -0.003278350830078125, 0.003278350830078125,
                0.04983367919921875, 3.15, -13.45
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite367", canvas, ctx, [0.03296966552734375, -0.0373687744140625, 0.0373687744140625,
                0.03296966552734375, 10.3, -20.5
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite335", canvas, ctx, [0.0498504638671875, 0.002129364013671875, -0.002129364013671875,
                0.0498504638671875, -23.25, -30.55
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite401", canvas, ctx, [0.04594879150390625, 0.0193206787109375, -0.0193206787109375,
                0.04594879150390625, -14.5, -17.3
            ], ctrans, 1, (0 + time) % 1, 63, time);
            place("sprite371", canvas, ctx, [0.049883270263671876, -0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, -33.6, -60.1
            ], ctrans, 1, (0 + time) % 1, 56, time);
            place("sprite375", canvas, ctx, [0.049883270263671876, -0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, -18.55, -37.0
            ], ctrans, 1, (0 + time) % 1, 56, time);
            place("shape402", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite375", canvas, ctx, [-0.049883270263671876, 0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, 12.5, -38.45
            ], ctrans, 1, (0 + time) % 1, 56, time);
            place("shape403", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite381", canvas, ctx, [0.049883270263671876, -0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, -36.35, -86.8
            ], ctrans, 1, (0 + time) % 1, 56, time);
            place("sprite385", canvas, ctx, [0.049883270263671876, -0.0030487060546875, 0.0030487060546875,
                0.049883270263671876, -45.65, -78.5
            ], ctrans, 1, (0 + time) % 1, 56, time);
            place("sprite339", canvas, ctx, [0.049657440185546874, 0.005632781982421875, -0.00563201904296875,
                0.049657440185546874, 9.95, -22.9
            ], ctrans, 1, (0 + time) % 1, 0, time);
            break;
        case 65:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.049999237060546875, -2.13623046875E-5, -2.13623046875E-5,
                0.049999237060546875, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04984130859375, -0.00331268310546875, 0.00331268310546875,
                0.04984130859375, 3.15, -13.5
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite367", canvas, ctx, [0.03296966552734375, -0.0373687744140625, 0.0373687744140625,
                0.03296966552734375, 10.3, -17.7
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite335", canvas, ctx, [0.04926910400390625, 0.0080047607421875, -0.0080047607421875,
                0.04926910400390625, -21.0, -31.6
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite401", canvas, ctx, [0.04594879150390625, 0.0193206787109375, -0.0193206787109375,
                0.04594879150390625, -14.5, -17.3
            ], ctrans, 1, (0 + time) % 1, 63, time);
            place("sprite409", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -32.1, -85.6], ctrans, 1, (0 + time) % 1, 65,
                time);
            place("sprite413", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -42.5, -66.5], ctrans, 1, (0 + time) % 1, 65,
                time);
            place("sprite339", canvas, ctx, [0.049657440185546874, 0.005632781982421875, -0.00563201904296875,
                0.049657440185546874, 9.95, -21.5
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite394", canvas, ctx, [0.04719390869140625, 0.01606903076171875, -0.01606903076171875,
                0.04719390869140625, -12.4, -17.75
            ], ctrans, 1, (0 + time) % 1, 65, time);
            break;
        case 66:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.049999237060546875, -2.13623046875E-5, -2.13623046875E-5,
                0.049999237060546875, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04984130859375, -0.00331268310546875, 0.00331268310546875,
                0.04984130859375, 3.15, -13.5
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite367", canvas, ctx, [0.03296966552734375, -0.0373687744140625, 0.0373687744140625,
                0.03296966552734375, 10.3, -17.7
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite335", canvas, ctx, [0.04926910400390625, 0.0080047607421875, -0.0080047607421875,
                0.04926910400390625, -21.0, -31.6
            ], ctrans, 1, (0 + time) % 1, 34, time);
            place("sprite401", canvas, ctx, [0.04594879150390625, 0.0193206787109375, -0.0193206787109375,
                0.04594879150390625, -14.5, -17.3
            ], ctrans, 1, (0 + time) % 1, 63, time);
            place("sprite409", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -32.1, -85.6], ctrans, 1, (0 + time) % 1, 65,
                time);
            place("sprite413", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -42.5, -66.5], ctrans, 1, (0 + time) % 1, 65,
                time);
            place("sprite339", canvas, ctx, [0.049657440185546874, 0.005632781982421875, -0.00563201904296875,
                0.049657440185546874, 9.95, -21.5
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite394", canvas, ctx, [0.04719390869140625, 0.01606903076171875, -0.01606903076171875,
                0.04719390869140625, -12.4, -17.75
            ], ctrans, 1, (0 + time) % 1, 65, time);
            break;
        case 67:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.049999237060546875, -2.13623046875E-5, -2.13623046875E-5,
                0.049999237060546875, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04984130859375, -0.00331268310546875, 0.00331268310546875,
                0.04984130859375, 2.85, -13.5
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite371", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -29.25, -66.85], ctrans, 1, (0 + time) % 1,
                67, time);
            place("sprite375", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -15.55, -42.55], ctrans, 1, (0 + time) % 1,
                67, time);
            place("shape414", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite375", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 15.5, -42.05], ctrans, 1, (0 + time) % 1,
                67, time);
            place("shape415", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite381", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -30.35, -93.35], ctrans, 1, (0 + time) % 1,
                67, time);
            place("sprite385", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -40.15, -85.65], ctrans, 1, (0 + time) % 1,
                67, time);
            place("sprite333", canvas, ctx, [-0.020458221435546875, 0.04518280029296875, 0.04518280029296875,
                0.020458221435546875, 16.7, -27.0
            ], ctrans, 1, (0 + time) % 1, 67, time);
            place("sprite335", canvas, ctx, [0.04918670654296875, -0.00550994873046875, 0.00550994873046875,
                0.04918670654296875, -18.5, -30.65
            ], ctrans, 1, (0 + time) % 1, 67, time);
            place("sprite339", canvas, ctx, [0.028905487060546874, 0.040682220458984376, -0.04068145751953125,
                0.02890625, 23.95, -33.05
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite401", canvas, ctx, [0.0398529052734375, 0.02942962646484375, -0.02942962646484375,
                0.0398529052734375, -11.95, -21.4
            ], ctrans, 1, (0 + time) % 1, 67, time);
            break;
        case 68:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -21.9, -38.0], ctrans, 1, (0 + time) % 1, 68,
                time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.049999237060546875, -2.13623046875E-5, -2.13623046875E-5,
                0.049999237060546875, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04984130859375, -0.00331268310546875, 0.00331268310546875,
                0.04984130859375, 3.15, -13.5
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite307", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -27.3, -72.25], ctrans, 1, (0 + time) % 1,
                68, time);
            place("sprite311", canvas, ctx, [0.0472076416015625, -0.01631927490234375, 0.01631927490234375,
                0.0472076416015625, -18.05, -50.5
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite316", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -17.2, -46.6], ctrans, 1, (0 + time) % 1, 68,
                time);
            place("sprite311", canvas, ctx, [0.0465362548828125, 0.0181304931640625, -0.0181304931640625,
                0.0465362548828125, 5.9, -54.65
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite316", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 4.25, -46.85], ctrans, 1, (0 + time) % 1, 68,
                time);
            place("sprite320", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -29.15, -97.35], ctrans, 1, (0 + time) % 1,
                68, time);
            place("sprite324", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -41.9, -92.8], ctrans, 1, (0 + time) % 1, 68,
                time);
            place("morphshape325", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -2.7, -35.7], ctrans, 1, 0, 0, time);
            place("sprite333", canvas, ctx, [-0.0435150146484375, 0.023632049560546875, 0.023632049560546875,
                0.0435150146484375, 17.15, -23.65
            ], ctrans, 1, (0 + time) % 1, 67, time);
            place("sprite335", canvas, ctx, [0.04943389892578125, 0.001647186279296875, -0.001647186279296875,
                0.04943389892578125, -16.3, -31.6
            ], ctrans, 1, (0 + time) % 1, 67, time);
            place("sprite339", canvas, ctx, [0.02134246826171875, 0.04508056640625, -0.045079803466796874,
                0.021343231201171875, 24.3, -25.7
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite347", canvas, ctx, [-0.04101409912109375, -0.028243255615234376, -0.028243255615234376,
                0.04101409912109375, -1.15, -24.85
            ], ctrans, 1, (0 + time) % 1, 68, time);
            break;
        case 69:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -21.9, -38.0], ctrans, 1, (0 + time) % 1, 68,
                time);
            place("sprite292", canvas, ctx, [0.049715423583984376, 0.00501861572265625, -0.00501861572265625,
                0.049715423583984376, 6.7, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.049715423583984376, 0.00501861572265625, -0.00501861572265625,
                0.049715423583984376, -6.75, -8.35
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.04999847412109375, -5.340576171875E-6, -5.340576171875E-6,
                0.04999847412109375, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.049832916259765624, -0.003278350830078125, 0.003278350830078125,
                0.049832916259765624, 3.1, -13.45
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite307", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -27.3, -72.25], ctrans, 1, (0 + time) % 1,
                68, time);
            place("sprite311", canvas, ctx, [0.0472076416015625, -0.01631927490234375, 0.01631927490234375,
                0.0472076416015625, -18.05, -50.5
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite316", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -17.2, -46.6], ctrans, 1, (0 + time) % 1, 68,
                time);
            place("sprite311", canvas, ctx, [0.0465362548828125, 0.0181304931640625, -0.0181304931640625,
                0.0465362548828125, 5.9, -54.65
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite316", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 4.25, -46.85], ctrans, 1, (0 + time) % 1, 68,
                time);
            place("sprite320", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -29.15, -97.35], ctrans, 1, (0 + time) % 1,
                68, time);
            place("sprite324", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -41.9, -92.8], ctrans, 1, (0 + time) % 1, 68,
                time);
            place("morphshape325", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -2.7, -35.7], ctrans, 1, 0, 13107, time);
            place("sprite333", canvas, ctx, [-0.0435150146484375, 0.023632049560546875, 0.023632049560546875,
                0.0435150146484375, 17.15, -23.65
            ], ctrans, 1, (0 + time) % 1, 67, time);
            place("sprite335", canvas, ctx, [0.04943389892578125, 0.001647186279296875, -0.001647186279296875,
                0.04943389892578125, -16.3, -31.6
            ], ctrans, 1, (0 + time) % 1, 67, time);
            place("sprite339", canvas, ctx, [0.02134246826171875, 0.04508056640625, -0.045079803466796874,
                0.021343231201171875, 24.3, -25.7
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite347", canvas, ctx, [-0.04101409912109375, -0.028243255615234376, -0.028243255615234376,
                0.04101409912109375, -1.15, -24.85
            ], ctrans, 1, (0 + time) % 1, 68, time);
            break;
        case 70:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -21.9, -38.0], ctrans, 1, (0 + time) % 1, 68,
                time);
            place("sprite292", canvas, ctx, [0.049715423583984376, 0.00501861572265625, -0.00501861572265625,
                0.049715423583984376, 6.7, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.049715423583984376, 0.00501861572265625, -0.00501861572265625,
                0.049715423583984376, -6.75, -8.35
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.04999847412109375, -5.340576171875E-6, -5.340576171875E-6,
                0.04999847412109375, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.049832916259765624, -0.003278350830078125, 0.003278350830078125,
                0.049832916259765624, 3.1, -13.45
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite307", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -27.3, -72.25], ctrans, 1, (0 + time) % 1,
                68, time);
            place("sprite311", canvas, ctx, [0.0472076416015625, -0.01631927490234375, 0.01631927490234375,
                0.0472076416015625, -18.05, -50.5
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite316", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -17.2, -46.6], ctrans, 1, (0 + time) % 1, 68,
                time);
            place("sprite311", canvas, ctx, [0.0465362548828125, 0.0181304931640625, -0.0181304931640625,
                0.0465362548828125, 5.9, -54.65
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite316", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 4.25, -46.85], ctrans, 1, (0 + time) % 1, 68,
                time);
            place("sprite320", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -29.15, -97.35], ctrans, 1, (0 + time) % 1,
                68, time);
            place("sprite324", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -41.9, -92.8], ctrans, 1, (0 + time) % 1, 68,
                time);
            place("morphshape325", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -2.7, -35.7], ctrans, 1, 0, 26214, time);
            place("sprite333", canvas, ctx, [-0.0435150146484375, 0.023632049560546875, 0.023632049560546875,
                0.0435150146484375, 17.15, -23.65
            ], ctrans, 1, (0 + time) % 1, 67, time);
            place("sprite335", canvas, ctx, [0.04943389892578125, 0.001647186279296875, -0.001647186279296875,
                0.04943389892578125, -16.3, -31.6
            ], ctrans, 1, (0 + time) % 1, 67, time);
            place("sprite339", canvas, ctx, [0.02134246826171875, 0.04508056640625, -0.045079803466796874,
                0.021343231201171875, 24.3, -25.7
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite347", canvas, ctx, [-0.04101409912109375, -0.028243255615234376, -0.028243255615234376,
                0.04101409912109375, -1.15, -24.85
            ], ctrans, 1, (0 + time) % 1, 68, time);
            break;
        case 71:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -21.9, -38.0], ctrans, 1, (0 + time) % 1, 68,
                time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.049999237060546875, -2.13623046875E-5, -2.13623046875E-5,
                0.049999237060546875, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04984130859375, -0.00331268310546875, 0.00331268310546875,
                0.04984130859375, 3.15, -13.5
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite307", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -27.3, -72.25], ctrans, 1, (0 + time) % 1,
                68, time);
            place("sprite311", canvas, ctx, [0.0472076416015625, -0.01631927490234375, 0.01631927490234375,
                0.0472076416015625, -18.05, -50.5
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite316", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -17.2, -46.6], ctrans, 1, (0 + time) % 1, 68,
                time);
            place("sprite311", canvas, ctx, [0.0465362548828125, 0.0181304931640625, -0.0181304931640625,
                0.0465362548828125, 5.9, -54.65
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite316", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 4.25, -46.85], ctrans, 1, (0 + time) % 1, 68,
                time);
            place("sprite320", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -29.15, -97.35], ctrans, 1, (0 + time) % 1,
                68, time);
            place("sprite324", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -41.9, -92.8], ctrans, 1, (0 + time) % 1, 68,
                time);
            place("morphshape325", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -2.7, -35.7], ctrans, 1, 0, 0, time);
            place("sprite333", canvas, ctx, [-0.0435150146484375, 0.023632049560546875, 0.023632049560546875,
                0.0435150146484375, 17.15, -23.65
            ], ctrans, 1, (0 + time) % 1, 67, time);
            place("sprite335", canvas, ctx, [0.04943389892578125, 0.001647186279296875, -0.001647186279296875,
                0.04943389892578125, -16.3, -31.6
            ], ctrans, 1, (0 + time) % 1, 67, time);
            place("sprite339", canvas, ctx, [0.02134246826171875, 0.04508056640625, -0.045079803466796874,
                0.021343231201171875, 24.3, -25.7
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite347", canvas, ctx, [-0.04101409912109375, -0.028243255615234376, -0.028243255615234376,
                0.04101409912109375, -1.15, -24.85
            ], ctrans, 1, (0 + time) % 1, 68, time);
            break;
        case 72:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.049997711181640626, 2.349853515625E-4, -2.349853515625E-4,
                0.049997711181640626, -22.0, -37.75
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite292", canvas, ctx, [0.049715423583984376, 0.00501861572265625, -0.00501861572265625,
                0.049715423583984376, 6.7, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.049715423583984376, 0.00501861572265625, -0.00501861572265625,
                0.049715423583984376, -6.75, -8.35
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.04999847412109375, -5.340576171875E-6, -5.340576171875E-6,
                0.04999847412109375, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.049832916259765624, -0.003278350830078125, 0.003278350830078125,
                0.049832916259765624, 3.1, -13.45
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite307", canvas, ctx, [0.049997711181640626, 2.349853515625E-4, -2.349853515625E-4,
                0.049997711181640626, -27.2, -71.95
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite311", canvas, ctx, [0.047296905517578126, -0.015898895263671876, 0.015898895263671876,
                0.047296905517578126, -18.05, -50.25
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite316", canvas, ctx, [0.049997711181640626, 2.349853515625E-4, -2.349853515625E-4,
                0.049997711181640626, -17.3, -46.35
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite311", canvas, ctx, [0.04639739990234375, 0.018326568603515624, -0.018326568603515624,
                0.04639739990234375, 5.9, -54.2
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite316", canvas, ctx, [0.049997711181640626, 2.349853515625E-4, -2.349853515625E-4,
                0.049997711181640626, 4.15, -46.5
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite320", canvas, ctx, [0.049997711181640626, 2.349853515625E-4, -2.349853515625E-4,
                0.049997711181640626, -29.0, -97.15
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite324", canvas, ctx, [0.049997711181640626, 2.349853515625E-4, -2.349853515625E-4,
                0.049997711181640626, -41.75, -92.65
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("morphshape325", canvas, ctx, [0.049997711181640626, 2.349853515625E-4, -2.349853515625E-4,
                0.049997711181640626, -2.85, -35.35
            ], ctrans, 1, 0, 13107, time);
            place("sprite333", canvas, ctx, [-0.043437957763671875, 0.02362823486328125, 0.02362823486328125,
                0.043437957763671875, 17.25, -23.45
            ], ctrans, 1, (0 + time) % 1, 67, time);
            place("sprite335", canvas, ctx, [0.0494537353515625, 4.364013671875E-4, -4.364013671875E-4,
                0.0494537353515625, -16.6, -30.9
            ], ctrans, 1, (0 + time) % 1, 67, time);
            place("sprite339", canvas, ctx, [0.021292877197265626, 0.04503326416015625, -0.04503326416015625,
                0.02129364013671875, 24.15, -25.9
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite347", canvas, ctx, [-0.03934402465820312, -0.030307769775390625, -0.030307769775390625,
                0.03934402465820312, -1.15, -24.2
            ], ctrans, 1, (0 + time) % 1, 68, time);
            break;
        case 73:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.04999465942382812, 4.69970703125E-4, -4.69970703125E-4,
                0.04999465942382812, -22.2, -37.5
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite292", canvas, ctx, [0.049715423583984376, 0.00501861572265625, -0.00501861572265625,
                0.049715423583984376, 6.7, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.049715423583984376, 0.00501861572265625, -0.00501861572265625,
                0.049715423583984376, -6.75, -8.35
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.04999847412109375, -5.340576171875E-6, -5.340576171875E-6,
                0.04999847412109375, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.049832916259765624, -0.003278350830078125, 0.003278350830078125,
                0.049832916259765624, 3.1, -13.45
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite307", canvas, ctx, [0.04999465942382812, 4.69970703125E-4, -4.69970703125E-4,
                0.04999465942382812, -27.1, -71.65
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite311", canvas, ctx, [0.0473724365234375, -0.0156768798828125, 0.0156768798828125,
                0.0473724365234375, -18.1, -50.1
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite316", canvas, ctx, [0.04999465942382812, 4.69970703125E-4, -4.69970703125E-4,
                0.04999465942382812, -17.4, -46.1
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite311", canvas, ctx, [0.04630966186523437, 0.01854400634765625, -0.01854400634765625,
                0.04630966186523437, 5.85, -53.75
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite316", canvas, ctx, [0.04999465942382812, 4.69970703125E-4, -4.69970703125E-4,
                0.04999465942382812, 4.1, -46.1
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite320", canvas, ctx, [0.04999465942382812, 4.69970703125E-4, -4.69970703125E-4,
                0.04999465942382812, -28.8, -96.9
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite324", canvas, ctx, [0.04999465942382812, 4.69970703125E-4, -4.69970703125E-4,
                0.04999465942382812, -41.65, -92.5
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("morphshape325", canvas, ctx, [0.04999465942382812, 4.69970703125E-4, -4.69970703125E-4,
                0.04999465942382812, -3.0, -35.05
            ], ctrans, 1, 0, 26214, time);
            place("sprite333", canvas, ctx, [-0.043437957763671875, 0.02362823486328125, 0.02362823486328125,
                0.043437957763671875, 17.25, -23.3
            ], ctrans, 1, (0 + time) % 1, 67, time);
            place("sprite335", canvas, ctx, [0.04944610595703125, -6.7138671875E-4, 6.7138671875E-4,
                0.04944610595703125, -16.95, -30.25
            ], ctrans, 1, (0 + time) % 1, 67, time);
            place("sprite339", canvas, ctx, [0.021292877197265626, 0.04503326416015625, -0.04503326416015625,
                0.02129364013671875, 23.95, -26.15
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite347", canvas, ctx, [-0.0376434326171875, -0.03231124877929688, -0.03231124877929688,
                0.0376434326171875, -1.15, -23.5
            ], ctrans, 1, (0 + time) % 1, 68, time);
            break;
        case 74:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.049990081787109376, 7.04193115234375E-4, -7.04193115234375E-4,
                0.049990081787109376, -22.3, -37.3
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite292", canvas, ctx, [0.049715423583984376, 0.00501861572265625, -0.00501861572265625,
                0.049715423583984376, 6.7, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.049715423583984376, 0.00501861572265625, -0.00501861572265625,
                0.049715423583984376, -6.75, -8.35
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.04999847412109375, -5.340576171875E-6, -5.340576171875E-6,
                0.04999847412109375, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.049832916259765624, -0.003278350830078125, 0.003278350830078125,
                0.049832916259765624, 3.1, -13.45
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite307", canvas, ctx, [0.049990081787109376, 7.04193115234375E-4, -7.04193115234375E-4,
                0.049990081787109376, -27.0, -71.35
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite311", canvas, ctx, [0.047444915771484374, -0.0154541015625, 0.0154541015625,
                0.047444915771484374, -18.1, -49.85
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite316", canvas, ctx, [0.049990081787109376, 7.04193115234375E-4, -7.04193115234375E-4,
                0.049990081787109376, -17.5, -45.85
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite311", canvas, ctx, [0.04615859985351563, 0.018914031982421874, -0.018914031982421874,
                0.04615859985351563, 5.85, -53.35
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite316", canvas, ctx, [0.049990081787109376, 7.04193115234375E-4, -7.04193115234375E-4,
                0.049990081787109376, 3.95, -45.75
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite320", canvas, ctx, [0.049990081787109376, 7.04193115234375E-4, -7.04193115234375E-4,
                0.049990081787109376, -28.7, -96.7
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite324", canvas, ctx, [0.049990081787109376, 7.04193115234375E-4, -7.04193115234375E-4,
                0.049990081787109376, -41.5, -92.35
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("morphshape325", canvas, ctx, [0.049990081787109376, 7.04193115234375E-4, -
                7.04193115234375E-4, 0.049990081787109376, -3.2, -34.75
            ], ctrans, 1, 0, 39322, time);
            place("sprite333", canvas, ctx, [-0.043437957763671875, 0.02362823486328125, 0.02362823486328125,
                0.043437957763671875, 17.2, -23.2
            ], ctrans, 1, (0 + time) % 1, 67, time);
            place("sprite335", canvas, ctx, [0.049410247802734376, -0.0017791748046875, 0.0017791748046875,
                0.049410247802734376, -17.15, -29.55
            ], ctrans, 1, (0 + time) % 1, 67, time);
            place("sprite339", canvas, ctx, [0.021292877197265626, 0.04503326416015625, -0.04503326416015625,
                0.02129364013671875, 23.8, -26.45
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite347", canvas, ctx, [-0.035799407958984376, -0.03438262939453125, -0.03438262939453125,
                0.035799407958984376, -1.05, -22.9
            ], ctrans, 1, (0 + time) % 1, 68, time);
            break;
        case 75:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -22.5, -37.1
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.049999237060546875, -2.13623046875E-5, -2.13623046875E-5,
                0.049999237060546875, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04984130859375, -0.00331268310546875, 0.00331268310546875,
                0.04984130859375, 3.15, -13.5
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite307", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -27.1, -71.5
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite311", canvas, ctx, [0.047563934326171876, -0.01523895263671875, 0.01523895263671875,
                0.047563934326171876, -18.35, -49.5
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite316", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -17.6, -45.6
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite311", canvas, ctx, [0.0461090087890625, 0.01918487548828125, -0.01918487548828125,
                0.0461090087890625, 5.7, -53.15
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite316", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, 3.85, -45.35
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite320", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -28.4, -96.65
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite324", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -41.25, -92.35
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("morphshape325", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -3.35, -34.4
            ], ctrans, 1, 0, 0, time);
            place("sprite333", canvas, ctx, [-0.043437957763671875, 0.02362823486328125, 0.02362823486328125,
                0.043437957763671875, 17.2, -23.05
            ], ctrans, 1, (0 + time) % 1, 67, time);
            place("sprite335", canvas, ctx, [0.04934616088867187, -0.0031341552734375, 0.0031341552734375,
                0.04934616088867187, -17.8, -28.85
            ], ctrans, 1, (0 + time) % 1, 67, time);
            place("sprite339", canvas, ctx, [0.02134246826171875, 0.04508056640625, -0.045079803466796874,
                0.021343231201171875, 23.6, -26.75
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite355", canvas, ctx, [0.049883270263671876, 5.8746337890625E-4, -5.8746337890625E-4,
                0.049883270263671876, -11.5, -17.1
            ], ctrans, 1, (0 + time) % 1, 75, time);
            break;
        case 76:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -22.85, -37.45
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.049999237060546875, -2.13623046875E-5, -2.13623046875E-5,
                0.049999237060546875, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04984130859375, -0.00331268310546875, 0.00331268310546875,
                0.04984130859375, 3.15, -13.5
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite307", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -27.45, -71.85
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite311", canvas, ctx, [0.047563934326171876, -0.01523895263671875, 0.01523895263671875,
                0.047563934326171876, -18.7, -49.85
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite360", canvas, ctx, [-0.047149658203125, -0.016485595703125, -0.016485595703125,
                0.047149658203125, -5.4, -41.7
            ], ctrans, 1, (0 + time) % 1, 76, time);
            place("sprite311", canvas, ctx, [0.0461090087890625, 0.01918487548828125, -0.01918487548828125,
                0.0461090087890625, 5.35, -53.5
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite360", canvas, ctx, [0.047149658203125, -0.016485595703125, 0.016485595703125,
                0.047149658203125, 3.1, -41.7
            ], ctrans, 1, (0 + time) % 1, 76, time);
            place("sprite320", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -28.75, -97.0
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite324", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -41.6, -92.7
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("morphshape325", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -3.7, -34.75
            ], ctrans, 1, 0, 0, time);
            place("sprite333", canvas, ctx, [-0.0435150146484375, 0.023632049560546875, 0.023632049560546875,
                0.0435150146484375, 17.15, -22.95
            ], ctrans, 1, (0 + time) % 1, 67, time);
            place("sprite335", canvas, ctx, [0.049410247802734376, 0.001399993896484375, -0.001399993896484375,
                0.049410247802734376, -16.3, -31.5
            ], ctrans, 1, (0 + time) % 1, 67, time);
            place("sprite339", canvas, ctx, [0.02134246826171875, 0.04508056640625, -0.045079803466796874,
                0.021343231201171875, 23.6, -24.65
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite355", canvas, ctx, [0.049883270263671876, 5.8746337890625E-4, -5.8746337890625E-4,
                0.049883270263671876, -11.5, -16.4
            ], ctrans, 1, (0 + time) % 1, 75, time);
            break;
        case 77:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -22.85, -37.45
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.049999237060546875, -2.13623046875E-5, -2.13623046875E-5,
                0.049999237060546875, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04984130859375, -0.00331268310546875, 0.00331268310546875,
                0.04984130859375, 3.15, -13.5
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite307", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -27.45, -71.85
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite311", canvas, ctx, [0.047563934326171876, -0.01523895263671875, 0.01523895263671875,
                0.047563934326171876, -18.7, -49.85
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite360", canvas, ctx, [-0.047149658203125, -0.016485595703125, -0.016485595703125,
                0.047149658203125, -5.4, -41.7
            ], ctrans, 1, (0 + time) % 1, 76, time);
            place("sprite311", canvas, ctx, [0.0461090087890625, 0.01918487548828125, -0.01918487548828125,
                0.0461090087890625, 5.35, -53.5
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite360", canvas, ctx, [0.047149658203125, -0.016485595703125, 0.016485595703125,
                0.047149658203125, 3.1, -41.7
            ], ctrans, 1, (0 + time) % 1, 76, time);
            place("sprite320", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -28.75, -97.0
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite324", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -41.6, -92.7
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("morphshape325", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -3.7, -34.75
            ], ctrans, 1, 0, 0, time);
            place("sprite333", canvas, ctx, [-0.0435150146484375, 0.023632049560546875, 0.023632049560546875,
                0.0435150146484375, 17.15, -22.95
            ], ctrans, 1, (0 + time) % 1, 67, time);
            place("sprite335", canvas, ctx, [0.049410247802734376, 0.001399993896484375, -0.001399993896484375,
                0.049410247802734376, -16.3, -31.5
            ], ctrans, 1, (0 + time) % 1, 67, time);
            place("sprite339", canvas, ctx, [0.02134246826171875, 0.04508056640625, -0.045079803466796874,
                0.021343231201171875, 23.6, -24.65
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite355", canvas, ctx, [0.049883270263671876, 5.8746337890625E-4, -5.8746337890625E-4,
                0.049883270263671876, -11.5, -16.4
            ], ctrans, 1, (0 + time) % 1, 75, time);
            break;
        case 78:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -22.85, -37.45
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.049999237060546875, -2.13623046875E-5, -2.13623046875E-5,
                0.049999237060546875, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04984130859375, -0.00331268310546875, 0.00331268310546875,
                0.04984130859375, 3.15, -13.5
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite307", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -27.45, -71.85
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite311", canvas, ctx, [0.047563934326171876, -0.01523895263671875, 0.01523895263671875,
                0.047563934326171876, -18.7, -49.85
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite360", canvas, ctx, [-0.047149658203125, -0.016485595703125, -0.016485595703125,
                0.047149658203125, -5.4, -41.7
            ], ctrans, 1, (0 + time) % 1, 76, time);
            place("sprite311", canvas, ctx, [0.0461090087890625, 0.01918487548828125, -0.01918487548828125,
                0.0461090087890625, 5.35, -53.5
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite360", canvas, ctx, [0.047149658203125, -0.016485595703125, 0.016485595703125,
                0.047149658203125, 3.1, -41.7
            ], ctrans, 1, (0 + time) % 1, 76, time);
            place("sprite320", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -28.75, -97.0
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite324", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -41.6, -92.7
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("morphshape325", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -3.7, -34.75
            ], ctrans, 1, 0, 0, time);
            place("sprite333", canvas, ctx, [-0.0435150146484375, 0.023632049560546875, 0.023632049560546875,
                0.0435150146484375, 17.15, -22.95
            ], ctrans, 1, (0 + time) % 1, 67, time);
            place("sprite335", canvas, ctx, [0.049410247802734376, 0.001399993896484375, -0.001399993896484375,
                0.049410247802734376, -16.3, -31.5
            ], ctrans, 1, (0 + time) % 1, 67, time);
            place("sprite339", canvas, ctx, [0.02134246826171875, 0.04508056640625, -0.045079803466796874,
                0.021343231201171875, 23.6, -24.65
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite355", canvas, ctx, [0.049883270263671876, 5.8746337890625E-4, -5.8746337890625E-4,
                0.049883270263671876, -11.5, -16.4
            ], ctrans, 1, (0 + time) % 1, 75, time);
            break;
        case 79:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -22.85, -37.45
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.049999237060546875, -2.13623046875E-5, -2.13623046875E-5,
                0.049999237060546875, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04984130859375, -0.00331268310546875, 0.00331268310546875,
                0.04984130859375, 3.15, -13.5
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite307", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -27.45, -71.85
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite311", canvas, ctx, [0.047563934326171876, -0.01523895263671875, 0.01523895263671875,
                0.047563934326171876, -18.7, -49.85
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite360", canvas, ctx, [-0.047149658203125, -0.016485595703125, -0.016485595703125,
                0.047149658203125, -5.4, -41.7
            ], ctrans, 1, (0 + time) % 1, 76, time);
            place("sprite311", canvas, ctx, [0.0461090087890625, 0.01918487548828125, -0.01918487548828125,
                0.0461090087890625, 5.35, -53.5
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite360", canvas, ctx, [0.047149658203125, -0.016485595703125, 0.016485595703125,
                0.047149658203125, 3.1, -41.7
            ], ctrans, 1, (0 + time) % 1, 76, time);
            place("sprite320", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -28.75, -97.0
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite324", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -41.6, -92.7
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("morphshape325", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -3.7, -34.75
            ], ctrans, 1, 0, 0, time);
            place("sprite333", canvas, ctx, [-0.0435150146484375, 0.023632049560546875, 0.023632049560546875,
                0.0435150146484375, 17.15, -22.95
            ], ctrans, 1, (0 + time) % 1, 67, time);
            place("sprite335", canvas, ctx, [0.049410247802734376, 0.001399993896484375, -0.001399993896484375,
                0.049410247802734376, -16.3, -31.5
            ], ctrans, 1, (0 + time) % 1, 67, time);
            place("sprite339", canvas, ctx, [0.02134246826171875, 0.04508056640625, -0.045079803466796874,
                0.021343231201171875, 23.6, -24.65
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite355", canvas, ctx, [0.049883270263671876, 5.8746337890625E-4, -5.8746337890625E-4,
                0.049883270263671876, -11.5, -16.4
            ], ctrans, 1, (0 + time) % 1, 75, time);
            break;
        case 80:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -22.5, -37.1
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.049999237060546875, -2.13623046875E-5, -2.13623046875E-5,
                0.049999237060546875, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04984130859375, -0.00331268310546875, 0.00331268310546875,
                0.04984130859375, 3.15, -13.5
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite307", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -27.1, -71.5
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite311", canvas, ctx, [0.047563934326171876, -0.01523895263671875, 0.01523895263671875,
                0.047563934326171876, -18.35, -49.5
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite316", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -17.25, -45.6
            ], ctrans, 1, (0 + time) % 1, 80, time);
            place("sprite311", canvas, ctx, [0.0461090087890625, 0.01918487548828125, -0.01918487548828125,
                0.0461090087890625, 5.7, -53.15
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite316", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, 3.85, -45.35
            ], ctrans, 1, (0 + time) % 1, 80, time);
            place("sprite320", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -28.4, -96.65
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite324", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -41.25, -92.35
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("morphshape325", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -3.35, -34.4
            ], ctrans, 1, 0, 0, time);
            place("sprite333", canvas, ctx, [-0.043437957763671875, 0.02362823486328125, 0.02362823486328125,
                0.043437957763671875, 17.25, -23.15
            ], ctrans, 1, (0 + time) % 1, 67, time);
            place("sprite335", canvas, ctx, [0.04934616088867187, -0.0031341552734375, 0.0031341552734375,
                0.04934616088867187, -17.8, -28.85
            ], ctrans, 1, (0 + time) % 1, 67, time);
            place("sprite339", canvas, ctx, [0.02134246826171875, 0.04508056640625, -0.045079803466796874,
                0.021343231201171875, 23.6, -26.75
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite355", canvas, ctx, [0.049883270263671876, 5.8746337890625E-4, -5.8746337890625E-4,
                0.049883270263671876, -11.5, -17.1
            ], ctrans, 1, (0 + time) % 1, 75, time);
            break;
        case 81:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.04999465942382812, 4.69970703125E-4, -4.69970703125E-4,
                0.04999465942382812, -22.2, -37.45
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite292", canvas, ctx, [0.049715423583984376, 0.00501861572265625, -0.00501861572265625,
                0.049715423583984376, 6.7, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.049715423583984376, 0.00501861572265625, -0.00501861572265625,
                0.049715423583984376, -6.75, -8.35
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.04999847412109375, -5.340576171875E-6, -5.340576171875E-6,
                0.04999847412109375, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.049832916259765624, -0.003278350830078125, 0.003278350830078125,
                0.049832916259765624, 3.1, -13.45
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite307", canvas, ctx, [0.04999465942382812, 4.69970703125E-4, -4.69970703125E-4,
                0.04999465942382812, -27.4, -72.0
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite311", canvas, ctx, [0.0473724365234375, -0.0156768798828125, 0.0156768798828125,
                0.0473724365234375, -18.3, -49.95
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite316", canvas, ctx, [0.04998321533203125, 0.0011383056640625, -0.0011383056640625,
                0.04998321533203125, -16.9, -45.95
            ], ctrans, 1, (0 + time) % 1, 80, time);
            place("sprite311", canvas, ctx, [0.0463104248046875, 0.018544769287109374, -0.018544769287109374,
                0.0463104248046875, 5.75, -54.05
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite316", canvas, ctx, [0.049993896484375, 4.69970703125E-4, -4.69970703125E-4,
                0.049993896484375, 4.0, -46.1
            ], ctrans, 1, (0 + time) % 1, 80, time);
            place("sprite320", canvas, ctx, [0.04999465942382812, 4.69970703125E-4, -4.69970703125E-4,
                0.04999465942382812, -28.8, -96.95
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite324", canvas, ctx, [0.04999465942382812, 4.69970703125E-4, -4.69970703125E-4,
                0.04999465942382812, -41.65, -92.5
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("morphshape325", canvas, ctx, [0.04999465942382812, 4.69970703125E-4, -4.69970703125E-4,
                0.04999465942382812, -3.0, -35.05
            ], ctrans, 1, 0, 13107, time);
            place("sprite333", canvas, ctx, [-0.043437957763671875, 0.02362823486328125, 0.02362823486328125,
                0.043437957763671875, 17.3, -23.35
            ], ctrans, 1, (0 + time) % 1, 67, time);
            place("sprite335", canvas, ctx, [0.04944610595703125, -6.72149658203125E-4, 6.72149658203125E-4,
                0.04944610595703125, -17.2, -30.3
            ], ctrans, 1, (0 + time) % 1, 67, time);
            place("sprite339", canvas, ctx, [0.021292877197265626, 0.04503326416015625, -0.04503326416015625,
                0.02129364013671875, 23.9, -26.15
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite347", canvas, ctx, [-0.035799407958984376, -0.03438262939453125, -0.03438262939453125,
                0.035799407958984376, -1.05, -22.9
            ], ctrans, 1, (0 + time) % 1, 81, time);
            break;
        case 82:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -21.9, -38.0], ctrans, 1, (0 + time) % 1, 68,
                time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.049999237060546875, -2.13623046875E-5, -2.13623046875E-5,
                0.049999237060546875, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04984130859375, -0.00331268310546875, 0.00331268310546875,
                0.04984130859375, 3.15, -13.5
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite307", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -27.3, -72.25], ctrans, 1, (0 + time) % 1,
                68, time);
            place("sprite311", canvas, ctx, [0.0472076416015625, -0.01631927490234375, 0.01631927490234375,
                0.0472076416015625, -18.05, -50.5
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("shape361", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite311", canvas, ctx, [0.0465362548828125, 0.0181304931640625, -0.0181304931640625,
                0.0465362548828125, 5.9, -54.65
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("shape362", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite320", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -29.15, -97.35], ctrans, 1, (0 + time) % 1,
                68, time);
            place("sprite324", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -41.9, -92.8], ctrans, 1, (0 + time) % 1, 68,
                time);
            place("morphshape325", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -2.7, -35.7], ctrans, 1, 0, 0, time);
            place("sprite333", canvas, ctx, [-0.0435150146484375, 0.023632049560546875, 0.023632049560546875,
                0.0435150146484375, 17.15, -23.65
            ], ctrans, 1, (0 + time) % 1, 67, time);
            place("sprite335", canvas, ctx, [0.04943389892578125, 0.001647186279296875, -0.001647186279296875,
                0.04943389892578125, -16.3, -31.6
            ], ctrans, 1, (0 + time) % 1, 67, time);
            place("sprite339", canvas, ctx, [0.02134246826171875, 0.04508056640625, -0.045079803466796874,
                0.021343231201171875, 24.3, -25.7
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite347", canvas, ctx, [-0.04101409912109375, -0.028243255615234376, -0.028243255615234376,
                0.04101409912109375, -1.15, -24.85
            ], ctrans, 1, (0 + time) % 1, 81, time);
            break;
        case 83:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -20.3, -35.55], ctrans, 1, (0 + time) % 1,
                68, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.049999237060546875, -2.13623046875E-5, -2.13623046875E-5,
                0.049999237060546875, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04984130859375, -0.00331268310546875, 0.00331268310546875,
                0.04984130859375, 3.15, -13.5
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite419", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -28.3, -84.75], ctrans, 1, (0 + time) % 1,
                83, time);
            place("sprite311", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -15.55, -66.75], ctrans, 1, (0 + time) % 1,
                68, time);
            place("shape420", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -24.0, 46.1], ctrans, 1, 0, 0, time);
            place("sprite311", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 10.5, -66.15], ctrans, 1, (0 + time) % 1, 68,
                time);
            place("shape421", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite425", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -29.05, -93.15], ctrans, 1, (0 + time) % 1,
                83, time);
            place("sprite429", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -40.55, -90.1], ctrans, 1, (0 + time) % 1,
                83, time);
            place("shape430", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite333", canvas, ctx, [-0.03661346435546875, 0.033282470703125, 0.033282470703125,
                0.03661346435546875, 16.95, -24.75
            ], ctrans, 1, (0 + time) % 1, 67, time);
            place("sprite335", canvas, ctx, [0.04836883544921875, -0.01015625, 0.01015625, 0.04836883544921875,
                -17.05, -26.25
            ], ctrans, 1, (0 + time) % 1, 67, time);
            place("sprite339", canvas, ctx, [0.03143310546875, 0.038677215576171875, -0.03867645263671875,
                0.03143310546875, 21.75, -29.0
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite355", canvas, ctx, [0.04930267333984375, -0.0074432373046875, 0.0074432373046875,
                0.04930267333984375, -9.6, -16.8
            ], ctrans, 1, (0 + time) % 1, 83, time);
            break;
        case 84:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -20.3, -35.55], ctrans, 1, (0 + time) % 1,
                68, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.049999237060546875, -2.13623046875E-5, -2.13623046875E-5,
                0.049999237060546875, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04984130859375, -0.00331268310546875, 0.00331268310546875,
                0.04984130859375, 3.15, -13.5
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite419", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -28.3, -84.75], ctrans, 1, (0 + time) % 1,
                83, time);
            place("sprite311", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -15.55, -66.75], ctrans, 1, (0 + time) % 1,
                68, time);
            place("shape420", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -24.0, 46.1], ctrans, 1, 0, 0, time);
            place("sprite311", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 10.5, -66.15], ctrans, 1, (0 + time) % 1, 68,
                time);
            place("shape421", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite425", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -29.05, -93.15], ctrans, 1, (0 + time) % 1,
                83, time);
            place("sprite429", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -40.55, -90.1], ctrans, 1, (0 + time) % 1,
                83, time);
            place("shape430", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite333", canvas, ctx, [-0.03661346435546875, 0.033282470703125, 0.033282470703125,
                0.03661346435546875, 16.95, -24.75
            ], ctrans, 1, (0 + time) % 1, 67, time);
            place("sprite335", canvas, ctx, [0.04836883544921875, -0.01015625, 0.01015625, 0.04836883544921875,
                -17.05, -26.25
            ], ctrans, 1, (0 + time) % 1, 67, time);
            place("sprite339", canvas, ctx, [0.03143310546875, 0.038677215576171875, -0.03867645263671875,
                0.03143310546875, 21.75, -29.0
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite355", canvas, ctx, [0.04930267333984375, -0.0074432373046875, 0.0074432373046875,
                0.04930267333984375, -9.6, -16.8
            ], ctrans, 1, (0 + time) % 1, 83, time);
            break;
        case 85:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -21.9, -38.0], ctrans, 1, (0 + time) % 1, 68,
                time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.049999237060546875, -2.13623046875E-5, -2.13623046875E-5,
                0.049999237060546875, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04984130859375, -0.00331268310546875, 0.00331268310546875,
                0.04984130859375, 3.15, -13.5
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite307", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -27.3, -72.25], ctrans, 1, (0 + time) % 1,
                85, time);
            place("sprite311", canvas, ctx, [0.0472076416015625, -0.01631927490234375, 0.01631927490234375,
                0.0472076416015625, -18.05, -50.5
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("shape361", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite311", canvas, ctx, [0.0465362548828125, 0.0181304931640625, -0.0181304931640625,
                0.0465362548828125, 5.9, -54.65
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("shape362", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite320", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -29.15, -97.35], ctrans, 1, (0 + time) % 1,
                85, time);
            place("sprite324", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -41.9, -92.8], ctrans, 1, (0 + time) % 1, 85,
                time);
            place("morphshape325", canvas, ctx, [0.1199432373046875, 0.0, 0.0, 0.069696044921875, -5.7, -36.35],
                ctrans, 1, 0, 0, time);
            place("sprite333", canvas, ctx, [-0.0435150146484375, 0.023632049560546875, 0.023632049560546875,
                0.0435150146484375, 17.15, -23.65
            ], ctrans, 1, (0 + time) % 1, 67, time);
            place("sprite335", canvas, ctx, [0.04943389892578125, 0.001647186279296875, -0.001647186279296875,
                0.04943389892578125, -16.3, -31.6
            ], ctrans, 1, (0 + time) % 1, 67, time);
            place("sprite339", canvas, ctx, [0.02134246826171875, 0.04508056640625, -0.045079803466796874,
                0.021343231201171875, 24.3, -25.7
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite347", canvas, ctx, [-0.04101409912109375, -0.028243255615234376, -0.028243255615234376,
                0.04101409912109375, -1.15, -24.85
            ], ctrans, 1, (0 + time) % 1, 85, time);
            break;
        case 86:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -20.3, -36.65], ctrans, 1, (0 + time) % 1,
                68, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.049999237060546875, -2.13623046875E-5, -2.13623046875E-5,
                0.049999237060546875, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 4.0, -10.8], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite419", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -28.3, -85.85], ctrans, 1, (0 + time) % 1,
                86, time);
            place("sprite311", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -15.55, -67.85], ctrans, 1, (0 + time) % 1,
                68, time);
            place("morphshape431", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite311", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 10.5, -67.25], ctrans, 1, (0 + time) % 1, 68,
                time);
            place("morphshape432", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite425", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -29.05, -94.25], ctrans, 1, (0 + time) % 1,
                86, time);
            place("sprite429", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -40.55, -91.2], ctrans, 1, (0 + time) % 1,
                86, time);
            place("morphshape433", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite333", canvas, ctx, [-0.0435150146484375, 0.023632049560546875, 0.023632049560546875,
                0.0435150146484375, 17.15, -23.65
            ], ctrans, 1, (0 + time) % 1, 67, time);
            place("sprite335", canvas, ctx, [0.04943389892578125, 0.001647186279296875, -0.001647186279296875,
                0.04943389892578125, -16.3, -31.6
            ], ctrans, 1, (0 + time) % 1, 67, time);
            place("sprite401", canvas, ctx, [0.046038818359375, 0.018603515625, -0.018603515625,
                0.046038818359375, -10.8, -23.65
            ], ctrans, 1, (0 + time) % 1, 86, time);
            break;
        case 87:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -20.3, -45.65], ctrans, 1, (0 + time) % 1,
                68, time);
            place("sprite292", canvas, ctx, [0.049680328369140624, 0.005277252197265625, -0.005277252197265625,
                0.049680328369140624, 5.8, -17.2
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.048535919189453124, 0.011688232421875, -0.011688232421875,
                0.048535919189453124, -8.3, -18.2
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.0499908447265625, -2.66265869140625E-4, -2.66265869140625E-4,
                0.0499908447265625, 12.2, -24.35
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 3.2, -20.15], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.049495697021484375, 0.0067535400390625, -0.0067535400390625,
                0.049495697021484375, -13.15, -25.65
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite303", canvas, ctx, [0.04998016357421875, 0.001102447509765625, -0.001102447509765625,
                0.04998016357421875, -12.05, -39.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite419", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -28.3, -94.85], ctrans, 1, (0 + time) % 1,
                86, time);
            place("sprite311", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -15.55, -76.85], ctrans, 1, (0 + time) % 1,
                68, time);
            place("morphshape431", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 13107, time);
            place("sprite311", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 10.5, -76.25], ctrans, 1, (0 + time) % 1, 68,
                time);
            place("morphshape432", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 13107, time);
            place("sprite425", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -29.05, -103.25], ctrans, 1, (0 + time) % 1,
                86, time);
            place("sprite429", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -40.55, -100.2], ctrans, 1, (0 + time) % 1,
                86, time);
            place("morphshape433", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 13107, time);
            place("sprite333", canvas, ctx, [-0.0360748291015625, 0.033788299560546874, 0.033788299560546874,
                0.0360748291015625, 16.35, -34.3
            ], ctrans, 1, (0 + time) % 1, 67, time);
            place("sprite335", canvas, ctx, [0.049436187744140624, -0.001117706298828125, 0.001117706298828125,
                0.049436187744140624, -17.7, -41.75
            ], ctrans, 1, (0 + time) % 1, 67, time);
            place("sprite401", canvas, ctx, [0.045978546142578125, 0.01860198974609375, -0.01860198974609375,
                0.045978546142578125, -11.3, -32.4
            ], ctrans, 1, (0 + time) % 1, 86, time);
            break;
        case 88:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -20.3, -54.65], ctrans, 1, (0 + time) % 1,
                68, time);
            place("sprite292", canvas, ctx, [0.049625396728515625, 0.0056976318359375, -0.0056976318359375,
                0.049625396728515625, 4.95, -26.15
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.046468353271484374, 0.018137359619140626, -0.018137359619140626,
                0.046468353271484374, -9.85, -28.1
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.0499786376953125, -6.90460205078125E-4, -6.90460205078125E-4,
                0.0499786376953125, 11.4, -33.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 2.45, -29.5], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.048085784912109374, 0.013376617431640625, -0.013376617431640625,
                0.048085784912109374, -13.65, -36.1
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite303", canvas, ctx, [0.0499359130859375, 0.002204132080078125, -0.002204132080078125,
                0.0499359130859375, -12.45, -48.45
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite419", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -28.3, -103.85], ctrans, 1, (0 + time) % 1,
                86, time);
            place("sprite311", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -15.55, -85.85], ctrans, 1, (0 + time) % 1,
                68, time);
            place("morphshape431", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 26214, time);
            place("sprite311", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 10.5, -85.25], ctrans, 1, (0 + time) % 1, 68,
                time);
            place("morphshape432", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 26214, time);
            place("sprite425", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -29.05, -112.25], ctrans, 1, (0 + time) % 1,
                86, time);
            place("sprite429", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -40.55, -109.2], ctrans, 1, (0 + time) % 1,
                86, time);
            place("morphshape433", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 26214, time);
            place("sprite333", canvas, ctx, [-0.026267242431640626, 0.04186859130859375, 0.04186859130859375,
                0.026267242431640626, 15.55, -44.9
            ], ctrans, 1, (0 + time) % 1, 67, time);
            place("sprite335", canvas, ctx, [0.049257659912109376, -0.004097747802734375, 0.004097747802734375,
                0.049257659912109376, -19.15, -51.65
            ], ctrans, 1, (0 + time) % 1, 67, time);
            place("sprite401", canvas, ctx, [0.045978546142578125, 0.01860198974609375, -0.01860198974609375,
                0.045978546142578125, -11.75, -41.2
            ], ctrans, 1, (0 + time) % 1, 86, time);
            break;
        case 89:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -20.3, -63.65], ctrans, 1, (0 + time) % 1,
                68, time);
            place("sprite292", canvas, ctx, [0.04956741333007812, 0.006118011474609375, -0.006118011474609375,
                0.04956741333007812, 4.05, -35.1
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.0435516357421875, 0.0242462158203125, -0.0242462158203125,
                0.0435516357421875, -11.35, -37.95
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.04996490478515625, -0.001113128662109375, -0.001113128662109375,
                0.04996490478515625, 10.55, -42.1
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 1.65, -38.9], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.045795440673828125, 0.01974945068359375, -0.01974945068359375,
                0.045795440673828125, -14.15, -46.45
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite303", canvas, ctx, [0.0498687744140625, 0.003304290771484375, -0.003304290771484375,
                0.0498687744140625, -12.85, -57.5
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite419", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -28.3, -112.85], ctrans, 1, (0 + time) % 1,
                86, time);
            place("sprite311", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -15.55, -94.85], ctrans, 1, (0 + time) % 1,
                68, time);
            place("morphshape431", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 39322, time);
            place("sprite311", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 10.5, -94.25], ctrans, 1, (0 + time) % 1, 68,
                time);
            place("morphshape432", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 39322, time);
            place("sprite425", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -29.05, -121.25], ctrans, 1, (0 + time) % 1,
                86, time);
            place("sprite429", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -40.55, -118.2], ctrans, 1, (0 + time) % 1,
                86, time);
            place("morphshape433", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 39322, time);
            place("sprite333", canvas, ctx, [-0.014893341064453124, 0.04714813232421875, 0.04714813232421875,
                0.014893341064453124, 14.8, -55.55
            ], ctrans, 1, (0 + time) % 1, 67, time);
            place("sprite335", canvas, ctx, [0.04892578125, -0.006903076171875, 0.006903076171875,
                0.04892578125, -20.5, -61.75
            ], ctrans, 1, (0 + time) % 1, 67, time);
            place("sprite401", canvas, ctx, [0.045978546142578125, 0.01860198974609375, -0.01860198974609375,
                0.045978546142578125, -12.15, -50.0
            ], ctrans, 1, (0 + time) % 1, 86, time);
            break;
        case 90:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -20.3, -72.65], ctrans, 1, (0 + time) % 1,
                68, time);
            place("sprite292", canvas, ctx, [0.04950637817382812, 0.00653839111328125, -0.00653839111328125,
                0.04950637817382812, 3.2, -44.1
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.03973846435546875, 0.030035400390625, -0.030035400390625,
                0.03973846435546875, -12.9, -47.85
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.049945831298828125, -0.001537322998046875, -
                0.001537322998046875, 0.049945831298828125, 9.75, -51.0
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.9, -48.25], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.0425811767578125, 0.025893402099609376, -0.025893402099609376,
                0.0425811767578125, -14.4, -56.5
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite303", canvas, ctx, [0.049776458740234376, 0.00440216064453125, -0.00440216064453125,
                0.049776458740234376, -13.3, -66.6
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite419", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -28.3, -121.85], ctrans, 1, (0 + time) % 1,
                86, time);
            place("sprite311", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -15.55, -103.85], ctrans, 1, (0 + time) % 1,
                68, time);
            place("morphshape431", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 52429, time);
            place("sprite311", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 10.5, -103.25], ctrans, 1, (0 + time) % 1,
                68, time);
            place("morphshape432", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 52429, time);
            place("sprite425", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -29.05, -130.25], ctrans, 1, (0 + time) % 1,
                86, time);
            place("sprite429", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -40.55, -127.2], ctrans, 1, (0 + time) % 1,
                86, time);
            place("morphshape433", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 52429, time);
            place("sprite333", canvas, ctx, [-0.002408599853515625, 0.0494140625, 0.0494140625,
                0.002408599853515625, 14.05, -66.05
            ], ctrans, 1, (0 + time) % 1, 67, time);
            place("sprite335", canvas, ctx, [0.0484344482421875, -0.0096832275390625, 0.0096832275390625,
                0.0484344482421875, -21.7, -71.7
            ], ctrans, 1, (0 + time) % 1, 67, time);
            place("sprite401", canvas, ctx, [0.045978546142578125, 0.01860198974609375, -0.01860198974609375,
                0.045978546142578125, -12.6, -58.8
            ], ctrans, 1, (0 + time) % 1, 86, time);
            break;
        case 91:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -20.3, -81.65], ctrans, 1, (0 + time) % 1,
                68, time);
            place("sprite292", canvas, ctx, [0.049462890625, 0.00697021484375, -0.00697021484375,
                0.049462890625, 2.25, -53.0
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.03533935546875, 0.03518600463867187, -0.03518600463867187,
                0.03533935546875, -14.45, -57.75
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.0499298095703125, -0.001958465576171875, -0.001958465576171875,
                0.0499298095703125, 8.9, -59.9
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.1, -57.6], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.03872833251953125, 0.0314453125, -0.0314453125,
                0.03872833251953125, -14.75, -66.65
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite303", canvas, ctx, [0.049658203125, 0.00567169189453125, -0.00567169189453125,
                0.049658203125, -13.4, -76.1
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite419", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -28.3, -130.85], ctrans, 1, (0 + time) % 1,
                86, time);
            place("sprite311", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -15.55, -112.85], ctrans, 1, (0 + time) % 1,
                68, time);
            place("shape420", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -24.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite311", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 10.5, -112.25], ctrans, 1, (0 + time) % 1,
                68, time);
            place("shape420", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite425", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -29.05, -139.25], ctrans, 1, (0 + time) % 1,
                86, time);
            place("sprite429", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -40.55, -136.2], ctrans, 1, (0 + time) % 1,
                86, time);
            place("shape434", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite333", canvas, ctx, [0.010064697265625, 0.04843902587890625, 0.04843902587890625, -
                0.010064697265625, 13.25, -77.0
            ], ctrans, 1, (0 + time) % 1, 67, time);
            place("sprite335", canvas, ctx, [0.04777984619140625, -0.0126068115234375, 0.0126068115234375,
                0.04777984619140625, -22.7, -81.65
            ], ctrans, 1, (0 + time) % 1, 67, time);
            place("sprite339", canvas, ctx, [0.04649810791015625, 0.018331146240234374, -0.01833038330078125,
                0.04649810791015625, 17.0, -87.05
            ], ctrans, 1, (0 + time) % 1, 91, time);
            place("sprite401", canvas, ctx, [0.046038818359375, 0.018603515625, -0.018603515625,
                0.046038818359375, -13.0, -67.65
            ], ctrans, 1, (0 + time) % 1, 86, time);
            break;
        case 92:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.049658203125, 0.00567169189453125, -0.00567169189453125,
                0.049658203125, -21.3, -84.25
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite292", canvas, ctx, [0.04986572265625, -0.002375030517578125, 0.002375030517578125,
                0.04986572265625, 2.55, -53.35
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.031972503662109374, 0.0382904052734375, -0.0382904052734375,
                0.031972503662109374, -15.6, -58.7
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.049388885498046875, 0.00738372802734375, 0.00738372802734375,
                0.049388885498046875, 7.8, -61.35
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04984130859375, -0.00331268310546875, 0.00331268310546875,
                0.04984130859375, -0.75, -58.8
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.0356903076171875, 0.03487548828125, -0.03487548828125,
                0.0356903076171875, -15.05, -67.6
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite303", canvas, ctx, [0.049658203125, 0.00567169189453125, -0.00567169189453125,
                0.049658203125, -13.4, -77.0
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite419", canvas, ctx, [0.049658203125, 0.00567169189453125, -0.00567169189453125,
                0.049658203125, -23.65, -134.1
            ], ctrans, 1, (0 + time) % 1, 86, time);
            place("sprite311", canvas, ctx, [0.049658203125, 0.00567169189453125, -0.00567169189453125,
                0.049658203125, -13.05, -114.75
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("morphshape435", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite311", canvas, ctx, [0.049658203125, 0.00567169189453125, -0.00567169189453125,
                0.049658203125, 12.75, -111.2
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("morphshape436", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite425", canvas, ctx, [0.049658203125, 0.00567169189453125, -0.00567169189453125,
                0.049658203125, -23.45, -142.45
            ], ctrans, 1, (0 + time) % 1, 86, time);
            place("sprite429", canvas, ctx, [0.049658203125, 0.00567169189453125, -0.00567169189453125,
                0.049658203125, -35.25, -140.75
            ], ctrans, 1, (0 + time) % 1, 86, time);
            place("morphshape437", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite333", canvas, ctx, [0.0237884521484375, 0.043756103515625, 0.043756103515625, -
                0.0237884521484375, 11.2, -79.3
            ], ctrans, 1, (0 + time) % 1, 67, time);
            place("sprite335", canvas, ctx, [0.044952392578125, -0.020888519287109376, 0.020888519287109376,
                0.044952392578125, -20.2, -79.35
            ], ctrans, 1, (0 + time) % 1, 67, time);
            place("sprite339", canvas, ctx, [0.04649810791015625, 0.018331146240234374, -0.01833038330078125,
                0.04649810791015625, 14.0, -88.5
            ], ctrans, 1, (0 + time) % 1, 91, time);
            place("sprite401", canvas, ctx, [0.0456268310546875, 0.019561767578125, -0.019561767578125,
                0.0456268310546875, -15.0, -71.0
            ], ctrans, 1, (0 + time) % 1, 86, time);
            break;
        case 93:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.04962997436523438, 0.005660247802734375, -0.005660247802734375,
                0.04962997436523438, -21.05, -73.95
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite292", canvas, ctx, [0.049920654296875, -8.84246826171875E-4, 8.84246826171875E-4,
                0.049920654296875, 3.35, -44.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.037393951416015626, 0.03289337158203125, -0.03289337158203125,
                0.037393951416015626, -13.8, -48.6
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.04958267211914062, 0.005873870849609375, 0.005873870849609375,
                0.04958267211914062, 8.85, -52.15
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.0498291015625, -0.003275299072265625, 0.003275299072265625,
                0.0498291015625, 0.05, -49.7
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.040637969970703125, 0.02883148193359375, -0.02883148193359375,
                0.040637969970703125, -14.65, -57.45
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite303", canvas, ctx, [0.049847412109375, 0.00348968505859375, -0.00348968505859375,
                0.049847412109375, -13.3, -66.5
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite419", canvas, ctx, [0.049745941162109376, 0.004596710205078125, -0.004596710205078125,
                0.049745941162109376, -24.75, -123.3
            ], ctrans, 1, (0 + time) % 1, 86, time);
            place("sprite311", canvas, ctx, [0.049745941162109376, 0.004596710205078125, -0.004596710205078125,
                0.049745941162109376, -13.8, -103.95
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("morphshape435", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 21845, time);
            place("sprite311", canvas, ctx, [0.049745941162109376, 0.004596710205078125, -0.004596710205078125,
                0.049745941162109376, 12.1, -100.9
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("morphshape436", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 21845, time);
            place("sprite425", canvas, ctx, [0.049745941162109376, 0.004596710205078125, -0.004596710205078125,
                0.049745941162109376, -24.8, -131.55
            ], ctrans, 1, (0 + time) % 1, 86, time);
            place("sprite429", canvas, ctx, [0.049745941162109376, 0.004596710205078125, -0.004596710205078125,
                0.049745941162109376, -36.75, -129.55
            ], ctrans, 1, (0 + time) % 1, 86, time);
            place("morphshape437", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 21845, time);
            place("sprite333", canvas, ctx, [0.01622467041015625, 0.04698638916015625, 0.04698638916015625, -
                0.01622467041015625, 12.15, -68.2
            ], ctrans, 1, (0 + time) % 1, 67, time);
            place("sprite335", canvas, ctx, [0.046910858154296874, -0.01575927734375, 0.01575927734375,
                0.046910858154296874, -20.2, -70.15
            ], ctrans, 1, (0 + time) % 1, 67, time);
            place("sprite339", canvas, ctx, [0.0444976806640625, 0.022515106201171874, -0.02251434326171875,
                0.044496917724609376, 15.7, -76.85
            ], ctrans, 1, (0 + time) % 1, 91, time);
            place("sprite401", canvas, ctx, [0.0456695556640625, 0.019194793701171876, -0.019194793701171876,
                0.0456695556640625, -14.95, -60.2
            ], ctrans, 1, (0 + time) % 1, 86, time);
            break;
        case 94:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.0496185302734375, 0.005657958984375, -0.005657958984375,
                0.0496185302734375, -20.7, -63.65
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite292", canvas, ctx, [0.04993896484375, 4.608154296875E-4, -4.608154296875E-4,
                0.04993896484375, 4.2, -35.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.042081451416015624, 0.02664642333984375, -0.02664642333984375,
                0.042081451416015624, -12.1, -38.55
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.04975204467773438, 0.00435943603515625, 0.00435943603515625,
                0.04975204467773438, 9.9, -43.05
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04982681274414062, -0.00327301025390625, 0.00327301025390625,
                0.04982681274414062, 0.9, -40.65
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.04466552734375, 0.022122955322265624, -0.022122955322265624,
                0.04466552734375, -14.2, -47.15
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite303", canvas, ctx, [0.049957275390625, 0.001309967041015625, -0.001309967041015625,
                0.049957275390625, -13.25, -56.1
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite419", canvas, ctx, [0.049829864501953126, 0.003528594970703125, -0.003528594970703125,
                0.049829864501953126, -25.75, -112.5
            ], ctrans, 1, (0 + time) % 1, 86, time);
            place("sprite311", canvas, ctx, [0.049829864501953126, 0.003528594970703125, -0.003528594970703125,
                0.049829864501953126, -14.4, -93.25
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("morphshape435", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 43691, time);
            place("sprite311", canvas, ctx, [0.049829864501953126, 0.003528594970703125, -0.003528594970703125,
                0.049829864501953126, 11.5, -90.7
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("morphshape436", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 43691, time);
            place("sprite425", canvas, ctx, [0.049829864501953126, 0.003528594970703125, -0.003528594970703125,
                0.049829864501953126, -26.1, -120.65
            ], ctrans, 1, (0 + time) % 1, 86, time);
            place("sprite429", canvas, ctx, [0.049829864501953126, 0.003528594970703125, -0.003528594970703125,
                0.049829864501953126, -38.05, -118.2
            ], ctrans, 1, (0 + time) % 1, 86, time);
            place("morphshape437", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 43691, time);
            place("sprite333", canvas, ctx, [0.0082489013671875, 0.04900054931640625, 0.04900054931640625, -
                0.0082489013671875, 12.95, -57.1
            ], ctrans, 1, (0 + time) % 1, 67, time);
            place("sprite335", canvas, ctx, [0.0483367919921875, -0.010552215576171874, 0.010552215576171874,
                0.0483367919921875, -19.8, -60.85
            ], ctrans, 1, (0 + time) % 1, 67, time);
            place("sprite339", canvas, ctx, [0.04208984375, 0.026647186279296874, -0.026647186279296874,
                0.04209060668945312, 17.45, -65.25
            ], ctrans, 1, (0 + time) % 1, 91, time);
            place("sprite401", canvas, ctx, [0.04578399658203125, 0.018802642822265625, -0.018802642822265625,
                0.04578399658203125, -14.9, -49.3
            ], ctrans, 1, (0 + time) % 1, 86, time);
            break;
        case 95:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.04962615966796875, 0.005657958984375, -0.005657958984375,
                0.04962615966796875, -21.0, -53.25
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite292", canvas, ctx, [0.04991302490234375, 0.00199127197265625, -0.00199127197265625,
                0.04991302490234375, 5.0, -26.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.045732879638671876, 0.019921875, -0.019921875,
                0.045732879638671876, -10.25, -28.45
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.049883270263671876, 0.002863311767578125, 0.002863311767578125,
                0.049883270263671876, 11.0, -33.8
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04983367919921875, -0.003278350830078125, 0.003278350830078125,
                0.04983367919921875, 1.4, -31.55
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.047582244873046874, 0.015071868896484375, -0.015071868896484375,
                0.047582244873046874, -13.85, -36.6
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite303", canvas, ctx, [0.04997100830078125, -8.72039794921875E-4, 8.72039794921875E-4,
                0.04997100830078125, -13.1, -45.15
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite419", canvas, ctx, [0.0498870849609375, 0.002648162841796875, -0.002648162841796875,
                0.0498870849609375, -27.1, -101.5
            ], ctrans, 1, (0 + time) % 1, 86, time);
            place("sprite311", canvas, ctx, [0.0498870849609375, 0.002648162841796875, -0.002648162841796875,
                0.0498870849609375, -15.35, -82.8
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("shape438", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite311", canvas, ctx, [0.0498870849609375, 0.002648162841796875, -0.002648162841796875,
                0.0498870849609375, 10.6, -80.75
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("shape439", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite425", canvas, ctx, [0.0498870849609375, 0.002648162841796875, -0.002648162841796875,
                0.0498870849609375, -27.4, -109.8
            ], ctrans, 1, (0 + time) % 1, 86, time);
            place("sprite429", canvas, ctx, [0.0498870849609375, 0.002648162841796875, -0.002648162841796875,
                0.0498870849609375, -39.05, -107.4
            ], ctrans, 1, (0 + time) % 1, 86, time);
            place("shape440", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite333", canvas, ctx, [2.5177001953125E-4, 0.04967041015625, 0.04967041015625, -
                2.5177001953125E-4, 13.95, -45.8
            ], ctrans, 1, (0 + time) % 1, 67, time);
            place("sprite335", canvas, ctx, [0.0491851806640625, -0.0053924560546875, 0.0053924560546875,
                0.0491851806640625, -19.6, -51.5
            ], ctrans, 1, (0 + time) % 1, 67, time);
            place("sprite339", canvas, ctx, [0.039373779296875, 0.03056640625, -0.03056640625,
                0.039373779296875, 18.9, -53.6
            ], ctrans, 1, (0 + time) % 1, 91, time);
            place("sprite401", canvas, ctx, [0.04588165283203125, 0.018596649169921875, -0.018596649169921875,
                0.04588165283203125, -14.95, -38.4
            ], ctrans, 1, (0 + time) % 1, 86, time);
            break;
        case 96:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite290", canvas, ctx, [0.049639892578125, 0.0056610107421875, -0.0056610107421875,
                0.049639892578125, -22.35, -44.75
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("sprite292", canvas, ctx, [0.04983444213867187, 0.003496551513671875, -0.003496551513671875,
                0.04983444213867187, 5.85, -17.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04829254150390625, 0.012538909912109375, -0.012538909912109375,
                0.04829254150390625, -8.5, -18.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.049959564208984376, 0.001337432861328125, 0.001337432861328125,
                0.049959564208984376, 12.05, -24.6
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04982833862304688, -0.003273773193359375, 0.003273773193359375,
                0.04982833862304688, 2.15, -22.55
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.049349212646484376, 0.0076080322265625, -0.0076080322265625,
                0.049349212646484376, -13.25, -25.9
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite303", canvas, ctx, [0.049877166748046875, -0.00305328369140625, 0.00305328369140625,
                0.049877166748046875, -12.95, -34.45
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite419", canvas, ctx, [0.0499298095703125, 0.001766204833984375, -0.001766204833984375,
                0.0499298095703125, -29.55, -92.55
            ], ctrans, 1, (0 + time) % 1, 86, time);
            place("sprite311", canvas, ctx, [0.0499298095703125, 0.001766204833984375, -0.001766204833984375,
                0.0499298095703125, -17.55, -74.05
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("shape441", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite311", canvas, ctx, [0.0499298095703125, 0.001766204833984375, -0.001766204833984375,
                0.0499298095703125, 8.45, -72.5
            ], ctrans, 1, (0 + time) % 1, 68, time);
            place("shape442", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite425", canvas, ctx, [0.0499298095703125, 0.001766204833984375, -0.001766204833984375,
                0.0499298095703125, -30.0, -100.75
            ], ctrans, 1, (0 + time) % 1, 86, time);
            place("sprite429", canvas, ctx, [0.0499298095703125, 0.001766204833984375, -0.001766204833984375,
                0.0499298095703125, -41.65, -98.25
            ], ctrans, 1, (0 + time) % 1, 86, time);
            place("shape443", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite333", canvas, ctx, [-0.007769012451171875, 0.04898910522460938, 0.04898910522460938,
                0.007769012451171875, 14.8, -34.6
            ], ctrans, 1, (0 + time) % 1, 67, time);
            place("sprite335", canvas, ctx, [0.04946746826171875, -9.918212890625E-6, 9.918212890625E-6,
                0.04946746826171875, -18.6, -42.0
            ], ctrans, 1, (0 + time) % 1, 67, time);
            place("sprite339", canvas, ctx, [0.036328125, 0.03404083251953125, -0.03404159545898437,
                0.03632965087890625, 20.55, -41.8
            ], ctrans, 1, (0 + time) % 1, 91, time);
            place("sprite401", canvas, ctx, [0.04592208862304688, 0.01834716796875, -0.01834716796875,
                0.04592208862304688, -14.55, -29.9
            ], ctrans, 1, (0 + time) % 1, 86, time);
            break;
        case 97:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.049999237060546875, -2.13623046875E-5, -2.13623046875E-5,
                0.049999237060546875, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04984130859375, -0.00331268310546875, 0.00331268310546875,
                0.04984130859375, 2.85, -13.5
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.04970703125, -0.0052398681640625, 0.0052398681640625,
                0.04970703125, -12.75, -23.75
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite371", canvas, ctx, [0.04970703125, -0.0052398681640625, 0.0052398681640625,
                0.04970703125, -34.6, -59.4
            ], ctrans, 1, (0 + time) % 1, 97, time);
            place("sprite375", canvas, ctx, [0.04970703125, -0.0052398681640625, 0.0052398681640625,
                0.04970703125, -18.45, -36.65
            ], ctrans, 1, (0 + time) % 1, 97, time);
            place("morphshape444", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite375", canvas, ctx, [-0.04970703125, 0.0052398681640625, 0.0052398681640625,
                0.04970703125, 12.5, -39.4
            ], ctrans, 1, (0 + time) % 1, 97, time);
            place("morphshape445", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite381", canvas, ctx, [0.04970703125, -0.0052398681640625, 0.0052398681640625,
                0.04970703125, -38.45, -85.6
            ], ctrans, 1, (0 + time) % 1, 97, time);
            place("sprite385", canvas, ctx, [0.04970703125, -0.0052398681640625, 0.0052398681640625,
                0.04970703125, -47.4, -76.95
            ], ctrans, 1, (0 + time) % 1, 97, time);
            place("sprite333", canvas, ctx, [-0.015602874755859374, 0.04706268310546875, 0.04706268310546875,
                0.015602874755859374, 15.75, -23.45
            ], ctrans, 1, (0 + time) % 1, 67, time);
            place("sprite335", canvas, ctx, [0.0491668701171875, 0.00531463623046875, -0.00531463623046875,
                0.0491668701171875, -17.45, -32.25
            ], ctrans, 1, (0 + time) % 1, 67, time);
            place("sprite339", canvas, ctx, [0.03300018310546875, 0.03741455078125, -0.03741378784179687,
                0.033000946044921875, 22.3, -30.2
            ], ctrans, 1, (0 + time) % 1, 91, time);
            place("sprite401", canvas, ctx, [0.046086883544921874, 0.018096160888671876, -0.018096160888671876,
                0.046086883544921874, -14.8, -16.6
            ], ctrans, 1, (0 + time) % 1, 86, time);
            break;
        case 98:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite292", canvas, ctx, [0.049715423583984376, 0.00501861572265625, -0.00501861572265625,
                0.049715423583984376, 6.7, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.049715423583984376, 0.00501861572265625, -0.00501861572265625,
                0.049715423583984376, -6.75, -8.35
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.04999847412109375, -5.340576171875E-6, -5.340576171875E-6,
                0.04999847412109375, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.049832916259765624, -0.003278350830078125, 0.003278350830078125,
                0.049832916259765624, 2.8, -13.45
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.04981842041015625, -0.003925323486328125, 0.003925323486328125,
                0.04981842041015625, -12.5, -25.5
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite371", canvas, ctx, [0.04981842041015625, -0.003925323486328125, 0.003925323486328125,
                0.04981842041015625, -33.25, -61.2
            ], ctrans, 1, (0 + time) % 1, 97, time);
            place("sprite375", canvas, ctx, [0.04981842041015625, -0.003925323486328125, 0.003925323486328125,
                0.04981842041015625, -17.75, -38.25
            ], ctrans, 1, (0 + time) % 1, 97, time);
            place("morphshape444", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 16384, time);
            place("sprite375", canvas, ctx, [-0.04981842041015625, 0.003925323486328125, 0.003925323486328125,
                0.04981842041015625, 13.35, -40.15
            ], ctrans, 1, (0 + time) % 1, 97, time);
            place("morphshape445", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 16384, time);
            place("sprite381", canvas, ctx, [0.04981842041015625, -0.003925323486328125, 0.003925323486328125,
                0.04981842041015625, -36.45, -87.55
            ], ctrans, 1, (0 + time) % 1, 97, time);
            place("sprite385", canvas, ctx, [0.04981842041015625, -0.003925323486328125, 0.003925323486328125,
                0.04981842041015625, -45.55, -79.05
            ], ctrans, 1, (0 + time) % 1, 97, time);
            place("sprite333", canvas, ctx, [-0.0167755126953125, 0.04660797119140625, 0.04660797119140625,
                0.0167755126953125, 16.05, -24.25
            ], ctrans, 1, (0 + time) % 1, 67, time);
            place("sprite335", canvas, ctx, [0.0493865966796875, 0.00259552001953125, -0.00259552001953125,
                0.0493865966796875, -17.8, -31.95
            ], ctrans, 1, (0 + time) % 1, 67, time);
            place("sprite339", canvas, ctx, [0.0319305419921875, 0.038232421875, -0.038233184814453126,
                0.03192977905273438, 22.7, -30.9
            ], ctrans, 1, (0 + time) % 1, 91, time);
            place("sprite401", canvas, ctx, [0.044793701171875, 0.020964813232421876, -0.020964813232421876,
                0.044793701171875, -14.1, -17.8
            ], ctrans, 1, (0 + time) % 1, 86, time);
            break;
        case 99:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite292", canvas, ctx, [0.049715423583984376, 0.00501861572265625, -0.00501861572265625,
                0.049715423583984376, 6.7, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.049715423583984376, 0.00501861572265625, -0.00501861572265625,
                0.049715423583984376, -6.75, -8.35
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.04999847412109375, -5.340576171875E-6, -5.340576171875E-6,
                0.04999847412109375, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.049832916259765624, -0.003278350830078125, 0.003278350830078125,
                0.049832916259765624, 2.8, -13.45
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.049913787841796876, -0.002618408203125, 0.002618408203125,
                0.049913787841796876, -12.2, -27.15
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite371", canvas, ctx, [0.049913787841796876, -0.002618408203125, 0.002618408203125,
                0.049913787841796876, -31.85, -63.05
            ], ctrans, 1, (0 + time) % 1, 97, time);
            place("sprite375", canvas, ctx, [0.049913787841796876, -0.002618408203125, 0.002618408203125,
                0.049913787841796876, -16.85, -39.75
            ], ctrans, 1, (0 + time) % 1, 97, time);
            place("morphshape444", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 32768, time);
            place("sprite375", canvas, ctx, [-0.049913787841796876, 0.002618408203125, 0.002618408203125,
                0.049913787841796876, 14.1, -40.85
            ], ctrans, 1, (0 + time) % 1, 97, time);
            place("morphshape445", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 32768, time);
            place("sprite381", canvas, ctx, [0.049913787841796876, -0.002618408203125, 0.002618408203125,
                0.049913787841796876, -34.35, -89.45
            ], ctrans, 1, (0 + time) % 1, 97, time);
            place("sprite385", canvas, ctx, [0.049913787841796876, -0.002618408203125, 0.002618408203125,
                0.049913787841796876, -43.75, -81.15
            ], ctrans, 1, (0 + time) % 1, 97, time);
            place("sprite333", canvas, ctx, [-0.01799468994140625, 0.04615097045898438, 0.04615097045898438,
                0.01799468994140625, 16.3, -25.15
            ], ctrans, 1, (0 + time) % 1, 67, time);
            place("sprite335", canvas, ctx, [0.049472808837890625, -2.3651123046875E-5, 2.3651123046875E-5,
                0.049472808837890625, -18.15, -31.55
            ], ctrans, 1, (0 + time) % 1, 67, time);
            place("sprite339", canvas, ctx, [0.03091583251953125, 0.03906173706054687, -0.03906326293945313,
                0.030918121337890625, 23.1, -31.55
            ], ctrans, 1, (0 + time) % 1, 91, time);
            place("sprite401", canvas, ctx, [0.04332275390625, 0.023857879638671874, -0.023857879638671874,
                0.04332275390625, -13.35, -19.0
            ], ctrans, 1, (0 + time) % 1, 86, time);
            break;
        case 100:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite292", canvas, ctx, [0.049715423583984376, 0.00501861572265625, -0.00501861572265625,
                0.049715423583984376, 6.7, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.049715423583984376, 0.00501861572265625, -0.00501861572265625,
                0.049715423583984376, -6.75, -8.35
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.04999847412109375, -5.340576171875E-6, -5.340576171875E-6,
                0.04999847412109375, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.049832916259765624, -0.003278350830078125, 0.003278350830078125,
                0.049832916259765624, 2.8, -13.45
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.04997329711914063, -0.00131072998046875, 0.00131072998046875,
                0.04997329711914063, -11.95, -28.9
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite371", canvas, ctx, [0.04997329711914063, -0.00131072998046875, 0.00131072998046875,
                0.04997329711914063, -30.4, -65.0
            ], ctrans, 1, (0 + time) % 1, 97, time);
            place("sprite375", canvas, ctx, [0.04997329711914063, -0.00131072998046875, 0.00131072998046875,
                0.04997329711914063, -16.2, -41.3
            ], ctrans, 1, (0 + time) % 1, 97, time);
            place("morphshape444", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 49152, time);
            place("sprite375", canvas, ctx, [-0.04997329711914063, 0.00131072998046875, 0.00131072998046875,
                0.04997329711914063, 14.95, -41.6
            ], ctrans, 1, (0 + time) % 1, 97, time);
            place("morphshape445", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 49152, time);
            place("sprite381", canvas, ctx, [0.04997329711914063, -0.00131072998046875, 0.00131072998046875,
                0.04997329711914063, -32.25, -91.45
            ], ctrans, 1, (0 + time) % 1, 97, time);
            place("sprite385", canvas, ctx, [0.04997329711914063, -0.00131072998046875, 0.00131072998046875,
                0.04997329711914063, -41.95, -83.25
            ], ctrans, 1, (0 + time) % 1, 97, time);
            place("sprite333", canvas, ctx, [-0.01920013427734375, 0.045664215087890626, 0.045664215087890626,
                0.01920013427734375, 16.6, -26.1
            ], ctrans, 1, (0 + time) % 1, 67, time);
            place("sprite335", canvas, ctx, [0.04939422607421875, -0.002805328369140625, 0.002805328369140625,
                0.04939422607421875, -18.35, -31.15
            ], ctrans, 1, (0 + time) % 1, 67, time);
            place("sprite339", canvas, ctx, [0.029883575439453126, 0.039865875244140626, -0.039865875244140626,
                0.0298828125, 23.55, -32.3
            ], ctrans, 1, (0 + time) % 1, 91, time);
            place("sprite401", canvas, ctx, [0.041666412353515626, 0.026650238037109374, -0.026650238037109374,
                0.041666412353515626, -12.65, -20.15
            ], ctrans, 1, (0 + time) % 1, 86, time);
            break;
        case 101:
            place("shape286", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, 6.65, -8.25
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite292", canvas, ctx, [0.04972763061523437, 0.0050506591796875, -0.0050506591796875,
                0.04972763061523437, -6.75, -8.3
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("sprite296", canvas, ctx, [-0.049999237060546875, -2.13623046875E-5, -2.13623046875E-5,
                0.049999237060546875, 13.05, -15.4
            ], ctrans, 1, (0 + time) % 1, 0, time);
            place("shape297", canvas, ctx, [0.04984130859375, -0.00331268310546875, 0.00331268310546875,
                0.04984130859375, 2.85, -13.5
            ], ctrans, 1, 0, 0, time);
            place("sprite296", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -12.65, -15.05], ctrans, 1, (0 + time) % 1,
                0, time);
            place("sprite303", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -11.6, -30.3], ctrans, 1, (0 + time) % 1, 0,
                time);
            place("sprite371", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -29.25, -66.85], ctrans, 1, (0 + time) % 1,
                97, time);
            place("sprite375", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -15.55, -42.55], ctrans, 1, (0 + time) % 1,
                97, time);
            place("shape414", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite375", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 15.5, -42.05], ctrans, 1, (0 + time) % 1,
                97, time);
            place("shape415", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 0.0, 0.0], ctrans, 1, 0, 0, time);
            place("sprite381", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -30.35, -93.35], ctrans, 1, (0 + time) % 1,
                97, time);
            place("sprite385", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -40.15, -85.65], ctrans, 1, (0 + time) % 1,
                97, time);
            place("sprite333", canvas, ctx, [-0.020458221435546875, 0.04518280029296875, 0.04518280029296875,
                0.020458221435546875, 16.7, -27.0
            ], ctrans, 1, (0 + time) % 1, 67, time);
            place("sprite335", canvas, ctx, [0.04918670654296875, -0.00550994873046875, 0.00550994873046875,
                0.04918670654296875, -18.5, -30.65
            ], ctrans, 1, (0 + time) % 1, 67, time);
            place("sprite339", canvas, ctx, [0.028905487060546874, 0.040682220458984376, -0.04068145751953125,
                0.02890625, 23.95, -33.05
            ], ctrans, 1, (0 + time) % 1, 91, time);
            place("sprite401", canvas, ctx, [0.0398529052734375, 0.02942962646484375, -0.02942962646484375,
                0.0398529052734375, -11.95, -21.4
            ], ctrans, 1, (0 + time) % 1, 86, time);
            break;
    }
    ctx.restore();
}

var frame = -1;
var time = 0;
var frames = [];
frames.push(0);
frames.push(1);
frames.push(2);
frames.push(3);
frames.push(4);
frames.push(5);
frames.push(6);
frames.push(7);
frames.push(8);
frames.push(9);
frames.push(10);
frames.push(11);
frames.push(12);
frames.push(13);
frames.push(14);
frames.push(15);
frames.push(16);
frames.push(17);
frames.push(18);
frames.push(19);
frames.push(20);
frames.push(21);
frames.push(22);
frames.push(23);
frames.push(24);
frames.push(25);
frames.push(26);
frames.push(27);
frames.push(28);
frames.push(29);
frames.push(30);
frames.push(31);
frames.push(32);
frames.push(33);
frames.push(34);
frames.push(35);
frames.push(36);
frames.push(37);
frames.push(38);
frames.push(39);
frames.push(40);
frames.push(41);
frames.push(42);
frames.push(43);
frames.push(44);
frames.push(45);
frames.push(46);
frames.push(47);
frames.push(48);
frames.push(49);
frames.push(50);
frames.push(51);
frames.push(52);
frames.push(53);
frames.push(54);
frames.push(55);
frames.push(56);
frames.push(57);
frames.push(58);
frames.push(59);
frames.push(60);
frames.push(61);
frames.push(62);
frames.push(63);
frames.push(64);
frames.push(65);
frames.push(66);
frames.push(67);
frames.push(68);
frames.push(69);
frames.push(70);
frames.push(71);
frames.push(72);
frames.push(73);
frames.push(74);
frames.push(75);
frames.push(76);
frames.push(77);
frames.push(78);
frames.push(79);
frames.push(80);
frames.push(81);
frames.push(82);
frames.push(83);
frames.push(84);
frames.push(85);
frames.push(86);
frames.push(87);
frames.push(88);
frames.push(89);
frames.push(90);
frames.push(91);
frames.push(92);
frames.push(93);
frames.push(94);
frames.push(95);
frames.push(96);
frames.push(97);
frames.push(98);
frames.push(99);
frames.push(100);
frames.push(101);

var backgroundColor = "#c6481d";
var originalWidth = 96;
var originalHeight = 153;

function nextFrame(ctx, ctrans) {
    var oldframe = frame;
    frame = (frame + 1) % frames.length;
    if (frame == oldframe) {
        time++;
    } else {
        time = 0;
    };
    drawFrame();
}

function drawFrame() {
    ctx.fillStyle = backgroundColor;
    ctx.fillRect(0, 0, canvas.width, canvas.height);
    ctx.save();
    ctx.transform(canvas.width / originalWidth, 0, 0, canvas.height / originalHeight, 0, 0);
    sprite446(ctx, ctrans, frames[frame], 0, time);
    ctx.restore();
}

window.setInterval(function() {
    nextFrame(ctx, ctrans);
}, 62);
nextFrame(ctx, ctrans);


