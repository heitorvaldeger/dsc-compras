<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RouteBaseUriController extends Controller
{
    public static function UriBaseArmazem()
    {
        // return 'http://192.168.100.173:5000/api/';
        return "http://armazem.com/api/";
    }

    public static function UriBaseAcesso()
    {
        // return 'http://192.168.100.173:80/api/';
        return "http://acesso.com/api/";
    }

    public static function Timeout()
    {
        return 10;
    }
}
