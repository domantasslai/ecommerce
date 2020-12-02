<?php

namespace App\Http\Controllers;

use App\Country;

use Illuminate\Http\Request;
use App\Http\Requests\AddressRequest;
use Gloudemans\Shoppingcart\Facades\Cart;

use Auth;

class AddressController extends Controller
{
    public function index(Request $request){

      if (Cart::instance('default')->count() == 0) {
        return redirect()->route('cart.index');
      }

      if (!auth()->check() && !request()->is('guest-checkout')) {
        return redirect()->route('login');
      }
      $countries = Country::all();

      if (Auth::check()) {
        $billing_email = auth()->user()->email;
        $delivery_email = '';
      }elseif(session('userAddress')) {
        $billing_email = session('userAddress')['billing_email'];
        $delivery_email = '';
      }else {
        $billing_email = '';
        $delivery_email = '';
      }

      $billing_email = (session('userAddress')) ? session('userAddress')['billing_email'] : null;
      $billing_firstName = (session('userAddress')) ? session('userAddress')['billing_firstName'] : null;
      $billing_lastName = (session('userAddress')) ? session('userAddress')['billing_lastName'] : null;
      $billing_address = (session('userAddress')) ? session('userAddress')['billing_address'] : null;
      $billing_countryIso = (session('userAddress')) ? session('userAddress')['billing_country'] : null;
      $billing_city = (session('userAddress')) ? session('userAddress')['billing_city'] : null;
      $billing_province = (session('userAddress')) ? session('userAddress')['billing_province'] : null;
      $billing_postalcode = (session('userAddress')) ? session('userAddress')['billing_postalcode'] : null;
      $billing_phone = (session('userAddress')) ? session('userAddress')['billing_phone'] : null;

      $delivery_email = (session('userAddress')) ? session('userAddress')['delivery_email'] : null;
      $delivery_firstName = (session('userAddress')) ? session('userAddress')['delivery_firstName'] : null;
      $delivery_lastName = (session('userAddress')) ? session('userAddress')['delivery_lastName'] : null;
      $delivery_address = (session('userAddress')) ? session('userAddress')['delivery_address'] : null;
      $delivery_countryIso = (session('userAddress')) ? session('userAddress')['delivery_country'] : null;
      $delivery_city = (session('userAddress')) ? session('userAddress')['delivery_city'] : null;
      $delivery_province = (session('userAddress')) ? session('userAddress')['delivery_province'] : null;
      $delivery_postalcode = (session('userAddress')) ? session('userAddress')['delivery_postalcode'] : null;
      $delivery_phone = (session('userAddress')) ? session('userAddress')['delivery_phone'] : null;

      $paymentType = (session('userAddress')) ? session('userAddress')['paymentType'] : null;

      return view('address', compact(
        'countries', 'billing_email', 'billing_firstName', 'billing_lastName', 'billing_address',
        'billing_countryIso', 'billing_city', 'billing_province', 'billing_postalcode', 'billing_phone', 'paymentType',
        'delivery_email', 'delivery_firstName', 'delivery_lastName', 'delivery_address', 'delivery_countryIso',
        'delivery_city', 'delivery_province', 'delivery_postalcode', 'delivery_phone'));
    }

    /*
    * Store User information to session
    */
    public function store(AddressRequest $request){
        if (Cart::instance('default')->count() == 0) {
          return redirect()->route('cart.index');
        }

        session()->put('userAddress', collect([
          // Delivery data
          'billing_email' => $request->billing_email,
          'billing_firstName' => $request->billing_firstName,
          'billing_lastName' => $request->billing_lastName,
          'billing_address' => $request->billing_address,
          'billing_country' => $request->billing_country,
          'billing_city' => $request->billing_city,
          'billing_province' => $request->billing_province,
          'billing_postalcode' => $request->billing_postalcode,
          'billing_phone' => $request->billing_phone,
          'paymentType' => $request->paymentType,

          // Billing data
          'delivery_email' => $request->delivery_email,
          'delivery_firstName' => $request->delivery_firstName,
          'delivery_lastName' => $request->delivery_lastName,
          'delivery_address' => $request->delivery_address,
          'delivery_country' => $request->delivery_country,
          'delivery_city' => $request->delivery_city,
          'delivery_province' => $request->delivery_province,
          'delivery_postalcode' => $request->delivery_postalcode,
          'delivery_phone' => $request->delivery_phone
        ]));

      return redirect()->route('checkout.show');
    }
}
