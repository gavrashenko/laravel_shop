<?php

namespace App\Providers;

use App\Services\MailService;
use App\Storage\Catalogue;
use App\Storage\Image;
use App\Storage\Item;
use App\Storage\Order;
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
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('storage.item', function () {
            return new Item();
        });
        $this->app->bind('storage.catalogue', function () {
            return new Catalogue();
        });
        $this->app->bind('storage.order', function () {
            return new Order();
        });
        $this->app->bind('storage.image', function () {
            return new Image();
        });
        $this->app->bind('mail.service', function () {
            return new MailService();
        });
    }
}
