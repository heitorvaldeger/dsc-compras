<?php

namespace App\Http\Middleware;

use Closure;
use \App\Http\Controllers\AutenticarController;

class TokenValidate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->session()->has('dados'))
        {
            $dados = $request->session()->get('dados');
            $token = $dados->token;
            $validartoken = new AutenticarController;
            $retorno = $validartoken->ValidarToken($token);

            if($retorno == true)
            {
                return redirect('/index');
            }
            
            return redirect('/');
            // if($retorno == false)
            // {
            //     return redirect('/');
            // }
        }

        return $next($request);
    }
}
