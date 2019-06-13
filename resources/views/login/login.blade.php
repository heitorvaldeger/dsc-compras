@extends('login.principal')
@section('conteudo')
    @if(isset($authfailure)) 
    <div class="alert alert-danger">
        <p>
            {{$authfailure}} 
        </p>
    </div>
    @endif
    <form action="{{action('AutenticarController@AutenticarAction')}}" method="post">
    {{csrf_field()}}
        <label for="login">Login:</label><br/>
        <input type="text" name="login" id="login"><br/>
        <label for="password">Password:</label><br/>
        <input type="password" name="password" id="password"><br/>
        <button type="submit">Entrar</button>
    </form>
@endsection