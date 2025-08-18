<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
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
            width: 480px;
            height: 320px;
            overflow: hidden;
        }

        .swiper {
            width: 220px;
            height: 200px;
            padding: 15px;
        }

        .swiper-slide {
            background: transparent;
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

        .rotate-animation {
            display: inline-block;
            /* Ensures smooth animation */
            animation: rotate-left-right 3s infinite;
        }

        @keyframes rotate-left-right {
            0% {
                transform: rotate(100deg);
            }

            60% {
                transform: rotate(-15deg);
            }

            100% {
                transform: rotate(100deg);
            }
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
        $countImages = count($images);
    @endphp

    <div class="contain gradient_bg relative flex flex-col">
        <div id="remove" class="header bg-[#2D3A43] absolute top-0 w-full">
            Create creative with AI
        </div>
        <div class="main flex">
            <div class="basis-6/12 border bg-zinc-200 flex flex-col gap-3 items-center pt-3">
                <img src="https://cdn-icons-png.flaticon.com/512/4603/4603384.png" alt=""
                    class="w-8 rotate-animation" />
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        @foreach ($images as $image)
                            <div class="swiper-slide">
                                <img src="{{ asset('uploads/' . $image) }}" alt=""
                                    class="w-full h-full object-cover" />
                            </div>
                        @endforeach
                    </div>
                </div>
                <button class="px-6 py-1 bg-orange-500 text-white font-semibold rounded-md">
                    <a href="{{ $creative->landing_url }}" target="_blank">{{ $creative->cta_name ?? 'Click' }}</a>
                </button>
            </div>
            <div class="basis-7/12 border">
                <img src="{{ asset('uploads/' . $images[5]) }}" alt="ADS" class="w-full h-full object-cover" />
            </div>
        </div>
        <div id="remove2" class="mt-6 d-flex justify-content-center">
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

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            loop: true,
        });

        document.getElementById("download-btn").addEventListener("click", function() {
            var pageContent = document.documentElement.outerHTML;

            // Remove specific divs with ids "remove" and "remove2"
            pageContent = pageContent.replace(/<div id="remove".*?>.*?<\/div>/s, '');
            pageContent = pageContent.replace(/<div id="remove2".*?>.*?<\/div>/s, '');


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
            const zip = new JSZip();

            // Add the HTML content as a file to the zip archive
            zip.file("index.html", pageContent);

            // Generate the zip file and trigger the download
            zip.generateAsync({
                type: "blob"
            }).then(function(content) {
                const link = document.createElement("a");
                link.href = URL.createObjectURL(content);
                link.download = "creative.zip"; // Set the zip file name
                link.click();
            });
        });
    </script>

</body>

</html>
