@extends('layouts.app')

@section('title', 'Níveis')

@section('content')
<h1>Niveis</h1>

<table class="table table-white">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">NOME</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td scope="col">{{ $nivel->id }}</td>
            <td scope="col">{{ $nivel->nome }}</td>
        </tr>
    </tbody>
</table>


<button class="btn btn-primary" onclick="window.location.href='{{route('niveis.index')}}'">Voltar</button>

@endsection