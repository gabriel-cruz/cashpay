<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class AuthorizeService
{
    public function __construct(
        public Client $client
    ){}

    public function authorizeTransaction(){
        try {
            return $this->client->get('https://run.mocky.io/v3/5794d450-d2e2-4412-8131-73d0293ac1cc');

        } catch (GuzzleException){
            return response()->json('Não autorizado', 401);
        }

    }
}
