@extends('layouts.app')

@section('title', 'Comprovantes')

@section('content')
<h1>Comprovantes</h1>

<button class="btn btn-primary" onclick="window.location.href='{{route('comprovantes.create')}}'">Adicionar</button>

@if(session('success'))
    <div id="alert-pop-up" class="alert alert-success my-3">
        {{ session('success') }}
    </div>
@endif

@if($comprovantes->isNotEmpty())
<table class="table table-white">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">ALUNO</th>
            <th scope="col">ATIVIDADE</th>
            <th scope="col">HORAS</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($comprovantes as $comprovante)
            <tr>
                <td scope="col">{{ $comprovante->id }}</td>
                <td scope="col">{{ $comprovante->aluno->nome }}</td>
                <td scope="col">{{ $comprovante->atividade }}</td>
                <td scope="col">{{ $comprovante->horas }}</td>
                <td>
                    <div class="d-flex gap-3 justify-content-end">
                        <form
                            action="{{ route('comprovantes.show', $comprovante->id) }}"
                            method="GET"
                        >
                            <button type="submit" class="btn btn-light">Ver</i></button>
                        </form>
                        <form
                            action="{{ route('comprovantes.edit', $comprovante->id) }}"
                            method="GET"
                        >
                            <button type="submit" class="btn btn-warning text-white">Atualizar</button>
                        </form>
                        <form
                            action="{{ route('comprovantes.destroy', $comprovante->id) }}"
                            method="POST"
                            onsubmit="return confirm('Tem certeza que deseja excluir este comprovante?');"
                        >
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Excluir</button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endif

@endsection