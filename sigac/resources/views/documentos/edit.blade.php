@extends('layouts.app')

@section('title', 'Documentos')

@section('content')
<h1>Documentos</h1>

@if ($errors->any())
     <div class="alert alert-danger">
         <ul>
             @foreach ($errors->all() as $error)
                 <li>{{ $error }}</li>
             @endforeach
         </ul>
     </div>
@endif

<form action="{{ route('documentos.update', $documento, $documento->id) }}" method="POST" class="mb-2">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="url" class="form-label">Url</label>
        <input type="text" class="form-control" id="url" name="url" value="{{ $documento->url }}" required>

        <label for="descricao" class="form-label">Descricao</label>
        <input type="text" class="form-control" id="descricao" name="descricao" value="{{ $documento->descricao }}" required>

        <label for="horas_in" class="form-label">Horas IN</label>
        <input type="number" class="form-control" id="horas_in" name="horas_in" value="{{ $documento->horas_in }}" required>

        <label for="horas_out" class="form-label">Horas OUT</label>
        <input type="number" class="form-control" id="horas_out" name="horas_out" value="{{ $documento->horas_out }}" required>
        
        <label for="status" class="form-label">Status</label>
        <select class="form-select" id="status" name="status" required>
            <option value="pendente" {{ $documento->status == 'pendente' ? 'selected' : '' }}>Pendente</option>
            <option value="aprovado" {{ $documento->status == 'aprovado' ? 'selected' : '' }}>Aprovado</option>
            <option value="reprovado" {{ $documento->status == 'reprovado' ? 'selected' : '' }}>Reprovado</option>
        </select>
        

        <label for="comentario" class="form-label">Comentário</label>
        <input type="text" class="form-control" id="comentario" name="comentario" value="{{ $documento->comentario }}" required>

        <label for="categoria_id" class="form-label">Categoria</label>
        <select class="form-select" id="categoria_id" name="categoria_id" required>
            <option value="{{ $documento->categoria->id }}" selected>{{ $documento->categoria->nome }}</option>
        
            @foreach ($categorias as $categoria)
                @if ($categoria->id != $documento->categoria->id)
                    <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                @endif
            @endforeach
        </select>
    
    <button type="submit" class="btn btn-primary">Atualizar</button>
    <button type="button" class="btn btn-primary" onclick="window.location.href='{{route('documentos.index')}}'">Voltar</button>
</form>

@endsection