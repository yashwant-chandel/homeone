@extends('front_layout/index')
@section('layout')
    <section class="banner-sec" style="background-image: url({{ asset('front/img/main-banner.png') }});">
        <div class="container">
            <div class="banner-text">
                <h1>EXTERIORS</h1>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">EXTERIORS</li>
                </ol>
            </nav>
        </div>
    </section>

    <section class="about-sec p-130 pb-0">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="about-text">
                        <h2>Install And <span class="blue">Product Done Right</span></h2>
                        <p>Every Home One bulb is Canada and USA certified. Be weary of installers not using approved
                            products and pulling proper permits. <br> <br>
                            ​
                            Our product stands up to the most harsh weather conditions. Waterproof connections between
                            every bulb ensure system longevity. <br><br>
                            ​
                            We custom manufacture the track for every job. This ensures the best colours and depths for
                            each system.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="about-img">
                        <img src="{{ asset('/front/img/main-p.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="divider">
        <div class="container">
            <span></span>
        </div>
    </div>
    <section class="create-sec">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="create-slider">
                        <div class="create-img">
                            <img src="{{ asset('front/img/Screen-01.png') }}" alt="">
                        </div>
                        <div class="create-img">
                            <img src="{{ asset('front/img/Screen-02.png') }}" alt="">
                        </div>
                        <div class="create-img">
                            <img src="{{ asset('front/img/Screen-03.png')}}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="create-text">
                        <h3>If You Can Think It, You
                            Can <span class="blue">Create It</span></h3>
                        <p>Fully customize your home from the app to whatever fits the occasion</p>
                        <div class="create-list">
                            <ul>
                                <li><a href="#">Lorem Ipsum has been the industry's</a></li>
                                <li><a href="#">The point of using Lorem Ipsum</a></li>
                                <li><a href="#">Any desktop publishing packages</a></li>
                                <li><a href="#">Various versions have evolved over</a></li>
                                <li><a href="#">There are many variations of passages</a></li>
                            </ul>
                        </div>
                        <a href="#" class="cta">Purchase What You Love!</a>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <div class="divider">
        <div class="container">
            <span></span>
        </div>
    </div>

    <section class="filter-sec">
        <div class="container">
            <div class="filter-head text-center">
                <h3>See the Difference</h3>
                <p>Showcase your home and see the difference on any occasion with Home One Smart Lighting.</p>
            </div>
            <div class="filter-tabs">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                            aria-controls="home" aria-selected="true">Security</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                            aria-controls="profile" aria-selected="false">Accent</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                            aria-controls="contact" aria-selected="false">Holiday</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="game-tab" data-toggle="tab" href="#game" role="tab" aria-controls="game"
                            aria-selected="false">Game Day</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="image-comparison" data-component="image-comparison-slider">
                            <div class="image-comparison__slider-wrapper">
                                <label for="image-comparison-range" class="image-comparison__label">Move image
                                    comparison slider</label>
                                <input type="range" min="0" max="100" value="50" class="image-comparison__range"
                                    id="image-compare-range" data-image-comparison-range="">

                                <div class="image-comparison__image-wrapper  image-comparison__image-wrapper--overlay"
                                    data-image-comparison-overlay="">
                                    <figure class="image-comparison__figure image-comparison__figure--overlay">
                                        <picture class="image-comparison__picture">
                                            <img src="https://bosso.biz/img/home/difference-before.jpg" alt=""
                                                class="image-comparison__image">
                                        </picture>
                                    </figure>
                                </div>

                                <div class="image-comparison__slider" data-image-comparison-slider="">
                                    <span class="image-comparison__thumb" data-image-comparison-thumb="">
                                        <svg class="image-comparison__thumb-icon" xmlns="http://www.w3.org/2000/svg"
                                            width="18" height="10" viewBox="0 0 18 10" fill="currentColor">
                                            <path class="image-comparison__thumb-icon--left"
                                                d="M12.121 4.703V.488c0-.302.384-.454.609-.24l4.42 4.214a.33.33 0 0 1 0 .481l-4.42 4.214c-.225.215-.609.063-.609-.24V4.703z">
                                            </path>
                                            <path class="image-comparison__thumb-icon--right"
                                                d="M5.879 4.703V.488c0-.302-.384-.454-.609-.24L.85 4.462a.33.33 0 0 0 0 .481l4.42 4.214c.225.215.609.063.609-.24V4.703z">
                                            </path>
                                        </svg>
                                    </span>
                                </div>

                                <div class="image-comparison__image-wrapper">
                                    <figure class="image-comparison__figure">
                                        <picture class="image-comparison__picture">
                                            <img src="https://bosso.biz/img/home/difference-security.jpg" alt=""
                                                class="image-comparison__image">
                                        </picture>
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="image-comparison" data-component="image-comparison-slider">
                            <div class="image-comparison__slider-wrapper">
                                <label for="image-comparison-range" class="image-comparison__label">Move image
                                    comparison slider</label>
                                <input type="range" min="0" max="100" value="50" class="image-comparison__range"
                                    id="image-compare-range" data-image-comparison-range="">

                                <div class="image-comparison__image-wrapper  image-comparison__image-wrapper--overlay"
                                    data-image-comparison-overlay="">
                                    <figure class="image-comparison__figure image-comparison__figure--overlay">
                                        <picture class="image-comparison__picture">
                                            <img src="https://bosso.biz/img/home/difference-before.jpg" alt=""
                                                class="image-comparison__image">
                                        </picture>
                                    </figure>
                                </div>

                                <div class="image-comparison__slider" data-image-comparison-slider="">
                                    <span class="image-comparison__thumb" data-image-comparison-thumb="">
                                        <svg class="image-comparison__thumb-icon" xmlns="http://www.w3.org/2000/svg"
                                            width="18" height="10" viewBox="0 0 18 10" fill="currentColor">
                                            <path class="image-comparison__thumb-icon--left"
                                                d="M12.121 4.703V.488c0-.302.384-.454.609-.24l4.42 4.214a.33.33 0 0 1 0 .481l-4.42 4.214c-.225.215-.609.063-.609-.24V4.703z">
                                            </path>
                                            <path class="image-comparison__thumb-icon--right"
                                                d="M5.879 4.703V.488c0-.302-.384-.454-.609-.24L.85 4.462a.33.33 0 0 0 0 .481l4.42 4.214c.225.215.609.063.609-.24V4.703z">
                                            </path>
                                        </svg>
                                    </span>
                                </div>

                                <div class="image-comparison__image-wrapper">
                                    <figure class="image-comparison__figure">
                                        <picture class="image-comparison__picture">
                                            <img src="https://bosso.biz/img/home/difference-accent.jpg" alt=""
                                                class="image-comparison__image">
                                        </picture>
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <div class="image-comparison" data-component="image-comparison-slider">
                            <div class="image-comparison__slider-wrapper">
                                <label for="image-comparison-range" class="image-comparison__label">Move image
                                    comparison slider</label>
                                <input type="range" min="0" max="100" value="50" class="image-comparison__range"
                                    id="image-compare-range" data-image-comparison-range="">

                                <div class="image-comparison__image-wrapper  image-comparison__image-wrapper--overlay"
                                    data-image-comparison-overlay="">
                                    <figure class="image-comparison__figure image-comparison__figure--overlay">
                                        <picture class="image-comparison__picture">
                                            <img src="https://bosso.biz/img/home/difference-before.jpg" alt=""
                                                class="image-comparison__image">
                                        </picture>
                                    </figure>
                                </div>

                                <div class="image-comparison__slider" data-image-comparison-slider="">
                                    <span class="image-comparison__thumb" data-image-comparison-thumb="">
                                        <svg class="image-comparison__thumb-icon" xmlns="http://www.w3.org/2000/svg"
                                            width="18" height="10" viewBox="0 0 18 10" fill="currentColor">
                                            <path class="image-comparison__thumb-icon--left"
                                                d="M12.121 4.703V.488c0-.302.384-.454.609-.24l4.42 4.214a.33.33 0 0 1 0 .481l-4.42 4.214c-.225.215-.609.063-.609-.24V4.703z">
                                            </path>
                                            <path class="image-comparison__thumb-icon--right"
                                                d="M5.879 4.703V.488c0-.302-.384-.454-.609-.24L.85 4.462a.33.33 0 0 0 0 .481l4.42 4.214c.225.215.609.063.609-.24V4.703z">
                                            </path>
                                        </svg>
                                    </span>
                                </div>

                                <div class="image-comparison__image-wrapper">
                                    <figure class="image-comparison__figure">
                                        <picture class="image-comparison__picture">
                                            <img src="https://bosso.biz/img/home/difference-holiday.jpg" alt=""
                                                class="image-comparison__image">
                                        </picture>
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="game" role="tabpanel" aria-labelledby="game-tab">
                        <div class="image-comparison" data-component="image-comparison-slider">
                            <div class="image-comparison__slider-wrapper">
                                <label for="image-comparison-range" class="image-comparison__label">Move image
                                    comparison slider</label>
                                <input type="range" min="0" max="100" value="50" class="image-comparison__range"
                                    id="image-compare-range" data-image-comparison-range="">

                                <div class="image-comparison__image-wrapper  image-comparison__image-wrapper--overlay"
                                    data-image-comparison-overlay="">
                                    <figure class="image-comparison__figure image-comparison__figure--overlay">
                                        <picture class="image-comparison__picture">
                                            <img src="https://bosso.biz/img/home/difference-before.jpg" alt=""
                                                class="image-comparison__image">
                                        </picture>
                                    </figure>
                                </div>

                                <div class="image-comparison__slider" data-image-comparison-slider="">
                                    <span class="image-comparison__thumb" data-image-comparison-thumb="">
                                        <svg class="image-comparison__thumb-icon" xmlns="http://www.w3.org/2000/svg"
                                            width="18" height="10" viewBox="0 0 18 10" fill="currentColor">
                                            <path class="image-comparison__thumb-icon--left"
                                                d="M12.121 4.703V.488c0-.302.384-.454.609-.24l4.42 4.214a.33.33 0 0 1 0 .481l-4.42 4.214c-.225.215-.609.063-.609-.24V4.703z">
                                            </path>
                                            <path class="image-comparison__thumb-icon--right"
                                                d="M5.879 4.703V.488c0-.302-.384-.454-.609-.24L.85 4.462a.33.33 0 0 0 0 .481l4.42 4.214c.225.215.609.063.609-.24V4.703z">
                                            </path>
                                        </svg>
                                    </span>
                                </div>

                                <div class="image-comparison__image-wrapper">
                                    <figure class="image-comparison__figure">
                                        <picture class="image-comparison__picture">
                                            <img src="https://bosso.biz/img/home/difference-game-day.jpg" alt=""
                                                class="image-comparison__image">
                                        </picture>
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="statement-sec p-130 pb-0">
            <div class="container">
                <div class="statement-head light">
                    <h3>Stand Out and Make a Statement</h3>
                    <p>Feature your home with HomeOne, the top decision for long-lasting home lighting. We've made a
                        brand that puts your experience first and where everything about painstakingly thought of.</p>
                </div>
            </div>
            <div class="container-fluid">
                <div class="statement-img">
                    <img src="img/statement-img.png" alt="">
                </div>
            </div>
        </div>
    </section>


    <section class="cleaning-sec p-130">
        <div class="container">
            <h3>Window Cleaning... <span class="blue">Re-imagined</span></h3>
            <div class="row">
                <div class="col-md-4 col-sm-6">
                    <div class="cleaning-box">
                        <img src="{{ asset('front/img/cleaning1.png') }}" alt="">
                        <div class="cleaning-text">
                            <h4>No Soaps</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="cleaning-box">
                        <img src="{{ asset('front/img/cleaning2.png') }}" alt="">
                        <div class="cleaning-text">
                            <h4>No Chemical</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="cleaning-box">
                        <img src="{{ asset('front/img/cleaning3.png') }}" alt="">
                        <div class="cleaning-text">
                            <h4>All Safely From The Ground</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <section class="bundle-sec">
        <div class="container">
            <div class="bundle-head">  
                <h3>Bundle <span class="blue">And Save!</span></h3>
            </div>
            <div class="row align-items-center">
                <div class="col-md-3 col-sm-3">
                    <div class="bundle-img">
                        <img src="{{ asset('front/img/bundel1.png') }}" alt="">
                    </div>
                </div>
                <div class="col-md-1 col-sm-1">
                    <div class="bundle-img">
                        <img src="{{ asset('front/img/+.png') }}" alt="">
                    </div>
                </div>
                <div class="col-md-3 col-sm-3">
                    <div class="bundle-img">
                        <img src="{{ asset('front/img/bundel2.png') }}" alt="">
                    </div>
                </div>
                <div class="col-md-2 col-sm-2">
                    <div class="bundle-img">
                        <img src="{{ asset('front/img/arrow.png') }}" alt="">
                    </div>
                </div>
                <div class="col-md-3 col-sm-3">
                    <div class="bundle-img">
                        <img src="{{ asset('front/img/bundel3.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>

    </section>

    <section class="contact-us p-130">
        <div class="container">
            <div class="contact-head text-center">
                <h3>Let's Chat Details And Information </h3>
                <p>Leave us your info and we will get back to you </p>
                <a href="{{ url('contact') }}" class="cta">Contact Us</a>
            </div>
        </div>
    </section>

   @endsection