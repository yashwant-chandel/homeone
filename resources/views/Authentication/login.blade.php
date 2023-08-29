<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="../../../">
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="./images/favicon.png">
    <!-- Page Title  -->
    <title>Login | eliteserenevillas</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('admin-theme/assets/css/dashlite.css')}}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('admin-theme/assets/css/theme.css') }}">
</head>

<body class="nk-body bg-white npc-general pg-auth">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- wrap @s -->
            <div class="nk-wrap nk-wrap-nosidebar">
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="nk-block nk-block-middle nk-auth-body  wide-xs">
                        <div class="brand-logo pb-4 text-center">
                            <!-- <a href="html/index.html" class="logo-link">
                                <img class="logo-light logo-img logo-img-lg" src="{{ asset('front/img/site-logo.png') }}" srcset="{{ asset('front/img/site-logo.png') }}" alt="logo">
                                <img class="logo-dark logo-img logo-img-lg" src="{{ asset('front/img/site-logo.png') }}" srcset="{{ asset('front/img/site-logo.png') }}" alt="logo-dark">
                            </a> -->
                           <h2>HomeOne</h2> 
                        </div>
                        <div class="card card-bordered">
                            <div class="card-inner card-inner-lg">
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                        <h4 class="nk-block-title">Sign-In</h4>
                                      
                                    </div>
                                </div>
                                <form action="{{ url('loginprocc') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="default-01">Email or Username</label>
                                        </div>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control form-control-lg" name="email" id="default-01" placeholder="Enter your email address or username">
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
                                            <input type="password" class="form-control form-control-lg" name ="password" id="password" placeholder="Enter your passcode">
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
                                        <button class="btn btn-lg btn-primary btn-block">Sign in</button>
                                    </div>
                                </form>
                               
                           
                                
                            </div>
                        </div>
                    </div>
                   
                </div>
                <!-- wrap @e -->
            </div>
            <!-- content @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->
    <!-- JavaScript -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="{{ asset('admin-theme/assets/js/bundle.js') }}"></script>
    <script src="{{ asset('admin-theme/assets/js/scripts.js') }}"></script>
    <script src="{{ asset('admin-theme/assets/js/example-toastr.js?ver=3.1.2') }}"></script>
    @if(Session::get('error'))
<script>
    toastr.clear();
    NioApp.Toast('{{ Session::get("error") }}', 'error', {position: 'top-right'});
</script>
@endif
@if(Session::get('success'))
<script>
    toastr.clear();
     NioApp.Toast('{{ Session::get("success") }}', 'info', {position: 'top-right'});
</script>
@endif
    <!-- select region modal -->


</html>


 <!-- site-key = 6LfWkd0mAAAAAHjVHtaMeA34uKJ-0SLcd33sUoqb
 secret-key = 6LfWkd0mAAAAAGzO6cmejBLvPy4WMBSZUP-CUoR2 -->