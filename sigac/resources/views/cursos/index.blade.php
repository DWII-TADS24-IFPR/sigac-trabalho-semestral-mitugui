@extends('layouts.app')

@section('title', 'Cursos')

@section('content')
<h1>Cursos</h1>

<button class="btn btn-primary" onclick="window.location.href='{{route('cursos.create')}}'">Adicionar</button>

@if(session('success'))
    <div id="alert-pop-up" class="alert alert-success my-3">
        {{ session('success') }}
    </div>
@endif

@if($cursos->isNotEmpty())
<table class="table table-white">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">NOME</th>
            <th scope="col">TOTAL DE HORAS</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($cursos as $curso)
            <tr>
                <td scope="col">{{ $curso->id }}</td>
                <td scope="col">{{ $curso->nome }}</td>
                <td scope="col">{{ $curso->total_horas }}</td>
                <td>
                    <div class="d-flex gap-3 justify-content-end">
                        <form
                            action="{{ route('cursos.show', $curso->id) }}"
                            method="GET"
                        >
                            <button type="submit" class="btn btn-light">Ver</i></button>
                        </form>
                        <form
                            action="{{ route('cursos.edit', $curso->id) }}"
                            method="GET"
                        >
                            <button type="submit" class="btn btn-warning text-white">Atualizar</button>
                        </form>
                        <form
                            action="{{ route('cursos.destroy', $curso->id) }}"
                            method="POST"
                            onsubmit="return confirm('Tem certeza que deseja excluir este curso?');"
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