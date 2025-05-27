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

<form action="{{ route('declaracoes.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="hash" class="form-label">Hash</label>
        <input type="text" class="form-control" id="hash" name="hash" required>

        <label for="data" class="form-label">Data</label>
        <input type="date" class="form-control date" id="data" name="data" required>

        <label for="aluno_id" class="form-label">Aluno</label>
        <select class="form-select" id="aluno_id" name="aluno_id" required>
            <option value="">Selecione um aluno</option>

            @foreach ($alunos as $aluno)
                <option value="{{ $aluno->id }}">{{ $aluno->nome }}</option>
            @endforeach
        </select>

        <label for="comprovante_id" class="form-label">Comprovante</label>
        <select class="form-select" id="comprovante_id" name="comprovante_id" required>
            <option value="">Selecione um comprovante</option>

            @foreach ($comprovantes as $comprovante)
                <option value="{{ $comprovante->id }}">{{ $comprovante->atividade }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Criar</button>
    <button class="btn btn-primary" onclick="window.location.href='{{route('declaracoes.index')}}'">Voltar</button>
</form>

@endsection