@extends('front_layout/index')
@section('layout')
<section class="check-out-sec p-130">
        <div class="container">
            <div class="check-out-head">
                <h3>Check Out</h3>
            </div>
            <div class="check_out_wrapper">
                <div class="row">
                    <div class="col-md-6">
                        <div class="billing-details">
                            <div class="billing-content">
                                <h5>Billing Details</h5>
                            </div>
                            <div class="billing_form">
                            <form id="payment-form" action="{{ url('checkoutpayment') }}" method="POST">
                                @csrf
                                    <div class="row form-group">
                                        
                                        <div class="col">
                                        @error('first_name')
                                            <div class="text-danger error">{{ $message }}</div>
                                        @enderror
                                            <input type="text" class="form-control" placeholder="First name" name="first_name" id="first_name" />
                                        </div>
                                        
                                        <div class="col">
                                        @error('last_name')
                                            <div class="text-danger error">{{ $message }}</div>
                                        @enderror
                                            <input type="text" class="form-control" placeholder="Last name"  name="last_name" id="last_name" />
                                        </div>
                                    </div>
                                        
                                    <div class="form-group">
                                        @error('email')
                                            <div class="text-danger error">{{ $message }}</div>
                                        @enderror
                                        <input type="Email" class="form-control" placeholder="Email Address"  name="email" id="email" />
                                    </div>
                                    <div class="form-group">
                                        @error('phone')
                                            <div class="text-danger error">{{ $message }}</div>
                                        @enderror
                                        <input type="number" class="form-control" placeholder="Phone number"  name="phone" id="phone" />
                                    </div>
                                    <div class="form-group">
                                        @error('last_name')
                                            <div class="text-danger error">{{ $message }}</div>
                                        @enderror
                                        <select name="country" >
                                            <option  selected disabled >Country / Region</option>
                                            <option value="US">US</option>
                                            <option value="IND">IND</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        @error('street')
                                            <div class="text-danger error">{{ $message }}</div>
                                        @enderror
                                        <input type="text" class="form-control" placeholder="Street Address" name="street" id="street" />
                                    </div>
                                    <div class="form-group">
                                        @error('city')
                                            <div class="text-danger error">{{ $message }}</div>
                                        @enderror
                                        <input type="text" class="form-control" placeholder="Town / City" name="city" id="city" />
                                    </div>
                                    <div class="form-group">
                                        @error('state')
                                            <div class="text-danger error">{{ $message }}</div>
                                        @enderror
                                        <select name="state">
                                            <option selected disabled >State</option>
                                            <option value="San Francisco">San Francisco</option>
                                            <option value="New York"> New York</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        @error('postal_code')
                                            <div class="text-danger error">{{ $message }}</div>
                                        @enderror
                                        <input type="text" class="form-control" placeholder="POSTAL Code" name="postal_code" id="postal_code"/>
                                    </div>
                                    <!-- <div class="additional-form">
                                        <h6>Additional Information</h6>
                                        <div class="form-group">
                                            <select>
                                                <option value="">Notes about your order, e.g. special notes for delivery. </option>
                                                <option value="">option</option>
                                                <option value="">option</option>
                                            </select>
                                        </div>
                                    </div> -->
                                <!-- </form> -->
                            </div>
                            <!-- <form class="pay_card_form"> -->
                                <div class="payments-method">
                                    <h5>Payments Method</h5>
                                    <div class="pament-box">
                                        <!-- <div class="card-wrapper">
                                            <div class="card-form">
                                                <div class="card-button">
                                                    <input type="radio" id="test1" name="radio-group" />
                                                    <label for="test1">Credit Card / Debit Card</label>
                                                </div>
                                            </div>
                                            <div class="boxs-img">
                                                <img src="img/cardimg.png" alt="" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Card Number" />
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Name On Card" />
                                        </div>
                                        <div class="row form-group">
                                            <div class="col">
                                                <input type="text" class="form-control" placeholder="Expiration Date (MM/YY)" />
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" placeholder="Card Verification Number" />
                                            </div>
                                        </div>
                                        <div class="card-button credit">
                                            <input type="radio" id="test2" name="radio-group" />
                                            <label for="test2">Credit Card / Debit Card</label>
                                        </div> -->
                                        <div class="card-button credit">
                                            <input type="radio" id="test3" name="paymentOption" checked />
                                            <label for="test3">Pay With Stripe</label>
                                            <div class="card-detail payment-option my-4" id="card">
                                                <div class="form-group">
                                                    <div id="card-elements"></div>
                                                    <div class="text text-danger mt-2" id="card-error-message"></div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="card-button">
                                            <input type="radio" id="test4" name="msg" />
                                            <label for="test4">
                                                I would like to receive exclusive emails with discounts and product information (optional)
                                                <span> Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our privacy policy.</span>
                                            </label>
                                        </div>
                                        @foreach ($cart as $c)
                                            <input type="hidden" class="product-data" data-quantity="{{ $c->product_quantity ?? '' }}" value="{{ $c->product_id ?? '' }}" />
                                        @endforeach
                                        <input type="hidden" name="products" id="products"/>
                                        <div class="checkbox-button">
                                            <div class="order-btn">
                                                <a href="" class="back">back</a>
                                            </div>
                                            <div>
                                                <!-- <a href="" class="place">place order</a> -->
                                                <input type="hidden" name="token" id="token" />
                                                <input type="hidden" name="amount" value="{{ $total_amount }}">
                                                <button type="submit" class="btn-main btn btn-primary pay-with-btn btn-lg" id="card-button" data-secret="{{ $client_secret }}">Pay
                                                Now</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6 total-text">
                        <div class="cart_totals">
                            <div class="check_out_table">

                           
                            <h5>Cart Totals</h5>
                            <div class="total-data">
                                <div class="Subtotal-content">
                                    <div class="Subtotal-text">
                                      <table>
                                        <tbody>
                                            <th>Product</th>
                                            <th class="price">Price</th>
                                            @foreach ($cart as $c)
                                            <tr>
                                                <td class="padd-product">
                                                    <div class="cart-wrapper">
                                                        <div class="cart-img"><img src="{{ url('productIMG') ?? '' }}/{{ $c->product->featured_image ?? '' }}" alt=""></div>
                                                        <div class="cart-content">
                                                         <p><?php print_r($c->product->short_note) ?> </p>
                                                        </div>
                                                      </div>
                                                </td>
                                                
                                                <td class="padd-product">${{ $c->product->sale_price ?? '' }}</td>
                                            </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="2" class="count-data">
                                                    <div class="cart-btn code-btn">
                                                        <input type="text" class="code-btn" placeholder="Gift Car Or Discount Code" > 
                                                        <a href="#" class="blur-btn">Apply</a></div>
                                                </td>
                                            </tr>
                                           
                                        
                                          <tr>
                                            <td data-th="Subtotal" class="cart-custom">Subtotal</td>
                                            <td data-th="Subtotal" class="cart-detail cart-custom">${{ $total_amount ?? '' }}</td>
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
                                            <td data-th="Total" class="total-data cart-detail ">${{ $total_amount ?? '' }}</td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </div>
                                  </div>
                                
                                </div>

                        </div>

                    </div>
                </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function() {
            var productData = {};
            $('.product-data').each(function() {
                var quantity = $(this).data('quantity');
                var productId = $(this).val();
                productData[quantity] = productId;
            });

            var productDataJson = JSON.stringify(productData);
            $('#products').val(productDataJson);
        });
    </script>

<script src="https://js.stripe.com/v3/"></script>
<script>
  const stripe = Stripe('{{ env('STRIPE_KEY') }}');
//   console.log(stripe);
  const elements = stripe.elements();
  const cardElement = elements.create('card');
  cardElement.mount('#card-elements');

  const form = document.getElementById('payment-form');
//   console.log(form);
  form.addEventListener('submit', async (e) => {

    const cardBtn = document.getElementById('card-button');
    const cardHolderName = $('#first_name').val() + ' ' + $('#last_name').val();

    e.preventDefault()

    // cardBtn.disabled = true
    const { setupIntent, error } = await stripe.confirmCardSetup(
      cardBtn.dataset.secret, {
      payment_method: {
        card: cardElement,
        billing_details: {
          name: cardHolderName
        }
      }
    }
    )

    if(error){
            console.log(error);
        }else{
            $('#token').val(setupIntent.payment_method);
            form.submit();
        }
  });
</script>
@endsection
   