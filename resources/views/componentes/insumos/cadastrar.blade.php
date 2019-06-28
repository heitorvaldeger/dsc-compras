@extends('template.template')

@section('conteudo')
    <form method="POST" action="{{route('cadastrarI')}}">
    {{csrf_field()}}
        <div class="form-group">
            <label for="descricao">Descrição</label>
            <input type="text" class="form-control" id="descricao" name="descricao">
        </div>
        <div class="form-group">
            <label for="materia_prima">Matéria Prima</label>
            <select name="idmateriaprima">
                    <option value="1" selected="value">Sim</option>
                    <option value="0">Não</option>
                </select>
        </div>
        <div class="form-group">
            <label for="estoque">Estoque</label>
            <input type="text" class="form-control" id="estoque" name="estoque">
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
@endsection