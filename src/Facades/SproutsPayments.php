<?php
namespace Innovativesprout\Sproutspayments\Facades;

use Illuminate\Support\Facades\Facade;

class SproutsPayments extends Facade {

    public static function getFacadeAccessor(): string
    {
        return 'sprouts-payments';
    }

}