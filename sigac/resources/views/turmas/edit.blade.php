@extends('layouts.app')

@section('title', 'Turmas')

@section('content')
<h1>Turmas</h1>

@if ($errors->any())
     <div class="alert alert-danger">
         <ul>
             @foreach ($errors->all() as $error)
                 <li>{{ $error }}</li>
             @endforeach
         </ul>
     </div>
@endif

<form action="{{ route('turmas.update', $turma, $turma->id) }}" method="POST" class="mb-2">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="ano" class="form-label">Ano</label>
        <input type="number" class="form-control" id="ano" name="ano" value="{{ $turma->ano }}" required>

        <label for="curso_id" class="form-label">Curso</label>
        <select class="form-select" id="curso_id" name="curso_id" required>
            <option value="{{ $turma->curso->id }}" selected>{{ $turma->curso->nome }}</option>
        
            @foreach ($cursos as $curso)
                @if ($curso->id != $turma->curso->id)
                    <option value="{{ $curso->id }}">{{ $curso->nome }}</option>
                @endif
            @endforeach
        </select>
    </div>
    
    <button type="submit" class="btn btn-primary">Atualizar</button>
    <button type="button" class="btn btn-primary" onclick="window.location.href='{{route('cursos.index')}}'">Voltar</button>
</form>

@endsection