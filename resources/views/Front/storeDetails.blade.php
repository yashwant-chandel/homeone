@extends('front_layout/index')
@section('layout')

<section class="store_detail_sec">
        <div class="container">
            <div class="store-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('') ?? '' }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('store') ?? '' }}">Store</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Product Name</li>
                    </ol>
                </nav>
            </div>
            <div class="row align-items-center">
                <div class="col-md-6">
                    <?php $images  = json_decode($product->images); ?>
                    <input type="hidden" id="imgCount" data-val="{{ count($images)+1 ?? ''}}" />
                    <div class="main">
                            <div class="slider slider-for">
                                <div class="store-img">
                                <img src="{{ url('productIMG') ?? '' }}/{{ $product->featured_image ?? '' }}" alt="">

                                </div>
                                @if(is_array($images))
                               
                                @foreach ($images as $img )
                                    <?php
                                        $image = \App\Models\Media::find($img);
                                    ?>
                                    <div class="store-img">
                                        <img src="{{ $image->image_path ?? '' }}" alt="">
                                    </div>   
                                @endforeach
                                
                                @endif
                            </div>
                           
                            <div class="slider slider-nav">
                                <div class="custom-img">
                                <img src="{{ url('productIMG') ?? '' }}/{{ $product->featured_image ?? '' }}" alt="">

                                </div>
                                @if(is_array($images))
                                @foreach ($images as $img )
                                <?php
                                        $image2 = \App\Models\Media::find($img);
                                    ?>
                                    <div class="custom-img">
                                    <img src="{{ $image2->image_path ?? '' }}" alt="">
                                    </div>   
                                @endforeach
                                @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="store-details-data">
                        <h3>{{ $product->product_name ?? '' }}</h3>
                        <p>{{ $product->short_note ?? '' }}</p>
                        <div class="products-price">
                                @if($product->sale_price)
                                        <h6>${{ $product->sale_price ?? '' }}<span>${{ $product->price ?? '' }}</span></h6>
                                    @else
                                    <h6>${{ $product->price ?? '' }}</h6>
                              @endif
                        </div>
                        <!-- <div class="simply-text">
                            <ul>
                                <li>Lorem Ipsum is simply dummy</li>
                                <li>Lorem Ipsum is simply dummy</li>

                            </ul>
                        </div> -->
                        <div class="cart-quantity">
                            <h6><b>Quantity</b></h6>
                        </div>
                        <div class="value_data">
                            <div class="value-button" id="decrease" onclick="decreaseValue()" value="Decrease Value">-
                            </div>
                            <input type="number" id="number" value="1" maxlength="{{ $product->Quantity ?? '' }}" minlength="1"/>
                            <div class="value-button" id="increase" onclick="increaseValue()" value="Increase Value">+
                            </div>
                        </div>

                        <div class="add-btn submit_cta">
                            <a href="" class="submit-btn">Add To Cart</a>
                        </div>

                    </div>

                </div>

            </div>



        </div>

    </section>

    <section class="tab-reviews-sec p-130">
        <div class="container">
            <div class="reviews_tabs">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active show" data-toggle="tab" href="#tabs-1" role="tab"
                            aria-selected="true">Description</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " data-toggle="tab" href="#tabs-2" role="tab"
                            aria-selected="false">Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Reviews</a>
                    </li>

                </ul>
                <div class="tab-content">
                    <div class="tab-pane active show" id="tabs-1" role="tabpanel">
                        <?php echo $product->description; ?>
                    </div>
                    <div class="tab-pane " id="tabs-2" role="tabpanel">
                    <?php echo $product->details; ?>
                    </div>
                    <div class="tab-pane" id="tabs-3" role="tabpanel">
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                            been the industry's standard dummy text ever since the 1500s, when an unknown printer took a
                            galley of type and scrambled it to make a type specimen book. It has survived not only five
                            centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                            It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum
                            passages, and more recently with desktop publishing software like Aldus PageMaker including
                            versions of Lorem Ipsum.</p>

                        <p> It is a long established fact that a reader will be distracted by the readable content of a
                            page when looking at its layout. The point of using Lorem Ipsum is that it has a
                            more-or-less normal distribution of letters, as opposed to using 'Content here, content
                            here', making it look like readable English. Many desktop publishing packages and web page
                            editors now use Lorem Ipsum as their default model text, and a search for.</p>

                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have
                            suffered alteration in some form, by injected humour, or randomised words which don't look
                            even slightly believable.</p>
                    </div>

                </div>

            </div>

        </div>

    </section>

    <section class="delivery-sec">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="icon_img">
                        <img src="{{ url('front/img/icon-img1.png') ?? '' }}" alt="">

                        <h5>Fast Delivery</h5>

                    </div>

                </div>
                <div class="col-md-4">
                    <div class="icon_img">
                        <img src="{{ url('front/img/icon-img2.png') ?? '' }}" alt="">

                        <h5>Satisfied or Refunded</h5>

                    </div>

                </div>
                <div class="col-md-4">
                    <div class="icon_img">
                        <img src="{{ url('front/img/icon-img3.png') ?? '' }}" alt="">
                        <h5>Secure Payments</h5>
                    </div>

                </div>

            </div>

        </div>

    </section>

    <section class="learning-sec p-130">
        <div class="container">
            <div class="learning-text">
                <h3>Learning Centre</h3>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                    industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type
                    and scrambled it to make a type specimen book. It has survived not only five centuries, but also the
                    leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s
                    with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop
                    publishing software</p>
            </div>
            <div class="collect-data">
                <div class="collect-head">
                    <h6>Information We Collect</h6>

                </div>
                <div class="collect-text">
                    <p>We may collect information about you in a variety of ways, including:
                    </p>
                    <ul>
                        <li>When you create an account or register for one of our products or services</li>
                        <li> When you purchase or use our products or services
                        </li>
                        <li> When you visit our website or use our mobile app.</li>

                        <li> When you communicate with us, such as by email, phone, or through our customer support
                            channels
                        </li>
                    </ul>
                </div>
                <div class="collect-text">
                    <p>The types of information we may collect include:
                    </p>
                    <ul>
                        <li>Personal information, such as your name, email address, and phone number</li>
                        <li>Payment information, such as your credit card or bank account information</li>
                        <li>Technical information, such as IP address, device type, and device identifiers,</li>
                        <li>Usage information, such as how you use our products and services</li>
                    </ul>
                </div>
                <div class="collect-head">
                    <h6>How We Use Your Information</h6>

                </div>
                <div class="collect-text">
                    <p>We may use the information we collect for a variety of purposes, including:</p>
                    <ul>
                        <li>To provide and improve our products and services</li>
                        <li>To process and fulfil orders and transactions</li>
                        <li> To communicate with you about your account and provide customer support</li>
                        <li>To personalise your experience and present customised content and offers</li>
                        <li>To analyse and understand how our products and services are used</li>
                        <li>To develop new products and services</li>
                        <li>To protect the security and integrity of our products and services</li>
                        <li>Sharing Your Information</li>
                    </ul>
                </div>
                <div class="collect-head">
                    <h6>Sharing Your Information</h6>

                </div>
                <div class="collect-text">
                    <p>We may share your information in the following ways:</p>
                    <ul>
                        <li> With third-party service providers who assist us in providing and improving our products
                            and services</li>
                        <li>With third parties for marketing and advertising purposes, subject to your consent</li>
                        <li>In response to legal process, such as a court order or subpoena
                        </li>
                        <li>In the event of a meraer. acquisition. or other business restructurina</li>
                    </ul>
                </div>


            </div>

        </div>

    </section>

@endsection