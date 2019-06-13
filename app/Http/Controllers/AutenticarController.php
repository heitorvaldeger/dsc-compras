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

            //Escrever o token na sessão
            $request->session()->put('token', $dados->token);
            
            $log = new LogController();
            $log_result = $log->CriarLog($dados->token);
            if($log_result['status_code'] == 200 || $log_result['status_code'] == 400)
            {
                return redirect('index')->with('msg', $log_result['msg']);
            }
        }

        if($status_code == 401)
        {
            return view('login.login', ['authfailure' => 'Usuário ou senha incorretos']);
        }
    }

    public function LogoutAction(Request $request)
    {
        $request->session()->forget('token');

        return redirect('/');
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
