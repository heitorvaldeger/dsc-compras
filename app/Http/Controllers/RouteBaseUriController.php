<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RouteBaseUriController extends Controller
{
    public static function UriBaseArmazem()
    {
        return "http://armazem.com/api/";
    }

    public static function UriBaseAcesso()
    {
        return "http://acesso.com/api/";
    }
}
