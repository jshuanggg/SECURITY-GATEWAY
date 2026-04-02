<?php

namespace App\Traits;

// Include the Guzzle Component Library
use GuzzleHttp\Client;

trait ConsumesExternalService
{
    /**
     * Send a request to any service
     * @return string
     */
    public function performRequest($method, $requestUrl, $form_params = [], $headers = [])
    {
        // Create a new client request using the baseUri defined in the Service class
        $client = new Client([
            'base_uri' => $this->baseUri,
        ]);

        // If a secret exists in the Service class, add it to the headers [cite: 126]
        if (isset($this->secret)) {
            $headers['Authorization'] = $this->secret;
        }

        // Perform the request
        $response = $client->request($method, $requestUrl, [
            'form_params' => $form_params, 
            'headers' => $headers
        ]);

        // Return the response body contents [cite: 63]
        return $response->getBody()->getContents();
    }
}