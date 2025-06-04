@extends('layouts.app')

@section('title', 'Aluno')

@section('content')
<h1>Seja bem vindo, Aluno!</h1>

@if(session('success'))
    <div id="alert-pop-up" class="alert alert-success my-3">
        {{ session('success') }}
    </div>
@endif

<div class="d-grid gap-2 mt-4" style="grid-template-columns: repeat(3, 1fr); max-width: 800px; margin: auto;">
    <button type="button" class="btn btn-primary py-4" style="grid-column: span 3;" onclick="window.location.href='{{route('documentos.index')}}'">
        Submeter Documento
    </button>
    @if($podeEmitirCertificado)
        <button type="button" class="btn btn-primary py-4" style="grid-column: span 3;" onclick="window.location.href='{{ route('aluno.declaracao') }}'">
            Gerar Declaração de Cumprimento das Horas Complementares
        </button>
    @else
        <button type="button" class="btn btn-secondary py-4" style="grid-column: span 3;" disabled>
            Ainda faltam horas para gerar a declaração
        </button>
    @endif

</div>

@endsection