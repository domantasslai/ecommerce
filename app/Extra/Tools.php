<?php

namespace App\Extra;

use App\Country;

use SoapClient;
use SoapFault;

use DB;
class Tools
{

  public static function getTaxRate($country, $vat_number){

    if ($country == null) {
      // $country  = 'LT';
      return ;
    }
    $vat_number = preg_replace('/[^0-9]/', '', $vat_number);

    // Your customer is based in the same country as you: charge your local VAT tariff.
    if('LT' == $country){
       $tax_rate = 21;
    }else{
       $country_info = DB::table('countries')->where('iso', '=', $country)->first();
       // Your customer is based outside of the EU: don’t charge VAT.
       if($country_info->eu_country != 1){
           $tax_rate = 0;
       }else{
           if($vat_number != '' && Tools::validateVATNumber($country, $vat_number)){
               // Your customer is based in another EU country than you and has a valid VAT number: don’t charge VAT.
               $tax_rate = 0;
           }else{
               // Your customer is based in another EU country than you, but is a private person or company without a valid VAT number: charge your local VAT tariff.
               if ($country_info->valida_vat_number == NULL) {
                 $tax_rate = 21;
               }else {
                 // Pakeisti į to šalies VAT numeri
                 $tax_rate = $country_info->valida_vat_number;
               }

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
