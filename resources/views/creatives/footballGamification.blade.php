<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <link rel="icon" href="{{ asset('img/icon.jpeg') }}" type="image/x-icon">
    @php
        $images = json_decode($creative->image, true);
    @endphp
    <style>
        .field {
            border: 1px solid;
            height: 250px !important;
            width: 300px !important;
            background-image: url('https://static.vecteezy.com/system/resources/previews/001/330/259/non_2x/soccer-or-football-stadium-with-goal-from-penalty-position-free-vector.jpg');
            background-position: center;
            background-size: cover;
            position: relative;
        }

        body {
            margin: 0px !important;
            width: 100%
        }

        .banner {
            text-align: center;
            color: white;
            height: 250px !important;
            width: 300px !important;
            top: 0;
            left: 0;
            position: relative;
            background-image: url({{ asset('uploads/' . $images[0]) }});
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center
        }

        .ball {
            width: 30px;
            position: relative;
            left: 136px;
            top: 68px;

            transition: transform 1s ease-out 0.2s;


        }

        img.bat {
            height: 129px;
            margin-left: 50px;

        }

        #oldbBtn {

            height: 29px;
            width: 141px;

            margin-top: 194px;
            border-radius: 15px;
            margin-left: 150px;
            display: block;
            background-image: url('images/btn-bg.png');
        }

        .text1 {
            width: 291px;
        }

        .logopo {
            position: absolute;
            top: 13px;
            left: 281px;
            width: 25px;
        }

        .cc {
            margin-top: 105px;
        }

        @-webkit-keyframes bounce {
            from {
                top: 50px;
            }

            to {
                top: 68px;
            }
        }

        .ball {
            -webkit-animation: bounce .9s linear;
        }

        .hand {
            z-index: 1000;
            position: absolute;
            height: 50px;
            width: 50px;
            /* background-color: aqua; */
            top: 30px;
            left: 30px;
            background: url(images/hand.png);
            background-size: 50px;
            transform: rotateY(180deg);

            animation-duration: 1.5s;
            animation-name: slidein;
            animation-iteration-count: infinite;
        }

        @keyframes slidein {
            from {
                left: 133px;
                top: 164px;
            }

            to {
                left: 133px;
                top: 171px;
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
    <div class="w-full h-screen gradient_bg flex justify-center items-center relative" id="parent">
        <div id="remove" class="header bg-[#2D3A43] absolute top-0 w-full">Create creative with AI</div>
        <div class="flex flex-col">
            <div>
                <div>
                    <div class="field" id="clc" onmouseover="myFunction()">
                        <div class="cc" onclick ="fun()">
                            <div class="hand" id="myDIV3"></div>
                            <img src="https://cdn.pixabay.com/photo/2013/07/13/10/51/football-157930_1280.png"
                                alt="" class="ball" id="myDIV1">
                        </div>
                    </div>
                    <a href="{{ $creative->landing_url }}" target="_blank">
                        <div class="banner" style="display: none;" class="absolute top-0" id="myDIV"></div>
                    </a>
                </div>
            </div>
            <div id="remove3" class="flex flex-col items-start text-white mt-2">
                <div class="checkbox-group flex flex-col">
                    <h3>Available Dimention:</h3>
                    <label class="cursor-pointer">
                        <input type="checkbox" name="options" value="300x250" checked />
                        300x250
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
        <div>
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
        function bigImg(x) {
            setTimeout(function() {
                var y = document.getElementById("myDIV");
                x.style.display = "none";
                y.style.display = "block";
            }, 2000);
        }

        function fun() {
            document.getElementById("myDIV1").style.transform = "rotate(40deg)";
            document.getElementById("myDIV1").style.transform = "translate(50px, -290px)";
            document.getElementById("myDIV1").style.scale = "0.2";
            document.getElementById("myDIV1").style.transition = "transform .8s ease-in, scale .8s ease-in";
            setTimeout(function() {
                var y = document.getElementById("myDIV");
                var x = document.getElementById("clc");
                x.style.display = "none";
                y.style.display = "block";
            }, 2000);
        }

        document.getElementById("download-btn").addEventListener("click", function() {

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
            let pageContent = document.documentElement.outerHTML;

            // Remove unnecessary sections from the HTML
            pageContent = pageContent
                .replace(/<div id="remove2".*?>.*?<\/div>/s, '')
                .replace(/<div id="remove".*?>.*?<\/div>/s, '')
                .replace(/<div id="remove3".*?>.*?<\/div>/s, '');

            // Add the cleaned HTML to the zip file
            zip.file("index.html", pageContent);

            // Generate the zip file and trigger the download
            zip.generateAsync({
                type: "blob"
            }).then(function(content) {
                saveAs(content, "creative.zip");
            });
        });

        function myFunction() {
            var x = document.getElementById("myDIV3");
            x.style.display = "none";
        }
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
