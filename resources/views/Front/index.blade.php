@extends('front_layout/index')
@section('layout')
    <section class="banner-sec" style="background-image: url({{ asset('front/img/banner-img.png') }});">
        <div class="container">
            <div class="banner-text">
                <h1>LOVE WHERE <br>
                    YOU LIVE</h1>
            </div>
        </div>
    </section>
    <section class="about-sec p-130 pb-0">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="about-text">
                        <span>About Us</span>
                        <h2>What <span class="blue">We</span> <span class="blue">Do</span></h2>
                        <h4>We custom manufacture the track for every job. This ensures the best colours and depths for
                            each
                            system.</h4>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="about-img">
                        <img src="{{ asset('img/about-img.png') }}" alt="">
                    </div>
                </div>
            </div>
            <p class="mt-5">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                been the
                industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type
                and
                scrambled it to make a type specimen book. It has survived not only five centuries, but also the
                leap
                into electronic typesetting, remaining essentially unchanged. </p>
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


    <section class="create-sec p-130 pb-0">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="create-slider">
                        <div class="create-img">
                            <img src="img/Screen-01.png" alt="">
                        </div>
                        <div class="create-img">
                            <img src="img/Screen-02.png" alt="">
                        </div>
                        <div class="create-img">
                            <img src="img/Screen-03.png" alt="">
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

    <section class="light-sec">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-9">
                    <div class="light-head">
                        <h3>Alter your lights to fit <span class="blue">the event</span> </h3>
                        <p>Whether you need to flaunt on game day, commend special times of year, or give an
                            enlightening feel, you'll have the option to alter your lights anyway you like, at whatever
                            point you like.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <a href="#" class="cta">Explore The Gallery</a>
                </div>
            </div>
            <div class="light-slider">
                <div class="light-list">
                    <div class="light-box light">
                        <div class="light-img">
                            <img src="img/light-1.png" alt="">
                        </div>
                        <div class="light-text">
                            <h4>Accent Lighting</h4>
                        </div>
                        <div class="light-btn">
                            <a href="#">View accent lighting photos<i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="light-list">
                    <div class="light-box light">
                        <div class="light-img">
                            <img src="img/light-2.png" alt="">
                        </div>
                        <div class="light-text">
                            <h4>Security Lighting</h4>
                        </div>
                        <div class="light-btn">
                            <a href="#">View accent lighting photos<i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="light-list">
                    <div class="light-box light">
                        <div class="light-img">
                            <img src="img/light-3.png" alt="">
                        </div>
                        <div class="light-text">
                            <h4>Security Lighting</h4>
                        </div>
                        <div class="light-btn">
                            <a href="#">View accent lighting photos<i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="light-list">
                    <div class="light-box light">
                        <div class="light-img">
                            <img src="img/light-1.png" alt="">
                        </div>
                        <div class="light-text">
                            <h4>Holiday Lighting</h4>
                        </div>
                        <div class="light-btn">
                            <a href="#">View accent lighting photos<i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="light-list">
                    <div class="light-box light">
                        <div class="light-img">
                            <img src="img/light-3.png" alt="">
                        </div>
                        <div class="light-text">
                            <h4>Game Day Lighting</h4>
                        </div>
                        <div class="light-btn">
                            <a href="#">View accent lighting photos<i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection