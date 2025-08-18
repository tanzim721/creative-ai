<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-    <link rel="icon" href="{{ asset('img/icon.jpeg') }}" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            background: rgb(11, 34, 64);
            background: radial-gradient(circle, rgba(11, 34, 64, 1) 0%, rgba(9, 14, 22, 1) 65%);
        }

        .main {
            width: 300px;
            height: 250px;
            background-color: #d9d9d9;
            overflow: hidden;
        }

        .ads {
            width: 100%;
            height: 100%;
            cursor: pointer;
            position: relative;
        }

        img {
            min-width: 100%;
            min-height: 100%;
            object-fit: cover;
        }

        .d-none {
            display: none;
        }

        #click {
            position: absolute;
            display: flex;
            justify-content: center;
            align-items: center;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        #click img {
            width: 50px;
            height: 50px;
            animation: clickAnimation 1.4s infinite;
        }

        @keyframes clickAnimation {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.08);
            }

            100% {
                transform: scale(1);
            }
        }

        .map {
            width: 100%;
            height: 100%;
        }

        iframe {
            width: 100%;
            height: 100%;
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
    </style>
</head>

<body>
    @php
        $images = json_decode($creative->image, true);
        $countImages = count($images);
    @endphp
    <div class="contain flex flex-col">
        <div id="remove" class="header bg-[#2D3A43]">Create creative with AI</div>
        <div class="main">
            <div class="ads">
                <img src="{{ asset('uploads/' . $images[0]) }}" alt="">
                <div id="click">
                    <img src="https://cdn-icons-png.flaticon.com/512/10187/10187222.png" alt="">
                </div>
            </div>
            <div class="map d-none">
                {{-- <iframe
                    src="{{ $creative->landing_url }}"
                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe> --}}

                <iframe src="{{ $creative->landing_url }}" width="600" height="450" style="border:0;"
                    allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
        <div id="remove3" class="w-[290px]">
            <div class="flex flex-col items-start text-white mt-2">
                <div class="checkbox-group flex flex-col">
                    <h3>Available Dimention:</h3>

                    <label class="cursor-pointer">
                        <input type="checkbox" name="options" value="1" checked />
                        250x300
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
    <script src="https://cdn.jsdelivr.net/npm/jszip@3.7.1/dist/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
    <script>
        document.querySelector('.ads').addEventListener('click', function() {
            document.querySelector('.ads').classList.add('d-none')
            document.querySelector('.map').classList.remove('d-none')
        })

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

                
            const zip = new JSZip();

            // Collect the selected files and modify dimensions
            selectedOptions.forEach(function(option) {
                const selectedValue = option.value;
                let fileName = '';
                let fileContent = document.documentElement.outerHTML;

                // Define the width and height based on the selected option
                let newHeight = "300px";
                let newWidth = "250px";

                if (selectedValue === "1") {
                    fileName = "300x250.html";
                } else if (selectedValue === "2") {
                    newHeight = "480px";
                    newWidth = "320px";
                    fileName = "480x320.html";
                } else if (selectedValue === "3") {
                    newHeight = "300px";
                    newWidth = "300px";
                    fileName = "300x300.html";
                } else if (selectedValue === "4") {
                    newHeight = "250px";
                    newWidth = "250px";
                    fileName = "250x250.html";
                }

                // Modify the HTML content to update the width and height dynamically
                fileContent = fileContent.replace(/\.main\s*\{[^}]*\}/, function(match) {
                    return `.main { width: ${newWidth}; height: ${newHeight}; background-color: #d9d9d9; }`;
                });

                // Remove unnecessary divs
                fileContent = fileContent.replace(/<div id="remove".*?>.*?<\/div>/s, '');
                fileContent = fileContent.replace(/<div id="remove2".*?>.*?<\/div>/s, '');
                fileContent = fileContent.replace(/<div id="remove3".*?>.*?<\/div>/s, '');

                // Add the file content to the zip
                zip.file(fileName, fileContent);
            });

            // Generate and download the zip
            zip.generateAsync({
                    type: "blob"
                })
                .then(function(content) {
                    saveAs(content, "creatives.zip");
                });
        });
    </script>
</body>

</html>
