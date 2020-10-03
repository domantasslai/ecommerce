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
    $countryIso = session()->get('userAddress')['country'] ?? 'LT';

    $tax = (int)(Tools::getTaxRate(session()->get('userAddress')['country'] ?? null, ''));

    $discount = session()->get('coupon')['discount'] ?? 0;
    $code = session()->get('coupon')['name'] ?? null;
    $shipping = session()->get('shipping_price') ?? 0;
    $newSubtotal = (Cart::subtotal() - $discount);
    if ($newSubtotal < 0) {
        $newSubtotal = 0;
    }

    if ($shipping < 0) {
      $shipping = 0;
    }

    // $newSubtotal = $newSubtotal + $shipping;
    $newTax = ($newSubtotal + $shipping) * ($tax / 100);
    $newTotal = ($newSubtotal + $shipping) + $newTax;

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
