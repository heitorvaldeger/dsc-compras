<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class UnidadeController extends Controller
{
    private $uri = "http://armazem.com/api/";
    private $access;
    private $unidades;

    public function Cadastrar(Request $request)
    {
        $this->access = new Client([
            'base_uri' => $this->uri,
            'timeout' => 2.0,
            'exceptions' => false
        ]);

        $response = $this->access->post('unidades/salvar', [
            'json' => [
                'descricao' => $request->unidadesname,
                'grama' => $request->grama,
            ],
        ]);
        
        if($response->getStatusCode() == 200)
        {
            LogController::CriarLog($request->session()->get('dados')->token, "Cadastrou uma nova unidade");
            return ['status_code'=>$response->getStatusCode(), 'unidades'=>$this->unidades];
        }
        else
        {
            return ['status_code'=>$response->getStatusCode()];
        }
    }

    public function IndexUnidades()
    {
        $status_code = $this->BuscarUnidades();

        if($status_code == 200)
            return view('componentes.unidade.indexunidade', ['unidades' => $this->unidades]);
        else
            return view('componentes.unidade.indexunidade');
    }

    private function BuscarUnidades()
    {
        $this->access = new Client([
            'base_uri' => $this->uri,
            'timeout' => 2.0,
            'exceptions' => false
        ]);

        $response = $this->access->get('unidades/listar');

        $status_code = $response->getStatusCode();

        if($status_code == 200)
        {
            $this->unidades = json_decode($response->getBody());
            return $status_code;
        }
        else
        {
            return $status_code;
        }
    }

    public function Atualizar(Request $request)
    {
        $this->access = new Client([
            'base_uri' => $this->uri,
            'timeout' => 2.0,
            'exceptions' => false
        ]);

        $response = $this->access->post('unidades/salvar/'.$request->idunidade, [
            'json' => [
                'descricao' => $request->unidadesname,
                'grama' => $request->grama,
            ],
        ]);

        if($response->getStatusCode() == 200)
        {
            LogController::CriarLog($request->session()->get('dados')->token, "Atualizou uma unidade");
            return ['status_code'=>$response->getStatusCode(), 'unidades'=>$this->unidades];
        }
        else
        {
            return ['status_code'=>$response->getStatusCode()];
        }
    }
}
