<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="icon" href="{{ asset('img/icon.jpeg') }}" type="image/x-icon">
    <title>{{ $creative->creative_type->name }}</title>
    <style>
        .game_container {
            width: 320px;
            height: 480px;
            position: relative;
            overflow: hidden;
        }

        iframe {
            width: 320px;
            height: 480px;
            object-fit: cover;
        }

        .d-none {
            opacity: 0;
            visibility: hidden;
            transition: opacity 1s ease-in-out, visibility 0s linear 1s;
        }

        .d-show {
            opacity: 1;
            visibility: visible;
        }

        img {
            position: absolute;
            width: 320px;
            height: 480px;
            left: 0;
            top: 0%;
            object-fit: cover;
            clip-path: inset(0 0 5% 0);
        }

        .click {
            width: 100%;
            height: 150px;
            position: absolute;
            bottom: 0;
            display: none;
        }

        .gradient_bg {
            background: rgb(11, 34, 64);
            background: radial-gradient(circle, rgba(11, 34, 64, 1) 0%, rgba(9, 14, 22, 1) 65%);
        }

        .header {
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body>
    @php
        $images = json_decode($creative->image, true);
    @endphp
    <div class="gradient_bg w-full min-h-screen flex flex-col items-center py-20">
        <div id="remove3" class="header bg-[#2D3A43] absolute w-full top-0">Create creative with AI</div>
        <div class="w-full relative flex flex-col items-center">
            <div class="game_container">
                <div class="click" id="click"></div>
                <iframe src="https://d2v3eqx6ppywls.cloudfront.net/toucan_games/roadmad/index.html" id="gameIframe" frameborder="0"
                    class=""></iframe>
                <a>
                    <img src="{{ asset('uploads/' . $images[0]) }}" alt="" class="d-none" />
                </a>
                <a href="{{ $creative->landing_url }}" target="_blank">
                    <button id="cta_btn"
                        class="bg-blue-600 text-white px-5 py-1 text-sm rounded-lg cursor-pointer absolute z-50 bottom-7 left-1/2 -translate-x-1/2 d-none">{{ $creative->cta_name }}</button></a>
            </div>
            <div class="">
                <div id="remove" class="flex flex-col items-start text-white mt-2">
                    <div class="checkbox-group">
                        <h3>Select Dimensions:</h3>
                        <label class="cursor-pointer">
                            <input type="checkbox" name="options" value="1" /> 320x480
                        </label><br>
                        <label class="cursor-pointer">
                            <input type="checkbox" name="options" value="2" /> 300x300
                        </label><br>
                        <label class="cursor-pointer">
                            <input type="checkbox" name="options" value="3" /> 300x250
                        </label><br>
                        <label class="cursor-pointer">
                            <input type="checkbox" name="options" value="4" /> 250x250
                        </label>
                    </div>

                    <div id="remove2" class="mt-4 d-flex justify-content-center">
                        @if (isset($subscription) && $subscription->status == 'active' && $subscription->downloads_used < $subscription->plan->monthly_download_limit)
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
    <script>
        setTimeout(() => {
            document.querySelector("iframe").src = ""
            document.querySelector("iframe").classList.add("d-none");
            let img = document.querySelector("img");
            img.classList.remove("d-none");
            img.classList.add("d-show", "animate__animated", "animate__backInUp");
            setTimeout(() => {
                document.querySelector('#cta_btn').classList.remove('d-none')
            }, 1000)
        }, 15000);


        let pageContent = document.documentElement.outerHTML;

        document.getElementById("download-btn").addEventListener("click", function() {
            const selectedOptions = document.querySelectorAll('input[name="options"]:checked');

            if (selectedOptions.length === 0) {
                alert("Please select at least one dimension.");
                return;
            }

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
                const selectedValue = option.value;
                let dimensions = {};

                switch (selectedValue) {
                    case "1":
                        dimensions = {
                            width: "320px",
                            height: "480px"
                        };
                        break;
                    case "2":
                        dimensions = {
                            width: "300px",
                            height: "300px"
                        };
                        break;
                    case "3":
                        dimensions = {
                            width: "300px",
                            height: "250px"
                        };
                        break;
                    case "4":
                        dimensions = {
                            width: "250px",
                            height: "250px"
                        };
                        break;
                }

                // Update dimensions for images
                pageContent = pageContent
                    .replace(/\.game_container\s*{[^}]*}/, function() {
                        return `.game_container {
                            width: ${dimensions.width};
                            height: ${dimensions.height};
                            position: relative;
                            overflow: hidden;
                        }`;
                    })
                pageContent = pageContent
                    .replace(/\img \s*{[^}]*}/, function() {
                        return `img  {
                                    position: absolute;
                                    width: ${dimensions.width};
                                    height: ${dimensions.height};
                                    left: 0;
                                    top: 0%;
                                    object-fit: cover;
                                    clip-path: inset(0 0 5% 0);
                                }`;
                    })
                pageContent = pageContent
                    .replace(/\iframe \s*{[^}]*}/, function() {
                        return `iframe  {
                                    width: ${dimensions.width};
                                    height: ${dimensions.height};
                                    object-fit: cover;
                                }`;
                    })

                /// Remove unnecessary sections
                pageContent = pageContent.replace(/<div id="remove2".*?>.*?<\/div>/s, "");
                pageContent = pageContent.replace(/<div id="remove".*?>.*?<\/div>/s, "");
                pageContent = pageContent.replace(/<div id="remove3".*?>.*?<\/div>/s, "");

                // Generate a unique filename based on the dimension
                const fileName = `index_${dimensions.width}x${dimensions.height}.html`;
                zip.file(fileName, pageContent);
            });

            // Generate the ZIP file and trigger download
            zip.generateAsync({
                type: "blob"
            }).then(function(content) {
                saveAs(content, "creative_dimensions.zip");
            });
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
</body>

</html>
