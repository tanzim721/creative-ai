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

        .carousel1 {
            position: relative;
            margin: 0 auto;
            perspective: 800px;
            transform: translateY(-50%);
        }

        .carousel1-content {
            width: 100%;
            height: 100%;
            transform-style: preserve-3d;
            transform: translateZ(-182px) rotateY(0);
            animation: carousel1 10s infinite cubic-bezier(1, 0.015, 0.295, 1.225) forwards;
        }

        .carousel1-item {
            position: absolute;
            border-radius: 6px;
        }

        .carousel1-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 6px;
            clip-path: inset(0 0 5% 0);
        }

        .carousel1-item:nth-child(1) {
            transform: rotateY(0deg) translateZ(182px);
        }

        .carousel1-item:nth-child(2) {
            transform: rotateY(120deg) translateZ(182px);
        }

        .carousel1-item:nth-child(3) {
            transform: rotateY(240deg) translateZ(182px);
        }

        @keyframes carousel1 {

            0%,
            17.5% {
                transform: translateZ(-182px) rotateY(0);
            }

            27.5%,
            45% {
                transform: translateZ(-182px) rotateY(-120deg);
            }

            55%,
            72.5% {
                transform: translateZ(-182px) rotateY(-240deg);
            }

            82.5%,
            100% {
                transform: translateZ(-182px) rotateY(-360deg);
            }
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
            line-height: 1;
            padding: 10px 10px 0px 15px;
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
    <div class="gradient_bg w-full">
        <div class="w-full">
            <div id="remove3" class="header bg-[#2D3A43]">Create creative with AI</div>

            <div class="flex flex-col items-center">
                <div class="min-h-[420px]">
                    <div class="container p-4 rounded ">
                        <div id="remove4" class="text-center mb-5">
                            <h2 class="text-3xl font-bold text-white">Generated Ads {{ $creative->creative_type->name }}
                            </h2>
                        </div>
                        <div class="mt-4 flex justify-content-center flex-column items-center">
                            <div class="carousel1 w-80">
                                <div class="carousel1-content p-5">
                                    @php $imageCount = 0; @endphp
                                    @foreach ($images as $image)
                                        <div class="carousel1-item flex justify-center">
                                            <img class="creativeImage" src="{{ asset('uploads/' . $image) }}"
                                                alt="Creative Image" style="height: 300px; width: 250px;">
                                            <a href="{{ $creative->landing_url }}" target="_blank"
                                                class="rounded-md px-4 border-[#3276ceb2] text-white py-1 mt-2  bg-blue-500 text-sm hover:scale-105 transition ease-in-out duration-150 absolute bottom-5">
                                                {{ $creative->cta_name ?? 'Click' }}
                                            </a>
                                        </div>
                                        @php
                                            $imageCount++;
                                            if ($imageCount >= 3) {
                                                break;
                                            }
                                        @endphp
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div id="remove" class="flex flex-col items-start text-white mt-2">
                        <div class="checkbox-group">
                            <h3>Select Dimensions:</h3>
                            <label class="cursor-pointer">
                                <input type="checkbox" name="options" value="1" /> 300x250
                            </label><br>
                            <label class="cursor-pointer">
                                <input type="checkbox" name="options" value="2" /> 320x480
                            </label><br>
                            <label class="cursor-pointer">
                                <input type="checkbox" name="options" value="3" /> 300x300
                            </label><br>
                            <label class="cursor-pointer">
                                <input type="checkbox" name="options" value="4" /> 250x250
                            </label>
                        </div>

                        <!-- Replace the conditional button with new implementation -->
                        <div id="remove2" class="mt-4 d-flex justify-content-center">
                            
                            @if (isset($subscription) && $subscription->status == 'active' && $subscription->downloads_used < $subscription->plan->monthly_download_limit)
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


    <script>
        // Original download button functionality remains unchanged
        document.getElementById("download-btn")?.addEventListener("click", function() {
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
    
            // Continue with the existing download functionality
            const zip = new JSZip();
    
            selectedOptions.forEach((option) => {
                const selectedValue = option.value;
                let dimensions = {};
    
                switch (selectedValue) {
                    case "1":
                        dimensions = {
                            width: "300px",
                            height: "250px"
                        };
                        break;
                    case "2":
                        dimensions = {
                            width: "480px",
                            height: "320px"
                        };
                        break;
                    case "3":
                        dimensions = {
                            width: "300px",
                            height: "300px"
                        };
                        break;
                    case "4":
                        dimensions = {
                            width: "250px",
                            height: "250px"
                        };
                        break;
                }
    
                // Clone the current HTML structure
                let pageContent = document.documentElement.outerHTML;
    
                // Update dimensions for images
                pageContent = pageContent.replace(
                    /(<img[^>]*class="creativeImage"[^>]*style=")([^"]*)(")/g,
                    (match, p1, p2, p3) => {
                        return `${p1}height: ${dimensions.height}; width: ${dimensions.width}; object-fit: cover;${p3}`;
                    }
                );
    
                // Remove elements with specific IDs
                ["remove", "remove2", "remove3", "remove4"].forEach((id) => {
                    const regex = new RegExp(`<div id="${id}".*?>.*?<\\/div>`, "gs");
                    pageContent = pageContent.replace(regex, "");
                });
    
                // Generate a unique filename based on the dimension
                const fileName = `index_${dimensions.width}x${dimensions.height}.html`;
                zip.file(fileName, pageContent);

                location.reload();
                
            });
    
            // Generate the ZIP file and trigger download
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>

</body>

</html>
