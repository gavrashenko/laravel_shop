<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        app('view')->composer('partials.breadcrumbs', function ($view) {
//
//            $view->with([
//                'test' => 'ВОДА'
//            ]);
//        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
//        $this->app->bind('Breadcrumbs', function ($app) {
//            return new Breadcrumbs();
//        });
    }
}
