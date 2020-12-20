<?php

namespace App\Http\Controllers;

use App\Coupon;
use App\Jobs\UpdateCoupon;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CouponsController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $coupon = Coupon::where('code', $request->coupon_code)->first();

        if (!$coupon) {
          return redirect()->route('cart.index')->withErrors('Invalid coupon code. Please try again.');
        }

        $subtotal = getNumbers()->get('newSubtotal');

        if($coupon->discount($subtotal) > $subtotal){
          return redirect()->route('cart.index')->withErrors('Shopping cart is too small. Please add more items.');
        }

        dispatch_now(new UpdateCoupon($coupon));

        return redirect()->route('cart.index')->with('success_message', 'Coupon has been applied!');
    }


    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        session()->forget('coupon');

        return redirect()->route('cart.index')->with('success_message', 'Coupon has been removed!');
    }
}
