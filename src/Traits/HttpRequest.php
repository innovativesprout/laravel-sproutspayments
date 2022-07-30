<?php namespace Innovativesprout\Sproutspayments\Traits;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

trait HttpRequest{

    protected array $data;
    protected array $payload;
    protected array $options;

    /**
     * Request a create to API.
     * @param array $payload
     * @return BaseModel
     */
    public function create(array $payload): BaseModel
    {
        $this->method = 'GET';
        $this->payload = $payload;
        $this->formRequestData();

        $this->setOptions([
            'headers' => [
                'Accept' => 'application/json',
                'Content-type' => 'application/json',
            ],
            'json' => $this->data,
        ]);

        return $this->request();
    }

    protected function request()
    {
        $client = new Client();

        try {
            $response = $client->request($this->method, $this->api_url, $this->options);

            return $this->parseToArray((string) $response->getBody());

        } catch (\Exception | GuzzleException $e) {
            $response = $e->getMessage();
            if ($e->getCode() === 400) {
                throw new BadRequestException($response, $e->getCode());
            } elseif ($e->getCode() === 401) {
                throw new UnauthorizedException($response, $e->getCode());
            } elseif ($e->getCode() === 402) {
                throw new PaymentErrorException($response, $e->getCode());
            } elseif ($e->getCode() === 404) {
                throw new NotFoundException($response, $e->getCode());
            }

            throw new Exception($response, $e->getCode());
        }
    }

    protected function formRequestData()
    {
        $this->data = $this->payload;
    }

    protected function parseToArray($json)
    {
        return json_decode($json, true);
    }

    /**
     * Set the return model with the data.
     *
     * @param  array  $array
     * @return mixed
     */
    protected function setReturnModel(array $array)
    {
        return (new $this->return_model)->setData($array['data']);
    }

    /**
     * Set the options.
     *
     * @param array $options
     * @return $this
     */
    protected function setOptions(array $options): HttpRequest
    {
        $this->options = $options;

        return $this;
    }

}
