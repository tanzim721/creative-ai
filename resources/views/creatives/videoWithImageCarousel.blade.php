<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
        * {
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
        }

        .main {
            width: 300px;
            height: 250px;
            overflow: hidden;
            background: #fff;
        }

        .video_container {
            width: 100%;
            height: 170px;
            display: flex;
            justify-content: start;
            align-items: start;
            object-fit: cover;
        }


        .video_container video {
            width: 300px;
            height: 170px;
            object-fit: cover;
        }

        .swiper {
            width: full;
            display: flex;
            gap: 10px;
        }

        .main .swiper-slide {
            min-width: 90px;
            min-height: 80px;
        }

        .main .swiper-slide img {
            display: block;
            width: 100%;
            height: 80px;
            object-fit: cover;
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
    @php
        $images = json_decode($creative->image, true);
        $videos = json_decode($creative->video, true);
    @endphp
    <div id="main_view"
        class="w-full min-h-screen gradient_bg flex justify-center items-center flex-wrap gap-8 relative">
        <div id="remove2" class="header bg-[#2D3A43] absolute w-full top-0">Create creative with AI</div>
        <!-- Dimention: 300x250 -->
        <div>
            <div class="main">
                @if (!empty($videos[0]))
                    <div class="video_container">
                        <a href="{{ url($creative->landing_url) }}" target="_blank" rel="noopener">
                            <video controls autoplay loop muted>
                                <source src="{{ asset('uploads/' . $videos[0]) }}" type="video/mp4">
                            </video>
                        </a>
                    </div>
                @endif

                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        @foreach ($images as $image)
                            <div class="swiper-slide">
                                <a href="{{ url($creative->landing_url) }}" target="_blank" rel="noopener">
                                    <img src="{{ asset('uploads/' . $image) }}" alt="" />
                                </a>
                            </div>
                        @endforeach

                    </div>

                </div>
            </div>

            <div>
                <div id="remove" class="flex flex-col items-start text-white mt-2">
                    <div class="checkbox-group flex flex-col">
                        <h3>Available Dimention:</h3>
                        <label class="cursor-pointer">
                            <input type="checkbox" name="options" value="300x250" checked />
                            300x250
                        </label>
                    </div>
                    <div id="remove3" class="mt-4 d-flex justify-content-center">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 3,
            spaceBetween: 7,
            freeMode: true,
            loop: true,
            autoplay: {
                delay: 1300,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });

        document.getElementById("download-btn").addEventListener("click", function() {
            const selectedOptions = Array.from(document.querySelectorAll('input[name="options"]:checked')).map(
                (input) => input.value
            );

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

            // Process each selected dimension
            selectedOptions.forEach((dimension) => {
                // Clone the current HTML
                let pageContent = document.documentElement.outerHTML;

                // Update the dimension-specific styles
                const [width, height] = dimension.split('x');
                const updatedCSS = `.main { width: ${width}px; height: ${height}px; }
                                .video_container { width: ${width}px; height: ${height * 0.68}px; }`;

                pageContent = pageContent.replace(/<style>[\s\S]*?<\/style>/, (match) => {
                    return match.replace('</style>', updatedCSS + '</style>');
                });

                // Remove unnecessary elements
                pageContent = pageContent.replace(/<div id="remove3".*?>.*?<\/div>/s, '');
                pageContent = pageContent.replace(/<div id="remove".*?>.*?<\/div>/s, '');
                pageContent = pageContent.replace(/<div id="remove2".*?>.*?<\/div>/s, '');

                // Add the file to the ZIP archive
                zip.file(`${dimension}/index.html`, pageContent);
            });

            // Generate the ZIP file and trigger download
            zip.generateAsync({
                type: 'blob'
            }).then((content) => {
                saveAs(content, 'dimensions.zip');
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
