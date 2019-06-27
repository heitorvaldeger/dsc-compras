<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ComprasController extends Controller
{
    private $client;
    private $uri;

    public function __construct()
    {   
        $this->uri = RouteBaseUriController::UriBaseArmazem();
    }
    
    public function Index(Request $request)
    {
        $this->client = new Client([
            'base_uri' => $this->uri,
            'timeout' => RouteBaseUriController::Timeout(),
            'exceptions' => false
        ]);

        $response = $this->client->get('insumos/listar');

        return view('componentes.compras.index', [
            'insumos' => json_decode($response->getBody()), 
            'status_code' => $response->getStatusCode()]);
    }

    public function BuscarInsumo($id)
    {
        $this->client = new Client([
            'base_uri' => $this->uri,
            'timeout' => RouteBaseUriController::Timeout(),
            'exceptions' => false
        ]);

        $response = $this->client->get('insumos/consultar/'.$id);
        
        return view('componentes.compras.cadastrar', [
            'id' => $id,
            'status_code' => $response->getStatusCode()
            ]);
    }

    public function RealizarCompra(Request $request)
    {
        $data_compra = str_replace('/', '-', $request->data_compra);
        $data_entrada = str_replace('/', '-', $request->data_entrada);

        $this->client = new Client([
            'base_uri' => $this->uri,
            'timeout' => RouteBaseUriController::Timeout(),
            'exceptions' => false,
        ]);

        $response = $this->client->put('compras/realizar', 
        [
        'json' => [
            'insumo_id' => (int)$request->insumo_id,
            'quantidade' => (float)$request->quantidade,
            'valor_unitario' => (float)$request->valor_unitario,
            'icms' => (float)$request->icms,
            'frete' => (float)$request->frete,
            'ipi' => (float)$request->ipi,
            'nf' => (float)$request->nf,
            'data_compra' => $data_compra,
            'data_entrada' => $data_entrada
            ]
        ]);

        if($response->getStatusCode() == 200)
        {
            LogController::CriarLog($request->session()->get('dados')->token, "Nova compra de insumo realizada");
            return redirect()->route('indexC')->with([
                'status_code' => $response->getStatusCode(), 
                'msg' => 'Compra realizada com sucesso']);
        }
        else
        {
            return redirect()->route('indexC')->with([
                'status_code' => $response->getStatusCode(), 
                'msg' => 'Não foi possível realizar a compra com sucesso']);   
        }
    }

    public function Balanco(Request $request)
    {
        $data_inicio = str_replace('/', '-', $request->data_inicio);
        $data_fim = str_replace('/', '-', $request->data_fim);

        $this->client = new Client([
            'base_uri' => $this->uri,
            'timeout' => RouteBaseUriController::Timeout(),
            'exceptions' => false,
        ]);

        $response = $this->client->get('compras/balanco/'.$data_inicio.'/'.$data_fim);
 
        return redirect()->route('balancoIndex')->with([
            'status_code' => $response->getStatusCode(), 
            'msg' => 'Não foi possível realizar a compra com sucesso',
            'balanco' => json_decode($response->getBody())
        ]);
    }

    public function IndexBalanco()
    {
        return view('componentes.compras.balanco');
    }
}
