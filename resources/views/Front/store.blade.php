@extends('front_layout/index')
@section('layout')
<section class="banner-sec" style="background-image: url({{ asset('front/img/store-banner.png')}});">
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
            <div class="select-data">
                <select class="shortBy" >
                    <option value="ASC-product_name" class="">Sort By: Alphabetically: A-Z</option>
                </select>
            </div>
        </div>
        <? $pNo = 0; ?>
        <div class="row" id="product-container">

            @foreach ($products as $product )

            <div class="col-lg-4 col-md-6">
                <div class="box-products">
                    <div class="products-img"><img src="{{ asset('productIMG')}}/{{ $product->featured_image ?? ''}}"
                            alt=""></div>
                    <div class="products-data">
                        <div class="products-name">
                            <h4>{{ $product->product_name ?? '' }}</h4> <!-- <sup>TM</sup> -->
                            <p><?php print_r($product->short_note); ?></p>
                        </div>
                        <div class="products-star"><i class="fa-sharp fa-solid fa-star"></i><i
                                class="fa-sharp fa-solid fa-star"></i><i class="fa-sharp fa-solid fa-star"></i><i
                                class="fa-sharp fa-solid fa-star"></i><i class="fa-sharp fa-solid fa-star"></i>
                        </div>
                        <div class="products-price">
                            @if($product->sale_price)
                            <h6>${{ $product->sale_price ?? '' }}<span>${{ $product->price ?? '' }}</span></h6>
                            @else
                            <h6>${{ $product->price ?? '' }}</h6>
                            @endif
                        </div>
                        <div class="add-cart"><a href="" data-id="{{ $product->id ?? '' }}"
                                class="add-btn active addToCart">Add To Cart</a><a
                                href="{{ url('store-details') ?? '' }}/{{ $product->slug ?? '' }}"
                                class="more-btn">Learn More</a></div>
                    </div>
                </div>
            </div>

            @endforeach
        </div>
        @if (count($products) < count($total_product)) <div class="submit_cta">
            <a href="{{ url('store')}}?page_order={{ count($products) + 9 }}" class="submit-btn" id="show-more-btn">Show
                More</a>
    </div>
    @endif


    </div>
</section>

<!-- Add to cart script -->
<script>
$(document).ready(function() {
    $('.addToCart').on('click', function(e) {
        e.preventDefault();
        var product_id = $(this).attr('data-id');
        console.warn(product_id);
        var quantity = $("input[type='number']").val();
        if (quantity === '' || quantity === undefined) {
            quantity = 1;
        }
        $.ajax({
            method: 'POST',
            url: '{{ url('addToCart ') }}',
            dataType: 'json',
            data: {
                product_id: product_id,
                quantity: quantity,
                _token: '{{csrf_token()}}'
            },
            success: function(response) {
                console.log(response);
                if (response.success) {
                    iziToast.success({
                        // title: 'DONE',
                        message: response.success,
                        position: 'topRight' // Set the position to top right
                    });


                } else {
                    iziToast.error({
                        message: response.error,
                        position: 'topRight' // Set the position to top right
                    });

                }
            }

        });
    });
})
</script>
@endsection