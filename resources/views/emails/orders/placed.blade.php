@component('mail::message')
# Order Received

Thank you for your order.

**Order ID:** {{ $order->id }}

**Order Email:** {{ $order->billing_email }}

**Order Name:** {{ $order->billing_name }}

@if($order->discount > 0)
**Order discount:** {{ round($order->discount / 100, 2) }} &euro;
@endif


@if($order->shipping_price > 0)
**Order shipping:** {{ round($order->shipping_price / 100, 2) }} &euro;
@endif

**Order Tax ({{ $order->tax_rate }}%):** {{ round($order->tax / 100, 2) }} &euro;

**Order Total:** {{ round($order->billing_total / 100, 2) }} &euro;

**Items Ordered**

@foreach ($order->products as $product)
Name: {{ $product->name }} <br>
Price: ${{ round($product->price / 100, 2)}} <br>
Quantity: {{ $product->pivot->quantity }} <br>
@endforeach

You can get further details about your order by logging into our website.

@component('mail::button', ['url' => config('app.url'), 'color' => 'green'])
Go to Website
@endcomponent

Thank you again for choosing us.

Regards,<br>
{{ config('app.name') }}
@endcomponent
