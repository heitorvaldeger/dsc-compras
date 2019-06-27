<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class UserController extends Controller
{
    private $uri;
    private $access;

    public function __construct()
    {   
        $this->uri = RouteBaseUriController::UriBaseAcesso();
    }
    
    public function ViewProfileAction(Request $request)
    {
        $this->access = new Client([
            'base_uri' => $this->uri,
            'timeout' => RouteBaseUriController::Timeout(),
            'exceptions' => false
        ]);
        
        $response = $this->access->get('usuarios/get/'.$request->id);

        $status_code = $response->getStatusCode();

        if($status_code == 200){
            $dados = json_decode($response->getBody());

            return view('componentes.userprofile', ['dados' => $dados]);
        }
        if($status_code != 200){
            return redirect('profile')->with('status_code', $status_code);
        }
    }
}
