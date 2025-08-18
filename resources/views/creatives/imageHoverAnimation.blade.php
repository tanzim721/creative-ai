<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
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
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300,400,400i|Nunito:300,300i" rel="stylesheet" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="icon" href="{{ asset('img/icon.jpeg') }}" type="image/x-icon">
    <style>
        *,
        *::after,
        *::before {
            margin: 0;
            padding: 0;
            box-sizing: inherit;
        }

        html {
            box-sizing: border-box;
        }

        body {
            font-family: "Nunito", sans-serif;
            color: #333;
            font-weight: 300;
            line-height: 1.6;
            min-width: 100vw;
        }

        .container {
            max-width: 300px;
            height: 250px;
            display: flex;
            justify-content: center;

        }

        .gallery {
            display: grid;
            grid-template-columns: repeat(8, 35px);
            grid-template-rows: repeat(8, 50px);
            grid-gap: 2px;
            position: relative;
            overflow: hidden;
            border: 1px solid #ccc;
        }

        .gallery__img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            position: relative;
        }

        .gallery__item--1 {
            grid-column-start: 1;
            grid-column-end: 5;
            grid-row-start: 1;
            grid-row-end: 5;
        }

        .gallery__item--2 {
            grid-column-start: 5;
            grid-column-end: 9;
            grid-row-start: 1;
            grid-row-end: 3;
        }

        .gallery__item--3 {
            grid-column-start: 5;
            grid-column-end: 7;
            grid-row-start: 3;
            grid-row-end: 5;
        }

        .gallery__item--4 {
            grid-column-start: 7;
            grid-column-end: 9;
            grid-row-start: 3;
            grid-row-end: 5;
        }

        #btn {
            background-image: url("Visit Now.png");
            height: 29px;
            width: 172px;
            border: none;
            border-radius: 10px;
            margin-left: 62px;
            margin-top: 4.6px;
        }

        .overlay1 {
            position: absolute;
            bottom: 100%;
            left: 0;
            right: 0;
            background-color: #ff4203c7;
            overflow: hidden;
            width: 147px;
            height: 0;
            transition: 0.5s ease;
            z-index: 1000;
        }

        div.a1 {
            position: absolute;
            top: 102px;
            left: 52px;
            width: 46px;
            height: 16px;
            background-image: url("wall tiles.png");
            text-align: center;
        }

        div.b1 {
            position: absolute;
            top: 47px;
            left: 44px;

            background-image: url("Floor Tiles.png");

            width: 48px;
            height: 16px;
            text-align: center;
        }

        .gallery__item--1:hover .overlay1 {
            top: 0;
            height: 207px;
        }

        .gallery__item--1:hover .a {
            display: none;
        }

        .text {
            color: white;
            font-size: 12px;
            position: absolute;
            top: 50%;
            left: 50%;
            -webkit-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            text-align: center;
        }

        /*  */
        .overlay2 {
            position: absolute;
            bottom: 100%;
            right: 0;
            /* right: ; */
            background-color: #ff4203c7;
            overflow: hidden;
            width: 146px;
            height: 0;
            transition: 0.5s ease;
            z-index: 1000;
        }

        .gallery__item--2:hover .overlay2 {
            top: 0;
            height: 103px;
        }

        .gallery__item--2:hover div.b {
            display: none;
        }

        div.a {
            position: absolute;
            top: 187px;
            left: 5px;
            width: 48px;
            height: 16px;
            background-image: url("wall tiles.png");
            z-index: 200;
        }

        div.b {
            position: absolute;
            top: 82px;
            left: 153px;
            background-image: url("Floor Tiles.png");
            width: 50px;
            height: 16px;
            text-align: center;
            z-index: 200;
        }

        div.e {
            position: absolute;
            top: 45px;
            left: 12px;
            background-image: url("Catalogue.png");
            width: 45px;
            height: 16px;
            text-align: center;
            z-index: 1000;
        }

        div.f {
            position: absolute;
            top: 45px;
            left: 7.5px;
            background-image: url("Where to buy.png");
            width: 57px;
            height: 16px;
            text-align: center;
            z-index: 1000;
        }

        .text2 {
            color: white;
            font-size: 12px;
            position: absolute;
            top: 50%;
            left: 50%;
            -webkit-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            text-align: center;
        }

        /*  */
        .overlay3 {
            position: absolute;
            bottom: 100%;
            right: 74px;
            background-color: #ff4203c7;
            overflow: hidden;
            width: 71.98px;
            height: 0;
            transition: 0.5s ease;
        }

        .gallery__item--3:hover .overlay3 {
            top: 105px;
            height: 102px;
        }

        .text3 {
            color: #f16233;
            background-color: white;
            font-size: 11px;
            font-weight: bolder;
            padding: 2px;
            position: absolute;
            top: 50%;
            left: 50%;
            -webkit-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            text-align: center;
        }

        /*  */
        .overlay4 {
            position: absolute;
            bottom: 100%;
            right: 0;
            background-color: #ff4203c7;
            overflow: hidden;
            width: 71.98px;
            height: 0;
            transition: 0.5s ease;
        }

        .gallery__item--4:hover .overlay4 {
            top: 105px;
            height: 102px;
        }

        .text4 {
            color: white;
            font-size: 20px;
            position: absolute;
            top: 50%;
            left: 50%;
            -webkit-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .gradient_bg {
            background: rgb(11, 34, 64);
            background: radial-gradient(circle, rgba(11, 34, 64, 1) 0%, rgba(9, 14, 22, 1) 65%);
        }

        /*  */

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    @php
        $images = json_decode($creative->image, true);
        $countImages = count($images);
    @endphp
    <div class="w-full h-screen  gradient_bg flex flex-col justify-center items-center relative">
        <div id="remove3" class="header bg-[#2D3A43] absolute w-full top-0">Create creative with AI</div>
        <div class="flex flex-col justify-center items-center">
            <div class="container">
                <div class="gallery">
                    <figure class="gallery__item gallery__item--1" id="aa1">
                        <a target="__blank" href="{{ $creative->landing_url }}">
                            <img id="firstImg" border="0" src="{{ asset('uploads/' . $images[0]) }}"
                                alt="Gallery image 1" class="gallery__img" />

                            <div class="overlay1">
                                <div class="a1"></div>
                                <div class="text"></div>
                            </div>
                        </a>
                    </figure>
                    <figure class="gallery__item gallery__item--2">
                        <a class="option" target="__blank" href="{{ $creative->landing_url }}">
                            <img id="secondImg" border="0" src="{{ asset('uploads/' . $images[1]) }}"
                                alt="Gallery image 1" class="gallery__img" />
                            <div class="overlay2">
                                <div class="b1"></div>
                            </div>
                        </a>
                    </figure>
                    <figure class="gallery__item gallery__item--3">
                        <a class="option" target="__blank" href="{{ $creative->landing_url }}"><img
                                src="{{ asset('uploads/' . $images[2]) }}" alt="Gallery image 3" class="gallery__img" />

                            <div class="overlay3">
                                <div class="e"></div>
                            </div>
                        </a>
                    </figure>
                    <figure class="gallery__item gallery__item--4">
                        <a class="option" target="__blank" href="{{ $creative->landing_url }}">
                            <img src="{{ asset('uploads/' . $images[3]) }}" alt="Gallery image 4"
                                class="gallery__img" />

                            <div class="overlay4">
                                <div class="f"></div>
                            </div>
                        </a>
                    </figure>

                    <div class="a"></div>

                    <div class="b"></div>

                    <a class="option" target="__blank" href="{{ $creative->tracking_url }}">
                        <button id="btn"
                            class="text-white px-4 py-1 bg-blue-600 ml-1 mt-1">{{ $creative->cta_name ?? 'Click' }}</button>
                    </a>


                </div>
            </div>
            <div id="remove" class="w-full">
                <div class="flex flex-col items-start text-white mt-2">
                    <div class="checkbox-group flex flex-col">
                        <h3>Available Dimention:</h3>
                        <label class="cursor-pointer">
                            <input type="checkbox" name="options" value="300x250" checked />
                            300x250
                        </label>
                        <!--
                            <label class="cursor-pointer">
                                <input type="checkbox" name="options" value="300x600" />
                                300x600
                            </label>
                            <label class="cursor-pointer">
                                <input type="checkbox" name="options" value="320x480" />
                                320x480
                            </label>
                            <label class="cursor-pointer">
                                <input type="checkbox" name="options" value="600x600" />
                                600x600
                            </label>
                            -->

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
        document.addEventListener("DOMContentLoaded", () => {
            function recurse() {
                setTimeout(function() {
                    slideStart();
                }, 1000);
                setTimeout(function() {
                    slideStop();
                    slideStart1();
                }, 3000);

                setTimeout(function() {
                    slideStop1();
                }, 5000);
            }

            recurse();
        });
        var currentIndex = 0,
            tOut = null;
        var targetObj = document.getElementById("firstImg");
        targetObj.onmouseover = slideStart;
        targetObj.onmouseout = slideStop;

        var initialSrc = targetObj.src;
        var allImages = ["Akij-Wall-Tiles-Thumb", "Akij-Wall-Tiles-1"];

        function slideStart() {
            var nextIndex =
                currentIndex + 1 >= allImages.length ? 0 : currentIndex + 1;
            var newSrc = targetObj.src.replace(
                allImages[currentIndex],
                allImages[nextIndex]
            );
            targetObj.src = newSrc;
            currentIndex = nextIndex;
            tOut = setTimeout(slideStart, 1000);
        }

        function slideStop() {
            clearTimeout(tOut);
            targetObj.src = initialSrc;
        }
    </script>
    <script>
        var currentIndex1 = 0,
            tOut1 = null;
        var targetObj1 = document.getElementById("secondImg");
        targetObj1.onmouseover = slideStart1;
        targetObj1.onmouseout = slideStop1;
        var initialSrc1 = targetObj1.src;
        var allImages1 = ["Akij-Floor-Tiles-Thumb", "Akij-Floor-Tiles-1"];

        function slideStart1() {
            var nextIndex1 =
                currentIndex1 + 1 >= allImages1.length ? 0 : currentIndex1 + 1;
            var newSrc1 = targetObj1.src.replace(
                allImages1[currentIndex1],
                allImages1[nextIndex1]
            );
            targetObj1.src = newSrc1;
            currentIndex1 = nextIndex1;
            tOut1 = setTimeout(slideStart1, 1000);
        }

        function slideStop1() {
            clearTimeout(tOut1);
            targetObj1.src = initialSrc1;
        }

        document.getElementById("download-btn").addEventListener("click", async function() {
            // Capture the HTML content of the page
            var pageContent = document.documentElement.outerHTML;

            // Remove specific elements
            pageContent = pageContent.replace(/<div id="remove2".*?>.*?<\/div>/s, '');
            pageContent = pageContent.replace(/<div id="remove".*?>.*?<\/div>/s, '');
            pageContent = pageContent.replace(/<div id="remove3".*?>.*?<\/div>/s, '');

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

            // Create a ZIP file using JSZip
            const zip = new JSZip();
            zip.file("index.html", pageContent);

            // Generate the ZIP file
            const content = await zip.generateAsync({
                type: "blob"
            });

            // Download the ZIP file
            const link = document.createElement("a");
            link.href = URL.createObjectURL(content);
            link.download = "creative.zip";
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
</body>

</html>
