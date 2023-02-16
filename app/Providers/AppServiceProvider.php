<?php

namespace App\Providers;

use Braintree\Gateway;
use Illuminate\Support\ServiceProvider;

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
        $this->app->singleton(Gateway::class, function ($app) {
            return new Gateway(
                [
                    'environment' => 'sandbox',
                    'merchantId' => '2ns4kxhfxbspps9p',
                    'publicKey' => 'rxfcnr6jzvs5kcc4',
                    'privateKey' => 'f5eeeca29953621c2b0ab86427f1e6d3',
                ]
            );
        });
    }
}

// [
//     'environment' => env('BRAINTREE_ENVIRONMENT'),
//     'merchantId' => env('BRAINTREE_MERCHANT_ID'),
//     'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
//     'privateKey' => env('BRAINTREE_PRIVATE_KEY'),
// ]
