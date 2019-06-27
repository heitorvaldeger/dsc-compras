@extends('template.template')

@section('conteudo') 
    <form method="POST" action="{{route('balancoC')}}" id="formFornecedor">
    {{csrf_field()}}
        <div class="form-group">
            <label for="Data de Início">Início</label>
            <input type="date" class="form-control" id="data_inicio" name="data_inicio">
        </div>
        <div class="form-group">
            <label for="Data de Fim">Fim</label>
            <input type="date" class="form-control" id="data_fim" name="data_fim">
        </div>
        
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>

    @if(session('balanco') != null && session('status_code') == 200)
        <h6>Data de Início: {{session('balanco')->data_inicio}}</h6>
        <h6>Data de Fim: {{session('balanco')->data_fim}}</h6>
        <p>Total de Compras: {{session('balanco')->compras_totais}}</p>

        <table class="table">
        <thead>
            <tr>
            <th scope="col">ID</th>
            <th scope="col">Média (Preço UNITÁRIO)</th>
            <th scope="col">Média (Preço TOTAL)</th>
            </tr>
        </thead>
        <tbody>
            @foreach(session('balanco')->insumos as $insumo)
                <tr>
                    <td>{{$insumo->insumo_id}}</td>
                    <td>{{$insumo->media_preco_unitario}}</td>
                    <td>{{$insumo->media_preco_total}}</td>
                </tr>
            @endforeach
        </tbody>
        </table>
    @endif
@endsection