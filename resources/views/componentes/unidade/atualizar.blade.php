@extends('template.template')

@section('conteudo')
    @if(is_numeric($id))
    <form method="POST" action="{{route('atualizarU', $id)}}">
    {{csrf_field()}}
        <div class="form-group">
            <select name="unidadesname" class="form-control">
                <option value="Miligrama">Miligrama</option>
                <option value="Grama" selected="selected">Grama</option>
                <option value="Quilograma">Quilograma</option>
            </select>
        </div>
        <div class="form-group">
            <label for="unidade">Unidade</label>
            <input type="number" class="form-control" name="grama" placeholder="Peso ">
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
    @else
    <div class="alert alert-danger" role="alert" data-autohide="true">
        Formato da URL Inválido
    </div>
    @endif
@endsection('conteudo')