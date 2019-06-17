<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Controllers\InsumoController;

class InsumoCorU
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
        $insumo = new InsumoController();

        if(!is_numeric($request->id))
            $this->retorno = $insumo->Cadastrar($request);
        else
            $this->retorno = $insumo->Atualizar($request);
        

        if($this->retorno['status_code'] == 200)
        {
            return redirect()->route('indexI', 
                ['status_code_save' => $this->retorno['status_code'], 
                'insumos' => $this->retorno['insumos']]);
        }
        else
        {
            return redirect()->route('indexI', 
            ['status_code_save' => $this->retorno['status_code']]);
        }
    }
}
