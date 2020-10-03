<?php

namespace App\Http\Controllers;

use App\Country;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Auth;

class AddressController extends Controller
{
    public function index(Request $request){
      $countries = Country::all();

      if (Auth::check()) {
        $email = auth()->user()->email;
      }elseif(session('userAddress')) {
        $email = session('userAddress')['email'];
      }else {
        $email = '';
      }

      $name = (session('userAddress')) ? session('userAddress')['name'] : null;
      $address = (session('userAddress')) ? session('userAddress')['address'] : null;
      $countryIso = (session('userAddress')) ? session('userAddress')['country'] : null;
      $city = (session('userAddress')) ? session('userAddress')['city'] : null;
      $province = (session('userAddress')) ? session('userAddress')['province'] : null;
      $postalcode = (session('userAddress')) ? session('userAddress')['postalcode'] : null;
      $phone = (session('userAddress')) ? session('userAddress')['phone'] : null;

      return view('address', compact('countries', 'email', 'name', 'address', 'countryIso', 'city', 'province', 'postalcode', 'phone'));
    }

    public function store(Request $request){
      $validator = Validator::make($request->all(), [
          'email' => 'required|string',
          'name' => 'required|string',
          'address' => 'required|string',
          'country' => 'required|string',
          'city' => 'required|string',
          'province' => 'required|string',
          'postalcode' => 'required|string',
          'phone' => 'required|string'
      ]);

        // sukuriam
        session()->put('userAddress', collect([
          'email' => $request->email,
          'name' => $request->name,
          'address' => $request->address,
          'country' => $request->country,
          'city' => $request->city,
          'province' => $request->province,
          'postalcode' => $request->postalcode,
          'phone' => $request->phone
        ]));

      // return redirec()->route('checkout.index');
      return redirect()->back();

    }
}
