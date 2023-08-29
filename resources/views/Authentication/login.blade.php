@extends('front_layout/index')
@section('layout')
<section class="banner-sec" style="background-image: url({{ asset('front/img/lawn-bg.png') }});">
        <div class="container">
            <div class="banner-text">
                <h1>Login</h1>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Login</li>
                </ol>
            </nav>
        </div>
    </section>

    <section class="simpilfied-sec p-130 ">
        <div class="container mb-5">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="lawn-img">
                        <img src="{{ asset('front/img/lawn-img.png')}}" alt="">
                    </div>
                </div>
                <div class="col-md-6">
                    <h2><span class="blue">Welcome Back</span></h2>
                    <div class="simplified-text">
                    <form action="{{ url('loginprocc') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="default-01">Username</label>
                                        </div>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control form-control-lg" name="email" id="default-01" >
                                        </div>
                                        @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="password">Password</label>
                                            <a class="link link-primary link-sm" href="html/pages/auths/auth-reset-v2.html">Forgot Code?</a>
                                        </div>
                                        <div class="form-control-wrap">
                                            <a href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                                                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                            </a>
                                            <input type="password" class="form-control form-control-lg" name ="password" id="password">
                                            @if ($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                             @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <!-- Here we use local host secret key we should change it with 6LetoOIlAAAAAMLtfUjMWwi82O070ZmLJZKk39s_  when our domain name logomax.com is working -->
                                        <div class="g-recaptcha" data-sitekey="6LfWkd0mAAAAAHjVHtaMeA34uKJ-0SLcd33sUoqb"></div>
                                        @if ($errors->has('g-recaptcha-response'))
                                            <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                                        @endif
                                    </div> 
                                    <div class="form-group">
                                    <button class="cta">Login</button>
                                    <a href="{{ url('register') }}" class="cta">Create an Account</a>
                                    </div>
                                </form>
                               
                    </div>
                </div>
            </div>

        </div>
        <!-- <script src="https://www.google.com/recaptcha/api.js" async defer></script> -->
@endsection