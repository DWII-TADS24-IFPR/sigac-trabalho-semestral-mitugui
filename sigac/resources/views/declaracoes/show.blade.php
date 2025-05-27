@extends('layouts.app')

@section('title', 'Declarações')

@section('content')
<h1>Declarações</h1>

<table class="table table-white">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">HASH</th>
            <th scope="col">DATA</th>
            <th scope="col">COMPROVANTE</th>
            <th scope="col">ALUNO</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td scope="col">{{ $declaracao->id }}</td>
            <td scope="col">{{ $declaracao->hash }}</td>
            <td scope="col">{{ $declaracao->data }}</td>
            <td scope="col">{{ $declaracao_comprovante->atividade }}</td>
            <td scope="col">{{ $declaracao_aluno->nome }}</td>
        </tr>
    </tbody>
</table>


<button class="btn btn-primary" onclick="window.location.href='{{route('declaracoes.index')}}'">Voltar</button>

@endsection