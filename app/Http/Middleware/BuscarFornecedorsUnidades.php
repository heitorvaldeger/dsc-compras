<?php

namespace App\Http\Middleware;

use Closure;

class BuscarFornecedorsUnidades
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    private $fornecedors;
    private $unidades;

    public function handle($request, Closure $next)
    {
        $this->BuscarFornecedores();
        $this->BuscarUnidades();

        $response = $next($request);
    }

    private function BuscarFornecedores(){
        $this->client = new CLient([
            'base_uri' => $this->uri,
            'timeout' => 2.0,
            'exceptions' => false
        ]);

        $response = $this->client->get('fornecedors/listar');

        $this->fornecedors = json_decode($response->getBody());
    }

    private function BuscarUnidades(){
        $this->client = new CLient([
            'base_uri' => $this->uri,
            'timeout' => 2.0,
            'exceptions' => false
        ]);

        $response = $this->client->get('unidades/listar');

        $this->unidades = json_decode($response->getBody());
    }
}
