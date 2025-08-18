<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>

    <style>
        body {
            background-color: #fff;
        }

        ::-webkit-scrollbar {}

        ::-webkit-scrollbar-track {
            background: #eee;
        }

        ::-webkit-scrollbar-thumb {
            background: #888;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        .wrapper {
            height: auto;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
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

        .main {
            background-color: #eee;
            width: 660px;
            position: relative;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2), 0 6px 20px rgba(0, 0, 0, 0.19);
        }

        .scroll {
            overflow-y: auto;
            scroll-behavior: smooth;
            height: 500px;
            padding: 10px;
        }

        .msg {
            background-color: #fff;
            font-size: 16px;
            padding: 8px;
            border-radius: 5px;
            font-weight: 500;
            color: #3e3c3c;
            margin-bottom: 10px;
        }

        .navbar {
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2), 0 6px 20px rgba(0, 0, 0, 0.19);
            padding: 10px;
        }


        .upload-box:hover {
            background-color: #e6e6e6;
        }

        /* Responsive design adjustments */
        @media (max-width: 768px) {

            .main {
                width: 100%;
                max-width: 100%;
            }

            .scroll {
                max-height: 300px;
            }

            .form-control {
                width: 75%;
            }

            .icon2 {
                font-size: 20px;
            }
        }

        @media (max-width: 576px) {

            .form-control {
                width: 70%;
            }

            .icon2 {
                font-size: 18px;
            }
        }
    </style>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
    <x-app-layout>
        <div class="wrapper">
            <div class="main">
                <div class="header">Create creative with AI</div>
                <div class="scroll">
                    <div class="d-flex align-items-center" style="opacity: 0; transition: opacity 1.5s ease-in-out;">
                        <div>
                            <p class="msg" style="animation: fadeIn 1.5s ease-in-out forwards;">Hello, How can I help you <br>
                                <button class="btn btn-primary btn-sm" id="createCreative"
                                style="animation: fadeIn 1.5s ease-in-out forwards;">Create Creative</button>
                            </p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center text-right justify-content-end">
                        <div>
                            <p class="msg d-none" id="selectCreateCreative"></p>
                        </div>
                    </div>
                    <div class="form-section d-none" id="sizeSection">
                        <label for="size">Size (px):</label>
                        <div class="d-flex flex-wrap">
                            <span class="badge badge-secondary m-1" style="cursor: pointer;"
                                data-size="300x250">300x250</span>
                            <span class="badge badge-secondary m-1" style="cursor: pointer;"
                                data-size="336x280">336x280</span>
                            <span class="badge badge-secondary m-1" style="cursor: pointer;"
                                data-size="728x90">728x90</span>
                            <span class="badge badge-secondary m-1" style="cursor: pointer;"
                                data-size="160x600">160x600</span>
                            <span class="badge badge-secondary m-1" style="cursor: pointer;"
                                data-size="300x600">300x600</span>
                        </div>
                        <input type="hidden" name="width" id="width">
                        <input type="hidden" name="height" id="height">
                    </div>
                    <div class="d-flex align-items-center text-right justify-content-end">
                        <div>
                            <p class="msg d-none" id="selectSize"></p>
                        </div>
                    </div>
                    <div class="upload-section d-none" id="uploadMainAssetSection">
                        <div class="upload-box">
                            <label for="main-asset">
                                <div class="input-box">
                                    <p class="d-none" id="uploadMainAsset"></p>
                                    <input type="file" id="main-asset" class="" multiple name="main_asset[]">
                                </div>
                            </label>
                            <div id="main-asset-preview"></div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center text-right justify-content-end">
                        <div>
                            <p class="msg d-none" id="selectMainAsset"></p>
                        </div>
                    </div>
                    <div class="upload-section d-none" id="uploadLogoAssetSection">
                        <div class="upload-box">
                            <label for="logo-asset">
                                <div class="input-box">
                                    <p class="d-none" id="uploadLogoAsset"></p>
                                    <input type="file" id="logo-asset" class="" multiple name="logo_asset">
                                </div>
                            </label>
                            <div id="logo-asset-preview"></div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center text-right justify-content-end">
                        <div>
                            <p class="msg d-none" id="selectLogoAsset"></p>
                        </div>
                    </div>

                </div>
                <div class="d-flex align-items-center text-right justify-content-end py-3 pe-2">
                    <div>
                        <button class="btn btn-success d-none" id="submitButton">Generate Creative</button>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelector(".d-flex").style.opacity = "1";

        });

        document.getElementById("createCreative").addEventListener("click", function() {
            document.getElementById("selectCreateCreative").classList.remove("d-none");
            document.getElementById("selectCreateCreative").innerHTML = "Select create creative";
        });

        document.getElementById("createCreative").addEventListener("click", function() {
            document.getElementById("sizeSection").classList.remove("d-none");
        });

        document.querySelectorAll('.badge[data-size]').forEach(badge => {
            badge.addEventListener("click", function() {
                document.getElementById("width").value = this.getAttribute("data-size").split("x")[0];
                document.getElementById("height").value = this.getAttribute("data-size").split("x")[1];
                document.getElementById("selectSize").classList.remove("d-none");
                document.getElementById("selectSize").innerHTML =
                    `Selected size: ${this.getAttribute("data-size")}`;
            });
        });

        document.querySelectorAll('.badge[data-size]').forEach(badge => {
            badge.addEventListener("click", function() {
                document.getElementById("uploadMainAssetSection").classList.remove("d-none");
                document.getElementById("uploadMainAsset").classList.remove("d-none");
                document.getElementById("uploadMainAsset").innerHTML = "Upload Main Asset";
            });
        });

        document.querySelector('input[type="file"]').addEventListener("change", function() {
            document.getElementById("selectMainAsset").classList.remove("d-none");
            document.getElementById("selectMainAsset").innerHTML = "Selected Main Asset";
            document.querySelector(".d-flex.align-items-center.text-right.justify-content-end").style.display =
                "flex";
        });

        document.querySelectorAll('.badge[data-size]').forEach(badge => {
            badge.addEventListener("click", function() {
                document.getElementById("uploadMainAssetSection").classList.remove("d-none");
                document.getElementById("uploadMainAsset").classList.remove("d-none");
                document.getElementById("uploadMainAsset").innerHTML = "Upload Main Asset";
            });
        });

        document.getElementById("main-asset").addEventListener("change", function() {
            document.getElementById("selectMainAsset").innerHTML = "Selected Main Asset";
            document.getElementById("uploadLogoAssetSection").classList.remove("d-none");
            document.getElementById("uploadLogoAsset").classList.remove("d-none");
            document.getElementById("uploadLogoAsset").innerHTML = "Upload Logo Asset";
        });

        document.getElementById("logo-asset").addEventListener("change", function() {
            document.getElementById("selectLogoAsset").classList.remove("d-none");
            document.getElementById("selectLogoAsset").innerHTML = "Selected Logo Asset";
            document.querySelector(".d-flex.align-items-center.text-right.justify-content-end").style.display =
                "flex";
        });
        document.getElementById("logo-asset").addEventListener("change", function() {
            if (this.files.length > 0) {
                document.getElementById("submitButton").classList.remove("d-none");
            }
        });
    </script>
    <script>
        function handleFileUpload(inputId, previewId, multiple = true) {
            const input = document.getElementById(inputId);
            const previewContainer = document.getElementById(previewId);

            input.addEventListener('change', function() {
                const files = Array.from(input.files);
                previewContainer.innerHTML = '';

                files.forEach((file, index) => {
                    const imageItem = document.createElement('div');
                    imageItem.className = 'image-item';
                    imageItem.innerHTML = `
                        <span>${file.name}</span>
                        ${multiple ? `<span class="delete-btn" onclick="removeFile('${inputId}', ${index})">&times;</span>` : ''}
                    `;
                    previewContainer.appendChild(imageItem);
                });

            });
        }

        function removeFile(inputId, index) {
            const input = document.getElementById(inputId);
            const dataTransfer = new DataTransfer(); // Create a new DataTransfer object

            // Copy existing files, except the one we want to remove
            for (let i = 0; i < input.files.length; i++) {
                if (i !== index) {
                    dataTransfer.items.add(input.files[i]);
                }
            }

            input.files = dataTransfer.files; // Assign new file list
            handleFileUpload(inputId, previewId, inputId === 'main-asset'); // Refresh the preview
        }

        // Initialize file uploads
        handleFileUpload('main-asset', 'main-asset-preview');
        handleFileUpload('logo-asset', 'logo-asset-preview', false);
        handleFileUpload('cta-asset', 'cta-asset-preview', false);
    </script>

</body>

</html>

