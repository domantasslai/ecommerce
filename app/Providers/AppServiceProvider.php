<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Configuration;

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
    }
}
