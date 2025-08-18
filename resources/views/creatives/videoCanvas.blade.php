<!DOCTYPE html>
<html>

<head>
    <title>{{ $creative->creative_type->name }}</title>
    <!-- Google Analytics 4 Tracking Code -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-VHXKMY3QR3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'G-VHXKMY3QR3');
    </script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.1.0/css/all.css"
        integrity="sha512-ajhUYg8JAATDFejqbeN7KbF2zyPbbqz04dgOLyGcYEk/MJD3V+HJhJLKvJ2VVlqrr4PwHeGTTWxbI+8teA7snw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="{{ asset('img/icon.jpeg') }}" type="image/x-icon">
    <style>
        body {
            margin: 0 !important;
        }

        #vid {
            position: relative;
            min-height: fit-content;
        }

        #sam1 {
            display: none;
        }

        #m1 {
            display: none;
        }

        .container img {
            width: 300px;
            height: 250px;
            object-fit: cover;
        }

        .button5 {
            background-color: white;
            color: black;
            border: 2px solid black;
            font-weight: 600;
        }


        video {
            z-index: -1;
            object-fit: cover;
        }

        .ml10 {
            position: relative;
            font-weight: 900;
            font-size: 16px;
            bottom: 20px;
        }

        .ml10 .text-wrapper {
            position: relative;
            display: inline-block;
            padding-top: 0.2em;
            padding-right: 0.05em;
            padding-bottom: 0.1em;
            overflow: hidden;
        }

        .ml10 .letter {
            display: inline-block;
            line-height: 1em;
            transform-origin: 0 0;
            color: #d1b444;
        }

        .siz {
            height: 33px;
            width: 100%;
        }

        .video_container {
            width: 250px;
            height: 300px;
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
            background: radial-gradient(circle, rgba(11, 34, 64, 1) 0%, rgba(9, 14, 22, 1) 65%);
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.5);
            backdrop-filter: blur(5px);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 0;
            border: none;
            border-radius: 15px;
            width: 90%;
            max-width: 800px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            animation: modalSlideIn 0.3s ease-out;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            padding: 10px;
            line-height: 1;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
        }

        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .modal-content {
                margin: 10% auto;
                width: 95%;
            }
        }
    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
</head>

<body>
    @php
        $videos = $creative->video ? json_decode($creative->video, true) : [];
    @endphp
    <div class="gradient_bg">
        <div id="remove3" class="header bg-[#2D3A43]">Create creative with AI</div>
        <div class="flex justify-center items-center pt-10">
            <div>
                <div id="vid" class="">
                    <button id="m1" class="btn1" onclick="enableMute()" type="button">
                        <i class="fas fa-volume"></i>
                    </button>
                    <div class="video_container">
                        @if(!empty($videos) && isset($videos[0]))
                            <a href="{{ url($creative->tracking_url) }}" target="_blank" rel="noopener">
                                <video src="{{ asset('uploads/' . $videos[0]) }}" controls autoplay loop muted
                                    class="h-full"></video>
                            </a>
                            
                        @endif
                    </div>
                    <br />
                    <div class="con" class="">
                        <a href="{{ $creative->landing_url }}" target="_blank">
                            <div class="siz" id="l1" onclick="">
                                <h1 class="ml10 text-center">
                                    <span class="text-wrapper text-center">
                                        <span class="letters" style="color: #d14444">{{ $creative->cta_name }}</span>
                                    </span>
                                </h1>
                            </div>
                        </a>
                    </div>
                </div>
                <div>
                    <div id="remove" class="flex flex-col items-start text-white -mt-3">
                        <div class="checkbox-group flex flex-col">
                            <h3>Available Dimensions:</h3>
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
                        <div id="remove2" class="mt-4 d-flex justify-content-center">
                            @if (isset($subscription) && $subscription->status == 'active')
                                <button class="bg-blue-600 text-white px-7 py-1.5 text-md rounded-lg" id="download-btn">
                                    Download
                                </button>
                            @else
                                <button class="bg-blue-600 text-white px-7 py-1.5 text-md rounded-lg" id="download-btn1">
                                    Download
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Subscription Modal -->
    <div id="subscription-modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            
            <!-- Modal Content -->
            <div class="p-8">
                <div class="bg-white rounded-2xl">
                    <div class="px-6 py-4 border-b border-gray-100">
                        <p class="text-gray-600 mt-2">Subscribe to any plan to unlock download.</p>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto border-collapse">
                            <thead>
                                <tr
                                    class="bg-indigo-50 text-left text-sm  text-indigo-600 uppercase tracking-wider">
                                    <th class="px-6 py-4 border-b border-indigo-100">Plan</th>
                                    <th class="px-6 py-4 border-b border-indigo-100">Price</th>
                                    <th class="px-6 py-4 border-b border-indigo-100">Download</th>
                                    <th class="px-6 py-4 border-b border-indigo-100">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                @if (isset($plans) && $plans->count() > 0)
                                    @foreach ($plans as $plan)
                                        <tr class="border-b border-indigo-100 hover:bg-gray-50">
                                            <td class="px-6 py-4 border-b border-indigo-100">
                                                <div class="font-medium text-gray-900">
                                                    {{ $plan->name ?? 'N/A' }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 border-b border-indigo-100">
                                                <div class="text-gray-900">
                                                    ${{ isset($plan->monthly_price) ? number_format($plan->monthly_price, 2) : '0.00' }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 border-b border-indigo-100">
                                                <div class="text-gray-700">
                                                    {{ $plan->monthly_download_limit ?? 'Unlimited' }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 border-b border-indigo-100">
                                                <form method="POST" action="{{ route('checkout', $plan->id) }}">
                                                    @csrf
                                                    <button type="submit"
                                                        class="px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white  rounded-lg transition-colors duration-200">
                                                        Payment
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="px-6 py-8 text-center text-gray-500" colspan="4">
                                            No subscription plans available at the moment.
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    <script>
        // Wrap every letter in a span
        var textWrapper = document.querySelector(".ml10 .letters");
        textWrapper.innerHTML = textWrapper.textContent.replace(
            /\S/g,
            "<span class='letter'>$&</span>"
        );

        anime
            .timeline({
                loop: true
            })
            .add({
                targets: ".ml10 .letter",
                rotateY: [-90, 0],
                duration: 1000,
                delay: (el, i) => 45 * i,
            })
            .add({
                targets: ".ml10",
                opacity: 0,
                duration: 2000,
                easing: "easeOutExpo",
                delay: 1000,
            });
    </script>

    <script>
        var vid = document.getElementById("sam2");

        var x = document.getElementById("m1");
        var y = document.getElementById("m2");

        function enableMute() {
            alert("Hellow")
            vid.muted = true;
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
                y.style.display = "block";
            }
        }

        function disableMute() {
            vid.muted = false;
            vid.play();
            if (y.style.display === "none") {
                x.style.display = "block";
            } else {
                y.style.display = "none";
                x.style.display = "block";
            }
        }


        document.getElementById("download-btn").addEventListener("click", async function() {
            const selectedOptions = document.querySelectorAll('input[name="options"]:checked');
            if (selectedOptions.length === 0) {
                alert("Please select at least one dimension to download.");
                return;
            }

            const pageContent = document.documentElement.outerHTML;
            const dimensions = {
                "1": { width: "300px", height: "250px" },
                "2": { width: "480px", height: "320px" },
                "3": { width: "300px", height: "300px" },
                "4": { width: "250px", height: "250px" },
            };

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
                
            // Initialize JSZip
            const zip = new JSZip();

            selectedOptions.forEach(option => {
                const { width, height } = dimensions[option.value];
                const updatedContent = pageContent
                    .replace(/\.video_container\s*{[^}]*}/, function() {
                        return `.video_container {
                            width: ${width};
                            height: ${height};
                        }`;
                    })
                    .replace(/<div id="remove".*?>.*?<\/div>/s, "")
                    .replace(/<div id="remove2".*?>.*?<\/div>/s, "")
                    .replace(/<div id="remove3".*?>.*?<\/div>/s, "");

                const fileName = `index_${width}x${height}.html`;
                zip.file(fileName, updatedContent);
            });

            // Generate the ZIP file
            const blob = await zip.generateAsync({ type: "blob" });
            const link = document.createElement("a");
            link.href = URL.createObjectURL(blob);
            link.download = "creative_files.zip";
            link.click();
        });
    </script>

    <script>
        // Get modal elements
        const subscriptionModal = document.getElementById('subscription-modal');
        const downloadBtn1 = document.getElementById('download-btn1');
        const closeBtn = document.querySelector('.close');

        // Function to open modal
        function openSubscriptionModal() {
            subscriptionModal.style.display = 'block';
            document.body.style.overflow = 'hidden'; // Prevent background scrolling
        }

        // Function to close modal
        function closeSubscriptionModal() {
            subscriptionModal.style.display = 'none';
            document.body.style.overflow = 'auto'; // Restore scrolling
        }

        // Event listener for non-subscriber download button
        if (downloadBtn1) {
            downloadBtn1.addEventListener('click', function(e) {
                e.preventDefault(); // Prevent any default action
                openSubscriptionModal();
            });
        }

        // Event listener for close button
        if (closeBtn) {
            closeBtn.addEventListener('click', closeSubscriptionModal);
        }

        // Close modal when clicking outside of it
        window.addEventListener('click', function(event) {
            if (event.target === subscriptionModal) {
                closeSubscriptionModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape' && subscriptionModal.style.display === 'block') {
                closeSubscriptionModal();
            }
        });

        // Prevent modal content clicks from closing the modal
        document.querySelector('.modal-content').addEventListener('click', function(event) {
            event.stopPropagation();
        });
    </script>
</body>

</html>


