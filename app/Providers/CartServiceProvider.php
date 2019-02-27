<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
		$this->app->bind('CartService', function()
        {
            return new \App\Providers\CartServiceProvider;
        });
    }
}
