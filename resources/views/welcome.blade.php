<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('frontend/images/favicon/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('frontend/images/favicon/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('frontend/images/favicon/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('frontend/images/favicon/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('frontend/images/favicon/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('frontend/images/favicon/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('frontend/images/favicon/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('frontend/images/favicon/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('frontend/images/favicon/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192"
        href="{{ asset('frontend/images/favicon/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32"
        href="{{ asset('frontend/images/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96"
        href="{{ asset('frontend/images/favicon/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16"
        href="{{ asset('frontend/images/favicon/favicon-16x16.png') }}">
    <title>Toucan | Home</title>
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('frontend/images/favicon/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('frontend/images/favicon/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('frontend/images/favicon/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('frontend/images/favicon/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('frontend/images/favicon/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('frontend/images/favicon/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('frontend/images/favicon/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('frontend/images/favicon/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('frontend/images/favicon/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192"
        href="{{ asset('frontend/images/favicon/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32"
        href="{{ asset('frontend/images/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96"
        href="{{ asset('frontend/images/favicon/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16"
        href="{{ asset('frontend/images/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
        integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('frontend/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/cdn.jsdelivr.net_npm_swiper@10_swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/superclasses.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/mobile.css') }}">



    <!-- Google Analytics 4 Tracking Code -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-VHXKMY3QR3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'G-VHXKMY3QR3');
    </script>

    <style>
        /* * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        } */

        /* body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            background-color: #000;
            color: #fff;
        } */
        /*
        .wrapper2 {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        } */
        /*
        .padding-top {
            padding-top: 80px;
        }

        .padding-bottom {
            padding-bottom: 80px;
        }

        .bg-light-black {
            background-color: #111;
        }

        .bg-dark-black {
            background-color: #000;
        } */

        .padding-top {
            padding-top: 20px;
        }

        /* Contact Section Styles */
        .contact-section {
            background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 100%);
            position: relative;
            overflow: hidden;
        }

        .contact-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background:
                radial-gradient(circle at 20% 30%, rgba(74, 144, 226, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 70%, rgba(255, 165, 0, 0.1) 0%, transparent 50%);
            pointer-events: none;
        }

        .contact-title {
            text-align: center;
            margin-bottom: 30px;
        }

        .contact-title span {
            color: #4a90e2;
            font-size: 14px;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            display: block;
            margin-bottom: 15px;
        }

        .contact-title h2 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 20px;
            background: linear-gradient(135deg, #4a90e2, #ffa500);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .contact-title p {
            font-size: 1.2rem;
            color: #ccc;
            max-width: 600px;
            margin: 0 auto;
        }

        .contact-container {
            display: grid;
            grid-template-columns: 0.5fr 1fr 0.5fr;
            gap: 30px;
            align-items: center;
        }

        .contact-info {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .contact-info h3 {
            font-size: 1.1rem;
            margin-bottom: 30px;
            color: #4a90e2;
        }

        .info-item {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
            padding: 20px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .info-item:hover {
            background: rgba(74, 144, 226, 0.1);
            transform: translateX(10px);
        }

        .info-item i {
            font-size: 18px;
            color: #4a90e2;
            margin-right: 20px;
            width: 40px;
            text-align: center;
        }

        .info-item div {
            flex: 1;
        }

        .info-item h4 {
            font-size: 1.1rem;
            margin-bottom: 5px;
            color: #fff;
        }

        .info-item p {
            color: #ccc;
            font-size: 0.95rem;
        }

        .info-item a {
            color: #ccc;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .info-item a:hover {
            color: #4a90e2;
        }

        .contact-form {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .contact-form h3 {
            font-size: 1.8rem;
            margin-bottom: 30px;
            color: #4a90e2;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #fff;
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 15px 20px;
            background: rgba(255, 255, 255, 0.05);
            border: 2px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            color: #fff;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            color: #fff;
            border-color: #4a90e2;
            background: rgba(223, 208, 208, 0.08);
            box-shadow: 0 0 20px rgba(74, 144, 226, 0.2);
        }

        .form-control::placeholder {
            color: #ffffff;
        }

        .form-control.textarea {
            resize: vertical;
            min-height: 120px;
        }

        .submit-btn {
            width: 100%;
            padding: 18px;
            background: linear-gradient(135deg, #4a90e2, #ffa500);
            border: none;
            border-radius: 12px;
            color: white;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px rgba(74, 144, 226, 0.4);
        }

        /* Footer Styles */
        .footer-main-sec {
            background: linear-gradient(135deg, #000000 0%, #111111 100%);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            position: relative;
        }

        .footer-main-sec::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 1px;
            background: linear-gradient(90deg, transparent, #4a90e2, transparent);
        }

        .footer-inner-section {
            display: grid;
            grid-template-columns: 3fr 1.5fr 1.5fr;
            gap: 40px;
            align-items: start;
        }

        .footer-box {
            padding: 20px 0;
        }

        .footer-logo img {
            max-width: 200px;
            margin-bottom: 20px;
        }

        .footer-box h4 {
            color: #4a90e2;
            font-size: 1.3rem;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .footer-box p {
            color: #ccc;
            margin-bottom: 10px;
            font-size: 0.9rem;
        }

        .footer-box ul {
            list-style: none;
        }

        .footer-box ul li {
            margin-bottom: 12px;
        }

        .footer-box ul li a {
            color: #ccc;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .footer-box ul li a:hover {
            color: #4a90e2;
            padding-left: 5px;
        }

        .social-media {
            margin-top: 20px;
        }

        .social-media span {
            color: #4a90e2;
            font-weight: 600;
            display: block;
            margin-bottom: 15px;
        }

        .social-links {
            display: flex;
            gap: 15px;
        }

        .social-links a {
            width: 45px;
            height: 45px;
            background: rgba(74, 144, 226, 0.1);
            border: 1px solid rgba(74, 144, 226, 0.3);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #4a90e2;
            font-size: 18px;
            transition: all 0.3s ease;
        }

        .social-links a:hover {
            background: #4a90e2;
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(74, 144, 226, 0.3);
        }

        .address-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 20px;
            padding: 15px;
            background: rgba(255, 255, 255, 0.03);
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .address-item:hover {
            background: rgba(255, 255, 255, 0.05);
        }

        .address-item i {
            color: #4a90e2;
            margin-right: 15px;
            font-size: 16px;
            margin-top: 3px;
        }

        .address-item div {
            flex: 1;
        }

        .address-item a {
            color: #ccc;
            text-decoration: none;
        }

        .address-item a:hover {
            color: #4a90e2;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .contact-container {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .contact-title h2 {
                font-size: 2rem;
            }

            .footer-inner-section {
                grid-template-columns: 1fr;
                gap: 30px;
                text-align: center;
            }

            .contact-info,
            .contact-form {
                padding: 30px 20px;
            }
        }

        /* Animation Classes */
        .fade-up {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease;
        }

        .fade-up.aos-animate {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>

<body>
    <!-- Preloader -->
    <div class="loader-mask">
        <div class="loader">
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- Preloader -->
    <!-- navbar section -->
    <header class="navbar-main-sec index2-navbar-sec w-100 float-left header-con3">
        <div class="wrapper">
            <nav class="navbar navbar-expand-lg navbar-light p-0">
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('frontend/images/AiMentor-logo.png') }}" alt="AiMentor-logo">
                </a>
                <button class="navbar-toggler collapsed" type="button" data-toggle="collapse"
                    data-target="#navbarToggle" aria-controls="navbarToggle" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    <span class="navbar-toggler-icon"></span>
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarToggle">
                    <ul class="navbar-nav mr-auto my-2 my-lg-0">
                        <li class="nav-item dropdown active">
                            <a class="nav-link" href="#home">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#features">Features</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#product">Product Overview</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#pricing">Pricing</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#contact">Contact</a>
                        </li>
                    </ul>
                    <form class="d-flex">
                        <ul class="mb-0 list-unstyled d-flex align-items-center navbar-right-box">
                            <li>
                                @if (auth()->check())
                                    @if (auth()->user()->role == 1)
                                        <a class="btn btn-warning"
                                            href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
                                    @elseif (auth()->user()->role == 2)
                                        <a class="btn btn-warning"
                                            href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                                    @else
                                        <a class="btn btn-warning"
                                            href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" class="login-btn">
                                        <img src="{{ asset('frontend/images/lock-icon.png') }}" alt="lock-icon">
                                        {{ __('Login') }}
                                    </a>
                                @endif
                            </li>
                        </ul>
                    </form>
                </div>
            </nav>
        </div>
    </header>
    <!-- navbar section -->
    <!-- banner section -->
    <section class="banner-sec w-100 float-left bg-light-black" id="home">
        <div class="wrapper2">
            <div class="banner-left-sec">
                <h1 data-aos="fade-up" data-aos-duration="600">Unleash <span>AI-Powered</span> Creativity for Smarter
                    Advertising</h1>
                <p data-aos="fade-up" data-aos-duration="600">AI Powered Interactive Ads for<br>
                    Brands & Publishers</p>
                <div class="generic-btn" data-aos="fade-up" data-aos-duration="600">
                    {{-- <a href="https://creativeaitest.adplay-mobile.com" target="_blank">Get Started</a> --}}
                    @if (auth()->check())
                        @if (auth()->user()->role == 1)
                            <a class="btn btn-warning" href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
                        @elseif (auth()->user()->role == 2)
                            <a class="btn btn-warning"
                                href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                        @endif
                    @else
                        <a href="{{ route('register') }}" class="login-btn">
                            {{ __('Get Started') }}
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!-- banner section -->
    <!-- services section -->
    <section class="service-slider-sec w-100 float-left padding-top padding-bottom bg-light-black">
        <div class="generic-title text-center">
            <span data-aos="fade-up" data-aos-duration="600">WHAT DOES TOUCAN DO?</span>
            <h4 data-aos="fade-up" data-aos-duration="600"> Toucan AI converts static and video creatives to HTML 5
                interactive ads effortlessly. Leverage Toucan’s in-built image generator which provides assets for your
                ads for high performance digital campaigns. </h4>
        </div>
        <div class="service-slider-box" data-aos="fade-up" data-aos-duration="600">
            <div id="owlsliderone" class="owl-carousel owl-theme">
                <div class="item">
                    <figure class="mb-0">
                        <img src="{{ asset('frontend/images/slider1.jpg') }}" alt="slider-img1">
                    </figure>
                </div>
                <div class="item">
                    <figure class="mb-0">
                        <img src="{{ asset('frontend/images/slider2.jpg') }}" alt="slider-img2">
                    </figure>
                </div>
                <div class="item">
                    <figure class="mb-0">
                        <img src="{{ asset('frontend/images/slider3.jpg') }}" alt="slider-img3">
                    </figure>
                </div>
                <div class="item">
                    <figure class="mb-0">
                        <img src="{{ asset('frontend/images/slider4.jpg') }}" alt="slider-img4">
                    </figure>
                </div>
                <div class="item">
                    <figure class="mb-0">
                        <img src="{{ asset('frontend/images/slider5.jpg') }}" alt="slider-img5">
                    </figure>
                </div>
                <div class="item">
                    <figure class="mb-0">
                        <img src="{{ asset('frontend/images/slider6.jpg') }}" alt="slider-img1">
                    </figure>
                </div>
                <div class="item">
                    <figure class="mb-0">
                        <img src="{{ asset('frontend/images/slider7.jpg') }}" alt="slider-img2">
                    </figure>
                </div>
                <div class="item">
                    <figure class="mb-0">
                        <img src="{{ asset('frontend/images/slider8.jpg') }}" alt="slider-img3">
                    </figure>
                </div>
                <div class="item">
                    <figure class="mb-0">
                        <img src="{{ asset('frontend/images/slider9.jpg') }}" alt="slider-img4">
                    </figure>
                </div>
                <div class="item">
                    <figure class="mb-0">
                        <img src="{{ asset('frontend/images/slider10.jpg') }}" alt="slider-img5">
                    </figure>
                </div>
            </div>
        </div>
    </section>
    <!-- services section -->
    <!-- collection section -->
    <section class="collection-section w-100 float-left padding-bottom padding-top bg-light-black" id="features">
        <div class="wrapper2">
            <div class="generic-title text-center">
                <span data-aos="fade-up" data-aos-duration="600">FEATURES</span>
                <h2 data-aos="fade-up" data-aos-duration="600">Revolutionizing Rich Media Ads</h2>
            </div>
            <div class="collection-inner-sec">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6" data-aos="fade-up" data-aos-duration="600">
                        <div class="collection-box bg-dark-black">
                            <figure>
                                <img src="{{ asset('frontend/images/collection-img1.png') }}" alt="collection-img1">
                            </figure>
                            <h4>Generate Interactive Ads</h4>
                            <p>Create highly engaging interactive ad creatives from static images or videos within
                                seconds.</p>
                            <!-- <a href="service.html"><i class="fas fa-arrow-right"></i></a> -->
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6" data-aos="fade-up" data-aos-duration="600">
                        <div class="collection-box bg-dark-black">
                            <figure>
                                <img src="{{ asset('frontend/images/collection-img2.png') }}" alt="collection-img2">
                            </figure>
                            <h4>Rich Media <br>Templates</h4>
                            <p>Access a vast library of templates, designed for high-impact digital
                                campaigns.</p>
                            <!-- <a href="service.html"><i class="fas fa-arrow-right"></i></a> -->
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6" data-aos="fade-up" data-aos-duration="600">
                        <div class="collection-box bg-dark-black">
                            <figure>
                                <img src="{{ asset('frontend/images/collection-img3.png') }}" alt="collection-img3">
                            </figure>
                            <h4>No-Code Ad Generation</h4>
                            <p>Simplify the process with a no-code, chatbot interface that lets you generate ads without
                                any design expertise.</p>
                            <!-- <a href="service.html"><i class="fas fa-arrow-right"></i></a> -->
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6" data-aos="fade-up" data-aos-duration="600">
                        <div class="collection-box bg-dark-black">
                            <figure>
                                <img src="{{ asset('frontend/images/collection-img4.png') }}" alt="collection-img4">
                            </figure>
                            <h4>Google, Facebook & Programmatic Ads</h4>
                            <p>Ensure seamless integration with Google Ads, Facebook and other programmatic platforms.
                            </p>
                            <!-- <a href="service.html"><i class="fas fa-arrow-right"></i></a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- collection section -->
    <!-- about section -->
    <section class="about-main-sec w-100 float-left padding-top padding-bottom bg-light-black">
        <div class="wrapper2">
            <div class="row">
                <div class="col-lg-6">
                    <figure class="mb-0" data-aos="fade-up" data-aos-duration="600">
                        <img src="{{ asset('frontend/images/toucan_img.gif') }}" alt="about-img"
                            style="background-color: transparent; mix-blend-mode: multiply; ">
                    </figure>
                </div>
                <div class="col-lg-6 d-flex align-items-center justify-content-left justify-content-center">
                    <div class="about-details-box">
                        <div class="generic-title">
                            <span data-aos="fade-up" data-aos-duration="600">WHY CHOOSE TOUCAN?</span>
                            <h2 class="mb-0" data-aos="fade-up" data-aos-duration="600">Powering Digital
                                Advertising
                                with AI</h2>
                        </div>
                        <p data-aos="fade-up" data-aos-duration="600">Unlike traditional AI tools that require
                            time-consuming manual design, Toucan AI automates the process, providing instant
                            multi-format ad exports and video-supported rich media—something most platforms don’t offer.
                        </p>
                        <div class="generic-btn" data-aos="fade-up" data-aos-duration="600">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Features section-->

    <section class="about-index-con w-100 float-left padding-top" id="product">
        <div class="wrapper2">
            <div class="about-index-box">
                <div class="about-index-img position-relative" data-aos="fade-up" data-aos-duration="600">
                    <figure class="mb-0">
                        <img src="{{ asset('frontend/images/feature1.png') }}" alt="about-img">
                    </figure>
                </div>
                <div class="about-index-content">
                    <div class="about-details-box pr-0">
                        <div class="generic-title">
                            <span data-aos="fade-up" data-aos-duration="600">PRODUCT OVERVIEW</span>
                            <h2 class="mb-0" data-aos="fade-up" data-aos-duration="600">Architecting the Digital
                                Future</h2>
                        </div>
                        <p data-aos="fade-up" data-aos-duration="600">Toucan AI can effortlessly convert static and
                            video creatives into striking interactive HTML ad formats with multiple dimension export and
                            a powerful AI image generator. </p>
                        <div class="generic-btn" data-aos="fade-up" data-aos-duration="600">
                        </div>
                    </div>
                </div>
                <div class="about-index-img about-index-img2">
                    <figure class="mb-0" data-aos="fade-up" data-aos-duration="600">
                        <img src="{{ asset('frontend/images/feature2.png') }}" alt="about-img">
                    </figure>
                </div>
            </div>
        </div>
    </section>

    <section class="plans-section w-100 float-left padding-top padding-bottom bg-light-black" id="pricing">
        <div class="wrapper2">
            <div class="generic-title text-center">
                <h2 data-aos="fade-up" data-aos-duration="600">
                    <span>Pricing Plans</span>
                </h2>
            </div>
            <div class="row">
                @foreach ($plans as $plan)
                    <div class="col-lg-4 col-md-4" data-aos="fade-up" data-aos-duration="600">
                        <div class="plan-box text-center bg-dark-black">
                            <h3>{{ $plan->name }}</h3>
                            <p class="plan-txt">{{ $plan->description }}</p>
                            <p>Starting at:</p>
                            <div class="price position-relative">
                                <span></span>${{ $plan->monthly_price }}<span>/mo</span>
                            </div>
                            <div class="generic-btn">
                                @if (auth()->check())
                                    <form method="POST" action="{{ route('checkout', $plan->id) }}">
                                        @csrf
                                        <input type="hidden" name="plan_name" value="{{ $plan->name }}">
                                        <input type="hidden" name="amount" value="{{ $plan->monthly_price }}">
                                        <button type="submit" class="btn btn-primary">Get Started</button>
                                    </form>
                                @else
                                    <a class="btn btn-primary" href="{{ route('login') }}">Get Started</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section w-100 float-left padding-top padding-bottom" id="contact">
        <div class="wrapper2">
            <div class="contact-title" data-aos="fade-up" data-aos-duration="600">
                <h2>Contact Us</h2>
            </div>

            <div class="contact-container">
                <div data-aos="fade-left" data-aos-duration="800">

                </div>
                <div class="contact-form" data-aos="fade-left" data-aos-duration="800">
                    <h5 class="text-center pb-2">Send Us a Message</h5>
                    <form class="support-form" id="supportForm" action="{{ route('zendesk.submit') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @if (auth()->check())
                            <div class="form-group">
                                <label for="name">Full Name</label>
                                <input type="text" id="name" name="name"
                                    value="{{ auth()->user()->name }}" class="form-control"
                                    placeholder="Enter your full name" required>
                            </div>

                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" id="email" name="email"
                                    value="{{ auth()->user()->email }}" class="form-control"
                                    placeholder="Enter your email address" required>
                            </div>
                        @else
                            <div class="form-group">
                                <label for="name">Full Name</label>
                                <input type="text" id="name" name="name" class="form-control"
                                    placeholder="Enter your full name" required>
                            </div>

                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" id="email" name="email" class="form-control"
                                    placeholder="Enter your email address" required>
                            </div>
                        @endif
                        {{--                         
                            <div class="form-group">
                                <label for="company">Company Name</label>
                                <input type="text" id="company" name="company" class="form-control" placeholder="Enter your company name">
                            </div>
                         --}}
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input type="text" id="subject" name="subject" class="form-control"
                                placeholder="What's this about?" required>
                        </div>

                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea id="message" name="message" class="form-control textarea" placeholder="Tell us more" required></textarea>
                        </div>

                        <button type="submit" class="submit-btn">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Enhanced Footer Section -->
    <section class="footer-main-sec w-100 float-left padding-top padding-bottom">
        <div class="wrapper2">
            <div class="footer-inner-section">
                <div class="footer-box footer-logo">
                    <img src="{{ asset('frontend/images/AiMentor-logo.png') }}" alt="Toucan AI Logo">
                    <p>Revolutionizing digital advertising with AI-powered interactive ad solutions. Transform your
                        static creatives into engaging experiences.</p>
                    <div class="social-media">
                        <span>Follow Us</span>
                        <div class="social-links">
                            <a href="https://www.facebook.com/adplaytechnology/" target="_blank"><i
                                    class="fab fa-facebook-f"></i></a>
                            <a href="https://x.com/adplaymobile" target="_blank"><i class="fab fa-twitter"></i></a>
                            <a href="https://bd.linkedin.com/company/adplay-mobile" target="_blank"><i
                                    class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>

                <div class="footer-box">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="#home">Home</a></li>
                        <li><a href="#features">Features</a></li>
                        <li><a href="#product">Product Overview</a></li>
                        <li><a href="#pricing">Pricing</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-box">
                    <h4>Contact Us</h4>
                    <ul>
                        <li>
                            <p>
                                {{-- <a href="tel:+8809610998951" class="py-4">+880 961 099 8951</a><br> --}}
                                <a href="mailto:it@toucan-ai.com" class="py-4">it@toucan-ai.com</a><br>
                                {{-- <a href="mailto:help@toucan-ai.com" class="py-4">help@toucan-ai.com</a><br> --}}
                                {{-- <a href="mailto:connect@toucan-ai.com" class="py-4">connect@toucan-ai.com</a> --}}
                            </p>
                        </li>
                    </ul>
                </div>


            </div>

            <div
                style="text-align: center; margin-top: 40px; padding-top: 30px; border-top: 1px solid rgba(255,255,255,0.1);">
                <p style="color: #888; margin: 0;">© 2025 Toucan AI. All rights reserved. | Privacy Policy | Terms of
                    Service</p>
            </div>
        </div>
    </section>

    <div class="container pb-4">
        <h1 class="text-center mt-5 mb-4">Gemini AI Prompt</h1>

        <form method="POST" action="{{ route('text.generate') }}" class="form-contact">
            @csrf
            <div class="form-group">
                <label for="prompt">Input: </label>
                <input class="form-control" name="prompt" id="prompt" type="text" placeholder="Enter your prompt here" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary submit-btn">Generate</button>
            </div>
        </form>

        <label>AI Response: </label>
        @isset($aiText)
            <div class="alert alert-success">
                {{ $aiText }}
            </div>
        @else
            <div class="alert alert-info">
                No response generated yet.
            </div>
        @endisset
    </div>


    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            duration: 600,
            once: true,
            offset: 100
        });

        // Contact Form Handler
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault();

            // Get form data
            const formData = new FormData(this);
            const data = Object.fromEntries(formData);

            // Simulate form submission
            const submitBtn = this.querySelector('.submit-btn');
            const originalText = submitBtn.textContent;

            submitBtn.textContent = 'Sending...';
            submitBtn.disabled = true;

            setTimeout(() => {
                alert('Thank you for your message! We\'ll get back to you soon.');
                this.reset();
                submitBtn.textContent = originalText;
                submitBtn.disabled = false;
            }, 1500);
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Auto-resize textarea
        const textarea = document.querySelector('#message');
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = Math.min(this.scrollHeight, 200) + 'px';
        });
    </script>
    <a id="button" class="show"></a>
    <!-- footer section-->
    <script src="{{ asset('frontend/js/popper.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/owl.carousel.js') }}"></script>
    <script src="{{ asset('frontend/js/aos.js') }}"></script>
    <script src="{{ asset('frontend/js/cdn.jsdelivr.net_npm_swiper@10_swiper-bundle.min.js') }}"></script>
    <script>
        const swiper = new Swiper('.swiper', {
            loop: true,
            spaceBetween: 10,
            autoplay: {
                delay: 0,
                pauseOnMouseEnter: true,
                disableOnInteraction: false,
            },
            breakpoints: {
                360: {
                    slidesPerView: 2,
                    spaceBetween: 30,
                },
                576: {
                    slidesPerView: 3,
                    spaceBetween: 10,
                },
                768: {
                    slidesPerView: 4,
                    spaceBetween: 20,
                },
                992: {
                    slidesPerView: 4,
                    spaceBetween: 20,
                },
                1200: {
                    slidesPerView: 7,
                    spaceBetween: 10,
                },
            },

            speed: 4000,
        })
        $(window).on('load', function() {
            // Preloader
            $('.loader').fadeOut();
            $('.loader-mask').delay(350).fadeOut('slow');
        });
        var btn = $('#button');
        $(window).scroll(function() {
            if ($(window).scrollTop() > 300) {
                btn.addClass('show');
            } else {
                btn.removeClass('show');
            }
        });
        btn.on('click', function(e) {
            e.preventDefault();
            $('html, body').animate({
                scrollTop: 0
            }, '300');
        });
        window.addEventListener('load', function() {
            document.querySelector('body').classList.add("loaded")
        });
        AOS.init();
        $('#owlsliderone').owlCarousel({
            loop: true,
            margin: 30,
            nav: true,
            animateOut: 'slideInLeft',
            animateIn: 'slideOutRight',
            responsive: {
                0: {
                    items: 2
                },
                576: {
                    items: 2
                },
                1000: {
                    items: 5
                }
            }
        })
    </script>
    <script>
        $('#owlslider').owlCarousel({
            loop: true,
            margin: 30,
            nav: true,
            animateOut: 'slideInLeft',
            animateIn: 'slideOutRight',
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 2
                }
            }
        })
    </script>
    <script>
        const lightbox = document.createElement('div')
        lightbox.id = 'lightbox'
        document.body.appendChild(lightbox)

        const images = document.querySelectorAll('.images img')
        images.forEach(image => {
            image.addEventListener('click', e => {
                lightbox.classList.add('active')
                const img = document.createElement('img')
                img.src = image.src
                while (lightbox.firstChild) {
                    lightbox.removeChild(lightbox.firstChild)
                }
                lightbox.appendChild(img)
            })
        })

        lightbox.addEventListener('click', e => {
            if (e.target !== e.currentTarget) return
            lightbox.classList.remove('active')
        })
    </script>
    <script>
        $(".box-video").click(function() {
            $('iframe', this)[0].src += "&amp;autoplay=1";
            $(this).addClass('open');
        });

        const $dropdown = $(".dropdown");
        const $dropdownToggle = $(".dropdown-toggle");
        const $dropdownMenu = $(".dropdown-menu");
        const showClass = "show";

        $(window).on("load resize", function() {
            if (this.matchMedia("(min-width: 768px)").matches) {
                $dropdown.hover(
                    function() {
                        const $this = $(this);
                        $this.addClass(showClass);
                        $this.find($dropdownToggle).attr("aria-expanded", "true");
                        $this.find($dropdownMenu).addClass(showClass);
                    },
                    function() {
                        const $this = $(this);
                        $this.removeClass(showClass);
                        $this.find($dropdownToggle).attr("aria-expanded", "false");
                        $this.find($dropdownMenu).removeClass(showClass);
                    }
                );
            } else {
                $dropdown.off("mouseenter mouseleave");
            }
        });
    </script>

    <script>
        // Chat Widget Functionality
        const chatIcon = document.getElementById('chatIcon');
        const chatWindow = document.getElementById('chatWindow');
        const closeBtn = document.getElementById('closeBtn');
        const supportForm = document.getElementById('supportForm');
        const successMessage = document.getElementById('successMessage');
        const fileInput = document.getElementById('fileInput');
        const fileLabel = document.getElementById('fileLabel');

        // Toggle chat window
        chatIcon.addEventListener('click', function() {
            chatWindow.classList.toggle('active');
            chatIcon.classList.toggle('active');
        });

        // Close chat window
        closeBtn.addEventListener('click', function() {
            chatWindow.classList.remove('active');
            chatIcon.classList.remove('active');
        });

        // Close when clicking outside
        document.addEventListener('click', function(event) {
            if (!event.target.closest('.support-widget')) {
                chatWindow.classList.remove('active');
                chatIcon.classList.remove('active');
            }
        });

        // File input change handler
        fileInput.addEventListener('change', function() {
            if (this.files.length > 0) {
                fileLabel.textContent = this.files[0].name;
            } else {
                fileLabel.textContent = 'Attach a file (optional)';
            }
        });

        // Form submission (demo - replace with actual form handling)
        supportForm.addEventListener('submit', function(e) {
            e.preventDefault(); // Remove this line in actual implementation

            // Add loading state
            supportForm.classList.add('loading');

            // Simulate form submission (replace with actual form submission)
            setTimeout(() => {
                supportForm.classList.remove('loading');
                supportForm.style.display = 'none';
                successMessage.style.display = 'block';

                // Reset form after 3 seconds
                setTimeout(() => {
                    supportForm.style.display = 'flex';
                    successMessage.style.display = 'none';
                    supportForm.reset();
                    fileLabel.textContent = 'Attach a file (optional)';
                    chatWindow.classList.remove('active');
                    chatIcon.classList.remove('active');
                }, 3000);
            }, 1500);
        });

        // Auto-resize textarea
        const textarea = document.querySelector('textarea[name="message"]');
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = Math.min(this.scrollHeight, 150) + 'px';
        });

        // Add some entrance animation
        setTimeout(() => {
            chatIcon.style.transform = 'scale(1)';
            chatIcon.style.opacity = '1';
        }, 500);
    </script>
</body>

</html>
