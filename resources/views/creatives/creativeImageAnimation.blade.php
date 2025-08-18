<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="{{ asset('img/icon.jpeg') }}" type="image/x-icon">
    <title>{{ $creative->creative_type->name }}</title>
    @php
        $images = json_decode($creative->image, true);
        $countImages = count($images);
    @endphp
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .d-none {
            display: none;
        }

        .contain {
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: rgb(11, 34, 64);
            background: radial-gradient(circle, rgba(11, 34, 64, 1) 0%, rgba(9, 14, 22, 1) 65%);
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

        .main {
            width: 300px;
            height: 250px;
            overflow: hidden;
        }

        #pic1 {
            background-image: url({{ asset('uploads/' . $images[0]) }});
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            animation: leftToRight 2.3s linear forwards;
        }

        #pic2 {
            background-image: url({{ asset('uploads/' . $images[1]) }});
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            animation: rightToLeft 2.3s linear forwards;
            z-index: 99;
        }

        #pic3 {
            background-image: url({{ asset('uploads/' . $images[2]) }});
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            animation: topToBottom 2.3s linear forwards;
        }

        #pic4 {
            animation: toTop 2.3s linear forwards;
            z-index: 999;
        }

        @keyframes leftToRight {
            0% {
                left: -190px;
            }

            100% {
                left: 0px;
            }
        }

        @keyframes rightToLeft {
            0% {
                right: -135px;
            }

            100% {
                right: 0px;
            }
        }

        @keyframes topToBottom {
            0% {
                right: -135px;
            }

            100% {
                right: 0px;
            }
        }

        @keyframes down1 {
            0% {
                top: 0px;
            }

            100% {
                top: 250px;
            }
        }

        @keyframes down2 {
            0% {
                top: 0px;
            }

            100% {
                top: 250px;
            }
        }

        @keyframes down3 {
            0% {
                top: 150px;
            }

            100% {
                top: 250px;
            }
        }

        @keyframes toTop {
            0% {
                top: 250px;
            }

            100% {
                top: 0px;
            }
        }
    </style>
</head>
<body>
    <div class="contain flex flex-col gap-3">
        <div id="remove" class="header bg-[#2D3A43]">Create creative with AI</div>
        <div class="main flex relative">
            <div class="h-full basis-7/12 relative">
                <div class="w-full h-full absolute" id="pic1"></div>
            </div>
            <div class="w-full h-full basis-5/12 flex flex-col relative">
                <div class="w-full h-full basis-1/2">
                    <div class="w-full h-[50%] bg-pink-500 absolute" id="pic2"></div>
                </div>
                <div class="w-full h-full basis-1/2">
                    <div class="w-full h-[50%] bg-purple-500 absolute" id="pic3"></div>
                </div>
            </div>
            <div class="absolute w-full h-full d-none" id="pic4">
                <a href="{{ $creative->landing_url }}"><img src="{{ asset('uploads/' . $images[3]) }}" alt="" class="w-full h-full object-cover"></a>
                <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 w-full flex justify-center items-center">
                    <button class="bg-blue-600 text-white px-4 py-1 text-sm rounded-lg">
                        <a href="{{ $creative->landing_url }}" style="text-decoration: none; color: white;" target="_blank">{{ $creative->cta_name ?? 'Click' }}</a>
                    </button>
                </div>
            </div>
        </div>
        <div id="remove3" class="w-[290px] flex justify-center">
            <div id="remove2" class="mt-4 d-flex justify-content-center text-white">
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
                @if ($subscription->status == 'active')
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
        setTimeout(() => {
            document.querySelector("#pic1").style.animation = "down1 2.3s linear forwards";
            document.querySelector("#pic2").style.animation = "down2 2.3s linear forwards";
            document.querySelector("#pic3").style.animation = "down3 2.3s linear forwards";
        }, 2300);
        setTimeout(() => {
            document.querySelector("#pic4").classList.remove("d-none");
        }, 3000);

        document.getElementById("download-btn").addEventListener("click", function() {

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

                
            var zip = new JSZip();
            var selectedCheckboxes = document.querySelectorAll('input[type="checkbox"]:checked');
            var htmlFiles = [];

            selectedCheckboxes.forEach(function(checkbox) {
                var optionValue = checkbox.value;
                var pageContent = document.documentElement.outerHTML;

                // Remove unwanted divs
                pageContent = pageContent.replace(/<div id="remove".*?>.*?<\/div>/s, '');
                pageContent = pageContent.replace(/<div id="remove2".*?>.*?<\/div>/s, '');
                pageContent = pageContent.replace(/<div id="remove3".*?>.*?<\/div>/s, '');

                // Add content to the ZIP
                zip.file("creative-" + optionValue + ".html", pageContent);
            });

            // Generate the ZIP file and trigger download
            zip.generateAsync({ type: "blob" }).then(function(content) {
                saveAs(content, "creatives.zip");
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/jszip@3.7.1/dist/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
</body>
</html>
