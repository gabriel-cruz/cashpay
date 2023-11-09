<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class AuthorizeService
{
    public function authorizeTransaction(){
        $client = new Client();

        try {
            return $client->get('https://run.mocky.io/v3/5794d450-d2e2-4412-8131-73d0293ac1cc');

        } catch (GuzzleException $exception){
            $response['message'] = 'Não autorizado';
            $code = 401;
            return response()->json($response, $code);
        }

    }
}
