@extends('layouts.app')

@section('title', 'Níveis')

@section('content')
<h1>Niveis</h1>

@if ($errors->any())
     <div class="alert alert-danger">
         <ul>
             @foreach ($errors->all() as $error)
                 <li>{{ $error }}</li>
             @endforeach
         </ul>
     </div>
@endif

<form action="{{ route('niveis.update', $nivel, $nivel->id) }}" method="POST" class="mb-2">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="nome" class="form-label">Nome</label>
        <input type="text" class="form-control" id="nome" name="nome" value="{{ $nivel->nome }}" required>
    </div>
    
    <button type="submit" class="btn btn-primary">Atualizar</button>
    <button type="button" class="btn btn-primary" onclick="window.location.href='{{route('niveis.index')}}'">Voltar</button>
</form>

@endsection