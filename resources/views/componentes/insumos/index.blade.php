@extends('template.template')

@section('conteudo')
    <a class="btn btn-success" href="{{route('cadastrarI')}}" role="button">Cadastrar Insumo</a>

    @if(session('status_code'))
    <div class="alert alert-success" role="alert" data-autohide="true">
        {{session('status_code')}} &nbsp; {{session('msg')}}
    </div>
    @endif    

    @if(isset($insumos))
    <table class="table">
    <thead>
        <tr>
        <th scope="col">ID</th>
        <th scope="col">Descricao</th>
        <th scope="col">Matéria Prima</th>
        <th scope="col">Estoque</th>
        </tr>
    </thead>
    <tbody>
        @foreach($insumos as $insumo)
            <tr>
                <td>{{$insumo->id}}</td>
                <td>{{$insumo->descricao}}</td>
                <td>{{$insumo->materia_prima}}</td>
                <td>{{$insumo->estoque}}</td>
                <td>
                    <a class="nav-link" href="{{route('atualizarI', $insumo->id)}}">
                        <i class="fa fa-refresh" aria-hidden="true"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
    </table>
    @endif
@endsection