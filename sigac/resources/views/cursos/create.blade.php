@extends('layouts.app')

@section('title', 'Cursos')

@section('content')
<h1>Cursos</h1>

@if ($errors->any())
     <div class="alert alert-danger">
         <ul>
             @foreach ($errors->all() as $error)
                 <li>{{ $error }}</li>
             @endforeach
         </ul>
     </div>
@endif

<form action="{{ route('cursos.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="nome" class="form-label">Nome</label>
        <input type="text" class="form-control" id="nome" name="nome" required>

        <label for="sigla" class="form-label">Sigla</label>
        <input type="text" class="form-control" id="sigla" name="sigla" required>

        <label for="total_horas" class="form-label">Total de Horas</label>
        <input type="number" class="form-control" id="total_horas" name="total_horas" required>
        <label for="nivel" class="form-label">Nível</label>

        <select class="form-select" id="nivel_id" name="nivel_id" required>
            <option value="">Selecione um nível</option>

            @foreach ($niveis as $nivel)
                <option value="{{ $nivel->id }}">{{ $nivel->nome }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Criar</button>
    <button class="btn btn-primary" onclick="window.location.href='{{route('cursos.index')}}'">Voltar</button>
</form>

@endsection