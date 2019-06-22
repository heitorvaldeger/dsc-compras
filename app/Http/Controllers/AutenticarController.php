<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;


class AutenticarController extends Controller
{
    private $uri = 'http://acesso.com/api/';
    private $access;
    
    public function AutenticarAction(Request $request)
    {

        $login = $request->login;
        $password = $request->password;

        $this->access = new Client([
            'base_uri' => $this->uri,
            'timeout' => 2.0,
            'exceptions' => false
        ]);
        
        $response = $this->access->post('usuarios/autenticar', [
            'json' => [
                'login' => $login,
                'senha' => $password
            ],
        ]);

        $status_code = $response->getStatusCode();

        if($status_code == 200)
        {
            $dados = json_decode($response->getBody());

            if($dados->usuario->tipo_acesso[0] != "1")
                return redirect('/')->with('authfailure', 'Você não tem permissão para acessar esse módulo');

            //Escrever o token na sessão
            $request->session()->put('dados', $dados);
            
            $log_result = LogController::CriarLog($dados->token, "Novo login realizado");

            // if($log_result['status_code'] == 200 || $log_result['status_code'] == 400)
            return redirect('index')->with('msg', $log_result['msg']);
        }

        if($status_code != 200)
        {
            return redirect('/')->with('authfailure', 'Usuário ou senha incorretos');
        }
    }

    public function LogoutAction(Request $request)
    {
        LogController::CriarLog($request->session()->get('dados')->token, "Novo logout realizado");
        $request->session()->forget('dados');

        return redirect('/');
    }

    private static function ChecarTipoAcesso($tipoAcesso)
    {
        if($tipoAcesso[0] == "1")
        {
            return true;
        }
        return false;
    }

    public function ValidarToken($token)
    {
        $access = new Client([
            'base_uri' => $this->uri,
            'timeout' => 2.0,
            'exceptions' => false
        ]);

        $response = $access->get('usuarios/verificar', [
            'json' => [
                'token' => $token
            ],
        ]);

        $status_code = $response->getStatusCode();
        $result = json_decode($response->getBody());

        if($status_code == 200)
        {
            if($result->is_valido)
                return true;
            else
                return false;
        }
        if($status_code == 400)
            return $result->message;
        
        if($status_code == 401)
            return $result->message;
    }
}
