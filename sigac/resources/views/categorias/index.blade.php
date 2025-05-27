@extends('layouts.app')

@section('title', 'Categorias')

@section('content')
<h1>Categorias</h1>

<button class="btn btn-primary" onclick="window.location.href='{{route('categorias.create')}}'">Adicionar</button>

@if(session('success'))
    <div id="alert-pop-up" class="alert alert-success my-3">
        {{ session('success') }}
    </div>
@endif

@if($categorias->isNotEmpty())
<table class="table table-white">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">NOME</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($categorias as $categoria)
            <tr>
                <td scope="col">{{ $categoria->id }}</td>
                <td scope="col">{{ $categoria->nome }}</td>
                <td>
                    <div class="d-flex gap-3 justify-content-end">
                        <form
                            action="{{ route('categorias.show', $categoria->id) }}"
                            method="GET"
                        >
                            <button type="submit" class="btn btn-light">Ver</i></button>
                        </form>
                        <form
                            action="{{ route('categorias.edit', $categoria->id) }}"
                            method="GET"
                        >
                            <button type="submit" class="btn btn-warning text-white">Atualizar</button>
                        </form>
                        <form
                            action="{{ route('categorias.destroy', $categoria->id) }}"
                            method="POST"
                            onsubmit="return confirm('Tem certeza que deseja excluir esta categoria?');"
                        >
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Excluir</button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endif

@endsection