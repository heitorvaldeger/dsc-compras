@extends('template.template')

@section('conteudo')
    @if(isset($fornecedor))
        <form method="POST" action="{{route('atualizarF', $fornecedor->id)}}" id="formFornecedor">
        {{csrf_field()}}
            <div class="form-group">
                <label for="unidade">CNPJ</label>
                <input type="text" class="form-control" id="cnpj" name="cnpj" value="{{$fornecedor->cnpj}}">
            </div>
            <div class="form-group">
                <label for="unidade">Nome Fantasia</label>
                <input type="text" class="form-control" id="fantasia" name="fantasia" value="{{$fornecedor->fantasia}}">
            </div>
            <div class="form-group">
                <label for="unidade">Razão Social</label>
                <input type="text" class="form-control" id="razao" name="razao" value="{{$fornecedor->razao}}">
            </div>
            
            <button type="submit" class="btn btn-primary">Atualizar</button>
        </form>
    @else
        <div class="alert alert-danger" role="alert" data-autohide="true">
            Não foi possível encontrar o registro!
        </div>
    @endif
@endsection