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

            return redirect()->route('indexU')->with([
                'status_code' => $response->getStatusCode(), 
                'msg' => 'Cadastro realizado com sucesso']);
        }
        else
        {
            return redirect()->route('indexU')->with([
                'status_code' => $response->getStatusCode(), 
                'msg' => 'Não foi possível realizar o cadastro']);
        }
    }

    public function IndexUnidades()
    {
        $unidades = $this->BuscarUnidades();

        if($unidades != null)
            return view('componentes.unidade.indexunidade', ['unidades' => $unidades]);
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

        return json_decode($response->getBody());
    }

    public function Atualizar(Request $request, $id)
    {
        $this->access = new Client([
            'base_uri' => $this->uri,
            'timeout' => 2.0,
            'exceptions' => false
        ]);

        $response = $this->access->post('unidades/salvar/'.$id, [
            'json' => [
                'descricao' => $request->unidadesname,
                'grama' => $request->grama,
            ],
        ]);

        if($response->getStatusCode() == 200)
        {
            LogController::CriarLog($request->session()->get('dados')->token, "Atualizou uma unidade");
            return redirect()->route('indexU')->with([
                'status_code' => $response->getStatusCode(), 
                'msg' => 'Atualização realizada com sucesso']);
        }
        else
        {
            return redirect()->route('indexU')->with([
                'status_code' => $response->getStatusCode(), 
                'msg' => 'Não foi possível realizar a atualização']);
        }
    }

    public function RenderUpdate($id)
    {
        return view('componentes.unidade.atualizar', ['id' => $id]);
    }
}
