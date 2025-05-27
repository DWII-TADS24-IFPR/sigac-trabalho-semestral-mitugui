@extends('layouts.app')

@section('title', 'Alunos')

@section('content')
<h1>Alunos</h1>

<table class="table table-white">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">NOME</th>
            <th scope="col">CPF</th>
            <th scope="col">EMAIL</th>
            <th scope="col">CURSO</th>
            <th scope="col">TURMA</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td scope="col">{{ $aluno->id }}</td>
            <td scope="col">{{ $aluno->nome }}</td>
            <td scope="col">{{ $aluno->cpf }}</td>
            <td scope="col">{{ $aluno->email }}</td>
            <td scope="col">{{ $aluno_curso->nome }}</td>
            <td scope="col">{{ $aluno_turma->ano }} - {{ $aluno_turma->curso->nome }}</td>
        </tr>
    </tbody>
</table>


<button class="btn btn-primary" onclick="window.location.href='{{route('alunos.index')}}'">Voltar</button>

@endsection