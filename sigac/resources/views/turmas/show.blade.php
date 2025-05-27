@extends('layouts.app')

@section('title', 'Turmas')

@section('content')
<h1>Turmas</h1>

<table class="table table-white">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">ANO</th>
            <th scope="col">CURSO</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td scope="col">{{ $turma->id }}</td>
            <td scope="col">{{ $turma->ano }}</td>
            <td scope="col">{{ $turma_curso->nome }}</td>
        </tr>
    </tbody>
</table>


<button class="btn btn-primary" onclick="window.location.href='{{route('turmas.index')}}'">Voltar</button>

@endsection