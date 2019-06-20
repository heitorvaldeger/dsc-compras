<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>ToY Manager - @yield('title', 'Login')</title>
	 <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="https://colorlib.com/etc/lf/Login_v12/vendor/animate/animate.css">

	<link rel="stylesheet" type="text/css" href="https://colorlib.com/etc/lf/Login_v12/vendor/css-hamburgers/hamburgers.min.css">

	<link rel="stylesheet" type="text/css" href="https://colorlib.com/etc/lf/Login_v12/vendor/select2/select2.min.css">

	<link rel="stylesheet" type="text/css" href="https://colorlib.com/etc/lf/Login_v12/css/util.css">
	<link rel="stylesheet" type="text/css" href="https://colorlib.com/etc/lf/Login_v12/css/main.css">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
    <div class="limiter">
        <div class="container-login100">
        <div class="wrap-login100">
            <form class="login100-form validate-form" action="{{action('AutenticarController@AutenticarAction')}}" method="post">
            {{csrf_field()}}
                <span class="login100-form-title p-t-20 p-b-45">
                    ToY Manager
                    @if(session('authfailure')) 
                        <p style="font-size: 16px;">{{session('authfailure')}} </p>
                    @endif
                </span>
                <div class="wrap-input100 validate-input m-b-10" data-validate="Nome do Usuário é requerido">
                    <input class="input100" type="text" name="login" placeholder="Nome do Usuário">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="fa fa-user"></i>
                    </span>
                </div>
                <div class="wrap-input100 validate-input m-b-10" data-validate="O campo senha é requerido">
                    <input class="input100" type="password" name="password" placeholder="Senha">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="fa fa-lock"></i>
                    </span>
                </div>
                <div class="container-login100-form-btn p-t-10">
                    <button class="login100-form-btn">
                    Login
                    </button>
                </div>
                <div class="text-center w-full p-t-25 p-b-30">
                    <a href="#" class="txt1">
                        Forgot Username / Password?
                    </a>
                </div>
                <div class="text-center w-full">
                    <a class="txt1" href="http://acesso.com/usuarios/cadastro">
                        Criar nova conta
                        <i class="fa fa-long-arrow-right"></i>
                    </a>
                </div>
            </form>
        </div>
        </div>
    </div>
</body>