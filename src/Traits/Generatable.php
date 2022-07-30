<?php namespace Innovativesprout\Sproutspayments\Traits;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

trait Generatable{

    protected array $data;
    protected array $payload;
    protected array $options;

    /**
     * Request a create to API.
     * @param array $payload
     * @return string
     */
    public function generateLink(array $payload): string
    {
        $link = $this->api_url;
        $counter = 0;
        foreach ($payload as $index => $value) {
            if ($counter == 0){
                $link .= '&';
            }
            $link .= $index.'='.$value;
            $counter += 1;

            if (count($payload) > $counter){
                $link .= '&';
            }
        }

        return urlencode($link);
    }
}
