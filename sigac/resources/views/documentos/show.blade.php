@extends('layouts.app')

@section('title', 'Documentos')

@section('content')
<h1>Documentos</h1>

<table class="table table-white">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">URL</th>
            <th scope="col">DESCRICAO</th>
            <th scope="col">HORAS IN</th>
            <th scope="col">STATUS</th>
            <th scope="col">HORAS OUT</th>
            <th scope="col">CATEGORIA</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td scope="col">{{ $documento->id }}</td>
            <td scope="col">{{ $documento->url }}</td>
            <td scope="col">{{ $documento->descricao }}</td>
            <td scope="col">{{ $documento->horas_in }}</td>
            <td scope="col">{{ $documento->status }}</td>
            <td scope="col">{{ $documento->horas_out }}</td>
            <td scope="col">{{ $documento->categoria->nome }}</td>
        </tr>
    </tbody>
</table>


<button class="btn btn-primary" onclick="window.location.href='{{route('documentos.index')}}'">Voltar</button>

@endsection