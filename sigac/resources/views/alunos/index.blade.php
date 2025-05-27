@extends('layouts.app')

@section('title', 'Alunos')

@section('content')
<h1>Alunos</h1>

<button class="btn btn-primary" onclick="window.location.href='{{route('alunos.create')}}'">Adicionar</button>

@if(session('success'))
    <div id="alert-pop-up" class="alert alert-success my-3">
        {{ session('success') }}
    </div>
@endif

@if($alunos->isNotEmpty())
<table class="table table-white">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">NOME</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($alunos as $aluno)
            <tr>
                <td scope="col">{{ $aluno->id }}</td>
                <td scope="col">{{ $aluno->nome }}</td>
                <td>
                    <div class="d-flex gap-3 justify-content-end">
                        <form
                            action="{{ route('alunos.show', $aluno->id) }}"
                            method="GET"
                        >
                            <button type="submit" class="btn btn-light">Ver</i></button>
                        </form>
                        <form
                            action="{{ route('alunos.edit', $aluno->id) }}"
                            method="GET"
                        >
                            <button type="submit" class="btn btn-warning text-white">Atualizar</button>
                        </form>
                        <form
                            action="{{ route('alunos.destroy', $aluno->id) }}"
                            method="POST"
                            onsubmit="return confirm('Tem certeza que deseja excluir este aluno?');"
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