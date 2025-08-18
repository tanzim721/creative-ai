<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <title>Video with Image Carousel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
        * {
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
        }

        .main {
            width: 300px;
            height: 250px;
            overflow: hidden;
            background: #fff;
        }

        .main2 {
            width: 300px;
            height: 300px;
            overflow: hidden;
            background: #fff;
        }

        .main3 {
            width: 320px;
            height: 480px;
            overflow: hidden;
            background: #fff;
        }

        .main4 {
            width: 600px;
            height: 600px;
            overflow: hidden;
            background: #fff;
        }


        .video_container {
            width: 100%;
            height: 170px;
            display: flex;
            justify-content: start;
            align-items: start;
        }

        .video_container2 {
            width: 100%;
            height: 200px;
            display: flex;
            justify-content: start;
            align-items: start;
        }

        .video_container3 {
            width: 100%;
            height: 300px;
            display: flex;
            justify-content: start;
            align-items: start;
        }

        .video_container4 {
            width: 100%;
            height: 400px;
            display: flex;
            justify-content: start;
            align-items: start;
        }

        .video_container video {
            width: 100%;
            height: 170px;
            object-fit: cover;
        }

        .video_container2 video {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .video_container3 video {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }

        .video_container4 video {
            width: 100%;
            height: 400px;
            object-fit: cover;
        }

        .swiper {
            width: full;
            display: flex;
            gap: 10px;
        }

        .main .swiper-slide {
            min-width: 90px;
            min-height: 80px;
        }




        .main .swiper-slide img {
            display: block;
            width: 100%;
            height: 80px;
            object-fit: cover;
        }



        .gradient_bg {
            background: rgb(11, 34, 64);
            background: radial-gradient(circle, rgba(11, 34, 64, 1) 0%, rgba(9, 14, 22, 1) 65%);
        }
    </style>
</head>

<body>

        <div class="w-full min-h-screen gradient_bg flex justify-center items-center flex-wrap gap-8">

            <div>
                <div class="main">
                    <div class="video_container">
                        <a href="#" target="_blank" rel="noopener">
                            <video src="lalamove_video_320x180_comps 1.mp4" controls autoplay loop muted></video>
                        </a>
                    </div>

                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <a href="#" target="_blank" rel="noopener">
                                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRaBb0Pc3hOfJVlgS3SbSovYhloKZ8gm4vko0nhTF6YU5RRSEEwwKn-EkU5F0v6mq519Y4&usqp=CAU" alt="" />
                                </a>
                            </div>
                            <div class="swiper-slide">
                                <a href="#" target="_blank" rel="noopener">
                                    <img src="https://images.unsplash.com/photo-1579618216504-5812dbc82a02?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTR8fGFkdmVydGlzaW5nfGVufDB8fDB8fHww" alt="" />
                                </a>
                            </div>
                            <div class="swiper-slide">
                                <a href="#" target="_blank" rel="noopener">
                                    <img src="https://plus.unsplash.com/premium_photo-1674718013659-6930c469e641?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTd8fGFkdmVydGlzaW5nfGVufDB8fDB8fHww" alt="" />
                                </a>
                            </div>
                            <div class="swiper-slide">
                                <a href="#" target="_blank" rel="noopener">
                                    <img src="https://images.unsplash.com/photo-1549813069-f95e44d7f498?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MzF8fGFkdmVydGlzaW5nfGVufDB8fDB8fHww" alt="" />
                                </a>
                            </div>
                            <div class="swiper-slide">
                                <a href="#" target="_blank" rel="noopener">
                                    <img src="https://images.unsplash.com/photo-1551383616-a9e150c07fca?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mzh8fGFkdmVydGlzaW5nfGVufDB8fDB8fHww" alt="" />
                                </a>
                            </div>
                            <div class="swiper-slide">
                                <a href="#" target="_blank" rel="noopener">
                                    <img src="https://plus.unsplash.com/premium_photo-1680284197425-4bd125d75cab?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NDl8fGFkdmVydGlzaW5nfGVufDB8fDB8fHww" alt="" />
                                </a>
                            </div>
                        </div>
                    </div>
                </div>         
            </div>
    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 3,
            spaceBetween: 7,
            freeMode: true,
            loop: true,
            autoplay: {
                delay: 1300,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });      
</body>
</html>
