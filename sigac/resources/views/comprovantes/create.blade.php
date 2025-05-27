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

<form action="{{ route('comprovantes.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="horas" class="form-label">Horas</label>
        <input type="number" class="form-control" id="horas" name="horas" required>

        <label for="atividade" class="form-label">Atividade</label>
        <input type="text" class="form-control" id="atividade" name="atividade" required>

        <label for="categoria_id" class="form-label">Categoria</label>
        <select class="form-select" id="categoria_id" name="categoria_id" required>
            <option value="">Selecione uma categoria</option>

            @foreach ($categorias as $categoria)
                <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
            @endforeach
        </select>

        <label for="aluno_id" class="form-label">Aluno</label>
        <select class="form-select" id="aluno_id" name="aluno_id" required>
            <option value="">Selecione um aluno</option>

            @foreach ($alunos as $aluno)
                <option value="{{ $aluno->id }}">{{ $aluno->nome }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Criar</button>
    <button class="btn btn-primary" onclick="window.location.href='{{route('comprovantes.index')}}'">Voltar</button>
</form>

@endsection