@extends('template.template')

@section('conteudo')
    <form method="POST" action="{{route('cadastrarU')}}">
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
@endsection