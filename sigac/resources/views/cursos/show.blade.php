@extends('layouts.app')

@section('title', 'Cursos')

@section('content')
<h1>Curso</h1>

<table class="table table-white">
    <thead>
        <tr>
            <thead>
            <th scope="col">ID</th>
            <th scope="col">NOME</th>
            <th scope="col">SIGLA</th>
            <th scope="col">TOTAL DE HORAS</th>
            <th scope="col">NIVEL</th>
            <th scope="col">EIXO</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td scope="col">{{ $curso->id }}</td>
            <td scope="col">{{ $curso->nome }}</td>
            <td scope="col">{{ $curso->sigla }}</td>
            <td scope="col">{{ $curso->total_horas }}</td>
            <td scope="col">{{ $curso_nivel->nome }}</td>
            <td scope="col">{{ $curso_eixo->nome }}</td>
        </tr>
    </tbody>
</table>


<button class="btn btn-primary" onclick="window.location.href='{{route('cursos.index')}}'">Voltar</button>

@endsection