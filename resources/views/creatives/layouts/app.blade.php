<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title', 'Creative Scratch')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
            width: 900px;
            height: auto;
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
            width: 200px;
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

        .prism-container {
            perspective: 1000px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .prism {
            position: relative;
            width: 300px;
            height: 300px;

            transform-style: preserve-3d;
            transition: transform 0.5s;
            /* Smooth transition for rotation */
        }

        .face,
        .face1 {
            position: absolute;
            width: 300px;
            height: 300px;
            backface-visibility: hidden;
            border: 1px solid #ccc;
            background-size: cover;
        }

        .flipbook-container {
            perspective: 1000px;
            width: 400px;
            height: 300px;
            position: relative;
        }

        .flipbook {
            position: relative;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            transform-style: preserve-3d;
        }

        .page {
            position: absolute;
            width: 300px;
            height: 300px;
            background-color: #fff;
            backface-visibility: hidden;
            border: 1px solid #ccc;
            background-size: cover;
            transition: transform 0.6s ease;
        }

        @for ($i = 1; $i <= 5; $i++)
            .page:nth-child({{ $i }}) {
                transform: rotateY({{ ($i - 1) * -120 }}deg);
            }
        @endfor

        @foreach (range(1, 5) as $i)
            .face{{ $i }} {
                transform: rotateY({{ ($i - 1) * 120 }}deg);
            }
        @endforeach
        @foreach (range(1, 5) as $i)
            .faceV{{ $i }} {
                transform: rotateX({{ ($i - 1) * 120 }}deg);
            }
        @endforeach



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

        /* Responsive design adjustments */
        @media (max-width: 768px) {
            .main {
                width: 100%;
                max-width: 100%;
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

        /* for scratch */
        #scratchCanvas {
            cursor: pointer;
            position: absolute;
            top: 0;
            left: 0;
        }
        #scratchCanvas2 {
            cursor: pointer;
            position: absolute;
            top: 0;
            left: 0;
        }
        #scratchCanvas3 {
            cursor: pointer;
            position: absolute;
            top: 0;
            left: 0;
        }
        #scratchCanvas4 {
            cursor: pointer;
            position: absolute;
            top: 0;
            left: 0;
        }

        .image-container {
            position: relative;
            width: 300px;
            height: 250px;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: red;
        }

        .image-container2 {
            position: relative;
            width: 300px;
            height: 300px;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: red;
        }

        .image-container3 {
            position: relative;
            width: 480px;
            height: 320px;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: red;
        }

         .image-container4 {
            position: relative;
            width: 600px;
            height: 600px;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: red;
        }

        
        .overlay_container{
            position: absolute;
            width: 100%;
            min-width: 300px;
            height: 100%;
            background-color: transparent;
            z-index: 1;
        }
  
        #hiddenImage {
            width: 100%;
            height: 250px;
            z-index: 1;
        }
        canvas{
            z-index: 3; 
        }

        #hiddenImage2 {
            width: 100%;
            height: 300px;
        }

        #hiddenImage3 {
            width: 100%;
            height: 320px;
        }

        #hiddenImage4 {
            width: 100%;
            height: 600px;
        }
        .gradient_bg {
            min-height: 100vh;
            background: rgb(11, 34, 64);
            background: radial-gradient(circle, rgba(11, 34, 64, 1) 0%, rgba(9, 14, 22, 1) 65%);
        }
    </style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>


    @php
        $images = json_decode($creative->image, true);
        $countImages = count($images);
    @endphp
    @yield('content1')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    {{-- scratch creative --}}
    <script>
        $(document).ready(function() {
            //Global Variables
            var img = new Image();
            img.src = '';

            
            img.onload = function() {
                 ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
                 ctx.globalCompositeOperation = 'destination-out';
                 ctx2.drawImage(img, 0, 0, canvas2.width, canvas2.height);
                 ctx2.globalCompositeOperation = 'destination-out';
                 ctx3.drawImage(img, 0, 0, canvas3.width, canvas3.height);
                 ctx3.globalCompositeOperation = 'destination-out';
                 ctx4.drawImage(img, 0, 0, canvas4.width, canvas4.height);
                 ctx4.globalCompositeOperation = 'destination-out';
           };

            //For Image1 250*300
            var canvas = document.getElementById('scratchCanvas');           
            var ctx = canvas.getContext('2d');           
            var isScratching = false;
            
            $('#scratchCanvas').on('mousedown', function(e) {
                isScratching = true;
            }).on('mousemove', function(e) {
                if (isScratching) {
                    var x = e.offsetX;
                    var y = e.offsetY;
                    ctx.beginPath();
                    ctx.arc(x, y, 30, 0, Math.PI * 2);
                    ctx.fill();
                }
            }).on('mouseup', function(e) {
                isScratching = false;
                checkScratchCompletion();
            });

            $('#scratchCanvas').on('touchstart', function(e) {
                isScratching = true;
            }).on('touchmove', function(e) {
                if (isScratching) {
                    var touch = e.touches[0];
                    var x = touch.pageX - $(this).offset().left;
                    var y = touch.pageY - $(this).offset().top;
                    ctx.beginPath();
                    ctx.arc(x, y, 30, 0, Math.PI * 2);
                    ctx.fill();
                }
            }).on('touchend', function(e) {
                isScratching = false;
                checkScratchCompletion();
            });
            
            function checkScratchCompletion() {
                var scratchedArea = 0;
                var imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
                var totalPixels = imageData.data.length / 4;
                for (var i = 0; i < totalPixels; i++) {
                    if (imageData.data[i * 4 + 3] === 0) {
                        scratchedArea++;
                    }
                }
                var scratchPercentage = (scratchedArea / totalPixels) * 100;
                if (scratchPercentage > 50) {
                    // alert("You've scratched enough!");
                }
            }
            

        //For Image2 300*300
        var canvas2 = document.getElementById('scratchCanvas2');
        var ctx2 = canvas2.getContext('2d');
        var isScratching2 = false;

            $('#scratchCanvas2').on('mousedown', function(e) {
                isScratching2 = true;
            }).on('mousemove', function(e) {
                if (isScratching2) {
                    var x = e.offsetX;
                    var y = e.offsetY;
                    ctx2.beginPath();
                    ctx2.arc(x, y, 30, 0, Math.PI * 2);
                    ctx2.fill();
                }
            }).on('mouseup', function(e) {
                isScratching2 = false;
                checkScratchCompletion2();
            });

            $('#scratchCanvas2').on('touchstart', function(e) {
                isScratching2 = true;
            }).on('touchmove', function(e) {
                if (isScratching2) {
                    var touch = e.touches[0];
                    var x = touch.pageX - $(this).offset().left;
                    var y = touch.pageY - $(this).offset().top;
                    ctx2.beginPath();
                    ctx2.arc(x, y, 30, 0, Math.PI * 2);
                    ctx2.fill();
                }
            }).on('touchend', function(e) {
                isScratching2 = false;
                checkScratchCompletion2();
            });

            function checkScratchCompletion2() {
                var scratchedArea = 0;
                var imageData = ctx2.getImageData(0, 0, canvas2.width, canvas2.height);
                var totalPixels = imageData.data.length / 4;
                for (var i = 0; i < totalPixels; i++) {
                    if (imageData.data[i * 4 + 3] === 0) {
                        scratchedArea++;
                    }
                }
                var scratchPercentage = (scratchedArea / totalPixels) * 100;
                if (scratchPercentage > 50) {
                    // alert("You've scratched enough!");
                }
            }



            //For Image3 320*480
            var canvas3 = document.getElementById('scratchCanvas3');
            var ctx3 = canvas3.getContext('2d');
            var isScratching3 = false;

            $('#scratchCanvas3').on('mousedown', function(e) {
                isScratching3 = true;
            }).on('mousemove', function(e) {
                if (isScratching3) {
                    var x = e.offsetX;
                    var y = e.offsetY;
                    ctx3.beginPath();
                    ctx3.arc(x, y, 30, 0, Math.PI * 2);
                    ctx3.fill();
                }
            }).on('mouseup', function(e) {
                isScratching3 = false;
                checkScratchCompletion3();
            });

            $('#scratchCanvas3').on('touchstart', function(e) {
                isScratching3 = true;
            }).on('touchmove', function(e) {
                if (isScratching3) {
                    var touch = e.touches[0];
                    var x = touch.pageX - $(this).offset().left;
                    var y = touch.pageY - $(this).offset().top;
                    ctx3.beginPath();
                    ctx3.arc(x, y, 30, 0, Math.PI * 2);
                    ctx3.fill();
                }
            }).on('touchend', function(e) {
                isScratching3 = false;
                checkScratchCompletion3();
            });

            function checkScratchCompletion3() {
                var scratchedArea = 0;
                var imageData = ctx3.getImageData(0, 0, canvas3.width, canvas3.height);
                var totalPixels = imageData.data.length / 4;
                for (var i = 0; i < totalPixels; i++) {
                    if (imageData.data[i * 4 + 3] === 0) {
                        scratchedArea++;
                    }
                }
                var scratchPercentage = (scratchedArea / totalPixels) * 100;
                if (scratchPercentage > 50) {
                    // alert("You've scratched enough!");
                }
            }


            //For Image4 600*600
        var canvas4 = document.getElementById('scratchCanvas4');
        var ctx4 = canvas4.getContext('2d');
        var isScratching4 = false;

            $('#scratchCanvas4').on('mousedown', function(e) {
                isScratching4 = true;
            }).on('mousemove', function(e) {
                if (isScratching4) {
                    var x = e.offsetX;
                    var y = e.offsetY;
                    ctx4.beginPath();
                    ctx4.arc(x, y, 30, 0, Math.PI * 2);
                    ctx4.fill();
                }
            }).on('mouseup', function(e) {
                isScratching4 = false;
                checkScratchCompletion4();
            });

            $('#scratchCanvas4').on('touchstart', function(e) {
                isScratching4 = true;
            }).on('touchmove', function(e) {
                if (isScratching4) {
                    var touch = e.touches[0];
                    var x = touch.pageX - $(this).offset().left;
                    var y = touch.pageY - $(this).offset().top;
                    ctx2.beginPath();
                    ctx2.arc(x, y, 30, 0, Math.PI * 2);
                    ctx2.fill();
                }
            }).on('touchend', function(e) {
                isScratching4 = false;
                checkScratchCompletion4();
            });

            function checkScratchCompletion4() {
                var scratchedArea = 0;
                var imageData = ctx2.getImageData(0, 0, canvas4.width, canvas4.height);
                var totalPixels = imageData.data.length / 4;
                for (var i = 0; i < totalPixels; i++) {
                    if (imageData.data[i * 4 + 3] === 0) {
                        scratchedArea++;
                    }
                }
                var scratchPercentage = (scratchedArea / totalPixels) * 100;
                if (scratchPercentage > 50) {
                    // alert("You've scratched enough!");
                }
            }
        });


        
        

        
        //Download Image1 250*300
        document.getElementById("downloadCanvas").addEventListener("click", function() {
            var link = document.createElement('a');
            link.setAttribute('href', 'data:text/html;charset=utf-8,' + encodeURIComponent(
                '<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Document</title></head><body>' +
                document.getElementById("scratchCanvas").outerHTML + '</body></html>'));
            link.setAttribute('download', 'canvas.html');
            link.style.display = 'none';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        });

        //Download Image2 300*300
        document.getElementById("downloadCanvas3").addEventListener("click", function() {
            var link = document.createElement('a');
            link.setAttribute('href', 'data:text/html;charset=utf-8,' + encodeURIComponent(
                '<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Document</title></head><body>' +
                document.getElementById("scratchCanvas").outerHTML + '</body></html>'));
            link.setAttribute('download', 'canvas.html');
            link.style.display = 'none';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        });

        //Download Image3 320*480
        document.getElementById("downloadCanvas3").addEventListener("click", function() {
            var link = document.createElement('a');
            link.setAttribute('href', 'data:text/html;charset=utf-8,' + encodeURIComponent(
                '<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Document</title></head><body>' +
                document.getElementById("scratchCanvas").outerHTML + '</body></html>'));
            link.setAttribute('download', 'canvas.html');
            link.style.display = 'none';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        });



        
    </script>

    {{-- carousel creative --}}
    


</body>

</html>
