<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;


class LogController extends Controller
{
    private $uri;

    public function __construct()
    {   
        $this->uri = RouteBaseUriController::UriBaseAcesso();
    }

    public static function CriarLog($token, $acao)
    {
        $access = new Client([
            'base_uri' => RouteBaseUriController::UriBaseAcesso(),
            'timeout' => 2.0,
            'exceptions' => true,
        ]);

        $response = $access->put('logs/criar', [
            'headers' => [
                'token' => $token,
            ],
            'json' => [
                'acao' => $acao,
            ],
        ]);

        $status_code = $response->getStatusCode();
        $dados = json_decode($response->getBody());

        return ['status_code'=>$status_code, 'msg'=>$dados->message];
    }
}
