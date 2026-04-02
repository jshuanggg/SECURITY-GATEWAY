<?php

namespace App\Services;

use GuzzleHttp\Client;

class Service
{
    public function performRequest($method, $requestUrl, $formParams = [])
    {
        $client = new Client();

        $response = $client->request($method, $requestUrl, [
            'form_params' => $formParams
        ]);

        return $response->getBody()->getContents();
    }
}