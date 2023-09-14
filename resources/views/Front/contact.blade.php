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
    @php
    $footer_meta =  App\Models\FooterMeta::first();
   @endphp

    <section class="contact-us-sec p-130">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="contact-box">
                        <div class="contact-icon img">
                            <img src="{{ asset('front/img/contact-icon.png') }}" alt="">

                        </div>
                        <div class="contact-text">
                            <p>{{ $footer_meta->Address1 ?? '' }}</p>

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
                            <a href="tel:{{ $footer_meta->Phone ?? '' }}">{{ $footer_meta->Phone ?? '' }}</a>

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

                <form class="contact_detail-form" method="post" action="{{ url('contactSubmit') }}">
                    @csrf
                        
                    <div class="form-group">
                        <sup>@error('name')
                                <div class="error text-danger">{{ $message }}</div>
                        @enderror</sup>
                        <input type="text" class="form-control"   name="name" placeholder="Name">
                      </div>
                      <div class="form-group">
                      <sup>@error('email')
                                <div class="error text-danger">{{ $message }}</div>
                        @enderror</sup>
                        <input type="Email" class="form-control"  name="email" placeholder="Email">
                      </div>
                      <div class="form-group">
                      <sup>@error('city')
                                <div class="error text-danger">{{ $message }}</div>
                        @enderror</sup>
                        <input type="text" class="form-control"   name="city" placeholder="City">
                      </div>
                      <div class="form-group">
                      <sup>@error('message')
                                <div class="error text-danger">{{ $message }}</div>
                        @enderror</sup>
                        <textarea id="w3review" name="message" rows="4" cols="50" placeholder="Message"></textarea>
                      </div>

                      <div class="submit_cta">
                        <button class="submit-btn">Submit</button>
                      </div>
                </form>

            </div>

        </div>
    </section>


@endsection
   