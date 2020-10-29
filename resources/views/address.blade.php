@extends('layout')

@section('title', 'Fill address information')

@section('extra-css')
    <style>
        .mt-32 {
            margin-top: 32px;
        }
    </style>

    <script src="https://js.stripe.com/v3/"></script>

@endsection

@section('content')
    <div class="container">
      <div class="steps row">
        <div class="line"></div>
        <div class="step">
          <a href="{{ route('cart.index') }}">
            <div class="circle complete">1</div>
            <div class="label">Cart</div>
          </a>
        </div><!-- end "step" -->
        <div class="step">
          <div class="circle active">2</div>
          <div class="label">Order<span class="responsive_hide"> Information</span></div>
        </div><!-- end "step" -->
        <div class="step">
          <div class="circle">3</div>
          <div class="label">Preview<span class="responsive_hide"> and Pay</span></div>
        </div><!-- end "step" -->
      </div><!-- end "steps" -->
    </div>
    <div class="container address-container">

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

        <h1 class="address-heading stylish-heading">Address information</h1>
        <div class="address-section">
            <div>
                <form action="{{ route('address.store') }}" method="POST"  id="payment-form">
                    @csrf
                    <h2>Billing Details</h2>

                    <div class="form-group">
                        <label for="billing_email">Email Address</label>
                        @if (auth()->user())
                            <input type="email" class="form-control" id="billing_email" name="billing_email" value="{{ auth()->user()->email }}" readonly>
                        @else
                            <input type="email" class="form-control" id="billing_email" name="billing_email" value="{{ old('billing_email', $billing_email) }}" required>
                        @endif
                    </div>
                    <div class="half-form">
                      <div class="form-group">
                        <label for="billing_firstName">First name</label>
                        <input type="text" class="form-control" id="billing_billing_firstName" name="billing_firstName" value="{{ old('billing_firstName', $billing_firstName) }}" required>
                      </div>
                      <div class="form-group">
                        <label for="billing_lastName">Last name</label>
                        <input type="text" class="form-control" id="billing_lastName" name="billing_lastName" value="{{ old('billing_lastName', $billing_lastName) }}" required>
                      </div>
                    </div>
                    <div class="form-group">
                        <label for="billing_address">Address</label>
                        <input type="text" class="form-control" id="billing_address" name="billing_address" value="{{ old('billing_address', $billing_address) }}" required>
                    </div>
                    <div class="half-form">
                      <div class="form-group">
                        <label for="billing_country">Country</label>
                        <select id="billing_country" class="selectpicker show-tick" data-show-subtext="true" data-style="country-select" data-live-search="true" name="billing_country" data-width="100%">
                            <option value="">Choose</option>
                            @foreach ($countries as $key => $country)
                                <option value="{{ $country->iso }}"
                                  {{ $billing_countryIso == $country->iso ? "selected" : "" }}
                                  >{{ $country->nicename }}</option>
                            @endforeach
                          </select>
                      </div>
                        <div class="form-group">
                            <label for="billing_city">City</label>
                            <input type="text" class="form-control" id="billing_city" name="billing_city" value="{{ old('billing_city', $billing_city) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="billing_province">Province</label>
                            <input type="text" class="form-control" id="billing_province" name="billing_province" value="{{ old('billing_province', $billing_province) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="billing_postalcode">Postal Code</label>
                            <input type="text" class="form-control" id="billing_postalcode" name="billing_postalcode" value="{{ old('billing_postalcode', $billing_postalcode) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="billing_phone">Phone</label>
                            <input type="text" class="form-control" id="billing_phone" name="billing_phone" value="{{ old('billing_phone', $billing_phone) }}" required>
                        </div>
                    </div> <!-- end half-form -->
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="address_different" onclick="showMe('delivery_container')" {{ old('address_different') == '1' ? 'checked' : '' }} value="1">
                      <label class="form-check-label" for="">Your Delivery Address is different?</label>
                    </div>
                    <div class="spacer"></div>

                    <div id="delivery_container" style="display: {{ old('address_different') == '1' ? 'block' : 'none' ?? 'none' }}">
                      <h2>Delivery Details</h2>

                      <div class="form-group">
                          <label for="delivery_email">Email Address</label>
                          @if (auth()->user())
                              <input type="email" class="form-control" id="delivery_email" name="delivery_email" value="{{ auth()->user()->email }}">
                          @else
                              <input type="email" class="form-control" id="delivery_email" name="delivery_email" value="{{ old('delivery_email', $delivery_email) }}">
                          @endif
                      </div>
                      <div class="half-form">
                        <div class="form-group">
                          <label for="delivery_firstName">First name</label>
                          <input type="text" class="form-control" id="delivery_delivery_firstName" name="delivery_firstName" value="{{ old('delivery_firstName', $delivery_firstName) }}">
                        </div>
                        <div class="form-group">
                          <label for="delivery_lastName">Last name</label>
                          <input type="text" class="form-control" id="delivery_lastName" name="delivery_lastName" value="{{ old('delivery_lastName', $delivery_lastName) }}">
                        </div>
                      </div>
                      <div class="form-group">
                          <label for="delivery_address">Address</label>
                          <input type="text" class="form-control" id="delivery_address" name="delivery_address" value="{{ old('delivery_address', $delivery_address) }}">
                      </div>
                      <div class="half-form">
                        <div class="form-group">
                          <label for="delivery_country">Country</label>
                          <select id="delivery_country" class="selectpicker show-tick" data-show-subtext="true" data-style="country-select" data-live-search="true" name="delivery_country" data-width="100%">
                              <option value="">Choose</option>
                              @foreach ($countries as $key => $country)
                                  <option value="{{ $country->iso }}"
                                    {{ $delivery_countryIso == $country->iso ? "selected" : "" }}
                                    >{{ $country->nicename }}</option>
                              @endforeach
                            </select>
                        </div>
                          <div class="form-group">
                              <label for="delivery_city">City</label>
                              <input type="text" class="form-control" id="delivery_city" name="delivery_city" value="{{ old('delivery_city', $delivery_city) }}">
                          </div>
                          <div class="form-group">
                              <label for="delivery_province">Province</label>
                              <input type="text" class="form-control" id="delivery_province" name="delivery_province" value="{{ old('delivery_province', $delivery_province) }}">
                          </div>

                          <div class="form-group">
                              <label for="delivery_postalcode">Postal Code</label>
                              <input type="text" class="form-control" id="delivery_postalcode" name="delivery_postalcode" value="{{ old('delivery_postalcode', $delivery_postalcode) }}">
                          </div>
                          <div class="form-group">
                              <label for="delivery_phone">Phone</label>
                              <input type="text" class="form-control" id="delivery_phone" name="delivery_phone" value="{{ old('delivery_phone', $delivery_phone) }}">
                          </div>
                      </div> <!-- end half-form -->
                    </div>

                    <div class="spacer"></div>
                    <h1 class="address-heading stylish-heading">Choose payment</h1>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="paymentType" id="stripe" value="stripe" {{ ($paymentType == 'stripe') ? 'checked' : '' }}>
                      <label class="form-check-label" for="stripe">
                        Visa/Mastescard <i style="font-size:8px;">(+3% to total price)</i>
                      </label>
                    </div>

                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="paymentType" id="paypal" value="paypal" {{ ($paymentType == 'paypal') ? 'checked' : '' }}>
                      <label class="form-check-label" for="paypal">
                        Paypal <i style="font-size:8px;">(+ 5% to total price)</i>
                      </label>
                    </div>
                    <div class="spacer"></div>


                    <div class="spacer"></div>

                    <button type="submit" id="" class="button button-checkout full-width">Preview Order</button>


                </form>
            </div>

        </div> <!-- end address-section -->
    </div>

@endsection

@section('extra-js')
  <script>
    // (function(){
      function showMe(box) {
          var chboxs = document.getElementsByName("address_different");
          var none = "none";
          for(var i=0;i<chboxs.length;i++) {
              if(chboxs[i].checked){
               none = "block";
                  break;
              }
          }

          // alert(document.getElementById(box));
          document.getElementById(box).style.display = none;

      }
    // })();
  </script>
@endsection
