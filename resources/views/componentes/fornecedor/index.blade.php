@extends('template.template')

@section('conteudo')
    <a class="btn btn-success" href="{{route('cadastrarF')}}" role="button">Cadastrar Fornecedor</a>

    @if(session('status_code'))
    <div class="alert alert-success" role="alert" data-autohide="true">
        {{session('status_code')}}&nbsp; {{session('msg')}}
    </div>
    @endif    

    @if(isset($fornecedors))
    <table class="table">
    <thead>
        <tr>
        <th scope="col">ID</th>
        <th scope="col">CNPJ</th>
        <th scope="col">Fantasia</th>
        <th scope="col">Razão Social</th>
        </tr>
    </thead>
    <tbody>
        @foreach($fornecedors as $fornecedor)
            <tr>
                <td>{{$fornecedor->id}}</td>
                <td>{{$fornecedor->cnpj}}</td>
                <td>{{$fornecedor->fantasia}}</td>
                <td>{{$fornecedor->razao}}</td>
                <td>
                    <a class="nav-link" href="{{route('atualizarF', $fornecedor->id)}}">
                        <i class="fa fa-refresh" aria-hidden="true"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
    </table>
    @endif
@endsection