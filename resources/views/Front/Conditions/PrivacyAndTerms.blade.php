@extends('front_layout/index')
@section('layout')
@if(isset($privacy->background_image))
<section class="banner-sec" style="background-image: url({{ asset('siteIMG/'.$privacy->background_image) }});">
@else
<section class="banner-sec" style="background-image: url({{ asset('front/img/policy-img.png') }});">
@endif
        <div class="container">
            <div class="banner-text">
                <h1>Privacy Policy</h1>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('') ?? '' }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Privacy Policy</li>
                </ol>
            </nav>
        </div>
    </section>
    <section class="privacy-policy-sec p-130">
        <div class="container">  
            <div class="privacy_wrapper">
                <div class="privacy_text box">
                    <h3>Privacy Policy</h3>
                </div>
            @if(isset($privacy->Description))
            <?php 
            echo $privacy->Description;
            ?>
            @else
            
            
                <div class="privacy_text box">
                    
                    <p>At ‘Home One Inc’ we are committed to protecting the privacy of our customers. This privacy
                        policy explains how we collect, use, and share information about you when you use our products
                        and services.</p>
                </div>
                <div class="privacy_text">
                    <h6>Information We Collect</h6>
                    <p>We may collect information about you in a variety of ways, including:</p>
                    <ul>
                        <li>When you create an account or register for one of our products or services</li>
                        <li> When you purchase or use our products or services</li>
                        <li> When you visit our website or use our mobile app</li>
                        <li> When you communicate with us, such as by email, phone, or through our customer support
                            channels</li>
                    </ul>
                </div>
                <div class="privacy_text">
                    <p>The types of information we may collect include:</p>
                    <ul>
                        <li>Personal information, such as your name, email address, and phone number</li>
                        <li>Payment information, such as your credit card or bank account information</li>
                        <li>Technical information, such as IP address, device type, and device identifiers</li>
                        <li>Usage information, such as how you use our products and services</li>
                    </ul>
                </div>
                <div class="privacy_text">
                    <h6>How We Use Your Information</h6>
                    <p>We may use the information we collect for a variety of purposes, including:</p>
                    <ul>
                        <li>To provide and improve our products and services</li>
                        <li>To process and fulfil orders and transactions</li>
                        <li>To communicate with you about your account and provide customer support</li>
                        <li>To personalise your experience and present customised content and offers</li>
                        <li>To analyse and understand how our products and services are used</li>
                        <li>To develop new products and services</li>
                        <li>To protect the security and integrity of our products and services</li>
                        <li>Sharing Your Information</li>
                    </ul>
                </div>
                <div class="privacy_text">
                    <h6>Sharing Your Information</h6>
                    <p>We may share your information in the following ways:</p>
                    <ul>
                        <li>With third-party service providers who assist us in providing and improving our products and
                            services</li>
                        <li>With third parties for marketing and advertising purposes, subject to your consent</li>
                        <li>In response to legal process, such as a court order or subpoena</li>
                        <li>In the event of a merger, acquisition, or other business restructuring</li>
                    </ul>
                </div>
                <div class="privacy_text">
                    <h6>Your Choices</h6>
                    <p>You have the following choices regarding the collection, use, and sharing of your information:
                    </p>
                    <ul>
                        <li>You can opt out of receiving marketing communications from us by following the unsubscribe
                            instructions included in the communications.</li>
                        <li>You can manage your privacy settings and preferences in your account settings.</li>
                        <li>You can exercise your right to access, rectify, erase, restrict, object to, or withdraw
                            consent to the processing of your personal data by contacting us at info@myhomeone.ca</li>
                    </ul>
                </div>
                <div class="privacy_text list">
                    <h6>Your Choices</h6>
                    <ul>
                        <li>We take reasonable steps to protect your information from unauthorised access, use, or
                            disclosure. However, no data transmission or storage can be completely secure, so we cannot
                            guarantee the security of your information.</li>
                    </ul>
                </div>
                <div class="privacy_text list">
                    <h6>Changes to This Privacy Policy</h6>
                    <ul>
                        <li>We may update this privacy policy from time to time. We will post any changes on this page
                            and encourage you to review the policy periodically.</li>
                    </ul>
                </div>
                <div class="privacy_text list">
                    <h6>Contact Us</h6>
                    <ul>
                        <li>If you have any questions or concerns about our privacy practices, please contact us at
                            info@myhomeone.ca</li>
                    </ul>
                </div>
            
            @endif
        </div>
        </div>
    </section>
@endsection