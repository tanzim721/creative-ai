<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Generated Ads</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
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
            width: 100%;
            height: 250px;
            border-radius: 6px;
        }

        .carousel1-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 6px;
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
            0%, 17.5% {
                transform: translateZ(-182px) rotateY(0);
            }

            27.5%, 45% {
                transform: translateZ(-182px) rotateY(-120deg);
            }

            55%, 72.5% {
                transform: translateZ(-182px) rotateY(-240deg);
            }

            82.5%, 100% {
                transform: translateZ(-182px) rotateY(-360deg);
            }
        }
    </style>
</head>

<body>

    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Dashboard') }}</h2>
        </x-slot>

        <div class="container mt-5 p-4 border rounded">
            <div class="text-center mb-5">
                <h2 class="text-3xl font-bold">Generated Ads</h2>
                <p>Select your preferred creatives and generate more to see different layouts.</p>
            </div>

            <!-- Creative Selection Header -->
            <div class="d-flex justify-content-between align-items-center">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="selectAllCreatives">
                    <label class="form-check-label" for="selectAllCreatives">Select all creatives</label>
                </div>
            </div>

            <div class="row mt-4">
                <!-- Creative Item 1 with Carousel -->
                <div class="col-md-4 p-2">
                    <div class="form-check my-2">
                        <input class="form-check-input" type="checkbox" id="creative1">
                        <label class="form-check-label" for="creative1">Unblur on touch</label>
                    </div>
                    <div class="carousel1">
                        <div class="carousel1-content p-5">
                            @php
                                $mainAssets = json_decode($creative->main_asset, true);
                            @endphp
                            @foreach ($mainAssets as $item)
                                <div class="carousel1-item">
                                    <img src="{{ asset('storage/' . $item) }}" alt="Creative 1" style="height: auto; weight: 20px; padding: 10px">
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>

                <!-- Creative Item 2 -->
                <div class="col-md-4 p-2">
                    <div class="form-check my-2">
                        <input class="form-check-input" type="checkbox" id="creative2">
                        <label class="form-check-label" for="creative2">Train</label>
                    </div>
                    <img src="https://via.placeholder.com/300" class="img-fluid" alt="Creative 2">
                </div>

                <!-- Creative Item 3 -->
                <div class="col-md-4 p-2">
                    <div class="form-check my-2">
                        <input class="form-check-input" type="checkbox" id="creative3">
                        <label class="form-check-label" for="creative3">3D Prism</label>
                    </div>
                    <img src="https://via.placeholder.com/300" class="img-fluid" alt="Creative 3">
                </div>
            </div>

            <!-- Campaign Actions -->
            <div class="d-flex justify-content-between mt-3">
                <button class="btn btn-link">Go Back</button>
                <div>
                    <button class="btn btn-secondary">Dismiss All</button>
                    <button class="btn btn-primary" id="saveSelection">Save Selection as Campaign</button>
                </div>
            </div>
        </div>
    </x-app-layout>

    <script>
        document.getElementById("selectAllCreatives").addEventListener("change", function () {
            let checkboxes = document.querySelectorAll(".form-check-input");
            checkboxes.forEach(checkbox => checkbox.checked = this.checked);
        });

        document.getElementById("saveSelection").addEventListener("click", function () {
            alert("Saving your selection as a campaign...");
        });
    </script>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
