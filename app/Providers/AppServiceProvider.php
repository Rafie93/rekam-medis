<?php

namespace App\Providers;

use App\Models\Rekam;
use App\Observers\ItemObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

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
        // Paginator::useBootstrapThree();
        date_default_timezone_set('Asia/Singapore');

    }
}
