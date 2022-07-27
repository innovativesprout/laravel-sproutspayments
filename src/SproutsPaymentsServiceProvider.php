<?php

namespace Innovativesprout\Sproutspayments;

use Illuminate\Support\ServiceProvider;

class SproutsPaymentsServiceProvider extends ServiceProvider{

    public function register()
    {
        $this->app->bind('sprouts-payments', function($app){
            return new SproutsPayments();
        });
    }

    public function boot()
    {

    }

}