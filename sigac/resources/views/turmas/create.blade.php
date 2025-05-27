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

<form action="{{ route('turmas.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="ano" class="form-label">Ano</label>
        <input type="number" class="form-control" id="ano" name="ano" required>

        <label for="curso_id" class="form-label">Curso</label>
        <select class="form-select" id="curso_id" name="curso_id" required>
            <option value="">Selecione um curso</option>

            @foreach ($cursos as $curso)
                <option value="{{ $curso->id }}">{{ $curso->nome }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Criar</button>
    <button class="btn btn-primary" onclick="window.location.href='{{route('turmas.index')}}'">Voltar</button>
</form>

@endsection