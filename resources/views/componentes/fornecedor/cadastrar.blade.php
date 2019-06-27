@extends('template.template')

@section('conteudo')
    <form method="POST" action="{{route('cadastrarF')}}" id="formFornecedor">
    {{csrf_field()}}
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
@endsection