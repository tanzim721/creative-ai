<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <style>
        * {
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
        }

        .img-comp-container {
            position: relative;
            /*should be the same height as the images*/
        }

        .gradient_bg {
            background: rgb(11, 34, 64);
            background: radial-gradient(circle, rgba(11, 34, 64, 1) 0%, rgba(9, 14, 22, 1) 65%);
        }

        .img-comp-img {
            position: absolute;
            width: 100%;
            min-height: 250px;
            overflow: hidden;
        }

        .img-comp-img img {
            min-height: 300px;
            display: block;
            vertical-align: middle;
            object-fit: cover;
        }

        .img-comp-slider {
            position: absolute;
            z-index: 9;
            cursor: ew-resize;
            /*set the appearance of the slider:*/
            width: 50px;
            height: 50px;
            /* background-color: #000; */
            background-image: url('https://cdn-icons-png.freepik.com/256/10066/10066236.png?semt=ais_hybrid');
            background-size: cover;
            background-position: center center;
            /* box-shadow: 5px 10px 18px #888888; */
            /* opacity: 0.7; */
            /* border-radius: 50%; */
        }

        .logo {
            width: 50px;
            position: relative;
            top: -190px;
            left: 245px;
            z-index: 1000;
        }

        .model {
            width: 97px;
            position: relative;
            top: -130px;
            left: 103px;
            z-index: 8;
            position: relative;
            animation-name: example;
            animation-duration: 3s;
            animation-iteration-count: infinite;
        }

        @keyframes example {
            0% {
                left: 98px;
                top: -125px;
            }

            25% {
                left: 105px;
                top: -135px;
            }

            50% {
                left: 98px;
                top: -125px;
            }

            75% {
                left: 105px;
                top: -135px;
            }

            100% {
                left: 98px;
                top: -125px;
            }
        }

        .hand {
            z-index: 1000;
            position: absolute;
            height: 50px;
            width: 50px;
            /* background-color: aqua; */
            top: 30px;
            left: 30px;
            /* background: url('https://i.ibb.co.com/fMFH0J5/hand.png'); */
            background-size: 50px;
            transform: rotateY(180deg);

            animation-duration: 1.5s;
            animation-name: slidein;
            animation-iteration-count: infinite;
        }

        @keyframes slidein {
            from {
                top: 100px;
                left: 100px;
            }

            to {
                top: 100px;
                left: 180px;
            }
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
    <script>
        function initComparisons() {
            var x, i;
            /*find all elements with an "overlay" class:*/
            x = document.getElementsByClassName("img-comp-overlay");
            for (i = 0; i < x.length; i++) {
                /*once for each "overlay" element:
                pass the "overlay" element as a parameter when executing the compareImages function:*/
                compareImages(x[i]);
            }

            function compareImages(img) {
                var slider, img, clicked = 0,
                    w, h;
                /*get the width and height of the img element*/
                w = img.offsetWidth;
                h = img.offsetHeight;
                /*set the width of the img element to 50%:*/
                img.style.width = (w / 2) + "px";
                /*create slider:*/
                slider = document.createElement("DIV");
                slider.setAttribute("class", "img-comp-slider");
                /*insert slider*/
                img.parentElement.insertBefore(slider, img);
                /*position the slider in the middle:*/
                slider.style.top = (h / 2) - (slider.offsetHeight / 2) + "px";
                slider.style.left = (w / 2) - (slider.offsetWidth / 2) + "px";
                /*execute a function when the mouse button is pressed:*/
                slider.addEventListener("mousedown", slideReady);
                /*and another function when the mouse button is released:*/
                window.addEventListener("mouseup", slideFinish);
                /*or touched (for touch screens:*/
                slider.addEventListener("touchstart", slideReady);
                /*and released (for touch screens:*/
                window.addEventListener("touchend", slideFinish);

                function slideReady(e) {
                    /*prevent any other actions that may occur when moving over the image:*/
                    e.preventDefault();
                    /*the slider is now clicked and ready to move:*/
                    clicked = 1;
                    /*execute a function when the slider is moved:*/
                    window.addEventListener("mousemove", slideMove);
                    window.addEventListener("touchmove", slideMove);
                }

                function slideFinish() {
                    /*the slider is no longer clicked:*/
                    clicked = 0;
                }

                function slideMove(e) {
                    var pos;
                    /*if the slider is no longer clicked, exit this function:*/
                    if (clicked == 0) return false;
                    /*get the cursor's x position:*/
                    pos = getCursorPos(e)
                    /*prevent the slider from being positioned outside the image:*/
                    if (pos < 0) pos = 0;
                    if (pos > w) pos = w;
                    /*execute a function that will resize the overlay image according to the cursor:*/
                    slide(pos);
                }

                function getCursorPos(e) {
                    var a, x = 0;
                    e = (e.changedTouches) ? e.changedTouches[0] : e;
                    /*get the x positions of the image:*/
                    a = img.getBoundingClientRect();
                    /*calculate the cursor's x coordinate, relative to the image:*/
                    x = e.pageX - a.left;
                    /*consider any page scrolling:*/
                    x = x - window.pageXOffset;
                    return x;
                }

                function slide(x) {
                    /*resize the image:*/
                    img.style.width = x + "px";
                    /*position the slider:*/
                    slider.style.left = img.offsetWidth - (slider.offsetWidth / 2) + "px";
                }
            }
        }
    </script>
</head>

<body>

    @php
        $images = json_decode($creative->image, true);
        $countImages = count($images);
    @endphp

    <div class="gradient_bg h-screen ">
        <div id="remove" class="header bg-[#2D3A43]">Create creative with AI</div>
        <div class="">
            <div class="relative w-[300px] mx-auto  h-[300px] pt-24 ">
                <div class="w-[300px] h-[300px] overflow-x-hidden">
                    <div class="img-comp-container" onmouseover="myFunction()">
                        <div class="img-comp-img">
                            <img src="{{ asset('uploads/' . $images[0]) }}" width="300" height="250">
                        </div>
                            <div class="img-comp-img img-comp-overlay" onmouseover="myFunction()">
                                <img src="{{ asset('uploads/' . $images[1]) }}" width="300" height="250">
                            </div>
                    </div>
                </div>
                <div class="hand" id="myDIV"></div>

                <div id="remove3" class="flex flex-col items-start text-white mt-2 absolute top-[400px]">
                    <div class="checkbox-group flex flex-col">
                        <h3>Available Dimention:</h3>
                        <label class="cursor-pointer">
                            <input type="checkbox" name="options" value="300x250" checked />
                            300x300
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

    <script>
        /*Execute a function that will execute an image compare function for each element with the img-comp-overlay class:*/
        initComparisons();
    </script>
    <script>
        function myFunction() {
            var x = document.getElementById("myDIV");
            x.style.display = "none";
        }

        document.getElementById("download-btn").addEventListener("click", function() {
            var zip = new JSZip();

            // Add the HTML content
            var pageContent = document.documentElement.outerHTML;
            pageContent = pageContent.replace(/<div id="remove".*?>.*?<\/div>/s, '');
            pageContent = pageContent.replace(/<div id="remove2".*?>.*?<\/div>/s, '');
            pageContent = pageContent.replace(/<div id="remove3".*?>.*?<\/div>/s, '');

            zip.file("index.html", pageContent);

            // Add images to the ZIP (assuming you have URLs to the images)
            @foreach($images as $image)
                var imageUrl = '{{ asset("uploads/' . $image . '") }}';
                fetch(imageUrl)
                    .then(response => response.blob())
                    .then(blob => {
                        zip.file("uploads/{{ $image }}", blob);
                    })
                    .catch(error => console.error("Error adding image to zip:", error));
            @endforeach

            // Once everything is added, generate the ZIP file
            zip.generateAsync({ type: "blob" })
                .then(function(content) {
                    // Create a link to download the ZIP file
                    var link = document.createElement("a");
                    link.href = URL.createObjectURL(content);
                    link.download = "creative-files.zip";
                    link.click();
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
    
   
</body>

</html>
