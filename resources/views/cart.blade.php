@extends('layout')

@section('title', 'Shopping Cart')

@section('extra-css')
  <link rel="stylesheet" href="{{ asset('css/algolia.css') }}">
  <script src="https://kit.fontawesome.com/a610340da6.js" crossorigin="anonymous"></script>
@endsection

@section('content')

@component('components.breadcrumbs')
  <a href="/">Home</a>
  <i class="fa fa-chevron-right breadcrumb-separator"></i>
  <span>Shopping Cart</span>
@endcomponent

@if (Cart::count() > 0)
<div class="container">
  <div class="steps row">
    <div class="line"></div>
    <div class="step">
      <div class="circle active">1</div>
      <div class="label">Cart</div>
    </div><!-- end "step" -->
    <div class="step">
      <div class="circle">2</div>
      <div class="label">Order<span class="responsive_hide"> Information</span></div>
    </div><!-- end "step" -->
    <div class="step">
      <div class="circle">3</div>
      <div class="label">Preview<span class="responsive_hide"> Information</span></div>
    </div><!-- end "step" -->
  </div><!-- end "steps" -->
</div>
@endif

<div class="cart-section container">
    <div>
        @if (session()->has('success_message'))
        <div class="alert alert-success">
            {{ session()->get('success_message') }}
        </div>
        @endif

        @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif


            @if (Cart::count() > 0)

            <h2>{{ Cart::count() }} item(s) in Shopping Cart</h2>

            <div class="cart-table">
                @foreach (Cart::content() as $item)
                <div class="cart-table-row">
                    <div class="cart-table-row-left">
                        <a href="{{ route('shop.show', $item->model->slug) }}"><img src="{{ productImage($item->model->image) }}" alt="item" class="cart-table-img"></a>
                        <div class="cart-item-details pl-2">
                            <div class="cart-table-item"><a href="{{ route('shop.show', $item->model->slug) }}">{{ $item->model->name }}</a></div>
                            <div class="cart-table-description">{{ $item->model->details }}</div>
                            <div class="spacer"></div>
                            <div class="cart-table-actions">
                              <form action="{{ route('cart.switchToSaveForLater', $item->rowId) }}" method="POST">
                                  {{ csrf_field() }}

                                  <button type="submit" class="cart-options">
                                    <span><i class="far fa-heart"></i></span>
                                    <span class="saveToWishlist"> Save to Wishlist</span>
                                  </button>
                              </form>
                            </div>
                        </div>
                    </div>
                    <div class="cart-table-row-right">
                        <div>
                            <select class="quantity" data-id="{{ $item->rowId }}" data-productQuantity="{{ $item->model->quantity }}">
                                @for ($i = 1; $i < 5 + 1 ; $i++)
                                    <option {{ $item->qty == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div>{{ presentPrice($item->subtotal, true) }}</div>
                        <div class="">
                          <form action="{{ route('cart.destroy', $item->rowId) }}" method="POST">
                              {{ csrf_field() }}
                              {{ method_field('DELETE') }}

                              <button type="submit" class="remove" style="font-size: 24px"><i class="far fa-times-circle"></i></button>
                          </form>
                        </div>

                    </div>
                </div> <!-- end cart-table-row -->
                @endforeach

            </div> <!-- end cart-table -->

            @if (! session()->has('coupon'))
              <div class="spacer"></div>
                <div class="have-code-container">
                    <form action="{{ route('coupon.store') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="text" name="coupon_code" id="coupon_code" placeholder="Enter discount code">
                        <button type="submit" class="button button-plain">Apply</button>
                    </form>
                </div> <!-- end have-code-container -->
            @endif

            <div class="cart-totals">
                <div class="cart-totals-left">
                    <h2 style="margin-bottom: 5px;"> Shipping: </h2>
                    <form class="radioForm" id="radioForm">
                       <div class="form-check">
                           <label class="form-check-label">
                               <input type="radio" class="form-check-input shipping" name="shipping" value="no" {{ (session()->get('shipping_price') == 0) ? 'checked' : '' }} >Pick up at the store: {{ presentPrice(0, true) }}
                           </label>
                       </div>
                       <div class="form-check">
                           <label class="form-check-label">
                               <input type="radio" class="form-check-input shipping" name="shipping" value="yes" {{ (session()->get('shipping_price') == 1400) ? 'checked' : '' }} >Shipping: +{{ presentPrice(1400, true) }}
                           </label>
                       </div>
                   </form>
                </div>

                <div class="cart-totals-right">
                  <table style="width: 100%;">
                    <tbody>
                      @if (session()->has('shipping_price') && session()->get('shipping_price') > 0)
                      <tr>
                        <td align="left">Shipping</td>
                        <td>{{ presentPrice($shipping, true) }}</td>
                      </tr>
                      @endif
                      @if (session()->has('coupon'))
                      <tr>
                        <td align="left">
                          <form action="{{ route('coupon.destroy') }}" method="POST" style="display:block">
                            {{ csrf_field() }}
                            {{ method_field('delete') }}
                            <span>Discount ({{ session()->get('coupon')['name'] }})</span>
                            <button type="submit" class="remove" style="font-size:18px;"><i class="far fa-times-circle"></i></button>
                          </form>
                        </td>
                        <td>-{{ presentPrice($discount, true) }}</td>
                      </tr>
                      @endif
                      <tr>
                        <td align="left">Subtotal</td>
                        <td>{{ presentPrice($newSubtotal, true) }} <br></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
            </div> <!-- end cart-totals -->

            <div class="cart-buttons">
                <a href="{{ route('shop.index') }}" class="button">Continue Shopping</a>
                <a href="{{ route('address.index') }}" class="button button-checkout">Proceed to Checkout</a>
            </div>

            @else

                <h3>No items in Cart!</h3>
                <div class="spacer"></div>
                <a href="{{ route('shop.index') }}" class="button">Continue Shopping</a>
                <div class="spacer"></div>

            @endif

            @if (Cart::instance('saveForLater')->count() > 0)

            <h2>{{ Cart::instance('saveForLater')->count() }} item(s) Saved For Later</h2>

            <div class="saved-for-later cart-table">
                @foreach (Cart::instance('saveForLater')->content() as $item)
                <div class="cart-table-row">
                    <div class="cart-table-row-left">
                        <a href="{{ route('shop.show', $item->model->slug) }}"><img src="{{ productImage($item->model->image) }}" alt="item" class="cart-table-img"></a>
                        <div class="cart-item-details pl-2">
                            <div class="cart-table-item"><a href="{{ route('shop.show', $item->model->slug) }}">{{ $item->model->name }}</a></div>
                            <div class="cart-table-description">{{ $item->model->details }}</div>
                            <div class="spacer"></div>
                            <div class="cart-table-actions">
                              <form action="{{ route('saveForLater.switchToCart', $item->rowId) }}" method="POST">
                                  {{ csrf_field() }}

                                  <button type="submit" class="cart-options">Move to Cart <i class="fas fa-cart-plus"></i></button>
                              </form>
                            </div>
                        </div>
                    </div>
                    <div class="cart-table-row-right">
                        <div>{{ $item->model->presentPrice() }}</div>
                        <div>
                            <form action="{{ route('saveForLater.destroy', $item->rowId) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                                <button type="submit" class="remove" style="font-size:18px;"><i class="far fa-times-circle"></i></button>
                            </form>
                        </div>

                    </div>
                </div> <!-- end cart-table-row -->
                @endforeach

            </div> <!-- end saved-for-later -->

            @else

            <h3>You have no items Saved for Later.</h3>

            @endif

        </div>

    </div> <!-- end cart-section -->

    @include('partials.might-like')


    @endsection

    @section('extra-js')
    <script>
        (function(){
            const classname = document.querySelectorAll('.quantity')
            Array.from(classname).forEach(function(element) {
                element.addEventListener('change', function() {
                    const id = element.getAttribute('data-id')
                    const productQuantity = element.getAttribute('data-productQuantity')
                    axios.patch(`/cart/${id}`, {
                            quantity: this.value,
                            productQuantity: productQuantity
                        })
                    .then(function(response) {
                        window.location.href = '{{ route('cart.index') }}'
                    })
                    .catch(function(error) {
                       window.location.href = '{{ route('cart.index') }}'
                    });
                })
            })

            // Add shippinh
            var rad = document.querySelectorAll('.shipping');
            var prev = null;

            for (var i = 0; i < rad.length; i++) {
              rad[i].addEventListener('change', function(){
                if (this !== prev) {
                  prev = this;
                }
                axios.post(`/cart-shipping`, {
                        value: prev.value,
                    })
                .then(function(response) {
                    window.location.href = '{{ route('cart.index') }}'
                })
                .catch(function(error) {
                   window.location.href = '{{ route('cart.index') }}'
                });
              });
            }
        })();
    </script>
    <!-- Include AlgoliaSearch JS Client and autocomplete.js library -->
    <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
    <script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
    <script src="{{ asset('js/algolia.js') }}"></script>
    @endsection
