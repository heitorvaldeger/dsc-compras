@extends('template.template')

@section('conteudo')
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            ID
        </button>
        @if(isset($unidades))
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <tr>
                <a class="dropdown-item"> </a>
            </tr>
            @foreach($unidades as $unidade)
                <tr>
                    <a class="dropdown-item" id="{{$unidade->id}}">{{$unidade->id}}</a>
                </tr>
            @endforeach
        </div>
        @endif
    </div>

    <form method="POST" action="{{route('salvarU')}}">
    {{csrf_field()}}
        <div class="form-group">
            <input type="text" class="form-control" id="idunidade" name="idunidade">
        </div>
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
        <script>
            $(".dropdown-item").click(function() {
                var text = $(this).text();
                $("#idunidade").val(text);
            });
        </script>
    </form>

    @if(isset($status_code_save))
    <div class="alert alert-success" role="alert" data-autohide="true">
        {{$status_code_save}}
    </div>
    @endif    

    @if(isset($unidades))
    <table class="table">
    <thead>
        <tr>
        <th scope="col">ID</th>
        <th scope="col">Descricao</th>
        <th scope="col">Grama</th>
        </tr>
    </thead>
    <tbody>
        @foreach($unidades as $unidade)
            <tr>
                <td>{{$unidade->id}}</td>
                <td>{{$unidade->descricao}}</td>
                <td>{{$unidade->grama}}</td>
            </tr>
        @endforeach
    </tbody>
    </table>
    @endif
@endsection