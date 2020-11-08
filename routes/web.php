<?php

use Illuminate\Support\Facades\Mail;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'LandingPageController@index')->name('landing-page');
Auth::routes(['verify' => true]);


// SHOP
Route::get('/shop', 'ShopController@index')->name('shop.index');
Route::get('/shop/{product}', 'ShopController@show')->name('shop.show');
// END SHOP

// CART
Route::get('/cart', 'CartController@index')->name('cart.index');
Route::post('/cart', 'CartController@store')->name('cart.store');
Route::patch('/cart/{product}', 'CartController@update')->name('cart.update');
Route::delete('/cart/{product}', 'CartController@destroy')->name('cart.destroy');
Route::post('/cart/switchToSaveForLater/{product}', 'CartController@switchToSaveForLater')->name('cart.switchToSaveForLater');
Route::post('/cart-shipping', 'CartController@cartShipping')->name('cart.shipping');
// END CART

// SAVE FOR LATER
Route::delete('/saveForLater/{product}', 'SaveForLaterController@destroy')->name('saveForLater.destroy');
Route::post('/saveForLater/switchToCart/{product}', 'SaveForLaterController@switchToCart')->name('saveForLater.switchToCart');
// END SAVE FOR LATER

// COUPOONS
Route::post('/coupon', 'CouponsController@store')->name('coupon.store');
Route::delete('/coupon', 'CouponsController@destroy')->name('coupon.destroy');
// END COUPONS

// ADDRESS
Route::get('/address_info', 'AddressController@index')->name('address.index');
Route::post('/address_info', 'AddressController@store')->name('address.store');
// END ADDRESS


// CHECKOUT
Route::get('/checkout', 'CheckoutController@index')->name('checkout.index')->middleware(['auth', 'verified']);
Route::get('/order-preview', 'CheckoutController@show')->name('checkout.show');
Route::post('/checkout', 'CheckoutController@store')->name('checkout.store');
Route::post('/paypal-checkout', 'CheckoutController@paypalCheckout')->name('checkout.paypal');

Route::get('/guest-checkout', 'AddressController@index')->name('guestCheckout.index');

Route::get('/thankyou', 'ConfirmationController@index')->name('confirmation.index');
// END CHECKOUT

Auth::routes();

Route::group(['prefix' => 'admin'], function () {
  Voyager::routes();
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/search', 'ShopController@search')->name('search');
Route::get('/search-algolia', 'ShopController@searchAlgolia')->name('search-algolia');

// COMMENTS
Route::post('comments', 'CommentController@store')->name('comments.store');
// END COMMENTS

// BLOG
Route::get('/blog', 'BlogController@index')->name('blog.index');
Route::get('/blog/{post}', 'BlogController@show')->name('blog.show');
// END BLOG

// MY PROFILE
Route::middleware('auth')->group(function () {
    Route::get('/my-profile', 'UsersController@edit')->name('users.edit');
    Route::patch('/my-profile', 'UsersController@update')->name('users.update');

    Route::get('/my-orders', 'OrdersController@index')->name('orders.index');
    Route::get('/my-orders/{order}', 'OrdersController@show')->name('orders.show');
});
// END MY PROFILE
