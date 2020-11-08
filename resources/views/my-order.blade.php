@extends('layout')

@section('title', 'My Order')

@section('extra-css')
    <link rel="stylesheet" href="{{ asset('css/algolia.css') }}">
    <style media="screen">
      .order-products table>tbody>tr{
        height: 35px;
      }
    </style>
@endsection

@section('content')

    @component('components.breadcrumbs')
        <a href="/">Home</a>
        <i class="fa fa-chevron-right breadcrumb-separator"></i>
        <span>My Order</span>
    @endcomponent

    <div class="container">
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
    </div>

    <div class="products-section my-orders container">
        <div class="sidebar">

            <ul>
              <li><a href="{{ route('users.edit') }}">My Profile</a></li>
              <li class="active"><a href="{{ route('orders.index') }}">My Orders</a></li>
            </ul>
        </div> <!-- end sidebar -->
        <div class="my-profile">
            <div class="products-header">
                <h1 class="stylish-heading">Order ID: {{ $order->id }}</h1>
            </div>

            <div>
                <div class="order-container">
                    <div class="order-header">
                        <div class="order-header-items">
                            <div>
                                <div class="uppercase font-bold">Order Placed</div>
                                <div>{{ presentDate($order->created_at) }}</div>
                            </div>
                            <div>
                                <div class="uppercase font-bold">Order ID</div>
                                <div>{{ $order->id }}</div>
                            </div><div>
                                <div class="uppercase font-bold">Total</div>
                                <div>{{ presentPrice($order->total, true) }}</div>
                            </div>
                        </div>
                        <div>
                            <div class="order-header-items">
                                <div><a href="#">Invoice</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="order-products">
                        <table class="" style="width:50%">
                            <tbody>
                                <tr>
                                    <td>Name</td>
                                    <td>{{ $order->user->name }}</td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td>{{ $order->billing_address }}</td>
                                </tr>
                                <tr>
                                    <td>City</td>
                                    <td>{{ $order->billing_city }}</td>
                                </tr>
                                <tr>
                                    <td>Country</td>
                                    <td>{{ getCountryName($order->billing_country) }}</td>
                                </tr>
                                <tr>
                                  <td></td>
                                </tr>
                                @if ($order->shipping_price > 0)
                                  <tr>
                                    <td>Shipping price</td>
                                    <td>{{ presentPrice($order->shipping_price, true) }}</td>
                                  </tr>
                                @endif
                                @if ($order->discount > 0)
                                  <tr>
                                    <td>Discount</td>
                                    <td>{{ presentPrice($order->discount, true) }}</td>
                                  </tr>
                                @endif
                                <tr>
                                    <td>Subtotal</td>
                                    <td>{{ presentPrice($order->subtotal, true) }}</td>
                                </tr>
                                <tr>
                                    <td>Tax
                                    @if ($order->tax_rate > 0)
                                      ({{ $order->tax_rate }}%)
                                    @endif
                                    </td>
                                    <td>{{ presentPrice($order->tax, true) }}</td>
                                </tr>
                                <tr>
                                  <td>Payment fee ({{ $order->payment_gateway_fee }}%)</td>
                                  <td>{{ presentPrice($order->payment_fee, true) }}</td>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td>{{ presentPrice($order->total, true) }}</td>
                                </tr>
                              </tbody>
                        </table>
                    </div>
                </div> <!-- end order-container -->

                <div class="order-container">
                    <div class="order-header">
                        <div class="order-header-items">
                            <div>
                                Order Items
                            </div>

                        </div>
                    </div>
                    <div class="order-products">
                        @foreach ($products as $product)
                            <div class="order-product-item">
                                <div><img src="{{ productImage($product->image) }}" alt="Product Image"></div>
                                <div>
                                    <div>
                                        <a href="{{ route('shop.show', $product->slug) }}">{{ $product->name }}</a>
                                    </div>
                                    <div>{{ presentPrice($product->price, true) }}</div>
                                    <div>Quantity: {{ $product->pivot->quantity }}</div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div> <!-- end order-container -->
            </div>

            <div class="spacer"></div>
        </div>
    </div>

@endsection

@section('extra-js')
    <!-- Include AlgoliaSearch JS Client and autocomplete.js library -->
    <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
    <script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
    <script src="{{ asset('js/algolia.js') }}"></script>
@endsection
