@extends('front_layout/index')
@section('layout')
<section class="banner-sec" style="background-image: url({{ asset('front/img/lawn-bg.png') }});">
        <div class="container">
            <div class="banner-text">
                <h1>Register</h1>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Register</li>
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
                    <form action="{{ url('registerProcc') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control form-control-lg" name="name" id="name" placeholder="Enter your Name" >
                                        </div>
                                        @if ($errors->has('name'))
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <input type="email" class="form-control form-control-lg" name="email" id="email" placeholder="Enter your email">
                                        </div>
                                        @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <input type="phone" class="form-control form-control-lg" name="phone" id="phone" placeholder="Enter your phone number">
                                        </div>
                                        @if ($errors->has('phone'))
                                            <span class="text-danger">{{ $errors->first('phone') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <a href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                                                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                            </a>
                                            <input type="password" class="form-control form-control-lg" name ="password" id="password" placeholder="Enter your password">
                                            @if ($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                             @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                    <button class="cta">Register</button>
                                    <a href="{{ url('login') }}" class="cta">Already have an Account</a>
                                    </div>
                                </form>
                               
                    </div>
                </div>
            </div>

        </div>
        <!-- <script src="https://www.google.com/recaptcha/api.js" async defer></script> -->
@endsection