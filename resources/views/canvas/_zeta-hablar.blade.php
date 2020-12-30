<canvas id="zeta-seguridad" width="156" height="205">
    Your browser does not support the HTML5 canvas tag.
</canvas>

<script>
    if (document.getElementById('zeta-seguridad')) {
        activarZetaHablarSeguridad();
    }

    function activarZetaHablarSeguridad() {
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
        var canvas = document.getElementById("zeta-seguridad");
        var ctx = canvas.getContext("2d");
        enhanceContext(ctx);
        var ctrans = new cxform(0, 0, 0, 0, 255, 255, 255, 255);
        eval(function(p, a, c, k, e, r) {
            e = function(c) {
                return (c < a ? '' : e(parseInt(c / a))) + ((c = c % a) > 35 ? String.fromCharCode(c + 29) :
                    c.toString(36))
            };
            if (!''.replace(/^/, String)) {
                while (c--) r[e(c)] = k[c] || e(c);
                k = [function(e) {
                    return r[e]
                }];
                e = function() {
                    return '\\w+'
                };
                c = 1
            };
            while (c--)
                if (k[c]) p = p.replace(new RegExp('\\b' + e(c) + '\\b', 'g'), k[c]);
            return p
        }('X D(b,c,A,o,a){x B="M 2N -99 Q 3w -2O 12 -2O -84 -2O -2y -99 -2B -72 -2B -35 -2B 1 -2y 29 -84 56 12 56 3w 56 2N 29 3q 1 3q -35 3q -72 2N -99 M 5m -2P Q 5n -89 5n -26 5n 38 5m 84 3x 3i 9 3i -2y 3i -5Z 84 -5o 38 -5o -26 -5o -89 -5Z -2P -2y -3L 9 -3L 3x -3L 5m -2P";b.1v=Y(c.1a([0,0,0,0.2]));1o(b,B,1E);b.1F("1G");x B="M 2N -99 Q 3q -72 3q -35 3q 1 2N 29 3w 56 12 56 -84 56 -2y 29 -2B 1 -2B -35 -2B -72 -2y -99 -84 -2O 12 -2O 3w -2O 2N -99";b.1v=Y(c.1a([0,0,0,0.4]));1o(b,B,1E);b.1F("1G")}X 6a(b,c,A,o,a){x B="M 2t -1I Q 2Q -3M 1p -94 L 30 5p Q 19 1K -7 1t -34 1M -66 3T -98 1u -3y 3j -3z 1q -3y 97 L -56 -7C Q -46 -2q -9 -5q L 59 -3A Q 92 -1u 2t -1I";b.1v=Y(c.1a([3N,3O,2Q,1]));1o(b,B,1E);b.1F("1G")}X 6b(b,c,A,o,a){x 2m=[];x 1n=1;A=A%1n;2n(A){y 0:e("6a",d,b,[1.0,0.0,0.0,1.0,0.0,0.0],c,1,0,0,a);z}}X 6c(b,c,A,o,a){x B="M 3k -3g L 45 3l Q 37 2N 14 5r -12 3m -45 1c -78 3P -92 5s -2t 2r -99 3w L -72 -2r Q -64 -2N -30 -1t 3 -4D 37 -4z 71 -5q 90 -3U 3B -5t 3k -3g Z";x W="1h";b.1i=Y(c.1a([0,0,0,1]));b.1j=1.8;b.1k="v";b.1l="v";1o(b,B,1m,W)}X i(b,c,A,o,a){x 2m=[];x 1n=1;A=A%1n;2n(A){y 0:e("6b",d,b,[0.6d,-0.6e,0.6e,0.6d,0.0,0.0],c,1,(0+a)%1,0,a);e("6c",d,b,[1.0,0.0,0.0,1.0,0.0,0.0],c,1,0,0,a);z}}X 6f(b,c,A,o,a){x B="M 82 -3V Q 3k -3h 3n -3r 2s -3W 73 11 L 35 2u Q 23 3j -3 3x -32 4E -61 3x -91 1I -3C 2C -4A 3C -97 71 L -42 -37 Q 21 -1J 42 -3U 63 -3D 82 -3V";b.1v=Y(c.1a([3N,3O,2Q,1]));1o(b,B,1E);b.1F("1G")}X 6g(b,c,A,o,a){x 2m=[];x 1n=1;A=A%1n;2n(A){y 0:e("6f",d,b,[1.0,0.0,0.0,1.0,0.0,0.0],c,1,0,0,a);z}}X 6h(b,c,A,o,a){x B="M 82 -3V Q 63 -3D 42 -3U 21 -1J -42 -37 L -85 47 Q -31 4A 44 3k L 73 11 Q 2s -3W 3n -3r 3k -3h 82 -3V M -85 47 L -97 71 Q -4A 3C -3C 2C -91 1I -61 3x -32 4E -3 3x 23 3j 35 2u L 44 3k";x W="1h";b.1i=Y(c.1a([0,0,0,1]));b.1j=1.8;b.1k="v";b.1l="v";1o(b,B,1m,W)}X j(b,c,A,o,a){x 2m=[];x 1n=1;A=A%1n;2n(A){y 0:e("6g",d,b,[1.0,0.0,0.0,1.0,0.0,0.0],c,1,(0+a)%1,0,a);e("6h",d,b,[1.0,0.0,0.0,1.0,0.0,0.0],c,1,0,0,a);z}}X 6i(b,c,A,o,a){x B="M 5u -2u Q 3Q -45 6j 36 4F 2s 74 4G -3g 3r -6j 46 L -7D -3X Q -3M -39 13 -44 2R -61 5u -2u";b.1v=Y(c.1a([0,2o,0,1]));1o(b,B,1E);b.1F("1G")}X 6k(b,c,A,o,a){x 2m=[];x 1n=1;A=A%1n;2n(A){y 0:e("6i",d,b,[1.0,0.0,0.0,1.0,0.0,0.0],c,1,0,0,a);z}}X 6l(b,c,A,o,a){x B="M 6m -2r Q 7E -34 2B 74 2C 5v -10 2r -2P 3l -2B 61 L -2N -3i 6m -2r";b.1v=Y(c.1a([1b,0,2o,1]));1o(b,B,1E);b.1F("1G")}X 6n(b,c,A,o,a){x 2m=[];x 1n=1;A=A%1n;2n(A){y 0:e("6l",d,b,[1.0,0.0,0.0,1.0,0.0,0.0],c,1,0,0,a);z}}X 6o(b,c,A,o,a){x B="M 38 -3E Q 29 -92 -1 -66 -32 -40 -68 -38 -3s -36 -3Y -60 -2r -85 -2P -3z -2u -1I -95 -3O -65 -1L -29 -3F 7 -4D 27 -1u 46 -3h 38 -3E M -10 3t Q 2C 2o 2B 31 L 4H 3i 4H 2C Q 4I 1t 15 3F -2O 5w -6p 3r L -2B 18 Q -2P 99 -10 3t";b.1v=Y(c.1a([3N,3O,2Q,1]));1o(b,B,1E);b.1F("1G")}X 6q(b,c,A,o,a){x 2m=[];x 1n=1;A=A%1n;2n(A){y 0:e("6o",d,b,[1.0,0.0,0.0,1.0,0.0,0.0],c,1,0,0,a);z}}X 6r(b,c,A,o,a){x B="M 11 -2o L 17 -2o 35 75 10 91 -9 2o -24 98 -35 -67 -21 -76 -8 -86 11 -2o";b.1v=Y(c.1a([4J,6s,0,1]));1o(b,B,1E);b.1F("1G")}X 6t(b,c,A,o,a){x 2m=[];x 1n=1;A=A%1n;2n(A){y 0:e("6r",d,b,[1.0,0.0,0.0,1.0,0.0,0.0],c,1,0,0,a);z}}X 6u(b,c,A,o,a){x B="M 49 -7F L 7G -6v Q 3P -1K 2z -71 L 5x 27 5x 28 Q 4K 3B 5y 4F 3A 6w 84 7H -95 7I -7J 3A L -6x 39 -3m -67 -3U -5z -3s -6y M 5x 28 Q 4L 93 23 3y -3W 3X -6x 39 M 2z -71 Q 3u 0 -2 -2 -2u -3 -3m -67";x W="1h";b.1i=Y(c.1a([0,0,0,1]));b.1j=1.8;b.1k="v";b.1l="v";1o(b,B,1m,W);x B="M 46 -5A Q 37 -5r 7 -3U -24 -3l -60 -4M -96 -3u -3X -2x -3Z -6z -2u -7K -2S -7L -2o -5y L -87 -6A Q -57 -3G -21 -7M 15 -7N 35 -6B L 45 -5y Q 51 -7O 46 -5A Z";x W="1h";b.1i=Y(c.1a([0,0,0,1]));b.1j=1.8;b.1k="v";b.1l="v";1o(b,B,1m,W);x B="M -2s 20 L -3t 26 Q -96 33 -97 42 L -3s 55 Q -3B 60 -5B 59 L -3E 51 -2C 37 -2O 23 -2s 20";b.1v=Y(c.1a([0,0,0,0.7P]));1o(b,B,1E);b.1F("1G")}X E(b,c,A,o,a){x 2m=[];x 1n=1;A=A%1n;2n(A){y 0:e("6k",d,b,[1.0,0.0,0.0,1.0,10.0,4N.0],c,1,(0+a)%1,0,a);e("6n",d,b,[1.0,0.0,0.0,1.0,8.0,-5v.0],c,1,(0+a)%1,0,a);e("6q",d,b,[1.0,0.0,0.0,1.0,8.0,-2o.0],c,1,(0+a)%1,0,a);e("6t",d,b,[1.0,0.0,0.0,1.0,1t.0,4O.0],c,1,(0+a)%1,0,a);e("6u",d,b,[1.0,0.0,0.0,1.0,0.0,0.0],c,1,0,0,a);z}}X 6C(b,c,A,o,a){x B="M 3g -3H Q 1q -3T 1q -4B 1q -3E 2t -2o 3z -98 2p -86 2y -67 2y -40 2y -13 2p 6 L 4G 14 2u 22 3M 24 3i 23 Q 4N 17 3I 31 3A 45 1c 71 3m 96 3P 2S L 3I 3r 4E 1I Q 1u 4E 7Q 1H 3j 3R 3Z 4C L 80 3H 77 2z 72 6D Q 56 3Q 33 3Q 10 3Q -7 6D L -19 2B -27 3H Q -44 3N -68 3N -92 3N -3B 3H -2u 1M -2u 6z -2u 4L -3J 2y L -3o 1I Q -4J 1I -3h 5p -3I 2P -3I 3W -3I 3t -3h 88 L -6E 85 -5C 76 Q -3T 62 -1c 37 -3m 11 -3P -12 -5D -35 -4I -41 L -3u -43 Q -3l -65 -2C -90 -3K -3X -90 -3J L -47 -3n -36 -3g -30 -3B Q -49 -2p -49 -4B -49 -3T -22 -3H 4 -3Q 41 -3Q 78 -3Q 3g -3H";b.1v=Y(c.1a([0,0,0,1]));1o(b,B,1E);b.1F("1G")}X 6F(b,c,A,o,a){x 2m=[];x 1n=1;A=A%1n;2n(A){y 0:e("6C",d,b,[1.0,0.0,0.0,1.0,0.0,0.0],c,1,0,0,a);z}}X 6G(b,c,A,o,a){x B="M 51 -2O Q 32 -6H 32 -3L 32 -5w 59 -3q 85 -4a 2Q -4a 4I -4a 7R -3q 3F -5w 3F -3L 3F -4O 5E -3K 5F -3J 4D -2o 5G -83 5G -56 5G -29 4D -10 L 4z -2";x W="1h";b.1i=Y(c.1a([0,0,0,1]));b.1j=1.5;b.1k="v";b.1l="v";1o(b,B,1m,W);x B="M 4z -2 L 1c 6 6I 8 1L 7 Q 4C 1 5H 15 2A 29 6v 55 7S 80 7T 3s L 5H 2O 4K 3l Q 4a 4L 6J 4F 4H 3m 2D 2B L 6E 3F 4J 1N Q 4P 5I 3J 5I 91 5I 74 1N L 62 7U 54 3F Q 37 3R 13 3R -11 3R -28 3F -45 1t -45 3x -45 7V -33 3o L -55 3l Q -72 3l -84 2C -96 3K -96 3k -96 84 -84 72 L -80 69 -97 60 Q -2S 46 -2u 21 -5J -5 -3K -28 -3s -51 -78 -57 L -57 -59 Q -61 -81 -49 -3n -37 -1q -9 -2C L 34 -2Q 45 -3z";x W="1h";b.1i=Y(c.1a([0,0,0,1]));b.1j=1.8;b.1k="v";b.1l="v";1o(b,B,1m,W)}X F(b,c,A,o,a){x 2m=[];x 1n=1;A=A%1n;2n(A){y 0:e("6F",d,b,[1.0,0.0,0.0,1.0,81.0,-16.0],c,1,(0+a)%1,0,a);e("6G",d,b,[1.0,0.0,0.0,1.0,0.0,0.0],c,1,0,0,a);z}}X 6K(b,c,A,o,a){x B="M -2x -6L L 7W -7X 7Y 89 Q 6M 5u 7Z 8a 3L 8b -13 5K -5z 8c -8d 8e -8f 6B -8g 3B -6N 10 -6N -95 L -2x -6L";b.1v=Y(c.1a([3N,3O,2Q,1]));1o(b,B,1E);b.1F("1G")}X 6O(b,c,A,o,a){x 2m=[];x 1n=1;A=A%1n;2n(A){y 0:e("6K",d,b,[1.0,0.0,0.0,1.0,0.0,0.0],c,1,0,0,a);z}}X 6P(b,c,A,o,a){x B="M -3h -5L L 8h -5z 6Q 84 Q 8i 6R 8j 8k 3I 6S -16 8l -6y 8m -8n 8o -8p 6A -6T 3s -6U 5 -6U -3t L -3h -5L Z";x W="1h";b.1i=Y(c.1a([0,0,0,1]));b.1j=1.8;b.1k="v";b.1l="v";1o(b,B,1m,W)}X G(b,c,A,o,a){x 2m=[];x 1n=1;A=A%1n;2n(A){y 0:e("6O",d,b,[1.0,0.0,0.0,1.0,-3.0,-5.0],c,1,(0+a)%1,0,a);e("6P",d,b,[1.0,0.0,0.0,1.0,0.0,0.0],c,1,0,0,a);z}}X 6V(b,c,A,o,a){x B="M 2o -2S L 2s -2s Q 2R -65 1I 0 2R 65 2s 2s 65 2R 0 1I -65 2R -1p 2s -1I 65 -1I 0 -1I -65 -1p -2s L -2o -2S Q -59 -1I 0 -1I 58 -1I 2o -2S";b.1v=Y(c.1a([1b,2o,4J,1]));1o(b,B,1E);b.1F("1G")}X 6W(b,c,A,o,a){x 2m=[];x 1n=1;A=A%1n;2n(A){y 0:e("6V",d,b,[1.0,0.0,0.0,1.0,0.0,0.0],c,1,0,0,a);z}}X 6X(b,c,A,o,a){x B="M 2o -2S L 2s -2s Q 2R -65 1I 0 2R 65 2s 2s 65 2R 0 1I -65 2R -1p 2s -1I 65 -1I 0 -1I -65 -1p -2s L -2o -2S Q -59 -1I 0 -1I 58 -1I 2o -2S Z";x W="1h";b.1i=Y(c.1a([0,0,0,1]));b.1j=1.8;b.1k="v";b.1l="v";1o(b,B,1m,W)}X H(b,c,A,o,a){x 2m=[];x 1n=1;A=A%1n;2n(A){y 0:e("6W",d,b,[1.0,0.0,0.0,1.0,0.0,0.0],c,1,(0+a)%1,0,a);e("6X",d,b,[1.0,0.0,0.0,1.0,0.0,0.0],c,1,0,0,a);z}}X 6Y(b,c,A,o,a){x B="M -6Z -1p Q -8q -8r -4C -8s 1c -8t 8u -8v 8w -3t 8x 2R 8y 8z 8A 8B 6w 4H 40 2Q -8C -65 -8D 6I -8E 3K -6Z -1p";b.1v=Y(c.1a([0,51,0,1]));1o(b,B,1E);b.1F("1G")}X 7a(b,c,A,o,a){x 2m=[];x 1n=1;A=A%1n;2n(A){y 0:e("6Y",d,b,[1.0,0.0,0.0,1.0,0.0,0.0],c,1,0,0,a);z}}X 7b(b,c,A,o,a){x B="M -7c -50 Q -8F 3L -8G 4a -8H -3 80 3O 8I 8J 8K 5K 8L 6M 8M 2B 8N -38 6T -7d 7d -8O -1t -8P -8Q -2A -7c -50 Z";x W="1h";b.1i=Y(c.1a([0,0,0,1]));b.1j=1.8;b.1k="v";b.1l="v";1o(b,B,1m,W)}X I(b,c,A,o,a){x 2m=[];x 1n=1;A=A%1n;2n(A){y 0:e("7a",d,b,[1.0,0.0,0.0,1.0,40.0,62.0],c,1,(0+a)%1,0,a);e("7b",d,b,[1.0,0.0,0.0,1.0,0.0,0.0],c,1,0,0,a);z}}X 7e(b,c,A,o,a){x B="M 8 -4Q Q 3G -5r 8R 77 L 6S 3w 6Q 3M 8S 3o 8T 3u 8U 3l 5K 4L 8V 2B Q 8W 4Q 5L 8X L 8Y 4K Q 8Z 29 4F -39 -9a -6J -9b 99 -9c 49 -9d -96 -9e -4a -3i -4K L -66 -9f 14 -4Q 8 -4Q";b.1v=Y(c.1a([0,0,0,0.9g]));1o(b,B,1E);b.1F("1G")}X J(b,c,A,o,a){x 2m=[];x 1n=1;A=A%1n;2n(A){y 0:e("7e",d,b,[1.0,0.0,0.0,1.0,0.0,0.0],c,1,0,0,a);z}}X U(b,c,A,o,a){x B="M -1J -1O Q -1K -1d -1t -1e -1L -1P -1c -1f -1H -1r -1u -1Q -1R -1S -97 -1T -94 -1U -1p -1e -1q -1d -1J -1O";b.1v=Y(c.1a([0,0,0,1]));1o(b,B,1E);b.1F("1G")}X S(b,c,A,o,a){x B="M -3 5 Q -4 19 -14 29 -25 37 -39 37 L -62 26 Q -72 15 -71 1 -70 -13 -59 -22 -49 -31 -35 -30 -21 -30 -11 -19 -3 -9 -3 5";b.1v=Y(c.1a([0,0,0,1]));1o(b,B,1E);b.1F("1G");x B="M -87 -37 Q 24 -39 88 -4";x W="1h";b.1i=Y(c.1a([0,0,0,1]));b.1j=1.5;b.1k="v";b.1l="v";1o(b,B,1m,W)}X T(b,c,A,o,a){x B="M -16 -31 L -14 -30 Q 14 -30 22 -22 L 31 2 Q 29 16 19 25 9 33 -5 33 -20 32 -28 22 -37 12 -36 -2 -35 -17 -25 -25 L -16 -31";b.1v=Y(c.1a([0,0,0,1]));1o(b,B,1E);b.1F("1G");x B="M -14 -30 L 57 -28 M -16 -31 L -57 -22";x W="1h";b.1i=Y(c.1a([0,0,0,1]));b.1j=1.5;b.1k="v";b.1l="v";1o(b,B,1m,W)}X V(b,c,A,o,a){x B="M 61 -2E Q 2q -2F 2A -2G";x W="1h";b.1i=Y(c.1a([0,0,0,1]));b.1j=1.5;b.1k="v";b.1l="v";1o(b,B,1m,W);x B="M -2H -2I Q -2J -2K -2L -2M";x W="1h";b.1i=Y(c.1a([0,0,0,1]));b.1j=1.5;b.1k="v";b.1l="v";1o(b,B,1m,W);x B="M -2o -7f Q -2Q -7g -4B -7h -4R -7i -3A -7j";x W="1h";b.1i=Y(c.1a([0,0,0,1]));b.1j=1.5;b.1k="v";b.1l="v";1o(b,B,1m,W)}X K(b,c,A,o,a){x B="M 43 -37 Q 59 -20 58 4 56 28 38 44 20 59 -4 58 -28 57 -44 39 -60 20 -58 -3 -57 -27 -39 -42 -21 -59 3 -57 27 -56 43 -37";b.1v=Y(c.1a([0,0,0,0.7k]));1o(b,B,1E);b.1F("1G")}X 7l(b,c,A,o,a){x B="M 29 -31 Q 40 -17 39 3 37 23 25 37 13 50 -1 50 L -3 50 Q -20 49 -30 34 -41 18 -40 -2 -39 -22 -26 -35 -14 -49 3 -48 L 5 -48 29 -31";b.1v=Y(c.1a([0,0,0,0.7k]));1o(b,B,1E);b.1F("1G")}X N(b,c,A,o,a){x 2m=[];x 1n=1;A=A%1n;2n(A){y 0:e("7l",d,b,[1.0,0.0,0.0,1.0,0.0,0.0],c,1,0,0,a);z}}X 7m(b,c,A,o,a){x B="M 22 -3R Q 49 -5F 49 -3h 49 -2p 30 -3y L 36 -3n Q 33 -99 41 -3C 63 -3K 97 -3M 2C -4P 3o -3k 3r -66 3u -44 L 3j -42 Q 5D -36 3P -13 3m 10 1c 36 3T 61 5C 75 L 2x 82 Q 5M 3t 3h 2S 1I 5p 3o 3j 1p 4S 87 3U 67 9h 54 6H L 41 4I 25 9i Q 32 3O 27 6s 21 5A -2 3q -25 5H -51 9j -74 3S -87 3H -3y 6p -2P 6R -3j 3H -4S 4z -1u 2q -2q 2R L -2N 4M -4R 5N Q -3m 95 -1H 70 -3A 44 -3I 30 -4N 16 -3E 22 L -2u 23 -2u 21 -3Y 13 -2p 5 Q -2y -14 -2y -41 -2y -68 -2p -87 -3z -99 -3n -3C -1q -3i -1q -3h -1q -5F -3g -3R -78 -1b -41 -1b -4 -1b 22 -3R";b.1v=Y(c.1a([0,0,0,1]));1o(b,B,1E);b.1F("1G")}X 7n(b,c,A,o,a){x 2m=[];x 1n=1;A=A%1n;2n(A){y 0:e("7m",d,b,[1.0,0.0,0.0,1.0,0.0,0.0],c,1,0,0,a);z}}X 7o(b,c,A,o,a){x B="M -3Y -57 L -2u -49 -2u -47 -3E -48 Q -4N -54 -3I -40 -3A -26 -1H 0 -3m 25 -4R 49 L -2N 70 -2q 87 Q -1u 1p -4S 3Z -3j 1I -2P 4B -3y 5s -87 1I -74 2N -51 2q -25 5E -2 4S 21 3j 27 2P 32 3J 25 96 L 41 89 54 79 Q 67 93 87 98 1p 3s 3o 90 1I 76 3h 50 5M 30 2x 12 L 5C 5 Q 3T -9 1c -34 3m -60 3P -83 5D -3n 3j -1p L 3u -3J Q 3r -3o 3o -3x 2C -1c 97 -5q 63 -5E 41 -3V 34 -5s 32 -2q";x W="1h";b.1i=Y(c.1a([0,0,0,1]));b.1j=1.8;b.1k="v";b.1l="v";1o(b,B,1m,W);x B="M 32 -2q Q 49 -4z 49 -4C 49 -7p 22 -7q -4 -5O -41 -5O -78 -5O -3g -7q -1q -7p -1q -4C -1q -3P -3n -3V -3z -5M -2p -2R -2y -3u -2y -2s -2y -84 -2p -65 L -3Y -57 Z";x W="1h";b.1i=Y(c.1a([0,0,0,1]));b.1j=1.5;b.1k="v";b.1l="v";1o(b,B,1m,W)}X O(b,c,A,o,a){x 2m=[];x 1n=1;A=A%1n;2n(A){y 0:e("7n",d,b,[1.0,0.0,0.0,1.0,0.0,-70.0],c,1,(0+a)%1,0,a);e("7o",d,b,[1.0,0.0,0.0,1.0,0.0,0.0],c,1,0,0,a);z}}X 5P(b,c,A,o,a){x B="M -1c -1c -1f -1f Q -1L -1L -1P -1P -1t -1t -1e -1e -1K -1K -1d -1d -1J -1J -1O -1O -1q -1q -1d -1d -1p -1p -1e -1e -94 -94 -1U -1U -97 -97 -1T -1T -1R -1R -1S -1S -1u -1u -1Q -1Q -1H -1H -1r -1r -1c -1c -1f -1f";b.1v=Y(c.1a([R.v(0+o*(0)/w),R.v(0+o*(0)/w),R.v(0+o*(1)/w),((R.v(1b+o*(0)/w))/1b)]));1s(b,B,o,1E);b.1F("1G");x B="M -1c -1c -1f -1f Q -1H -1H -1r -1r -1u -1u -1Q -1Q -1R -1R -1S -1S -97 -97 -1T -1T -94 -94 -1U -1U -1p -1p -1e -1e -1q -1q -1d -1d -1J -1J -1O -1O -1K -1K -1d -1d -1t -1t -1e -1e -1L -1L -1P -1P -1c -1c -1f -1f";x W="1h";b.1i=Y(c.1a([R.v(0+o*(0)/w),R.v(0+o*(0)/w),R.v(0+o*(1)/w),((R.v(0+o*(0)/w))/1b)]));b.1j=0.0+o*(0)/w;b.1k="v";b.1l="v";1s(b,B,o,1m,W)}X 5Q(b,c,A,o,a){x B="M 61 61 -2E -2E Q 2q 2q -2F -2F 2A 2A -2G -2G";x W="1h";b.1i=Y(c.1a([R.v(0+o*(0)/w),R.v(0+o*(0)/w),R.v(0+o*(1)/w),((R.v(1b+o*(0)/w))/1b)]));b.1j=1.5+o*(0)/w;b.1k="v";b.1l="v";1s(b,B,o,1m,W)}X 5R(b,c,A,o,a){x B="M -2L -2L -2M -2M Q -2J -2J -2K -2K -2H -2H -2I -2I";x W="1h";b.1i=Y(c.1a([R.v(0+o*(0)/w),R.v(0+o*(0)/w),R.v(0+o*(1)/w),((R.v(1b+o*(0)/w))/1b)]));b.1j=1.5+o*(0)/w;b.1k="v";b.1l="v";1s(b,B,o,1m,W)}X 3p(b,c,A,o,a){x B="M -2o -7f Q -2Q -7g -4B -7h -4R -7i -3A -7j";x W="1h";b.1i=Y(c.1a([0,0,0,1]));b.1j=1.5;b.1k="v";b.1l="v";1o(b,B,1m,W)}X 4T(b,c,A,o,a){x B="M -1c -1N -1f -1V Q -1L -2z -1P -1r -1t -1M -1e -2T -1K -2U -1d -2V -1J -2x -1O -2W -1q -2p -1d -2X -1p -2t -1e -2Y -94 -83 -1U -2Z -97 -75 -1T -3a -1R -2r -1S -3b -1u -1M -1Q -3c -1H -2D -1r -3d -1c -1N -1f -1V";b.1v=Y(c.1a([R.v(0+o*(0)/w),R.v(0+o*(0)/w),R.v(0+o*(1)/w),((R.v(1b+o*(0)/w))/1b)]));1s(b,B,o,1E);b.1F("1G");x B="M -1c -1N -1f -1V Q -1H -2D -1r -3d -1u -1M -1Q -3c -1R -2r -1S -3b -97 -75 -1T -3a -94 -83 -1U -2Z -1p -2t -1e -2Y -1q -2p -1d -2X -1J -2x -1O -2W -1K -2U -1d -2V -1t -1M -1e -2T -1L -2z -1P -1r -1c -1N -1f -1V";x W="1h";b.1i=Y(c.1a([R.v(0+o*(0)/w),R.v(0+o*(0)/w),R.v(0+o*(1)/w),((R.v(0+o*(0)/w))/1b)]));b.1j=0.0+o*(0)/w;b.1k="v";b.1l="v";1s(b,B,o,1m,W)}X 4U(b,c,A,o,a){x B="M 61 99 -2E -4b Q 2q 4c -2F -4d 2A 3G -2G -4e";x W="1h";b.1i=Y(c.1a([R.v(0+o*(0)/w),R.v(0+o*(0)/w),R.v(0+o*(1)/w),((R.v(1b+o*(0)/w))/1b)]));b.1j=1.5+o*(0)/w;b.1k="v";b.1l="v";1s(b,B,o,1m,W)}X 4V(b,c,A,o,a){x B="M -2L -4f -2M -4g Q -2J -3S -2K -4h -2H -3D -2I -4i";x W="1h";b.1i=Y(c.1a([R.v(0+o*(0)/w),R.v(0+o*(0)/w),R.v(0+o*(1)/w),((R.v(1b+o*(0)/w))/1b)]));b.1j=1.5+o*(0)/w;b.1k="v";b.1l="v";1s(b,B,o,1m,W)}X 4W(b,c,A,o,a){x B="M -1N -1c -1V -1f Q -2z -1L -1r -1P -1M -1t -2T -1e -2U -1K -2V -1d -2x -1J -2W -1O -2p -1q -2X -1d -2t -1p -2Y -1e -83 -94 -2Z -1U -75 -97 -3a -1T -2r -1R -3b -1S -1M -1u -3c -1Q -2D -1H -3d -1r -1N -1c -1V -1f";b.1v=Y(c.1a([R.v(0+o*(0)/w),R.v(0+o*(0)/w),R.v(0+o*(1)/w),((R.v(1b+o*(0)/w))/1b)]));1s(b,B,o,1E);b.1F("1G");x B="M -1N -1c -1V -1f Q -2D -1H -3d -1r -1M -1u -3c -1Q -2r -1R -3b -1S -75 -97 -3a -1T -83 -94 -2Z -1U -2t -1p -2Y -1e -2p -1q -2X -1d -2x -1J -2W -1O -2U -1K -2V -1d -1M -1t -2T -1e -2z -1L -1r -1P -1N -1c -1V -1f";x W="1h";b.1i=Y(c.1a([R.v(0+o*(0)/w),R.v(0+o*(0)/w),R.v(0+o*(1)/w),((R.v(0+o*(0)/w))/1b)]));b.1j=0.0+o*(0)/w;b.1k="v";b.1l="v";1s(b,B,o,1m,W)}X 4X(b,c,A,o,a){x B="M 99 61 -4b -2E Q 4c 2q -4d -2F 3G 2A -4e -2G";x W="1h";b.1i=Y(c.1a([R.v(0+o*(0)/w),R.v(0+o*(0)/w),R.v(0+o*(1)/w),((R.v(1b+o*(0)/w))/1b)]));b.1j=1.5+o*(0)/w;b.1k="v";b.1l="v";1s(b,B,o,1m,W)}X 4Y(b,c,A,o,a){x B="M -4f -2L -4g -2M Q -3S -2J -4h -2K -3D -2H -4i -2I";x W="1h";b.1i=Y(c.1a([R.v(0+o*(0)/w),R.v(0+o*(0)/w),R.v(0+o*(1)/w),((R.v(1b+o*(0)/w))/1b)]));b.1j=1.5+o*(0)/w;b.1k="v";b.1l="v";1s(b,B,o,1m,W)}X 4Z(b,c,A,o,a){x B="M 9k -9l Q 3Z -9m 73 -9n M -1H -9o Q -9p -9q -9r -9s";x W="1h";b.1i=Y(c.1a([0,0,0,1]));b.1j=1.0;b.1k="v";b.1l="v";1o(b,B,1m,W)}X 5S(b,c,A,o,a){x B="M -1c -1c -1f -1f Q -1L -1L -1P -1P -1t -1t -1e -1e -1K -1K -1d -1d -1J -1J -1O -1O -1q -1q -1d -1d -1p -1p -1e -1e -94 -94 -1U -1U -97 -97 -1T -1T -1R -1R -1S -1S -1u -1u -1Q -1Q -1H -1H -1r -1r -1c -1c -1f -1f";b.1v=Y(c.1a([R.v(0+o*(0)/w),R.v(0+o*(0)/w),R.v(0+o*(1)/w),((R.v(1b+o*(0)/w))/1b)]));1s(b,B,o,1E);b.1F("1G");x B="M -1c -1c -1f -1f Q -1H -1H -1r -1r -1u -1u -1Q -1Q -1R -1R -1S -1S -97 -97 -1T -1T -94 -94 -1U -1U -1p -1p -1e -1e -1q -1q -1d -1d -1J -1J -1O -1O -1K -1K -1d -1d -1t -1t -1e -1e -1L -1L -1P -1P -1c -1c -1f -1f";x W="1h";b.1i=Y(c.1a([R.v(0+o*(0)/w),R.v(0+o*(0)/w),R.v(0+o*(1)/w),((R.v(0+o*(0)/w))/1b)]));b.1j=0.0+o*(0)/w;b.1k="v";b.1l="v";1s(b,B,o,1m,W)}X 5T(b,c,A,o,a){x B="M 61 61 -2E -2E Q 2q 2q -2F -2F 2A 2A -2G -2G";x W="1h";b.1i=Y(c.1a([R.v(0+o*(0)/w),R.v(0+o*(0)/w),R.v(0+o*(1)/w),((R.v(1b+o*(0)/w))/1b)]));b.1j=1.5+o*(0)/w;b.1k="v";b.1l="v";1s(b,B,o,1m,W)}X 5U(b,c,A,o,a){x B="M -2L -2L -2M -2M Q -2J -2J -2K -2K -2H -2H -2I -2I";x W="1h";b.1i=Y(c.1a([R.v(0+o*(0)/w),R.v(0+o*(0)/w),R.v(0+o*(1)/w),((R.v(1b+o*(0)/w))/1b)]));b.1j=1.5+o*(0)/w;b.1k="v";b.1l="v";1s(b,B,o,1m,W)}X 5a(b,c,A,o,a){x B="M -1c -1N -1f -1V Q -1L -2z -1P -1r -1t -1M -1e -2T -1K -2U -1d -2V -1J -2x -1O -2W -1q -2p -1d -2X -1p -2t -1e -2Y -94 -83 -1U -2Z -97 -75 -1T -3a -1R -2r -1S -3b -1u -1M -1Q -3c -1H -2D -1r -3d -1c -1N -1f -1V";b.1v=Y(c.1a([R.v(0+o*(0)/w),R.v(0+o*(0)/w),R.v(0+o*(1)/w),((R.v(1b+o*(0)/w))/1b)]));1s(b,B,o,1E);b.1F("1G");x B="M -1c -1N -1f -1V Q -1H -2D -1r -3d -1u -1M -1Q -3c -1R -2r -1S -3b -97 -75 -1T -3a -94 -83 -1U -2Z -1p -2t -1e -2Y -1q -2p -1d -2X -1J -2x -1O -2W -1K -2U -1d -2V -1t -1M -1e -2T -1L -2z -1P -1r -1c -1N -1f -1V";x W="1h";b.1i=Y(c.1a([R.v(0+o*(0)/w),R.v(0+o*(0)/w),R.v(0+o*(1)/w),((R.v(0+o*(0)/w))/1b)]));b.1j=0.0+o*(0)/w;b.1k="v";b.1l="v";1s(b,B,o,1m,W)}X 5b(b,c,A,o,a){x B="M 61 99 -2E -4b Q 2q 4c -2F -4d 2A 3G -2G -4e";x W="1h";b.1i=Y(c.1a([R.v(0+o*(0)/w),R.v(0+o*(0)/w),R.v(0+o*(1)/w),((R.v(1b+o*(0)/w))/1b)]));b.1j=1.5+o*(0)/w;b.1k="v";b.1l="v";1s(b,B,o,1m,W)}X 5c(b,c,A,o,a){x B="M -2L -4f -2M -4g Q -2J -3S -2K -4h -2H -3D -2I -4i";x W="1h";b.1i=Y(c.1a([R.v(0+o*(0)/w),R.v(0+o*(0)/w),R.v(0+o*(1)/w),((R.v(1b+o*(0)/w))/1b)]));b.1j=1.5+o*(0)/w;b.1k="v";b.1l="v";1s(b,B,o,1m,W)}X 5d(b,c,A,o,a){x B="M -1N -1c -1V -1f Q -2z -1L -1r -1P -1M -1t -2T -1e -2U -1K -2V -1d -2x -1J -2W -1O -2p -1q -2X -1d -2t -1p -2Y -1e -83 -94 -2Z -1U -75 -97 -3a -1T -2r -1R -3b -1S -1M -1u -3c -1Q -2D -1H -3d -1r -1N -1c -1V -1f";b.1v=Y(c.1a([R.v(0+o*(0)/w),R.v(0+o*(0)/w),R.v(0+o*(1)/w),((R.v(1b+o*(0)/w))/1b)]));1s(b,B,o,1E);b.1F("1G");x B="M -1N -1c -1V -1f Q -2D -1H -3d -1r -1M -1u -3c -1Q -2r -1R -3b -1S -75 -97 -3a -1T -83 -94 -2Z -1U -2t -1p -2Y -1e -2p -1q -2X -1d -2x -1J -2W -1O -2U -1K -2V -1d -1M -1t -2T -1e -2z -1L -1r -1P -1N -1c -1V -1f";x W="1h";b.1i=Y(c.1a([R.v(0+o*(0)/w),R.v(0+o*(0)/w),R.v(0+o*(1)/w),((R.v(0+o*(0)/w))/1b)]));b.1j=0.0+o*(0)/w;b.1k="v";b.1l="v";1s(b,B,o,1m,W)}X 5e(b,c,A,o,a){x B="M 99 61 -4b -2E Q 4c 2q -4d -2F 3G 2A -4e -2G";x W="1h";b.1i=Y(c.1a([R.v(0+o*(0)/w),R.v(0+o*(0)/w),R.v(0+o*(1)/w),((R.v(1b+o*(0)/w))/1b)]));b.1j=1.5+o*(0)/w;b.1k="v";b.1l="v";1s(b,B,o,1m,W)}X 5f(b,c,A,o,a){x B="M -4f -2L -4g -2M Q -3S -2J -4h -2K -3D -2H -4i -2I";x W="1h";b.1i=Y(c.1a([R.v(0+o*(0)/w),R.v(0+o*(0)/w),R.v(0+o*(1)/w),((R.v(1b+o*(0)/w))/1b)]));b.1j=1.5+o*(0)/w;b.1k="v";b.1l="v";1s(b,B,o,1m,W)}X 5V(b,c,A,o,a){x B="M -1c -1c -1f -1f Q -1L -1L -1P -1P -1t -1t -1e -1e -1K -1K -1d -1d -1J -1J -1O -1O -1q -1q -1d -1d -1p -1p -1e -1e -94 -94 -1U -1U -97 -97 -1T -1T -1R -1R -1S -1S -1u -1u -1Q -1Q -1H -1H -1r -1r -1c -1c -1f -1f";b.1v=Y(c.1a([R.v(0+o*(0)/w),R.v(0+o*(0)/w),R.v(0+o*(1)/w),((R.v(1b+o*(0)/w))/1b)]));1s(b,B,o,1E);b.1F("1G");x B="M -1c -1c -1f -1f Q -1H -1H -1r -1r -1u -1u -1Q -1Q -1R -1R -1S -1S -97 -97 -1T -1T -94 -94 -1U -1U -1p -1p -1e -1e -1q -1q -1d -1d -1J -1J -1O -1O -1K -1K -1d -1d -1t -1t -1e -1e -1L -1L -1P -1P -1c -1c -1f -1f";x W="1h";b.1i=Y(c.1a([R.v(0+o*(0)/w),R.v(0+o*(0)/w),R.v(0+o*(1)/w),((R.v(0+o*(0)/w))/1b)]));b.1j=0.0+o*(0)/w;b.1k="v";b.1l="v";1s(b,B,o,1m,W)}X 5W(b,c,A,o,a){x B="M 61 61 -2E -2E Q 2q 2q -2F -2F 2A 2A -2G -2G";x W="1h";b.1i=Y(c.1a([R.v(0+o*(0)/w),R.v(0+o*(0)/w),R.v(0+o*(1)/w),((R.v(1b+o*(0)/w))/1b)]));b.1j=1.5+o*(0)/w;b.1k="v";b.1l="v";1s(b,B,o,1m,W)}X 5X(b,c,A,o,a){x B="M -2L -2L -2M -2M Q -2J -2J -2K -2K -2H -2H -2I -2I";x W="1h";b.1i=Y(c.1a([R.v(0+o*(0)/w),R.v(0+o*(0)/w),R.v(0+o*(1)/w),((R.v(1b+o*(0)/w))/1b)]));b.1j=1.5+o*(0)/w;b.1k="v";b.1l="v";1s(b,B,o,1m,W)}X 5g(b,c,A,o,a){x B="M -1c -1N -1f -1V Q -1L -2z -1P -1r -1t -1M -1e -2T -1K -2U -1d -2V -1J -2x -1O -2W -1q -2p -1d -2X -1p -2t -1e -2Y -94 -83 -1U -2Z -97 -75 -1T -3a -1R -2r -1S -3b -1u -1M -1Q -3c -1H -2D -1r -3d -1c -1N -1f -1V";b.1v=Y(c.1a([R.v(0+o*(0)/w),R.v(0+o*(0)/w),R.v(0+o*(1)/w),((R.v(1b+o*(0)/w))/1b)]));1s(b,B,o,1E);b.1F("1G");x B="M -1c -1N -1f -1V Q -1H -2D -1r -3d -1u -1M -1Q -3c -1R -2r -1S -3b -97 -75 -1T -3a -94 -83 -1U -2Z -1p -2t -1e -2Y -1q -2p -1d -2X -1J -2x -1O -2W -1K -2U -1d -2V -1t -1M -1e -2T -1L -2z -1P -1r -1c -1N -1f -1V";x W="1h";b.1i=Y(c.1a([R.v(0+o*(0)/w),R.v(0+o*(0)/w),R.v(0+o*(1)/w),((R.v(0+o*(0)/w))/1b)]));b.1j=0.0+o*(0)/w;b.1k="v";b.1l="v";1s(b,B,o,1m,W)}X 5h(b,c,A,o,a){x B="M 61 99 -2E -4b Q 2q 4c -2F -4d 2A 3G -2G -4e";x W="1h";b.1i=Y(c.1a([R.v(0+o*(0)/w),R.v(0+o*(0)/w),R.v(0+o*(1)/w),((R.v(1b+o*(0)/w))/1b)]));b.1j=1.5+o*(0)/w;b.1k="v";b.1l="v";1s(b,B,o,1m,W)}X 5i(b,c,A,o,a){x B="M -2L -4f -2M -4g Q -2J -3S -2K -4h -2H -3D -2I -4i";x W="1h";b.1i=Y(c.1a([R.v(0+o*(0)/w),R.v(0+o*(0)/w),R.v(0+o*(1)/w),((R.v(1b+o*(0)/w))/1b)]));b.1j=1.5+o*(0)/w;b.1k="v";b.1l="v";1s(b,B,o,1m,W)}X 5j(b,c,A,o,a){x B="M -1N -1c -1V -1f Q -2z -1L -1r -1P -1M -1t -2T -1e -2U -1K -2V -1d -2x -1J -2W -1O -2p -1q -2X -1d -2t -1p -2Y -1e -83 -94 -2Z -1U -75 -97 -3a -1T -2r -1R -3b -1S -1M -1u -3c -1Q -2D -1H -3d -1r -1N -1c -1V -1f";b.1v=Y(c.1a([R.v(0+o*(0)/w),R.v(0+o*(0)/w),R.v(0+o*(1)/w),((R.v(1b+o*(0)/w))/1b)]));1s(b,B,o,1E);b.1F("1G");x B="M -1N -1c -1V -1f Q -2D -1H -3d -1r -1M -1u -3c -1Q -2r -1R -3b -1S -75 -97 -3a -1T -83 -94 -2Z -1U -2t -1p -2Y -1e -2p -1q -2X -1d -2x -1J -2W -1O -2U -1K -2V -1d -1M -1t -2T -1e -2z -1L -1r -1P -1N -1c -1V -1f";x W="1h";b.1i=Y(c.1a([R.v(0+o*(0)/w),R.v(0+o*(0)/w),R.v(0+o*(1)/w),((R.v(0+o*(0)/w))/1b)]));b.1j=0.0+o*(0)/w;b.1k="v";b.1l="v";1s(b,B,o,1m,W)}X 5k(b,c,A,o,a){x B="M 99 61 -4b -2E Q 4c 2q -4d -2F 3G 2A -4e -2G";x W="1h";b.1i=Y(c.1a([R.v(0+o*(0)/w),R.v(0+o*(0)/w),R.v(0+o*(1)/w),((R.v(1b+o*(0)/w))/1b)]));b.1j=1.5+o*(0)/w;b.1k="v";b.1l="v";1s(b,B,o,1m,W)}X 5l(b,c,A,o,a){x B="M -4f -2L -4g -2M Q -3S -2J -4h -2K -3D -2H -4i -2I";x W="1h";b.1i=Y(c.1a([R.v(0+o*(0)/w),R.v(0+o*(0)/w),R.v(0+o*(1)/w),((R.v(1b+o*(0)/w))/1b)]));b.1j=1.5+o*(0)/w;b.1k="v";b.1l="v";1s(b,B,o,1m,W)}X 7r(b,c,A,o,a){b.7s();b.7t(1,0,0,1,31.25,99.0);x 2m=[];x 1n=5v;A=A%1n;2n(A){y 0:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 1:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 2:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 3:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 4:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 5:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 6:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 7:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 8:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 9:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 10:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 11:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 12:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 13:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 14:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 15:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 16:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 17:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 18:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 19:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 20:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 21:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 22:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 23:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 24:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("5P",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("5Q",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("5R",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("3p",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 25:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.1w,-0.1x,-0.1x,0.1w,-9.3,-27.5],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.4j,-0.4k,0.4k,0.4j,-21.6,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.1y,0.1z,-0.1z,0.1y,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.1y,0.1z,-0.1z,0.1y,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.1y,0.1z,-0.1z,0.1y,7.f,-74.9],c,1,(0+a)%1,0,a);e("J",d,b,[0.1y,0.1z,-0.1z,0.1y,4.3,-67.95],c,1,(0+a)%1,0,a);e("5P",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,3v,a);e("j",d,b,[-0.1A,-0.1B,-0.1B,0.1A,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("5Q",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,3v,a);e("5R",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,3v,a);e("3p",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.1y,0.1z,-0.1z,0.1y,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 26:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("4T",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("4U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("4V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("3p",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 27:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.1w,-0.1x,-0.1x,0.1w,-9.4,-27.75],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.2],c,1,(0+a)%1,0,a);e("F",d,b,[0.4l,-0.4m,0.4m,0.4l,-20.65,-54.7],c,1,(0+a)%1,0,a);e("G",d,b,[0.1W,0.1X,-0.1X,0.1W,6.45,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.4n,0.4o,-0.4o,0.4n,26.55,-86.9],c,1,(0+a)%1,0,a);e("I",d,b,[0.1W,0.1X,-0.1X,0.1W,8.f,-74.8],c,1,(0+a)%1,0,a);e("J",d,b,[0.1W,0.1X,-0.1X,0.1W,5.1,-67.95],c,1,(0+a)%1,0,a);e("4T",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,2v,a);e("j",d,b,[-0.1A,-0.1B,-0.1B,0.1A,14.85,-25.1],c,1,(0+a)%1,0,a);e("S",d,b,[0.1Y,0.1Z,-0.1Z,0.1Y,7.85,-52.15],c,1,0,0,a);e("T",d,b,[0.1Y,0.1Z,-0.1Z,0.1Y,-13.15,-54.55],c,1,0,0,a);e("4U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,2v,a);e("4V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,2v,a);e("K",d,b,[0.1Y,0.1Z,-0.1Z,0.1Y,10.35,-45.55],c,1,0,0,a);e("N",d,b,[0.1Y,0.1Z,-0.1Z,0.1Y,-16.7,-48.2],c,1,(0+a)%1,0,a);e("O",d,b,[0.1W,0.1X,-0.1X,0.1W,25.4,-40.2],c,1,(0+a)%1,0,a);z;y 28:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.1w,-0.1x,-0.1x,0.1w,-9.55,-27.95],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.4],c,1,(0+a)%1,0,a);e("F",d,b,[0.3e,-0.3f,0.3f,0.3e,-19.7,-55.5],c,1,(0+a)%1,0,a);e("G",d,b,[0.1g,0.2a,-0.2a,0.1g,6.95,-58.15],c,1,(0+a)%1,0,a);e("H",d,b,[0.4p,0.4q,-0.4q,0.4p,28.45,-84.85],c,1,(0+a)%1,0,a);e("I",d,b,[0.1g,0.2a,-0.2a,0.1g,9.0,-74.8],c,1,(0+a)%1,0,a);e("J",d,b,[0.1g,0.2a,-0.2a,0.1g,5.85,-67.95],c,1,(0+a)%1,0,a);e("4T",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,2w,a);e("j",d,b,[-0.1A,-0.1B,-0.1B,0.1A,14.85,-25.3],c,1,(0+a)%1,0,a);e("S",d,b,[0.2b,0.2c,-0.2c,0.2b,8.15,-52.85],c,1,0,0,a);e("T",d,b,[0.2b,0.2c,-0.2c,0.2b,-12.75,-55.8],c,1,0,0,a);e("4U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,2w,a);e("4V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,2w,a);e("K",d,b,[0.2b,0.2c,-0.2c,0.2b,10.45,-45.45],c,1,0,0,a);e("N",d,b,[0.2b,0.2c,-0.2c,0.2b,-16.45,-48.95],c,1,(0+a)%1,0,a);e("O",d,b,[0.1g,0.2a,-0.2a,0.1g,25.8,-39.7],c,1,(0+a)%1,0,a);z;y 29:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.65,-28.25],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.55],c,1,(0+a)%1,0,a);e("F",d,b,[0.4r,-0.4s,0.4s,0.4r,-18.85,-56.3],c,1,(0+a)%1,0,a);e("G",d,b,[0.1C,0.1D,-0.1D,0.1C,7.5,-58.15],c,1,(0+a)%1,0,a);e("H",d,b,[0.1C,0.1D,-0.1D,0.1C,30.65,-82.3],c,1,(0+a)%1,0,a);e("I",d,b,[0.1C,0.1D,-0.1D,0.1C,10.0,-74.75],c,1,(0+a)%1,0,a);e("J",d,b,[0.1C,0.1D,-0.1D,0.1C,6.65,-68.0],c,1,(0+a)%1,0,a);e("4W",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-25.55],c,1,(0+a)%1,0,a);e("S",d,b,[0.2d,0.2e,-0.2e,0.2d,8.45,-53.45],c,1,0,0,a);e("T",d,b,[0.2d,0.2e,-0.2e,0.2d,-12.4,-57.f],c,1,0,0,a);e("4X",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("4Y",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.2d,0.2e,-0.2e,0.2d,10.6,-45.35],c,1,0,0,a);e("N",d,b,[0.2d,0.2e,-0.2e,0.2d,-16.25,-49.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.1C,0.1D,-0.1D,0.1C,26.25,-39.15],c,1,(0+a)%1,0,a);z;y 30:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.1w,-0.1x,-0.1x,0.1w,-9.5,-28.0],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.4],c,1,(0+a)%1,0,a);e("F",d,b,[0.3e,-0.3f,0.3f,0.3e,-19.75,-55.5],c,1,(0+a)%1,0,a);e("G",d,b,[0.1g,0.2f,-0.2f,0.1g,7.1,-58.15],c,1,(0+a)%1,0,a);e("H",d,b,[0.4t,0.4u,-0.4u,0.4t,29.15,-84.f],c,1,(0+a)%1,0,a);e("I",d,b,[0.1g,0.2f,-0.2f,0.1g,9.0,-74.8],c,1,(0+a)%1,0,a);e("J",d,b,[0.1g,0.2f,-0.2f,0.1g,5.85,-68.0],c,1,(0+a)%1,0,a);e("4W",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,2v,a);e("j",d,b,[-0.1A,-0.1B,-0.1B,0.1A,14.85,-25.3],c,1,(0+a)%1,0,a);e("S",d,b,[0.2g,0.2h,-0.2h,0.2g,8.15,-52.8],c,1,0,0,a);e("T",d,b,[0.2g,0.2h,-0.2h,0.2g,-12.85,-55.75],c,1,0,0,a);e("4X",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,2v,a);e("4Y",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,2v,a);e("K",d,b,[0.2g,0.2h,-0.2h,0.2g,10.4,-45.4],c,1,0,0,a);e("N",d,b,[0.2g,0.2h,-0.2h,0.2g,-16.45,-48.95],c,1,(0+a)%1,0,a);e("O",d,b,[0.1g,0.2f,-0.2f,0.1g,25.8,-39.65],c,1,(0+a)%1,0,a);z;y 31:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.1w,-0.1x,-0.1x,0.1w,-9.35,-27.8],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.2],c,1,(0+a)%1,0,a);e("F",d,b,[0.4v,-0.4w,0.4w,0.4v,-20.65,-54.75],c,1,(0+a)%1,0,a);e("G",d,b,[0.2i,0.2j,-0.2j,0.2i,6.55,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.4x,0.4y,-0.4y,0.4x,27.25,-86.f],c,1,(0+a)%1,0,a);e("I",d,b,[0.2i,0.2j,-0.2j,0.2i,8.f,-74.85],c,1,(0+a)%1,0,a);e("J",d,b,[0.2i,0.2j,-0.2j,0.2i,5.1,-67.9],c,1,(0+a)%1,0,a);e("4W",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,2w,a);e("j",d,b,[-0.1A,-0.1B,-0.1B,0.1A,14.85,-25.1],c,1,(0+a)%1,0,a);e("S",d,b,[0.2k,0.2l,-0.2l,0.2k,7.9,-52.15],c,1,0,0,a);e("T",d,b,[0.2k,0.2l,-0.2l,0.2k,-13.15,-54.65],c,1,0,0,a);e("4X",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,2w,a);e("4Y",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,2w,a);e("K",d,b,[0.2k,0.2l,-0.2l,0.2k,10.35,-45.55],c,1,0,0,a);e("N",d,b,[0.2k,0.2l,-0.2l,0.2k,-16.65,-48.2],c,1,(0+a)%1,0,a);e("O",d,b,[0.2i,0.2j,-0.2j,0.2i,25.35,-40.15],c,1,(0+a)%1,0,a);z;y 32:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 33:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 34:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 35:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 36:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 37:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 38:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 39:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 40:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 41:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 42:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 43:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 44:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 45:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 46:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 47:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 48:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 49:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 50:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 51:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("4Z",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 52:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 53:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 54:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 55:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 56:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 57:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 58:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("4Z",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 59:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 60:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 61:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 62:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 63:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 64:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 65:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 66:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 67:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 68:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 69:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 70:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 71:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 72:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 73:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 74:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 75:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 76:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 77:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 78:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 79:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 80:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 81:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 82:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 83:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 84:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("5S",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("5T",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("5U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("3p",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 85:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.1w,-0.1x,-0.1x,0.1w,-9.3,-27.5],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.4j,-0.4k,0.4k,0.4j,-21.6,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.1y,0.1z,-0.1z,0.1y,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.1y,0.1z,-0.1z,0.1y,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.1y,0.1z,-0.1z,0.1y,7.f,-74.9],c,1,(0+a)%1,0,a);e("J",d,b,[0.1y,0.1z,-0.1z,0.1y,4.3,-67.95],c,1,(0+a)%1,0,a);e("5S",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,3v,a);e("j",d,b,[-0.1A,-0.1B,-0.1B,0.1A,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("5T",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,3v,a);e("5U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,3v,a);e("3p",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.1y,0.1z,-0.1z,0.1y,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 86:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("5a",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("5b",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("5c",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("3p",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 87:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.1w,-0.1x,-0.1x,0.1w,-9.4,-27.75],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.2],c,1,(0+a)%1,0,a);e("F",d,b,[0.4l,-0.4m,0.4m,0.4l,-20.65,-54.7],c,1,(0+a)%1,0,a);e("G",d,b,[0.1W,0.1X,-0.1X,0.1W,6.45,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.4n,0.4o,-0.4o,0.4n,26.55,-86.9],c,1,(0+a)%1,0,a);e("I",d,b,[0.1W,0.1X,-0.1X,0.1W,8.f,-74.8],c,1,(0+a)%1,0,a);e("J",d,b,[0.1W,0.1X,-0.1X,0.1W,5.1,-67.95],c,1,(0+a)%1,0,a);e("5a",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,2v,a);e("j",d,b,[-0.1A,-0.1B,-0.1B,0.1A,14.85,-25.1],c,1,(0+a)%1,0,a);e("S",d,b,[0.1Y,0.1Z,-0.1Z,0.1Y,7.85,-52.15],c,1,0,0,a);e("T",d,b,[0.1Y,0.1Z,-0.1Z,0.1Y,-13.15,-54.55],c,1,0,0,a);e("5b",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,2v,a);e("5c",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,2v,a);e("K",d,b,[0.1Y,0.1Z,-0.1Z,0.1Y,10.35,-45.55],c,1,0,0,a);e("N",d,b,[0.1Y,0.1Z,-0.1Z,0.1Y,-16.7,-48.2],c,1,(0+a)%1,0,a);e("O",d,b,[0.1W,0.1X,-0.1X,0.1W,25.4,-40.2],c,1,(0+a)%1,0,a);z;y 88:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.1w,-0.1x,-0.1x,0.1w,-9.55,-27.95],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.4],c,1,(0+a)%1,0,a);e("F",d,b,[0.3e,-0.3f,0.3f,0.3e,-19.7,-55.5],c,1,(0+a)%1,0,a);e("G",d,b,[0.1g,0.2a,-0.2a,0.1g,6.95,-58.15],c,1,(0+a)%1,0,a);e("H",d,b,[0.4p,0.4q,-0.4q,0.4p,28.45,-84.85],c,1,(0+a)%1,0,a);e("I",d,b,[0.1g,0.2a,-0.2a,0.1g,9.0,-74.8],c,1,(0+a)%1,0,a);e("J",d,b,[0.1g,0.2a,-0.2a,0.1g,5.85,-67.95],c,1,(0+a)%1,0,a);e("5a",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,2w,a);e("j",d,b,[-0.1A,-0.1B,-0.1B,0.1A,14.85,-25.3],c,1,(0+a)%1,0,a);e("S",d,b,[0.2b,0.2c,-0.2c,0.2b,8.15,-52.85],c,1,0,0,a);e("T",d,b,[0.2b,0.2c,-0.2c,0.2b,-12.75,-55.8],c,1,0,0,a);e("5b",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,2w,a);e("5c",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,2w,a);e("K",d,b,[0.2b,0.2c,-0.2c,0.2b,10.45,-45.45],c,1,0,0,a);e("N",d,b,[0.2b,0.2c,-0.2c,0.2b,-16.45,-48.95],c,1,(0+a)%1,0,a);e("O",d,b,[0.1g,0.2a,-0.2a,0.1g,25.8,-39.7],c,1,(0+a)%1,0,a);z;y 89:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.65,-28.25],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.55],c,1,(0+a)%1,0,a);e("F",d,b,[0.4r,-0.4s,0.4s,0.4r,-18.85,-56.3],c,1,(0+a)%1,0,a);e("G",d,b,[0.1C,0.1D,-0.1D,0.1C,7.5,-58.15],c,1,(0+a)%1,0,a);e("H",d,b,[0.1C,0.1D,-0.1D,0.1C,30.65,-82.3],c,1,(0+a)%1,0,a);e("I",d,b,[0.1C,0.1D,-0.1D,0.1C,10.0,-74.75],c,1,(0+a)%1,0,a);e("J",d,b,[0.1C,0.1D,-0.1D,0.1C,6.65,-68.0],c,1,(0+a)%1,0,a);e("5d",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-25.55],c,1,(0+a)%1,0,a);e("S",d,b,[0.2d,0.2e,-0.2e,0.2d,8.45,-53.45],c,1,0,0,a);e("T",d,b,[0.2d,0.2e,-0.2e,0.2d,-12.4,-57.f],c,1,0,0,a);e("5e",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("5f",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.2d,0.2e,-0.2e,0.2d,10.6,-45.35],c,1,0,0,a);e("N",d,b,[0.2d,0.2e,-0.2e,0.2d,-16.25,-49.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.1C,0.1D,-0.1D,0.1C,26.25,-39.15],c,1,(0+a)%1,0,a);z;y 90:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.1w,-0.1x,-0.1x,0.1w,-9.5,-28.0],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.4],c,1,(0+a)%1,0,a);e("F",d,b,[0.3e,-0.3f,0.3f,0.3e,-19.75,-55.5],c,1,(0+a)%1,0,a);e("G",d,b,[0.1g,0.2f,-0.2f,0.1g,7.1,-58.15],c,1,(0+a)%1,0,a);e("H",d,b,[0.4t,0.4u,-0.4u,0.4t,29.15,-84.f],c,1,(0+a)%1,0,a);e("I",d,b,[0.1g,0.2f,-0.2f,0.1g,9.0,-74.8],c,1,(0+a)%1,0,a);e("J",d,b,[0.1g,0.2f,-0.2f,0.1g,5.85,-68.0],c,1,(0+a)%1,0,a);e("5d",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,2v,a);e("j",d,b,[-0.1A,-0.1B,-0.1B,0.1A,14.85,-25.3],c,1,(0+a)%1,0,a);e("S",d,b,[0.2g,0.2h,-0.2h,0.2g,8.15,-52.8],c,1,0,0,a);e("T",d,b,[0.2g,0.2h,-0.2h,0.2g,-12.85,-55.75],c,1,0,0,a);e("5e",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,2v,a);e("5f",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,2v,a);e("K",d,b,[0.2g,0.2h,-0.2h,0.2g,10.4,-45.4],c,1,0,0,a);e("N",d,b,[0.2g,0.2h,-0.2h,0.2g,-16.45,-48.95],c,1,(0+a)%1,0,a);e("O",d,b,[0.1g,0.2f,-0.2f,0.1g,25.8,-39.65],c,1,(0+a)%1,0,a);z;y 91:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.1w,-0.1x,-0.1x,0.1w,-9.35,-27.8],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.2],c,1,(0+a)%1,0,a);e("F",d,b,[0.4v,-0.4w,0.4w,0.4v,-20.65,-54.75],c,1,(0+a)%1,0,a);e("G",d,b,[0.2i,0.2j,-0.2j,0.2i,6.55,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.4x,0.4y,-0.4y,0.4x,27.25,-86.f],c,1,(0+a)%1,0,a);e("I",d,b,[0.2i,0.2j,-0.2j,0.2i,8.f,-74.85],c,1,(0+a)%1,0,a);e("J",d,b,[0.2i,0.2j,-0.2j,0.2i,5.1,-67.9],c,1,(0+a)%1,0,a);e("5d",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,2w,a);e("j",d,b,[-0.1A,-0.1B,-0.1B,0.1A,14.85,-25.1],c,1,(0+a)%1,0,a);e("S",d,b,[0.2k,0.2l,-0.2l,0.2k,7.9,-52.15],c,1,0,0,a);e("T",d,b,[0.2k,0.2l,-0.2l,0.2k,-13.15,-54.65],c,1,0,0,a);e("5e",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,2w,a);e("5f",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,2w,a);e("K",d,b,[0.2k,0.2l,-0.2l,0.2k,10.35,-45.55],c,1,0,0,a);e("N",d,b,[0.2k,0.2l,-0.2l,0.2k,-16.65,-48.2],c,1,(0+a)%1,0,a);e("O",d,b,[0.2i,0.2j,-0.2j,0.2i,25.35,-40.15],c,1,(0+a)%1,0,a);z;y 92:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 93:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("5V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("5W",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("5X",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("3p",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 94:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.1w,-0.1x,-0.1x,0.1w,-9.3,-27.5],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.4j,-0.4k,0.4k,0.4j,-21.6,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.1y,0.1z,-0.1z,0.1y,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.1y,0.1z,-0.1z,0.1y,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.1y,0.1z,-0.1z,0.1y,7.f,-74.9],c,1,(0+a)%1,0,a);e("J",d,b,[0.1y,0.1z,-0.1z,0.1y,4.3,-67.95],c,1,(0+a)%1,0,a);e("5V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,3v,a);e("j",d,b,[-0.1A,-0.1B,-0.1B,0.1A,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("5W",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,3v,a);e("5X",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,3v,a);e("3p",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.1y,0.1z,-0.1z,0.1y,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 95:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("5g",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("5h",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("5i",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("3p",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 96:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.1w,-0.1x,-0.1x,0.1w,-9.4,-27.75],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.2],c,1,(0+a)%1,0,a);e("F",d,b,[0.4l,-0.4m,0.4m,0.4l,-20.65,-54.7],c,1,(0+a)%1,0,a);e("G",d,b,[0.1W,0.1X,-0.1X,0.1W,6.45,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.4n,0.4o,-0.4o,0.4n,26.55,-86.9],c,1,(0+a)%1,0,a);e("I",d,b,[0.1W,0.1X,-0.1X,0.1W,8.f,-74.8],c,1,(0+a)%1,0,a);e("J",d,b,[0.1W,0.1X,-0.1X,0.1W,5.1,-67.95],c,1,(0+a)%1,0,a);e("5g",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,2v,a);e("j",d,b,[-0.1A,-0.1B,-0.1B,0.1A,14.85,-25.1],c,1,(0+a)%1,0,a);e("S",d,b,[0.1Y,0.1Z,-0.1Z,0.1Y,7.85,-52.15],c,1,0,0,a);e("T",d,b,[0.1Y,0.1Z,-0.1Z,0.1Y,-13.15,-54.55],c,1,0,0,a);e("5h",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,2v,a);e("5i",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,2v,a);e("K",d,b,[0.1Y,0.1Z,-0.1Z,0.1Y,10.35,-45.55],c,1,0,0,a);e("N",d,b,[0.1Y,0.1Z,-0.1Z,0.1Y,-16.7,-48.2],c,1,(0+a)%1,0,a);e("O",d,b,[0.1W,0.1X,-0.1X,0.1W,25.4,-40.2],c,1,(0+a)%1,0,a);z;y 97:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.1w,-0.1x,-0.1x,0.1w,-9.55,-27.95],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.4],c,1,(0+a)%1,0,a);e("F",d,b,[0.3e,-0.3f,0.3f,0.3e,-19.7,-55.5],c,1,(0+a)%1,0,a);e("G",d,b,[0.1g,0.2a,-0.2a,0.1g,6.95,-58.15],c,1,(0+a)%1,0,a);e("H",d,b,[0.4p,0.4q,-0.4q,0.4p,28.45,-84.85],c,1,(0+a)%1,0,a);e("I",d,b,[0.1g,0.2a,-0.2a,0.1g,9.0,-74.8],c,1,(0+a)%1,0,a);e("J",d,b,[0.1g,0.2a,-0.2a,0.1g,5.85,-67.95],c,1,(0+a)%1,0,a);e("5g",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,2w,a);e("j",d,b,[-0.1A,-0.1B,-0.1B,0.1A,14.85,-25.3],c,1,(0+a)%1,0,a);e("S",d,b,[0.2b,0.2c,-0.2c,0.2b,8.15,-52.85],c,1,0,0,a);e("T",d,b,[0.2b,0.2c,-0.2c,0.2b,-12.75,-55.8],c,1,0,0,a);e("5h",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,2w,a);e("5i",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,2w,a);e("K",d,b,[0.2b,0.2c,-0.2c,0.2b,10.45,-45.45],c,1,0,0,a);e("N",d,b,[0.2b,0.2c,-0.2c,0.2b,-16.45,-48.95],c,1,(0+a)%1,0,a);e("O",d,b,[0.1g,0.2a,-0.2a,0.1g,25.8,-39.7],c,1,(0+a)%1,0,a);z;y 98:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.65,-28.25],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.55],c,1,(0+a)%1,0,a);e("F",d,b,[0.4r,-0.4s,0.4s,0.4r,-18.85,-56.3],c,1,(0+a)%1,0,a);e("G",d,b,[0.1C,0.1D,-0.1D,0.1C,7.5,-58.15],c,1,(0+a)%1,0,a);e("H",d,b,[0.1C,0.1D,-0.1D,0.1C,30.65,-82.3],c,1,(0+a)%1,0,a);e("I",d,b,[0.1C,0.1D,-0.1D,0.1C,10.0,-74.75],c,1,(0+a)%1,0,a);e("J",d,b,[0.1C,0.1D,-0.1D,0.1C,6.65,-68.0],c,1,(0+a)%1,0,a);e("5j",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-25.55],c,1,(0+a)%1,0,a);e("S",d,b,[0.2d,0.2e,-0.2e,0.2d,8.45,-53.45],c,1,0,0,a);e("T",d,b,[0.2d,0.2e,-0.2e,0.2d,-12.4,-57.f],c,1,0,0,a);e("5k",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("5l",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.2d,0.2e,-0.2e,0.2d,10.6,-45.35],c,1,0,0,a);e("N",d,b,[0.2d,0.2e,-0.2e,0.2d,-16.25,-49.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.1C,0.1D,-0.1D,0.1C,26.25,-39.15],c,1,(0+a)%1,0,a);z;y 99:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.1w,-0.1x,-0.1x,0.1w,-9.5,-28.0],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.4],c,1,(0+a)%1,0,a);e("F",d,b,[0.3e,-0.3f,0.3f,0.3e,-19.75,-55.5],c,1,(0+a)%1,0,a);e("G",d,b,[0.1g,0.2f,-0.2f,0.1g,7.1,-58.15],c,1,(0+a)%1,0,a);e("H",d,b,[0.4t,0.4u,-0.4u,0.4t,29.15,-84.f],c,1,(0+a)%1,0,a);e("I",d,b,[0.1g,0.2f,-0.2f,0.1g,9.0,-74.8],c,1,(0+a)%1,0,a);e("J",d,b,[0.1g,0.2f,-0.2f,0.1g,5.85,-68.0],c,1,(0+a)%1,0,a);e("5j",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,2v,a);e("j",d,b,[-0.1A,-0.1B,-0.1B,0.1A,14.85,-25.3],c,1,(0+a)%1,0,a);e("S",d,b,[0.2g,0.2h,-0.2h,0.2g,8.15,-52.8],c,1,0,0,a);e("T",d,b,[0.2g,0.2h,-0.2h,0.2g,-12.85,-55.75],c,1,0,0,a);e("5k",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,2v,a);e("5l",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,2v,a);e("K",d,b,[0.2g,0.2h,-0.2h,0.2g,10.4,-45.4],c,1,0,0,a);e("N",d,b,[0.2g,0.2h,-0.2h,0.2g,-16.45,-48.95],c,1,(0+a)%1,0,a);e("O",d,b,[0.1g,0.2f,-0.2f,0.1g,25.8,-39.65],c,1,(0+a)%1,0,a);z;y 3t:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.1w,-0.1x,-0.1x,0.1w,-9.35,-27.8],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.2],c,1,(0+a)%1,0,a);e("F",d,b,[0.4v,-0.4w,0.4w,0.4v,-20.65,-54.75],c,1,(0+a)%1,0,a);e("G",d,b,[0.2i,0.2j,-0.2j,0.2i,6.55,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.4x,0.4y,-0.4y,0.4x,27.25,-86.f],c,1,(0+a)%1,0,a);e("I",d,b,[0.2i,0.2j,-0.2j,0.2i,8.f,-74.85],c,1,(0+a)%1,0,a);e("J",d,b,[0.2i,0.2j,-0.2j,0.2i,5.1,-67.9],c,1,(0+a)%1,0,a);e("5j",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,2w,a);e("j",d,b,[-0.1A,-0.1B,-0.1B,0.1A,14.85,-25.1],c,1,(0+a)%1,0,a);e("S",d,b,[0.2k,0.2l,-0.2l,0.2k,7.9,-52.15],c,1,0,0,a);e("T",d,b,[0.2k,0.2l,-0.2l,0.2k,-13.15,-54.65],c,1,0,0,a);e("5k",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,2w,a);e("5l",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,2w,a);e("K",d,b,[0.2k,0.2l,-0.2l,0.2k,10.35,-45.55],c,1,0,0,a);e("N",d,b,[0.2k,0.2l,-0.2l,0.2k,-16.65,-48.2],c,1,(0+a)%1,0,a);e("O",d,b,[0.2i,0.2j,-0.2j,0.2i,25.35,-40.15],c,1,(0+a)%1,0,a);z;y 3k:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 2o:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 3C:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 3s:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 3g:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 3n:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 2t:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 3w:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 3B:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 3y:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 2s:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 1p:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 4A:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 3J:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 3X:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 5B:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 3W:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 3K:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 5N:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 2S:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 3z:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("4Z",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 2Q:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 3Y:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 4G:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 2O:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 2u:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 3M:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 3E:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 3i:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 2C:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 1q:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 5J:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 2p:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 2P:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 3Z:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 3o:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 4P:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 3u:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 5t:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 4M:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 3r:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 3l:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 2r:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z;y 4O:e("D",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("i",d,b,[0.k,0.l,0.l,-0.k,-2.8,-12.7],c,1,(0+a)%1,0,a);e("i",d,b,[0.m,0.n,0.n,-0.m,4.6,-10.75],c,1,(0+a)%1,0,a);e("j",d,b,[-0.p,-0.q,-0.q,0.p,-9.3,-27.55],c,1,(0+a)%1,0,a);e("E",d,b,[0.f,0.0,0.0,0.f,1.4,-23.f],c,1,(0+a)%1,0,a);e("F",d,b,[0.t,-0.u,0.u,0.t,-21.55,-53.9],c,1,(0+a)%1,0,a);e("G",d,b,[0.g,0.h,-0.h,0.g,6.0,-58.2],c,1,(0+a)%1,0,a);e("H",d,b,[0.g,0.h,-0.h,0.g,25.1,-88.6],c,1,(0+a)%1,0,a);e("I",d,b,[0.g,0.h,-0.h,0.g,7.f,-74.95],c,1,(0+a)%1,0,a);e("J",d,b,[0.g,0.h,-0.h,0.g,4.3,-67.95],c,1,(0+a)%1,0,a);e("U",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("j",d,b,[-0.r,-0.s,-0.s,0.r,14.85,-24.85],c,1,(0+a)%1,0,a);e("S",d,b,[0.f,0.0,0.0,0.f,7.55,-51.6],c,1,0,0,a);e("T",d,b,[0.f,0.0,0.0,0.f,-13.55,-53.35],c,1,0,0,a);e("V",d,b,[0.f,0.0,0.0,0.f,0.0,0.0],c,1,0,0,a);e("K",d,b,[0.f,0.0,0.0,0.f,10.2,-45.7],c,1,0,0,a);e("N",d,b,[0.f,0.0,0.0,0.f,-16.9,-47.6],c,1,(0+a)%1,0,a);e("O",d,b,[0.g,0.h,-0.h,0.g,24.9,-40.75],c,1,(0+a)%1,0,a);z}b.7u()}x A=-1;x a=0;x C=[];C.P(0);C.P(1);C.P(2);C.P(3);C.P(4);C.P(5);C.P(6);C.P(7);C.P(8);C.P(9);C.P(10);C.P(11);C.P(12);C.P(13);C.P(14);C.P(15);C.P(16);C.P(17);C.P(18);C.P(19);C.P(20);C.P(21);C.P(22);C.P(23);C.P(24);C.P(25);C.P(26);C.P(27);C.P(28);C.P(29);C.P(30);C.P(31);C.P(32);C.P(33);C.P(34);C.P(35);C.P(36);C.P(37);C.P(38);C.P(39);C.P(40);C.P(41);C.P(42);C.P(43);C.P(44);C.P(45);C.P(46);C.P(47);C.P(48);C.P(49);C.P(50);C.P(51);C.P(52);C.P(53);C.P(54);C.P(55);C.P(56);C.P(57);C.P(58);C.P(59);C.P(60);C.P(61);C.P(62);C.P(63);C.P(64);C.P(65);C.P(66);C.P(67);C.P(68);C.P(69);C.P(70);C.P(71);C.P(72);C.P(73);C.P(74);C.P(75);C.P(76);C.P(77);C.P(78);C.P(79);C.P(80);C.P(81);C.P(82);C.P(83);C.P(84);C.P(85);C.P(86);C.P(87);C.P(88);C.P(89);C.P(90);C.P(91);C.P(92);C.P(93);C.P(94);C.P(95);C.P(96);C.P(97);C.P(98);C.P(99);C.P(3t);C.P(3k);C.P(2o);C.P(3C);C.P(3s);C.P(3g);C.P(3n);C.P(2t);C.P(3w);C.P(3B);C.P(3y);C.P(2s);C.P(1p);C.P(4A);C.P(3J);C.P(3X);C.P(5B);C.P(3W);C.P(3K);C.P(5N);C.P(2S);C.P(3z);C.P(2Q);C.P(3Y);C.P(4G);C.P(2O);C.P(2u);C.P(3M);C.P(3E);C.P(3i);C.P(2C);C.P(1q);C.P(5J);C.P(2p);C.P(2P);C.P(3Z);C.P(3o);C.P(4P);C.P(3u);C.P(5t);C.P(4M);C.P(3r);C.P(3l);C.P(2r);C.P(4O);x 7v="#9t";x 7w=77;x 7x=3g;X 5Y(b,c){x 7y=A;A=(A+1)%C.9u;9v(A==7y){a++}9w{a=0};7z()}X 7z(){b.1v=7v;b.9x(0,0,d.7A,d.7B);b.7s();b.7t(d.7A/7w,0,0,d.7B/7x,0,0);7r(b,c,C[A],0,a);b.7u()}9y.9z(X(){5Y(b,c)},62);5Y(b,c);',
            62, 594,
            '||||||||||time|ctx|ctrans|canvas|place|05|049896240234375|00305328369140625|sprite175|sprite179|048693084716796876|0111083984375|04920501708984375|0085113525390625|ratio|0383209228515625|031903076171875|048974609375|0095367431640625|04918670654296875|008712005615234376|round|65535|var|case|break|frame|pathData|frames|shape1|sprite189|sprite193|sprite197|sprite201|sprite205|sprite207|shape212|||sprite214|sprite218|push||Math|shape209|shape210|shape208|shape211|scaleMode|function|tocolor||||||||||||apply|255|207|744|762|807|0496124267578125|NORMAL|strokeStyle|lineWidth|lineCap|lineJoin|true|frame_cnt|drawPath|112|131|820|drawMorphPath|195|189|fillStyle|03822784423828125|0318878173828125|04988555908203125|003052520751953125|04894561767578125|009523773193359375|0494232177734375|00740966796875|false|fill|evenodd|206|158|155|179|210|211|221|743|781|777|172|734|788|780|852|0497772216796875|004395294189453125|0499725341796875|00134735107421875|||||||||||00589599609375|049898529052734376|002855682373046875|04979248046875|004378509521484375|00589752197265625|04989776611328125|0028564453125|049776458740234376|00439453125|04997177124023437|001348876953125|clips|switch|102|133|182|143|111|107|126|21845|43691|162|152|227|281|219|130|216|1254|1257|1184|222|1276|289|1285|346|1245|176|125|134|122|157|120|795|193|770|767|765|786|806|||||||||||834|857|880|866|04959869384765625|00569610595703125|105|165|129|160|101|142|213|106|136|shape222|244|141|104|100|138|32768|108|171|110|121|200|109|103|181|128|212|312|228|177|114|118|180|127|245|184|199|254|229|246|201|168|173|117|115|123|135|||||||||||270|1308|220|1300|1219|307|1314|1349|1334|04916305541992187|008684539794921875|04940338134765625|00719451904296875|04979782104492188|0041595458984375|049640655517578125|005661773681640625|049745941162109376|00436859130859375|0495819091796875|006131744384765625|049404144287109375|0071929931640625|049738311767578126|0047943115234375|205|113|164|235|214|183|190|124|241|159|153|264|167|140|154|144|137|248|198|174|morphshape223|morphshape224|morphshape225|morphshape226|morphshape227|morphshape228|shape229|||||||||||morphshape233|morphshape234|morphshape235|morphshape236|morphshape237|morphshape238|morphshape242|morphshape243|morphshape244|morphshape245|morphshape246|morphshape247|285|398|381|146|197|194|170|139|239|145|217|249|271|274|230|116|178|185|188|202|233|258|238|132|509|523|169|119|325|morphshape219|morphshape220|morphshape221|morphshape230|morphshape231|morphshape232|morphshape239|morphshape240|morphshape241|nextFrame|266|||||||||||shape172|sprite173|shape174|994140625|10467529296875|shape176|sprite177|shape178|shape180|261|sprite181|shape182|148|sprite183|shape184|240|sprite185|shape186|204|sprite187|shape188|288|265|232|277|187|286|291|shape190|237|161|sprite191|shape192|149|208|256|shape194|518|424|488|sprite195|shape196|490|234|480|454|491|shape198|sprite199|shape200|shape202|576|||||||||||sprite203|shape204|536|247|shape206|787|742|754|763|801|14901961|shape213|shape215|sprite216|shape217|272|299|sprite248|save|transform|restore|backgroundColor|originalWidth|originalHeight|oldframe|drawFrame|width|height|150|242|191|283|156|278|295|251|223|250|314|316|253|49803922|175|186|294|280|203|151|428|269|493|300|||||||||||358|485|545|417|418|551|451|425|421|297|353|504|540|420|413|554|444|343|410|517|414|309|621|613|595|362|355|447|442|521|670|630|481|402|305|303|395|635|653|661|455|348|404|464|494|495|497|531|542|327|487|333|||||||||||373|433|548|450|329|257|54901963|163|166|252|218|1025|1073|1060|1074|263|1108|319|1080|c6481d|length|if|else|fillRect|window|setInterval'
            .split('|'), 0, {}));
        //El numero c6481d es el color de fondo del FRAME
    }

</script>
