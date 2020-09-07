<?php

namespace App\Extra;

use Illuminate\Database\Eloquent\Model;
use SoapClient;
use SoapFault;
use App\Country;

class Tools extends Model
{

  public static function getTaxRate($country, $vat_number){

    $vat_number = preg_replace('/[^0-9]/', '', $vat_number);
    // Your customer is based in the same country as you: charge your local VAT tariff.
    if(LOCAL_COUNTRY_ISO == $country){
       $tax_rate = LOCAL_VAT_VALUE;
    }else{
       $country_info = Country::where('iso', '=', $country)->first();
       //Your customer is based outside of the EU: don’t charge VAT.
       if($country_info->eu_country != 1){
           $tax_rate = 0;
       }else{
           if($vat_number != '' && Tools::validateVATNumber($country, $vat_number)){
               //Your customer is based in another EU country than you and has a valid VAT number: don’t charge VAT.
               $tax_rate = 0;
           }else{
               //Your customer is based in another EU country than you, but is a private person or company without a valid VAT number: charge your local VAT tariff.
               $tax_rate = LOCAL_VAT_VALUE;
           }
       }
    }

    return $tax_rate;
  }


    public static function validateVATNumber($country, $vat_number){
      $wsdl = "http://ec.europa.eu/taxation_customs/vies/checkVatService.wsdl";
      $soap = new SoapClient($wsdl, array('trace' => true) );
      $rs = $soap->checkVat( array('countryCode' => $country, 'vatNumber' => $vat_number) );

      return $rs->valid;
    }
}
