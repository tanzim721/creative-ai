<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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

        :root {
            --cube-width: 200px;
            --cube-height: 200px;
            --cube-depth: var(--cube-height);
        }

        .contain {
            width: 100%;
            height: 100vh;
            display: grid;
            place-items: center;
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
            padding: 5px;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .parent {
            text-align: center;
        }

        .radio-group {
            margin-bottom: 20px;
        }

        .space3d {
            perspective: 700px;
            width: var(--cube-width);
            height: var(--cube-height);
            text-align: center;
            display: inline-block;
        }

        ._3dbox {
            display: inline-block;
            transition: transform 0.6s ease;
            text-align: center;
            position: relative;
            width: 100%;
            height: 100%;
            transform-style: preserve-3d;
        }

        ._3dface {
            overflow: hidden;
            position: absolute;
            border: 1px solid #888;
            background: #fff;
            box-shadow: inset 0 0 60px rgba(0, 0, 0, 0.1),
                0 0 50px rgba(0, 0, 0, 0.3);
            color: #333;
            line-height: var(--cube-width);
            opacity: 1;
        }

        ._3dface--front {
            width: var(--cube-width);
            height: var(--cube-height);
            transform: translate3d(0, 0, calc(var(--cube-depth) / 2));
            background: url({{ asset('uploads/' . $images[0]) }}) no-repeat center/cover;
        }

        ._3dface--top {
            width: var(--cube-width);
            height: var(--cube-depth);
            transform: rotateX(90deg) translate3d(0, 0, calc(var(--cube-height) / 2));
            background: url({{ asset('uploads/' . $images[1]) }}) no-repeat center/cover;
        }

        ._3dface--bottom {
            width: var(--cube-width);
            height: var(--cube-depth);
            transform: rotateX(-90deg) translate3d(0, 0, calc(var(--cube-height) / 2));
            background: url({{ asset('uploads/' . $images[2]) }}) no-repeat center/cover;
        }

        ._3dface--left {
            width: var(--cube-depth);
            height: var(--cube-height);
            left: 50%;
            margin-left: calc(-1 * var(--cube-depth) / 2);
            transform: rotateY(-90deg) translate3d(0, 0, calc(var(--cube-width) / 2));
            background: url({{ asset('uploads/' . $images[3]) }}) no-repeat center/cover;
        }

        ._3dface--right {
            width: var(--cube-depth);
            height: var(--cube-height);
            left: 50%;
            margin-left: calc(-1 * var(--cube-depth) / 2);
            transform: rotateY(90deg) translate3d(0, 0, calc(var(--cube-width) / 2));
            background: url({{ asset('uploads/' . $images[4]) }}) no-repeat center/cover;
        }

        ._3dface--back {
            width: var(--cube-width);
            height: var(--cube-height);
            transform: rotateY(180deg) translate3d(0, 0, calc(var(--cube-depth) / 2));
            background: url({{ asset('uploads/' . $images[5]) }}) no-repeat center/cover;
        }
    </style>
</head>

<body>

    <div class="contain">
        <div id="remove" class="header bg-[#2D3A43]">
            Create creative with AI
        </div>
        <div class="parent">
            <!-- Radio Buttons -->
            <div class="radio-group pb-5">
                <label><input type="radio" name="control" data-rotate="rotateX(0deg) rotateY(0deg)" checked /></label>
                <label><input type="radio" name="control" data-rotate="rotateY(-90deg)" /></label>
                <label><input type="radio" name="control" data-rotate="rotateY(90deg)" /></label>
                <label><input type="radio" name="control" data-rotate="rotateX(-90deg)" /></label>
                <label><input type="radio" name="control" data-rotate="rotateX(90deg)" /></label>
                <label><input type="radio" name="control" data-rotate="rotateY(180deg)" /></label>
            </div>

            <div class="space3d">
                <div class="_3dbox">
                    <div class="_3dface _3dface--front"></div>
                    <div class="_3dface _3dface--top"></div>
                    <div class="_3dface _3dface--bottom"></div>
                    <div class="_3dface _3dface--left"></div>
                    <div class="_3dface _3dface--right"></div>
                    <div class="_3dface _3dface--back"></div>
                </div>
            </div>

            <div id="remove3" class="flex flex-col items-start text-white mt-5">
                <div class="checkbox-group flex flex-col items-start">
                    <h3>Available Dimention:</h3>

                    <label class="cursor-pointer">
                        <input type="radio" name="options" value="1" checked />
                        300x300
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script>
        const box = document.querySelector("._3dbox");
        const radios = document.querySelectorAll('input[name="control"]');

        let isDragging = false;
        let previousX = 0;
        let previousY = 0;
        let rotationX = 0;
        let rotationY = 0;

        // Rotate cube with radio buttons
        radios.forEach((radio) => {
            radio.addEventListener("change", () => {
                const rotateValue = radio.getAttribute("data-rotate");
                box.style.transform = rotateValue;
                const [x, y] = rotateValue
                    .match(/rotate[XY]\(([-\d.]+)deg\)/g)
                    .map((r) => +r.match(/[-\d.]+/)[0]);
                rotationX = x || 0;
                rotationY = y || 0;
            });
        });

        // Rotate cube with mouse
        document.addEventListener("mousedown", (e) => {
            isDragging = true;
            previousX = e.clientX;
            previousY = e.clientY;
        });

        document.addEventListener("mousemove", (e) => {
            if (!isDragging) return;

            const deltaX = e.clientX - previousX;
            const deltaY = e.clientY - previousY;

            rotationY += deltaX * 0.5;
            rotationX -= deltaY * 0.5;

            box.style.transform = `rotateX(${rotationX}deg) rotateY(${rotationY}deg)`;

            previousX = e.clientX;
            previousY = e.clientY;
        });

        document.addEventListener("mouseup", () => {
            isDragging = false;
        });

        document.getElementById("download-btn").addEventListener("click", async function() {
            // Extract the current page content
            var pageContent = document.documentElement.outerHTML;

            // Remove elements with specific IDs
            pageContent = pageContent.replace(/<div id="remove".*?>.*?<\/div>/s, "");
            pageContent = pageContent.replace(/<div id="remove2".*?>.*?<\/div>/s, "");
            pageContent = pageContent.replace(/<div id="remove3".*?>.*?<\/div>/s, "");

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

            // Add the HTML file to the zip
            zip.file("index.html", pageContent);

            // Generate the zip file
            const content = await zip.generateAsync({
                type: "blob"
            });

            // Create a download link
            const link = document.createElement("a");
            link.href = URL.createObjectURL(content);
            link.download = "project.zip";
            link.click();
        });
    </script>
</body>

</html>
