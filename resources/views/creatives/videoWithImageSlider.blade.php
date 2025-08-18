<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="icon" href="{{ asset('img/icon.jpeg') }}" type="image/x-icon">
    <style>
        body {
            width: 100%;
            overflow: hidden;
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        video {
            border: 1px solid #ccc;
            height: 160px;
            width: 300px;
        }

        .scrollmenu img {
            width: 90px;
            height: 80px;
        }


        div.gallery {
            border: 1px solid #ccc;
        }

        div.gallery:hover {
            border: 1px solid #777;
        }

        div.gallery img {
            width: 100%;
            height: auto;
        }

        div.desc {
            padding: 15px;
            text-align: center;
        }

        * {
            box-sizing: border-box;
        }

        .responsive {
            padding: 0 6px;
            float: left;
            width: 24.99999%;
        }

        @media only screen and (max-width: 700px) {
            .responsive {
                width: 49.99999%;
                margin: 6px 0;
            }
        }

        @media only screen and (max-width: 500px) {
            .responsive {
                width: 100%;
            }
        }

        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        button {
            margin-left: 118px;
            margin-right: 113px;
        }

        div.scrollmenu {
            background-color: rgb(255, 255, 255);
            overflow: auto;
            white-space: nowrap;
            overflow-x: scroll;
            overflow-y: hidden;
            height: 100px;
            width: 100%;
            white-space: nowrap;
        }

        div.scrollmenu a {
            display: inline-block;
            color: white;
            text-align: center;
            padding: 5px;
            text-decoration: none;
        }

        div.scrollmenu::-webkit-scrollbar {
            height: 12px !important;
            margin-top: 0px;
        }

        div.scrollmenu::-webkit-scrollbar-track {
            box-shadow: inset 0 0 6px rgb(255, 255, 255);
        }

        div.scrollmenu::-webkit-scrollbar-thumb {
            background-color: #fec214;
            outline: 1px solid #fec214;
        }

        .cc {
            position: relative;
            margin-left: -16px;
            margin-top: -9px;
        }

        .aligned {
            display: flex;
            align-items: center;
        }

        span {
            padding: 10px;
        }

        .containerScroll {
            width: 300px;
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
    <div class="w-full h-screen gradient_bg flex justify-center items-center relative">
        <div id="remove3" class="header bg-[#2D3A43] absolute w-full top-0">Create creative with AI</div>
        <div class="cc">
            @if (!empty($videos) && isset($videos[0]))
                <div class="video_container">
                    <a href="{{ url($creative->landing_url) }}" target="_blank" rel="noopener">
                        <video src="{{ asset('uploads/' . $videos[0]) }}" controls autoplay loop muted></video>
                    </a>
                </div>
            @endif
            <div class="mobilehide tablethide"
                style="
                    display: -webkit-flex;
                    display: flex;
                    width: 58px;
                    float: right;
                    margin-top: -50px;
                    left: 27px;
                    position: relative;
                    z-index: 999;
                    ">
            </div>

            <div class="containerScroll" id="main">
                <div class="scrollmenu">
                    @foreach ($images as $image)
                        <a href="{{ url($creative->landing_url) }}" target="_blank">
                            <img src="{{ asset('uploads/' . $image) }}" alt="" width="80px" />
                        </a>
                    @endforeach

                </div>

                <!-- <a href="#" target="_blank" rel="noopener"
                        class=" text-white bg-blue-600 px-7 py-1 mt-2 rounded-md absolute "><button>Visit</button></a> -->
            </div>


            <div id="remove">
                <div class="flex flex-col items-start text-white mt-2">
                    <div class="checkbox-group flex flex-col">
                        <h3>Available Dimention:</h3>
                        <label class="cursor-pointer">
                            <input type="checkbox" name="options" value="300x250" checked />
                            300x250
                        </label>
                        {{-- <label class="cursor-pointer">
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
                            </label> --}}
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
            jQuery(".videomute").click(function() {
                jQuery("video").prop("muted", !jQuery("video").prop("muted"));
                if (
                    jQuery(this).html() ==
                    '<img src="https://opengameart.org/sites/default/files/styles/medium/public/unmute.png" style="width: 43px;">'
                ) {
                    jQuery(this).html(
                        '<img src="https://opengameart.org/sites/default/files/styles/medium/public/mute.png" style="width: 43px;"> '
                    );
                } else {
                    jQuery(this).html(
                        '<img src="https://opengameart.org/sites/default/files/styles/medium/public/unmute.png" style="width: 43px;">'
                    );
                }
            });

            jQuery("video").trigger("play"); //for auto play
            jQuery("video").addClass("pause"); //for check pause or play add a class
            jQuery(".videopause").click(function() {
                if (jQuery(this).hasClass("pause")) {
                    jQuery("video").trigger("play");
                    jQuery(this).removeClass("pause");
                    jQuery(this).addClass("play");
                    jQuery(this).html(
                        '<img src="https://opengameart.org/sites/default/files/styles/medium/public/pause_1.png" style="width: 43px;">'
                    );
                } else {
                    jQuery("video").trigger("pause");
                    jQuery(this).removeClass("play");
                    jQuery(this).addClass("pause");
                    jQuery(this).html(
                        '<img src="https://opengameart.org/sites/default/files/styles/medium/public/play_1.png" style="width: 43px;">'
                    );
                }
            });
        </script>

        <script>
            document.getElementById("download-btn").addEventListener("click", function() {
                // Get selected dimensions
                const checkboxes = document.querySelectorAll("input[name='options']:checked");
                const dimensions = Array.from(checkboxes).map(checkbox => checkbox.value);

                if (dimensions.length === 0) {
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

                // Create a new JSZip instance
                const zip = new JSZip();

                dimensions.forEach(dimension => {
                    // Customize the HTML content for each dimension
                    let pageContent = document.documentElement.outerHTML;

                    pageContent = pageContent.replace(/<div id="remove2".*?>.*?<\/div>/s, '');
                    pageContent = pageContent.replace(/<div id="remove".*?>.*?<\/div>/s, '');
                    pageContent = pageContent.replace(/<div id="remove3".*?>.*?<\/div>/s, '');

                    pageContent = pageContent.replace(
                        '<head>',
                        `<head><style>/* Styles for ${dimension} */</style>`
                    );

                    // Add the modified HTML content to the zip
                    zip.file(`index_${dimension}.html`, pageContent);
                });

                // Generate the zip file
                zip.generateAsync({
                    type: "blob"
                }).then(function(blob) {
                    saveAs(blob, "creative_dimensions.zip");
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
    </div>
</body>

</html>
