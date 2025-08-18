<!DOCTYPE html>
<html lang="en" class="theme_switchable">

<head>
    <meta charset="UTF-8" />
    <title>Toucan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.0/normalize.min.css" />
    <link rel="stylesheet" href="https://static.fontawesome.com/css/fontawesome-app.css" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.2.0/css/all.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        div#user-button {
            display: none;
        }

        @import url(https://pro.fontawesome.com/releases/v5.11.2/css/all.css);

        :root {
            --user-button-circle: rgba(0, 0, 0, 0.025);
            --user-button-cardborder: rgba(255, 255, 255, 0.25);
            --user-button-text: #323133;
            --user-button-shadow: rgba(0, 0, 0, 0.1);
        }

        #user-button {
            z-index: 1000;
            bottom: 1rem !important;
            right: 1rem !important;
            color: var(--user-button-text);
            transition: 1s 0s ease-out;
            -webkit-animation: slide 3s ease-out forwards;
            animation: slide 3s ease-out forwards;
        }

        @-webkit-keyframes slide {

            0%,
            50% {
                opacity: 0;
                display: block !important;
            }

            100% {
                opacity: 1;
                display: block !important;
            }
        }

        @keyframes slide {

            0%,
            50% {
                opacity: 0;
                display: block !important;
            }

            100% {
                opacity: 1;
                display: block !important;
            }
        }

        #user-button .u-card {
            border-radius: 100%;
            box-shadow: 0 0 1rem -0.25rem var(--user-button-shadow),
                inset 0 0 1rem -0.75rem var(--user-button-shadow);
        }

        #user-button .u-main {
            cursor: pointer;
            --user-button-background: var(--user-button-main, #ec87c0);
        }

        #user-button .u-main img {
            height: 100%;
            width: 100%;
        }

        #user-button .u-main iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 4rem;
            height: 4rem;
            opacity: 1;
            transition: 0s 4s;
        }

        #user-button .u-icons {
            position: relative;
            z-index: 950;
            transform: translate(-50%, -50%);
            background: var(--user-button-circle);
            box-shadow: 0 0 0 0.125rem var(--user-button-cardborder);
            border-radius: 100%;
            transition: 0.25s;
            opacity: 1 !important;
            -webkit-backdrop-filter: blur(10px);
            backdrop-filter: blur(10px);
            /*&:before {
     z-index:-1;
     position:absolute;
     top:0; right:0; bottom:0; left:0;
     content:'';

     backdrop-filter: blur(10px);
  }*/
        }

        #user-button .u-icons a {
            color: inherit;
            display: grid;
            place-items: center;
            width: 30px;
            height: 30px;
            text-decoration: none;
        }

        #user-button .u-icons a div {
            padding: 0.5rem;
            transition: 0s;
        }

        #user-button .u-icons a[href="https://twitter.com/Osorpenke"] {
            position: relative;
        }

        #user-button .u-icons a[href="https://twitter.com/Osorpenke"]:before {
            content: "Middle Click";
            position: absolute;
            top: -1.5rem;
            left: 50%;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            white-space: pre;
            transform: translateX(-50%);
            opacity: 0;
            pointer-events: none;
            transition: 0.25s ease-in;
            background: #fffc;
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
        }

        #user-button .u-icons a[href="https://twitter.com/Osorpenke"].show:before {
            opacity: 1;
            transition: 0.25s ease-out;
        }

        #user-button .u-icons a[href="https://twitter.com/Osorpenke"] div {
            color: #1da1f2;
        }

        #user-button .u-icons a[href="https://codepen.io/z-"] div {
            background: black;
            color: white;
        }

        #user-button .u-icons a.u-random div {
            position: relative;
            top: -1px;
            -webkit-animation: diespin 2s linear infinite;
            animation: diespin 2s linear infinite;
        }

        @-webkit-keyframes diespin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes diespin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        #user-button .u-icons a.u-random:not(:hover) div {
            -webkit-animation-play-state: paused;
            animation-play-state: paused;
        }

        #user-button .u-icons>* {
            position: absolute;
            width: 30px;
            height: 30px;
            background: var(--singlecolour);
            border-radius: 100%;
            cursor: pointer;
            transform: translate(-50%, -50%);
            transition: 0.25s -0.05s;
        }

        #user-button .u-icons>*:before {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        #user-button .u-icons>*:hover,
        #user-button .u-icons>*:focus-within {
            background: var(--hcolour);
        }

        #user-button .u-icons>*:first-child:nth-last-child(1):nth-child(1),

        #user-button .u-icons>*:first-child:nth-last-child(1)~*:nth-child(1) {
            left: 25%;
            top: 25%;
        }

        #user-button .u-icons>*:first-child:nth-last-child(2):nth-child(1),

        #user-button .u-icons>*:first-child:nth-last-child(2)~*:nth-child(1) {
            left: 37.5%;
            top: 18.75%;
        }

        #user-button .u-icons>*:first-child:nth-last-child(2):nth-child(2),

        #user-button .u-icons>*:first-child:nth-last-child(2)~*:nth-child(2) {
            left: 18.75%;
            top: 37.5%;
        }

        #user-button .u-icons>*:first-child:nth-last-child(3):nth-child(1),

        #user-button .u-icons>*:first-child:nth-last-child(3)~*:nth-child(1) {
            left: 50%;
            top: 15.625%;
        }

        #user-button .u-icons>*:first-child:nth-last-child(3):nth-child(2),

        #user-button .u-icons>*:first-child:nth-last-child(3)~*:nth-child(2) {
            left: 25%;
            top: 25%;
        }

        #user-button .u-icons>*:first-child:nth-last-child(3):nth-child(3),

        #user-button .u-icons>*:first-child:nth-last-child(3)~*:nth-child(3) {
            left: 15.625%;
            top: 50%;
        }

        #user-button .u-icons>*:first-child:nth-last-child(4):nth-child(1),

        #user-button .u-icons>*:first-child:nth-last-child(4)~*:nth-child(1) {
            left: 62.5%;
            top: 18.75%;
        }

        #user-button .u-icons>*:first-child:nth-last-child(4):nth-child(2),

        #user-button .u-icons>*:first-child:nth-last-child(4)~*:nth-child(2) {
            left: 37.5%;
            top: 18.75%;
        }

        #user-button .u-icons>*:first-child:nth-last-child(4):nth-child(3),

        #user-button .u-icons>*:first-child:nth-last-child(4)~*:nth-child(3) {
            left: 18.75%;
            top: 37.5%;
        }

        #user-button .u-icons>*:first-child:nth-last-child(4):nth-child(4),

        #user-button .u-icons>*:first-child:nth-last-child(4)~*:nth-child(4) {
            left: 18.75%;
            top: 62.5%;
        }

        #user-button:hover .u-icons,
        #user-button:focus-within .u-icons {
            width: 300% !important;
            height: 300% !important;
        }


        .credit {
            position: absolute;
            bottom: 20px;
            left: 20px;
            color: inherit;
        }


        #parent .options {
            display: flex;
            flex-direction: row;
            align-items: stretch;
            overflow: hidden;
            min-width: 600px;
            max-width: 900px;
            position: relative;
            top: 10%;
            left: -40%;
            width: calc(100% - 100px);
            height: 400px;
        }

        /* @media screen and (max-width: 718px) {
   .options {
    min-width: 520px;
  }
  .options .option:nth-child(5) {
    display: none;
  }
}
@media screen and (max-width: 638px) {
  .options {
    min-width: 440px;
  }
  .options .option:nth-child(4) {
    display: none;
  }
}
@media screen and (max-width: 558px) {
  .options {
    min-width: 360px;
  }
   .options .option:nth-child(3) {
    display: none;
  }
}
@media screen and (max-width: 478px) {
  .options {
    min-width: 280px;
  }
  .options .option:nth-child(2) {
    display: none;
  }
} */
        .options .option {
            position: relative;
            overflow: hidden;
            min-width: 60px;
            margin: 10px;
            background: var(--optionBackground, var(--defaultBackground, #e6e9ed));
            background-size: auto 120%;
            background-position: center;
            cursor: pointer;
            transition: 0.5s cubic-bezier(0.05, 0.61, 0.41, 0.95);
        }

        .options .option:nth-child(1) {
            --defaultBackground: #ed5565;
        }

        .options .option:nth-child(2) {
            --defaultBackground: #fc6e51;
        }

        .options .option:nth-child(3) {
            --defaultBackground: #ffce54;
        }

        .options .option:nth-child(4) {
            --defaultBackground: #2ecc71;
        }

        .options .option:nth-child(5) {
            --defaultBackground: #5d9cec;
        }

        .options .option:nth-child(6) {
            --defaultBackground: #ac92ec;
        }

        .options .option.active {
            flex-grow: 10000;
            transform: scale(1);
            max-width: 600px;
            margin: 0px;
            border-radius: 40px;
            background-size: auto 100%;
            /*&:active {
     transform:scale(0.9);
  }*/
        }

        .options .option.active .shadow {
            box-shadow: inset 0 -120px 120px -120px black,
                inset 0 -120px 120px -100px black;
        }

        .options .option.active .label {
            bottom: 20px;
            left: 20px;
        }

        .options .option.active .label .info>div {
            left: 0px;
            opacity: 1;
        }

        .options .option:not(.active) {
            flex-grow: 1;
            border-radius: 30px;
        }

        .options .option:not(.active) .shadow {
            bottom: -40px;
            box-shadow: inset 0 -120px 0px -120px black,
                inset 0 -120px 0px -100px black;
        }

        .options .option:not(.active) .label {
            bottom: 10px;
            left: 10px;
        }

        .options .option:not(.active) .label .info>div {
            left: 20px;
            opacity: 0;
        }

        .options .option .shadow {
            position: absolute;
            bottom: 0px;
            left: 0px;
            right: 0px;
            height: 120px;
            transition: 0.5s cubic-bezier(0.05, 0.61, 0.41, 0.95);
        }

        .options .option .label {
            display: flex;
            position: absolute;
            right: 0px;
            height: 40px;
            transition: 0.5s cubic-bezier(0.05, 0.61, 0.41, 0.95);
        }

        .options .option .label .icon {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            min-width: 40px;
            max-width: 40px;
            height: 40px;
            border-radius: 100%;
            background-color: white;
            color: var(--defaultBackground);
        }

        .options .option .label .info {
            display: flex;
            flex-direction: column;
            justify-content: center;
            margin-left: 10px;
            color: white;
            white-space: pre;
        }

        .options .option .label .info>div {
            position: relative;
            transition: 0.5s cubic-bezier(0.05, 0.61, 0.41, 0.95),
                opacity 0.5s ease-out;
        }

        .options .option .label .info .main {
            font-weight: bold;
            font-size: 1.2rem;
        }

        .options .option .label .info .sub {
            transition-delay: 0.1s;
        }

        .options {
            scale: 0.49;
        }

        #parent {
            width: 350px;
            position: relative;
        }

        #main {
            width: 100%;
            background: white;
            height: 100vh;
            background: rgb(11, 34, 64);
            background: radial-gradient(circle, rgba(11, 34, 64, 1) 0%, rgba(9, 14, 22, 1) 65%);
            display: flex;
            justify-content: center;
            align-items: center;
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

        .gradient_bg {
            min-height: 100vh;
            background: rgb(11, 34, 64);
            background: radial-gradient(circle, rgba(11, 34, 64, 1) 0%, rgba(9, 14, 22, 1) 65%);
        }
    </style>
</head>

<body>
        <!-- partial:index.partial.html -->
        <div id="main" class="flex flex-col gradient_bg relative">
            <div id="remove3" class="header bg-[#2D3A43] absolute top-0 w-full">Create creative with AI</div>
            <div id="parent">
                <div class="options">

                    <div class="option" id="2"
                        style="--optionBackground: url('https://images.pexels.com/photos/4207620/pexels-photo-4207620.jpeg?auto=compress&cs=tinysrgb&w=600')">
                        <div class="shadow"></div>
                        <a href="#">
                            <div class="label">
                                <div class="icon">
                                    <img src="L1.png" />
                                </div>
                                <div class="info">
                                    <div class="main">Feel The Rush</div>
                                    <div class="sub">Intense Muscle T Shirt</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="option" id="5"
                        style="--optionBackground: url('https://images.pexels.com/photos/17343119/pexels-photo-17343119/free-photo-of-a-potted-plant-sits-on-a-small-stool-next-to-a-clock.jpeg?auto=compress&cs=tinysrgb&w=600')">
                        <div class="shadow"></div>
                        <a href="#">
                            <div class="label">
                                <div class="icon">
                                    <img src="L1.png" />
                                </div>
                                <div class="info">
                                    <div class="main">Speed Up</div>
                                    <div class="sub">Intense Shorts</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="option" id="3"
                        style="--optionBackground: url('https://images.pexels.com/photos/3392937/pexels-photo-3392937.jpeg?auto=compress&cs=tinysrgb&w=600')">
                        <div class="shadow"></div>
                        <a href="#">
                            <div class="label">
                                <div class="icon">
                                    <img src="L1.png" />
                                </div>
                                <div class="info">
                                    <div class="main">Good Form</div>
                                    <div class="sub">Go Easy T-Shirt</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="option" id="4"
                        style="--optionBackground: url('https://images.pexels.com/photos/7184402/pexels-photo-7184402.jpeg?auto=compress&cs=tinysrgb&w=600')">
                        <div class="shadow"></div>
                        <a href="#">
                            <div class="label">
                                <div class="icon">
                                    <img src="L1.png" />
                                </div>
                                <div class="info">
                                    <div class="main">Break A Sweat</div>
                                    <div class="sub">Vitality Collection</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="option" id="5"
                        style="--optionBackground: url('https://images.pexels.com/photos/17343119/pexels-photo-17343119/free-photo-of-a-potted-plant-sits-on-a-small-stool-next-to-a-clock.jpeg?auto=compress&cs=tinysrgb&w=600')">
                        <div class="shadow"></div>
                        <a href="#">
                            <div class="label">
                                <div class="icon">
                                    <img src="L1.png" />
                                </div>
                                <div class="info">
                                    <div class="main">Speed Up</div>
                                    <div class="sub">Intense Shorts</div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div id="remove" class="w-[310px]">                              
                <div class="flex flex-col items-start text-white -mt-12">
                    <div class="checkbox-group flex flex-col">
                        <h3>Available Dimention:</h3>
                        <label class="cursor-pointer">
                            <input type="checkbox" name="options" value="300x250" checked />
                            300x250
                        </label>
                    </div>

                    <div id="remove2" class="mt-4 d-flex justify-content-center">
                        <button class="btn bg-blue-600 text-white px-7 py-1.5 text-md rounded-lg"
                            id="download-btn">Download as HTML</button>
                    </div>
                </div>
            </div>
        </div>

    <!-- partial -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- <script src='https://codepen.io/z-/pen/jvReOb/a8e37caf2a04602ea5815e5acedab458.js'></script> -->
    <script>
        $(".option").on("click", function() {
            _this = $(this);
            var id = $(this).attr("id");
            var url = $(this).find("a").attr("href");
            let isActive = $(this).hasClass("active");
            if (isActive) {
                window.open(url);
            } else {
                rich_event_tracking(id);
                $(".option").removeClass("active");
                _this.addClass("active");
            }
        });

        function rich_event_tracking(event) {
            let paramString = window.location.search;
            let queryString = new URLSearchParams(paramString);
            let bid = queryString.get("bid");
            let impid = queryString.get("impid");
            let campaign_id = queryString.get("campaign_id");

            let url = "";
            const image = document.createElement("img");
            image.setAttribute("id", "rich_event");
            image.src = url;
            image.style = "display:none";
            document.body.appendChild(image);
        }

        document.getElementById("download-btn").addEventListener("click", function() {
            // Capture the HTML content of the entire page
            var pageContent = document.documentElement.outerHTML;
 
            //    pageContent = pageContent.replace(/<x-app-layout[^>]*>|<\/x-app-layout>/g, '');
 
 
            // Remove the specific div with id "remove"
 
            pageContent = pageContent.replace(/<div id="remove".*?>.*?<\/div>/s, '');
            pageContent = pageContent.replace(/<div id="remove2".*?>.*?<\/div>/s, '');
            pageContent = pageContent.replace(/<div id="remove3".*?>.*?<\/div>/gs, '');
 
 
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
