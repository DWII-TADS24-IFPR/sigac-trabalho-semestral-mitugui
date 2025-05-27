@extends('layouts.app')

@section('title', 'Categorias')

@section('content')
<h1>Categorias</h1>

<table class="table table-white">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">NOME</th>
            <th scope="col">MÁXIMO DE HORAS</th>
            <th scope="col">CURSO</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td scope="col">{{ $categoria->id }}</td>
            <td scope="col">{{ $categoria->nome }}</td>
            <td scope="col">{{ $categoria->maximo_horas }}</td>
            <td scope="col">{{ $categoria_curso->nome }}</td>
        </tr>
    </tbody>
</table>


<button class="btn btn-primary" onclick="window.location.href='{{route('categorias.index')}}'">Voltar</button>

@endsection