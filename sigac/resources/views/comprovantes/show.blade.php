@extends('layouts.app')

@section('title', 'Comprovantes')

@section('content')
<h1>Comprovantes</h1>

<table class="table table-white">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">ALUNO</th>
            <th scope="col">ATIVIDADE</th>
            <th scope="col">CATEGORIA</th>
            <th scope="col">HORAS</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td scope="col">{{ $comprovante->id }}</td>
            <td scope="col">{{ $comprovante_aluno->nome }}</td>
            <td scope="col">{{ $comprovante->atividade }}</td>
            <td scope="col">{{ $comprovante_categoria-> nome }}</td>
            <td scope="col">{{ $comprovante->horas }}</td>
        </tr>
    </tbody>
</table>


<button class="btn btn-primary" onclick="window.location.href='{{route('comprovantes.index')}}'">Voltar</button>

@endsection