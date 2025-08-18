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
            align-items: center;
        }

        .main {
            width: 300px;
            height: 250px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            place-content: end;
            position: relative;
            overflow: hidden;
            cursor: pointer;
        }

        video {
            width: 50%;
            max-height: 120px;
            position: absolute;
            bottom: 0;
            left: 0;
            transition: all 0.5s ease;
            transform: translateX(0%);
            transform-origin: bottom;
            z-index: 99;
        }

        .main:hover video {
            height: 60%;
            width: 85%;
            top: 10%;
            left: 50%;
            transform: translateX(-50%);
        }

        img {
            width: 50%;
            max-height: 120px;
            position: absolute;
            bottom: 0;
            right: 0;
            transition: all 0.5s ease;
            transform-origin: bottom right;
            overflow: hidden;
        }

        .main:hover img {
            min-height: 100%;
            width: 100%;
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
            background: radial-gradient(circle,
                    rgba(11, 34, 64, 1) 0%,
                    rgba(9, 14, 22, 1) 65%);
        }
    </style>
</head>

<body>
    @php
        $images = json_decode($creative->image, true);
        $videos = $creative->video ? json_decode($creative->video, true) : [];
    @endphp
    <div class="contain gradient_bg relative flex flex-col gap-2">
        <div id="remove" class="header bg-[#2D3A43] absolute top-0 w-full">
            Create creative with AI
        </div>
        <div class="main">
            @if (!empty($videos[0]))
                <video id="video" class="object-fill" autoplay muted loop>
                    <source src="{{ asset('uploads/' . $videos[0]) }}" type="video/mp4" />
                    Your browser does not support the video tag.
                </video>
            @endif
            <img src="{{ asset('uploads/' . $images[0]) }}" alt="" />
        </div>
        <div class="w-[290px]">
            <div id="remove2" class="flex flex-col items-start text-white mt-2">
                <div class="checkbox-group flex flex-col">
                    <h3>Available Dimention:</h3>

                    <label class="cursor-pointer">
                        <input type="checkbox" name="options" value="1" checked />
                        300x250
                    </label>
                    <label class="cursor-pointer">
                        <input type="checkbox" name="options" value="2" />
                        320x480
                    </label>
                    <label class="cursor-pointer">
                        <input type="checkbox" name="options" value="3" />
                        300x300
                    </label>
                    <label class="cursor-pointer">
                        <input type="checkbox" name="options" value="4" />
                        250x250
                    </label>
                </div>

                <div id="remove3" class="mt-4 d-flex justify-content-center">
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

    <script>
        const video = document.getElementById("video");
        const main = document.querySelector(".main");

        main.addEventListener("mouseenter", function() {
            video.controls = true;
            video.muted = false;
            video.play();
        });

        main.addEventListener("mouseleave", function() {
            video.controls = false;
            video.muted = true;
        });

        document.getElementById("download-btn").addEventListener("click", function() {
            const selectedOptions = Array.from(
                document.querySelectorAll('input[name="options"]:checked')
            ).map((option) => option.value);

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

            const zip = new JSZip();

            selectedOptions.forEach((option) => {
                let newWidth = "300px";
                let newHeight = "250px";

                if (option === "1") {
                    newWidth = "300px";
                    newHeight = "250px";
                } else if (option === "2") {
                    newWidth = "320px";
                    newHeight = "480px";
                } else if (option === "3") {
                    newWidth = "300px";
                    newHeight = "300px";
                } else if (option === "4") {
                    newWidth = "250px";
                    newHeight = "250px";
                }

                let pageContent = document.documentElement.outerHTML;

                pageContent = pageContent.replace(/\.main\s*{[^}]*}/, function(match) {
                    return `.main {
                    width: ${newWidth};
                    height: ${newHeight};
                    display: grid;
                    grid-template-columns: 1fr 1fr;
                    place-content: end;
                    position: relative;
                    overflow: hidden;
                    cursor: pointer;
                }`;
                });

                // Remove unnecessary elements
                pageContent = pageContent.replace(/<div id="remove".*?>.*?<\/div>/s, "");
                pageContent = pageContent.replace(/<div id="remove2".*?>.*?<\/div>/s, "");
                pageContent = pageContent.replace(/<div id="remove3".*?>.*?<\/div>/s, "");

                const fileName = `creative_${newWidth}x${newHeight}.html`;
                zip.file(fileName, pageContent);
            });

            zip.generateAsync({
                type: "blob"
            }).then(function(blob) {
                saveAs(blob, "creatives.zip");
            });
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
</body>

</html>
