<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <link rel="icon" href="{{ asset('img/icon.jpeg') }}" type="image/x-icon">
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
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css" />
    <link rel="stylesheet" href="./style.css" />
    @php
        $images = json_decode($creative->image, true);
    @endphp
    <style>
        * {
            box-sizing: border-box;
            transition: 0.3s;
        }

        html,
        body {
            height: 100%;
            width: 100%;
            overflow: hidden;
        }

        .scene {
            perspective: 800px;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 400px;
            width: 100%;
            background-size: 100% 100%;
            background-position: center;
            background-repeat: no-repeat;
            transform: scale(0.57);
        }

        /* .scene:hover {
            transform: scale(.5);
            }
            .scene:hover .side {
            opacity: 1;
        } */

        .cube {
            transform-style: preserve-3d;
            position: relative;
            width: 300px;
            height: 300px;
            -webkit-animation: rotate 10s ease-in-out infinite;
            animation: rotate 10s ease-in-out infinite;
            transform-origin: center center;
        }

        .side {
            position: absolute;
            width: 300px;
            height: 300px;
            background-color: #333;
            opacity: 1;
            background-size: cover;
            background-repeat: no-repeat;
        }

        .back {
            transform: translateZ(-150px) rotateX(180deg);
        }

        .left {
            transform: translateX(-150px) rotateY(270deg);
        }

        .right {
            transform: translateX(150px) rotateY(90deg);
        }

        .top {
            transform: translateY(-150px) rotateX(90deg);
        }

        .bottom {
            transform: translateY(150px) rotateX(270deg);
        }

        .front {
            transform: translateZ(150px);
        }

        @-webkit-keyframes rotate {
            0% {
                transform: rotateX(0);
            }

            12.5% {
                transform: rotateY(90deg);
            }

            25% {
                transform: rotateY(270deg);
            }

            37.5% {
                transform: rotateY(270deg);
            }

            50% {
                transform: rotateY(360deg);
            }

            62.5% {
                transform: rotateX(90deg);
            }

            75% {
                transform: rotateX(180deg);
            }

            87.5% {
                transform: rotateX(270deg);
            }

            100% {
                transform: rotateX(360deg);
            }
        }

        @keyframes rotate {
            0% {
                transform: rotateX(0);
            }

            12.5% {
                transform: rotateY(90deg);
            }

            25% {
                transform: rotateY(270deg);
            }

            37.5% {
                transform: rotateY(270deg);
            }

            50% {
                transform: rotateY(360deg);
            }

            62.5% {
                transform: rotateX(90deg);
            }

            75% {
                transform: rotateX(180deg);
            }

            87.5% {
                transform: rotateX(270deg);
            }

            100% {
                transform: rotateX(360deg);
            }
        }

        .gradient_bg {
            background: rgb(11, 34, 64);
            background: radial-gradient(circle, rgba(11, 34, 64, 1) 0%, rgba(9, 14, 22, 1) 65%);
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
            padding: 10px 10px 0px 15px;
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
</head>

<body>
    <!-- partial:index.partial.html -->
    @php
        $images = json_decode($creative->image, true);
        $countImages = count($images);
    @endphp
    <div class="w-full h-screen gradient_bg">
        <div id="remove3" class="header bg-[#2D3A43] absolute w-full top-0">Create creative with AI</div>
        <div class="flex flex-col justify-center items-center pt-24">
            <div class="scene">
                <div class="cube">
                    <div class="side back">
                        <a href="{{ $creative->landing_url }}" target="_blank">
                            <img src="{{ asset('uploads/' . $images[0]) }}" alt=""
                                style="width: 100%; height:100%; cursor: pointer;">
                        </a>
                    </div>
                    <div class="side left">
                        <a href="{{ $creative->landing_url }}" target="_blank">
                            <img src="{{ asset('uploads/' . $images[1]) }}" alt=""
                                style="width: 100%; height:100%; cursor: pointer;">
                        </a>
                    </div>
                    <div class="side right">
                        <a href="{{ $creative->landing_url }}" target="_blank">
                            <img src="{{ asset('uploads/' . $images[2]) }}" alt=""
                                style="width: 100%; height:100%; cursor: pointer;">
                        </a>
                    </div>
                    <div class="side top">
                        <a href="{{ $creative->landing_url }}" target="_blank">
                            <img src="{{ asset('uploads/' . $images[3]) }}" alt=""
                                style="width: 100%; height:100%; cursor: pointer;">
                        </a>
                    </div>
                    <div class="side bottom">
                        <a href="{{ $creative->landing_url }}" target="_blank">
                            <img src="{{ asset('uploads/' . $images[4]) }}" alt=""
                                style="width: 100%; height:100%; cursor: pointer;">
                        </a>
                    </div>
                    <div class="side front">
                        <a href="{{ $creative->landing_url }}" target="_blank">
                            <img src="{{ asset('uploads/' . $images[5]) }}" alt=""
                                style="width: 100%; height:100%; cursor: pointer;">
                        </a>
                    </div>
                </div>

            </div>
            <div id="remove">
                <div class="flex flex-col items-start text-white -mt-14">
                    <div class="checkbox-group flex flex-col">
                        <h3>Available Dimention:</h3>
                        <label class="cursor-pointer">
                            <input type="checkbox" name="options" value="1" checked />
                            250x300
                        </label>
                        <label class="cursor-pointer">
                            <input type="checkbox" name="options" value="2" />
                            300x300
                        </label>
                        <label class="cursor-pointer">
                            <input type="checkbox" name="options" value="3" />
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
    <!-- Subscription Modal -->
    <div id="subscription-modal" class="modal">
        <div class="modal-content">
            <div style="display: flex; justify-content: flex-end;">
                <span class="close px-2">&times;</span>
            </div>

            <!-- Modal Content -->
            <div class="pb-2">
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
    <!-- partial -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/react/15.1.0/react.min.js"></script>
    <script src="https://fb.me/react-dom-15.1.0.min.js"></script>
    <script>
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
                    canvasWidth = "300";
                    canvasHeight = "300";
                } else if (dimension === "3") {
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
                saveAs(content, "creative_dimensions.zip");
            });
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
    <script src="https://cdn.jsdelivr.net/npm/jszip/dist/jszip.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/file-saver/dist/FileSaver.min.js"></script>
</body>

</html>
