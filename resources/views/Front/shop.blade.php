@extends('front_layout/index')
@section('layout')
<section class="banner-sec" style="background-image: url({{ url('front/img/store-banner.png')}});">
        <div class="container">
            <div class="banner-text">
                <h1>Store</h1>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Store</li>
                </ol>
            </nav>
        </div>
    </section>
    <section class="all_products_sec p-130">
        <div class="container">
            <div class="products-wrapper">
                <div class="products-head">
                    <h3>All Products</h3>
                </div>
                <div class="select-data"><select>
                        <option>Sort By: Alphabetically: A-Z</option>
                        <option>option</option>
                        <option>option</option>
                        <option>option</option>
                    </select></div>
            </div>
            <div class="row">
                @foreach ($products as $product )
               
                <div class="col-lg-4 col-md-6">
                    <div class="box-products">
                        <div class="products-img"><img src="{{ url('productIMG')}}/{{ $product->featured_image ?? ''}}" alt=""></div>
                        <div class="products-data">
                            <div class="products-name">
                               <h4>{{ $product->product_name ?? '' }}</h4> <!-- <sup>TM</sup> -->
                                <p>{{ $product->short_note ?? ''}}</p>
                            </div>
                            <div class="products-star"><i class="fa-sharp fa-solid fa-star"></i><i
                                    class="fa-sharp fa-solid fa-star"></i><i class="fa-sharp fa-solid fa-star"></i><i
                                    class="fa-sharp fa-solid fa-star"></i><i class="fa-sharp fa-solid fa-star"></i>
                            </div>
                            <div class="products-price">
                               <h6>${{ $product->price ?? '' }}</h6> <!-- <span>$65.99</span> -->
                            </div>
                            <div class="add-cart"><a href="" class="add-btn active">Add To Cart</a><a href="" class="more-btn">Learn More</a></div>
                        </div>
                    </div>
                </div>
                     
                @endforeach
            </div>
            <div class="submit_cta"><a href="" class="submit-btn">Load More</a></div>
        </div>
    </section>
@endsection