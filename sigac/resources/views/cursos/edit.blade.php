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

<form action="{{ route('cursos.update', $curso, $curso->id) }}" method="POST" class="mb-2">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="nome" class="form-label">Nome</label>
        <input type="text" class="form-control" id="nome" name="nome" value="{{ $curso->nome }}" required>

        <label for="sigla" class="form-label">Sigla</label>
        <input type="text" class="form-control" id="sigla" name="sigla" value="{{ $curso->sigla }}" required>

        <label for="total_horas" class="form-label">Total de Horas</label>
        <input type="text" class="form-control" id="total_horas" name="total_horas" value="{{ $curso->total_horas }}" required>

        <select class="form-select" id="nivel_id" name="nivel_id" required>
            <option value="{{ $curso->nivel->id }}" selected>{{ $curso->nivel->nome }}</option>
        
            @foreach ($niveis as $nivel)
                @if ($nivel->id != $curso->nivel->id)
                    <option value="{{ $nivel->id }}">{{ $nivel->nome }}</option>
                @endif
            @endforeach
        </select>
    </div>
    
    <button type="submit" class="btn btn-primary">Atualizar</button>
    <button type="button" class="btn btn-primary" onclick="window.location.href='{{route('cursos.index')}}'">Voltar</button>
</form>

@endsection