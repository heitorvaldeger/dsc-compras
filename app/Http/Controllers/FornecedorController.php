<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class FornecedorController extends Controller
{
    private $uri;
    private $client;
    private $fornecedors;

    public function __construct()
    {   
        $this->uri = RouteBaseUriController::UriBaseArmazem();
    }
    
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

            return redirect()->route('indexF')->with([
                'status_code' => $response->getStatusCode(), 
                'msg' => 'Cadastro realizado com sucesso']);
        }
        else
        {
            return redirect()->route('indexF')->with([
                'status_code' => $response->getStatusCode(), 
                'msg' => 'Não foi possível realizar o cadastro']);
        }
    }

    public function Atualizar(Request $request, $id){
        
        $this->client = new Client([
            'base_uri' => $this->uri,
            'timeout' => 2.0,
            'exceptions' => false
        ]);

        $response = $this->client->post('fornecedors/salvar/'.$id, [
            'json' => [
                'cnpj' => $request->cnpj,
                'fantasia' => $request->fantasia,
                'razao' => $request->razao
            ],
        ]);

        if($response->getStatusCode() == 200)
        {
            LogController::CriarLog($request->session()->get('dados')->token, "Atualizou um fornecedor");
            return redirect()->route('indexF')->with([
                'status_code' => $response->getStatusCode(), 
                'msg' => 'Registro atualizado com sucesso']);
        }
        else
        {
            return redirect()->route('indexF')->with([
                'status_code' => $response->getStatusCode(), 
                'msg' => 'Não foi possível atualizar o registro']);
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

    public function BuscarFornecedorsID($id){
        $this->access = new Client([
            'base_uri' => $this->uri,
            'timeout' => 2.0,
            'exceptions' => false
        ]);

        $response = $this->access->get('fornecedors/consultar/'.$id);

        if($response->getStatusCode() == 200)
        {
            $fornecedor = json_decode($response->getBody());
            return view('componentes.fornecedor.atualizar', ['fornecedor' => $fornecedor]);
        }
        else
        {
            $fornecedor = json_decode($response->getBody());
            return view('componentes.fornecedor.atualizar', ['fornecedor' => $fornecedor]);
        }
    }
}
