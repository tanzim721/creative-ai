<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" href="{{ asset('img/icon.jpeg') }}" type="image/x-icon">
    <title>{{ $creative->creative_type->name }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container {
            width: 100%;
            margin: auto;
            padding: 30px 0px;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: transparent;
        }

        .main {
            width: 1200px;
            min-height: 90vh;
            background: #fff;
            padding-top: 0px;
            padding-left: 10px;
            padding-right: 10px;
            padding-bottom: 10px;
            border-radius: 5px;
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
        }

        .icon_container {
            width: 100%;
            height: 7%;
            display: flex;
            justify-content: end;
            padding: 5px;
        }

        .content {
            width: 100%;
            height: 93%;
        }

        #icon {
            width: 35px;
            height: 100%;
            object-fit: cover;
            cursor: pointer;
        }

        .d-none {
            display: none;
        }

        .image-container {
            position: relative;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .overlay_container {
            position: absolute;
            width: 100%;
            height: 100%;
            background-color: transparent;
            z-index: 1;
        }

        #hiddenImage {
            position: absolute;
            width: 100%;
            height: 100%;
            display: block;
            z-index: 1;
        }

        #scratchCanvas {
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        canvas {
            z-index: 3;
        }

        .gradient_bg {
            min-height: 100vh;
            background: rgb(11, 34, 64);
            background: radial-gradient(circle, rgba(11, 34, 64, 1) 0%, rgba(9, 14, 22, 1) 65%);
        }

        .header {
            background-color: #2D3A43;
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .btn_container {
            width: 100%;
            display: flex;
            justify-content: center;
            padding-bottom: 40px;
        }

        .btn_custom {
            background-color: #2563eb;
            color: white;
            padding: 0.475rem 1.75rem;
            font-size: 1rem;
            border-radius: 0.5rem;
            cursor: pointer;
            margin-top: 10px;
        }
    </style>
</head>

<body class="gradient_bg">
    @php
        $images = json_decode($creative->image, true);
        $countImages = count($images);
    @endphp
    <div id="remove" class="header">Create creative with AI</div>
    <div class="container">
        <div class="main">
            <div class="icon_container">
                <img id="icon" src="https://static.thenounproject.com/png/861785-200.png" alt="" />
            </div>
            <div class="content">
                <div class="image-container">
                    <img id="hiddenImage" src="{{ asset('uploads/' . $images[0]) }}" alt="Creative 2" />
                    <canvas id="scratchCanvas"></canvas>
                    <div class="overlay_container flex flex-col justify-between items-center py-2 px-2"></div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div id="remove2" class="btn_container">
            <button class="btn_custom" id="download-btn">Download as
                HTML</button>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        document.getElementById("icon").addEventListener("click", function() {
            document.querySelector(".container").classList.add("d-none");
            document.querySelector(".main").classList.add("d-none");
        });

        $(document).ready(function() {
            var canvas = document.getElementById("scratchCanvas");
            var ctx = canvas.getContext("2d");
            var isScratching = false;

            var img = new Image();
            img.src =
                "{{ asset('uploads/' . $images[1]) }}";

            img.onload = function() {
                var mainDiv = document.querySelector(".main");
                canvas.width = mainDiv.offsetWidth;
                canvas.height = mainDiv.offsetHeight;
                ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
                ctx.globalCompositeOperation = "destination-out";
            };
            $("#scratchCanvas")
                .on("mousedown", function(e) {
                    isScratching = true;
                })
                .on("mousemove", function(e) {
                    if (isScratching) {
                        var x = e.offsetX;
                        var y = e.offsetY;
                        ctx.beginPath();
                        ctx.arc(x, y, 30, 0, Math.PI * 2);
                        ctx.fill();
                    }
                })
                .on("mouseup", function(e) {
                    isScratching = false;
                    checkScratchCompletion();
                });

            $("#scratchCanvas")
                .on("touchstart", function(e) {
                    isScratching = true;
                })
                .on("touchmove", function(e) {
                    if (isScratching) {
                        var touch = e.touches[0];
                        var x = touch.pageX - $(this).offset().left;
                        var y = touch.pageY - $(this).offset().top;
                        ctx.beginPath();
                        ctx.arc(x, y, 30, 0, Math.PI * 2);
                        ctx.fill();
                    }
                })
                .on("touchend", function(e) {
                    isScratching = false;
                    checkScratchCompletion();
                });

            function checkScratchCompletion() {
                var scratchedArea = 0;
                var imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
                var totalPixels = imageData.data.length / 2;
                for (var i = 0; i < totalPixels; i++) {
                    if (imageData.data[i * 4 + 3] === 0) {
                        scratchedArea++;
                    }
                }
                var scratchPercentage = (scratchedArea / totalPixels) * 100;
                if (scratchPercentage > 50) {
                    // alert("You've scratched enough!");
                }
            }
        });

        document.getElementById("download-btn").addEventListener("click", function() {
            var pageContent = document.documentElement.outerHTML;

            pageContent = pageContent.replace(/<div id="remove".*?>.*?<\/div>/s, '');
            pageContent = pageContent.replace(/<div id="remove2".*?>.*?<\/div>/s, '');

            const blob = new Blob([pageContent], {
                type: 'text/html'
            });

            const link = document.createElement("a");
            link.href = URL.createObjectURL(blob);
            link.download = "index.html";
            link.click();
        });
    </script>
</body>

</html>
