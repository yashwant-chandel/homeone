@extends('front_layout/index')
@section('layout')
    <section class="banner-sec" style="background-image: url({{ asset('front/img/lawn-bg.png') }});">
        <div class="container">
            <div class="banner-text">
                <h1>lawn</h1>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">lawn</li>
                </ol>
            </nav>
        </div>
    </section>


    <section class="simpilfied-sec p-130">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="simplified-text">
                        <h3>Lawn Care <span class="blue">Simplified</span></h3>
                        <h4>You Choose The Freequency Of Treatments!</h4>
                        <p>Most lawn service companies over sell and over treat. To give grass the most ideal growing
                            conditions, it needs 3 things. No weeds to fight with, fertilizer, and water. Most other
                            services offered are going to make a minimal difference compared to those 3 treatments. Let
                            us handle the weeds and fertilizer, you take care of the water. You choose the frequency of
                            treatments.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="lawn-img">
                        <img src="{{ asset('front/img/lawn-img.png')}}" alt="">
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