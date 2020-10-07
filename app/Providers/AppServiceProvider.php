<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Configuration;
use Braintree;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      //  Creating CONSTANTS from configuriation table
      // $configurations =	Configuration::get();
      // foreach($configurations as $configuration){
      //     define($configuration->key, $configuration->value);
      // }

      $environment = env('BT_ENVIRONMENT');
       $gateway = new \Braintree\Gateway([
         'environment' => config('services.braintree.environment'),
         'merchantId' => config('services.braintree.merchantId'),
         'publicKey' => config('services.braintree.publicKey'),
         'privateKey' => config('services.braintree.privateKey')
       ]);
       config(['braintree' => $gateway]);
    }
}
