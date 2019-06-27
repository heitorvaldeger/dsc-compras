<?php

namespace App\Http\Middleware;

use Closure;

class HasToken
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
        if(!$request->session()->has('dados'))
        {
            return redirect('/');
        }

        $dados = $request->session()->get('dados');

        if($dados->usuario->tipo_acesso[0] == "1")
            return $next($request);
        return redirect('/');
    }
}
