<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;


class LogController extends Controller
{
    private $access;
    private $uri = 'http://acesso.com/api/';

    public function CriarLog($token)
    {
        $this->access = new Client([
            'base_uri' => $this->uri,
            'timeout' => 2.0,
            'exceptions' => true,
        ]);

        $response = $this->access->put('logs/criar', [
            'headers' => [
                'token' => $token,
            ],
            'json' => [
                'acao' => 'Novo login realizado',
            ],
        ]);

        $status_code = $response->getStatusCode();
        $dados = json_decode($response->getBody());

        return ['status_code'=>$status_code, 'msg'=>$dados->message];
    }
}
