<?php
// app/Services/FedExService.php

namespace App\Services;

use GuzzleHttp\Client;

class FedExService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function calculateShipping($data)
    {
        $payload = [
        ];

        $headers = [
            'Authorization' => 'Bearer ' . env('FEDEX_API_KEY'),
            'Content-Type' => 'application/json',
        ];

        $response = $this->client->post(env('FEDEX_API_URL') . '/rate/v1/rates', [
            'headers' => $headers,
            'json' => $payload,
        ]);
        
        $responseData = json_decode($response->getBody()->getContents(), true);

        return $shippingCharges;
    }
}
