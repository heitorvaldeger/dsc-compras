@extends('template.template')

@section('conteudo')
    <a class="btn btn-success" href="{{route('cadastrarU')}}" role="button">Cadastrar Unidade</a>

    @if(session('status_code'))
    <div class="alert alert-success" role="alert" data-autohide="true">
        {{session('status_code')}} &nbsp; {{session('msg')}}
    </div>
    @endif    

    @if(isset($unidades))
    <table class="table">
    <thead>
        <tr>
        <th scope="col">ID</th>
        <th scope="col">Descricao</th>
        <th scope="col">Grama</th>
        </tr>
    </thead>
    <tbody>
        @foreach($unidades as $unidade)
            <tr>
                <td>{{$unidade->id}}</td>
                <td>{{$unidade->descricao}}</td>
                <td>{{$unidade->grama}}</td>
                <td>
                    <a class="nav-link" href="{{route('atualizarU', $unidade->id)}}">
                        <i class="fa fa-refresh" aria-hidden="true"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
    </table>
    @endif
@endsection