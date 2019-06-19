<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class InsumoController extends Controller
{
    private $uri = "http://armazem.com/api/";
    private $client;
    private $insumos;
    
    public function Index(){
        $this->insumos = self::BuscarInsumos();

        if($this->insumos != null)
            return view('componentes.insumos.index', ['insumos' => $this->insumos]);
        else
            return view('componentes.insumos.index');
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
            return redirect()->route('indexI')->with([
                'status_code' => $response->getStatusCode(), 
                'msg' => 'Cadastro realizado com sucesso']);
        }
        else
        {
            return redirect()->route('indexI')->with([
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

        $response = $this->client->post('insumos/salvar/'.$id, [
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
            return redirect()->route('indexI')->with([
                'status_code' => $response->getStatusCode(), 
                'msg' => 'Atualização realizada com sucesso']);
        }
        else
        {
            return redirect()->route('indexI')->with([
                'status_code' => $response->getStatusCode(), 
                'msg' => 'Não foi possível fazer atualização']);
        }
    }

    public function BuscarFornecedorsUnidades(){
        $fornecedors = self::BuscarFornecedores();
        $unidades = self::BuscarUnidades();

        return view('componentes.insumos.cadastrar', ['fornecedors' => $fornecedors, 'unidades' => $unidades]);
    }

    public function BuscarInsumoID($id)
    {
        $this->client = new Client([
            'base_uri' => $this->uri,
            'timeout' => 2.0,
            'exceptions' => false
        ]);

        $response = $this->client->get('insumos/consultar/'.$id);
        
        return view('componentes.insumos.atualizar', [
            'insumo' => json_decode($response->getBody()),
            'fornecedors' => self::BuscarFornecedores(),
            'unidades' => self::BuscarUnidades()
            ]);
    }

    private static function BuscarInsumos(){
        $client = new Client([
            'base_uri' => "http://armazem.com/api/",
            'timeout' => 2.0,
            'exceptions' => false
        ]);

        $response = $client->get('insumos/listar');

        return $insumos = json_decode($response->getBody());
    }

    private static function BuscarFornecedores(){
        $client = new Client([
            'base_uri' => "http://armazem.com/api/",
            'timeout' => 2.0,
            'exceptions' => false
        ]);

        $response = $client->get('fornecedors/listar');

        $fornecedors = json_decode($response->getBody());
        return $fornecedors;
    }

    private static function BuscarUnidades(){
        $client = new Client([
            'base_uri' => "http://armazem.com/api/",
            'timeout' => 2.0,
            'exceptions' => false
        ]);

        $response = $client->get('unidades/listar');

        $unidades = json_decode($response->getBody());
        return $unidades;
    }
}
