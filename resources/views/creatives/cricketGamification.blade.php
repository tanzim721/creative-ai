<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" href="{{ asset('img/icon.jpeg') }}" type="image/x-icon">
    @php
        $images = json_decode($creative->image, true);
    @endphp
    <style>
        /* Cricket Bat-Ball Ads Start */
        body {
            min-width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .cricket_main {
            width: 300px;
            height: 250px;
            background-image: url('https://i.ibb.co.com/1XFMqbX/studium.webp');
            position: relative;
            background-position: center;
            background-size: cover;
            overflow: hidden;
        }

        .d-none {
            display: none;
        }

        #confettiCanvas {}

        .confetti {
            position: absolute;
            width: 10px;
            height: 10px;
            background-color: red;
            opacity: 0.8;
            pointer-events: none;
            /* Prevent interaction */
            border-radius: 50%;
            /* Makes the confetti circular */
            z-index: 99;
        }

        .offer {
            position: absolute;
            width: 100%;
            height: 100%;
            background-image: url({{ asset('uploads/' . $images[0]) }});
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            z-index: 1;
            top: 100%;
            transition: all 1s;
        }

        .offer_visible {
            top: 0%;
        }


        .cricket_main_h1 {
            font-size: 1.3rem;
            text-align: center;
            color: white;
            font-weight: 500;
            font-family: Arial, Helvetica, sans-serif;
            margin-top: 5px;
        }

        .cricket_bat_container {
            position: absolute;
            bottom: 2rem;
            left: 2rem;
        }

        .cricket_bat_animation {
            animation: batAnimation 2.5s none;
        }

        @keyframes batAnimation {
            0% {
                transform: rotate(30deg);
            }

            35% {
                transform: rotate(-90deg);
            }

            100% {
                transform: rotate(-90deg);
            }
        }

        .cricket_bat_container img {
            width: 120px;
        }

        .cricket_ball_container {
            position: absolute;
            bottom: 3rem;
            left: 8rem;
        }

        .cricket_ball_animation {
            animation: ballAnimation 4s none;
            animation-delay: 0.5s;
        }

        @keyframes ballAnimation {
            0% {
                transform: translateX(-50px) translateX(50px);
            }

            23% {
                transform: translateY(-100px) translateX(300px);
            }

            100% {
                transform: translateY(-100px) translateX(300px);
            }
        }

        .cricket_ball_container img {
            width: 25px;
        }

        /* Cricket Bat-Ball Ads End */
        .gradient_bg {
            min-width: 100vw;
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

<body style="width: 100vw; margin: 0;">

    <div class="w-full h-screen gradient_bg flex justify-center items-center relative ">

        <div id="remove3" class="header bg-[#2D3A43] absolute top-0 w-full">Create creative with AI</div>
        <!-- Cricket Bat-Ball Ads Start-->
        <div>
            <div class="cricket_main">
                <canvas id="confettiCanvas" class="" width="350" height="250"></canvas>
                <div class="text_container">
                    <h1 class="cricket_main_h1">Hit the ball to get your Offer!!!</h1>
                </div>
                <div class="cricket_bat_container">
                    <img src="https://i.ibb.co.com/tqv3qtr/cricket-bat.png" alt="" class="hit_bat" />
                </div>
                <div class="cricket_ball_container">
                    <img src="https://i.ibb.co.com/7tDFnNS/cricket-ball.png" alt="" />
                </div>
                <a href="{{ $creative->landing_url }}" target="_blank">
                    <div class="offer"></div>
                </a>

            </div>
            <div id="remove">
                <div class="flex flex-col items-start text-white mt-2">
                    <div class="checkbox-group flex flex-col">
                        <h3>Available Dimention:</h3>

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
                        @if (isset($subscription) &&  $subscription->status == 'active')
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
        <!-- Cricket Bat-Ball Ads End-->
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
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@latest/dist/confetti.browser.min.js"></script>
    <script>
        const cricketMain = document.querySelector(".cricket_main");
        const batContainer = document.querySelector(".cricket_bat_container");
        const ballContainer = document.querySelector(".cricket_ball_container");
        const confettiCanvas = document.getElementById("confettiCanvas");
        const confettiContext = confettiCanvas.getContext("2d");
        const offerWall = document.querySelector(".offer");

        confettiCanvas.width = cricketMain.clientWidth;
        confettiCanvas.height = cricketMain.clientHeight;
        confettiCanvas.style.position = "absolute";
        confettiCanvas.style.top = 0;
        confettiCanvas.style.left = 0;
        confettiCanvas.style.zIndex = 2;

        cricketMain.appendChild(confettiCanvas);

        const confettiInstance = confetti.create(confettiCanvas, {
            resize: true,
        });

        cricketMain.addEventListener("click", () => {
            batContainer.classList.add("cricket_bat_animation");
            ballContainer.classList.add("cricket_ball_animation");

            setTimeout(() => {
                setInterval(() => {
                    var count = 200;
                    var defaults = {
                        origin: {
                            y: 0.7
                        },
                    };

                    function fire(particleRatio, opts) {
                        const originX = randomInRange(0.1, 0.9);
                        const originY = 0.7;

                        confettiInstance({
                            ...defaults,
                            ...opts,
                            particleCount: Math.floor(count * particleRatio),
                            origin: {
                                x: originX,
                                y: originY,
                            },
                            spread: opts.spread || 60,
                            startVelocity: opts.startVelocity || 25,
                            scalar: opts.scalar || 0.9,
                        });
                    }

                    function randomInRange(min, max) {
                        return Math.random() * (max - min) + min;
                    }

                    fire(0.25, {
                        spread: 50,
                        startVelocity: 20,
                    });
                    fire(0.25, {
                        spread: 60,
                        startVelocity: 25,
                    });
                    fire(0.25, {
                        spread: 70,
                        decay: 0.9,
                        scalar: 0.8,
                    });
                    fire(0.25, {
                        spread: 80,
                        startVelocity: 30,
                    });
                }, 700);
            }, 500);

            setTimeout(() => {
                offerWall.classList.add("offer_visible");
                setTimeout(() => {
                    document.getElementById("confettiCanvas").classList.add("d-none");
                }, 1400);
            }, 1500);
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

            // Continue with the existing download functionality
            const zip = new JSZip();
            const pageContent = document.documentElement.outerHTML;

            const dimensions = {
                1: {
                    width: "250px",
                    height: "300px"
                },
                2: {
                    width: "320px",
                    height: "480px"
                },
                3: {
                    width: "300px",
                    height: "300px"
                },
                4: {
                    width: "250px",
                    height: "250px"
                },
            };

            selectedOptions.forEach((option) => {
                const value = option.value;
                const newWidth = dimensions[value].width;
                const newHeight = dimensions[value].height;

                // Update the content with the new dimensions
                let updatedContent = pageContent.replace(/\.cricket_main\s*{[^}]*}/, function(match) {
                    return `.cricket_main {
                    position: relative;
                    width: ${newWidth};
                    height: ${newHeight};
                    background-image: url('https://i.ibb.co.com/1XFMqbX/studium.webp');
                    background-position: center;
                    background-size: cover;
                    overflow: hidden;
                }`;
                });

                // Remove unnecessary divs
                updatedContent = updatedContent
                    .replace(/<div id="remove".*?>.*?<\/div>/s, '')
                    .replace(/<div id="remove2".*?>.*?<\/div>/s, '')
                    .replace(/<div id="remove3".*?>.*?<\/div>/s, '');

                // Add the updated content to the zip file
                zip.file(`index_${value}.html`, updatedContent);
            });

            // Generate the zip file and trigger download
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

</body>

</html>
