@extends('template.template')

@section('conteudo')
    @if(isset($msg))
        <div class="alert alert-success">
            <p>
                    Bem-Vindo {{$msg}}
            </p>
        </div>
    @endif
@endsection