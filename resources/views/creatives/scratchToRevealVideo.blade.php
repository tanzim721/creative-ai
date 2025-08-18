<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="{{ asset('img/icon.jpeg') }}" type="image/x-icon">
    <title>{{ $creative->creative_type->name }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .contain {
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            padding-top: 150px;
        }

        .main {
            width: 300px;
            height: 250px;
            position: relative;
            overflow: hidden;
            cursor: pointer;
        }

        #scratchCanvas {
            width: 300px;
            height: 250px;
            cursor: pointer;
            position: absolute;
            top: 0;
            left: 0;
        }

        .image-container {
            position: relative;
            width: 300px;
            height: 250px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .overlay_container {
            position: absolute;
            width: 300px;
            height: 250px;
            background-color: transparent;
            z-index: 1;
        }

        #hiddenImage {
            width: 300px;
            height: 250px;
            z-index: 1;
            object-fit: fill;
        }

        canvas {
            width: 300px;
            height: 250px;
            z-index: 999;
        }

        #sound {
            position: absolute;
            z-index: 99;
            width: 30px;
            bottom: 7px;
            right: 7px;
        }

        .header {
            background-color: #e63946;
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .gradient_bg {
            min-height: 100vh;
            background: rgb(11, 34, 64);
            background: radial-gradient(circle, rgba(11, 34, 64, 1) 0%, rgba(9, 14, 22, 1) 65%);
        }
    </style>
    @php
        $images = json_decode($creative->image, true);
        $countImages = count($images);
        $videos = json_decode($creative->video, true);
        $countVideos = count($videos);
    @endphp
</head>

<body>


    <div class="gradient_bg relative">
        <div id="remove" class="header bg-[#2D3A43]">Create creative with AI</div>
        <div class="contain flex flex-col gap-3 items-center justify-start">
            <div class="main">
                <div class="image-container">
                    <video id="hiddenImage" class="object-cover" src="{{ asset('uploads/' . $videos[0]) }}" autoplay
                        muted loop>
                    </video>
                    <img id="sound"
                        src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/3f/Mute_Icon.svg/480px-Mute_Icon.svg.png"
                        alt="" />
                    <canvas id="scratchCanvas" width="300" height="250"></canvas>
                    <div class="overlay_container flex flex-col justify-between items-center py-2 px-2"></div>
                </div>
                <a href="{{ $creative->landing_url }}" target="_blank" id="cta_btn"
                    class="bg-blue-600 text-white px-7 py-1.5 text-xs rounded-lg absolute"
                    style="z-index: 99; top: 90%; left: 50%; transform: translate(-50%, -50%);">
                    {{ $creative->cta_name ?? 'Click' }}
                </a>
            </div>
            <div id="remove3" class="w-[290px]">
                <div class="flex flex-col items-start text-white mt-2">
                    <div class="checkbox-group flex flex-col">
                        <h3>Available Dimention:</h3>

                        <label class="cursor-pointer">
                            <input type="radio" name="options" value="1" checked />
                            300x250
                        </label>
                    </div>

                    <div id="remove2" class="mt-4 d-flex justify-content-center">
                        @if (isset($subscription) && $subscription->status == 'active')
                            <button class="bg-blue-600 text-white px-7 py-1.5 text-md rounded-lg" id="download-btn">
                                Download
                            </button>
                        @else
                            <button class="bg-blue-600 text-white px-7 py-1.5 text-md rounded-lg" id="download-btn"
                                disabled>
                                Download
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            // Global Variables
            var img = new Image();
            img.crossOrigin = "anonymous";
            img.src = "{{ asset('uploads/' . $images[0]) }}";

            var canvas = document.getElementById("scratchCanvas");
            var ctx = canvas.getContext("2d");
            var isScratching = false;

            // Set up canvas size after the image loads
            img.onload = function() {
                canvas.width = 300; // Set the canvas width to the image's width
                canvas.height = 250; // Set the canvas height to the image's height

                // Draw the image on the canvas
                ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
                ctx.globalCompositeOperation = "destination-out"; // Allow scratching effect
            };

            // Event listeners for mouse interaction
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
                    checkScratchCompletion(); // Check completion when mouse is released
                });

            // Event listeners for touch interaction
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
                var imageData = ctx.getImageData(0, 0, canvas.width, canvas.height); // Get pixel data
                var totalPixels = imageData.data.length / 4;
                for (var i = 0; i < totalPixels; i++) {
                    if (imageData.data[i * 4 + 3] === 0) {
                        scratchedArea++;
                    }
                }

                var scratchPercentage = (scratchedArea / totalPixels) * 100;

                console.log("Scratch Percentage: " + scratchPercentage);

                // If scratched area exceeds 20%, hide the canvas
                if (scratchPercentage > 5) {
                    document.getElementById("sound").style.zIndex = 99999;
                }
                if (scratchPercentage > 20) {
                    document.getElementById("cta_btn").style.zIndex = 99999;
                }
            }
        });

        document.getElementById("sound").addEventListener("click", function() {
            var img = document.getElementById("sound");
            var video = document.getElementById("hiddenImage");

            // Toggle mute/unmute
            if (video.muted) {
                video.muted = false;
                img.src = "https://pngimg.com/d/sound_PNG22.png";
            } else {
                video.muted = true; // Mute the video
                img.src =
                    "https://upload.wikimedia.org/wikipedia/commons/thumb/3/3f/Mute_Icon.svg/480px-Mute_Icon.svg.png"; // Change to mute icon
            }
        });

        document.getElementById("download-btn").addEventListener("click", function() {
            var pageContent = document.documentElement.outerHTML;

            // Remove specific sections by IDs
            pageContent = pageContent.replace(/<div id="remove".*?>.*?<\/div>/s, '');
            pageContent = pageContent.replace(/<div id="remove2".*?>.*?<\/div>/s, '');
            pageContent = pageContent.replace(/<div id="remove3".*?>.*?<\/div>/s, '');


            // Track the download first using a more robust CSRF approach
            let csrfToken = "{{ csrf_token() }}"; // Get token from Blade template directly

            fetch('/customer/track-download', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        creative_id: {{ $creative->id }},
                        content_type: '{{ $creative->creative_type->name }}'
                    })
                })
                .then(response => response.json())
                .catch(error => console.error('Error tracking download:', error));

            // Create a new instance of JSZip
            var zip = new JSZip();

            // Add the HTML file to the ZIP
            zip.file("index.html", pageContent);

            // Generate the ZIP file and trigger download
            zip.generateAsync({
                type: "blob"
            }).then(function(blob) {
                saveAs(blob,
                "{{ $creative->creative_type->name }}.zip"); // Save the ZIP file as creative.zip
            });
        });
    </script>
</body>

</html>
