@extends('front_layout/index')
@section('layout')
<section>
  <!-- Credit card form -->
  <div class="row my-4">
    <div class="container col-md-6 mb-4">
        <div class="">
          <form id="payment-form" action="{{ url('checkoutpayment') }}" method="POST">
            @csrf
            <div class="row mb-4">
              <div class="col">
                <div class="form-outline">
                  <input type="text" id="full_name" name="full_name" class="form-control" required />
                  <label class="form-label" for="full_name">Full name</label>
                </div>
              </div>
            </div>
            @foreach ($cart as $c)
              <input type="hidden" class="product-data" data-quantity="{{ $c->product_quantity ?? '' }}" value="{{ $c->product_id ?? '' }}" />
          @endforeach
          <input type="hidden" name="products" id="products"/>
            <!-- Email input -->
            <div class="form-outline mb-4">
              <input type="email" name="email" id="email" class="form-control" required />
              <label class="form-label" for="email">Email</label>
            </div>
            <div class="form-outline mb-4">
              <input type="number" name="phone" id="phone" class="form-control" required />
              <label class="form-label" for="phone">Phone</label>
            </div>
            <hr>
            <div class="card-detail payment-option" id="card">
              <div class="form-group">
                <div id="card-elements"></div>
                <div class="text text-danger mt-2" id="card-error-message"></div>
              </div>

            </div>
            <hr>
            <input type="hidden" name="amount" value="{{ $total_amount }}">
            <button type="submit" class="btn-main btn btn-primary pay-with-btn" id="card-button" data-secret="{{ $client_secret }}">Pay
              Now</button>
          </form>
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
  console.log(stripe);
  const elements = stripe.elements();
  const cardElement = elements.create('card');
  cardElement.mount('#card-elements');

  const form = document.getElementById('payment-form');
  console.log(form);
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
            $('#card-elements').append('<input type="hidden" name="token" value="'+setupIntent.payment_method+'">');
            form.submit();
        }
  });
</script>
@endsection
   