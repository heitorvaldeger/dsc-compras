<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class InsumoController extends Controller
{
    private $uri = "http://armazem.com/api/";
    private $client;
    private $insumos;
    private $fornecedors;
    private $unidades;

    public function Index(){
        $status_code = $this->BuscarInsumos();
        if(($this->BuscarInsumos() == 200) and 
        ($this->BuscarFornecedores() == 200) and 
        ($this->BuscarUnidades() == 200))
            return view('componentes.insumos.index', [
                'insumos' => $this->insumos, 
                'fornecedors' => $this->fornecedors,
                'unidades' => $this->unidades
            ]);
        else
            return view('componentes.insumos.index');
    }

    private function BuscarInsumos(){
        $this->client = new Client([
            'base_uri' => $this->uri,
            'timeout' => 2.0,
            'exceptions' => false
        ]);

        $response = $this->client->get('insumos/listar');

        if($response->getStatusCode() == 200)
        {
            $this->insumos = json_decode($response->getBody());
            return 200;
        }
        else
        {
            return $response->getStatusCode();
        }
    }
    private function BuscarFornecedores(){
        $this->client = new CLient([
            'base_uri' => $this->uri,
            'timeout' => 2.0,
            'exceptions' => false
        ]);

        $response = $this->client->get('fornecedors/listar');

        if($response->getStatusCode() == 200)
        {
            $this->fornecedors = json_decode($response->getBody());
            return 200;
        }
        else
        {
            return $response->getStatusCode();
        }
    }
    private function BuscarUnidades(){
        $this->client = new CLient([
            'base_uri' => $this->uri,
            'timeout' => 2.0,
            'exceptions' => false
        ]);

        $response = $this->client->get('unidades/listar');

        if($response->getStatusCode() == 200)
        {
            $this->unidades = json_decode($response->getBody());
            return 200;
        }
        else
        {
            return $response->getStatusCode();
        }
    }

    public function Cadastrar(Request $request){
        $this->client = new Client([
            'base_uri' => $this->uri,
            'timeout' => 2.0,
            'exceptions' => false
        ]);

        $response = $this->client->post('insumos/salvar', [
            'json' => [
                'descricao' => $request->descricao,
                'materia_prima' => $request->materia_prima,
                'estoque' => $request->estoque,
                'fornecedors_id' => $request->get('idfornecedor'),
                'unidade_id' => $request->get('idunidade')
            ]
        ]);
        
        if($response->getStatusCode() == 200)
        {
            LogController::CriarLog($request->session()->get('dados')->token, "Registrou um novo insumo");
            return ['status_code' => $response->getStatusCode(), 'insumos' => $this->insumos];
        }
        else
        {
            return ['status_code' => $response->getStatusCode()];
        }
    }
    public function Atualizar(Request $request){
        $this->client = new Client([
            'base_uri' => $this->uri,
            'timeout' => 2.0,
            'exceptions' => false
        ]);

        $response = $this->client->post('insumos/salvar/'.$request->get('idinsumo'), [
            'json' => [
                'descricao' => $request->descricao,
                'materia_prima' => $request->materia_prima,
                'estoque' => $request->estoque,
                'fornecedors_id' => $request->get('idfornecedor'),
                'unidade_id' => $request->get('idunidade')
            ],
        ]);

        if($response->getStatusCode() == 200)
        {
            LogController::CriarLog($request->session()->get('dados')->token, "Atualizou um insumo");
            return ['status_code' => $response->getStatusCode(), 'insumos' => $this->insumos];
        }
        else
        {
            return ['status_code' => $response->getStatusCode()];
        }
    }
}
