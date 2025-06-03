@extends('layouts.app')

@section('title', 'Admin')

@section('content')
<h1>Seja bem vindo, Admin!</h1>

@if(session('success'))
    <div id="alert-pop-up" class="alert alert-success my-3">
        {{ session('success') }}
    </div>
@endif

<div class="d-grid gap-2 mt-4" style="grid-template-columns: repeat(3, 1fr); max-width: 800px; margin: auto;">
    <button type="button" class="btn btn-primary w-100 py-4" onclick="window.location.href='{{route('niveis.index')}}'">Níveis</button>
    <button type="button" class="btn btn-primary w-100 py-4" onclick="window.location.href='{{route('eixos.index')}}'">Eixos</button>
    <button type="button" class="btn btn-primary w-100 py-4" onclick="window.location.href='{{route('cursos.index')}}'">Cursos</button>
    <button type="button" class="btn btn-primary w-100 py-4" onclick="window.location.href='{{route('alunos.index')}}'">Alunos</button>
    <button type="button" class="btn btn-primary w-100 py-4" onclick="window.location.href='{{route('turmas.index')}}'">Turmas</button>
    <button type="button" class="btn btn-primary w-100 py-4" onclick="window.location.href='{{route('categorias.index')}}'">Categorias</button>
</div>


@if($documentos->isNotEmpty())
<table class="table table-white mt-5">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">DOCUMENTO</th>
            <th scope="col">DESCRICAO</th>
            <th scope="col">ALUNO</th>
            <th scope="col">AÇÕES</th>
        </tr>
    </thead>
    <tbody>
        @foreach($documentos as $documento)
            <tr>
                <td>{{ $documento->id }}</td>
                <td><a href="{{ $documento->url }}" target="_blank">Documento</a></td>
                <td>{{ $documento->descricao }}</td>
                <td>{{ $documento->user->name }}</td>
                <td>
                    <form action="{{ route('documentos.aprovar', $documento->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-success btn-sm">Aprovar</button>
                    </form>
    
                    <form action="{{ route('documentos.rejeitar', $documento->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-danger btn-sm">Rejeitar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endif

@endsection