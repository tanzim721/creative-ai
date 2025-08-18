<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" href="{{ asset('img/icon.jpeg') }}" type="image/x-icon">
    <title>{{ $creative->creative_type->name }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .contain {
            max-width: 1200px;
            margin: 0 auto;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: transparent;
        }

        .main {
            width: 100%;
            height: 90%;
            background: #fff;
            padding-top: 0px;
            padding-left: 10px;
            padding-right: 10px;
            padding-bottom: 10px;
            border-radius: 5px;
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
        }

        .icon_container {
            width: 100%;
            height: 7%;
            display: flex;
            justify-content: end;
            padding: 5px;
        }

        .content {
            width: 100%;
            height: 93%;
        }

        #image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        #icon {
            width: 35px;
            height: 100%;
            object-fit: cover;
            cursor: pointer;
        }

        .d-none {
            display: none;
        }

        .header {
            background-color: #2D3A43;
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .gradient_bg {
            background: rgb(11, 34, 64);
            background: radial-gradient(circle, rgba(11, 34, 64, 1) 0%, rgba(9, 14, 22, 1) 65%);
        }

        .parent {
            width: 100%;
            min-height: 100vh;
        }
    </style>
</head>

<body>
    @php
        $images = json_decode($creative->image, true);
        $countImages = count($images);
    @endphp
    <div class="gradient_bg parent relative">
        <div id="remove" class="header bg-[]">Create creative with AI</div>
        <div class="contain px-6">
            <div class="main">
                <div class="icon_container">
                    <img id="icon" src="https://static.thenounproject.com/png/861785-200.png" alt="" />
                </div>
                <div class="content">
                    @foreach ($images as $image)
                        <img id="image" src="{{ asset('uploads/'.$image) }}" alt="" />
                    @endforeach
                </div>
            </div>
        </div>
        <div>
            <div id="remove2" class="flex justify-center pb-10">
                <button class="bg-blue-600 text-white px-7 py-1.5 text-md rounded-lg" id="download-btn">Download as
                    HTML
                </button>
            </div>
        </div>
    </div>

    <script>
        document.getElementById("icon").addEventListener("click", function() {
            document.querySelector(".contain").classList.add("d-none");
            document.querySelector(".main").classList.add("d-none");
        });
        document.getElementById("download-btn").addEventListener("click", function() {
            var pageContent = document.documentElement.outerHTML;

            pageContent = pageContent.replace(/<div id="remove".*?>.*?<\/div>/s, '');
            pageContent = pageContent.replace(/<div id="remove2".*?>.*?<\/div>/s, '');

            const blob = new Blob([pageContent], {
                type: 'text/html'
            });

            const link = document.createElement("a");
            link.href = URL.createObjectURL(blob);
            link.download = "index.html";
            link.click();
        });
    </script>
</body>

</html>
