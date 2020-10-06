@extends('layout')

@section('title', 'Preview Order')

@section('extra-css')
    <style>
        .mt-32 {
            margin-top: 32px;
        }
    </style>


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


        <h1 class="preview-order-heading stylish-heading">Preview Your Order</h1>
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

        </div> <!-- end preview-order-section -->
    </div>


@endsection
