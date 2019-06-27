@extends('template.template')

@section('conteudo')
    @if(isset($insumo))
    <form method="POST" action="{{route('atualizarI', $insumo->id)}}">
    {{csrf_field()}}
        <div class="form-group">
            <label for="descricao">Descrição</label>
            <input type="text" class="form-control" id="descricao" name="descricao" value="{{$insumo->descricao}}">
        </div>
        <div class="form-group">
            <label for="materia_prima">Matéria Prima</label>
            <input type="text" class="form-control" id="materia_prima" name="materia_prima" value="{{$insumo->materia_prima}}">
        </div>
        <div class="form-group">
            <label for="estoque">Estoque</label>
            <input type="text" class="form-control" id="estoque" name="estoque" value="{{$insumo->estoque}}">
        </div>

        <div class="form-group">
            <label for="fornecedores">Lista de Fornecedores</label>
            <div class="dropdown">
                <select name="idfornecedor">
                    <option value="{{$insumo->fornecedor->id}}" selected="selected">
                    {{$insumo->fornecedor->id}} | {{$insumo->fornecedor->cnpj}} | {{$insumo->fornecedor->fantasia}}
                    </option>
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
                    <option value="{{$insumo->unidade->id}}" selected="selected">
                    {{$insumo->unidade->id}} | {{$insumo->unidade->descricao}} | {{$insumo->unidade->grama}}
                    </option>
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
    @endif
@endsection