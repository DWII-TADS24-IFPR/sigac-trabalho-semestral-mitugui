@extends('layouts.app')

@section('title', 'Declarações')

@section('content')
<h1>Declarações</h1>

@if ($errors->any())
     <div class="alert alert-danger">
         <ul>
             @foreach ($errors->all() as $error)
                 <li>{{ $error }}</li>
             @endforeach
         </ul>
     </div>
@endif

<form action="{{ route('declaracoes.update', $declaracao, $declaracao->id) }}" method="POST" class="mb-2">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="hash" class="form-label">Hash</label>
        <input type="text" class="form-control" id="hash" name="hash" value="{{ $declaracao->hash }}" required>

        <label for="data" class="form-label">Data</label>
        <input type="date" class="form-control" id="data" name="data" value="{{ $declaracao->data }}" required>

        <label for="aluno_id" class="form-label">Aluno</label>
        <select class="form-select" id="aluno_id" name="aluno_id" required>
            <option value="{{ $declaracao->aluno->id }}" selected>{{ $declaracao->aluno->nome }}</option>
        
            @foreach ($alunos as $aluno)
                @if ($aluno->id != $declaracao->aluno->id)
                    <option value="{{ $aluno->id }}">{{ $aluno->nome }}</option>
                @endif
            @endforeach
        </select>

        <label for="comprovante_id" class="form-label">Comprovante</label>
        <select class="form-select" id="comprovante_id" name="comprovante_id" required>
            <option value="{{ $declaracao->comprovante->id }}" selected>{{ $declaracao->comprovante->atividade }}</option>
        
            @foreach ($comprovantes as $comprovante)
                @if ($comprovante->id != $declaracao->comprovante->id)
                    <option value="{{ $comprovante->id }}">{{ $comprovante->atividade }}</option>
                @endif
            @endforeach
        </select>
    </div>
    
    <button type="submit" class="btn btn-primary">Atualizar</button>
    <button type="button" class="btn btn-primary" onclick="window.location.href='{{route('declaracoes.index')}}'">Voltar</button>
</form>

@endsection