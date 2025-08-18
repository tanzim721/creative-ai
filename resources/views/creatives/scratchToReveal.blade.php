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
    <link rel="stylesheet" href="./style.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes slidein {
            from {
                top: 80px;
                left: 30px;
            }

            to {
                top: 80px;
                left: 180px;
            }
        }

        #parent {
            position: relative;
        }

        #canvas {
            /* background: url("https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT0IB6tb3nN_Zjj1wLURTPjYwnZHZOINe7CNA&s"); */
            background-size: 100% 100%;
            position: relative;
        }

        .hand {
            position: absolute;
            height: 50px;
            width: 50px;
            /* background-color: aqua; */
            top: 30px;
            left: 30px;
            background: url("https://www.iconpacks.net/icons/1/free-hand-cursor-icon-1299-thumb.png");
            background-size: 50px;
            transform: rotateY(180deg);

            animation-duration: 1.5s;
            animation-name: slidein;
            animation-iteration-count: infinite;
        }

        .cta {
            position: absolute;
            top: 217px;
            left: 107px;
            border: 3px solid #026865;
            background-color: #026865;
            color: white;
            display: none;
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

<body class="w-full">
    @php
        $images = json_decode($creative->image, true);
        $countImages = count($images);
    @endphp
    <div class="w-full h-screen gradient_bg flex flex-col justify-center items-center">
        <div id="remove2" class="header bg-[#2D3A43] absolute w-full top-0">Create creative with AI</div>
        <div id="parent">
            <div class="relative">
                <canvas id="canvas" width="300" height="250"
                    style="background-image: url({{ asset('uploads/' . $images[0]) }})"></canvas>
                <a href={{ $creative->landing_url }} target="_blank" id="click_btn"
                    class="bg-blue-500 text-sm text-white px-3 py-1 rounded-full shadow-md absolute bottom-2 left-1/2 transform -translate-x-1/2">{{ $creative->cta_name ?? 'Click' }}</a>
            </div>
            <div class="hand"></div>
        </div>
        <div id="remove" class="w-[300px]">
            <div class="flex flex-col items-start text-white mt-2">
                <div class="checkbox-group flex flex-col">
                    <h3>Available Dimention:</h3>

                    <label class="cursor-pointer">
                        <input type="checkbox" name="options" value="1" checked />
                        250x300
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
        var canvas = document.getElementById("canvas"),
            ctx = canvas.getContext("2d"),
            isDown = false,
            radius = 20,
            pi2 = Math.PI * 2,
            img = new Image();

        /// load top image backgroud is set with CSS, se CSS corner)
        img.onload = start;
        img.src = "{{ asset('uploads/' . $images[1]) }}";
        /*img.src = 'https://i.imgur.com/TOWpuh2.jpg';*/

        /// start: setup graphics, comp mode and handlers
        function start() {
            ctx.drawImage(this, 0, 0, canvas.width, canvas.height);

            /// key, this will earse where next drawing is drawn
            ctx.globalCompositeOperation = "destination-out";

            canvas.onmousedown = handleMouseDown;
            canvas.onmousemove = handleMouseMove;

            canvas.ontouchstart = handleTouchDown;
            canvas.ontouchmove = handleTouchMove;

            window.onmouseup = handleMouseUp;
            window.ontouchend = handleTouchUp;
        }

        function handleMouseDown(e) {
            isDown = true;
            var pos = getXY(e);
            erase(pos.x, pos.y);
        }

        function handleMouseUp(e) {
            isDown = false;
        }

        function handleMouseMove(e) {
            if (!isDown) return;
            var pos = getXY(e);
            erase(pos.x, pos.y);
        }

        function handleTouchDown(e) {
            isDown = true;
            var pos = getTouchXY(e);
            erase(pos.x, pos.y);
        }

        function handleTouchUp(e) {
            isDown = false;
        }

        function handleTouchMove(e) {
            if (!isDown) return;
            var pos = getTouchXY(e);
            erase(pos.x, pos.y);
        }

        function getXY(e) {
            console.log(e);
            var rect = canvas.getBoundingClientRect();
            console.log(rect);
            retirect("https://www.prothomalo.com/");
            // retirect('https://www.prothomalo.com/');
            return {
                x: e.clientX - rect.left,
                y: e.clientY - rect.top,
            };
        }

        function getTouchXY(e) {
            console.log(e);
            console.log(e.changedTouches, e.changedTouches[0]);
            var rect = canvas.getBoundingClientRect();
            console.log(rect);
            retirect("");
            return {
                x: e.changedTouches[0].clientX - rect.left,
                y: e.changedTouches[0].clientY - rect.top,
            };
        }

        function retirect(redirect_url) {
            var x = document.getElementById("ccr");
            // event
            var rich_event = document.getElementById("rich_event");
            if (!rich_event) {
                rich_event_tracking();
            }
            // event end
            setTimeout(function() {
                // window.location.href = redirect_url;

                x.style.display = "block";
            }, 5000);
        }

        /// simply draws an arc in any color - due to comp mode
        /// it will erase rather than draw
        function erase(x, y) {
            console.log(x, y);
            ctx.beginPath();
            console.log(ctx);
            console.log(x, y, radius, 0, pi2);
            ctx.arc(x, y, radius, 0, pi2);
            ctx.fill();
        }

        // click and event


        function rich_event_tracking() {
            let paramString = window.location.search;
            let queryString = new URLSearchParams(paramString);
            let bid = queryString.get("bid");
            let impid = queryString.get("impid");
            let campaign_id = queryString.get("campaign_id");
            const image = document.createElement("img");
            image.setAttribute("id", "rich_event");
            image.src = "";
            image.style = "display:none";
            document.body.appendChild(image);
        }


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

            // Create a ZIP file using JSZip
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
                    canvasWidth = "320";
                    canvasHeight = "480";
                } else if (dimension === "3") {
                    canvasWidth = "300";
                    canvasHeight = "300";
                } else if (dimension === "4") {
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
