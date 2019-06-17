<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Controllers\FornecedorController;

class FornecedorCorU
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
        $fornecedor = new FornecedorController();

        if(!is_numeric($request->id))
            $this->retorno = $fornecedor->Cadastrar($request);
        else
            $this->retorno = $fornecedor->Atualizar($request);

        if($this->retorno['status_code'] == 200)
        {
            return redirect()->route('indexF', 
                ['status_code_save' => $this->retorno['status_code'], 
                'fornecedors' => $this->retorno['fornecedors']]);
        }
        else
        {
            return redirect()->route('indexF', 
            ['status_code_save' => $this->retorno['status_code']]);
        }
    }
}
