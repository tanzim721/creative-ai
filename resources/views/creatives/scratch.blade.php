<!DOCTYPE html>
<html lang="en">

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
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="icon" href="{{ asset('img/icon.jpeg') }}" type="image/x-icon">
    <style>
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

        #scratchCanvas {
            cursor: pointer;
            position: absolute;
            top: 0;
            left: 0;
        }

        .image-container {
            position: relative;
            width: 300px;
            height: 250px;
            display: flex;
            justify-content: center;
            align-items: center;
            clip-path: inset(0 0 5% 0);
        }

        .overlay_container {
            position: absolute;
            width: 100%;
            min-width: 200px;
            height: 100%;
            background-color: transparent;
            z-index: 1;
        }

        #hiddenImage {
            width: 100%;
            height: 250px;
            clip-path: inset(0 0 5% 0);
        }

        canvas {
            z-index: 2;
        }

        #click_btn {
            position: absolute;
            z-index: 9999 !important;
            bottom: 10%;
            left: 50%;
            transform: translateX(-50%);
            color: white;
            background-color: #0063ff;
            padding: 6px 14px;
            border-radius: 5px;
            font-weight: bold;
            text-decoration: none;
            cursor: pointer;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        #click_btn:hover {
            background-color: #0056e0;
            transform: translateX(-50%) scale(1.05);
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
    @php
        $images = json_decode($creative->image, true);
        $countImages = count($images);
    @endphp
    <div class="gradient_bg">
        <div class="">
            <div id="remove3" class="header bg-[#2D3A43]">Create creative with AI</div>
            <div class="container p-4 rounded">
                <div class="flex justify-center gap-5 flex-wrap">
                    <!-- Image1 250*300 -->
                    <div class="mt-4 flex justify-content-center flex-column items-center">
                        <div class="image-container">
                            <img id="hiddenImage" src="{{ asset('uploads/' . $images[0]) }}" alt="Creative 2">
                            <canvas id="scratchCanvas" width="300" height="250"></canvas>
                            <div class="overlay_container flex flex-col justify-between items-center py-2 px-2">
                                <button id="click_btn"
                                    class="text-sm px-3 py-1 rounded-md mt-2 hover:scale-105 transition ease-in-out duration-150">
                                    {{ $creative->cta_name ?? 'Click' }}
                                </button>
                            </div>
                        </div>
                        <div class="w-[290px]">
                            <div id="remove" class="flex flex-col items-start text-white mt-2">
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
                                    @if (isset($subscription) && $subscription->status == 'active' && $subscription->downloads_used < $subscription->plan->monthly_download_limit)
                                        <button class="bg-blue-600 text-white px-7 py-1.5 text-md rounded-lg"
                                            id="download-btn">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            // Store the landing URL in a JavaScript variable
            const landingUrl = "{{ $creative->landing_url }}";

            // Add click event handler for the button
            $("#click_btn").on("click", function(e) {
                e.preventDefault();
                window.open(landingUrl, "_blank");
            });

            //Global Variables
            var img = new Image();
            img.src = '{{ asset('uploads/' . $images[1]) }}';
            img.onload = function() {
                ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
                ctx.globalCompositeOperation = 'destination-out';
            };

            //For Image1 250*300
            var canvas = document.getElementById('scratchCanvas');
            var ctx = canvas.getContext('2d');
            var isScratching = false;

            $('#scratchCanvas').on('mousedown', function(e) {
                isScratching = true;
            }).on('mousemove', function(e) {
                if (isScratching) {
                    var x = e.offsetX;
                    var y = e.offsetY;
                    ctx.beginPath();
                    ctx.arc(x, y, 30, 0, Math.PI * 2);
                    ctx.fill();
                }
            }).on('mouseup', function(e) {
                isScratching = false;
                checkScratchCompletion();
            });

            $('#scratchCanvas').on('touchstart', function(e) {
                isScratching = true;
            }).on('touchmove', function(e) {
                if (isScratching) {
                    var touch = e.touches[0];
                    var x = touch.pageX - $(this).offset().left;
                    var y = touch.pageY - $(this).offset().top;
                    ctx.beginPath();
                    ctx.arc(x, y, 30, 0, Math.PI * 2);
                    ctx.fill();
                }
            }).on('touchend', function(e) {
                isScratching = false;
                checkScratchCompletion();
            });

            function checkScratchCompletion() {
                var scratchedArea = 0;
                var imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
                var totalPixels = imageData.data.length / 4;
                for (var i = 0; i < totalPixels; i++) {
                    if (imageData.data[i * 4 + 3] === 0) {
                        scratchedArea++;
                    }
                }
                var scratchPercentage = (scratchedArea / totalPixels) * 100;
                if (scratchPercentage > 50) {
                    // Auto-click for user convenience after 50% scratched
                    // Uncomment if you want this behavior
                    // window.open(landingUrl, "_blank");
                }
            }
        });

        document.getElementById("download-btn").addEventListener("click", function() {
            const selectedOptions = Array.from(document.querySelectorAll('input[name="options"]:checked')).map(
                option => option.value);

            const dimensions = {
                1: {
                    width: "300px",
                    height: "250px",
                    canvasWidth: "300",
                    canvasHeight: "250"
                },
                2: {
                    width: "320px",
                    height: "480px",
                    canvasWidth: "320",
                    canvasHeight: "480"
                },
                3: {
                    width: "300px",
                    height: "300px",
                    canvasWidth: "300",
                    canvasHeight: "300"
                },
                4: {
                    width: "250px",
                    height: "250px",
                    canvasWidth: "250",
                    canvasHeight: "250"
                },
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


            const jsZip = new JSZip();

            selectedOptions.forEach(option => {
                const dimension = dimensions[option];
                let pageContent = document.documentElement.outerHTML;

                pageContent = pageContent.replace(/\.image-container\s*{[^}]*}/, function(match) {
                    return `.image-container {
                        position: relative;
                        width: ${dimension.width};
                        height: ${dimension.height};
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        clip-path: inset(0 0 5% 0);
                    }`;
                });

                pageContent = pageContent.replace(/#hiddenImage\s*{[^}]*}/, function(match) {
                    return `#hiddenImage {
                        width: 100%;
                        height: ${dimension.height};
                        z-index: 1;
                        clip-path: inset(0 0 5% 0);
                    }`;
                });

                pageContent = pageContent.replace(
                    /<canvas([^>]*?)width="[^"]*"([^>]*?)height="[^"]*"([^>]*?)>/,
                    function(match, p1, p2, p3) {
                        return `<canvas${p1}width="${dimension.canvasWidth}"${p2}height="${dimension.canvasHeight}"${p3}>`;
                    });

                // Remove unnecessary divs
                pageContent = pageContent.replace(/<div id="remove".*?>.*?<\/div>/s, '');
                pageContent = pageContent.replace(/<div id="remove2".*?>.*?<\/div>/s, '');
                pageContent = pageContent.replace(/<div id="remove3".*?>.*?<\/div>/s, '');

                jsZip.file(`index_${dimension.canvasWidth}x${dimension.canvasHeight}.html`, pageContent);
                location.reload();

            });

            jsZip.generateAsync({
                type: "blob"
            }).then(function(blob) {
                saveAs(blob, "creative_files.zip");
            });
        });

        // New functionality for inactive subscription button
        document.getElementById("inactive-download-btn")?.addEventListener("click", function() {
            // Check if dimensions are selected (optional, remove if not needed)
            console.log("Inactive download button clicked");
            const selectedOptions = document.querySelectorAll('input[name="options"]:checked');
            if (selectedOptions.length === 0) {
                alert("Please select at least one dimension first.");
                return;
            }

            // Show the modal
            const subscriptionModal = new bootstrap.Modal(document.getElementById('subscriptionModal'));
            subscriptionModal.show();

            // Fetch subscription information from server
            fetch('/customer/subscription-info', {
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                        'Content-Type': 'application/json',
                        'Accept': 'text/html'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.text();
                })
                .then(html => {
                    // Insert the server-rendered HTML into the modal
                    document.getElementById('subscription-modal-content').innerHTML = html;

                    // Initialize any components inside the modal that might need it
                    const form = document.getElementById('subscription-form');
                    if (form) {
                        form.addEventListener('submit', function(e) {
                            e.preventDefault();
                            // Handle form submission if needed
                            const formData = new FormData(form);

                            fetch(form.action, {
                                    method: form.method,
                                    body: formData,
                                    headers: {
                                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                                    }
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        // Reload the page or update UI as needed
                                        window.location.reload();
                                    } else {
                                        // Show error message
                                        const errorElement = document.getElementById(
                                            'subscription-error');
                                        if (errorElement) {
                                            errorElement.textContent = data.message ||
                                                'An error occurred';
                                            errorElement.classList.remove('d-none');
                                        }
                                    }
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                });
                        });
                    }
                })
                .catch(error => {
                    document.getElementById('subscription-modal-content').innerHTML = `
                        <div class="alert alert-danger">
                            Failed to load subscription information. Please try again later.
                        </div>
                    `;
                    console.error('Error fetching subscription information:', error);
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
</body>

</html>
