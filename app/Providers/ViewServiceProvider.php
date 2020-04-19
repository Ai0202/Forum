<?php

namespace App\Providers;

use App\Channel;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // \View::share('channels', Channel::all());
        view()->composer('*', function ($view) {
            $view->with('channels', Channel::all());
        });
    }
}
