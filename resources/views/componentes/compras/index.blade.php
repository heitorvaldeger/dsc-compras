@extends('template.template')

@section('conteudo')
    @if(session('status_code') == 200)
        <div class="alert alert-success" role="alert" data-autohide="true">
            Compra efetivada com sucesso
        </div>
    @else
        <div class="alert alert-danger" role="alert" data-autohide="true">
            Não foi possível efetivar a compra
        </div>
    @endif
    @if($status_code == 200 && $insumos != null)
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
                        <a class="nav-link" href="{{route('cadastrarC', $insumo->id)}}">
                            <i class="fas fa-shopping-basket"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
        </table>
    @endif
@endsection