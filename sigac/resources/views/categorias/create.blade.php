@extends('layouts.app')

@section('title', 'Categorias')

@section('content')
<h1>Categorias</h1>

@if ($errors->any())
     <div class="alert alert-danger">
         <ul>
             @foreach ($errors->all() as $error)
                 <li>{{ $error }}</li>
             @endforeach
         </ul>
     </div>
@endif

<form action="{{ route('categorias.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="nome" class="form-label">Nome</label>
        <input type="text" class="form-control" id="nome" name="nome" required>

        <label for="maximo_horas" class="form-label">Máximo de Horas</label>
        <input type="number" class="form-control" id="maximo_horas" name="maximo_horas" required>

        <label for="curso_id" class="form-label">Curso</label>
        <select class="form-select" id="curso_id" name="curso_id" required>
            <option value="">Selecione um curso</option>

            @foreach ($cursos as $curso)
                <option value="{{ $curso->id }}">{{ $curso->nome }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Criar</button>
    <button class="btn btn-primary" onclick="window.location.href='{{route('categorias.index')}}'">Voltar</button>
</form>

@endsection