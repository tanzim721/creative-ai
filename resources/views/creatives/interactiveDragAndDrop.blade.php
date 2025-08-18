<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>All Time Bread</title>
    <link href="https://fonts.googleapis.com/css?family=Shrikhand" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css" />
    <style>
        body {
            width: 100%;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 100%;
            color: #000;
            background-color: #fff;
        }

        html {
            margin: 0;
            padding: 0;
            outline: 0;
        }

        hr.new4 {
            border: 1px solid rgb(38, 78, 50);
            width: 200px;
        }

        h1 {
            font-family: "Shrikhand", Arial, Helvetica, sans-serif;
            text-align: center;
            color: rgba(67, 91, 131, 1);
            margin-top: 4px;
            padding-top: 1%;
            padding-bottom: 1%;
            background-color: #e0dbcd;
            border: 2px solid #fff;
            outline: 1px solid #ddd;
        }

        h3 {
            color: darkblue;
            padding-left: 2%;
        }

        .container {
            margin: 0 auto;
            width: 300px;
            min-height: 250px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        section {
            display: -webkit-flex;
            display: flex;
            flex: 1;
            background-color: #fff;
            /* margin: 2% 4%; */
            zoom: 0.95;
        }

        .columns {
            display: flex;
            flex: 1;
        }

        .left {
            flex: 1;
            background-color: #eeeff5;
            text-align: center;
            max-height: 250px !important;
            max-width: 300px !important;
        }

        #bread {
            width: 136px;
            height: 106px;
            background: #fff;
            margin: -79px auto;
            margin-bottom: 29px;
            /* background-image: url(http://www.movingpixelsdesign.com/codepen/bread.png); */
        }

        /* #bread {
  width: 134px;
  height: 114px;
  background: #fff;
  margin: -58px auto;
  margin-bottom: 29px;
  background-image: url(http://www.movingpixelsdesign.com/codepen/bread.png);
} */
        .plate {
            background-image: url(plate.png);
            background-size: contain;
            background-color: #eeeff5;
            width: 60px;
            height: 60px;
        }

        .labels p {
            margin-top: 4px;
            margin-bottom: 4px;
            padding: 1%;
            text-align: center;
            font-weight: bold;
            background-color: rgba(204, 231, 165, 1);
        }

        .reset {
            margin: 2% auto 2% auto;
            padding: 1%;
            width: 100%;
            font-weight: bold;
            font-size: 12px;
        }

        .right {
            width: 60%;
            /*  background-color: #eee;*/
        }

        .center {
            margin: 4% 4%;
            text-align: center;
        }

        [draggable] {
            cursor: move;
        }

        .drag {
            width: 80px;
            height: 80px;
            /*background-image: url(plate.png);*/
            /*  background-color: rgba(0,255,0,0.1);*/
        }

        #toppings .blocks img {
            cursor: pointer;
        }

        #toppings .blocks {
            float: left;

            text-align: center;
            font-weight: bold;
            margin: 1%;

            /*background-image: url(plate.png);*/
        }

        table {
            align-content: center;
            padding-left: auto;
            display: flex;
            justify-content: center;
        }

        #toppings .blocks p {
            margin-top: 0;
            margin-bottom: 0;
            padding-top: 1%;
            padding-bottom: 1%;
            font-size: 11px;
        }

        /*** keep this below others ***/
        .show {
            opacity: 1;
        }

        .clear {
            clear: both;
            line-height: 1px;
        }

        b,
        strong {
            font-weight: bolder;
            font-size: 11px;
        }
        .gradient_bg {
            background: rgb(11, 34, 64);
            background: radial-gradient(circle, rgba(11, 34, 64, 1) 0%, rgba(9, 14, 22, 1) 65%);
        }
    </style>
</head>

<body>
    @php
        $images = json_decode($creative->image, true);
        $countImages = count($images);
        $videos = json_decode($creative->video, true);
        $countVideos = count($videos);
    @endphp
    <x-app-layout>
        <div class="w-full h-screen gradient_bg flex justify-center items-center">
        <!-- partial:index.partial.html -->
        <div class="container" id="main-con">
            <!-- <h1>Drag &amp; Drop Sandwich Maker</h1> -->
            <section>
                <!-- Left -->
                <div class="left">
                    <img style="width: 63px; padding-left: 232px; z-index: 4000" src="logo.png" />

                    <div id="bread" ondrop="drop_processor()">
                        <div class="plate" style="width: 141px; height: 150px">
                            <img style="width: 80px; padding: 29px" src="bread.png" alt="Bread" />
                        </div>
                    </div>
                    <!-- <div class="labels"></div> -->
                    <div id="toppings">
                        <p>
                            <strong>
                                সকালে অলটাইম ব্রেড দিয়ে কোন ধরণের খাবার খেতে পছন্দ করেন?
                            </strong>
                        </p>
                        <hr style="margin-bottom: -1px; margin-top: -11px" class="new4" />
                        <table>
                            <tr>
                                <td>
                                    <div class="blocks">
                                        <div class="plate">
                                            <div class="drag" id="pb">
                                                <img id="butter"
                                                    style="
                            width: 47px;
                            padding-right: 18px;
                            padding-top: 7px;
                          "
                                                    src="Butter.png" alt="Peanut Butter" />
                                            </div>
                                        </div>
                                        <p>বাটার</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="blocks">
                                        <div class="plate">
                                            <div class="drag" id="grape">
                                                <img id="egg"
                                                    style="
                            width: 47px;
                            padding-right: 18px;
                            padding-top: 7px;
                          "
                                                    src="Egg.png" alt="Grape Jelly" />
                                            </div>
                                        </div>
                                        <p>ডিম</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="blocks">
                                        <div class="plate">
                                            <div class="drag" id="ham">
                                                <img id="jam"
                                                    style="
                            width: 47px;
                            padding-right: 18px;
                            padding-top: 7px;
                          "
                                                    src="Jam.png" alt="Ham" />
                                            </div>
                                        </div>
                                        <p>জ্যাম</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="blocks">
                                        <div class="plate">
                                            <div class="drag" id="cheese">
                                                <img id="Chocolate"
                                                    style="
                            width: 47px;
                            padding-right: 18px;
                            padding-top: 7px;
                          "
                                                    src="Chocolate.png" alt="Cheese" />
                                            </div>
                                        </div>
                                        <p>চকলেট</p>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- end div columns -->
            </section>
            <!-- end section -->
        </div>
        <!-- end div container -->

        <!-- new 2 -->

        <div class="container" id="butter-container" style="display: none">
            <!-- <h1>Drag &amp; Drop Sandwich Maker</h1> -->
            <section>
                <!-- Left -->
                <div class="left">
                    <img style="
              border-style: none;
              padding-left: 24px;
              padding-right: 14px;
              width: 250px;
            "
                        src="Bread_butter.png" />
                </div>

                <!-- end div columns -->
            </section>
            <!-- end section -->
        </div>

        <!-- new 2 -->

        <!--  -->

        <div class="container" id="egg-container" style="display: none">
            <!-- <h1>Drag &amp; Drop Sandwich Maker</h1> -->
            <section>
                <!-- Left -->
                <div class="left">
                    <img style="border-style: none; padding-left: 24px; padding-right: 14px" src="Bread_egg.png" />
                </div>

                <!-- end div columns -->
            </section>
            <!-- end section -->
        </div>

        <!--  -->

        <!--  -->

        <div class="container" id="jam-container" style="display: none">
            <!-- <h1>Drag &amp; Drop Sandwich Maker</h1> -->
            <section>
                <!-- Left -->
                <div class="left">
                    <img style="border-style: none; padding-left: 24px; padding-right: 14px" src="Bread_jelly.png" />
                </div>

                <!-- end div columns -->
            </section>
            <!-- end section -->
        </div>

        <!--  -->

        <!--  -->

        <div class="container" id="Chocolate-container" style="display: none">
            <!-- <h1>Drag &amp; Drop Sandwich Maker</h1> -->
            <section>
                <!-- Left -->
                <div class="left">
                    <img style="border-style: none; padding-left: 24px; padding-right: 14px"
                        src="Bread_chocolate.png" />
                </div>

                <!-- end div columns -->
            </section>
            <!-- end section -->
        </div>
        </div>
    </x-app-layout>

    <!--  -->

    <!-- partial -->
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script>
        $(document).ready(function() {
            // draggable
            $("#toppings .drag").draggable({
                revert: "invalid",
                snap: "#bread",
                stack: ".drag",
            }); // end draggable

            // draggable position
            $(".drag").data({
                originalLeft: $(".drag").css("left"),
                origionalTop: $(".drag").css("top"),
            });

            // droppable
            $("#bread").droppable({
                accept: ".drag",
                drop: function(event, ui) {
                    let image_id = ui.draggable.find("img").attr("id");
                    var labelName = ui.draggable.find("img").attr("alt");
                    $(this)
                        .find(".labels")
                        .append("<p>" + labelName + "</p>");
                    $("#" + image_id + "-container").fadeIn(7000);
                    $(this).closest(".container").fadeOut(2000);
                },
            }); // end droppable

            $(".reset").click(function() {
                // location.reload(true);
                $("#toppings .drag").css({
                    left: $(".drag").data("originalLeft"),
                    top: $(".drag").data("origionalTop"),
                });

                $(".labels").empty();
            });
        }); // end ready

        function drop_processor() {
            let cotainer = $("#bread");
            let image_id = cotainer.find("img").attr("id");
            $("#" + image_id + "-container").show();
            // $('#bread').closest('.container').hide();
        }

        $("html").on("drag", ".drag", function() {
            console.log($(this).find("img"));
        });
    </script>
</body>

</html>
