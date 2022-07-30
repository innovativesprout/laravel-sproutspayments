<?php namespace Innovativesprout\Sproutspayments;

use Innovativesprout\SproutsPayments\Traits\HttpRequest;

class SproutsPayments{

    use HttpRequest;

    protected string $method;
    protected string $api_url = '';
    protected string $return_model = '';

    protected const BASE_API = 'https://sproutspayments.com/api/v1';
    protected const ENDPOINT_PAYMENT = '/process-payment';
    public const SOURCE_GCASH = 'gcash';
    public const AMOUNT_TYPE_FLOAT = 'float';
    public const AMOUNT_TYPE_INT = 'int';

    public function payment(): SproutsPayments
    {
        $this->api_url = self::BASE_API.self::ENDPOINT_PAYMENT.'?app_token='.config('sproutspayments.api_token');
        return $this;
    }

}
