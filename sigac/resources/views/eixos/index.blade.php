@extends('layouts.app')

@section('title', 'Eixos')

@section('content')
<h1>Eixos</h1>

@if($eixos->isNotEmpty())
<table class="table table-white">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">NOME</th>
        </tr>
    </thead>
    <tbody>
        @foreach($eixos as $eixo)
            <tr>
                <td scope="col">{{ $eixo->id }}</td>
                <td scope="col">{{ $eixo->nome }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endif

@endsection