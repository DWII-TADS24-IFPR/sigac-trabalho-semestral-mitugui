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

<form action="{{ route('categorias.update', $categoria, $categoria->id) }}" method="POST" class="mb-2">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="nome" class="form-label">Nome</label>
        <input type="text" class="form-control" id="nome" name="nome" value="{{ $categoria->nome }}" required>

        <label for="maximo_horas" class="form-label">Máximo de Horas</label>
        <input type="number" class="form-control" id="maximo_horas" name="maximo_horas" value="{{ $categoria->maximo_horas }}" required>

        <label for="curso_id" class="form-label">Curso</label>
        <select class="form-select" id="curso_id" name="curso_id" required>
            <option value="{{ $categoria->curso->id }}" selected>{{ $categoria->curso->nome }}</option>
        
            @foreach ($cursos as $curso)
                @if ($curso->id != $categoria->curso->id)
                    <option value="{{ $curso->id }}">{{ $curso->nome }}</option>
                @endif
            @endforeach
        </select>

    </div>
    
    <button type="submit" class="btn btn-primary">Atualizar</button>
    <button type="button" class="btn btn-primary" onclick="window.location.href='{{route('categorias.index')}}'">Voltar</button>
</form>

@endsection