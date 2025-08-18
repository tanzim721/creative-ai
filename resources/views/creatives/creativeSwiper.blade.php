<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jszip@3.7.1/dist/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
    <link rel="icon" href="{{ asset('img/icon.jpeg') }}" type="image/x-icon">
    <title>{{ $creative->creative_type->name }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .contain {
            height: 100vh;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background: rgb(11, 34, 64);
            background: radial-gradient(circle,
                    rgba(11, 34, 64, 1) 0%,
                    rgba(9, 14, 22, 1) 65%);
        }

        .header {
            position: absolute;
            top: 0;
            width: 100%;
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .parent {
            width: 320px;
            height: 100px;
            background-color: rgba(204, 203, 203, 0.89);
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 8px;
        }

        .logo_container {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        img {
            width: 65px;
        }

        .btn_container {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .button {
            width: 90px;
            height: 27px;
            border-radius: 20px;
            border: none;
            background-color: rgba(255, 68, 0, 0.89);
            color: #fff;
            cursor: pointer;
        }

        .swiper {
            width: 90px;
            height: 100%;
        }

        .swiper-slide {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .swiper-slide img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
</head>

<body>
    @php
        $images = json_decode($creative->image, true);
        $countImages = count($images);
    @endphp
    <div class="contain flex flex-col gap-4">
        <div id="remove" class="header bg-[#2D3A43]">
            Create creative with AI
        </div>
        <div class="parent">
            <div class="logo_container">
                <img src="{{ asset('uploads/'.$images[0]) }}" alt="" />
            </div>
            <div class="carousel">
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img src="{{ asset('uploads/'.$images[1]) }}" alt="" />
                        </div>
                        <div class="swiper-slide">
                            <img src="{{ asset('uploads/'.$images[2]) }}" alt="" />
                        </div>
                        <div class="swiper-slide">
                            <img src="{{ asset('uploads/'.$images[3]) }}" alt="" />
                        </div>
                        <div class="swiper-slide">
                            <img src="{{ asset('uploads/'.$images[4]) }}" alt="" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="btn_container">
                <a href="#">
                    <button class="button">
                        <a href="{{ $creative->landing_url }}" style="text-decoration: none; color: white" target="_blank">{{ $creative->cta_name ?? 'Click' }}</a>
                    </button>
                </a>
            </div>
        </div>
        <div id="remove3" class="w-[350px] flex justify-center">
            <div id="remove2" class="flex flex-col items-start text-white m-2">
                <div class="checkbox-group flex flex-col mb-2">
                    <h3>Available Dimention:</h3>
                    <label class="cursor-pointer">
                        <input type="checkbox" name="options" value="1" checked />
                        300x250
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

    <script>
        var swiper = new Swiper(".mySwiper", {
            autoplay: {
                delay: 2000,
                disableOnInteraction: false,
            },
            loop: true,
        });

        document.getElementById("download-btn").addEventListener("click", function() {
            const selectedOptions = document.querySelectorAll('input[name="options"]:checked');


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

            // Create a new JSZip instance
            const zip = new JSZip();
            
            selectedOptions.forEach(function(option) {
                const selectedValue = option.value;
                let newWidth = "250px";
                let newHeight = "300px";
                let fileName = "";

                if (selectedValue === "1") {
                    newWidth = "250px";
                    newHeight = "300px";
                    fileName = "250x300.html";
                } else if (selectedValue === "3") {
                    newWidth = "300px";
                    newHeight = "300px";
                    fileName = "300x300.html";
                } else if (selectedValue === "4") {
                    newWidth = "250px";
                    newHeight = "250px";
                    fileName = "250x250.html";
                }

                let pageContent = document.documentElement.outerHTML;

                pageContent = pageContent.replace(/\.main\s*\{[^}]*\}/, function(match) {
                    return `.main { width: ${newWidth}; height: ${newHeight}; background-color: #d9d9d9; }`;
                });

                pageContent = pageContent.replace(/<div id="remove".*?>.*?<\/div>/s, '');
                pageContent = pageContent.replace(/<div id="remove2".*?>.*?<\/div>/s, '');
                pageContent = pageContent.replace(/<div id="remove3".*?>.*?<\/div>/s, '');

                zip.file(fileName, pageContent);
            });

            zip.generateAsync({ type: "blob" }).then(function(content) {
                saveAs(content, "creatives.zip");
            });
        });
    </script>
</body>

</html>
