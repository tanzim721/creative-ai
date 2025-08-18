<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="{{ asset('img/icon.jpeg') }}" type="image/x-icon">
    <title>{{ $creative->creative_type->name }}</title>
    <style>
        * {
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
        }

        .contain {
            width: 100%;
            height: 100vh;
            display: flex;
            flex-direction: column;
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
            background-color: #2d3a43;
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        video {
            width: 300px;
            height: 300px;
            object-fit: cover;
        }

        .parent {
            position: relative;
            display: flex;
            justify-content: center;
        }

        .update {
            position: absolute;
            top: 2%;
            height: 7px;
            width: 90%;
            background: #c7c7c7;
            border-radius: 8px;
        }

        .updated {
            height: 100%;
            width: 0%;
            background: #ffffff93;
            border-radius: 8px;
            transition: width 0.1s ease-out;
        }

        button {
            position: absolute;
            bottom: 10%;
            padding: 10px 40px;
            font-weight: 600;
            background-color: #3b82f6;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .dimension-container {
            width: 290px;
        }

        .flex-container {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            color: white;
            margin-top: 10px;
        }

        .checkbox-group {
            display: flex;
            flex-direction: column;
        }

        .checkbox-group h3 {
            margin-bottom: 10px;
        }

        label {
            cursor: pointer;
            margin-bottom: 5px;
        }

        .button-container {
            margin-top: 5px;
            display: flex;
            justify-content: center;
            padding-left: 30px;
        }

        .download-btn {
            background-color: #2563eb;
            color: white;
            padding: 8px 28px;
            font-size: 16px;
            border-radius: 8px;
            border: none;
        }

        .download-btn:hover {
            background-color: #1d4ed8;
        }
    </style>
</head>

<body>
    @php
        $videos = json_decode($creative->video, true);
        $countVideos = count($videos);
    @endphp
    <!-- Video Element -->
    <div class="contain">
        <div id="remove" class="header">Create creative with AI</div>
        <div class="parent">
            <video autoplay muted controls loop src="{{ asset('uploads/' . $videos[0]) }}"></video>
            <div class="update">
                <div class="updated"></div>
            </div>
            <button id="cta-btn"
                class="bg-blue-600 text-white px-4 rounded-md hover:bg-blue-700 transition duration-150 ease-in-out">
                <a href="{{ $creative->landing_url }}" style="text-decoration: none; color: white"
                    target="_blank">{{ $creative->cta_name ?? 'Click' }}</a>
            </button>
        </div>
        <div id="remove3" class="dimension-container">
            <div class="flex-container">
                <div class="checkbox-group">
                    <h3>Available Dimension:</h3>

                    <label class="cursor-pointer">
                        <input type="checkbox" name="options" value="1" />
                        250x300
                    </label>
                    <label class="cursor-pointer">
                        <input type="checkbox" name="options" value="2" />
                        320x480
                    </label>
                    <label class="cursor-pointer">
                        <input type="checkbox" name="options" value="3" checked />
                        300x300
                    </label>
                    <label class="cursor-pointer">
                        <input type="checkbox" name="options" value="4" />
                        250x250
                    </label>
                    <div id="remove2" class="button-container">
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
    <script>
        const video = document.querySelector("video");
        const updatedBar = document.querySelector(".updated");

        video.play().catch((error) => {
            console.warn("Autoplay was blocked:", error);
        });

        video.addEventListener("timeupdate", () => {
            const progress = (video.currentTime / video.duration) * 100;
            updatedBar.style.width = progress + "%";
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

            // Create a ZIP file
            const zip = new JSZip();

            selectedOptions.forEach(option => {
                const value = option.value;
                let newHeight = "300px";
                let newWidth = "250px";

                if (value === "1") {
                    newHeight = "300px";
                    newWidth = "250px";
                } else if (value === "2") {
                    newHeight = "480px";
                    newWidth = "320px";
                } else if (value === "3") {
                    newHeight = "300px";
                    newWidth = "300px";
                } else if (value === "4") {
                    newHeight = "250px";
                    newWidth = "250px";
                }

                let pageContent = document.documentElement.outerHTML;

                // Update styles for video dimensions
                pageContent = pageContent.replace(
                    /video\s*{[^}]*}/,
                    `video {
                        width: ${newWidth};
                        height: ${newHeight};
                        object-fit: cover;
                    }`
                );

                // Remove unnecessary sections
                pageContent = pageContent.replace(/<div id="remove".*?>.*?<\/div>/s, "");
                pageContent = pageContent.replace(/<div id="remove3".*?>.*?<\/div>/s, "");
                pageContent = pageContent.replace(/<div id="remove2".*?>.*?<\/div>/s, "");

                // Add the file to the zip
                zip.file(`index_${value}.html`, pageContent);
            });

            // Generate the zip file and download it
            zip.generateAsync({
                type: "blob"
            }).then(function(content) {
                const link = document.createElement("a");
                link.href = URL.createObjectURL(content);
                link.download = "creative_files.zip";
                link.click();
            });
        });
    </script>

</body>

</html>
