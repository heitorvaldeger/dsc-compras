@extends('template.template')

@section('conteudo')
    @if(isset($dados))
        <h3>Nome: {{$dados->nome}}</h3>
        <h3>CPF: {{$dados->cpf}}</h3>
    @endif
    @if(isset($status_code))
        @if($status_code != 200)
            <h4>Não foi possível recuperar as informações</h4>
        @endif
    @endif
@endsection