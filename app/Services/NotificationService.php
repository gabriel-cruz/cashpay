<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class NotificationService
{
    public function notifyUser(){
        $client = new Client();

        try {
            $client->get('https://run.mocky.io/v3/54dc2cf1-3add-45b5-b5a9-6bf7e7f1f4a6');
            return response()->json('Usuário notificado');
        } catch (GuzzleException){
            return response()->json('Serviço indisponível', 500);
        }

    }
}
