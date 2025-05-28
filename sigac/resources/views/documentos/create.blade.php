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

<form action="{{ route('documentos.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="url" class="form-label">Url</label>
        <input type="file" class="form-control" id="url" name="url" required>

        <label for="descricao" class="form-label">Descricao</label>
        <input type="text" class="form-control date" id="descricao" name="descricao" required>

        <label for="horas_in" class="form-label">Horas_in</label>
        <input type="number" class="form-control date" id="horas_in" name="horas_in" required>

        <label for="comentario" class="form-label">Comentario</label>
        <input type="text" class="form-control date" id="comentario" name="comentario" required>

        <label for="horas_out" class="form-label">Horas_out</label>
        <input type="number" class="form-control date" id="horas_out" name="horas_out" required>

        <label for="categoria_id" class="form-label">Categoria</label>
        <select class="form-select" id="categoria_id" name="categoria_id" required>
            <option value="">Selecione uma categoria</option>

            @foreach ($categorias as $categoria)
                <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Criar</button>
    <button class="btn btn-primary" onclick="window.location.href='{{route('documentos.index')}}'">Voltar</button>
</form>

@endsection