@extends('template.template')

@section('conteudo')
    <form method="POST" action="{{route('salvarI')}}">
    {{csrf_field()}}
        <div class="dropdown">
            <select name="idinsumo">
                <option value="id" selected="selected">ID</option>
                @if(isset($insumos))
                    @foreach($insumos as $insumo)
                        <tr>
                            <option value="{{$insumo->id}}">{{$insumo->id}}</option>
                        </tr>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="form-group">
            <label for="descricao">Descrição</label>
            <input type="text" class="form-control" id="descricao" name="descricao">
        </div>
        <div class="form-group">
            <label for="materia_prima">Matéria Prima</label>
            <input type="text" class="form-control" id="materia_prima" name="materia_prima">
        </div>
        <div class="form-group">
            <label for="estoque">Estoque</label>
            <input type="text" class="form-control" id="razao" name="razao">
        </div>
        <div class="form-group">
            <label for="fornecedores">Lista de Fornecedores</label>
            <div class="dropdown">
                <select name="idfornecedor">
                    <option value="id" selected="selected">ID</option>
                    @if(isset($fornecedors))
                        @foreach($fornecedors as $fornecedor)
                            <option value="{{$fornecedor->id}}">
                                {{$fornecedor->id}} | 
                                {{$fornecedor->cnpj}} | 
                                {{$fornecedor->fantasia}}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="unidades">Lista de Unidades</label>
            <div class="dropdown">
                <select name="idunidade">
                    <option value="id" selected="selected">ID</option>
                    @if(isset($unidades))
                        @foreach($unidades as $unidade)
                            <option value="{{$unidade->id}}">
                                {{$unidade->id}} | 
                                {{$unidade->descricao}} |
                                {{$unidade->grama}} 
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>

    @if(isset($status_code_save))
    <div class="alert alert-success" role="alert" data-autohide="true">
        {{$status_code_save}}
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
            </tr>
        @endforeach
    </tbody>
    </table>
    @endif
@endsection