@extends('template.template')

@section('conteudo')
    @if(isset($id))
        @if(is_numeric($id) && $status_code == 200)
            <form method="POST" action="{{route('realizarC')}}" id="formFornecedor">
            {{csrf_field()}}
                <div class="form-group">
                    <label for="unidade" id="insumo_id" name="insumo_id">Identificador do Insumo</label>
                    <input type="number" class="form-control" id="insumo_id" name="insumo_id" value="{{$id}}">
                </div>
                <div class="form-group">
                    <label for="quantidade">Quantidade</label>
                    <input type="number" class="form-control" id="quantidade" name="quantidade">
                </div>
                <div class="form-group">
                    <label for="valor_unitario">Valor Unitário</label>
                    <input type="text" class="form-control" id="valor_unitario" name="valor_unitario">
                </div>
                <div class="form-group">
                    <label for="icms">ICMS</label>
                    <input type="text" class="form-control" id="icms" name="icms">
                </div>
                <div class="form-group">
                    <label for="frete">Frete</label>
                    <input type="text" class="form-control" id="frete" name="frete">
                </div>
                <div class="form-group">
                    <label for="ipi">IPI</label>
                    <input type="text" class="form-control" id="ipi" name="ipi">
                </div>
                <div class="form-group">
                    <label for="Nota Fiscal">Nº Nota Fiscal</label>
                    <input type="text" class="form-control" id="nf" name="nf">
                </div>
                <div class="form-group">
                    <label for="Data da Compra">Data da Compra</label>
                    <input type="date" class="form-control" id="data_compra" name="data_compra">
                </div>
                <div class="form-group">
                    <label for="Data de Entrada">Data de Entrada</label>
                    <input type="date" class="form-control" id="data_entrada" name="data_entrada">
                </div>
                
                <button type="submit" class="btn btn-primary">Salvar</button>
            </form>
        @else
        <div class="alert alert-danger" role="alert" data-autohide="true">
            URL Inválida
        </div>
        @endif
    @else
    <div class="alert alert-danger" role="alert" data-autohide="true">
        URL Inválida
    </div>
    @endif
@endsection