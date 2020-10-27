@extends('layout')

@section('title', 'Preview Order')

@section('extra-css')
<style>
    .mt-32 {
        margin-top: 32px;
    }
</style>

<script src="https://js.stripe.com/v3/"></script>
@endsection

@section('content')
    <div class="container preview-order-container">

        @if (session()->has('success_message'))
            <div class="spacer"></div>
            <div class="alert alert-success">
                {{ session()->get('success_message') }}
            </div>
        @endif

        @if(count($errors) > 0)
            <div class="spacer"></div>
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{!! $error !!}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <h1 class="preview-order-heading stylish-heading">Preview Order and Pay</h1>
        <div class="preview-order-section">

            <div class="preview-order-table-container">
                <h2>Your Order</h2>
                <div class="preview-order-table">
                    @foreach  (Cart::content() as $item)
                      <div class="preview-order-table-row">
                        <div class="preview-order-table-row-left">
                          <img src="{{ Voyager::image($item->model->image) }}" alt="item" class="preview-order-table-img">
                          <div class="preview-order-item-details">
                            <div class="preview-order-table-item">{{ $item->model->name }}</div>
                            <div class="preview-order-table-description">{{ $item->model->details }}</div>
                            <div class="preview-order-table-price">{{ $item->model->presentPrice() }}</div>
                          </div>
                        </div> <!-- end preview-order-table -->

                        <div class="preview-order-table-row-right">
                          <div class="preview-order-table-quantity">{{ isset($item->qty) ? $item->qty : 0 }}</div>
                        </div>
                      </div> <!-- end preview-order-table-row -->
                    @endforeach

                </div> <!-- end preview-order-table -->

                <div class="preview-order-totals">
                  <div class="preview-order-totals-left">
                    Subtotal <br>
                    @if (session()->has('coupon'))
                        Discount ({{ session()->get('coupon')['name'] }}) :
                        <br>
                        <hr>
                        New Subtotal <br>
                    @endif
                    @if (session()->has('shipping_price') && session()->get('shipping_price') > 0)
                      <div class="my-2"></div>
                      <span>Shipping <br></span>
                    @endif
                    Tax ({{ $tax }}%)<br>
                    <span class="preview-order-totals-total">Total</span>

                  </div>

                  <div class="preview-order-totals-right">
                    {{ presentPrice(Cart::subtotal(), true) }} <br>
                    @if (session()->has('coupon'))
                        -{{ presentPrice($discount, true) }} <br>
                        <hr>
                        {{ presentPrice($newSubtotal, true) }} <br>
                    @endif
                    @if (session()->has('shipping_price') && session()->get('shipping_price') > 0)
                        <div class="my-2"></div>
                        {{ presentPrice($shipping, true) }}
                        <br>
                    @endif
                    {{ presentPrice($newTax, true) }} <br>
                    <span class="preview-order-totals-total">{{ presentPrice($newTotal, true) }}</span>

                  </div>
                </div> <!-- end preview-order-totals -->
            </div>
            @if (session('userAddress')['paymentType'] == 'stripe')
            <form action="{{ route('checkout.store') }}" method="POST"  id="payment-form">
              @csrf
              <h2>Payment Details</h2>

              <div class="form-group">
                <label for="name_on_card">Name on Card</label>
                <input type="text" class="form-control" id="name_on_card" name="name_on_card" value="">
              </div>

              <div class="form-group">
                <label for="card-element">
                  Credit or debit card
                </label>
                <div id="card-element">
                  <!-- a Stripe Element will be inserted here. -->
                </div>

                <!-- Used to display form errors -->
                <div id="card-errors" role="alert"></div>
              </div>
              <div class="spacer"></div>

              <button type="submit" id="complete-order" class="button-primary full-width">Complete Order</button>
            </form>
            @endif
            @if (session('userAddress')['paymentType'] == 'paypal')
              @if ($paypalToken)
                    <div class="mt-32">
                        <h2>Pay with PayPal</h2>

                        <form method="post" id="paypal-payment-form" action="{{ route('checkout.paypal') }}">
                            @csrf
                            <section>
                                <div class="bt-drop-in-wrapper">
                                    <div id="bt-dropin"></div>
                                </div>
                            </section>

                            <input id="nonce" name="payment_method_nonce" type="hidden" />
                            <button class="button-primary full-width" type="submit"><span>Pay with PayPal</span></button>
                        </form>
                    </div>
                @endif
            @endif
        </div> <!-- end preview-order-section -->
    </div>


@endsection

@section('extra-js')
  <script src="https://js.braintreegateway.com/web/dropin/1.13.0/js/dropin.min.js"></script>
  <script>
  (function(){
    @if (session('userAddress')['paymentType'] == 'stripe')
    // Create a Stripe client
    var stripe = Stripe('{{ config('services.stripe.key') }}');

    // Create an instance of Elements.
    var elements = stripe.elements();

    // Custom styling can be passed to options when creating an Element.
    // (Note that this demo uses a wider set of styles than the guide below.)
    var style = {
      base: {
        color: '#32325d',
        fontFamily: '"Roboto", Helvetica Neue", Helvetica, sans-serif',
        fontSmoothing: 'antialiased',
        fontSize: '16px',
        '::placeholder': {
          color: '#aab7c4'
        }
      },
      invalid: {
        color: '#fa755a',
        iconColor: '#fa755a'
      }
    };

    // Create an instance of the card Element.
    var card = elements.create('card', {
      style: style,
      hidePostalCode: true
    });

    // Add an instance of the card Element into the `card-element` <div>.
    card.mount('#card-element');

    // Handle real-time validation errors from the card Element.
    card.on('change', function(event) {
      var displayError = document.getElementById('card-errors');
      if (event.error) {
        displayError.textContent = event.error.message;
      } else {
        displayError.textContent = '';
      }
    });

    // Handle form submission.
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
      event.preventDefault();

      // Disable the submit button to prevent repeated clicks
      document.getElementById('complete-order').disabled = true;

      var options = {
        name: document.getElementById('name_on_card').value,
        address_line1: "{{ session('userAddress')['billing_address'] }}",
        address_city: "{{ session('userAddress')['billing_city'] }}",
        address_state: "{{ session('userAddress')['billing_province'] }}",
        address_zip: "{{ session('userAddress')['billing_postalcode'] }}"
      }


      stripe.createToken(card, options).then(function(result) {
        if (result.error) {
          // Inform the user if there was an error.
          var errorElement = document.getElementById('card-errors');
          errorElement.textContent = result.error.message;

          // Disable the submit button to prevent repeated clicks
          document.getElementById('complete-order').disabled = false;
        } else {
          // Send the token to your server.
          stripeTokenHandler(result.token);
        }
      });
    });

    function stripeTokenHandler(token) {
        // Insert the token ID into the form so it gets submitted to the server
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);

        // Submit the form
        form.submit();
      }
    @endif
    @if (session('userAddress')['paymentType'] == 'paypal')
    // PayPal Stuff
    var form = document.querySelector('#paypal-payment-form');
    var client_token = "{{ $paypalToken }}";
    braintree.dropin.create({
      authorization: client_token,
      selector: '#bt-dropin',
      paypal: {
        flow: 'vault'
      }
    }, function (createErr, instance) {
      if (createErr) {
        console.log('Create Error', createErr);
        return;
      }
      // remove credit card option
      var elem = document.querySelector('.braintree-option__card');
      elem.parentNode.removeChild(elem);
      form.addEventListener('submit', function (event) {
        event.preventDefault();
        instance.requestPaymentMethod(function (err, payload) {
          if (err) {
            console.log('Request Payment Method Error', err);
            return;
          }
          // Add the nonce to the form and submit
          document.querySelector('#nonce').value = payload.nonce;
          form.submit();
        });
      });
    });
    @endif
  })();
  </script>
@endsection
