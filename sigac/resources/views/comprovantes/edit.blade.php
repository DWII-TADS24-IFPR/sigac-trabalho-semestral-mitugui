@extends('layouts.app')

@section('title', 'Comprovantes')

@section('content')
<h1>Comprovantes</h1>

@if ($errors->any())
     <div class="alert alert-danger">
         <ul>
             @foreach ($errors->all() as $error)
                 <li>{{ $error }}</li>
             @endforeach
         </ul>
     </div>
@endif

<form action="{{ route('comprovantes.update', $comprovante, $comprovante->id) }}" method="POST" class="mb-2">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="horas" class="form-label">Horas</label>
        <input type="number" class="form-control" id="horas" name="horas" value="{{ $comprovante->horas }}" required>

        <label for="atividade" class="form-label">Atividade</label>
        <input type="text" class="form-control" id="atividade" name="atividade" value="{{ $comprovante->atividade }}" required>

        <label for="categoria_id" class="form-label">Categoria</label>
        <select class="form-select" id="categoria_id" name="categoria_id" required>
            <option value="{{ $comprovante->categoria->id }}" selected>{{ $comprovante->categoria->nome }}</option>
        
            @foreach ($categorias as $categoria)
                @if ($categoria->id != $comprovante->categoria->id)
                    <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                @endif
            @endforeach
        </select>

        <label for="aluno_id" class="form-label">Aluno</label>
        <select class="form-select" id="aluno_id" name="aluno_id" required>
            <option value="{{ $comprovante->aluno->id }}" selected>{{ $comprovante->aluno->nome }}</option>
        
            @foreach ($alunos as $aluno)
                @if ($aluno->id != $comprovante->aluno->id)
                    <option value="{{ $aluno->id }}">{{ $aluno->nome }}</option>
                @endif
            @endforeach
        </select>
    </div>
    
    <button type="submit" class="btn btn-primary">Atualizar</button>
    <button type="button" class="btn btn-primary" onclick="window.location.href='{{route('comprovantes.index')}}'">Voltar</button>
</form>

@endsection