<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use App\OrderProduct;
use App\Mail\OrderPlaced;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\CheckoutRequest;
use Gloudemans\Shoppingcart\Facades\Cart;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Cartalyst\Stripe\Exception\CardErrorException;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Cart::instance('default')->count() == 0) {
          return redirect()->route('shop.index');
        }

        if(session('userAddress') == null){
          return redirect()->route('address.index')->withErrors('Please fill up address information');
        }

        if (auth()->user() && request()->is('guest-checkout')) {
          return redirect()->route('checkout.index');
        }

        $tax = getNumbers()->get('tax_rate');
        $discount = getNumbers()->get('discount');
        $newSubtotal = getNumbers()->get('newSubtotal');
        $newTax = getNumbers()->get('newTax');

        $newTotal = getNumbers()->get('newTotal');

        return view('checkout', compact('discount', 'newSubtotal', 'newTax', 'newTotal', 'payment_gateway_fee'));
    }

    /*
      * Show formated Order
    */
    public function show()
    {
      if (Cart::instance('default')->count() == 0) {
        return redirect()->route('shop.index');
      }
      // dd(Cart::content());

      if(session('userAddress') == null){
        return redirect()->route('address.index')->withErrors('Please fill up address information');
      }

      if (auth()->user() && request()->is('guest-checkout')) {
        return redirect()->route('checkout.index');
      }

      $shipping = getNumbers()->get('shipping');
      $tax = getNumbers()->get('tax_rate');
      $discount = getNumbers()->get('discount');
      $newSubtotal = getNumbers()->get('newSubtotal');
      $newTax = getNumbers()->get('newTax');
      $payment_gateway_fee = getNumbers()->get('payment_gateway_fee');
      $payment_fee = getNumbers()->get('payment_fee');
      $newTotal = getNumbers()->get('newTotal');

      try {
          $gateway = config('braintree');
          $paypalToken = $gateway->ClientToken()->generate();
      } catch (\Exception $e) {
          $paypalToken = null;
      }

      return view('checkout.show', compact('discount', 'newSubtotal', 'newTax', 'newTotal',
      'shipping', 'tax', 'paypalToken', 'payment_gateway_fee', 'payment_fee'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(session('userAddress') == null){
          return redirect()->route('address.index')->withErrors('Please fill up address information');
        }

        // Check race condition when there are less items available to purchase
        if ($this->productsAreNoLongerAvailable()) {
            return back()->withErrors('Sorry! One of the items in your cart is no longer available.');
        }

        $contents = Cart::content()->map(function($item){
          return $item->model->slug.', '.$item->qty;
        })->values()->toJson();

        try{
          $charge = Stripe::charges()->create([
               'amount' => presentPrice(getNumbers()->get('newTotal')),
               'currency' => 'EUR',
               'source' => $request->stripeToken,
               'description' => 'Order',
               'receipt_email' => $request->email,
               'metadata' => [
                   'contents' => $contents,
                   'quantity' => Cart::instance('default')->count(),
                   'discount' => collect(session()->get('coupon'))->toJson()
               ],
          ]);

          // dd($charge);
           // SUCCESSFUL
          $order = $this->addToOrdersTables(session('userAddress'), null);
          Mail::send(new OrderPlaced($order));
          // dd('cia');
          // decrease the quantities of all the products in the cart
          $this->decreaseQuantities();
          Cart::instance('default')->destroy();
          // dd('cia');
          session()->forget('coupon');
          session()->forget('userAddress');

          return redirect(route('confirmation.index'))->with('success_message', 'Thank you! Your payment has been successfully accepted!');
        }catch(CardErrorException $e){
          $this->addToOrdersTables($request, $e->getMessage());
          return back()->withErrors('Error! ' . $e->getMessage());
        }
    }

    public function paypalCheckout(Request $request)
    {
        if(session('userAddress') == null){
          return redirect()->route('address.index')->withErrors('Please fill up address information');
        }

        // Check race condition when there are less items available to purchase
        if ($this->productsAreNoLongerAvailable()) {
            return back()->withErrors('Sorry! One of the items in your cart is no longer avialble.');
        }

        $gateway = new \Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);

        $nonce = $request->payment_method_nonce;

        $result = $gateway->transaction()->sale([
            'amount' => round(getNumbers()->get('newTotal') / 100, 2),
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        $transaction = $result->transaction;

        if ($result->success) {
            $order = $this->addToOrdersTablesPaypal(
                session('userAddress'),
                $transaction->paypal['payerEmail'],
                $transaction->paypal['payerFirstName'].' '.$transaction->paypal['payerLastName'],
                null
            );

            Mail::send(new OrderPlaced($order));

            // decrease the quantities of all the products in the cart
            $this->decreaseQuantities();

            Cart::instance('default')->destroy();
            session()->forget('coupon');
            session()->forget('userAddress');

            return redirect()->route('confirmation.index')->with('success_message', 'Thank you! Your payment has been successfully accepted!');
        } else {
            $order = $this->addToOrdersTablesPaypal(
                $transaction->paypal['payerEmail'],
                $transaction->paypal['payerFirstName'].' '.$transaction->paypal['payerLastName'],
                $result->message
            );

            return back()->withErrors('An error occurred with the message: '.$result->message);
        }
    }

    protected function addToOrdersTables($session, $error)
    {
        // Insert into orders table
        $order = Order::create([
            'user_id' => auth()->user() ? auth()->user()->id : null,
            // Billing address
            'billing_email' => $session['billing_email'],
            'billing_firstName' => $session['billing_firstName'],
            'billing_lastName' => $session['billing_lastName'],
            'billing_address' => $session['billing_address'],
            'billing_country' => $session['billing_country'],
            'billing_city' => $session['billing_city'],
            'billing_province' => $session['billing_province'],
            'billing_postalcode' => $session['billing_postalcode'],
            'billing_phone' => $session['billing_phone'],
            // Delivery address
            'delivery_email' => $session['delivery_email'],
            'delivery_firstName' => $session['delivery_firstName'],
            'delivery_lastName' => $session['delivery_lastName'],
            'delivery_country' => $session['delivery_country'],
            'delivery_address' => $session['delivery_address'],
            'delivery_city' => $session['delivery_city'],
            'delivery_province' => $session['delivery_province'],
            'delivery_postalcode' => $session['delivery_postalcode'],
            'delivery_phone' => $session['delivery_phone'],
            'discount' => getNumbers()->get('discount'),
            'discount_code' => getNumbers()->get('code'),
            'subtotal' => getNumbers()->get('newSubtotal'),
            'tax' => getNumbers()->get('newTax'),
            'total' => getNumbers()->get('newTotal'),
            'error' => $error,
            'tax_rate' => getNumbers()->get('tax_rate'),
            'payment_gateway_fee' => getNumbers()->get('payment_gateway_fee'),
            'payment_fee' => getNumbers()->get('payment_fee'),
            'shipping_price' => getNumbers()->get('shipping'),
            'shipped' => 0
        ]);

        // Insert into order_product table
        foreach (Cart::content() as $item) {
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $item->model->id,
                'quantity' => $item->qty,
                'unit_price' => $item->price
            ]);
        }

        return $order;
    }

    protected function addToOrdersTablesPaypal($session, $email, $name, $error)
    {
        // Insert into orders table
        $order = Order::create([
            'user_id' => auth()->user() ? auth()->user()->id : null,
            'billing_email' => $email,
            'billing_firstName' => $name,
            'billing_lastName' => $session['billing_lastName'],
            'billing_address' => $session['billing_address'],
            'billing_country' => $session['billing_country'],
            'billing_city' => $session['billing_city'],
            'billing_province' => $session['billing_province'],
            'billing_postalcode' => $session['billing_postalcode'],
            'billing_phone' => $session['billing_phone'],
            // Delivery address
            'delivery_email' => $session['delivery_email'],
            'delivery_firstName' => $session['delivery_firstName'],
            'delivery_lastName' => $session['delivery_lastName'],
            'delivery_country' => $session['delivery_country'],
            'delivery_address' => $session['delivery_address'],
            'delivery_city' => $session['delivery_city'],
            'delivery_province' => $session['delivery_province'],
            'delivery_postalcode' => $session['delivery_postalcode'],
            'discount' => getNumbers()->get('discount'),
            'discount_code' => getNumbers()->get('code'),
            'subtotal' => getNumbers()->get('newSubtotal'),
            'tax' => getNumbers()->get('newTax'),
            'total' => getNumbers()->get('newTotal'),
            'error' => $error,
            'payment_gateway' => 'paypal',
            'tax_rate' => getNumbers()->get('tax_rate'),
            'payment_gateway_fee' => getNumbers()->get('payment_gateway_fee'),
            'payment_fee' => getNumbers()->get('payment_fee'),
            'shipping_price' => getNumbers()->get('shipping'),
            'shipped' => 0
        ]);

        // Insert into order_product table
        foreach (Cart::content() as $item) {
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $item->model->id,
                'quantity' => $item->qty,
                'unit_price' => $item->price
            ]);
        }

        return $order;
    }

    public function decreaseQuantities()
    {
      foreach (Cart::content() as $item) {
          $product = Product::find($item->model->id);
          
          $product->update(['quantity' => $product->quantity - $item->qty]);
          // dd('cia');
      }
    }

    protected function productsAreNoLongerAvailable()
    {
      foreach (Cart::content() as $item) {
          $product = Product::find($item->model->id);
          if ($product->quantity < $item->qty) {
            return true;
          }
      }
      return false;
    }
}
