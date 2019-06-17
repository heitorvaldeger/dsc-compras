<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class FornecedorController extends Controller
{
    private $uri = "http://armazem.com/api/";
    private $client;
    private $fornecedors;

    public function Index(){
        $status_code = $this->BuscarFornecedors();

        if($status_code == 200)
            return view('componentes.fornecedor.index', ['fornecedors' => $this->fornecedors]);
        else
            return view('componentes.fornecedor.index');
    }

    public function Cadastrar(Request $request){
        $this->client = new Client([
            'base_uri' => $this->uri,
            'timeout' => 2.0,
            'exceptions' => false
        ]);

        $response = $this->client->post('fornecedors/salvar', [
            'json' => [
                'cnpj' => $request->cnpj,
                'fantasia' => $request->fantasia,
                'razao' => $request->razao
            ]
        ]);
        
        if($response->getStatusCode() == 200)
        {
            LogController::CriarLog($request->session()->get('dados')->token, "Registrou um novo fornecedor");

            return ['status_code'=>$response->getStatusCode(), 'fornecedors'=>$this->fornecedors];
        }
        else
        {
            return ['status_code'=>$response->getStatusCode()];
        }
    }

    public function Atualizar(Request $request){
        $this->client = new Client([
            'base_uri' => $this->uri,
            'timeout' => 2.0,
            'exceptions' => false
        ]);

        $response = $this->client->post('fornecedors/salvar/'.$request->id, [
            'json' => [
                'cnpj' => $request->cnpj,
                'fantasia' => $request->fantasia,
                'razao' => $request->razao
            ],
        ]);

        if($response->getStatusCode() == 200)
        {
            LogController::CriarLog($request->session()->get('dados')->token, "Atualizou um fornecedor");
            return ['status_code'=>$response->getStatusCode(), 'fornecedors'=>$this->fornecedors];
        }
        else
        {
            return ['status_code'=>$response->getStatusCode()];
        }
    }

    private function BuscarFornecedors(){
        $this->access = new Client([
            'base_uri' => $this->uri,
            'timeout' => 2.0,
            'exceptions' => false
        ]);

        $response = $this->access->get('fornecedors/listar');

        $status_code = $response->getStatusCode();

        if($status_code == 200)
        {
            $this->fornecedors = json_decode($response->getBody());
            return $status_code;
        }
        else
        {
            return $status_code;
        }
    }
}
