<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
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

        .contain {
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: rgb(11, 34, 64);
            background: radial-gradient(circle, rgba(11, 34, 64, 1) 0%, rgba(9, 14, 22, 1) 65%);
        }

        .parent {
            width: 300px;
            height: 250px;
            display: flex;
            gap: 5px;
        }

        .child1,
        .child2,
        .child3,
        .child4,
        .child5 {
            border: 1px solid #9e9e9e;
            height: 100%;
            border-radius: 25px;
            flex: 1;
            transition: flex-basis 0.4s ease, background-color 0.4s ease;
            cursor: pointer;
        }

        .child1 {
            background-image: url({{ asset('uploads/' . $images[0]) }});
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
        }

        .child2 {
            background-image: url({{ asset('uploads/' . $images[1]) }});
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
        }

        .child3 {
            background-image: url({{ asset('uploads/' . $images[2]) }});
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
        }

        .child4 {
            background-image: url({{ asset('uploads/' . $images[3]) }});
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
        }

        .child5 {
            background-image: url({{ asset('uploads/' . $images[4]) }});
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
        }


        .basis-5/12 {
            flex-basis: 41.66%;
            /* Matches Tailwind's 5/12 */
            background-color: lightblue;
            /* Optional visual feedback */
        }
    </style>
</head>

<body>
    <div class="contain flex flex-col">
        <div id="remove" class="header bg-[#2D3A43]">Create creative with AI</div>
        <div class="parent">
            <div class="child1 flex-1 basis-5/12 relative flex justify-center">
                <a href={{ $creative->landing_url }} target="_blank"
                    class="bg-blue-600 text-white px-7 py-1 text-xs rounded-lg absolute bottom-4 mx-auto">{{ $creative->cta_name ?? 'Click' }}</a>
            </div>
            <div class="child2 flex-1 relative flex justify-center">
                <a href={{ $creative->landing_url }} target="_blank"
                    class="bg-blue-600 text-white px-7 py-1 text-xs rounded-lg absolute bottom-4 mx-auto">{{ $creative->cta_name ?? 'Click' }}</a>
            </div>
            <div class="child3 flex-1 relative flex justify-center">
                <a href={{ $creative->landing_url }} target="_blank"
                    class="bg-blue-600 text-white px-7 py-1 text-xs rounded-lg absolute bottom-4 mx-auto">{{ $creative->cta_name ?? 'Click' }}</a>
            </div>
            <div class="child4 flex-1 relative flex justify-center">
                <a href={{ $creative->landing_url }} target="_blank"
                    class="bg-blue-600 text-white px-7 py-1 text-xs rounded-lg absolute bottom-4 mx-auto">{{ $creative->cta_name ?? 'Click' }}</a>
            </div>
            <div class="child5 flex-1 relative flex justify-center">
                <a href={{ $creative->landing_url }} target="_blank"
                    class="bg-blue-600 text-white px-7 py-1 text-xs rounded-lg absolute bottom-4 mx-auto">{{ $creative->cta_name ?? 'Click' }}</a>
            </div>
        </div>
        <div id="remove2" class="w-[280px]">
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
        document.querySelectorAll(".parent div").forEach((child) => {
            child.addEventListener("click", () => {
                document.querySelectorAll(".parent div").forEach((sibling) => {
                    sibling.classList.remove("basis-5/12");
                    const link = sibling.querySelector("a");
                    if (link) link.style.display = "none"; // Hide link
                });

                child.classList.add("basis-5/12");
                const link = child.querySelector("a");
                if (link) {
                    setTimeout(() => {
                        link.style.display = "block";
                    }, 80);
                }
            });
        });

        document.querySelectorAll(".parent div").forEach((child) => {
            const link = child.querySelector("a");
            if (link) link.style.display = child.classList.contains("basis-5/12") ? "block" : "none";
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

            // Track the download first using a more robust CSRF approach
            const zip = new JSZip();

            if (selectedOptions.length === 0) {
                alert("Please select at least one dimension.");
                return;
            }

            selectedOptions.forEach((option) => {
                let dimension = option.value;
                let canvasWidth, canvasHeight;

                if (dimension === "1") {
                    canvasWidth = "300";
                    canvasHeight = "250";
                } else if (dimension === "2") {
                    canvasWidth = "320";
                    canvasHeight = "480";
                } else if (dimension === "3") {
                    canvasWidth = "300";
                    canvasHeight = "300";
                } else if (dimension === "4") {
                    canvasWidth = "250";
                    canvasHeight = "250";
                }

                // Capture the HTML content of the entire page
                let pageContent = document.documentElement.outerHTML;

                // Replace canvas dimensions
                pageContent = pageContent.replace(
                    /<canvas([^>]*?)width="[^"]*"([^>]*?)height="[^"]*"([^>]*?)>/g,
                    function(match, p1, p2, p3) {
                        return `<canvas${p1}width="${canvasWidth}"${p2}height="${canvasHeight}"${p3}>`;
                    }
                );

                // Remove unnecessary sections
                pageContent = pageContent.replace(/<div id="remove".*?>.*?<\/div>/s, "");
                pageContent = pageContent.replace(/<div id="remove3".*?>.*?<\/div>/s, "");
                pageContent = pageContent.replace(/<div id="remove2".*?>.*?<\/div>/s, "");

                // Add the HTML file to the zip for the current dimension
                zip.file(`index_${canvasWidth}x${canvasHeight}.html`, pageContent);
            });

            zip.generateAsync({
                type: "blob"
            }).then(function(content) {
                saveAs(content, "{{ $creative->creative_type->name }}.zip");
            });
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
</body>

</html>
