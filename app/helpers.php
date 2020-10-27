<?php
use App\Extra\Tools;
use Carbon\Carbon;


function presentPrice($price, $curreny_sign = false){
  if ($curreny_sign) {
    return number_format($price / 100, 2) . ' €';
  }
  return number_format($price / 100, 2);
}

function setActiveCategory($category, $output = 'active'){
  return request()->category == $category ? $output : '';
}

function productImage($path)
{
  // return $path;
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

    $tax = (int)(Tools::getTaxRate($countryIso ?? null, ''));

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
        $payment_gateway_fee_rate = 3;
      }elseif ($payment_gateway_fee['paymentType'] == 'paypal') {
        $payment_gateway_fee = 5;
      }else{
        $payment_gateway_fee = 0;
      }
    }else {
      $payment_gateway_fee = 0;
    }


    $newTax = ($newSubtotal + $shipping) * ($tax / 100);
    // $newTax = ($newSubtotal + $shipping) * ($tax / 100) + $shipping;
    $newTotal = $newSubtotal + $newTax;
    // $taxAndSubtotal = $newSubtotal + $newTax;
    // $payment_gateway_total_fee = $taxAndSubtotal * ($payment_gateway_fee / 100);


    // //////

     // Choosen payment fee in procentages
     // $payment_fee = ($payment) ? $payment : 0;
     //
     // // Get total price without hardware price
     // $price_without_hardware = $this->cartSubTotalPrice()->get('total');
     //
     // $subtotal = $this->cartSubTotalPrice()->get('subtotal');
     // $subtotal_with_fees = ($this->cartSubTotalPrice()->get('subtotal') + $administration_fee + $shipping_fee);
     // if ($price_without_hardware > $discount) {
     //   $subtotal_with_fees -= $discount;
     // }
     // $tax_rate = Tools::getTaxRate($user_addresses->billing_country_code, $user_addresses->billing_company_vat_number);
     // $total_tax = $subtotal_with_fees * ($tax_rate / 100);
     //
     // $subtotal_with_tax = $subtotal_with_fees + $total_tax;
     // $payment_fee = $subtotal_with_tax * ($payment_fee / 100);
     // $total = $subtotal_with_tax + $payment_fee;


    ///////

    // dd($newTotal);
    return collect([
        'shipping' => $shipping,
        'tax' => $tax,
        'discount' => $discount,
        'code' => $code,
        'newSubtotal' => $newSubtotal,
        'newTax' => $newTax,
        'newTotal' => $newTotal,
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
