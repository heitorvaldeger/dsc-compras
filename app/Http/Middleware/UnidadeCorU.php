<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Controllers\UnidadeController;

/*
Middleware que checa se a operação é de Criação (C) ou Update(U)
*/
class UnidadeCorU
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    private $retorno;

    public function handle($request, Closure $next)
    {
        $unidade = new UnidadeController;

        if(!is_numeric($request->idunidade))
            $this->retorno = $unidade->Cadastrar($request);
        else
            $this->retorno = $unidade->Atualizar($request);

        if($this->retorno['status_code'] == 200)
            return redirect()->route('indexU', 
                ['status_code_save' => $this->retorno['status_code'], 
                'unidades' => $this->retorno['unidades']]);
        else
            return redirect()->route('indexU', 
            ['status_code_save' => $this->retorno['status_code']]);
    }
}
