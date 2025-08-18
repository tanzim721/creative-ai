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
            margin: 0px;
            padding: 0px;
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

        .parent {
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
            height: 180px;
            background-image: url({{ asset('uploads/' . $images[0]) }});
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            position: relative;
        }

        .btn_custom {
            position: absolute;
            padding: 3px 10px;
            font-size: 10px;
            border: none;
            color: #fff;
            border-radius: 4px;
            bottom: 5px;
            left: 50%;
            transform: translateX(-50%);
            animation: btnAnimation 3s ease-in-out forwards;
        }

        @keyframes btnAnimation {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        /* 2024-12-24T15:13 */

        .parent {
            position: relative;
        }

        .btn_container button {
            padding: 5px 20px;
            font-size: 12px;
            cursor: pointer;
        }

        #countdown {
            font-size: 7px;
            font-weight: bold;
            margin-top: 20px;
            position: absolute;
            right: 2%;
            top: -35%;
        }

        .countdown-section {
            display: inline-block;
            text-align: center;
            background-color: #000;
            color: #fff;
            padding: 5px 8px;
            border-radius: 5px;
        }

        .countdown-section span {
            display: block;
            font-size: 12px;
            background-color: #000;
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="parent flex flex-col">
        <div id="remove" class="header bg-[#2D3A43]">Create creative with AI</div>
        <div class="main">
            <div class="btn_container">
                <a href="{{ $creative->landing_url }}" style="text-decoration: none; color: white" target="_blank">
                    <button class="bg-orange-500 text-white btn_custom">{{ $creative->cta_name ?? 'Click' }}</button>
                </a>

            </div>
            <div id="countdown"></div>
        </div>
        <div id="remove2" class="w-[300px]">
            <div class="flex flex-col items-start text-white mt-2">
                <div class="checkbox-group flex flex-col">
                    <h3>Available Dimention:</h3>
                    <label class="cursor-pointer">
                        <input type="radio" name="options" value="1" checked />
                        320x100
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
        const countdownDisplay = document.getElementById("countdown");

        setInterval(function() {
            // Set your target date here
            const targetDate = new Date("2025-10-12T15:13");
            const currentDate = new Date();

            if (targetDate > currentDate) {
                const timeDifference = targetDate - currentDate;

                // Calculate days, hours, minutes, and seconds
                const days = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
                const hours = Math.floor(
                    (timeDifference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
                );
                const minutes = Math.floor(
                    (timeDifference % (1000 * 60 * 60)) / (1000 * 60)
                );
                const seconds = Math.floor((timeDifference % (1000 * 60)) / 1000);

                // Display the countdown
                countdownDisplay.innerHTML = `
                    <div class="countdown-section">
                        <span>${days}</span>
                        Days
                    </div>
                    <div class="countdown-section">
                        <span>${hours}</span>
                        Hours
                    </div>
                    <div class="countdown-section">
                        <span>${minutes}</span>
                        Minutes
                    </div>
                    <div class="countdown-section">
                        <span>${seconds}</span>
                        Seconds
                    </div>
                `;
            } else {
                countdownDisplay.innerHTML = "Countdown finished!";
            }
        }, 1000);

        document.getElementById("download-btn").addEventListener("click", function() {
            // Remove specific sections before downloading
            let pageContent = document.documentElement.outerHTML;

            pageContent = pageContent.replace(/<div id="remove".*?>.*?<\/div>/s, '');
            pageContent = pageContent.replace(/<div id="remove3".*?>.*?<\/div>/s, '');
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

            // Create a ZIP file
            const zip = new JSZip();
            zip.file("index.html", pageContent); // Add the HTML content to the ZIP

            // Generate and trigger the download
            zip.generateAsync({
                type: "blob"
            }).then(function(blob) {
                const link = document.createElement("a");
                link.href = URL.createObjectURL(blob);
                link.download = "{{ $creative->creative_type->name }}.zip";
                link.click();
            });
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
</body>

</html>
