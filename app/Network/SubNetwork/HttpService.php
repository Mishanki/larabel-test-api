<?php

namespace App\Network\SubNetwork;

use GuzzleHttp\Client;

class HttpService implements HttpServiceInterface
{
    /* @var $client Client */
    public $client;

    public function __construct()
    {
        $this->client = new Client([
            'headers' => ['Content-Type' => 'text/plain']
        ]);
    }
}
