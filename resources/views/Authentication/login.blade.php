@extends('front_layout/index')
@section('layout')

        <section class="banner-sec" style="background-image: url({{ asset('front//img/login-banner.png') }});">
        <div class="container">
            <div class="banner-text">
                <h1>log in</h1>
            </div>

        </div>
    </section>

    <section class="login-sec p-130">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="login-box">
                        <img src="{{ asset('/front/img/login-box.png') }}" alt="">
                    </div>

                </div>
                <div class="col-md-6 custom_form">
                    <div class="login-text">
                        <h2> <span class="blue">Welcome back.</span></h2>

                    </div>
                    <div class="contact_detail ">
                        <form class="contact_detail-form" action="{{ url('loginprocc') }}" method="post">
                                    @csrf

                            <div class="form-group">
                                <input type="Email" class="form-control" name="email" aria-describedby="emailHelp"
                                    placeholder="Email Address">
                                    @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                            </div>
                            <div class="form-group">
                                <input type="Password" class="form-control" name="password" aria-describedby="emailHelp"
                                    placeholder="Password">
                                    @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                     @endif
                            </div>

                            <div class="remember-box">
                                <div class="remember_data">
                                    <input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent"
                                        type="checkbox" value="yes">
                                    <p>Remember Me</p>

                                </div>
                                <div class="forgot-data">
                                    <p>Forgot Password?</p>

                                </div>

                            </div>


                            <div class="submit_cta">
                                <button class="submit-btn submit-btn">Login</button>
                                <!-- <a href="" class="create-btn">Create an Account</a> -->
                            </div>
                        </form>
                    </div>


                </div>

            </div>

        </div>

    </section>
        <!-- <script src="https://www.google.com/recaptcha/api.js" async defer></script> -->
@endsection