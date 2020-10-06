<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'billing_email' => 'required|string',
          'billing_firstName' => 'required|string',
          'billing_lastName' => 'required|string',
          'billing_address' => 'required|string',
          'billing_country' => 'required|string',
          'billing_city' => 'required|string',
          'billing_province' => 'required|string',
          'billing_postalcode' => 'required|string',
          'billing_phone' => 'required|string',
          'paymentType' => 'required|in:paypal,stripe',
          'address_different' => 'sometimes',
          'delivery_email' => 'required_with:address_different,on',
          'delivery_firstName' => 'required_with:address_different,on',
          'delivery_lastName' => 'required_with:address_different,on',
          'delivery_address' => 'required_with:address_different,on',
          'delivery_country' => 'required_with:address_different,on',
          'delivery_city' => 'required_with:address_different,on',
          'delivery_province' => 'required_with:address_different,on',
          'delivery_postalcode' => 'required_with:address_different,on',
          'delivery_phone' => 'required_with:address_different,on',
        ];
    }
}
