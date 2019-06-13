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
        if($request->session()->has('token'))
        {
            $token = $request->session()->get('token');
            $validartoken = new AutenticarController;
            $retorno = $validartoken->ValidarToken($token);

            if($retorno == true)
            {
                return redirect('/index');
            }
            
            if($retorno == false)
            {
                return redirect('/');
            }

            return redirect('/');
        }

        return $next($request);
    }
}
