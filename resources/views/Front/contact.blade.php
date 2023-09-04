@extends('front_layout/index')
@section('layout')
<section class="banner-sec" style="background-image: url({{ asset('front/img/contact-banner.png') }});">
        <div class="container">
            <div class="banner-text">
                <h1>CONTACT</h1>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">contact</li>
                </ol>
            </nav>
        </div>
    </section>

    <section class="contact-us-sec p-130">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="contact-box">
                        <div class="contact-icon img">
                            <img src="{{ asset('front/img/contact-icon.png') }}" alt="">

                        </div>
                        <div class="contact-text">
                            <p>15 - 1339 40th Ave Ne, Calgary, Alberta. T2E 8N6
                                1602 3rd Ave S, Lethbridge, Alberta. T1J 0L2</p>

                        </div>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact-box">
                        <div class="contact-icon">
                            <img src="{{ asset('front/img/contact-icon1.png') }}" alt="">

                        </div>
                        <div class="contact-text">
                            <h6>Phone</h6>
                            <a href="tel:+4733378901">+  866 233 7351</a>

                        </div>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact-box">
                        <div class="contact-icon">
                            <img src="{{ asset('front/img/contact-icon2.png') }}" alt="">

                        </div>
                        <div class="contact-text">
                            <h6>Email</h6>
                            <a href="mailto:info@myhomeone.ca">info@myhomeone.ca</a>

                        </div>

                    </div>
                </div>
            </div>
        </div>

    </section>

    <section class="contact_detail p-130">
        <div class="container">
            <div class="contact_detail-text">
                <div class="Details-data">
                    <h3>Let's Chat Details And<span class="blue"> Information</span></h3>
                    <h4>Leave Us Your Info And We Will Get Back To You</h4>
                </div>

                <form class="contact_detail-form">
                    <div class="form-group">
                        <input type="text" class="form-control"  aria-describedby="emailHelp" name="name" placeholder="Name">
                      </div>
                      <div class="form-group">
                        <input type="Email" class="form-control"  aria-describedby="emailHelp" name="email" placeholder="Email">
                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control"  aria-describedby="emailHelp" name="city" placeholder="City">
                      </div>
                      <div class="form-group">
                        <textarea id="w3review" name="w3review" rows="4" cols="50" placeholder="Message"></textarea>
                      </div>

                      <div class="submit_cta">
                        <a class="submit-btn">Submit</a>
                      </div>
                </form>

            </div>

        </div>
    </section>


@endsection
   