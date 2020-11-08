<?php
use App\Extra\Tools;
use Carbon\Carbon;


function presentPrice($price, $curreny_sign = false){
  if ($curreny_sign) {
    return number_format($price / 100, 2) . ' €';
  }
  return number_format($price / 100, 2);
}

function presentDate($date)
{
    return Carbon::parse($date)->format('M d, Y');
}

function setActiveCategory($category, $output = 'active'){
  return request()->category == $category ? $output : '';
}

function productImage($path)
{
  return $path && file_exists('storage/'.$path) ? Voyager::image($path) : asset('img/not-found.jpg');
}

function profileImage($path)
{
  return $path && file_exists('storage/'.$path) ? Voyager::image($path) : asset('img/not-found.jpg');
}

function getTaxRate($country, $vat_number){
  return Tools::getTaxRate($country, $vat_number);
}

function getNumbers()
{
    $countryIso = session()->get('userAddress')['billing_country'] ?? 'LT';

    $tax_rate = (int)(Tools::getTaxRate($countryIso ?? null, ''));

    $discount = session()->get('coupon')['discount'] ?? 0;
    $code = session()->get('coupon')['name'] ?? null;
    $shipping = session()->get('shipping_price') ?? 0;

    $newSubtotal = (Cart::subtotal() - $discount) + $shipping;


    if ($newSubtotal < 0) {
        $newSubtotal = 0;
    }

    if ($shipping < 0) {
      $shipping = 0;
    }

    $payment_gateway_fee = session()->get('userAddress');

    if ($payment_gateway_fee != null) {
      if ($payment_gateway_fee['paymentType'] == 'stripe') {
        // dd('cia');
        $payment_gateway_fee = 3;
      }elseif ($payment_gateway_fee['paymentType'] == 'paypal') {
        $payment_gateway_fee = 5;
      }else{
        $payment_gateway_fee = 0;
      }
    }else {
      $payment_gateway_fee = 0;
    }

    // Tax calculation
    $newTax = ($newSubtotal) * ($tax_rate / 100);


    $newTotal = $newSubtotal + $newTax;

    $payment_fee =  $newTotal * ($payment_gateway_fee / 100);
    $newTotal = $newTotal + $payment_fee;

  // dd($tax_rate);

    // dd($newTotal);
    return collect([
        'shipping' => $shipping,
        'tax_rate' => $tax_rate,
        'discount' => $discount,
        'code' => $code,
        'newSubtotal' => $newSubtotal,
        'newTax' => $newTax,
        'newTotal' => $newTotal,
        'payment_gateway_fee' => $payment_gateway_fee,
        'payment_fee' => $payment_fee
    ]);
}
function getStockLevel($quantity){
  if ($quantity > setting('site.stock_threshold')) {
    $stockLevel = '<div class="badge badge-success">In stock</div>';
  }elseif($quantity <= setting('site.stock_threshold') && $quantity > 0) {
    $stockLevel = '<div class="badge badge-warning">Low Stock</div>';
  } else {
    $stockLevel = '<div class="badge badge-danger">Not available</div>';
  }

  return $stockLevel;
}
