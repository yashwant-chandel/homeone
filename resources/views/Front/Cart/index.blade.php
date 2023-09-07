@extends('front_layout/index')
@section('layout')

<section class="shopping-cart-sec">
        <div class="container">
            <div class="cart-head">
                <h3>Shopping Cart</h3>
            </div>
            <div class="table-data">
                <div class="shoping-tab">

               
                <table class="product-table">
                  <thead>
                    <tr class="head-class">
                      <th data-th="Product" class="col-6 bor">Product</th>
                      <th data-th="Quantity" class="col-2 bor">Price</th>
                      <th data-th="Quantity" class="col-2 bor">Quantity</th>
                      <th data-th="Total" class="col-2 bor total-text">Subtotal</th>
                      <th data-th="Remove" class="col-2 bor remove-text">Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($cart as $c )
                   
                    <tr class="cart{{ $c->product->id ?? '' }}">
                      <td data-th="Product" class="product-data-wrap">
                        <div class="cart-wrapper">
                          <div class="cart-img"><img src="{{ url('productIMG') ?? '' }}/{{ $c->product->featured_image ?? '' }} " alt=""></div>
                          <div class="cart-content">
                           <p><?php echo $c->product->short_note ?></p>
                          </div>
                        </div>
                      </td>
                      <td data-th="Quantity" class="product-data-wrap">
                      <p> ${{ $c->product->sale_price ?? '' }}</p>
                      </td>
                      <td data-th="Total" class="product-data-wrap total-text">
                            <div class="value_data">
                                <div class="value-button decrease" value="Decrease Value">-</div>
                                <input class="number" id="number" type="number" data-product-id="{{ $c->product->id }}" value="{{ $c->product_quantity ?? '' }}" disabled />
                                <div class="value-button increase" value="Increase Value">+</div>
                            </div>
                        </td>

                      <td data-th="Total" class="product-data-wrap total-text">
                        <p>${{ $c->subtotal ?? '' }}</p>
                      </td>
                      <td data-th="Remove"  class=" product-data-wrap remove-text aaa">
                        <i class="removeItem fa-solid fa-xmark" data-id="{{ $c->product->id ?? '' }}" style="cursor:pointer;"></i>
                      </td>
                    </tr>
                        
                    @endforeach
                  </tbody>
                </table>
            </div>
                <table class="apply-table">
                    <tbody>
                        <tr>
                            <td> <div class="check-btn">
                                <input type="text" placeholder="Enter Discount Code" class="cta code">
                                <a href="#" class="cta cart">Apply Discount</a></div></td>
                                <td> <div class="cart-btn">
                                    <a href="#" class="updateCart">Update Shopping Cart</a>
                                    <a href="#" class="removeAll">Clear Shopping Cart</a></div></td>
                               
                        </tr>
                    </tbody>
                </table>
              <div class="table-text">
                <div class="total-data">
                <div class="Subtotal-content">
                    <div class="Subtotal-text">
                      <table class="tableTotal">
                        <tbody>
                            <tr class="sum">
                                <td data-th="Subtotal" class="cart-custom sum">Summary</td>
                              
                              </tr>
                              <tr class="sum">
                                <td data-th="Subtotal" class="cart-custom tax" colspan="2">
                                    <select name="" id="">
                                        <option value="">Estimate Shipping and Tax</option>
                                        <option value="">option</option>
                                        <option value="">option</option>

                                    </select>
                                </td>
                              
                              </tr>
                          <tr>
                            <td data-th="Subtotal" class="cart-custom">Subtotal</td>
                            <td data-th="Subtotal" class="cart-detail cart-custom">${{ $subtotalSum ?? '' }}</td>
                          </tr>
                          <tr>
                            <td data-th="Shipping" class="cart-custom">Shipping  </td>
                            <td data-th="Shipping" class="cart-detail cart-custom">$0</td>
                          </tr>
                          <tr>
                            <td data-th="Taxes" class="cart-custom">Tax</td>
                            <td data-th="Taxes" class="cart-detail cart-custom">$0</td>
                          </tr>
                          <tr>
                            <td data-th="data" class="total-data">Order Total Incl. Tax</td>
                            <td data-th="Total" class="total-data cart-detail ">${{ $subtotalSum ?? '' }}</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="Checkout-btn">
                      <a href="{{ url('checkout') ?? ''}}" class="cta">Proceed to Checkout</a>
                    
                </div>
                </div>
              </div>
        </div>

    </section>

    <section class="all_products_sec p-130">
        <div class="container">
            <div class="products-wrapper">
                <div class="products-head">
                    <h3>You May Also Love</h3>
                </div>
            </div>
            <div class="row">
                @foreach ($relatedProducts as $related)
                 
                <div class="col-lg-4 col-md-6">
                    <div class="box-products">
                        <div class="products-img"><img src="{{ url('productIMG') ?? '' }}/{{ $related['featured_image'] ?? '' }}" alt=""></div>
                        <div class="products-data">
                            <div class="products-name">
                                <h4>{{ $related['product_name'] ?? '' }}</h4>
                                <p><?php print_r($related['short_note']) ?></p>
                            </div>
                            <div class="products-star"><i class="fa-sharp fa-solid fa-star"></i><i
                                    class="fa-sharp fa-solid fa-star"></i><i class="fa-sharp fa-solid fa-star"></i><i
                                    class="fa-sharp fa-solid fa-star"></i><i class="fa-sharp fa-solid fa-star"></i>
                            </div>
                            <div class="products-price">
                                <h6>${{ $related['sale_price'] ?? '' }}<span>${{ $related['price'] ?? '' }}</span></h6>
                            </div>
                            <div class="add-cart">
                                <a href="" data-id="{{ $related['id'] ?? '' }}" class="add-btn active addToCart">Add To Cart</a>
                                <a href="{{ url('store-details') ?? '' }}/{{ $related['slug'] ?? '' }}" class="more-btn">Learn More</a>
                            </div>
                        </div>
                    </div>
                </div>
                   
                @endforeach
            </div>
                </div>
    </section>
  <!-- Add to cart script -->
  <script>
$(document).ready( function(){
    $("body").delegate(".addToCart", "click", function(e) {
    // $('.addToCart').on('click', function(e){
        e.preventDefault();
        var product_id = $(this).attr('data-id');
        console.warn(product_id);
        var quantity = 1;
        if (quantity === '' || quantity === undefined) {
            quantity = 1;
        }
        $.ajax({
                method: 'POST',
                url: '{{ url('addToCart') }}',
                dataType: 'json',
                data: {
                    product_id : product_id,
                    quantity : quantity,
                    _token: '{{csrf_token()}}'
                    },
                success: function(response) {
                    console.log(response);
                    if(response.success){
                        iziToast.success({
                            // title: 'DONE',
                            message: response.success,
                            position: 'topRight' // Set the position to top right
                        });
                        $(".tableTotal").load(location.href + " .tableTotal");
                        $(".product-table").load(location.href + " .product-table");

                    }else{
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
<!-- end add to cart -->
<script>
   $(document).ready(function(){
    $("body").delegate(".updateCart", "click", function(e) {
        // $('.updateCart').on('click', function(){
            const cartItems = [];
            const quantityInputs = document.querySelectorAll('.number');
        
            quantityInputs.forEach(input => {
                const productId = input.getAttribute('data-product-id');
                const quantity = input.value;
        
                cartItems.push({ productId, quantity });
            });
            // console.warn(cartItems);
            $.ajax({
                method: 'POST',
                url: '{{ url('update-cart') }}',
                dataType: 'json',
                data: {
                    cartItems : cartItems,
                    _token: '{{csrf_token()}}'
                    },
                success: function(response) {
                    if(response.success){
                            iziToast.success({
                                message: response.success,
                                position: 'topRight'
                            });
                        $(".tableTotal").load(location.href + " .tableTotal");
                        $(".product-table").load(location.href + " .product-table");
                        // window.location.reload();
                    }else{
                        iziToast.error({
                                message: response.error,
                                position: 'topRight'
                            });
                      
                    }
                   
                }

            });
        });
   });
</script>
<script>
    $(document).ready(function(){
        $("body").delegate(".removeItem", "click", function(e) {
        // $('.removeItem').on('click',function(){
            // console.warn($(this).attr('data-id'));
            var product_id = $(this).attr('data-id');
            // console.warn(product_id);
            $.ajax({
                method: 'POST',
                url: '{{ url('remove-cart') }}',
                dataType: 'json',
                data: {
                    product_id : product_id,
                    removeSingle:'removeSingle',
                    _token: '{{csrf_token()}}'
                    },
                success: function(response) {
                    // console.log(response);
                    if(response.success){
                        // console.log(product_id);
                        $('.cart'+product_id).remove();
                        // console.log(response.success);
                        iziToast.success({
                            // title: 'DONE',
                            message: response.success,
                            position: 'topRight' // Set the position to top right
                        });
                        $(".tableTotal").load(location.href + " .tableTotal");
                    }else{
                        iziToast.error({
                            message: response.error,
                            position: 'topRight' // Set the position to top right
                        });
                        // console.log(response.error);
                    }
                   
                }

            });
        })
    })
</script>
<script>
    $(document).ready(function(){
    $("body").delegate(".removeAll", "click", function(e) {
        // $('.removeAll').on('click',function(){
            $.ajax({
                method: 'POST',
                url: '{{ url('remove-cart') }}',
                dataType: 'json',
                data: {
                    removeAll:'removeAll',
                    _token: '{{csrf_token()}}'
                    },
                success: function(response) {
                    // console.log(response);
                    if(response.success){
                        // setTimeout(function() {
                            iziToast.success({
                                message: response.success,
                                position: 'topRight'
                            // });
                            // location.reload();
                        });
                        $(".tableTotal").load(location.href + " .tableTotal");
                        $(".product-table").load(location.href + " .product-table");
                        // window.location.reload();
                        console.log(response.success);
                    }else{
                        iziToast.error({
                            // title: 'DONE',
                            message: response.error,
                            position: 'topRight' // Set the position to top right
                        });
                        //   console.log(response.error);
                        
                    }
                   
                }

            });
        })
    })
</script>
@endsection
   