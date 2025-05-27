@extends('layouts.app')

@section('title', 'Alunos')

@section('content')
<h1>Alunos</h1>

@if ($errors->any())
     <div class="alert alert-danger">
         <ul>
             @foreach ($errors->all() as $error)
                 <li>{{ $error }}</li>
             @endforeach
         </ul>
     </div>
@endif

<form action="{{ route('alunos.update', $aluno, $aluno->id) }}" method="POST" class="mb-2">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="nome" class="form-label">Nome</label>
        <input type="text" class="form-control" id="nome" name="nome" value="{{ $aluno->nome }}" required>

        <label for="cpf" class="form-label">Cpf</label>
        <input type="text" class="form-control cpf" id="cpf" name="cpf" value="{{ $aluno->cpf }}" required>

        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control email" id="email" name="email" value="{{ $aluno->email }}" required>

        <label for="curso_id" class="form-label">Curso</label>
        <select class="form-select" id="curso_id" name="curso_id" required>
            <option value="{{ $aluno->curso->id }}" selected>{{ $aluno->curso->nome }}</option>
        
            @foreach ($cursos as $curso)
                @if ($curso->id != $aluno->curso->id)
                    <option value="{{ $curso->id }}">{{ $curso->nome }}</option>
                @endif
            @endforeach
        </select>

        <label for="turma_id" class="form-label">Turma</label>
        <select class="form-select" id="turma_id" name="turma_id" required>
            <option value="{{ $aluno->turma->id }}" selected>{{ $aluno->turma->ano }} - {{ $aluno->turma->curso->nome }}</option>
        
            @foreach ($turmas as $turma)
                @if ($turma->id != $aluno->turma->id)
                    <option value="{{ $turma->id }}">{{ $turma->ano }} - {{ $turma->curso->nome }}</option>
                @endif
            @endforeach
        </select>

        <label for="senha" class="form-label">Senha</label>
        <input type="password" class="form-control" id="senha" name="senha" value="" required>
    </div>
    
    <button type="submit" class="btn btn-primary">Atualizar</button>
    <button type="button" class="btn btn-primary" onclick="window.location.href='{{route('alunos.index')}}'">Voltar</button>
</form>

@endsection