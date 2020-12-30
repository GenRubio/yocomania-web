<div>
    <canvas id="myCanvas" width="370" height="930">
        Your browser does not support the HTML5 canvas tag.
    </canvas>
</div>

<script>
    Filters = {};

    var createCanvas = function(width, height) {
        var c = document.createElement("canvas");
        c.width = width;
        c.height = height;
        c.style.display = "none";
        //temporary add to document to get this work (getImageData, etc.)
        document.body.appendChild(c);
        document.body.removeChild(c);
        return c;
    };

    Filters._premultiply = function(data) {
        var len = data.length;
        for (var i = 0; i < len; i += 4) {
            var f = data[i + 3] * 0.003921569;
            data[i] = Math.round(data[i] * f);
            data[i + 1] = Math.round(data[i + 1] * f);
            data[i + 2] = Math.round(data[i + 2] * f);
        }
    };

    Filters._unpremultiply = function(data) {
        var len = data.length;
        for (var i = 0; i < len; i += 4) {
            var a = data[i + 3];
            if (a == 0 || a == 255) {
                continue;
            }
            var f = 255 / a;
            var r = (data[i] * f);
            var g = (data[i + 1] * f);
            var b = (data[i + 2] * f);
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
        var index = 0;
        var newColors = [];

        for (var y = 0; y < h; y++) {
            var hits = 0;
            var r = 0;
            var g = 0;
            var b = 0;
            var a = 0;
            for (var x = -radius * 4; x < w * 4; x += 4) {
                var oldPixel = x - radius * 4 - 4;
                if (oldPixel >= 0) {
                    if ((maskType == 0) || (maskType == 1 && mask[index + oldPixel + 3] > 0) || (maskType == 2 &&
                            mask[index + oldPixel + 3] < 255)) {
                        a -= pixels[index + oldPixel + 3];
                        r -= pixels[index + oldPixel];
                        g -= pixels[index + oldPixel + 1];
                        b -= pixels[index + oldPixel + 2];
                        hits--;
                    }
                }

                var newPixel = x + radius * 4;
                if (newPixel < w * 4) {
                    if ((maskType == 0) || (maskType == 1 && mask[index + newPixel + 3] > 0) || (maskType == 2 &&
                            mask[index + newPixel + 3] < 255)) {
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
            for (var p = 0; p < w * 4; p += 4) {
                pixels[index + p] = newColors[p];
                pixels[index + p + 1] = newColors[p + 1];
                pixels[index + p + 2] = newColors[p + 2];
                pixels[index + p + 3] = newColors[p + 3];
            }

            index += w * 4;
        }
    };

    Filters._boxBlurVertical = function(pixels, mask, w, h, radius, maskType) {
        var newColors = [];
        var oldPixelOffset = -(radius + 1) * w * 4;
        var newPixelOffset = (radius) * w * 4;

        for (var x = 0; x < w * 4; x += 4) {
            var hits = 0;
            var r = 0;
            var g = 0;
            var b = 0;
            var a = 0;
            var index = -radius * w * 4 + x;
            for (var y = -radius; y < h; y++) {
                var oldPixel = y - radius - 1;
                if (oldPixel >= 0) {
                    if ((maskType == 0) || (maskType == 1 && mask[index + oldPixelOffset + 3] > 0) || (maskType ==
                            2 && mask[index + oldPixelOffset + 3] < 255)) {
                        a -= pixels[index + oldPixelOffset + 3];
                        r -= pixels[index + oldPixelOffset];
                        g -= pixels[index + oldPixelOffset + 1];
                        b -= pixels[index + oldPixelOffset + 2];
                        hits--;
                    }

                }

                var newPixel = y + radius;
                if (newPixel < h) {
                    if ((maskType == 0) || (maskType == 1 && mask[index + newPixelOffset + 3] > 0) || (maskType ==
                            2 && mask[index + newPixelOffset + 3] < 255)) {
                        a += pixels[index + newPixelOffset + 3];
                        r += pixels[index + newPixelOffset];
                        g += pixels[index + newPixelOffset + 1];
                        b += pixels[index + newPixelOffset + 2];
                        hits++;
                    }
                }

                if (y >= 0) {
                    if ((maskType == 0) || (maskType == 1 && mask[y * w * 4 + x + 3] > 0) || (maskType == 2 && mask[
                            y * w * 4 + x + 3] < 255)) {
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

            for (var y = 0; y < h; y++) {
                pixels[y * w * 4 + x] = newColors[4 * y];
                pixels[y * w * 4 + x + 1] = newColors[4 * y + 1];
                pixels[y * w * 4 + x + 2] = newColors[4 * y + 2];
                pixels[y * w * 4 + x + 3] = newColors[4 * y + 3];
            }
        }
    };


    Filters.blur = function(canvas, ctx, hRadius, vRadius, iterations, mask, maskType) {
        var imgData = ctx.getImageData(0, 0, canvas.width, canvas.height);
        var data = imgData.data;
        Filters._premultiply(data);
        for (var i = 0; i < iterations; i++) {
            Filters._boxBlurHorizontal(data, mask, canvas.width, canvas.height, Math.floor(hRadius / 2), maskType);
            Filters._boxBlurVertical(data, mask, canvas.width, canvas.height, Math.floor(vRadius / 2), maskType);
        }

        Filters._unpremultiply(data);

        var width = canvas.width;
        var height = canvas.height;
        var retCanvas = createCanvas(width, height);
        var retImg = retCanvas.getContext("2d");
        retImg.putImageData(imgData, 0, 0);
        return retCanvas;
    }

    Filters._moveRGB = function(width, height, rgb, deltaX, deltaY, fill) {
        var img = createCanvas(width, height);

        var ig = img.getContext("2d");

        Filters._setRGB(ig, 0, 0, width, height, rgb);
        var retImg = createCanvas(width, height);
        retImg.width = width;
        retImg.heigth = height;
        var g = retImg.getContext("2d");
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
        var id = ctx.createImageData(width, height);
        for (var i = 0; i < data.length; i++) {
            id.data[i] = data[i];
        }
        ctx.putImageData(id, x, y);
    };

    Filters.gradientGlow = function(srcCanvas, src, blurX, blurY, angle, distance, colors, ratios, type, iterations,
        strength, knockout) {
        var width = canvas.width;
        var height = canvas.height;
        var retCanvas = createCanvas(width, height);
        var retImg = retCanvas.getContext("2d");

        var gradCanvas = createCanvas(256, 1);

        var gradient = gradCanvas.getContext("2d");
        var grd = ctx.createLinearGradient(0, 0, 255, 0);
        for (var s = 0; s < colors.length; s++) {
            var v = "rgba(" + colors[s][0] + "," + colors[s][1] + "," + colors[s][2] + "," + colors[s][3] + ")";
            grd.addColorStop(ratios[s], v);
        }
        gradient.fillStyle = grd;
        gradient.fillRect(0, 0, 256, 1);
        var gradientPixels = gradient.getImageData(0, 0, gradCanvas.width, gradCanvas.height).data;

        var angleRad = angle / 180 * Math.PI;
        var moveX = (distance * Math.cos(angleRad));
        var moveY = (distance * Math.sin(angleRad));
        var srcPixels = src.getImageData(0, 0, width, height).data;
        var shadow = [];
        for (var i = 0; i < srcPixels.length; i += 4) {
            var alpha = srcPixels[i + 3];
            shadow[i] = 0;
            shadow[i + 1] = 0;
            shadow[i + 2] = 0;
            shadow[i + 3] = Math.round(alpha * strength);
        }
        var colorAlpha = "rgba(0,0,0,0)";
        shadow = Filters._moveRGB(width, height, shadow, moveX, moveY, colorAlpha);

        Filters._setRGB(retImg, 0, 0, width, height, shadow);

        var maskType = 0;
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
            for (var i = 0; i < srcPixels.length; i += 4) {
                if ((maskType == 1 && srcPixels[i + 3] == 0) || (maskType == 2 && srcPixels[i + 3] == 255)) {
                    shadow[i] = 0;
                    shadow[i + 1] = 0;
                    shadow[i + 2] = 0;
                    shadow[i + 3] = 0;
                }
            }
        }





        for (var i = 0; i < shadow.length; i += 4) {
            var a = shadow[i + 3];
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
            var hilightIm = Filters.dropShadow(canvas, src, 0, 0, angle, distance, [255, 0, 0, 1], true, iterations,
                strength, true);
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
            var shadowIm = Filters.dropShadow(canvas, src, 0, 0, angle, distance, [0, 0, 255, 1], false, iterations,
                strength, true);
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
    Filters.bevel = function(canvas, src, blurX, blurY, strength, type, highlightColor, shadowColor, angle, distance,
        knockout, iterations) {
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
        return Filters.dropShadow(canvas, src, blurX, blurY, 45, 0, color, inner, iterations, strength, knockout);
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
            return new cxform(this.r_add + cx.r_add, this.g_add + cx.g_add, this.b_add + cx.b_add, this.a_add +
                cx.a_add, this.r_mult * cx.r_mult / 255, this.g_mult * cx.g_mult / 255, this.b_mult * cx
                .b_mult / 255, this.a_mult * cx.a_mult / 255);
        };
        this.isEmpty = function() {
            return this.r_add == 0 && this.g_add == 0 && this.b_add == 0 && this.a_add == 0 && this.r_mult ==
                255 && this.g_mult == 255 && this.b_mult == 255 && this.a_mult == 255;
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



    window.addEventListener('load', function() {

        var wsize = document.getElementById("width_size");
        var hsize = document.getElementById("height_size");
    });

    var startWidth = 0;
    var startHeight = 0;
    var dragWidth = false;
    var dragHeight = false;

    function initDragWidth(e) {
        dragWidth = true;
        dragHeight = false;
        initDrag(e);
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
                            ctx.quadraticCurveTo(useRatio(parts[i], parts[i + 1], ratio), useRatio(parts[i + 2], parts[
                                    i + 3], ratio),
                                useRatio(parts[i + 4], parts[i + 5], ratio), useRatio(parts[i + 6], parts[i + 7],
                                    ratio));
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

    function shape192(ctx, ctrans, frame, ratio, time) {
        var pathData = "M -605 421 L -128 421 -128 623 -605 623 -605 421";
        ctx.fillStyle = tocolor(ctrans.apply([104, 124, 130, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M -605 421 L -729 421 -729 0 0 0 0 421 -128 421 -605 421";
        ctx.fillStyle = tocolor(ctrans.apply([122, 146, 154, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M -128 623 L -128 1080 -605 1080 -605 623 -128 623";
        ctx.fillStyle = tocolor(ctrans.apply([126, 151, 159, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
    }

    function sprite193(ctx, ctrans, frame, ratio, time) {
        var clips = [];
        var frame_cnt = 1;
        frame = frame % frame_cnt;
        switch (frame) {
            case 0:
                place("shape192", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
                break;
        }
    }

    function shape194(ctx, ctrans, frame, ratio, time) {
        var pathData =
            "M 345 0 Q 366 0 387 43 454 215 454 437 L 459 683 Q 367 635 253 661 L 345 0 M 459 745 Q 461 994 453 1244 L 430 1687 419 1821 277 1818 Q 316 1467 289 1150 252 1072 215 1153 L 214 1155 249 718 Q 356 690 459 745";
        ctx.fillStyle = tocolor(ctrans.apply([22, 26, 31, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 165 1797 L 158 1683 Q 146 1452 150 1228 L 178 743 Q 213 726 249 718 L 214 1155 Q 157 1467 165 1797 M 184 682 Q 196 565 214 451 236 221 303 48 324 2 345 0 L 253 661 Q 219 668 184 682";
        ctx.fillStyle = tocolor(ctrans.apply([60, 66, 75, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M 178 743 L 184 682 Q 219 668 253 661 L 249 718 Q 213 726 178 743";
        ctx.fillStyle = tocolor(ctrans.apply([210, 68, 68, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M 459 683 L 459 745 Q 356 690 249 718 L 253 661 Q 367 635 459 683";
        ctx.fillStyle = tocolor(ctrans.apply([202, 35, 35, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M 533 1286 Q 549 1239 586 1284 595 1295 600 1339 605 1385 590 1721 L 514 1726 533 1286";
        ctx.fillStyle = tocolor(ctrans.apply([131, 18, 18, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M 453 1244 L 533 1286 514 1726 430 1687 453 1244";
        ctx.fillStyle = tocolor(ctrans.apply([147, 65, 65, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 277 1818 L 166 1825 Q 243 1484 215 1153 252 1072 289 1150 316 1467 277 1818 M 66 1721 L 1 1725 0 1272 Q 37 1208 62 1274 L 66 1721";
        ctx.fillStyle = tocolor(ctrans.apply([162, 26, 26, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M 166 1825 L 165 1797 Q 157 1467 214 1155 L 215 1153 Q 243 1484 166 1825";
        ctx.fillStyle = tocolor(ctrans.apply([160, 58, 58, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M 158 1683 L 66 1721 62 1274 150 1228 Q 146 1452 158 1683";
        ctx.fillStyle = tocolor(ctrans.apply([169, 76, 76, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
    }

    function sprite195(ctx, ctrans, frame, ratio, time) {
        var clips = [];
        var frame_cnt = 1;
        frame = frame % frame_cnt;
        switch (frame) {
            case 0:
                place("shape194", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
                break;
        }
    }

    function shape164(ctx, ctrans, frame, ratio, time) {
        var pathData =
            "M 2927 0 Q 2927 395 2069 672 1212 952 0 952 -1213 952 -2071 672 -2928 395 -2928 0 -2928 -50 -2914 -100 -2818 -431 -2071 -676 -1213 -952 0 -952 1212 -952 2069 -676 2817 -431 2914 -100 2927 -50 2927 0";
        ctx.fillStyle = tocolor(ctrans.apply([0, 0, 0, 0.13333334]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
    }

    function shape165(ctx, ctrans, frame, ratio, time) {
        var pathData =
            "M 1361 -290 Q 1392 -151 1392 0 1392 543 984 926 577 1310 0 1310 -577 1310 -985 926 -1313 618 -1376 206 145 -551 1361 -290";
        ctx.fillStyle = tocolor(ctrans.apply([143, 74, 118, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M -1376 206 Q -1392 106 -1392 0 -1392 -543 -985 -927 -577 -1310 0 -1310 577 -1310 984 -927 1278 -650 1361 -290 145 -551 -1376 206";
        ctx.fillStyle = tocolor(ctrans.apply([103, 74, 94, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
    }

    function shape166(ctx, ctrans, frame, ratio, time) {
        var pathData = "M 610 -646 L 833 -425 Q 837 -384 664 -530 534 -621 610 -646";
        ctx.fillStyle = tocolor(ctrans.apply([57, 74, 90, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 460 -182 Q 470 -227 505 -262 556 -313 628 -313 700 -313 750 -262 795 -217 801 -157 800 -119 791 -79 712 -155 596 -187 L 598 -200 Q 598 -217 586 -229 575 -240 558 -240 541 -240 529 -229 518 -217 518 -200 L 518 -197 Q 469 -204 460 -182";
        ctx.fillStyle = tocolor(ctrans.apply([162, 193, 214, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 801 -157 Q 795 -217 750 -262 700 -313 628 -313 556 -313 505 -262 470 -227 460 -182 204 -264 -116 -255 L -97 -297 Q -90 -323 -90 -352 -90 -431 -145 -486 -201 -542 -280 -542 -358 -542 -414 -486 -469 -431 -469 -352 -469 -311 -453 -275 -442 -249 -421 -226 L -452 -221 Q -494 -209 -511 -180 L -533 -231 Q -546 -271 -546 -312 L -546 -313 Q -546 -361 -529 -411 -436 -638 80 -621 470 -603 724 -379 802 -273 801 -157";
        ctx.fillStyle = tocolor(ctrans.apply([130, 167, 196, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 518 -197 L 518 -200 Q 518 -217 529 -229 541 -240 558 -240 575 -240 586 -229 598 -217 598 -200 L 596 -187 586 -172 Q 575 -160 558 -160 541 -160 529 -172 519 -182 518 -197 M -400 -362 L -406 -367 Q -417 -378 -417 -395 -417 -412 -406 -424 -394 -435 -377 -435 -360 -435 -349 -424 -337 -412 -337 -395 L -341 -377 -349 -367 Q -360 -355 -377 -355 -390 -355 -400 -362";
        ctx.fillStyle = tocolor(ctrans.apply([61, 79, 89, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 460 -182 Q 469 -204 518 -197 519 -182 529 -172 541 -160 558 -160 575 -160 586 -172 L 596 -187 Q 712 -155 791 -79 L 779 -54 Q 570 23 456 -124 L 455 -140 460 -182";
        ctx.fillStyle = tocolor(ctrans.apply([222, 241, 255, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M -511 -180 Q -494 -209 -452 -221 -353 -125 -258 -164 -193 -171 -145 -218 -128 -235 -116 -255 204 -264 460 -182 L 455 -140 456 -124 Q 460 -70 494 -29 503 12 535 36 413 64 251 55 L 268 41 Q 220 56 179 41 -228 3 -496 -155 L -511 -180";
        ctx.fillStyle = tocolor(ctrans.apply([194, 229, 251, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 779 -54 L 791 -79 778 -36 748 11 716 48 692 71 Q 586 74 535 36 503 12 494 -29 L 505 -17 Q 556 33 628 33 700 33 750 -17 L 779 -54";
        ctx.fillStyle = tocolor(ctrans.apply([134, 179, 210, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 456 -124 Q 570 23 779 -54 L 750 -17 Q 700 33 628 33 556 33 505 -17 L 494 -29 Q 460 -70 456 -124";
        ctx.fillStyle = tocolor(ctrans.apply([203, 226, 242, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 748 11 Q 821 71 901 194 954 290 901 272 837 234 752 104 795 388 769 369 720 357 716 48 L 748 11";
        ctx.fillStyle = tocolor(ctrans.apply([95, 149, 187, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 692 71 Q 629 126 540 156 434 191 291 191 -15 160 -220 69 -309 22 -373 -28 -453 -90 -496 -155 -228 3 179 41 188 52 198 59 222 74 251 55 413 64 535 36 586 74 692 71 M 166 127 Q 271 238 362 100 272 190 166 127";
        ctx.fillStyle = tocolor(ctrans.apply([181, 221, 247, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 540 156 Q 523 195 483 219 371 285 77 238 -170 196 -304 61 L -313 52 Q -347 15 -373 -28 -309 22 -220 69 -15 160 291 191 434 191 540 156 M 436 247 Q 445 313 398 322 151 356 -116 276 -34 334 123 366 368 364 403 343 L 430 390 Q 345 482 97 471 L 97 434 Q 83 397 -2 434 -224 359 -315 96 L -304 62 Q -216 209 15 247 317 292 436 247";
        ctx.fillStyle = tocolor(ctrans.apply([115, 176, 220, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 483 219 Q 465 235 436 247 317 292 15 247 -216 209 -304 62 L -304 61 Q -170 196 77 238 371 285 483 219";
        ctx.fillStyle = tocolor(ctrans.apply([101, 158, 201, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 179 41 Q 220 56 268 41 L 251 55 Q 222 74 198 59 188 52 179 41 M 166 127 Q 272 190 362 100 271 238 166 127";
        ctx.fillStyle = tocolor(ctrans.apply([102, 155, 187, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M -2 434 Q 83 397 97 434 L 97 471 97 617 17 629 Q -17 485 -2 434";
        ctx.fillStyle = tocolor(ctrans.apply([126, 144, 158, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 430 390 Q 485 503 489 645 L 386 632 Q 406 500 394 482 315 435 311 482 L 311 629 Q 276 630 262 639 247 652 247 673 232 580 149 611 L 97 617 97 471 Q 345 482 430 390";
        ctx.fillStyle = tocolor(ctrans.apply([140, 204, 248, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M 311 629 L 311 482 Q 315 435 394 482 406 500 386 632 L 311 629";
        ctx.fillStyle = tocolor(ctrans.apply([126, 143, 159, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M 398 322 Q 417 334 403 343 368 364 123 366 -34 334 -116 276 151 356 398 322";
        ctx.fillStyle = tocolor(ctrans.apply([106, 161, 200, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 489 645 L 489 677 Q 484 752 431 764 L 249 764 262 724 446 724 Q 382 693 249 692 L 247 673 Q 247 652 262 639 276 630 311 629 L 386 632 489 645";
        ctx.fillStyle = tocolor(ctrans.apply([184, 224, 249, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
        "M 249 764 L -80 764 -100 750 Q -89 659 -50 652 -69 705 50 684 L 247 673 249 692 262 724 249 764";
        ctx.fillStyle = tocolor(ctrans.apply([147, 190, 222, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M 249 692 Q 382 693 446 724 L 262 724 249 692";
        ctx.fillStyle = tocolor(ctrans.apply([149, 190, 222, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M 17 629 L 97 617 149 611 Q 232 580 247 673 L 50 684 Q -69 705 -50 652 -49 640 17 629";
        ctx.fillStyle = tocolor(ctrans.apply([185, 227, 252, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M -50 -797 Q -11 -826 17 -797 28 -761 -82 -700 -323 -597 -349 -622 -175 -702 -50 -797";
        ctx.fillStyle = tocolor(ctrans.apply([80, 96, 109, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M -453 -275 Q -469 -311 -469 -352 -469 -431 -414 -486 -358 -542 -280 -542 -201 -542 -145 -486 -90 -431 -90 -352 -90 -323 -97 -297 -109 -318 -127 -333 -194 -392 -341 -377 L -337 -395 Q -337 -412 -349 -424 -360 -435 -377 -435 -394 -435 -406 -424 -417 -412 -417 -395 -417 -378 -406 -367 L -400 -362 Q -458 -341 -453 -275";
        ctx.fillStyle = tocolor(ctrans.apply([162, 192, 216, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M -452 -221 L -421 -226 -414 -218 Q -358 -163 -280 -163 L -258 -164 Q -353 -125 -452 -221";
        ctx.fillStyle = tocolor(ctrans.apply([157, 199, 224, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M -421 -226 Q -442 -249 -453 -275 -276 -174 -127 -333 -109 -318 -97 -297 L -116 -255 Q -128 -235 -145 -218 -193 -171 -258 -164 L -280 -163 Q -358 -163 -414 -218 L -421 -226";
        ctx.fillStyle = tocolor(ctrans.apply([203, 226, 244, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M -546 -312 Q -546 -271 -533 -231 -519 -58 -559 116 -584 243 -651 275 -687 279 -651 170 -579 -11 -570 -175 -645 -34 -793 97 -875 174 -917 143 -951 106 -877 68 -710 -21 -656 -116 -622 -222 -546 -312";
        ctx.fillStyle = tocolor(ctrans.apply([96, 150, 184, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M -341 -377 Q -194 -392 -127 -333 -276 -174 -453 -275 -458 -341 -400 -362 -390 -355 -377 -355 -360 -355 -349 -367 L -341 -377";
        ctx.fillStyle = tocolor(ctrans.apply([222, 239, 255, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M -331 154 L -315 96 Q -224 359 -2 434 -17 485 17 629 -49 640 -50 652 -89 659 -100 750 -350 565 -331 154";
        ctx.fillStyle = tocolor(ctrans.apply([139, 203, 247, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M -80 764 Q -112 783 -228 807 -378 839 -388 645 -389 374 -331 154 -350 565 -100 750 L -80 764";
        ctx.fillStyle = tocolor(ctrans.apply([104, 161, 204, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
    }

    function shape167(ctx, ctrans, frame, ratio, time) {
        var pathData = "M 610 -646 L 833 -425 Q 837 -384 664 -530 534 -621 610 -646";
        ctx.fillStyle = tocolor(ctrans.apply([57, 74, 90, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 519 -210 L 518 -200 518 -197 Q 469 -204 460 -182 L 474 -221 519 -210 M 596 -187 L 597 -191 801 -142 791 -79 Q 712 -155 596 -187";
        ctx.fillStyle = tocolor(ctrans.apply([162, 193, 214, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 597 -191 L 519 -210 474 -221 460 -182 Q 204 -264 -116 -255 L -97 -297 Q -90 -323 -90 -352 L -90 -356 -343 -417 -397 -430 -447 -442 -448 -440 Q -469 -401 -469 -352 L -463 -305 -452 -303 -236 -253 -134 -229 -145 -218 Q -193 -171 -258 -164 L -280 -163 Q -358 -163 -414 -218 L -421 -226 -452 -221 Q -494 -209 -511 -180 L -533 -231 Q -546 -271 -546 -312 L -546 -313 Q -546 -361 -529 -411 -436 -638 80 -621 470 -603 724 -379 802 -273 801 -157 L 801 -142 597 -191 M 494 -29 Q 471 -57 462 -90 L 495 -83 707 -33 755 -22 750 -17 Q 700 33 628 33 556 33 505 -17 L 494 -29";
        ctx.fillStyle = tocolor(ctrans.apply([130, 167, 196, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 518 -197 L 518 -200 519 -210 597 -191 596 -187 586 -172 Q 575 -160 558 -160 541 -160 529 -172 519 -182 518 -197 M -400 -362 L -406 -367 Q -417 -378 -417 -395 -417 -412 -406 -424 L -397 -430 -343 -417 Q -337 -407 -337 -395 L -341 -377 -349 -367 Q -360 -355 -377 -355 -390 -355 -400 -362";
        ctx.fillStyle = tocolor(ctrans.apply([61, 79, 89, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 518 -197 Q 519 -182 529 -172 541 -160 558 -160 575 -160 586 -172 L 596 -187 Q 712 -155 791 -79 L 779 -54 Q 742 -40 707 -33 L 495 -83 456 -124 455 -140 460 -182 Q 469 -204 518 -197";
        ctx.fillStyle = tocolor(ctrans.apply([222, 241, 255, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 460 -182 L 455 -140 456 -124 462 -90 Q 471 -57 494 -29 503 12 535 36 413 64 251 55 L 268 41 Q 220 56 179 41 -228 3 -496 -155 L -511 -180 Q -494 -209 -452 -221 -353 -125 -258 -164 -193 -171 -145 -218 L -134 -229 -116 -255 Q 204 -264 460 -182";
        ctx.fillStyle = tocolor(ctrans.apply([194, 229, 251, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 535 36 Q 503 12 494 -29 L 505 -17 Q 556 33 628 33 700 33 750 -17 L 755 -22 779 -54 791 -79 778 -36 769 -19 748 11 716 48 692 71 Q 586 74 535 36";
        ctx.fillStyle = tocolor(ctrans.apply([134, 179, 210, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M 462 -90 L 456 -124 495 -83 462 -90 M 707 -33 Q 742 -40 779 -54 L 755 -22 707 -33";
        ctx.fillStyle = tocolor(ctrans.apply([203, 226, 242, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 748 11 Q 821 71 901 194 954 290 901 272 837 234 752 104 795 388 769 369 720 357 716 48 L 748 11";
        ctx.fillStyle = tocolor(ctrans.apply([95, 149, 187, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M -496 -155 Q -228 3 179 41 188 52 198 59 222 74 251 55 413 64 535 36 586 74 692 71 629 126 540 156 434 191 291 191 -15 160 -220 69 -309 22 -373 -28 -453 -90 -496 -155 M 362 100 Q 272 190 166 127 271 238 362 100";
        ctx.fillStyle = tocolor(ctrans.apply([181, 221, 247, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 540 156 Q 523 195 483 219 371 285 77 238 -170 196 -304 61 L -313 52 Q -347 15 -373 -28 -309 22 -220 69 -15 160 291 191 434 191 540 156 M 436 247 Q 445 313 398 322 151 356 -116 276 -34 334 123 366 368 364 403 343 L 430 390 Q 345 482 97 471 L 97 434 Q 83 397 -2 434 -224 359 -315 96 L -304 62 Q -216 209 15 247 317 292 436 247";
        ctx.fillStyle = tocolor(ctrans.apply([115, 176, 220, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 483 219 Q 465 235 436 247 317 292 15 247 -216 209 -304 62 L -304 61 Q -170 196 77 238 371 285 483 219";
        ctx.fillStyle = tocolor(ctrans.apply([101, 158, 201, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 179 41 Q 220 56 268 41 L 251 55 Q 222 74 198 59 188 52 179 41 M 362 100 Q 271 238 166 127 272 190 362 100";
        ctx.fillStyle = tocolor(ctrans.apply([102, 155, 187, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M -2 434 Q 83 397 97 434 L 97 471 97 617 17 629 Q -17 485 -2 434";
        ctx.fillStyle = tocolor(ctrans.apply([126, 144, 158, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 430 390 Q 485 503 489 645 L 386 632 Q 406 500 394 482 315 435 311 482 L 311 629 Q 276 630 262 639 247 652 247 673 232 580 149 611 L 97 617 97 471 Q 345 482 430 390";
        ctx.fillStyle = tocolor(ctrans.apply([140, 204, 248, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M 311 629 L 311 482 Q 315 435 394 482 406 500 386 632 L 311 629";
        ctx.fillStyle = tocolor(ctrans.apply([126, 143, 159, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M 398 322 Q 417 334 403 343 368 364 123 366 -34 334 -116 276 151 356 398 322";
        ctx.fillStyle = tocolor(ctrans.apply([106, 161, 200, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 489 645 L 489 677 Q 484 752 431 764 L 249 764 262 724 446 724 Q 382 693 249 692 L 247 673 Q 247 652 262 639 276 630 311 629 L 386 632 489 645";
        ctx.fillStyle = tocolor(ctrans.apply([184, 224, 249, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
        "M 249 764 L -80 764 -100 750 Q -89 659 -50 652 -69 705 50 684 L 247 673 249 692 262 724 249 764";
        ctx.fillStyle = tocolor(ctrans.apply([147, 190, 222, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M 249 692 Q 382 693 446 724 L 262 724 249 692";
        ctx.fillStyle = tocolor(ctrans.apply([149, 190, 222, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M 17 629 L 97 617 149 611 Q 232 580 247 673 L 50 684 Q -69 705 -50 652 -49 640 17 629";
        ctx.fillStyle = tocolor(ctrans.apply([185, 227, 252, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M -50 -797 Q -11 -826 17 -797 28 -761 -82 -700 -323 -597 -349 -622 -175 -702 -50 -797";
        ctx.fillStyle = tocolor(ctrans.apply([80, 96, 109, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M -452 -303 L -463 -305 -469 -352 Q -469 -401 -448 -440 L -447 -442 -397 -430 -406 -424 Q -417 -412 -417 -395 -417 -378 -406 -367 L -400 -362 Q -445 -346 -452 -303 M -343 -417 L -90 -356 -90 -352 Q -90 -323 -97 -297 -109 -318 -127 -333 -194 -392 -341 -377 L -337 -395 Q -337 -407 -343 -417";
        ctx.fillStyle = tocolor(ctrans.apply([162, 192, 216, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M -258 -164 Q -353 -125 -452 -221 L -421 -226 -414 -218 Q -358 -163 -280 -163 L -258 -164";
        ctx.fillStyle = tocolor(ctrans.apply([157, 199, 224, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M -116 -255 L -134 -229 -236 -253 Q -180 -276 -127 -333 -109 -318 -97 -297 L -116 -255";
        ctx.fillStyle = tocolor(ctrans.apply([203, 226, 244, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M -546 -312 Q -546 -271 -533 -231 -519 -58 -559 116 -584 243 -651 275 -687 279 -651 170 -579 -11 -570 -175 -645 -34 -793 97 -875 174 -917 143 -951 106 -877 68 -710 -21 -656 -116 -622 -222 -546 -312";
        ctx.fillStyle = tocolor(ctrans.apply([96, 150, 184, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M -452 -303 Q -445 -346 -400 -362 -390 -355 -377 -355 -360 -355 -349 -367 L -341 -377 Q -194 -392 -127 -333 -180 -276 -236 -253 L -452 -303";
        ctx.fillStyle = tocolor(ctrans.apply([222, 239, 255, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M -331 154 L -315 96 Q -224 359 -2 434 -17 485 17 629 -49 640 -50 652 -89 659 -100 750 -350 565 -331 154";
        ctx.fillStyle = tocolor(ctrans.apply([139, 203, 247, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M -80 764 Q -112 783 -228 807 -378 839 -388 645 -389 374 -331 154 -350 565 -100 750 L -80 764";
        ctx.fillStyle = tocolor(ctrans.apply([104, 161, 204, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
    }

    function shape168(ctx, ctrans, frame, ratio, time) {
        var pathData = "M 610 -646 L 833 -425 Q 837 -384 664 -530 534 -621 610 -646";
        ctx.fillStyle = tocolor(ctrans.apply([57, 74, 90, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 494 -29 Q 460 -70 456 -124 L 455 -140 456 -160 460 -182 Q 301 -233 117 -249 5 -258 -116 -255 -128 -235 -145 -218 -193 -171 -258 -164 L -280 -163 Q -358 -163 -414 -218 L -421 -226 -452 -221 Q -494 -209 -511 -180 L -533 -231 Q -546 -271 -546 -312 L -546 -313 Q -546 -361 -529 -411 -436 -638 80 -621 470 -603 724 -379 802 -273 801 -157 800 -119 791 -79 L 789 -74 779 -54 750 -17 Q 700 33 628 33 556 33 505 -17 L 494 -29 M -97 -297 L -95 -304 -102 -305 -97 -297 M -349 -367 L -347 -369 -348 -369 -349 -367";
        ctx.fillStyle = tocolor(ctrans.apply([130, 167, 196, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M -349 -367 L -348 -369 -347 -369 -349 -367";
        ctx.fillStyle = tocolor(ctrans.apply([61, 79, 89, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M -258 -164 Q -193 -171 -145 -218 -128 -235 -116 -255 5 -258 117 -249 301 -233 460 -182 L 456 -160 455 -140 456 -124 Q 460 -70 494 -29 503 12 535 36 413 64 251 55 L 268 41 Q 220 56 179 41 -228 3 -496 -155 L -511 -180 Q -494 -209 -452 -221 -353 -125 -258 -164";
        ctx.fillStyle = tocolor(ctrans.apply([194, 229, 251, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 494 -29 L 505 -17 Q 556 33 628 33 700 33 750 -17 L 779 -54 789 -74 791 -79 790 -74 778 -36 748 11 716 48 692 71 Q 586 74 535 36 503 12 494 -29";
        ctx.fillStyle = tocolor(ctrans.apply([134, 179, 210, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 748 11 Q 821 71 901 194 954 290 901 272 837 234 752 104 795 388 769 369 720 357 716 48 L 748 11";
        ctx.fillStyle = tocolor(ctrans.apply([95, 149, 187, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 692 71 Q 629 126 540 156 434 191 291 191 -15 160 -220 69 -309 22 -373 -28 -453 -90 -496 -155 -228 3 179 41 188 52 198 59 222 74 251 55 413 64 535 36 586 74 692 71 M 166 127 Q 271 238 362 100 272 190 166 127";
        ctx.fillStyle = tocolor(ctrans.apply([181, 221, 247, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 540 156 Q 523 195 483 219 371 285 77 238 -170 196 -304 61 L -313 52 Q -347 15 -373 -28 -309 22 -220 69 -15 160 291 191 434 191 540 156 M 436 247 Q 445 313 398 322 151 356 -116 276 -34 334 123 366 368 364 403 343 L 430 390 Q 345 482 97 471 L 97 434 Q 83 397 -2 434 -224 359 -315 96 L -304 62 Q -216 209 15 247 317 292 436 247";
        ctx.fillStyle = tocolor(ctrans.apply([115, 176, 220, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 483 219 Q 465 235 436 247 317 292 15 247 -216 209 -304 62 L -304 61 Q -170 196 77 238 371 285 483 219";
        ctx.fillStyle = tocolor(ctrans.apply([101, 158, 201, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 179 41 Q 220 56 268 41 L 251 55 Q 222 74 198 59 188 52 179 41 M 166 127 Q 272 190 362 100 271 238 166 127";
        ctx.fillStyle = tocolor(ctrans.apply([102, 155, 187, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M -2 434 Q 83 397 97 434 L 97 471 97 617 17 629 Q -17 485 -2 434";
        ctx.fillStyle = tocolor(ctrans.apply([126, 144, 158, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 430 390 Q 485 503 489 645 L 386 632 Q 406 500 394 482 315 435 311 482 L 311 629 Q 276 630 262 639 247 652 247 673 232 580 149 611 L 97 617 97 471 Q 345 482 430 390";
        ctx.fillStyle = tocolor(ctrans.apply([140, 204, 248, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M 311 629 L 311 482 Q 315 435 394 482 406 500 386 632 L 311 629";
        ctx.fillStyle = tocolor(ctrans.apply([126, 143, 159, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M 398 322 Q 417 334 403 343 368 364 123 366 -34 334 -116 276 151 356 398 322";
        ctx.fillStyle = tocolor(ctrans.apply([106, 161, 200, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 489 645 L 489 677 Q 484 752 431 764 L 249 764 262 724 446 724 Q 382 693 249 692 L 247 673 Q 247 652 262 639 276 630 311 629 L 386 632 489 645";
        ctx.fillStyle = tocolor(ctrans.apply([184, 224, 249, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
        "M 249 764 L -80 764 -100 750 Q -89 659 -50 652 -69 705 50 684 L 247 673 249 692 262 724 249 764";
        ctx.fillStyle = tocolor(ctrans.apply([147, 190, 222, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M 249 692 Q 382 693 446 724 L 262 724 249 692";
        ctx.fillStyle = tocolor(ctrans.apply([149, 190, 222, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M 17 629 L 97 617 149 611 Q 232 580 247 673 L 50 684 Q -69 705 -50 652 -49 640 17 629";
        ctx.fillStyle = tocolor(ctrans.apply([185, 227, 252, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M -349 -622 Q -175 -702 -50 -797 -11 -826 17 -797 28 -761 -82 -700 -323 -597 -349 -622";
        ctx.fillStyle = tocolor(ctrans.apply([80, 96, 109, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M -97 -297 L -102 -305 -95 -304 -97 -297";
        ctx.fillStyle = tocolor(ctrans.apply([162, 192, 216, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M -452 -221 L -421 -226 -414 -218 Q -358 -163 -280 -163 L -258 -164 Q -353 -125 -452 -221";
        ctx.fillStyle = tocolor(ctrans.apply([157, 199, 224, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M -546 -312 Q -546 -271 -533 -231 -519 -58 -559 116 -584 243 -651 275 -687 279 -651 170 -579 -11 -570 -175 -645 -34 -793 97 -875 174 -917 143 -951 106 -877 68 -710 -21 -656 -116 -622 -222 -546 -312";
        ctx.fillStyle = tocolor(ctrans.apply([96, 150, 184, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M -331 154 L -315 96 Q -224 359 -2 434 -17 485 17 629 -49 640 -50 652 -89 659 -100 750 -350 565 -331 154";
        ctx.fillStyle = tocolor(ctrans.apply([139, 203, 247, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M -80 764 Q -112 783 -228 807 -378 839 -388 645 -389 374 -331 154 -350 565 -100 750 L -80 764";
        ctx.fillStyle = tocolor(ctrans.apply([104, 161, 204, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
    }

    function shape169(ctx, ctrans, frame, ratio, time) {
        var pathData = "M 610 -646 L 833 -425 Q 837 -384 664 -530 534 -621 610 -646";
        ctx.fillStyle = tocolor(ctrans.apply([57, 74, 90, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 460 -182 Q 470 -227 505 -262 532 -289 565 -301 L 757 -255 Q 795 -213 801 -157 800 -119 791 -79 712 -155 596 -187 L 598 -200 Q 598 -217 586 -229 575 -240 558 -240 541 -240 529 -229 518 -217 518 -200 L 518 -197 Q 469 -204 460 -182";
        ctx.fillStyle = tocolor(ctrans.apply([162, 193, 214, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 801 -157 Q 795 -213 757 -255 L 565 -301 Q 532 -289 505 -262 470 -227 460 -182 204 -264 -116 -255 L -97 -297 Q -90 -323 -90 -352 -90 -419 -129 -469 L -360 -524 Q -389 -511 -414 -486 -469 -431 -469 -352 -469 -311 -453 -275 L -438 -247 -182 -189 Q -217 -168 -258 -164 L -280 -163 Q -358 -163 -414 -218 L -421 -226 -452 -221 Q -494 -209 -511 -180 L -533 -231 Q -546 -271 -546 -312 L -546 -313 Q -546 -361 -529 -411 -498 -487 -419 -536 L -416 -538 Q -259 -632 80 -621 470 -603 724 -379 771 -315 790 -247 801 -203 801 -157 M 709 14 Q 672 33 628 33 556 33 505 -17 L 494 -29 489 -36 709 14";
        ctx.fillStyle = tocolor(ctrans.apply([130, 167, 196, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 518 -197 L 518 -200 Q 518 -217 529 -229 541 -240 558 -240 575 -240 586 -229 598 -217 598 -200 L 596 -187 586 -172 Q 575 -160 558 -160 541 -160 529 -172 519 -182 518 -197 M -400 -362 L -406 -367 Q -417 -378 -417 -395 -417 -412 -406 -424 -394 -435 -377 -435 -360 -435 -349 -424 -337 -412 -337 -395 L -341 -377 -349 -367 Q -360 -355 -377 -355 -390 -355 -400 -362";
        ctx.fillStyle = tocolor(ctrans.apply([61, 79, 89, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 460 -182 Q 469 -204 518 -197 519 -182 529 -172 541 -160 558 -160 575 -160 586 -172 L 596 -187 Q 712 -155 791 -79 L 779 -54 Q 570 23 456 -124 L 455 -140 460 -182";
        ctx.fillStyle = tocolor(ctrans.apply([222, 241, 255, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M -511 -180 Q -494 -209 -452 -221 -353 -125 -258 -164 -217 -168 -182 -189 -162 -201 -145 -218 -128 -235 -116 -255 204 -264 460 -182 L 455 -140 456 -124 Q 460 -75 489 -36 L 494 -29 Q 503 12 535 36 413 64 251 55 L 268 41 Q 220 56 179 41 -228 3 -496 -155 L -511 -180";
        ctx.fillStyle = tocolor(ctrans.apply([194, 229, 251, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 779 -54 L 791 -79 778 -36 748 11 740 21 716 48 692 71 Q 586 74 535 36 503 12 494 -29 L 505 -17 Q 556 33 628 33 672 33 709 14 L 750 -17 779 -54";
        ctx.fillStyle = tocolor(ctrans.apply([134, 179, 210, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M 456 -124 Q 570 23 779 -54 L 750 -17 709 14 489 -36 Q 460 -75 456 -124";
        ctx.fillStyle = tocolor(ctrans.apply([203, 226, 242, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 748 11 L 767 27 Q 831 87 901 194 954 290 901 272 837 234 752 104 795 388 769 369 720 357 716 48 L 740 21 748 11";
        ctx.fillStyle = tocolor(ctrans.apply([95, 149, 187, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 692 71 Q 629 126 540 156 434 191 291 191 -15 160 -220 69 -309 22 -373 -28 -453 -90 -496 -155 -228 3 179 41 188 52 198 59 222 74 251 55 413 64 535 36 586 74 692 71 M 362 100 Q 272 190 166 127 271 238 362 100";
        ctx.fillStyle = tocolor(ctrans.apply([181, 221, 247, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 540 156 Q 523 195 483 219 371 285 77 238 -170 196 -304 61 L -313 52 Q -347 15 -373 -28 -309 22 -220 69 -15 160 291 191 434 191 540 156 M 436 247 Q 445 313 398 322 151 356 -116 276 -34 334 123 366 368 364 403 343 L 430 390 Q 345 482 97 471 L 97 434 Q 83 397 -2 434 -224 359 -315 96 L -304 62 Q -216 209 15 247 317 292 436 247";
        ctx.fillStyle = tocolor(ctrans.apply([115, 176, 220, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 483 219 Q 465 235 436 247 317 292 15 247 -216 209 -304 62 L -304 61 Q -170 196 77 238 371 285 483 219";
        ctx.fillStyle = tocolor(ctrans.apply([101, 158, 201, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 179 41 Q 220 56 268 41 L 251 55 Q 222 74 198 59 188 52 179 41 M 362 100 Q 271 238 166 127 272 190 362 100";
        ctx.fillStyle = tocolor(ctrans.apply([102, 155, 187, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M -2 434 Q 83 397 97 434 L 97 471 97 617 17 629 Q -17 485 -2 434";
        ctx.fillStyle = tocolor(ctrans.apply([126, 144, 158, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 430 390 Q 485 503 489 645 L 386 632 Q 406 500 394 482 315 435 311 482 L 311 629 Q 276 630 262 639 247 652 247 673 232 580 149 611 L 97 617 97 471 Q 345 482 430 390";
        ctx.fillStyle = tocolor(ctrans.apply([140, 204, 248, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M 311 629 L 311 482 Q 315 435 394 482 406 500 386 632 L 311 629";
        ctx.fillStyle = tocolor(ctrans.apply([126, 143, 159, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M 398 322 Q 417 334 403 343 368 364 123 366 -34 334 -116 276 151 356 398 322";
        ctx.fillStyle = tocolor(ctrans.apply([106, 161, 200, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 489 645 L 489 677 Q 484 752 431 764 L 249 764 262 724 446 724 Q 382 693 249 692 L 247 673 Q 247 652 262 639 276 630 311 629 L 386 632 489 645";
        ctx.fillStyle = tocolor(ctrans.apply([184, 224, 249, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
        "M 249 764 L -80 764 -100 750 Q -89 659 -50 652 -69 705 50 684 L 247 673 249 692 262 724 249 764";
        ctx.fillStyle = tocolor(ctrans.apply([147, 190, 222, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M 249 692 Q 382 693 446 724 L 262 724 249 692";
        ctx.fillStyle = tocolor(ctrans.apply([149, 190, 222, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M 17 629 L 97 617 149 611 Q 232 580 247 673 L 50 684 Q -69 705 -50 652 -49 640 17 629";
        ctx.fillStyle = tocolor(ctrans.apply([185, 227, 252, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M -349 -622 Q -175 -702 -50 -797 -11 -826 17 -797 28 -761 -82 -700 -323 -597 -349 -622";
        ctx.fillStyle = tocolor(ctrans.apply([80, 96, 109, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M -453 -275 Q -469 -311 -469 -352 -469 -431 -414 -486 -389 -511 -360 -524 L -129 -469 Q -90 -419 -90 -352 -90 -323 -97 -297 -109 -318 -127 -333 -194 -392 -341 -377 L -337 -395 Q -337 -412 -349 -424 -360 -435 -377 -435 -394 -435 -406 -424 -417 -412 -417 -395 -417 -378 -406 -367 L -400 -362 Q -458 -341 -453 -275";
        ctx.fillStyle = tocolor(ctrans.apply([162, 192, 216, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M -452 -221 L -421 -226 -414 -218 Q -358 -163 -280 -163 L -258 -164 Q -353 -125 -452 -221";
        ctx.fillStyle = tocolor(ctrans.apply([157, 199, 224, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M -182 -189 L -438 -247 -453 -275 Q -276 -174 -127 -333 -109 -318 -97 -297 L -116 -255 Q -128 -235 -145 -218 -162 -201 -182 -189";
        ctx.fillStyle = tocolor(ctrans.apply([203, 226, 244, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M -546 -312 Q -546 -271 -533 -231 -519 -58 -559 116 -584 243 -651 275 -687 279 -651 170 -579 -11 -570 -175 -645 -34 -793 97 -875 174 -917 143 -951 106 -877 68 -710 -21 -656 -116 -622 -222 -546 -312";
        ctx.fillStyle = tocolor(ctrans.apply([96, 150, 184, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M -341 -377 Q -194 -392 -127 -333 -276 -174 -453 -275 -458 -341 -400 -362 -390 -355 -377 -355 -360 -355 -349 -367 L -341 -377";
        ctx.fillStyle = tocolor(ctrans.apply([222, 239, 255, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M -331 154 L -315 96 Q -224 359 -2 434 -17 485 17 629 -49 640 -50 652 -89 659 -100 750 -350 565 -331 154";
        ctx.fillStyle = tocolor(ctrans.apply([139, 203, 247, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M -80 764 Q -112 783 -228 807 -378 839 -388 645 -389 374 -331 154 -350 565 -100 750 L -80 764";
        ctx.fillStyle = tocolor(ctrans.apply([104, 161, 204, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
    }

    function sprite170(ctx, ctrans, frame, ratio, time) {
        var clips = [];
        var frame_cnt = 30;
        frame = frame % frame_cnt;
        switch (frame) {
            case 0:
                place("shape166", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
                break;
            case 1:
                place("shape166", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
                break;
            case 2:
                place("shape166", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
                break;
            case 3:
                place("shape166", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
                break;
            case 4:
                place("shape166", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
                break;
            case 5:
                place("shape166", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
                break;
            case 6:
                place("shape166", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
                break;
            case 7:
                place("shape166", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
                break;
            case 8:
                place("shape166", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
                break;
            case 9:
                place("shape166", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
                break;
            case 10:
                place("shape166", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
                break;
            case 11:
                place("shape166", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
                break;
            case 12:
                place("shape166", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
                break;
            case 13:
                place("shape166", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
                break;
            case 14:
                place("shape166", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
                break;
            case 15:
                place("shape166", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
                break;
            case 16:
                place("shape166", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
                break;
            case 17:
                place("shape166", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
                break;
            case 18:
                place("shape166", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
                break;
            case 19:
                place("shape166", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
                break;
            case 20:
                place("shape166", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
                break;
            case 21:
                place("shape166", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
                break;
            case 22:
                place("shape166", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
                break;
            case 23:
                place("shape166", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
                break;
            case 24:
                place("shape166", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
                break;
            case 25:
                place("shape166", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
                break;
            case 26:
                place("shape166", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
                break;
            case 27:
                place("shape167", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
                break;
            case 28:
                place("shape168", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
                break;
            case 29:
                place("shape169", canvas, ctx, [1.0, 0.0, 0.0, 1.0, 0.0, 0.0], ctrans, 1, 0, 0, time);
                break;
        }
    }

    function shape171(ctx, ctrans, frame, ratio, time) {
        var pathData =
            "M 6 -641 L -188 -545 Q -330 -477 -334 -397 -331 -331 -230 -343 -21 -393 136 -563 L 202 -537 Q 137 -403 0 -251 -51 -147 81 -192 303 -304 359 -492 454 -472 507 -393 295 -88 -5 57 L -6 57 Q -217 53 -423 -18 -504 -327 -901 -691 -902 -814 -882 -914 -580 -1064 -66 -731 -43 -682 6 -641";
        ctx.fillStyle = tocolor(ctrans.apply([152, 79, 135, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 136 -563 Q -21 -393 -230 -343 -331 -331 -334 -397 -330 -477 -188 -545 L 6 -641 Q 55 -599 131 -566 L 136 -563";
        ctx.fillStyle = tocolor(ctrans.apply([109, 57, 96, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M 359 -492 Q 303 -304 81 -192 -51 -147 0 -251 137 -403 202 -537 290 -503 359 -492";
        ctx.fillStyle = tocolor(ctrans.apply([108, 58, 96, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M -66 -731 Q -580 -1064 -882 -914 -836 -1149 -679 -1255 -213 -1416 -84 -825 -85 -775 -66 -731";
        ctx.fillStyle = tocolor(ctrans.apply([118, 56, 103, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M -6 57 L -5 57 Q 467 35 567 -228 601 -84 611 33 620 135 611 216 604 284 583 338 545 441 460 491 402 334 264 364 91 405 60 534 50 578 56 633 L -17 633 Q -186 628 -298 570 -358 539 -402 493 L -434 461 Q -565 321 -660 156 -527 182 -402 173 -188 145 -6 57";
        ctx.fillStyle = tocolor(ctrans.apply([148, 67, 82, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M -423 -18 Q -217 53 -6 57 -188 145 -402 173 -396 80 -423 -18";
        ctx.fillStyle = tocolor(ctrans.apply([119, 57, 104, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M -423 -18 Q -396 80 -402 173 -527 182 -660 156 -834 -147 -886 -533 -779 -180 -423 -18";
        ctx.fillStyle = tocolor(ctrans.apply([180, 152, 174, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
        "M -434 461 L -402 493 Q -358 539 -298 570 -338 743 -356 919 -404 901 -451 872 -459 678 -434 461";
        ctx.fillStyle = tocolor(ctrans.apply([206, 210, 213, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M 60 534 Q 91 405 264 364 402 334 460 491 L 486 606 Q 273 592 155 727 96 633 60 534";
        ctx.fillStyle = tocolor(ctrans.apply([231, 236, 239, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 56 633 Q 50 578 60 534 96 633 155 727 L 118 777 Q 80 707 56 633 M 173 754 Q 292 612 493 645 513 763 523 898 411 895 338 954 242 857 173 754";
        ctx.fillStyle = tocolor(ctrans.apply([217, 222, 225, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M -298 570 Q -186 628 -17 633 -141 761 -239 944 -301 939 -356 919 -338 743 -298 570";
        ctx.fillStyle = tocolor(ctrans.apply([174, 182, 185, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M 611 216 Q 620 135 611 33 807 93 887 307 739 207 611 216";
        ctx.fillStyle = tocolor(ctrans.apply([231, 235, 238, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M 486 606 L 493 645 Q 292 612 173 754 L 155 727 Q 273 592 486 606";
        ctx.fillStyle = tocolor(ctrans.apply([197, 198, 200, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M 583 338 Q 604 284 611 216 739 207 887 307 L 901 347 583 338";
        ctx.fillStyle = tocolor(ctrans.apply([196, 205, 210, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M -5 57 Q 295 -88 507 -393 551 -330 567 -228 467 35 -5 57";
        ctx.fillStyle = tocolor(ctrans.apply([187, 93, 109, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M -901 -691 Q -504 -327 -423 -18 -779 -180 -886 -533 L -901 -691";
        ctx.fillStyle = tocolor(ctrans.apply([228, 210, 224, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M -449 904 L -451 872 Q -404 901 -356 919 L -358 948 -362 946 Q -406 930 -449 904";
        ctx.fillStyle = tocolor(ctrans.apply([200, 204, 205, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M 523 898 L 525 931 Q 425 924 362 977 L 338 954 Q 411 895 523 898";
        ctx.fillStyle = tocolor(ctrans.apply([194, 195, 197, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 525 931 L 547 1132 Q 445 1057 362 977 425 924 525 931 M -449 904 Q -406 930 -362 946 L -358 948 Q -371 1094 -369 1242 L -385 1290 Q -436 1110 -449 904";
        ctx.fillStyle = tocolor(ctrans.apply([230, 235, 238, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M 547 1132 L 552 1178 Q 531 1183 407 1094 L 320 1025 362 977 Q 445 1057 547 1132";
        ctx.fillStyle = tocolor(ctrans.apply([216, 221, 224, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M 294 1000 Q 198 910 135 806 153 777 173 754 242 857 338 954 L 294 1000";
        ctx.fillStyle = tocolor(ctrans.apply([203, 208, 211, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M 155 727 L 173 754 Q 153 777 135 806 L 118 777 155 727";
        ctx.fillStyle = tocolor(ctrans.apply([192, 192, 194, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M 320 1025 L 294 1000 338 954 362 977 320 1025";
        ctx.fillStyle = tocolor(ctrans.apply([185, 186, 188, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M -358 948 Q -308 965 -253 971 -316 1094 -369 1242 -371 1094 -358 948";
        ctx.fillStyle = tocolor(ctrans.apply([195, 205, 207, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M -358 948 L -356 919 Q -301 939 -239 944 L -253 971 Q -308 965 -358 948";
        ctx.fillStyle = tocolor(ctrans.apply([160, 164, 167, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
    }

    function shape172(ctx, ctrans, frame, ratio, time) {
        var pathData =
            "M -388 418 L -638 409 Q -842 337 -389 64 -34 -105 82 -76 L 83 -76 Q 172 -54 119 85 L -12 305 Q -160 369 -330 409 L -388 418";
        ctx.fillStyle = tocolor(ctrans.apply([237, 161, 163, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M -12 305 L 119 85 Q 172 -54 83 -76 712 -646 701 -442 690 -323 608 -196 528 -72 380 59 283 144 169 212 83 263 -12 305";
        ctx.fillStyle = tocolor(ctrans.apply([251, 185, 187, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M -388 418 L -330 409 Q -160 369 -12 305 83 263 169 212 L 46 359 273 350 Q 196 399 99 437 -189 562 -388 418";
        ctx.fillStyle = tocolor(ctrans.apply([178, 92, 103, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M 608 -196 Q 593 -83 526 59 455 235 273 350 L 46 359 169 212 Q 283 144 380 59 528 -72 608 -196";
        ctx.fillStyle = tocolor(ctrans.apply([200, 112, 126, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
    }

    function shape173(ctx, ctrans, frame, ratio, time) {
        var pathData =
            "M -608 -196 Q -690 -323 -701 -442 -712 -646 -83 -76 -172 -54 -119 85 L 12 305 Q -83 263 -169 212 -283 144 -380 59 -528 -72 -608 -196";
        ctx.fillStyle = tocolor(ctrans.apply([251, 185, 187, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M -83 -76 L -82 -76 Q 34 -105 389 64 842 337 638 409 L 388 418 330 409 Q 160 369 12 305 L -119 85 Q -172 -54 -83 -76";
        ctx.fillStyle = tocolor(ctrans.apply([237, 161, 163, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 388 418 Q 189 562 -99 437 -196 399 -273 350 L -46 359 -169 212 Q -83 263 12 305 160 369 330 409 L 388 418";
        ctx.fillStyle = tocolor(ctrans.apply([178, 92, 103, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M -273 350 Q -455 235 -526 59 -593 -83 -608 -196 -528 -72 -380 59 -283 144 -169 212 L -46 359 -273 350";
        ctx.fillStyle = tocolor(ctrans.apply([200, 112, 126, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
    }

    function shape174(ctx, ctrans, frame, ratio, time) {
        var pathData =
            "M -1795 -1530 L -1717 -1606 Q -1006 -2270 -1 -2270 1004 -2270 1715 -1606 L 1806 -1517 Q 1689 -1569 1547 -1486 1366 -1382 1547 -901 1661 -657 1947 -463 2248 -293 2380 -463 2426 -241 2426 -1 L 2426 11 2374 112 Q 2224 206 2224 338 L 2224 339 Q 1581 1168 -26 1251 -1770 1222 -2302 464 -2256 426 -2237 307 -2236 174 -2425 84 L -2427 -1 Q -2427 -234 -2383 -451 -2250 -304 -1963 -466 -1677 -660 -1563 -904 -1382 -1385 -1563 -1489 -1689 -1562 -1795 -1530 M -1485 -366 L -1487 -308 Q -1487 204 -1058 564 -627 925 -20 925 588 925 1017 564 1448 204 1448 -308 L 1447 -366 1448 -425 Q 1448 -936 1017 -1297 588 -1658 -20 -1658 -627 -1658 -1058 -1297 -1487 -936 -1487 -425 L -1485 -366";
        ctx.fillStyle = tocolor(ctrans.apply([242, 126, 163, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 2380 -463 Q 2248 -293 1947 -463 1661 -657 1547 -901 1366 -1382 1547 -1486 1689 -1569 1806 -1517 2256 -1053 2380 -463";
        ctx.fillStyle = tocolor(ctrans.apply([218, 101, 130, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M -1485 -366 L -1487 -425 Q -1487 -936 -1058 -1297 -627 -1658 -20 -1658 588 -1658 1017 -1297 1448 -936 1448 -425 L 1447 -366 Q 1423 108 1017 447 588 808 -20 808 -627 808 -1058 447 -1462 108 -1485 -366 M 1160 -498 Q 1160 -903 816 -1190 472 -1477 -14 -1477 -500 -1477 -845 -1190 -1188 -903 -1188 -498 -1188 -92 -845 195 -500 482 -14 482 472 482 816 195 1160 -92 1160 -498";
        ctx.fillStyle = tocolor(ctrans.apply([247, 211, 189, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 1447 -366 L 1448 -308 Q 1448 204 1017 564 588 925 -20 925 -627 925 -1058 564 -1487 204 -1487 -308 L -1485 -366 Q -1462 108 -1058 447 -627 808 -20 808 588 808 1017 447 1423 108 1447 -366";
        ctx.fillStyle = tocolor(ctrans.apply([218, 101, 128, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M 2224 339 L 2224 338 Q 2307 231 2374 112 2397 97 2425 83 2417 304 2369 510 2257 543 2224 339";
        ctx.fillStyle = tocolor(ctrans.apply([216, 84, 107, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M -2425 84 Q -2236 174 -2237 307 -2256 426 -2302 464 -2365 375 -2411 275 -2422 181 -2425 84 M 2224 338 Q 2224 206 2374 112 2307 231 2224 338";
        ctx.fillStyle = tocolor(ctrans.apply([217, 102, 131, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M -2302 464 Q -1770 1222 -26 1251 1581 1168 2224 339 2257 543 2369 510 2224 1128 1715 1604 1004 2269 -1 2269 -1006 2269 -1717 1604 -2238 1116 -2377 480 -2333 490 -2302 464 M 2374 112 L 2426 11 2425 83 Q 2397 97 2374 112";
        ctx.fillStyle = tocolor(ctrans.apply([240, 105, 137, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M -1795 -1530 Q -1689 -1562 -1563 -1489 -1382 -1385 -1563 -904 -1677 -660 -1963 -466 -2250 -304 -2383 -451 -2261 -1057 -1795 -1530";
        ctx.fillStyle = tocolor(ctrans.apply([216, 102, 128, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M -2377 480 L -2377 477 Q -2399 378 -2411 275 -2365 375 -2302 464 -2333 490 -2377 480";
        ctx.fillStyle = tocolor(ctrans.apply([216, 84, 108, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
    }

    function shape175(ctx, ctrans, frame, ratio, time) {
        var pathData =
            "M 848 1185 Q 946 1193 946 1240 946 1247 938 1254 930 1261 930 1267 930 1275 960 1309 L 960 1331 933 1332 Q 913 1334 909 1346 887 1338 871 1327 L 833 1322 729 1328 Q 680 1336 643 1361 L 564 1421 Q 516 1466 516 1503 516 1546 570 1564 L 700 1578 Q 746 1578 778 1614 795 1634 813 1664 798 1662 761 1644 L 712 1624 Q 700 1624 674 1635 L 672 1636 667 1638 646 1638 624 1651 Q 615 1657 615 1667 L 659 1727 Q 704 1782 704 1793 704 1820 676 1849 641 1886 632 1907 L 628 1907 627 1900 625 1893 Q 625 1873 639 1847 L 653 1810 Q 653 1770 593 1770 L 575 1772 556 1775 Q 518 1775 489 1739 L 468 1714 Q 457 1702 447 1702 442 1702 356 1729 269 1756 223 1756 203 1756 122 1725 51 1698 27 1684 L -66 1627 Q -96 1598 -96 1547 -96 1502 -64 1472 -35 1446 47 1410 40 1424 40 1432 40 1454 61 1459 L 99 1461 Q 149 1461 184 1431 212 1408 212 1388 212 1358 164 1296 L 95 1216 95 1211 194 1210 Q 199 1226 210 1240 L 251 1279 291 1314 Q 308 1335 307 1357 305 1394 346 1442 389 1490 389 1529 389 1554 358 1568 333 1580 299 1580 249 1580 230 1555 L 216 1539 Q 208 1531 191 1531 L 165 1536 144 1540 Q 120 1540 106 1514 L 95 1482 Q 37 1489 37 1560 37 1627 88 1664 143 1702 252 1702 314 1702 360 1682 405 1662 452 1662 483 1662 500 1675 L 516 1698 516 1710 Q 527 1727 574 1731 L 631 1742 599 1705 Q 566 1668 566 1660 566 1651 587 1637 606 1625 615 1624 L 558 1606 Q 522 1595 512 1582 461 1518 461 1471 461 1417 508 1381 536 1361 608 1322 627 1311 660 1299 698 1286 721 1288 L 791 1280 833 1269 857 1282 Q 876 1296 896 1297 L 865 1229 853 1197 848 1185 M 243 1470 L 256 1482 249 1489 233 1494 198 1485 188 1485 166 1488 140 1489 Q 152 1511 179 1513 L 226 1510 Q 241 1510 257 1523 274 1536 292 1536 316 1536 328 1522 338 1510 338 1494 338 1481 316 1467 291 1453 287 1439 L 287 1401 Q 287 1378 260 1371 L 229 1453 Q 229 1463 243 1470 M 631 1742 L 636 1747 636 1745 631 1742";
        ctx.fillStyle = tocolor(ctrans.apply([236, 143, 40, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 194 1210 L 214 1208 349 1193 526 1190 690 1188 684 1185 751 1184 Q 813 1183 848 1185 L 853 1197 865 1229 896 1297 Q 876 1296 857 1282 L 833 1269 791 1280 721 1288 Q 698 1286 660 1299 627 1311 608 1322 536 1361 508 1381 461 1417 461 1471 461 1518 512 1582 522 1595 558 1606 L 615 1624 Q 606 1625 587 1637 566 1651 566 1660 566 1668 599 1705 L 631 1742 574 1731 Q 527 1727 516 1710 L 516 1698 500 1675 Q 483 1662 452 1662 405 1662 360 1682 314 1702 252 1702 143 1702 88 1664 37 1627 37 1560 37 1489 95 1482 L 106 1514 Q 120 1540 144 1540 L 165 1536 191 1531 Q 208 1531 216 1539 L 230 1555 Q 249 1580 299 1580 333 1580 358 1568 389 1554 389 1529 389 1490 346 1442 305 1394 307 1357 308 1335 291 1314 L 251 1279 210 1240 Q 199 1226 194 1210 M 243 1470 Q 229 1463 229 1453 L 260 1371 Q 287 1378 287 1401 L 287 1439 Q 291 1453 316 1467 338 1481 338 1494 338 1510 328 1522 316 1536 292 1536 274 1536 257 1523 241 1510 226 1510 L 179 1513 Q 152 1511 140 1489 L 166 1488 188 1485 198 1485 233 1494 249 1489 256 1482 243 1470";
        ctx.fillStyle = tocolor(ctrans.apply([255, 255, 149, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
    }

    function shape176(ctx, ctrans, frame, ratio, time) {
        var pathData =
            "M 373 153 Q 460 390 847 384 1028 389 1033 297 1070 362 1064 442 L 1064 473 Q 837 505 624 436 393 353 331 202 351 173 373 153";
        ctx.fillStyle = tocolor(ctrans.apply([240, 190, 227, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 1033 297 Q 1028 389 847 384 460 390 373 153 410 118 451 108 722 57 928 188 999 236 1033 297 M 873 255 Q 878 238 834 212 793 188 728 171 662 153 612 153 563 153 558 170 553 188 596 213 639 238 705 256 770 273 818 272 868 273 873 255";
        ctx.fillStyle = tocolor(ctrans.apply([242, 226, 239, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 873 255 Q 868 273 818 272 770 273 705 256 639 238 596 213 553 188 558 170 563 153 612 153 662 153 728 171 793 188 834 212 878 238 873 255";
        ctx.fillStyle = tocolor(ctrans.apply([152, 100, 138, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 331 202 Q 393 353 624 436 837 505 1064 473 L 1064 1069 Q 691 1063 406 972 341 860 324 772 367 723 374 648 396 593 379 539 335 460 290 471 290 324 331 202";
        ctx.fillStyle = tocolor(ctrans.apply([236, 106, 154, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M 290 471 Q 275 425 244 377 284 267 331 202 290 324 290 471";
        ctx.fillStyle = tocolor(ctrans.apply([218, 87, 137, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M -235 266 Q -211 187 -112 173 L -78 176 Q 114 199 224 349 L 244 377 Q 275 425 290 471 303 513 301 554 296 617 264 653 180 424 -56 308 L -78 299 Q -125 282 -173 274 L -235 266";
        ctx.fillStyle = tocolor(ctrans.apply([164, 188, 198, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 264 653 Q 296 617 301 554 303 513 290 471 335 460 379 539 396 593 374 648 L 371 656 Q 353 693 317 730 205 820 103 769 81 745 76 718 69 690 81 659 111 709 199 690 239 679 264 653";
        ctx.fillStyle = tocolor(ctrans.apply([245, 210, 188, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 374 648 Q 367 723 324 772 281 820 203 842 L 190 884 Q 93 818 62 753 L 76 718 Q 81 745 103 769 205 820 317 730 353 693 371 656 L 374 648";
        ctx.fillStyle = tocolor(ctrans.apply([165, 62, 105, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M -202 400 Q -248 365 -235 266 L -173 274 Q -125 282 -78 299 L -56 308 Q 180 424 264 653 239 679 199 690 111 709 81 659 52 501 -86 441 -124 424 -170 415 L -202 400";
        ctx.fillStyle = tocolor(ctrans.apply([126, 159, 168, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 62 753 Q 93 818 190 884 139 1054 110 1267 L 47 1221 Q 19 1194 2 1163 12 987 72 821 L 48 789 62 753";
        ctx.fillStyle = tocolor(ctrans.apply([168, 82, 127, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M 48 789 L 72 821 Q 12 987 2 1163 -52 1067 -5 926 L 48 789";
        ctx.fillStyle = tocolor(ctrans.apply([215, 116, 163, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M 324 772 Q 341 860 406 972 291 935 190 884 L 203 842 Q 281 820 324 772";
        ctx.fillStyle = tocolor(ctrans.apply([216, 85, 135, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 110 1267 Q 139 1054 190 884 291 935 406 972 562 1309 967 1408 881 1446 720 1441 329 1411 110 1267";
        ctx.fillStyle = tocolor(ctrans.apply([214, 116, 165, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M 406 972 Q 691 1063 1064 1069 L 1064 1264 Q 1064 1364 967 1408 562 1309 406 972";
        ctx.fillStyle = tocolor(ctrans.apply([237, 144, 188, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M -1064 -1127 Q -1066 -1364 -900 -1442 -815 -1454 -690 -1347 -410 -1122 -233 -749 -162 -600 -139 -494 L -211 -436 -280 -619 Q -451 -556 -554 -715 L -447 -444 Q -903 -670 -1064 -1127";
        ctx.fillStyle = tocolor(ctrans.apply([250, 209, 189, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M -1064 -1127 Q -903 -670 -447 -444 L -554 -715 Q -451 -556 -280 -619 L -211 -436 -139 -494 Q -109 -350 -171 -290 -305 -199 -526 -286 -918 -536 -1045 -952 -1064 -1048 -1064 -1127";
        ctx.fillStyle = tocolor(ctrans.apply([244, 170, 141, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M -78 176 L -112 173 Q -211 187 -235 266 -248 365 -202 400 -208 458 -204 526 -276 500 -331 397 L -334 329 Q -302 -9 -124 -14 -83 19 -78 176";
        ctx.fillStyle = tocolor(ctrans.apply([249, 208, 188, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M -331 397 Q -276 500 -204 526 -208 458 -202 400 L -170 415 Q -124 424 -86 441 L -91 496 Q -103 635 -150 656 -311 639 -331 397";
        ctx.fillStyle = tocolor(ctrans.apply([240, 169, 141, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
    }

    function shape177(ctx, ctrans, frame, ratio, time) {
        var pathData =
            "M 11559 5480 L 11581 5492 11559 5492 11559 5480 M 11810 5176 L 11802 5144 Q 11827 5147 11865 5131 L 11896 5117 11910 5170 Q 11910 5215 11888 5239 11859 5269 11777 5292 11818 5229 11818 5207 L 11810 5176";
        ctx.fillStyle = tocolor(ctrans.apply([255, 255, 149, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 12995 3750 L 13062 3752 13062 3797 13023 3868 Q 12995 3920 12995 3933 12995 3953 13038 4004 13079 4053 13079 4091 13079 4108 13062 4142 13038 4132 12995 4098 12970 4074 12925 4074 12878 4074 12837 4108 12796 4143 12796 4184 12796 4274 12878 4349 12931 4395 13064 4468 13197 4544 13246 4585 13330 4658 13330 4743 13330 4812 13197 4911 L 13062 4997 Q 13062 5005 13079 5034 13095 5062 13095 5078 13095 5130 13046 5207 12984 5304 12900 5304 L 12880 5302 12872 5297 12913 5256 Q 12946 5216 12946 5192 12946 5156 12937 5138 12925 5110 12892 5110 L 12845 5122 12811 5133 Q 12829 5099 12829 5082 12829 5000 12729 4935 12631 4874 12520 4874 12252 4874 12137 4940 12011 5013 12011 5190 12011 5231 12015 5240 12025 5264 12068 5257 L 12068 5263 Q 11937 5334 11851 5385 11706 5467 11688 5492 L 11581 5492 11559 5480 11559 5370 11618 5343 Q 11743 5278 11743 5195 11743 5184 11732 5162 11718 5138 11718 5127 11718 5105 11743 5094 L 11798 5076 Q 11876 5052 11876 4977 11876 4963 11857 4918 11835 4871 11835 4863 11835 4847 11876 4797 11919 4746 11919 4708 11919 4582 11743 4481 11575 4386 11379 4386 L 11258 4398 Q 11192 4414 11192 4445 11192 4490 11233 4510 11268 4528 11342 4528 11387 4528 11444 4508 L 11526 4476 11526 4538 Q 11512 4562 11448 4589 11403 4607 11419 4646 11419 4666 11350 4691 11282 4715 11237 4715 11186 4715 11008 4623 10826 4529 10826 4488 10826 4459 10859 4414 10892 4368 10892 4351 10892 4310 10867 4286 10855 4274 10812 4252 10734 4211 10734 4123 10734 4067 10789 3992 10853 3908 10949 3859 11041 3806 11145 3803 L 11233 3802 Q 11141 3860 11066 3947 10957 4071 10957 4159 10957 4180 10988 4230 11017 4281 11017 4303 11017 4331 10974 4395 10933 4459 10933 4471 10933 4492 11084 4567 11231 4640 11258 4640 11307 4640 11342 4615 11368 4595 11368 4587 L 11350 4573 11242 4569 11147 4558 Q 11059 4537 11059 4448 11059 4359 11125 4318 11188 4278 11321 4278 11422 4278 11555 4306 11696 4337 11818 4386 12119 4509 12119 4668 12119 4740 12082 4780 12017 4847 11976 4935 12095 4880 12234 4843 12377 4805 12465 4805 12661 4805 12776 4847 12929 4904 12913 5034 12921 4984 12970 4953 12999 4935 13076 4907 13148 4882 13175 4861 13220 4829 13220 4777 13220 4689 13119 4634 13068 4603 12896 4548 12737 4497 12671 4449 12569 4378 12569 4266 12569 4130 12631 4065 12704 3988 12878 3996 12860 3951 12860 3927 12860 3886 12915 3835 L 12995 3750 M 11810 5176 L 11818 5207 Q 11818 5229 11777 5292 11859 5269 11888 5239 11910 5215 11910 5170 L 11896 5117 11865 5131 Q 11827 5147 11802 5144 L 11810 5176";
        ctx.fillStyle = tocolor(ctrans.apply([236, 143, 40, 0.8]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 12995 3750 L 12915 3835 Q 12860 3886 12860 3927 12860 3951 12878 3996 12704 3988 12631 4065 12569 4130 12569 4266 12569 4378 12671 4449 12737 4497 12896 4548 13068 4603 13119 4634 13220 4689 13220 4777 13220 4829 13175 4861 13148 4882 13076 4907 12999 4935 12970 4953 12921 4984 12913 5034 12929 4904 12776 4847 12661 4805 12465 4805 12377 4805 12234 4843 12095 4880 11976 4935 12017 4847 12082 4780 12119 4740 12119 4668 12119 4509 11818 4386 11696 4337 11555 4306 11422 4278 11321 4278 11188 4278 11125 4318 11059 4359 11059 4448 11059 4537 11147 4558 L 11242 4569 11350 4573 11368 4587 Q 11368 4595 11342 4615 11307 4640 11258 4640 11231 4640 11084 4567 10933 4492 10933 4471 10933 4459 10974 4395 11017 4331 11017 4303 11017 4281 10988 4230 10957 4180 10957 4159 10957 4071 11066 3947 11141 3860 11233 3802 L 11360 3802 Q 12228 3740 12694 3740 L 12860 3746 12995 3750";
        ctx.fillStyle = tocolor(ctrans.apply([255, 255, 149, 0.8]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
    }

    function shape178(ctx, ctrans, frame, ratio, time) {
        var pathData =
            "M 139 -494 Q 162 -600 233 -749 410 -1122 690 -1347 815 -1454 900 -1442 1066 -1364 1064 -1127 903 -670 447 -444 L 554 -715 Q 451 -556 280 -619 L 211 -436 139 -494";
        ctx.fillStyle = tocolor(ctrans.apply([250, 209, 189, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 1064 -1127 Q 1064 -1048 1045 -952 918 -536 526 -286 305 -199 171 -290 109 -350 139 -494 L 211 -436 280 -619 Q 451 -556 554 -715 L 447 -444 Q 903 -670 1064 -1127";
        ctx.fillStyle = tocolor(ctrans.apply([244, 170, 141, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M -373 153 Q -351 173 -331 202 -393 353 -624 436 -837 505 -1064 473 L -1064 442 Q -1070 362 -1033 297 -1028 389 -847 384 -460 390 -373 153";
        ctx.fillStyle = tocolor(ctrans.apply([240, 190, 227, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 78 176 L 112 173 Q 211 187 235 266 L 173 274 Q 125 282 78 299 L 56 308 Q -180 424 -264 653 -296 617 -301 554 -303 513 -290 471 -275 425 -244 377 L -224 349 Q -114 199 78 176";
        ctx.fillStyle = tocolor(ctrans.apply([164, 188, 198, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M -244 377 Q -275 425 -290 471 -290 324 -331 202 -284 267 -244 377";
        ctx.fillStyle = tocolor(ctrans.apply([218, 87, 137, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M -1064 473 Q -837 505 -624 436 -393 353 -331 202 -290 324 -290 471 -335 460 -379 539 -396 593 -374 648 -367 723 -324 772 -341 860 -406 972 -691 1063 -1064 1069 L -1064 473";
        ctx.fillStyle = tocolor(ctrans.apply([236, 106, 154, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M -612 153 Q -563 153 -558 170 -553 188 -596 213 -639 238 -705 256 -770 273 -818 272 -868 273 -873 255 -878 238 -834 212 -793 188 -728 171 -662 153 -612 153";
        ctx.fillStyle = tocolor(ctrans.apply([152, 100, 138, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M -373 153 Q -460 390 -847 384 -1028 389 -1033 297 -999 236 -928 188 -722 57 -451 108 -410 118 -373 153 M -612 153 Q -662 153 -728 171 -793 188 -834 212 -878 238 -873 255 -868 273 -818 272 -770 273 -705 256 -639 238 -596 213 -553 188 -558 170 -563 153 -612 153";
        ctx.fillStyle = tocolor(ctrans.apply([242, 226, 239, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M -290 471 Q -303 513 -301 554 -296 617 -264 653 -239 679 -199 690 -111 709 -81 659 -69 690 -76 718 -81 745 -103 769 -205 820 -317 730 -353 693 -371 656 L -374 648 Q -396 593 -379 539 -335 460 -290 471";
        ctx.fillStyle = tocolor(ctrans.apply([245, 210, 188, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 235 266 Q 248 365 202 400 L 170 415 Q 124 424 86 441 -52 501 -81 659 -111 709 -199 690 -239 679 -264 653 -180 424 56 308 L 78 299 Q 125 282 173 274 L 235 266";
        ctx.fillStyle = tocolor(ctrans.apply([126, 159, 168, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M -374 648 L -371 656 Q -353 693 -317 730 -205 820 -103 769 -81 745 -76 718 L -62 753 Q -93 818 -190 884 L -203 842 Q -281 820 -324 772 -367 723 -374 648";
        ctx.fillStyle = tocolor(ctrans.apply([165, 62, 105, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M -324 772 Q -281 820 -203 842 L -190 884 Q -291 935 -406 972 -341 860 -324 772";
        ctx.fillStyle = tocolor(ctrans.apply([216, 85, 135, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M -190 884 Q -93 818 -62 753 L -48 789 -72 821 Q -12 987 -2 1163 -19 1194 -47 1221 L -110 1267 Q -139 1054 -190 884";
        ctx.fillStyle = tocolor(ctrans.apply([168, 82, 127, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M -2 1163 Q -12 987 -72 821 L -48 789 5 926 Q 52 1067 -2 1163";
        ctx.fillStyle = tocolor(ctrans.apply([215, 116, 163, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M -406 972 Q -291 935 -190 884 -139 1054 -110 1267 -329 1411 -720 1441 -881 1446 -967 1408 -562 1309 -406 972";
        ctx.fillStyle = tocolor(ctrans.apply([214, 116, 165, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M -967 1408 Q -1064 1364 -1064 1264 L -1064 1069 Q -691 1063 -406 972 -562 1309 -967 1408";
        ctx.fillStyle = tocolor(ctrans.apply([237, 144, 188, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 235 266 Q 211 187 112 173 L 78 176 Q 83 19 124 -14 302 -9 334 329 L 331 397 Q 276 500 204 526 208 458 202 400 248 365 235 266";
        ctx.fillStyle = tocolor(ctrans.apply([249, 208, 188, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 202 400 Q 208 458 204 526 276 500 331 397 311 639 150 656 103 635 91 496 L 86 441 Q 124 424 170 415 L 202 400";
        ctx.fillStyle = tocolor(ctrans.apply([240, 169, 141, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
    }

    function shape179(ctx, ctrans, frame, ratio, time) {
        var pathData =
            "M -316 -1247 Q -196 -1306 -56 -1302 226 -1322 410 -1120 L 493 -999 Q 455 -759 172 -685 103 -815 0 -928 -10 -1310 -316 -1247";
        ctx.fillStyle = tocolor(ctrans.apply([124, 65, 109, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 0 -928 Q 103 -815 172 -685 252 -538 288 -369 L 288 -368 138 -227 Q -24 -196 -218 -192 -556 -223 -708 -362 -415 -248 -274 -320 -38 -492 0 -928";
        ctx.fillStyle = tocolor(ctrans.apply([229, 211, 225, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M 288 -368 L 306 -268 Q 227 -244 138 -227 L 288 -368";
        ctx.fillStyle = tocolor(ctrans.apply([165, 138, 157, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 521 -948 Q 677 -645 660 -193 575 37 74 124 -385 161 -703 15 -297 90 138 -227 227 -244 306 -268 L 288 -368 288 -369 Q 500 -648 521 -948";
        ctx.fillStyle = tocolor(ctrans.apply([109, 52, 95, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 660 -193 L 658 -144 647 -83 Q 635 -22 613 33 527 259 302 401 L 237 439 170 472 Q 42 505 -95 497 L -147 493 -266 472 Q -237 355 -517 202 L -614 152 Q -745 101 -786 152 -875 47 -876 -86 -795 -28 -703 15 -385 161 74 124 575 37 660 -193";
        ctx.fillStyle = tocolor(ctrans.apply([136, 62, 77, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M 493 -999 L 521 -948 Q 500 -648 288 -369 252 -538 172 -685 455 -759 493 -999";
        ctx.fillStyle = tocolor(ctrans.apply([152, 78, 137, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 903 574 L 898 616 Q 851 768 590 1052 L 646 648 302 401 Q 527 259 613 33 826 287 903 574 M 237 439 Q 240 629 170 768 -26 632 -95 497 42 505 170 472 L 237 439";
        ctx.fillStyle = tocolor(ctrans.apply([203, 208, 212, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 302 401 Q 300 696 226 948 -88 704 -147 493 L -95 497 Q -26 632 170 768 240 629 237 439 L 302 401";
        ctx.fillStyle = tocolor(ctrans.apply([235, 241, 241, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M 647 -83 Q 915 350 903 574 826 287 613 33 635 -22 647 -83";
        ctx.fillStyle = tocolor(ctrans.apply([232, 236, 237, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M -876 -86 Q -876 -164 -846 -252 -805 -353 -784 -458 -754 -405 -708 -362 -556 -223 -218 -192 -24 -196 138 -227 -297 90 -703 15 -795 -28 -876 -86";
        ctx.fillStyle = tocolor(ctrans.apply([149, 78, 134, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M -784 -458 Q -762 -559 -759 -664 -586 -1114 -316 -1247 -10 -1310 0 -928 -38 -492 -274 -320 -415 -248 -708 -362 -754 -405 -784 -458";
        ctx.fillStyle = tocolor(ctrans.apply([195, 167, 189, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M -266 472 L -370 724 Q -431 910 -186 1304 -744 992 -886 684 -906 626 -905 554 -746 656 -517 202 -237 355 -266 472";
        ctx.fillStyle = tocolor(ctrans.apply([217, 222, 225, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M -905 554 Q -901 390 -786 152 -745 101 -614 152 L -517 202 Q -746 656 -905 554";
        ctx.fillStyle = tocolor(ctrans.apply([231, 236, 239, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
    }

    function shape180(ctx, ctrans, frame, ratio, time) {
        var pathData =
            "M 451 -752 L 396 -737 Q 169 -685 -106 -831 -429 -1002 -440 -1159 -439 -1235 -372 -1260 -412 -1110 -275 -989 -176 -918 4 -847 216 -766 390 -800 L 451 -752";
        ctx.fillStyle = tocolor(ctrans.apply([218, 193, 215, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M -372 -1260 L -364 -1285 Q -220 -972 125 -928 L 26 -1037 Q 74 -1227 418 -1099 491 -1044 498 -949 543 -952 556 -1012 L 566 -990 Q 582 -949 573 -915 565 -877 526 -847 461 -814 390 -800 216 -766 4 -847 -176 -918 -275 -989 -412 -1110 -372 -1260";
        ctx.fillStyle = tocolor(ctrans.apply([242, 171, 141, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M -364 -1285 L -372 -1260 Q -439 -1235 -440 -1159 -429 -1002 -106 -831 169 -685 396 -737 L 451 -752 587 -646 454 -629 Q 63 -610 -184 -682 -300 -716 -384 -770 -654 -919 -756 -1083 -830 -1204 -813 -1333 L -798 -1382 -789 -1398 Q -716 -1517 -441 -1552 -59 -1537 488 -1243 958 -972 1041 -774 1034 -759 1010 -745 L 628 -893 Q 633 -973 566 -990 L 556 -1012 Q 524 -1074 442 -1150 212 -1332 -79 -1365 -286 -1396 -364 -1285";
        ctx.fillStyle = tocolor(ctrans.apply([244, 228, 241, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M -798 -1382 L -813 -1333 Q -830 -1204 -756 -1083 -658 -517 -362 -118 L -356 11 Q -613 2 -652 315 -664 382 -659 441 -938 183 -1027 -61 -1102 -835 -798 -1382";
        ctx.fillStyle = tocolor(ctrans.apply([152, 79, 135, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M -364 -1285 Q -286 -1396 -79 -1365 212 -1332 442 -1150 524 -1074 556 -1012 543 -952 498 -949 491 -1044 418 -1099 74 -1227 26 -1037 L 125 -928 Q -220 -972 -364 -1285 M 417 878 Q 395 826 360 788 L 280 706 Q 422 663 466 780 468 806 476 822 L 417 878";
        ctx.fillStyle = tocolor(ctrans.apply([248, 210, 191, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 1010 -745 Q 1034 -759 1041 -774 1055 -659 758 -507 140 -170 191 550 -123 222 -362 -118 -360 -441 -184 -682 63 -610 454 -629 L 587 -646 Q 920 -692 1010 -745";
        ctx.fillStyle = tocolor(ctrans.apply([201, 171, 195, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M 628 -893 L 1010 -745 Q 920 -692 587 -646 L 451 -752 Q 610 -801 628 -893";
        ctx.fillStyle = tocolor(ctrans.apply([232, 200, 224, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M 390 -800 Q 461 -814 526 -847 565 -877 573 -915 L 628 -893 Q 610 -801 451 -752 L 390 -800";
        ctx.fillStyle = tocolor(ctrans.apply([209, 172, 205, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M -659 441 Q -664 382 -652 315 -613 2 -356 11 L -362 -118 Q -123 222 191 550 203 600 241 657 L 256 677 280 706 360 788 Q 395 826 417 878 438 928 446 990 L 453 1068 Q 390 1078 250 1027 -48 788 -89 525 -179 708 -333 723 L -334 723 Q -550 565 -659 441 M -393 436 Q -358 436 -333 415 -308 395 -308 365 -308 335 -333 314 -358 294 -393 294 -428 294 -453 314 -478 335 -478 365 -478 395 -453 415 -428 436 -393 436";
        ctx.fillStyle = tocolor(ctrans.apply([229, 211, 225, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M -393 436 Q -428 436 -453 415 -478 395 -478 365 -478 335 -453 314 -428 294 -393 294 -358 294 -333 314 -308 335 -308 365 -308 395 -333 415 -358 436 -393 436";
        ctx.fillStyle = tocolor(ctrans.apply([161, 160, 158, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M -334 723 L -333 723 Q -141 882 250 1027 334 1095 438 1161 399 1257 275 1331 L 249 1338 Q 116 1279 57 1156 L 58 1125 Q 54 1073 4 1060 -63 1051 -85 1112 -97 1202 -87 1271 -288 1232 -381 1177 -904 705 -1012 64 L -1027 -61 Q -938 183 -659 441 -644 599 -502 695 -410 730 -334 723";
        ctx.fillStyle = tocolor(ctrans.apply([133, 64, 118, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M -659 441 Q -550 565 -334 723 -410 730 -502 695 -644 599 -659 441";
        ctx.fillStyle = tocolor(ctrans.apply([201, 173, 198, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 453 1068 L 446 990 542 837 Q 571 787 514 719 490 689 449 656 L 443 651 Q 592 636 668 729 722 810 696 1004 514 1519 162 1424 172 1368 109 1359 58 1358 46 1307 175 1350 249 1338 L 275 1331 Q 399 1257 438 1161 L 453 1108 453 1068";
        ctx.fillStyle = tocolor(ctrans.apply([248, 210, 189, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 256 677 L 241 657 Q 369 594 443 651 L 449 656 Q 490 689 514 719 452 670 390 663 323 650 256 677";
        ctx.fillStyle = tocolor(ctrans.apply([166, 186, 193, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 280 706 L 256 677 Q 323 650 390 663 452 670 514 719 571 787 542 837 494 856 476 822 468 806 466 780 422 663 280 706";
        ctx.fillStyle = tocolor(ctrans.apply([118, 131, 147, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 446 990 Q 438 928 417 878 L 476 822 Q 494 856 542 837 L 446 990 M 696 1004 L 668 1157 Q 599 1508 370 1542 142 1575 36 1497 -32 1434 -36 1397 L -12 1424 Q 118 1505 162 1424 514 1519 696 1004";
        ctx.fillStyle = tocolor(ctrans.apply([240, 171, 138, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M -333 723 Q -179 708 -89 525 -48 788 250 1027 -141 882 -333 723";
        ctx.fillStyle = tocolor(ctrans.apply([151, 78, 133, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
        "M -756 -1083 Q -654 -919 -384 -770 -300 -716 -184 -682 -360 -441 -362 -118 -658 -517 -756 -1083";
        ctx.fillStyle = tocolor(ctrans.apply([135, 62, 115, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M 566 -990 Q 633 -973 628 -893 L 573 -915 Q 582 -949 566 -990";
        ctx.fillStyle = tocolor(ctrans.apply([218, 195, 215, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M 250 1027 Q 390 1078 453 1068 L 453 1108 438 1161 Q 334 1095 250 1027";
        ctx.fillStyle = tocolor(ctrans.apply([204, 170, 195, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 58 1125 L 57 1156 53 1181 Q 35 1263 46 1307 58 1358 109 1359 172 1368 162 1424 118 1505 -12 1424 L -36 1397 -39 1393 Q -60 1365 -73 1329 8 1333 58 1125";
        ctx.fillStyle = tocolor(ctrans.apply([138, 147, 164, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M -87 1271 Q -97 1202 -85 1112 -63 1051 4 1060 54 1073 58 1125 8 1333 -73 1329 L -87 1271";
        ctx.fillStyle = tocolor(ctrans.apply([164, 189, 196, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M 57 1156 Q 116 1279 249 1338 175 1350 46 1307 35 1263 53 1181 L 57 1156";
        ctx.fillStyle = tocolor(ctrans.apply([127, 57, 111, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
    }

    function shape181(ctx, ctrans, frame, ratio, time) {
        var pathData =
            "M -110 -457 L -148 -447 Q -203 -648 -135 -858 L -95 -867 Q -163 -646 -110 -457 M 552 -936 L 598 -935 Q 700 -709 665 -470 L 632 -477 Q 665 -724 552 -936 M 1365 -724 L 1396 -703 Q 1447 -459 1277 -273 L 1276 -273 1242 -289 Q 1415 -476 1365 -724";
        ctx.fillStyle = tocolor(ctrans.apply([116, 146, 156, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M -135 -858 Q -203 -648 -148 -447 -414 -379 -655 -228 -807 -117 -943 21 -1161 -95 -1140 -334 L -1021 -442 Q -578 -748 -135 -858 M 598 -935 Q 918 -926 1185 -823 1285 -776 1365 -724 1415 -476 1242 -289 1017 -394 665 -470 700 -709 598 -935 M -1540 934 L -1664 926 Q -1914 849 -1878 724 -1827 584 -1755 448 -1642 628 -1404 655 -1476 788 -1540 934";
        ctx.fillStyle = tocolor(ctrans.apply([143, 166, 172, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 632 -477 L 631 -478 Q 240 -538 -110 -457 -163 -646 -95 -867 42 -899 179 -911 L 552 -936 Q 665 -724 632 -477 M -1732 405 Q -1529 40 -1175 -301 -1174 -58 -973 52 -1204 296 -1385 620 -1535 611 -1600 556 -1697 488 -1732 405";
        ctx.fillStyle = tocolor(ctrans.apply([164, 189, 196, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M -110 -457 Q -83 -364 -27 -278 L -74 -268 Q -123 -357 -148 -447 L -110 -457";
        ctx.fillStyle = tocolor(ctrans.apply([90, 118, 129, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M -148 -447 Q -123 -357 -74 -268 -332 -205 -564 -58 -667 9 -760 87 -866 61 -943 21 -807 -117 -655 -228 -414 -379 -148 -447";
        ctx.fillStyle = tocolor(ctrans.apply([126, 151, 158, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M -27 -278 Q -83 -364 -110 -457 240 -538 631 -478 L 632 -477 Q 621 -389 590 -295 265 -340 -27 -278";
        ctx.fillStyle = tocolor(ctrans.apply([144, 171, 182, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M -943 21 Q -866 61 -760 87 L -794 116 Q -897 93 -973 52 L -943 21 M -1385 620 Q -1306 624 -1204 616 L -1226 655 Q -1322 664 -1404 655 L -1385 620";
        ctx.fillStyle = tocolor(ctrans.apply([97, 133, 145, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 1881 -149 Q 1873 -73 1821 21 1712 202 1610 267 1417 374 1396 264 1378 206 1338 159 1206 -4 1051 -111 1177 -168 1273 -269 L 1276 -273 1277 -273 Q 1769 28 1881 -149 M -973 52 Q -897 93 -794 116 -1033 327 -1204 616 -1306 624 -1385 620 -1204 296 -973 52";
        ctx.fillStyle = tocolor(ctrans.apply([143, 171, 182, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M -943 21 L -973 52 Q -1174 -58 -1175 -301 L -1140 -334 Q -1161 -95 -943 21 M -1755 448 L -1732 405 Q -1697 488 -1600 556 -1535 611 -1385 620 L -1404 655 Q -1642 628 -1755 448";
        ctx.fillStyle = tocolor(ctrans.apply([110, 144, 154, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M -1404 655 Q -1322 664 -1226 655 -1278 747 -1323 847 -1413 927 -1540 934 -1476 788 -1404 655";
        ctx.fillStyle = tocolor(ctrans.apply([128, 151, 159, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M 1396 -703 Q 1659 -527 1862 -272 1889 -218 1881 -149 1769 28 1277 -273 1447 -459 1396 -703";
        ctx.fillStyle = tocolor(ctrans.apply([161, 188, 197, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData = "M 590 -295 Q 621 -389 632 -477 L 665 -470 Q 652 -382 620 -291 L 590 -295";
        ctx.fillStyle = tocolor(ctrans.apply([104, 134, 144, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 1021 -130 Q 837 -250 620 -291 652 -382 665 -470 1017 -394 1242 -289 L 1240 -287 Q 1145 -187 1021 -130";
        ctx.fillStyle = tocolor(ctrans.apply([127, 152, 159, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 1051 -111 L 1021 -130 Q 1145 -187 1240 -287 L 1242 -289 1276 -273 1273 -269 Q 1177 -168 1051 -111";
        ctx.fillStyle = tocolor(ctrans.apply([96, 128, 139, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
    }

    function shape182(ctx, ctrans, frame, ratio, time) {
        var pathData = "M -481 430 Q -892 622 -758 93 -576 -340 -37 -471 575 -542 788 -124 857 -76 -481 430";
        var grd = ctx.createLinearGradient(-107.75, -315.0, -10.25, 67.0);
        grd.addColorStop(0.0, tocolor(ctrans.apply([214, 214, 214, 0.28235295])));
        grd.addColorStop(1.0, tocolor(ctrans.apply([255, 255, 255, 0.0])));
        ctx.fillStyle = grd;
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
    }

    function shape183(ctx, ctrans, frame, ratio, time) {
        var pathData =
            "M 12954 3741 L 12954 3747 Q 12954 3778 12943 3818 12929 3856 12929 3875 12929 3957 13029 4017 13081 4047 13097 4063 13128 4094 13128 4136 L 13126 4180 Q 13119 4205 13087 4216 13078 4185 13060 4172 13042 4159 13013 4159 L 12823 4188 Q 12655 4216 12528 4216 12403 4216 12268 4269 12119 4327 12119 4394 L 12121 4423 Q 12125 4436 12144 4453 L 12144 4488 Q 12031 4472 11984 4514 11945 4549 11945 4627 11945 4664 11986 4880 L 11976 4918 11968 4955 Q 11968 5001 12117 5070 12262 5139 12328 5134 12311 5150 12266 5166 L 12191 5192 Q 12111 5228 12170 5297 L 12162 5297 Q 12150 5281 12115 5269 12082 5257 12047 5257 11982 5257 11820 5300 L 11640 5342 Q 11456 5342 11375 5304 L 11321 5266 Q 11289 5241 11284 5229 L 11264 5182 Q 11250 5163 11209 5162 11057 5154 10888 5038 10734 4931 10734 4864 10734 4827 10742 4789 10757 4711 10800 4692 10830 4732 10871 4765 10924 4810 10963 4810 L 11051 4794 Q 11117 4777 11139 4777 L 11186 4780 11225 4788 11205 4827 Q 11184 4862 11184 4880 11184 4952 11242 4952 11280 4952 11319 4926 L 11383 4879 11420 4887 11460 4891 Q 11495 4891 11563 4861 11634 4829 11702 4782 11876 4662 11876 4550 11876 4494 11843 4420 11810 4346 11810 4331 11810 4322 11847 4270 11884 4217 11884 4204 11884 4189 11796 4151 L 11600 4066 Q 11317 3929 11317 3794 L 11321 3775 11886 3758 12811 3741 12954 3741 M 11434 4697 Q 11534 4697 11628 4652 11732 4604 11728 4545 11763 4600 11614 4720 11464 4845 11334 4845 L 11299 4842 11268 4839 Q 11276 4830 11362 4789 11442 4745 11442 4715 L 11438 4701 11434 4697";
        ctx.fillStyle = tocolor(ctrans.apply([255, 255, 149, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 11321 3775 L 11317 3794 Q 11317 3929 11600 4066 L 11796 4151 Q 11884 4189 11884 4204 11884 4217 11847 4270 11810 4322 11810 4331 11810 4346 11843 4420 11876 4494 11876 4550 11876 4662 11702 4782 11634 4829 11563 4861 11495 4891 11460 4891 L 11420 4887 11383 4879 11319 4926 Q 11280 4952 11242 4952 11184 4952 11184 4880 11184 4862 11205 4827 L 11225 4788 11186 4780 11139 4777 Q 11117 4777 11051 4794 L 10963 4810 Q 10924 4810 10871 4765 10830 4732 10800 4692 10757 4711 10742 4789 10734 4827 10734 4864 10734 4931 10888 5038 11057 5154 11209 5162 11250 5163 11264 5182 L 11284 5229 Q 11289 5241 11321 5266 L 11375 5304 Q 11456 5342 11640 5342 L 11820 5300 Q 11982 5257 12047 5257 12082 5257 12115 5269 12150 5281 12162 5297 L 12170 5297 Q 12111 5228 12191 5192 L 12266 5166 Q 12311 5150 12328 5134 12262 5139 12117 5070 11968 5001 11968 4955 L 11976 4918 11986 4880 Q 11945 4664 11945 4627 11945 4549 11984 4514 12031 4472 12144 4488 L 12144 4453 Q 12125 4436 12121 4423 L 12119 4394 Q 12119 4327 12268 4269 12403 4216 12528 4216 12655 4216 12823 4188 L 13013 4159 Q 13042 4159 13060 4172 13078 4185 13087 4216 13119 4205 13126 4180 L 13128 4136 Q 13128 4094 13097 4063 13081 4047 13029 4017 12929 3957 12929 3875 12929 3856 12943 3818 12954 3778 12954 3747 L 12954 3741 13054 3741 Q 13060 3811 13083 3879 13113 3958 13154 3985 13222 4027 13275 4095 13330 4165 13330 4218 13330 4258 13312 4290 13289 4335 13242 4335 12921 4283 12811 4283 12653 4283 12532 4318 12389 4359 12328 4443 L 12183 4626 Q 12119 4719 12119 4830 12119 4924 12195 4980 12283 5048 12465 5048 L 12577 5037 Q 12612 5029 12653 5008 L 12653 5070 Q 12665 5115 12612 5142 12577 5159 12487 5176 L 12356 5205 Q 12295 5227 12295 5260 12295 5280 12311 5301 12328 5321 12328 5347 L 12266 5365 Q 12260 5367 12260 5399 L 12266 5436 12277 5479 12270 5479 Q 12230 5416 12174 5386 12105 5347 12005 5347 11917 5347 11786 5402 11655 5456 11559 5456 11428 5456 11266 5354 11129 5266 11084 5195 10898 5227 10724 5066 10566 4918 10566 4773 10566 4711 10620 4643 10679 4573 10767 4533 L 10816 4533 Q 10839 4593 10873 4622 10914 4658 10974 4658 L 11043 4643 11113 4630 Q 11149 4630 11172 4650 11195 4668 11233 4668 11307 4668 11375 4632 11454 4589 11518 4578 11538 4577 11604 4521 11685 4453 11685 4398 11685 4277 11598 4191 11542 4134 11409 4063 11258 3985 11213 3949 11123 3879 11109 3789 L 11321 3775 M 11434 4697 L 11438 4701 11442 4715 Q 11442 4745 11362 4789 11276 4830 11268 4839 L 11299 4842 11334 4845 Q 11464 4845 11614 4720 11763 4600 11728 4545 11732 4604 11628 4652 11534 4697 11434 4697";
        ctx.fillStyle = tocolor(ctrans.apply([236, 143, 40, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
    }

    function shape184(ctx, ctrans, frame, ratio, time) {
        var pathData =
            "M 854 1178 L 886 1180 933 1183 908 1226 Q 892 1251 892 1262 892 1324 937 1355 L 969 1375 Q 984 1387 984 1402 984 1419 975 1426 L 930 1445 Q 933 1429 921 1421 L 888 1403 865 1378 Q 849 1359 825 1359 786 1359 755 1385 724 1410 724 1444 724 1467 780 1519 829 1566 860 1582 941 1622 964 1637 1019 1674 1019 1709 1019 1757 925 1802 L 859 1832 Q 830 1848 830 1859 L 838 1883 Q 813 1882 780 1849 747 1816 729 1816 L 710 1821 687 1825 687 1823 697 1795 704 1760 Q 704 1745 687 1728 666 1707 638 1707 600 1707 566 1724 531 1743 540 1763 L 498 1771 Q 488 1777 488 1793 L 492 1809 495 1825 Q 495 1861 453 1876 L 410 1887 361 1897 361 1883 Q 360 1869 398 1860 437 1852 437 1839 L 429 1811 Q 420 1790 420 1780 420 1750 453 1728 485 1706 485 1678 485 1635 462 1594 437 1553 393 1524 362 1504 271 1478 183 1452 155 1452 L 136 1454 Q 129 1458 129 1469 129 1476 136 1489 L 143 1508 Q 75 1477 23 1436 -42 1385 -42 1344 -42 1314 20 1263 L 103 1199 104 1199 129 1202 139 1201 133 1208 Q 121 1223 106 1223 L 106 1224 109 1227 110 1229 Q 63 1278 43 1309 20 1346 20 1383 20 1395 51 1423 L 88 1454 Q 102 1437 128 1428 156 1417 189 1417 336 1417 444 1514 487 1553 513 1598 537 1640 537 1671 L 527 1698 509 1723 549 1700 570 1673 595 1650 Q 612 1640 644 1640 703 1640 736 1696 759 1734 765 1784 L 792 1763 789 1788 789 1807 825 1780 Q 849 1762 868 1758 905 1752 921 1738 936 1725 936 1704 936 1681 913 1670 L 857 1655 786 1637 Q 745 1620 721 1591 683 1548 668 1502 656 1466 656 1422 656 1327 812 1327 L 840 1331 858 1336 858 1333 840 1303 Q 824 1273 824 1262 824 1251 838 1216 L 854 1181 854 1178";
        ctx.fillStyle = tocolor(ctrans.apply([236, 143, 40, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 854 1178 L 854 1181 838 1216 Q 824 1251 824 1262 824 1273 840 1303 L 858 1333 858 1336 840 1331 812 1327 Q 656 1327 656 1422 656 1466 668 1502 683 1548 721 1591 745 1620 786 1637 L 857 1655 913 1670 Q 936 1681 936 1704 936 1725 921 1738 905 1752 868 1758 849 1762 825 1780 L 789 1807 789 1788 792 1763 765 1784 Q 759 1734 736 1696 703 1640 644 1640 612 1640 595 1650 L 570 1673 549 1700 509 1723 527 1698 537 1671 Q 537 1640 513 1598 487 1553 444 1514 336 1417 189 1417 156 1417 128 1428 102 1437 88 1454 L 51 1423 Q 20 1395 20 1383 20 1346 43 1309 63 1278 110 1229 L 109 1227 106 1224 106 1223 Q 121 1223 133 1208 L 139 1201 854 1178";
        ctx.fillStyle = tocolor(ctrans.apply([255, 255, 149, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
    }

    function shape185(ctx, ctrans, frame, ratio, time) {
        var pathData =
            "M 12933 3742 L 12921 3822 Q 12921 3916 12948 3973 12986 4050 13087 4115 L 13179 4164 Q 13246 4201 13246 4228 13246 4340 13271 4380 L 13220 4380 Q 13209 4337 13119 4295 13017 4250 12882 4250 12829 4250 12714 4290 12598 4329 12506 4329 12469 4329 12403 4310 12336 4290 12299 4290 12213 4290 12152 4318 12076 4354 12076 4425 12076 4440 12093 4480 12111 4520 12111 4533 12111 4565 12045 4602 11982 4640 11986 4692 L 11957 4663 Q 11941 4647 11910 4647 11857 4647 11853 4672 L 11843 4737 11839 4732 11835 4731 11796 4667 Q 11792 4662 11792 4635 11792 4583 11855 4516 11919 4449 11919 4403 11919 4339 11847 4301 L 11798 4275 Q 11777 4261 11777 4241 L 11784 4208 11792 4173 Q 11792 4112 11728 4058 11643 3990 11499 3990 L 11395 4000 11303 4008 Q 11258 4008 11233 3994 L 11176 3961 11133 4002 11133 3939 Q 11150 3891 11184 3843 11199 3819 11215 3806 L 12933 3742 M 11446 4940 Q 11465 4902 11510 4902 L 11561 4912 11604 4924 Q 11685 4924 11745 4867 11794 4821 11802 4770 L 11802 4777 Q 11806 4778 11827 4794 11843 4805 11855 4805 L 11900 4776 11935 4742 Q 11935 4784 11955 4846 11978 4924 12009 4924 L 12076 4918 Q 12052 4952 12052 5065 12052 5143 12068 5184 12099 5269 12193 5269 L 12248 5258 12303 5247 Q 12305 5314 12230 5370 12152 5427 12043 5427 11982 5427 11951 5399 11919 5371 11880 5371 11847 5371 11808 5387 L 11733 5424 Q 11618 5479 11479 5479 11329 5479 11229 5343 11201 5305 11172 5247 L 11141 5196 Q 11121 5184 11021 5152 10929 5123 10892 5099 10839 5067 10798 5030 10734 4972 10734 4929 10734 4879 10757 4850 10785 4815 10845 4815 10935 4815 10974 4857 L 11002 4883 Q 11019 4896 11049 4896 L 11078 4888 11109 4879 Q 11094 4952 11139 4989 11184 5025 11284 5025 11379 5025 11424 4985 L 11446 4940 M 11616 4796 L 11659 4762 11659 4770 Q 11659 4793 11634 4833 11606 4879 11581 4879 L 11536 4871 11479 4862 Q 11467 4862 11434 4879 11401 4896 11375 4896 L 11352 4887 11327 4874 11395 4838 Q 11432 4815 11464 4815 11481 4815 11505 4825 L 11542 4833 Q 11569 4833 11616 4796";
        ctx.fillStyle = tocolor(ctrans.apply([255, 255, 149, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 11215 3806 Q 11199 3819 11184 3843 11150 3891 11133 3939 L 11133 4002 11176 3961 11233 3994 Q 11258 4008 11303 4008 L 11395 4000 11499 3990 Q 11643 3990 11728 4058 11792 4112 11792 4173 L 11784 4208 11777 4241 Q 11777 4261 11798 4275 L 11847 4301 Q 11919 4339 11919 4403 11919 4449 11855 4516 11792 4583 11792 4635 11792 4662 11796 4667 L 11835 4731 11839 4732 11843 4737 11853 4672 Q 11857 4647 11910 4647 11941 4647 11957 4663 L 11986 4692 Q 11982 4640 12045 4602 12111 4565 12111 4533 12111 4520 12093 4480 12076 4440 12076 4425 12076 4354 12152 4318 12213 4290 12299 4290 12336 4290 12403 4310 12469 4329 12506 4329 12598 4329 12714 4290 12829 4250 12882 4250 13017 4250 13119 4295 13209 4337 13220 4380 L 13271 4380 Q 13246 4340 13246 4228 13246 4201 13179 4164 L 13087 4115 Q 12986 4050 12948 3973 12921 3916 12921 3822 L 12933 3742 13003 3751 Q 13019 3893 13085 3982 13126 4038 13218 4102 13310 4165 13342 4204 13396 4274 13396 4388 13396 4459 13359 4490 L 13238 4562 13238 4555 13261 4505 Q 13279 4473 13279 4455 13232 4441 13109 4387 13056 4363 12925 4363 12541 4363 12369 4505 12195 4648 12195 4963 12195 5036 12236 5105 12289 5196 12381 5196 12424 5196 12444 5183 12459 5171 12461 5144 L 12469 5144 12498 5199 Q 12518 5235 12518 5255 12518 5353 12395 5412 12332 5440 12309 5451 12270 5468 12270 5481 L 12270 5536 Q 12258 5569 12193 5569 12123 5569 12041 5526 11957 5484 11947 5484 11915 5484 11902 5500 L 11876 5533 Q 11831 5581 11667 5581 11448 5581 11242 5505 11002 5416 10992 5280 10988 5200 10900 5172 L 10804 5147 10716 5122 Q 10648 5090 10601 5026 10548 4956 10548 4872 10548 4803 10566 4754 10599 4658 10687 4658 10724 4658 10791 4703 10859 4748 10896 4748 L 10959 4740 11029 4731 Q 11068 4731 11090 4741 L 11121 4762 Q 11164 4794 11301 4794 L 11413 4780 Q 11471 4762 11475 4725 11481 4683 11495 4643 11510 4602 11526 4590 11532 4586 11685 4537 11802 4500 11802 4453 11802 4343 11552 4193 11450 4132 11348 4092 11244 4053 11186 4053 11109 4053 11109 4098 L 11113 4118 11115 4131 Q 11066 4127 11037 4043 11017 3980 11017 3912 11017 3862 11078 3802 L 11141 3802 11215 3806 M 11616 4796 Q 11569 4833 11542 4833 L 11505 4825 Q 11481 4815 11464 4815 11432 4815 11395 4838 L 11327 4874 11352 4887 11375 4896 Q 11401 4896 11434 4879 11467 4862 11479 4862 L 11536 4871 11581 4879 Q 11606 4879 11634 4833 11659 4793 11659 4770 L 11659 4762 11616 4796 M 11446 4940 L 11424 4985 Q 11379 5025 11284 5025 11184 5025 11139 4989 11094 4952 11109 4879 L 11078 4888 11049 4896 Q 11019 4896 11002 4883 L 10974 4857 Q 10935 4815 10845 4815 10785 4815 10757 4850 10734 4879 10734 4929 10734 4972 10798 5030 10839 5067 10892 5099 10929 5123 11021 5152 11121 5184 11141 5196 L 11172 5247 Q 11201 5305 11229 5343 11329 5479 11479 5479 11618 5479 11733 5424 L 11808 5387 Q 11847 5371 11880 5371 11919 5371 11951 5399 11982 5427 12043 5427 12152 5427 12230 5370 12305 5314 12303 5247 L 12248 5258 12193 5269 Q 12099 5269 12068 5184 12052 5143 12052 5065 12052 4952 12076 4918 L 12009 4924 Q 11978 4924 11955 4846 11935 4784 11935 4742 L 11900 4776 11855 4805 Q 11843 4805 11827 4794 11806 4778 11802 4777 L 11802 4770 Q 11794 4821 11745 4867 11685 4924 11604 4924 L 11561 4912 11510 4902 Q 11465 4902 11446 4940";
        ctx.fillStyle = tocolor(ctrans.apply([236, 143, 40, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
    }

    function shape186(ctx, ctrans, frame, ratio, time) {
        var pathData =
            "M 12837 3705 L 13029 3706 13029 3712 12952 3774 Q 12915 3795 12901 3806 12862 3831 12862 3905 12862 4114 13013 4222 L 13115 4283 Q 13162 4311 13162 4331 13162 4346 13136 4368 13113 4392 13113 4403 13113 4437 13160 4449 L 13261 4457 13365 4463 Q 13412 4472 13412 4502 13412 4521 13381 4537 13346 4554 13338 4567 13371 4578 13377 4594 L 13379 4636 Q 13379 4685 13338 4720 13283 4765 13173 4765 13126 4765 13083 4734 13046 4709 12978 4720 12935 4727 12855 4687 12761 4640 12720 4567 L 12720 4521 12811 4574 Q 12839 4590 12886 4590 L 12935 4587 Q 12956 4582 12954 4555 L 12847 4476 Q 12743 4403 12657 4403 12581 4403 12528 4455 12477 4504 12477 4565 12477 4632 12567 4715 L 12766 4870 Q 12900 4972 12964 5052 13054 5164 13054 5282 13054 5365 13001 5412 12952 5455 12847 5484 L 12749 5493 12624 5501 Q 12473 5519 12495 5591 L 12487 5591 Q 12469 5569 12469 5549 12469 5522 12502 5477 12536 5434 12536 5410 12536 5359 12487 5326 12434 5292 12344 5292 12230 5292 12131 5374 12041 5447 12035 5512 12029 5580 11923 5641 11872 5671 11853 5687 11823 5715 11827 5751 L 11806 5723 Q 11792 5702 11792 5690 11792 5659 11827 5602 11861 5546 11861 5521 11861 5505 11839 5442 L 11818 5369 Q 11818 5342 11859 5297 L 11951 5203 Q 12086 5057 12086 4904 12086 4790 11970 4725 11857 4663 11663 4663 L 11489 4665 Q 11399 4671 11327 4697 L 11289 4636 Q 11262 4599 11225 4585 11176 4565 11123 4553 L 11017 4533 Q 10859 4505 10794 4382 10749 4299 10749 4180 10749 4045 10837 3933 10916 3834 11031 3793 L 11188 3781 11145 3828 11055 3928 Q 10967 4030 10967 4145 10967 4258 11031 4313 11072 4347 11176 4376 11285 4407 11325 4432 11395 4480 11401 4578 11464 4525 11561 4497 11655 4470 11769 4470 11994 4470 12195 4713 12273 4807 12322 4911 12369 5008 12369 5065 12369 5123 12301 5152 12271 5164 12148 5188 12043 5209 11996 5241 11927 5286 11927 5374 11927 5396 11939 5412 11951 5427 11951 5456 11992 5392 12060 5355 12123 5321 12234 5297 L 12395 5251 Q 12526 5212 12561 5212 12694 5212 12694 5317 12694 5327 12675 5355 12653 5381 12653 5394 L 12729 5394 Q 12851 5350 12878 5320 12903 5293 12903 5209 12903 5142 12810 5056 12770 5018 12608 4892 12467 4786 12403 4715 12311 4608 12311 4510 12311 4396 12377 4318 12440 4245 12518 4245 12639 4245 12862 4368 13079 4489 13079 4543 13079 4591 13060 4614 13042 4635 12988 4658 12995 4675 13017 4679 L 13062 4680 Q 13140 4680 13205 4658 13279 4631 13279 4586 13279 4559 13154 4497 13029 4435 13029 4398 L 13038 4375 13044 4354 Q 13044 4326 12931 4277 12810 4225 12796 4181 12788 4161 12778 4053 L 12770 3916 Q 12770 3836 12776 3823 L 12837 3705";
        ctx.fillStyle = tocolor(ctrans.apply([236, 143, 40, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 12837 3705 L 12776 3823 Q 12770 3836 12770 3916 L 12778 4053 Q 12788 4161 12796 4181 12810 4225 12931 4277 13044 4326 13044 4354 L 13038 4375 13029 4398 Q 13029 4435 13154 4497 13279 4559 13279 4586 13279 4631 13205 4658 13140 4680 13062 4680 L 13017 4679 Q 12995 4675 12988 4658 13042 4635 13060 4614 13079 4591 13079 4543 13079 4489 12862 4368 12639 4245 12518 4245 12440 4245 12377 4318 12311 4396 12311 4510 12311 4608 12403 4715 12467 4786 12608 4892 12770 5018 12810 5056 12903 5142 12903 5209 12903 5293 12878 5320 12851 5350 12729 5394 L 12653 5394 Q 12653 5381 12675 5355 12694 5327 12694 5317 12694 5212 12561 5212 12526 5212 12395 5251 L 12234 5297 Q 12123 5321 12060 5355 11992 5392 11951 5456 11951 5427 11939 5412 11927 5396 11927 5374 11927 5286 11996 5241 12043 5209 12148 5188 12271 5164 12301 5152 12369 5123 12369 5065 12369 5008 12322 4911 12273 4807 12195 4713 11994 4470 11769 4470 11655 4470 11561 4497 11464 4525 11401 4578 11395 4480 11325 4432 11285 4407 11176 4376 11072 4347 11031 4313 10967 4258 10967 4145 10967 4030 11055 3928 L 11145 3828 11188 3781 11555 3740 Q 11859 3698 12119 3696 12127 3704 12493 3704 L 12837 3705";
        ctx.fillStyle = tocolor(ctrans.apply([255, 255, 149, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
    }

    function shape187(ctx, ctrans, frame, ratio, time) {
        var pathData =
            "M 135 1199 L 105 1253 Q 78 1306 78 1314 L 80 1325 81 1336 85 1336 Q 88 1323 125 1318 L 167 1316 205 1309 239 1301 Q 265 1301 322 1337 375 1371 393 1394 L 409 1422 417 1452 Q 420 1471 438 1481 454 1490 454 1504 454 1534 427 1557 L 375 1587 Q 359 1596 346 1628 334 1658 334 1682 L 338 1691 345 1700 Q 369 1690 385 1663 402 1633 417 1624 L 453 1596 Q 467 1585 502 1568 L 519 1549 533 1531 Q 545 1522 549 1511 L 556 1494 Q 542 1471 576 1454 607 1438 645 1438 666 1438 707 1458 748 1478 772 1478 L 802 1472 827 1466 Q 869 1466 902 1498 929 1526 927 1542 L 953 1509 Q 968 1481 968 1458 968 1424 940 1406 924 1395 880 1383 838 1370 820 1358 793 1339 793 1302 793 1290 803 1273 L 826 1238 850 1188 854 1188 922 1188 893 1225 Q 868 1253 868 1268 868 1286 893 1314 L 947 1368 Q 1025 1442 1025 1481 1025 1501 1011 1517 L 980 1544 Q 936 1579 940 1621 L 940 1624 Q 922 1606 912 1584 L 898 1551 Q 891 1536 876 1529 L 821 1522 729 1529 Q 683 1537 618 1557 564 1572 540 1582 486 1602 472 1624 L 472 1667 485 1671 497 1672 510 1670 523 1667 Q 493 1684 488 1693 485 1698 485 1719 485 1749 494 1775 509 1812 540 1804 L 516 1828 527 1829 495 1852 Q 474 1866 474 1883 474 1910 509 1930 536 1946 556 1946 572 1946 587 1928 599 1915 601 1902 L 603 1904 612 1904 Q 630 1904 649 1884 666 1865 666 1853 L 663 1845 660 1840 Q 721 1879 721 1919 721 1943 680 1963 639 1982 612 1971 L 591 1971 Q 599 1997 564 2007 L 500 2013 444 2002 396 1981 Q 401 1993 364 2004 L 295 2013 Q 216 2013 161 1986 115 1963 88 1923 54 1870 8 1850 L -11 1833 Q -17 1821 -17 1790 L -8 1749 0 1719 -16 1704 Q -31 1688 -31 1676 -31 1666 0 1642 30 1619 46 1619 61 1619 70 1629 L 85 1651 Q 110 1682 184 1682 214 1682 242 1665 270 1649 270 1637 L 266 1624 263 1612 Q 263 1605 282 1596 L 301 1582 296 1560 Q 294 1547 310 1542 348 1533 370 1514 393 1494 393 1469 393 1426 318 1389 248 1355 184 1355 L 132 1361 Q 112 1369 112 1381 L 114 1390 Q 117 1394 126 1399 L 126 1401 Q 74 1395 44 1359 20 1331 20 1298 20 1282 26 1269 L 48 1234 63 1204 Q 70 1195 102 1195 L 135 1199 M 331 1988 Q 355 1986 366 1976 379 1965 384 1965 L 436 1976 516 1988 552 1987 Q 574 1983 577 1970 L 493 1965 Q 442 1952 444 1923 446 1900 431 1891 422 1884 400 1879 L 366 1870 Q 352 1860 352 1839 L 398 1800 Q 444 1760 444 1732 L 438 1713 Q 431 1702 431 1691 431 1681 451 1661 402 1682 398 1715 L 394 1732 Q 388 1740 369 1740 348 1740 327 1721 307 1703 297 1703 L 272 1707 250 1710 243 1709 208 1723 158 1732 Q 146 1732 104 1712 L 58 1689 Q 58 1727 63 1743 L 68 1780 Q 68 1804 83 1816 96 1829 123 1830 123 1841 133 1870 143 1899 153 1911 189 1958 262 1983 L 311 1994 Q 331 1995 331 1988 M 663 1914 L 641 1929 Q 625 1940 608 1936 L 624 1945 640 1946 663 1943 666 1930 664 1918 663 1916 663 1914 M 486 2402 L 488 2401 495 2404 486 2404 486 2402";
        ctx.fillStyle = tocolor(ctrans.apply([236, 143, 40, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 135 1199 L 220 1199 354 1188 482 1176 682 1181 850 1188 826 1238 803 1273 Q 793 1290 793 1302 793 1339 820 1358 838 1370 880 1383 924 1395 940 1406 968 1424 968 1458 968 1481 953 1509 L 927 1542 Q 929 1526 902 1498 869 1466 827 1466 L 802 1472 772 1478 Q 748 1478 707 1458 666 1438 645 1438 607 1438 576 1454 542 1471 556 1494 L 549 1511 Q 545 1522 533 1531 L 519 1549 502 1568 Q 467 1585 453 1596 L 417 1624 Q 402 1633 385 1663 369 1690 345 1700 L 338 1691 334 1682 Q 334 1658 346 1628 359 1596 375 1587 L 427 1557 Q 454 1534 454 1504 454 1490 438 1481 420 1471 417 1452 L 409 1422 393 1394 Q 375 1371 322 1337 265 1301 239 1301 L 205 1309 167 1316 125 1318 Q 88 1323 85 1336 L 81 1336 80 1325 78 1314 Q 78 1306 105 1253 L 135 1199 M 331 1988 Q 331 1995 311 1994 L 262 1983 Q 189 1958 153 1911 143 1899 133 1870 123 1841 123 1830 96 1829 83 1816 68 1804 68 1780 L 63 1743 Q 58 1727 58 1689 L 104 1712 Q 146 1732 158 1732 L 208 1723 243 1709 250 1710 272 1707 297 1703 Q 307 1703 327 1721 348 1740 369 1740 388 1740 394 1732 L 398 1715 Q 402 1682 451 1661 431 1681 431 1691 431 1702 438 1713 L 444 1732 Q 444 1760 398 1800 L 352 1839 Q 352 1860 366 1870 L 400 1879 Q 422 1884 431 1891 446 1900 444 1923 442 1952 493 1965 L 577 1970 Q 574 1983 552 1987 L 516 1988 436 1976 384 1965 Q 379 1965 366 1976 355 1986 331 1988 L 331 1985 326 1988 331 1988 M 663 1914 L 663 1916 664 1918 666 1930 663 1943 640 1946 624 1945 608 1936 Q 625 1940 641 1929 L 663 1914";
        ctx.fillStyle = tocolor(ctrans.apply([255, 255, 149, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
    }

    function shape188(ctx, ctrans, frame, ratio, time) {
        var pathData =
            "M 12772 3741 L 12847 3746 13036 3770 Q 13013 3812 12960 3855 L 12741 3984 Q 12586 4066 12518 4127 12418 4220 12418 4331 12418 4356 12487 4383 12561 4411 12577 4441 L 12510 4459 Q 12522 4484 12592 4512 12661 4537 12678 4595 L 12622 4583 Q 12586 4583 12518 4610 12451 4636 12436 4634 12268 4616 12268 4713 12268 4845 12338 4939 12381 5000 12491 5078 12604 5162 12641 5208 12710 5292 12710 5404 12710 5492 12704 5530 12696 5573 12669 5614 12635 5668 12557 5715 12495 5753 12495 5779 12495 5804 12498 5816 12504 5830 12528 5851 L 12518 5846 Q 12448 5842 12422 5816 12405 5797 12405 5760 12403 5717 12397 5706 12383 5682 12330 5682 12279 5682 12234 5715 12193 5749 12193 5789 12193 5834 12244 5895 12293 5958 12293 5984 12293 6037 12240 6076 12191 6109 12127 6113 L 12174 6068 Q 12201 6041 12201 6013 12201 5984 12178 5948 L 12123 5878 Q 12043 5779 12043 5676 12043 5594 12178 5452 12311 5312 12311 5243 12311 5150 12270 5077 12191 4940 11994 4940 11951 4940 11833 4969 L 11681 4997 Q 11546 4997 11287 4939 11064 4888 11008 4862 10830 4774 10699 4648 10573 4528 10573 4453 10573 4343 10673 4275 10736 4232 10896 4180 11060 4127 11115 4092 11217 4030 11217 3933 11217 3909 11178 3866 11147 3828 11119 3810 L 11348 3782 11329 3801 Q 11325 3809 11325 3850 11325 3897 11409 3948 11493 4000 11493 4023 11493 4045 11434 4087 L 11342 4148 Q 11329 4156 11321 4176 L 11307 4213 Q 11285 4262 11209 4278 L 11060 4293 Q 10986 4297 10957 4329 10904 4387 10882 4423 10857 4464 10857 4502 10857 4517 10908 4561 10965 4607 11008 4618 L 10976 4658 10974 4691 Q 10974 4782 11090 4838 11197 4890 11344 4890 11389 4890 11595 4850 L 11812 4810 Q 11917 4810 12017 4857 12072 4882 12152 4929 L 12086 4535 Q 12086 4508 12137 4493 L 12227 4482 12318 4494 Q 12377 4509 12410 4538 12426 4517 12426 4502 12426 4452 12328 4343 12227 4233 12227 4189 12227 4126 12283 4062 12346 3992 12444 3961 12624 3904 12694 3836 L 12772 3741 M 12129 5667 Q 12193 5630 12228 5618 12271 5603 12336 5603 12448 5603 12453 5671 12461 5651 12528 5570 12579 5508 12579 5453 12579 5418 12514 5362 L 12410 5268 12418 5292 12420 5351 Q 12420 5476 12273 5538 12185 5577 12174 5585 12127 5614 12127 5656 L 12129 5667 12111 5676 Q 12127 5686 12129 5667";
        ctx.fillStyle = tocolor(ctrans.apply([236, 143, 40, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 12772 3741 L 12694 3836 Q 12624 3904 12444 3961 12346 3992 12283 4062 12227 4126 12227 4189 12227 4233 12328 4343 12426 4452 12426 4502 12426 4517 12410 4538 12377 4509 12318 4494 L 12227 4482 12137 4493 Q 12086 4508 12086 4535 L 12152 4929 Q 12072 4882 12017 4857 11917 4810 11812 4810 L 11595 4850 Q 11389 4890 11344 4890 11197 4890 11090 4838 10974 4782 10974 4691 L 10976 4658 11008 4618 Q 10965 4607 10908 4561 10857 4517 10857 4502 10857 4464 10882 4423 10904 4387 10957 4329 10986 4297 11060 4293 L 11209 4278 Q 11285 4262 11307 4213 L 11321 4176 Q 11329 4156 11342 4148 L 11434 4087 Q 11493 4045 11493 4023 11493 4000 11409 3948 11325 3897 11325 3850 11325 3809 11329 3801 L 11348 3782 11833 3749 Q 12162 3734 12555 3734 L 12772 3741 M 12129 5667 L 12127 5656 Q 12127 5614 12174 5585 12185 5577 12273 5538 12420 5476 12420 5351 L 12418 5292 12410 5268 12514 5362 Q 12579 5418 12579 5453 12579 5508 12528 5570 12461 5651 12453 5671 12448 5603 12336 5603 12271 5603 12228 5618 12193 5630 12129 5667";
        ctx.fillStyle = tocolor(ctrans.apply([255, 255, 149, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
    }

    function shape189(ctx, ctrans, frame, ratio, time) {
        var pathData =
            "M -92 1185 Q 6 1193 6 1240 6 1247 -2 1254 -10 1261 -10 1267 -10 1275 20 1309 L 20 1331 -7 1332 Q -27 1334 -31 1346 -53 1338 -69 1327 L -107 1322 -211 1328 Q -260 1336 -297 1361 -351 1398 -376 1421 -424 1466 -424 1503 -424 1546 -370 1564 L -240 1578 Q -194 1578 -162 1614 -145 1634 -127 1664 -142 1662 -179 1644 L -228 1624 Q -240 1624 -266 1635 L -268 1636 -273 1638 -294 1638 -316 1651 Q -325 1657 -325 1667 L -281 1727 Q -236 1782 -236 1793 -236 1820 -264 1849 -299 1886 -308 1907 L -312 1907 -313 1900 -315 1893 Q -315 1873 -301 1847 -287 1822 -287 1810 -287 1770 -347 1770 L -365 1772 -384 1775 Q -422 1775 -451 1739 L -472 1714 Q -483 1702 -493 1702 L -584 1729 Q -671 1756 -717 1756 -737 1756 -818 1725 -889 1698 -913 1684 -986 1646 -1006 1627 -1036 1598 -1036 1547 -1036 1502 -1004 1472 -975 1446 -893 1410 L -900 1432 Q -900 1454 -879 1459 L -841 1461 Q -791 1461 -756 1431 -728 1408 -728 1388 -728 1358 -776 1296 L -845 1216 -845 1211 -746 1210 -730 1240 -689 1279 -649 1314 Q -632 1335 -633 1357 -635 1394 -594 1442 -551 1490 -551 1529 -551 1554 -582 1568 -607 1580 -641 1580 -691 1580 -710 1555 L -724 1539 Q -732 1531 -749 1531 L -775 1536 -796 1540 Q -820 1540 -834 1514 L -845 1482 Q -903 1489 -903 1560 -903 1627 -852 1664 -797 1702 -688 1702 -626 1702 -580 1682 -535 1662 -488 1662 -457 1662 -440 1675 L -424 1698 -424 1710 Q -413 1727 -366 1731 -324 1734 -309 1742 L -341 1705 -374 1660 Q -374 1651 -353 1637 -334 1625 -325 1624 L -382 1606 Q -418 1595 -428 1582 -479 1518 -479 1471 -479 1417 -432 1381 -404 1361 -332 1322 L -280 1299 Q -242 1286 -219 1288 L -149 1280 -107 1269 Q -102 1269 -83 1282 -64 1296 -44 1297 L -75 1229 -87 1197 -92 1185 M -309 1742 L -304 1747 -304 1745 -309 1742 M -711 1453 Q -711 1463 -697 1470 L -684 1482 -691 1489 -707 1494 -742 1485 -752 1485 -774 1488 -800 1489 Q -788 1511 -761 1513 L -714 1510 Q -699 1510 -683 1523 -666 1536 -648 1536 -624 1536 -612 1522 -602 1510 -602 1494 -602 1481 -624 1467 -649 1453 -653 1439 L -653 1401 Q -653 1378 -680 1371 L -711 1453";
        ctx.fillStyle = tocolor(ctrans.apply([236, 143, 40, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M -92 1185 L -87 1197 -75 1229 -44 1297 Q -64 1296 -83 1282 -102 1269 -107 1269 L -149 1280 -219 1288 Q -242 1286 -280 1299 L -332 1322 Q -404 1361 -432 1381 -479 1417 -479 1471 -479 1518 -428 1582 -418 1595 -382 1606 L -325 1624 Q -334 1625 -353 1637 -374 1651 -374 1660 L -341 1705 -309 1742 Q -324 1734 -366 1731 -413 1727 -424 1710 L -424 1698 -440 1675 Q -457 1662 -488 1662 -535 1662 -580 1682 -626 1702 -688 1702 -797 1702 -852 1664 -903 1627 -903 1560 -903 1489 -845 1482 L -834 1514 Q -820 1540 -796 1540 L -775 1536 -749 1531 Q -732 1531 -724 1539 L -710 1555 Q -691 1580 -641 1580 -607 1580 -582 1568 -551 1554 -551 1529 -551 1490 -594 1442 -635 1394 -633 1357 -632 1335 -649 1314 L -689 1279 -730 1240 -746 1210 -726 1208 -591 1193 -414 1190 -250 1188 Q -250 1186 -256 1185 L -189 1184 Q -127 1183 -92 1185 M -711 1453 L -680 1371 Q -653 1378 -653 1401 L -653 1439 Q -649 1453 -624 1467 -602 1481 -602 1494 -602 1510 -612 1522 -624 1536 -648 1536 -666 1536 -683 1523 -699 1510 -714 1510 L -761 1513 Q -788 1511 -800 1489 L -774 1488 -752 1485 -742 1485 -707 1494 -691 1489 -684 1482 -697 1470 Q -711 1463 -711 1453";
        ctx.fillStyle = tocolor(ctrans.apply([255, 255, 149, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
    }

    function shape190(ctx, ctrans, frame, ratio, time) {
        var pathData =
            "M 204 1198 L 196 1206 194 1226 Q 194 1245 229 1266 263 1287 263 1297 263 1306 239 1323 L 201 1348 192 1359 187 1374 Q 178 1394 147 1401 L 86 1407 Q 55 1409 43 1422 L 13 1460 Q 2 1477 2 1493 L 23 1517 Q 47 1536 64 1540 L 51 1557 50 1570 Q 50 1607 98 1630 142 1652 202 1652 L 305 1635 394 1619 Q 437 1619 478 1638 L 533 1668 506 1506 Q 506 1495 527 1489 L 564 1485 601 1489 Q 625 1496 638 1508 L 645 1493 Q 645 1472 605 1428 564 1383 564 1365 564 1339 586 1313 612 1284 652 1271 726 1248 755 1220 L 787 1181 817 1183 895 1193 864 1228 774 1281 Q 711 1314 683 1339 642 1377 642 1423 642 1433 670 1444 700 1456 707 1468 L 679 1475 Q 684 1485 713 1497 741 1507 748 1531 L 725 1526 Q 711 1526 683 1537 L 649 1547 Q 580 1539 580 1579 580 1633 609 1672 627 1697 672 1729 718 1763 733 1782 761 1816 761 1862 L 759 1914 Q 756 1931 745 1948 731 1970 699 1990 673 2005 673 2016 L 675 2031 687 2045 683 2043 Q 654 2042 643 2031 636 2023 636 2008 L 633 1986 Q 627 1976 606 1976 585 1976 566 1990 550 2003 550 2020 550 2038 570 2063 591 2089 591 2100 591 2121 569 2137 549 2151 523 2153 L 542 2134 Q 553 2123 553 2112 553 2100 543 2085 L 521 2056 Q 488 2016 488 1974 488 1940 543 1882 598 1825 598 1796 598 1758 581 1728 549 1672 468 1672 L 402 1684 340 1696 Q 285 1696 179 1672 87 1651 64 1640 -9 1604 -62 1553 -114 1503 -114 1473 -114 1428 -73 1400 -47 1382 18 1361 86 1339 108 1325 150 1299 150 1260 150 1250 134 1232 L 110 1209 204 1198 M 523 1970 Q 550 1955 564 1950 L 608 1944 Q 654 1944 656 1972 659 1963 687 1930 708 1905 708 1882 708 1868 681 1845 L 638 1806 642 1816 643 1840 Q 643 1892 582 1917 L 542 1936 Q 523 1948 523 1965 L 523 1970";
        ctx.fillStyle = tocolor(ctrans.apply([236, 143, 40, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M 204 1198 L 402 1184 Q 537 1178 698 1178 L 787 1181 755 1220 Q 726 1248 652 1271 612 1284 586 1313 564 1339 564 1365 564 1383 605 1428 645 1472 645 1493 L 638 1508 Q 625 1496 601 1489 L 564 1485 527 1489 Q 506 1495 506 1506 L 533 1668 478 1638 Q 437 1619 394 1619 L 305 1635 202 1652 Q 142 1652 98 1630 50 1607 50 1570 L 51 1557 64 1540 Q 47 1536 23 1517 L 2 1493 Q 2 1477 13 1460 L 43 1422 Q 55 1409 86 1407 L 147 1401 Q 178 1394 187 1374 L 192 1359 201 1348 239 1323 Q 263 1306 263 1297 263 1287 229 1266 194 1245 194 1226 L 196 1206 204 1198 M 523 1970 L 523 1965 Q 523 1948 542 1936 L 582 1917 Q 643 1892 643 1840 L 642 1816 638 1806 681 1845 Q 708 1868 708 1882 708 1905 687 1930 659 1963 656 1972 654 1944 608 1944 L 564 1950 Q 550 1955 523 1970";
        ctx.fillStyle = tocolor(ctrans.apply([255, 255, 149, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
    }

    function shape191(ctx, ctrans, frame, ratio, time) {
        var pathData =
            "M -805 1199 L -835 1253 Q -862 1306 -862 1314 L -860 1325 -859 1336 -855 1336 Q -852 1323 -815 1318 L -773 1316 -735 1309 -701 1301 Q -675 1301 -618 1337 -565 1371 -547 1394 L -531 1422 -523 1452 Q -520 1471 -502 1481 -486 1490 -486 1504 -486 1534 -513 1557 L -565 1587 Q -581 1596 -594 1628 -606 1658 -606 1682 L -602 1691 -595 1700 Q -571 1690 -555 1663 -538 1633 -523 1624 L -487 1596 Q -473 1585 -438 1568 L -421 1549 -407 1531 Q -395 1522 -391 1511 L -384 1494 Q -398 1471 -364 1454 -333 1438 -295 1438 -274 1438 -233 1458 -192 1478 -168 1478 L -138 1472 -113 1466 Q -71 1466 -38 1498 -11 1526 -13 1542 -1 1536 13 1509 28 1481 28 1458 28 1424 0 1406 -16 1395 -60 1383 -102 1370 -120 1358 -147 1339 -147 1302 -147 1290 -137 1273 L -114 1238 -90 1188 -86 1188 -18 1188 -47 1225 Q -72 1253 -72 1268 -72 1286 -47 1314 L 7 1368 Q 85 1442 85 1481 85 1501 71 1517 L 40 1544 Q -4 1579 0 1621 L 0 1624 Q -18 1606 -28 1584 L -42 1551 Q -49 1536 -64 1529 L -119 1522 -211 1529 -322 1557 Q -376 1572 -400 1582 -454 1602 -468 1624 L -468 1667 -455 1671 -443 1672 -430 1670 -417 1667 -452 1693 -455 1719 Q -455 1749 -446 1775 -431 1812 -400 1804 L -424 1828 -413 1829 -445 1852 Q -466 1866 -466 1883 -466 1910 -431 1930 -404 1946 -384 1946 -368 1946 -353 1928 -341 1915 -339 1902 L -337 1904 -328 1904 Q -310 1904 -291 1884 -274 1865 -274 1853 -274 1850 -277 1845 L -280 1840 Q -219 1879 -219 1919 -219 1943 -260 1963 -301 1982 -328 1971 L -349 1971 Q -341 1997 -376 2007 L -440 2013 Q -465 2013 -496 2002 L -544 1981 Q -539 1993 -576 2004 L -645 2013 Q -724 2013 -779 1986 -825 1963 -852 1923 -886 1870 -932 1850 L -951 1833 Q -957 1821 -957 1790 L -948 1749 -940 1719 -956 1704 Q -971 1688 -971 1676 -971 1666 -940 1642 -910 1619 -894 1619 -879 1619 -870 1629 L -855 1651 Q -830 1682 -756 1682 -726 1682 -698 1665 -670 1649 -670 1637 L -674 1624 -677 1612 Q -677 1605 -658 1596 L -639 1582 -644 1560 Q -646 1547 -630 1542 -592 1533 -570 1514 -547 1494 -547 1469 -547 1426 -622 1389 -692 1355 -756 1355 L -808 1361 Q -828 1369 -828 1381 L -826 1390 -814 1399 -814 1401 Q -866 1395 -896 1359 -920 1331 -920 1298 L -914 1269 -892 1234 -877 1204 Q -870 1195 -838 1195 L -805 1199 M -609 1988 Q -585 1986 -574 1976 L -556 1965 Q -545 1965 -504 1976 L -424 1988 -388 1987 Q -366 1983 -363 1970 L -447 1965 Q -498 1952 -496 1923 -494 1900 -509 1891 -518 1884 -540 1879 L -574 1870 Q -588 1860 -588 1839 L -542 1800 Q -496 1760 -496 1732 -496 1725 -502 1713 L -509 1691 Q -509 1681 -489 1661 -538 1682 -542 1715 L -546 1732 Q -552 1740 -571 1740 -592 1740 -613 1721 -633 1703 -643 1703 L -668 1707 -690 1710 -697 1709 -732 1723 -782 1732 -836 1712 -882 1689 -877 1743 Q -872 1760 -872 1780 -872 1804 -857 1816 -844 1829 -817 1830 L -807 1870 -787 1911 Q -751 1958 -678 1983 L -629 1994 Q -609 1995 -609 1988 M -316 1945 L -300 1946 -277 1943 Q -274 1941 -274 1930 L -276 1918 -277 1916 -277 1914 -299 1929 Q -315 1940 -332 1936 L -316 1945 M -454 2402 L -452 2401 -445 2404 -454 2404 -454 2402";
        ctx.fillStyle = tocolor(ctrans.apply([236, 143, 40, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
        var pathData =
            "M -90 1188 L -114 1238 -137 1273 Q -147 1290 -147 1302 -147 1339 -120 1358 -102 1370 -60 1383 -16 1395 0 1406 28 1424 28 1458 28 1481 13 1509 -1 1536 -13 1542 -11 1526 -38 1498 -71 1466 -113 1466 L -138 1472 -168 1478 Q -192 1478 -233 1458 -274 1438 -295 1438 -333 1438 -364 1454 -398 1471 -384 1494 L -391 1511 Q -395 1522 -407 1531 L -421 1549 -438 1568 Q -473 1585 -487 1596 L -523 1624 Q -538 1633 -555 1663 -571 1690 -595 1700 L -602 1691 -606 1682 Q -606 1658 -594 1628 -581 1596 -565 1587 L -513 1557 Q -486 1534 -486 1504 -486 1490 -502 1481 -520 1471 -523 1452 L -531 1422 -547 1394 Q -565 1371 -618 1337 -675 1301 -701 1301 L -735 1309 -773 1316 -815 1318 Q -852 1323 -855 1336 L -859 1336 -860 1325 -862 1314 Q -862 1306 -835 1253 L -805 1199 -720 1199 -586 1188 -458 1176 -258 1181 -90 1188 M -609 1988 Q -609 1995 -629 1994 L -678 1983 Q -751 1958 -787 1911 L -807 1870 -817 1830 Q -844 1829 -857 1816 -872 1804 -872 1780 -872 1760 -877 1743 L -882 1689 -836 1712 -782 1732 -732 1723 -697 1709 -690 1710 -668 1707 -643 1703 Q -633 1703 -613 1721 -592 1740 -571 1740 -552 1740 -546 1732 L -542 1715 Q -538 1682 -489 1661 -509 1681 -509 1691 L -502 1713 Q -496 1725 -496 1732 -496 1760 -542 1800 L -588 1839 Q -588 1860 -574 1870 L -540 1879 Q -518 1884 -509 1891 -494 1900 -496 1923 -498 1952 -447 1965 L -363 1970 Q -366 1983 -388 1987 L -424 1988 -504 1976 Q -545 1965 -556 1965 L -574 1976 Q -585 1986 -609 1988 L -609 1985 -614 1988 -609 1988 M -316 1945 L -332 1936 Q -315 1940 -299 1929 L -277 1914 -277 1916 -276 1918 -274 1930 Q -274 1941 -277 1943 L -300 1946 -316 1945";
        ctx.fillStyle = tocolor(ctrans.apply([255, 255, 149, 1]));
        drawPath(ctx, pathData, false);
        ctx.fill("evenodd");
    }

    function sprite196(ctx, ctrans, frame, ratio, time) {
        ctx.save();
        ctx.transform(1, 0, 0, 1, 325.2, 972.0);
        var clips = [];
        var frame_cnt = 121;
        frame = frame % frame_cnt;
        switch (frame) {
            case 0:
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (0 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape175", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape177", canvas, ctx, [0.020473480224609375, 0.0, 0.0, 0.0204620361328125, -399.85, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 1:
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (1 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape183", canvas, ctx, [0.020477294921875, 0.0, 0.0, 0.0204833984375, -98.35, -121.45], ctrans,
                    1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape184", canvas, ctx, [0.049999237060546875, 0.0, 0.0, 0.05, -177.7, -103.85], ctrans, 1, 0, 0,
                    time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 2:
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (2 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape185", canvas, ctx, [0.020470428466796874, 0.0, 0.0, 0.02047271728515625, -98.25, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape186", canvas, ctx, [0.020484161376953126, 0.0, 0.0, 0.0204620361328125, -400.0, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 3:
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (3 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape187", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape188", canvas, ctx, [0.0204833984375, 0.0, 0.0, 0.020491790771484376, -399.95, -121.45],
                    ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 4:
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (4 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape177", canvas, ctx, [0.020473480224609375, 0.0, 0.0, 0.0204620361328125, -98.3, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape189", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 5:
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (5 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape184", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape183", canvas, ctx, [0.020477294921875, 0.0, 0.0, 0.0204833984375, -399.9, -121.45], ctrans,
                    1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 6:
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (6 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape186", canvas, ctx, [0.020484161376953126, 0.0, 0.0, 0.0204620361328125, -98.45, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape185", canvas, ctx, [0.020470428466796874, 0.0, 0.0, 0.02047271728515625, -399.8, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 7:
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (7 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape190", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape191", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 8:
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (8 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape175", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape177", canvas, ctx, [0.020473480224609375, 0.0, 0.0, 0.0204620361328125, -399.85, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 9:
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (9 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape183", canvas, ctx, [0.020477294921875, 0.0, 0.0, 0.0204833984375, -98.35, -121.45], ctrans,
                    1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape184", canvas, ctx, [0.049999237060546875, 0.0, 0.0, 0.05, -177.7, -103.85], ctrans, 1, 0, 0,
                    time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 10:
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (10 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape185", canvas, ctx, [0.020470428466796874, 0.0, 0.0, 0.02047271728515625, -98.25, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape186", canvas, ctx, [0.020484161376953126, 0.0, 0.0, 0.0204620361328125, -400.0, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 11:
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (11 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape187", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape188", canvas, ctx, [0.0204833984375, 0.0, 0.0, 0.020491790771484376, -399.95, -121.45],
                    ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 12:
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (12 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape177", canvas, ctx, [0.020473480224609375, 0.0, 0.0, 0.0204620361328125, -98.3, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape189", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 13:
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (13 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape184", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape183", canvas, ctx, [0.020477294921875, 0.0, 0.0, 0.0204833984375, -399.9, -121.45], ctrans,
                    1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 14:
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (14 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape186", canvas, ctx, [0.020484161376953126, 0.0, 0.0, 0.0204620361328125, -98.45, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape185", canvas, ctx, [0.020470428466796874, 0.0, 0.0, 0.02047271728515625, -399.8, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 15:
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (15 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape190", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape191", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 16:
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (16 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape175", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape177", canvas, ctx, [0.020473480224609375, 0.0, 0.0, 0.0204620361328125, -399.85, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 17:
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (17 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape183", canvas, ctx, [0.020477294921875, 0.0, 0.0, 0.0204833984375, -98.35, -121.45], ctrans,
                    1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape184", canvas, ctx, [0.049999237060546875, 0.0, 0.0, 0.05, -177.7, -103.85], ctrans, 1, 0, 0,
                    time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 18:
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (18 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape185", canvas, ctx, [0.020470428466796874, 0.0, 0.0, 0.02047271728515625, -98.25, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape186", canvas, ctx, [0.020484161376953126, 0.0, 0.0, 0.0204620361328125, -400.0, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 19:
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (19 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape187", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape188", canvas, ctx, [0.0204833984375, 0.0, 0.0, 0.020491790771484376, -399.95, -121.45],
                    ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 20:
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (20 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape177", canvas, ctx, [0.020473480224609375, 0.0, 0.0, 0.0204620361328125, -98.3, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape189", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 21:
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (21 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape184", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape183", canvas, ctx, [0.020477294921875, 0.0, 0.0, 0.0204833984375, -399.9, -121.45], ctrans,
                    1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 22:
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (22 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape186", canvas, ctx, [0.020484161376953126, 0.0, 0.0, 0.0204620361328125, -98.45, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape185", canvas, ctx, [0.020470428466796874, 0.0, 0.0, 0.02047271728515625, -399.8, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 23:
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (23 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape190", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape191", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 24:
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (24 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape175", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape177", canvas, ctx, [0.020473480224609375, 0.0, 0.0, 0.0204620361328125, -399.85, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 25:
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (25 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape183", canvas, ctx, [0.020477294921875, 0.0, 0.0, 0.0204833984375, -98.35, -121.45], ctrans,
                    1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape184", canvas, ctx, [0.049999237060546875, 0.0, 0.0, 0.05, -177.7, -103.85], ctrans, 1, 0, 0,
                    time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 26:
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (26 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape185", canvas, ctx, [0.020470428466796874, 0.0, 0.0, 0.02047271728515625, -98.25, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape186", canvas, ctx, [0.020484161376953126, 0.0, 0.0, 0.0204620361328125, -400.0, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 27:
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (27 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape187", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape188", canvas, ctx, [0.0204833984375, 0.0, 0.0, 0.020491790771484376, -399.95, -121.45],
                    ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 28:
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (28 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape177", canvas, ctx, [0.020473480224609375, 0.0, 0.0, 0.0204620361328125, -98.3, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape189", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 29:
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (29 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape184", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape183", canvas, ctx, [0.020477294921875, 0.0, 0.0, 0.0204833984375, -399.9, -121.45], ctrans,
                    1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 30:
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (0 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape186", canvas, ctx, [0.020484161376953126, 0.0, 0.0, 0.0204620361328125, -98.45, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape185", canvas, ctx, [0.020470428466796874, 0.0, 0.0, 0.02047271728515625, -399.8, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 31:
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (1 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape190", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape191", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 32:
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (2 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape175", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape177", canvas, ctx, [0.020473480224609375, 0.0, 0.0, 0.0204620361328125, -399.85, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 33:
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (3 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape183", canvas, ctx, [0.020477294921875, 0.0, 0.0, 0.0204833984375, -98.35, -121.45], ctrans,
                    1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape184", canvas, ctx, [0.049999237060546875, 0.0, 0.0, 0.05, -177.7, -103.85], ctrans, 1, 0, 0,
                    time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 34:
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (4 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape185", canvas, ctx, [0.020470428466796874, 0.0, 0.0, 0.02047271728515625, -98.25, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape186", canvas, ctx, [0.020484161376953126, 0.0, 0.0, 0.0204620361328125, -400.0, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 35:
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (5 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape187", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape188", canvas, ctx, [0.0204833984375, 0.0, 0.0, 0.020491790771484376, -399.95, -121.45],
                    ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 36:
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (6 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape177", canvas, ctx, [0.020473480224609375, 0.0, 0.0, 0.0204620361328125, -98.3, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape189", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 37:
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (7 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape184", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape183", canvas, ctx, [0.020477294921875, 0.0, 0.0, 0.0204833984375, -399.9, -121.45], ctrans,
                    1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 38:
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (8 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape186", canvas, ctx, [0.020484161376953126, 0.0, 0.0, 0.0204620361328125, -98.45, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape185", canvas, ctx, [0.020470428466796874, 0.0, 0.0, 0.02047271728515625, -399.8, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 39:
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (9 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape190", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape191", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 40:
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (10 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape175", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape177", canvas, ctx, [0.020473480224609375, 0.0, 0.0, 0.0204620361328125, -399.85, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 41:
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (11 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape183", canvas, ctx, [0.020477294921875, 0.0, 0.0, 0.0204833984375, -98.35, -121.45], ctrans,
                    1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape184", canvas, ctx, [0.049999237060546875, 0.0, 0.0, 0.05, -177.7, -103.85], ctrans, 1, 0, 0,
                    time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 42:
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (12 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape185", canvas, ctx, [0.020470428466796874, 0.0, 0.0, 0.02047271728515625, -98.25, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape186", canvas, ctx, [0.020484161376953126, 0.0, 0.0, 0.0204620361328125, -400.0, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 43:
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (13 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape187", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape188", canvas, ctx, [0.0204833984375, 0.0, 0.0, 0.020491790771484376, -399.95, -121.45],
                    ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 44:
                place("sprite193", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 14.75, -194.75], ctrans, 1, (0 + time) % 1, 44,
                    time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (14 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape177", canvas, ctx, [0.020473480224609375, 0.0, 0.0, 0.0204620361328125, -98.3, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape189", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 45:
                place("sprite193", canvas, ctx, [0.04902496337890625, 0.0, 0.0, 0.0525665283203125, 14.4, -228.55],
                    ctrans, 1, (0 + time) % 1, 44, time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (15 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape184", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape183", canvas, ctx, [0.020477294921875, 0.0, 0.0, 0.0204833984375, -399.9, -121.45], ctrans,
                    1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 46:
                place("sprite193", canvas, ctx, [0.0480499267578125, 0.0, 0.0, 0.055133056640625, 14.05, -262.3],
                    ctrans, 1, (0 + time) % 1, 44, time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (16 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape186", canvas, ctx, [0.020484161376953126, 0.0, 0.0, 0.0204620361328125, -98.45, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape185", canvas, ctx, [0.020470428466796874, 0.0, 0.0, 0.02047271728515625, -399.8, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 47:
                place("sprite193", canvas, ctx, [0.04902496337890625, 0.0, 0.0, 0.0525665283203125, 14.45, -257.95],
                    ctrans, 1, (0 + time) % 1, 44, time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (17 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape190", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape191", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 48:
                place("sprite193", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 14.75, -253.7], ctrans, 1, (0 + time) % 1, 44,
                    time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (18 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape175", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape177", canvas, ctx, [0.020473480224609375, 0.0, 0.0, 0.0204620361328125, -399.85, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 49:
                place("sprite193", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 14.75, -253.7], ctrans, 1, (0 + time) % 1, 44,
                    time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (19 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape183", canvas, ctx, [0.020477294921875, 0.0, 0.0, 0.0204833984375, -98.35, -121.45], ctrans,
                    1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape184", canvas, ctx, [0.049999237060546875, 0.0, 0.0, 0.05, -177.7, -103.85], ctrans, 1, 0, 0,
                    time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 50:
                place("sprite193", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 14.75, -253.7], ctrans, 1, (0 + time) % 1, 44,
                    time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (20 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape185", canvas, ctx, [0.020470428466796874, 0.0, 0.0, 0.02047271728515625, -98.25, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape186", canvas, ctx, [0.020484161376953126, 0.0, 0.0, 0.0204620361328125, -400.0, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 51:
                place("sprite193", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 14.75, -253.7], ctrans, 1, (0 + time) % 1, 44,
                    time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (21 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape187", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape188", canvas, ctx, [0.0204833984375, 0.0, 0.0, 0.020491790771484376, -399.95, -121.45],
                    ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 52:
                place("sprite193", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 14.75, -253.7], ctrans, 1, (0 + time) % 1, 44,
                    time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (22 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape177", canvas, ctx, [0.020473480224609375, 0.0, 0.0, 0.0204620361328125, -98.3, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape189", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 53:
                place("sprite193", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 14.75, -253.7], ctrans, 1, (0 + time) % 1, 44,
                    time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (23 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape184", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape183", canvas, ctx, [0.020477294921875, 0.0, 0.0, 0.0204833984375, -399.9, -121.45], ctrans,
                    1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 54:
                place("sprite193", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 14.75, -253.7], ctrans, 1, (0 + time) % 1, 44,
                    time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (24 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape186", canvas, ctx, [0.020484161376953126, 0.0, 0.0, 0.0204620361328125, -98.45, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape185", canvas, ctx, [0.020470428466796874, 0.0, 0.0, 0.02047271728515625, -399.8, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 55:
                place("sprite193", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 14.75, -253.7], ctrans, 1, (0 + time) % 1, 44,
                    time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (25 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape190", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape191", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 56:
                place("sprite193", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 14.75, -253.7], ctrans, 1, (0 + time) % 1, 44,
                    time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (26 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape175", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape177", canvas, ctx, [0.020473480224609375, 0.0, 0.0, 0.0204620361328125, -399.85, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 57:
                place("sprite193", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 14.75, -253.7], ctrans, 1, (0 + time) % 1, 44,
                    time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (27 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape183", canvas, ctx, [0.020477294921875, 0.0, 0.0, 0.0204833984375, -98.35, -121.45], ctrans,
                    1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape184", canvas, ctx, [0.049999237060546875, 0.0, 0.0, 0.05, -177.7, -103.85], ctrans, 1, 0, 0,
                    time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 58:
                place("sprite193", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 14.75, -253.7], ctrans, 1, (0 + time) % 1, 44,
                    time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (28 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape185", canvas, ctx, [0.020470428466796874, 0.0, 0.0, 0.02047271728515625, -98.25, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape186", canvas, ctx, [0.020484161376953126, 0.0, 0.0, 0.0204620361328125, -400.0, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 59:
                place("sprite193", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 14.75, -253.7], ctrans, 1, (0 + time) % 1, 44,
                    time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (29 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape187", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape188", canvas, ctx, [0.0204833984375, 0.0, 0.0, 0.020491790771484376, -399.95, -121.45],
                    ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 60:
                place("sprite193", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 14.75, -253.7], ctrans, 1, (0 + time) % 1, 44,
                    time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (0 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape177", canvas, ctx, [0.020473480224609375, 0.0, 0.0, 0.0204620361328125, -98.3, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape189", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 61:
                place("sprite193", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 14.75, -253.7], ctrans, 1, (0 + time) % 1, 44,
                    time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (1 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape184", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape183", canvas, ctx, [0.020477294921875, 0.0, 0.0, 0.0204833984375, -399.9, -121.45], ctrans,
                    1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 62:
                place("sprite193", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 14.75, -253.7], ctrans, 1, (0 + time) % 1, 44,
                    time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (2 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape186", canvas, ctx, [0.020484161376953126, 0.0, 0.0, 0.0204620361328125, -98.45, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape185", canvas, ctx, [0.020470428466796874, 0.0, 0.0, 0.02047271728515625, -399.8, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 63:
                place("sprite193", canvas, ctx, [0.06491622924804688, 0.0, 0.0, 0.03770599365234375, 20.2, -236.15],
                    ctrans, 1, (0 + time) % 1, 44, time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.049756622314453124, -3.0, -108.6], ctrans, 1, 0, 0,
                    time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.049756622314453124, -8.55, -103.4], ctrans, 1, (3 +
                    time) % 30, 0, time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.049756622314453124, 51.4, 63.3], ctrans, 1, 0, 0,
                    time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.049756622314453124, 59.7, -2.05], ctrans, 1, 0, 0,
                    time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.049756622314453124, -59.25, 63.3], ctrans, 1, 0, 0,
                    time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.049756622314453124, -66.9, -2.05], ctrans, 1, 0, 0,
                    time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.049756622314453124, -3.0, -91.15], ctrans, 1, 0, 0,
                    time);
                place("shape190", canvas, ctx, [0.05, 0.0, 0.0, 0.049756622314453124, 123.85, -102.75], ctrans, 1, 0, 0,
                    time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.049756622314453124, 123.85, -102.75], ctrans, 1, 0, 0,
                    time);
                place("shape191", canvas, ctx, [0.05, 0.0, 0.0, 0.049756622314453124, -130.7, -102.75], ctrans, 1, 0, 0,
                    time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.049756622314453124, -130.7, -102.75], ctrans, 1, 0, 0,
                    time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.049756622314453124, 231.45, 48.4], ctrans, 1, 0, 0,
                    time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.049756622314453124, 265.75, -50.8], ctrans, 1, 0, 0,
                    time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.049756622314453124, 178.7, -147.6], ctrans, 1, 0, 0,
                    time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.049756622314453124, -238.8, 48.4], ctrans, 1, 0, 0,
                    time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.049756622314453124, -273.1, -50.8], ctrans, 1, 0, 0,
                    time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.049756622314453124, -186.05, -147.6], ctrans, 1, 0, 0,
                    time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.049756622314453124, -14.8, -136.3], ctrans, 1, 0, 0,
                    time);
                break;
            case 64:
                place("sprite193", canvas, ctx, [0.07386627197265624, 0.0, 0.0, 0.030329132080078126, 23.45, -225.65],
                    ctrans, 1, (0 + time) % 1, 44, time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.04951400756835937, -3.0, -107.45], ctrans, 1, 0, 0,
                    time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.04951400756835937, -8.55, -102.3], ctrans, 1, (4 +
                    time) % 30, 0, time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.04951400756835937, 51.4, 63.6], ctrans, 1, 0, 0,
                    time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.04951400756835937, 59.7, -1.45], ctrans, 1, 0, 0,
                    time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.04951400756835937, -59.25, 63.6], ctrans, 1, 0, 0,
                    time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.04951400756835937, -66.9, -1.45], ctrans, 1, 0, 0,
                    time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.04951400756835937, -3.0, -90.05], ctrans, 1, 0, 0,
                    time);
                place("shape175", canvas, ctx, [0.05, 0.0, 0.0, 0.04951400756835937, 123.85, -101.6], ctrans, 1, 0, 0,
                    time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.04951400756835937, 123.85, -101.6], ctrans, 1, 0, 0,
                    time);
                place("shape177", canvas, ctx, [0.020473480224609375, 0.0, 0.0, 0.020262908935546876, -399.85, -118.95],
                    ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.04951400756835937, -130.7, -101.6], ctrans, 1, 0, 0,
                    time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.04951400756835937, 231.45, 48.8], ctrans, 1, 0, 0,
                    time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.04951400756835937, 265.75, -49.9], ctrans, 1, 0, 0,
                    time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.04951400756835937, 178.7, -146.25], ctrans, 1, 0, 0,
                    time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.04951400756835937, -238.8, 48.8], ctrans, 1, 0, 0,
                    time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.04951400756835937, -273.1, -49.9], ctrans, 1, 0, 0,
                    time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.04951400756835937, -186.05, -146.25], ctrans, 1, 0, 0,
                    time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.04951400756835937, -14.8, -135.0], ctrans, 1, 0, 0,
                    time);
                break;
            case 65:
                place("sprite193", canvas, ctx, [0.076849365234375, 0.0, 0.0, 0.02787017822265625, 24.55, -222.1],
                    ctrans, 1, (0 + time) % 1, 44, time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.0492706298828125, -3.0, -106.3], ctrans, 1, 0, 0,
                    time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.0492706298828125, -8.55, -101.15], ctrans, 1, (5 +
                    time) % 30, 0, time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.0492706298828125, 51.4, 63.95], ctrans, 1, 0, 0,
                    time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.0492706298828125, 59.7, -0.8], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.0492706298828125, -59.25, 63.95], ctrans, 1, 0, 0,
                    time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.0492706298828125, -66.9, -0.8], ctrans, 1, 0, 0,
                time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.0492706298828125, -3.0, -89.0], ctrans, 1, 0, 0,
                time);
                place("shape183", canvas, ctx, [0.020477294921875, 0.0, 0.0, 0.020184326171875, -98.35, -117.85],
                    ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.0492706298828125, 123.85, -100.5], ctrans, 1, 0, 0,
                    time);
                place("shape184", canvas, ctx, [0.049999237060546875, 0.0, 0.0, 0.04927139282226563, -177.7, -100.5],
                    ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.0492706298828125, -130.7, -100.5], ctrans, 1, 0, 0,
                    time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.0492706298828125, 231.45, 49.15], ctrans, 1, 0, 0,
                    time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.0492706298828125, 265.75, -49.05], ctrans, 1, 0, 0,
                    time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.0492706298828125, 178.7, -144.95], ctrans, 1, 0, 0,
                    time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.0492706298828125, -238.8, 49.15], ctrans, 1, 0, 0,
                    time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.0492706298828125, -273.1, -49.05], ctrans, 1, 0, 0,
                    time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.0492706298828125, -186.05, -144.95], ctrans, 1, 0, 0,
                    time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.0492706298828125, -14.8, -133.75], ctrans, 1, 0, 0,
                    time);
                break;
            case 66:
                place("sprite193", canvas, ctx, [0.076849365234375, 0.0, 0.0, 0.02753143310546875, 24.6, -216.85],
                    ctrans, 1, (0 + time) % 1, 44, time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.04902801513671875, -3.0, -105.15], ctrans, 1, 0, 0,
                    time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.04902801513671875, -8.55, -100.05], ctrans, 1, (6 +
                    time) % 30, 0, time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.04902801513671875, 51.4, 64.25], ctrans, 1, 0, 0,
                    time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.04902801513671875, 59.7, -0.2], ctrans, 1, 0, 0,
                time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.04902801513671875, -59.25, 64.25], ctrans, 1, 0, 0,
                    time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.04902801513671875, -66.9, -0.2], ctrans, 1, 0, 0,
                    time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.04902801513671875, -3.0, -87.9], ctrans, 1, 0, 0,
                    time);
                place("shape185", canvas, ctx, [0.020470428466796874, 0.0, 0.0, 0.020074462890625, -98.25, -116.5],
                    ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.04902801513671875, 123.85, -99.35], ctrans, 1, 0, 0,
                    time);
                place("shape186", canvas, ctx, [0.020484161376953126, 0.0, 0.0, 0.020064544677734376, -400.0, -116.5],
                    ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.04902801513671875, -130.7, -99.35], ctrans, 1, 0, 0,
                    time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.04902801513671875, 231.45, 49.55], ctrans, 1, 0, 0,
                    time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.04902801513671875, 265.75, -48.15], ctrans, 1, 0, 0,
                    time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.04902801513671875, 178.7, -143.6], ctrans, 1, 0, 0,
                    time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.04902801513671875, -238.8, 49.55], ctrans, 1, 0, 0,
                    time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.04902801513671875, -273.1, -48.15], ctrans, 1, 0, 0,
                    time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.04902801513671875, -186.05, -143.6], ctrans, 1, 0, 0,
                    time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.04902801513671875, -14.8, -132.45], ctrans, 1, 0, 0,
                    time);
                break;
            case 67:
                place("sprite195", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -17.45, -207.75], ctrans, 1, (0 + time) % 1, 67,
                    time);
                place("sprite193", canvas, ctx, [0.076849365234375, 0.0, 0.0, 0.02719268798828125, 24.55, -211.7],
                    ctrans, 1, (0 + time) % 1, 44, time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.048784637451171876, -3.0, -104.0], ctrans, 1, 0, 0,
                    time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.048784637451171876, -8.55, -98.9], ctrans, 1, (7 +
                    time) % 30, 0, time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.048784637451171876, 51.4, 64.55], ctrans, 1, 0, 0,
                    time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.048784637451171876, 59.7, 0.45], ctrans, 1, 0, 0,
                    time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.048784637451171876, -59.25, 64.55], ctrans, 1, 0, 0,
                    time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.048784637451171876, -66.9, 0.45], ctrans, 1, 0, 0,
                    time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.048784637451171876, -3.0, -86.85], ctrans, 1, 0, 0,
                    time);
                place("shape187", canvas, ctx, [0.05, 0.0, 0.0, 0.048784637451171876, 123.85, -98.25], ctrans, 1, 0, 0,
                    time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.048784637451171876, 123.85, -98.25], ctrans, 1, 0, 0,
                    time);
                place("shape188", canvas, ctx, [0.0204833984375, 0.0, 0.0, 0.01999359130859375, -399.95, -115.4],
                    ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.048784637451171876, -130.7, -98.25], ctrans, 1, 0, 0,
                    time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.048784637451171876, 231.45, 49.95], ctrans, 1, 0, 0,
                    time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.048784637451171876, 265.75, -47.3], ctrans, 1, 0, 0,
                    time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.048784637451171876, 178.7, -142.25], ctrans, 1, 0, 0,
                    time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.048784637451171876, -238.8, 49.95], ctrans, 1, 0, 0,
                    time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.048784637451171876, -273.1, -47.3], ctrans, 1, 0, 0,
                    time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.048784637451171876, -186.05, -142.25], ctrans, 1, 0,
                    0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.048784637451171876, -14.8, -131.15], ctrans, 1, 0, 0,
                    time);
                break;
            case 68:
                place("sprite195", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -13.9, -398.8], ctrans, 1, (0 + time) % 1, 67,
                    time);
                place("sprite193", canvas, ctx, [0.04805755615234375, 0.0, 0.0, 0.11318588256835938, 14.0, -310.8],
                    ctrans, 1, (0 + time) % 1, 44, time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.0509765625, -3.0, -114.4], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.0509765625, -8.55, -109.1], ctrans, 1, (8 + time) %
                    30, 0, time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.0509765625, 51.4, 61.75], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.0509765625, 59.7, -5.25], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.0509765625, -59.25, 61.75], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.0509765625, -66.9, -5.25], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.0509765625, -3.0, -96.5], ctrans, 1, 0, 0, time);
                place("shape177", canvas, ctx, [0.020473480224609375, 0.0, 0.0, 0.02086181640625, -98.3, -126.25],
                    ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.0509765625, 123.85, -108.4], ctrans, 1, 0, 0, time);
                place("shape189", canvas, ctx, [0.05, 0.0, 0.0, 0.0509765625, -130.7, -108.4], ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.0509765625, -130.7, -108.4], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.0509765625, 231.45, 46.45], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.0509765625, 265.75, -55.15], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.0509765625, 178.7, -154.35], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.0509765625, -238.8, 46.45], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.0509765625, -273.1, -55.15], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.0509765625, -186.05, -154.35], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.0509765625, -14.8, -142.8], ctrans, 1, 0, 0, time);
                break;
            case 69:
                place("sprite195", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -10.4, -589.85], ctrans, 1, (0 + time) % 1, 67,
                    time);
                place("sprite193", canvas, ctx, [0.051910400390625, 0.0, 0.0, 0.09126052856445313, 15.4, -290.05],
                    ctrans, 1, (0 + time) % 1, 44, time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05065155029296875, -3.0, -112.85], ctrans, 1, 0, 0,
                    time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05065155029296875, -8.55, -107.6], ctrans, 1, (9 +
                    time) % 30, 0, time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05065155029296875, 51.4, 62.15], ctrans, 1, 0, 0,
                    time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05065155029296875, 59.7, -4.4], ctrans, 1, 0, 0,
                time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05065155029296875, -59.25, 62.15], ctrans, 1, 0, 0,
                    time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05065155029296875, -66.9, -4.4], ctrans, 1, 0, 0,
                    time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05065155029296875, -3.0, -95.05], ctrans, 1, 0, 0,
                    time);
                place("shape184", canvas, ctx, [0.05, 0.0, 0.0, 0.05065155029296875, 123.85, -106.9], ctrans, 1, 0, 0,
                    time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05065155029296875, 123.85, -106.9], ctrans, 1, 0, 0,
                    time);
                place("shape183", canvas, ctx, [0.020477294921875, 0.0, 0.0, 0.02075042724609375, -399.9, -124.75],
                    ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05065155029296875, -130.7, -106.9], ctrans, 1, 0, 0,
                    time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05065155029296875, 231.45, 46.95], ctrans, 1, 0, 0,
                    time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05065155029296875, 265.75, -54.0], ctrans, 1, 0, 0,
                    time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05065155029296875, 178.7, -152.55], ctrans, 1, 0, 0,
                    time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05065155029296875, -238.8, 46.95], ctrans, 1, 0, 0,
                    time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05065155029296875, -273.1, -54.0], ctrans, 1, 0, 0,
                    time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05065155029296875, -186.05, -152.55], ctrans, 1, 0, 0,
                    time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05065155029296875, -14.8, -141.1], ctrans, 1, 0, 0,
                    time);
                break;
            case 70:
                place("sprite195", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -6.85, -780.95], ctrans, 1, (0 + time) % 1, 67,
                    time);
                place("sprite193", canvas, ctx, [0.05576248168945312, 0.0, 0.0, 0.06933517456054687, 16.9, -269.2],
                    ctrans, 1, (0 + time) % 1, 44, time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.0503265380859375, -3.0, -111.3], ctrans, 1, 0, 0,
                    time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.0503265380859375, -8.55, -106.05], ctrans, 1, (10 +
                    time) % 30, 0, time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.0503265380859375, 51.4, 62.6], ctrans, 1, 0, 0,
                time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.0503265380859375, 59.7, -3.55], ctrans, 1, 0, 0,
                time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.0503265380859375, -59.25, 62.6], ctrans, 1, 0, 0,
                    time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.0503265380859375, -66.9, -3.55], ctrans, 1, 0, 0,
                    time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.0503265380859375, -3.0, -93.65], ctrans, 1, 0, 0,
                    time);
                place("shape186", canvas, ctx, [0.020484161376953126, 0.0, 0.0, 0.020595550537109375, -98.45, -122.95],
                    ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.0503265380859375, 123.85, -105.35], ctrans, 1, 0, 0,
                    time);
                place("shape185", canvas, ctx, [0.020470428466796874, 0.0, 0.0, 0.020606231689453126, -399.8, -122.95],
                    ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.0503265380859375, -130.7, -105.35], ctrans, 1, 0, 0,
                    time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.0503265380859375, 231.45, 47.5], ctrans, 1, 0, 0,
                    time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.0503265380859375, 265.75, -52.8], ctrans, 1, 0, 0,
                    time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.0503265380859375, 178.7, -150.75], ctrans, 1, 0, 0,
                    time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.0503265380859375, -238.8, 47.5], ctrans, 1, 0, 0,
                    time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.0503265380859375, -273.1, -52.8], ctrans, 1, 0, 0,
                    time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.0503265380859375, -186.05, -150.75], ctrans, 1, 0, 0,
                    time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.0503265380859375, -14.8, -139.4], ctrans, 1, 0, 0,
                    time);
                break;
            case 71:
                place("sprite195", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.35, -972.0], ctrans, 1, (0 + time) % 1, 67,
                    time);
                place("sprite193", canvas, ctx, [0.05961532592773437, 0.0, 0.0, 0.04740753173828125, 18.25, -248.4],
                    ctrans, 1, (0 + time) % 1, 44, time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (11 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape190", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape191", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 72:
                place("sprite193", canvas, ctx, [0.05240478515625, 0.0, 0.0, 0.04935302734375, 15.65, -252.35], ctrans,
                    1, (0 + time) % 1, 44, time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (12 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape175", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape177", canvas, ctx, [0.020473480224609375, 0.0, 0.0, 0.0204620361328125, -399.85, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 73:
                place("sprite193", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 14.75, -253.7], ctrans, 1, (0 + time) % 1, 44,
                    time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (13 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape183", canvas, ctx, [0.020477294921875, 0.0, 0.0, 0.0204833984375, -98.35, -121.45], ctrans,
                    1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape184", canvas, ctx, [0.049999237060546875, 0.0, 0.0, 0.05, -177.7, -103.85], ctrans, 1, 0, 0,
                    time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 74:
                place("sprite193", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 14.75, -253.7], ctrans, 1, (0 + time) % 1, 44,
                    time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (14 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape185", canvas, ctx, [0.020470428466796874, 0.0, 0.0, 0.02047271728515625, -98.25, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape186", canvas, ctx, [0.020484161376953126, 0.0, 0.0, 0.0204620361328125, -400.0, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 75:
                place("sprite193", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 14.75, -253.7], ctrans, 1, (0 + time) % 1, 44,
                    time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (15 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape187", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape188", canvas, ctx, [0.0204833984375, 0.0, 0.0, 0.020491790771484376, -399.95, -121.45],
                    ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 76:
                place("sprite193", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 14.75, -253.7], ctrans, 1, (0 + time) % 1, 44,
                    time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (16 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape177", canvas, ctx, [0.020473480224609375, 0.0, 0.0, 0.0204620361328125, -98.3, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape189", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 77:
                place("sprite193", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 14.75, -253.7], ctrans, 1, (0 + time) % 1, 44,
                    time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (17 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape184", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape183", canvas, ctx, [0.020477294921875, 0.0, 0.0, 0.0204833984375, -399.9, -121.45], ctrans,
                    1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 78:
                place("sprite193", canvas, ctx, [0.06491622924804688, 0.0, 0.0, 0.03770599365234375, 20.2, -236.15],
                    ctrans, 1, (0 + time) % 1, 44, time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.049839019775390625, -3.0, -109.0], ctrans, 1, 0, 0,
                    time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.049839019775390625, -8.55, -103.8], ctrans, 1, (18 +
                    time) % 30, 0, time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.049839019775390625, 51.4, 63.2], ctrans, 1, 0, 0,
                    time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.049839019775390625, 59.7, -2.3], ctrans, 1, 0, 0,
                    time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.049839019775390625, -59.25, 63.2], ctrans, 1, 0, 0,
                    time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.049839019775390625, -66.9, -2.3], ctrans, 1, 0, 0,
                    time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.049839019775390625, -3.0, -91.5], ctrans, 1, 0, 0,
                    time);
                place("shape186", canvas, ctx, [0.020484161376953126, 0.0, 0.0, 0.02039642333984375, -98.45, -120.55],
                    ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.049839019775390625, 123.85, -103.1], ctrans, 1, 0, 0,
                    time);
                place("shape185", canvas, ctx, [0.020470428466796874, 0.0, 0.0, 0.0204071044921875, -399.8, -120.55],
                    ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.049839019775390625, -130.7, -103.1], ctrans, 1, 0, 0,
                    time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.049839019775390625, 231.45, 48.25], ctrans, 1, 0, 0,
                    time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.049839019775390625, 265.75, -51.05], ctrans, 1, 0, 0,
                    time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.049839019775390625, 178.7, -148.05], ctrans, 1, 0, 0,
                    time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.049839019775390625, -238.8, 48.25], ctrans, 1, 0, 0,
                    time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.049839019775390625, -273.1, -51.05], ctrans, 1, 0, 0,
                    time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.049839019775390625, -186.05, -148.05], ctrans, 1, 0,
                    0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.049839019775390625, -14.8, -136.75], ctrans, 1, 0, 0,
                    time);
                break;
            case 79:
                place("sprite193", canvas, ctx, [0.07386627197265624, 0.0, 0.0, 0.030329132080078126, 23.45, -225.65],
                    ctrans, 1, (0 + time) % 1, 44, time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.049677276611328126, -3.0, -108.25], ctrans, 1, 0, 0,
                    time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.049677276611328126, -8.55, -103.05], ctrans, 1, (19 +
                    time) % 30, 0, time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.049677276611328126, 51.4, 63.4], ctrans, 1, 0, 0,
                    time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.049677276611328126, 59.7, -1.85], ctrans, 1, 0, 0,
                    time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.049677276611328126, -59.25, 63.4], ctrans, 1, 0, 0,
                    time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.049677276611328126, -66.9, -1.85], ctrans, 1, 0, 0,
                    time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.049677276611328126, -3.0, -90.8], ctrans, 1, 0, 0,
                    time);
                place("shape190", canvas, ctx, [0.05, 0.0, 0.0, 0.049677276611328126, 123.85, -102.35], ctrans, 1, 0, 0,
                    time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.049677276611328126, 123.85, -102.35], ctrans, 1, 0, 0,
                    time);
                place("shape191", canvas, ctx, [0.05, 0.0, 0.0, 0.049677276611328126, -130.7, -102.35], ctrans, 1, 0, 0,
                    time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.049677276611328126, -130.7, -102.35], ctrans, 1, 0, 0,
                    time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.049677276611328126, 231.45, 48.5], ctrans, 1, 0, 0,
                    time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.049677276611328126, 265.75, -50.5], ctrans, 1, 0, 0,
                    time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.049677276611328126, 178.7, -147.15], ctrans, 1, 0, 0,
                    time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.049677276611328126, -238.8, 48.5], ctrans, 1, 0, 0,
                    time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.049677276611328126, -273.1, -50.5], ctrans, 1, 0, 0,
                    time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.049677276611328126, -186.05, -147.15], ctrans, 1, 0,
                    0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.049677276611328126, -14.8, -135.9], ctrans, 1, 0, 0,
                    time);
                break;
            case 80:
                place("sprite193", canvas, ctx, [0.076849365234375, 0.0, 0.0, 0.02787017822265625, 24.55, -222.1],
                    ctrans, 1, (0 + time) % 1, 44, time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.04951629638671875, -3.0, -107.45], ctrans, 1, 0, 0,
                    time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.04951629638671875, -8.55, -102.3], ctrans, 1, (20 +
                    time) % 30, 0, time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.04951629638671875, 51.4, 63.65], ctrans, 1, 0, 0,
                    time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.04951629638671875, 59.7, -1.45], ctrans, 1, 0, 0,
                    time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.04951629638671875, -59.25, 63.65], ctrans, 1, 0, 0,
                    time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.04951629638671875, -66.9, -1.45], ctrans, 1, 0, 0,
                    time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.04951629638671875, -3.0, -90.05], ctrans, 1, 0, 0,
                    time);
                place("shape175", canvas, ctx, [0.05, 0.0, 0.0, 0.04951629638671875, 123.85, -101.65], ctrans, 1, 0, 0,
                    time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.04951629638671875, 123.85, -101.65], ctrans, 1, 0, 0,
                    time);
                place("shape177", canvas, ctx, [0.020473480224609375, 0.0, 0.0, 0.020264434814453124, -399.85, -119.0],
                    ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.04951629638671875, -130.7, -101.65], ctrans, 1, 0, 0,
                    time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.04951629638671875, 231.45, 48.8], ctrans, 1, 0, 0,
                    time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.04951629638671875, 265.75, -49.9], ctrans, 1, 0, 0,
                    time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.04951629638671875, 178.7, -146.3], ctrans, 1, 0, 0,
                    time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.04951629638671875, -238.8, 48.8], ctrans, 1, 0, 0,
                    time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.04951629638671875, -273.1, -49.9], ctrans, 1, 0, 0,
                    time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.04951629638671875, -186.05, -146.3], ctrans, 1, 0, 0,
                    time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.04951629638671875, -14.8, -135.05], ctrans, 1, 0, 0,
                    time);
                break;
            case 81:
                place("sprite193", canvas, ctx, [0.076849365234375, 0.0, 0.0, 0.027645111083984375, 24.6, -218.3],
                    ctrans, 1, (0 + time) % 1, 44, time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.04935455322265625, -3.0, -106.7], ctrans, 1, 0, 0,
                    time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.04935455322265625, -8.55, -101.55], ctrans, 1, (21 +
                    time) % 30, 0, time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.04935455322265625, 51.4, 63.85], ctrans, 1, 0, 0,
                    time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.04935455322265625, 59.7, -1.0], ctrans, 1, 0, 0,
                time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.04935455322265625, -59.25, 63.85], ctrans, 1, 0, 0,
                    time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.04935455322265625, -66.9, -1.0], ctrans, 1, 0, 0,
                    time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.04935455322265625, -3.0, -89.35], ctrans, 1, 0, 0,
                    time);
                place("shape183", canvas, ctx, [0.020477294921875, 0.0, 0.0, 0.020218658447265624, -98.35, -118.25],
                    ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.04935455322265625, 123.85, -100.9], ctrans, 1, 0, 0,
                    time);
                place("shape184", canvas, ctx, [0.049999237060546875, 0.0, 0.0, 0.04935531616210938, -177.7, -100.85],
                    ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.04935455322265625, -130.7, -100.9], ctrans, 1, 0, 0,
                    time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.04935455322265625, 231.45, 49.05], ctrans, 1, 0, 0,
                    time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.04935455322265625, 265.75, -49.35], ctrans, 1, 0, 0,
                    time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.04935455322265625, 178.7, -145.4], ctrans, 1, 0, 0,
                    time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.04935455322265625, -238.8, 49.05], ctrans, 1, 0, 0,
                    time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.04935455322265625, -273.1, -49.35], ctrans, 1, 0, 0,
                    time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.04935455322265625, -186.05, -145.4], ctrans, 1, 0, 0,
                    time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.04935455322265625, -14.8, -134.2], ctrans, 1, 0, 0,
                    time);
                break;
            case 82:
                place("sprite195", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -17.45, -207.75], ctrans, 1, (0 + time) % 1, 82,
                    time);
                place("sprite193", canvas, ctx, [0.076849365234375, 0.0, 0.0, 0.0274200439453125, 24.55, -214.55],
                    ctrans, 1, (0 + time) % 1, 44, time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.04919357299804687, -3.0, -105.95], ctrans, 1, 0, 0,
                    time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.04919357299804687, -8.55, -100.8], ctrans, 1, (22 +
                    time) % 30, 0, time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.04919357299804687, 51.4, 64.05], ctrans, 1, 0, 0,
                    time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.04919357299804687, 59.7, -0.6], ctrans, 1, 0, 0,
                time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.04919357299804687, -59.25, 64.05], ctrans, 1, 0, 0,
                    time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.04919357299804687, -66.9, -0.6], ctrans, 1, 0, 0,
                    time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.04919357299804687, -3.0, -88.65], ctrans, 1, 0, 0,
                    time);
                place("shape185", canvas, ctx, [0.020470428466796874, 0.0, 0.0, 0.020142364501953124, -98.25, -117.35],
                    ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.04919357299804687, 123.85, -100.15], ctrans, 1, 0, 0,
                    time);
                place("shape186", canvas, ctx, [0.020484161376953126, 0.0, 0.0, 0.020131683349609374, -400.0, -117.35],
                    ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.04919357299804687, -130.7, -100.15], ctrans, 1, 0, 0,
                    time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.04919357299804687, 231.45, 49.3], ctrans, 1, 0, 0,
                    time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.04919357299804687, 265.75, -48.75], ctrans, 1, 0, 0,
                    time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.04919357299804687, 178.7, -144.5], ctrans, 1, 0, 0,
                    time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.04919357299804687, -238.8, 49.3], ctrans, 1, 0, 0,
                    time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.04919357299804687, -273.1, -48.75], ctrans, 1, 0, 0,
                    time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.04919357299804687, -186.05, -144.5], ctrans, 1, 0, 0,
                    time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.04919357299804687, -14.8, -133.35], ctrans, 1, 0, 0,
                    time);
                break;
            case 83:
                place("sprite195", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -13.9, -398.8], ctrans, 1, (0 + time) % 1, 82,
                    time);
                place("sprite193", canvas, ctx, [0.04805755615234375, 0.0, 0.0, 0.11318588256835938, 14.0, -310.8],
                    ctrans, 1, (0 + time) % 1, 44, time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.0509765625, -3.0, -114.4], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.0509765625, -8.55, -109.1], ctrans, 1, (23 + time) %
                    30, 0, time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.0509765625, 51.4, 61.75], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.0509765625, 59.7, -5.25], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.0509765625, -59.25, 61.75], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.0509765625, -66.9, -5.25], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.0509765625, -3.0, -96.5], ctrans, 1, 0, 0, time);
                place("shape187", canvas, ctx, [0.05, 0.0, 0.0, 0.0509765625, 123.85, -108.4], ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.0509765625, 123.85, -108.4], ctrans, 1, 0, 0, time);
                place("shape188", canvas, ctx, [0.0204833984375, 0.0, 0.0, 0.020892333984375, -399.95, -126.35], ctrans,
                    1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.0509765625, -130.7, -108.4], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.0509765625, 231.45, 46.45], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.0509765625, 265.75, -55.15], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.0509765625, 178.7, -154.35], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.0509765625, -238.8, 46.45], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.0509765625, -273.1, -55.15], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.0509765625, -186.05, -154.35], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.0509765625, -14.8, -142.8], ctrans, 1, 0, 0, time);
                break;
            case 84:
                place("sprite195", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -10.4, -589.85], ctrans, 1, (0 + time) % 1, 82,
                    time);
                place("sprite193", canvas, ctx, [0.051910400390625, 0.0, 0.0, 0.09126052856445313, 15.4, -290.05],
                    ctrans, 1, (0 + time) % 1, 44, time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05078125, -3.0, -113.45], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05078125, -8.55, -108.25], ctrans, 1, (24 + time) %
                    30, 0, time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05078125, 51.4, 62.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05078125, 59.7, -4.75], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05078125, -59.25, 62.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05078125, -66.9, -4.75], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05078125, -3.0, -95.65], ctrans, 1, 0, 0, time);
                place("shape177", canvas, ctx, [0.020473480224609375, 0.0, 0.0, 0.020781707763671876, -98.3, -125.3],
                    ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05078125, 123.85, -107.55], ctrans, 1, 0, 0, time);
                place("shape189", canvas, ctx, [0.05, 0.0, 0.0, 0.05078125, -130.7, -107.55], ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05078125, -130.7, -107.55], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05078125, 231.45, 46.75], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05078125, 265.75, -54.45], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05078125, 178.7, -153.25], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05078125, -238.8, 46.75], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05078125, -273.1, -54.45], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05078125, -186.05, -153.25], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05078125, -14.8, -141.75], ctrans, 1, 0, 0, time);
                break;
            case 85:
                place("sprite195", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -6.85, -780.95], ctrans, 1, (0 + time) % 1, 82,
                    time);
                place("sprite193", canvas, ctx, [0.05576248168945312, 0.0, 0.0, 0.06933517456054687, 16.9, -269.2],
                    ctrans, 1, (0 + time) % 1, 44, time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.0505859375, -3.0, -112.55], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.0505859375, -8.55, -107.3], ctrans, 1, (25 + time) %
                    30, 0, time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.0505859375, 51.4, 62.3], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.0505859375, 59.7, -4.25], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.0505859375, -59.25, 62.3], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.0505859375, -66.9, -4.25], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.0505859375, -3.0, -94.8], ctrans, 1, 0, 0, time);
                place("shape184", canvas, ctx, [0.05, 0.0, 0.0, 0.0505859375, 123.85, -106.6], ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.0505859375, 123.85, -106.6], ctrans, 1, 0, 0, time);
                place("shape183", canvas, ctx, [0.020477294921875, 0.0, 0.0, 0.020723724365234376, -399.9, -124.4],
                    ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.0505859375, -130.7, -106.6], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.0505859375, 231.45, 47.05], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.0505859375, 265.75, -53.75], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.0505859375, 178.7, -152.2], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.0505859375, -238.8, 47.05], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.0505859375, -273.1, -53.75], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.0505859375, -186.05, -152.2], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.0505859375, -14.8, -140.7], ctrans, 1, 0, 0, time);
                break;
            case 86:
                place("sprite195", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.35, -972.0], ctrans, 1, (0 + time) % 1, 82,
                    time);
                place("sprite193", canvas, ctx, [0.05961532592773437, 0.0, 0.0, 0.04740753173828125, 18.25, -248.4],
                    ctrans, 1, (0 + time) % 1, 44, time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.050390625, -3.0, -111.6], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.050390625, -8.55, -106.35], ctrans, 1, (26 + time) %
                    30, 0, time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.050390625, 51.4, 62.55], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.050390625, 59.7, -3.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.050390625, -59.25, 62.55], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.050390625, -66.9, -3.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.050390625, -3.0, -93.9], ctrans, 1, 0, 0, time);
                place("shape186", canvas, ctx, [0.020484161376953126, 0.0, 0.0, 0.02062225341796875, -98.45, -123.3],
                    ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.050390625, 123.85, -105.65], ctrans, 1, 0, 0, time);
                place("shape185", canvas, ctx, [0.020470428466796874, 0.0, 0.0, 0.0206329345703125, -399.8, -123.3],
                    ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.050390625, -130.7, -105.65], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.050390625, 231.45, 47.4], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.050390625, 265.75, -53.05], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.050390625, 178.7, -151.1], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.050390625, -238.8, 47.4], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.050390625, -273.1, -53.05], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.050390625, -186.05, -151.1], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.050390625, -14.8, -139.7], ctrans, 1, 0, 0, time);
                break;
            case 87:
                place("sprite193", canvas, ctx, [0.05240478515625, 0.0, 0.0, 0.04935302734375, 15.65, -252.35], ctrans,
                    1, (0 + time) % 1, 44, time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.0501953125, -3.0, -110.7], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.0501953125, -8.55, -105.5], ctrans, 1, (27 + time) %
                    30, 0, time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.0501953125, 51.4, 62.75], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.0501953125, 59.7, -3.2], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.0501953125, -59.25, 62.75], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.0501953125, -66.9, -3.2], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.0501953125, -3.0, -93.05], ctrans, 1, 0, 0, time);
                place("shape190", canvas, ctx, [0.05, 0.0, 0.0, 0.0501953125, 123.85, -104.8], ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.0501953125, 123.85, -104.8], ctrans, 1, 0, 0, time);
                place("shape191", canvas, ctx, [0.05, 0.0, 0.0, 0.0501953125, -130.7, -104.8], ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.0501953125, -130.7, -104.8], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.0501953125, 231.45, 47.7], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.0501953125, 265.75, -52.35], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.0501953125, 178.7, -150.05], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.0501953125, -238.8, 47.7], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.0501953125, -273.1, -52.35], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.0501953125, -186.05, -150.05], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.0501953125, -14.8, -138.65], ctrans, 1, 0, 0, time);
                break;
            case 88:
                place("sprite193", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 14.75, -253.7], ctrans, 1, (0 + time) % 1, 44,
                    time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (28 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape175", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape177", canvas, ctx, [0.020473480224609375, 0.0, 0.0, 0.0204620361328125, -399.85, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 89:
                place("sprite193", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 14.75, -253.7], ctrans, 1, (0 + time) % 1, 44,
                    time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (29 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape183", canvas, ctx, [0.020477294921875, 0.0, 0.0, 0.0204833984375, -98.35, -121.45], ctrans,
                    1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape184", canvas, ctx, [0.049999237060546875, 0.0, 0.0, 0.05, -177.7, -103.85], ctrans, 1, 0, 0,
                    time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 90:
                place("sprite193", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 14.75, -253.7], ctrans, 1, (0 + time) % 1, 44,
                    time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (0 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape185", canvas, ctx, [0.020470428466796874, 0.0, 0.0, 0.02047271728515625, -98.25, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape186", canvas, ctx, [0.020484161376953126, 0.0, 0.0, 0.0204620361328125, -400.0, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 91:
                place("sprite193", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 14.75, -253.7], ctrans, 1, (0 + time) % 1, 44,
                    time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (1 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape187", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape188", canvas, ctx, [0.0204833984375, 0.0, 0.0, 0.020491790771484376, -399.95, -121.45],
                    ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 92:
                place("sprite193", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 14.75, -253.7], ctrans, 1, (0 + time) % 1, 44,
                    time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (2 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape177", canvas, ctx, [0.020473480224609375, 0.0, 0.0, 0.0204620361328125, -98.3, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape189", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 93:
                place("sprite193", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 14.75, -253.7], ctrans, 1, (0 + time) % 1, 44,
                    time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (3 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape184", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape183", canvas, ctx, [0.020477294921875, 0.0, 0.0, 0.0204833984375, -399.9, -121.45], ctrans,
                    1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 94:
                place("sprite193", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 14.75, -253.7], ctrans, 1, (0 + time) % 1, 44,
                    time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (4 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape186", canvas, ctx, [0.020484161376953126, 0.0, 0.0, 0.0204620361328125, -98.45, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape185", canvas, ctx, [0.020470428466796874, 0.0, 0.0, 0.02047271728515625, -399.8, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 95:
                place("sprite193", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 14.75, -255.65], ctrans, 1, (0 + time) % 1, 44,
                    time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (5 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape190", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape191", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 96:
                place("sprite193", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 14.75, -257.65], ctrans, 1, (0 + time) % 1, 44,
                    time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (6 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape175", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape177", canvas, ctx, [0.020473480224609375, 0.0, 0.0, 0.0204620361328125, -399.85, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 97:
                place("sprite193", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 14.75, -230.15], ctrans, 1, (0 + time) % 1, 44,
                    time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (7 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape183", canvas, ctx, [0.020477294921875, 0.0, 0.0, 0.0204833984375, -98.35, -121.45], ctrans,
                    1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape184", canvas, ctx, [0.049999237060546875, 0.0, 0.0, 0.05, -177.7, -103.85], ctrans, 1, 0, 0,
                    time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 98:
                place("sprite193", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 14.75, -202.7], ctrans, 1, (0 + time) % 1, 44,
                    time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (8 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape185", canvas, ctx, [0.020470428466796874, 0.0, 0.0, 0.02047271728515625, -98.25, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape186", canvas, ctx, [0.020484161376953126, 0.0, 0.0, 0.0204620361328125, -400.0, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 99:
                place("sprite193", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 14.75, -175.2], ctrans, 1, (0 + time) % 1, 44,
                    time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (9 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape187", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape188", canvas, ctx, [0.0204833984375, 0.0, 0.0, 0.020491790771484376, -399.95, -121.45],
                    ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 100:
                place("sprite193", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 14.75, -175.2], ctrans, 1, (0 + time) % 1, 44,
                    time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (10 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape177", canvas, ctx, [0.020473480224609375, 0.0, 0.0, 0.0204620361328125, -98.3, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape189", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 101:
                place("sprite193", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 14.75, -175.2], ctrans, 1, (0 + time) % 1, 44,
                    time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (11 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape184", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape183", canvas, ctx, [0.020477294921875, 0.0, 0.0, 0.0204833984375, -399.9, -121.45], ctrans,
                    1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 102:
                place("sprite193", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 14.75, -175.2], ctrans, 1, (0 + time) % 1, 44,
                    time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (12 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape186", canvas, ctx, [0.020484161376953126, 0.0, 0.0, 0.0204620361328125, -98.45, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape185", canvas, ctx, [0.020470428466796874, 0.0, 0.0, 0.02047271728515625, -399.8, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 103:
                place("sprite193", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 14.75, -175.2], ctrans, 1, (0 + time) % 1, 44,
                    time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (13 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape190", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape191", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 104:
                place("sprite193", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 14.75, -175.2], ctrans, 1, (0 + time) % 1, 44,
                    time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (14 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape175", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape177", canvas, ctx, [0.020473480224609375, 0.0, 0.0, 0.0204620361328125, -399.85, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 105:
                place("sprite193", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 14.75, -175.2], ctrans, 1, (0 + time) % 1, 44,
                    time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (15 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape183", canvas, ctx, [0.020477294921875, 0.0, 0.0, 0.0204833984375, -98.35, -121.45], ctrans,
                    1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape184", canvas, ctx, [0.049999237060546875, 0.0, 0.0, 0.05, -177.7, -103.85], ctrans, 1, 0, 0,
                    time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 106:
                place("sprite193", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 14.75, -175.2], ctrans, 1, (0 + time) % 1, 44,
                    time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (16 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape185", canvas, ctx, [0.020470428466796874, 0.0, 0.0, 0.02047271728515625, -98.25, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape186", canvas, ctx, [0.020484161376953126, 0.0, 0.0, 0.0204620361328125, -400.0, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 107:
                place("sprite193", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 14.75, -175.2], ctrans, 1, (0 + time) % 1, 44,
                    time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (17 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape187", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape188", canvas, ctx, [0.0204833984375, 0.0, 0.0, 0.020491790771484376, -399.95, -121.45],
                    ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 108:
                place("sprite193", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 14.75, -175.2], ctrans, 1, (0 + time) % 1, 44,
                    time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (18 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape177", canvas, ctx, [0.020473480224609375, 0.0, 0.0, 0.0204620361328125, -98.3, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape189", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 109:
                place("sprite193", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 14.75, -175.2], ctrans, 1, (0 + time) % 1, 44,
                    time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (19 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape184", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape183", canvas, ctx, [0.020477294921875, 0.0, 0.0, 0.0204833984375, -399.9, -121.45], ctrans,
                    1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 110:
                place("sprite193", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 14.75, -175.2], ctrans, 1, (0 + time) % 1, 44,
                    time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (20 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape186", canvas, ctx, [0.020484161376953126, 0.0, 0.0, 0.0204620361328125, -98.45, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape185", canvas, ctx, [0.020470428466796874, 0.0, 0.0, 0.02047271728515625, -399.8, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 111:
                place("sprite193", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 14.75, -175.2], ctrans, 1, (0 + time) % 1, 44,
                    time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (21 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape190", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape191", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 112:
                place("sprite193", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 14.75, -175.2], ctrans, 1, (0 + time) % 1, 44,
                    time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (22 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape175", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape177", canvas, ctx, [0.020473480224609375, 0.0, 0.0, 0.0204620361328125, -399.85, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 113:
                place("sprite193", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 14.75, -175.2], ctrans, 1, (0 + time) % 1, 44,
                    time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (23 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape183", canvas, ctx, [0.020477294921875, 0.0, 0.0, 0.0204833984375, -98.35, -121.45], ctrans,
                    1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape184", canvas, ctx, [0.049999237060546875, 0.0, 0.0, 0.05, -177.7, -103.85], ctrans, 1, 0, 0,
                    time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 114:
                place("sprite193", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 14.75, -175.2], ctrans, 1, (0 + time) % 1, 44,
                    time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (24 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape185", canvas, ctx, [0.020470428466796874, 0.0, 0.0, 0.02047271728515625, -98.25, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape186", canvas, ctx, [0.020484161376953126, 0.0, 0.0, 0.0204620361328125, -400.0, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 115:
                place("sprite193", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 14.75, -175.2], ctrans, 1, (0 + time) % 1, 44,
                    time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (25 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape187", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape188", canvas, ctx, [0.0204833984375, 0.0, 0.0, 0.020491790771484376, -399.95, -121.45],
                    ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 116:
                place("sprite193", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 14.75, -175.2], ctrans, 1, (0 + time) % 1, 44,
                    time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (26 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape177", canvas, ctx, [0.020473480224609375, 0.0, 0.0, 0.0204620361328125, -98.3, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape189", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 117:
                place("sprite193", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 14.75, -175.2], ctrans, 1, (0 + time) % 1, 44,
                    time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (27 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape184", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape183", canvas, ctx, [0.020477294921875, 0.0, 0.0, 0.0204833984375, -399.9, -121.45], ctrans,
                    1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 118:
                place("sprite193", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 14.75, -175.2], ctrans, 1, (0 + time) % 1, 44,
                    time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (28 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape186", canvas, ctx, [0.020484161376953126, 0.0, 0.0, 0.0204620361328125, -98.45, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape185", canvas, ctx, [0.020470428466796874, 0.0, 0.0, 0.02047271728515625, -399.8, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 119:
                place("sprite193", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 14.75, -175.2], ctrans, 1, (0 + time) % 1, 44,
                    time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (29 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape190", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape191", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
                break;
            case 120:
                place("sprite193", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 14.75, -175.2], ctrans, 1, (0 + time) % 1, 44,
                    time);
                place("shape164", canvas, ctx, [0.035616302490234376, 0.0, 0.0, 0.02935943603515625, -7.05, 567.9],
                    ctrans, 1, 0, 0, time);
                place("shape165", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -109.75], ctrans, 1, 0, 0, time);
                place("sprite170", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -8.55, -104.55], ctrans, 1, (0 + time) % 30, 0,
                    time);
                place("shape171", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 51.4, 63.0], ctrans, 1, 0, 0, time);
                place("shape172", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 59.7, -2.7], ctrans, 1, 0, 0, time);
                place("shape171", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -59.25, 63.0], ctrans, 1, 0, 0, time);
                place("shape173", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -66.9, -2.7], ctrans, 1, 0, 0, time);
                place("shape174", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -3.0, -92.2], ctrans, 1, 0, 0, time);
                place("shape175", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape176", canvas, ctx, [0.05, 0.0, 0.0, 0.05, 123.85, -103.85], ctrans, 1, 0, 0, time);
                place("shape177", canvas, ctx, [0.020473480224609375, 0.0, 0.0, 0.0204620361328125, -399.85, -121.35],
                    ctrans, 1, 0, 0, time);
                place("shape178", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -130.7, -103.85], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 231.45, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 265.75, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [-0.05, 0.0, 0.0, 0.05, 178.7, -148.95], ctrans, 1, 0, 0, time);
                place("shape179", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -238.8, 48.0], ctrans, 1, 0, 0, time);
                place("shape180", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -273.1, -51.65], ctrans, 1, 0, 0, time);
                place("shape181", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -186.05, -148.95], ctrans, 1, 0, 0, time);
                place("shape182", canvas, ctx, [0.05, 0.0, 0.0, 0.05, -14.8, -137.6], ctrans, 1, 0, 0, time);
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
    frames.push(102);
    frames.push(103);
    frames.push(104);
    frames.push(105);
    frames.push(106);
    frames.push(107);
    frames.push(108);
    frames.push(109);
    frames.push(110);
    frames.push(111);
    frames.push(112);
    frames.push(113);
    frames.push(114);
    frames.push(115);
    frames.push(116);
    frames.push(117);
    frames.push(118);
    frames.push(119);
    frames.push(120);

    var backgroundColor = "#c6481d";
    var originalWidth = 643;
    var originalHeight = 1567;

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
        sprite196(ctx, ctrans, frames[frame], 0, time);
        ctx.restore();
    }

    window.setInterval(function() {
        nextFrame(ctx, ctrans);
    }, 62);
    nextFrame(ctx, ctrans);

</script>
