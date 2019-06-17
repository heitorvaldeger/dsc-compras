@extends('template.template')

@section('conteudo')
    <form method="POST" action="{{route('salvarF')}}" id="formFornecedor">
    {{csrf_field()}}
        <div class="dropdown">
            <select name="id">
                <option value="id" selected="selected">ID</option>
                @if(isset($fornecedors))
                    @foreach($fornecedors as $fornecedor)
                        <tr>
                            <option value="{{$fornecedor->id}}">{{$fornecedor->id}}</option>
                        </tr>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="form-group">
            <label for="unidade">CNPJ</label>
            <input type="text" class="form-control" id="cnpj" name="cnpj">
        </div>
        <div class="form-group">
            <label for="unidade">Nome Fantasia</label>
            <input type="text" class="form-control" id="fantasia" name="fantasia">
        </div>
        <div class="form-group">
            <label for="unidade">Razão Social</label>
            <input type="text" class="form-control" id="razao" name="razao">
        </div>
        
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>

    @if(isset($status_code_save))
    <div class="alert alert-success" role="alert" data-autohide="true">
        {{$status_code_save}}
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
            </tr>
        @endforeach
    </tbody>
    </table>
    @endif
@endsection