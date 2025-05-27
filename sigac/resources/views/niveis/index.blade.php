@extends('layouts.app')

@section('title', 'Níveis')

@section('content')
<h1>Niveis</h1>

<button class="btn btn-primary" onclick="window.location.href='{{route('niveis.create')}}'">Adicionar</button>

@if(session('success'))
    <div id="alert-pop-up" class="alert alert-success my-3">
        {{ session('success') }}
    </div>
@endif

@if($niveis->isNotEmpty())
<table class="table table-white">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">NOME</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($niveis as $nivel)
            <tr>
                <td scope="col">{{ $nivel->id }}</td>
                <td scope="col">{{ $nivel->nome }}</td>
                <td scope="col">
                    <div class="d-flex gap-3 justify-content-end">
                        <form
                            action="{{ route('niveis.show', $nivel->id) }}"
                            method="GET"
                        >
                            <button type="submit" class="btn btn-light">Ver</i></button>
                        </form>
                        <form
                            action="{{ route('niveis.edit', $nivel->id) }}"
                            method="GET"
                        >
                            <button type="submit" class="btn btn-warning text-white">Atualizar</button>
                        </form>
                        <form
                            action="{{ route('niveis.destroy', $nivel->id) }}"
                            method="POST"
                            onsubmit="return confirm('Tem certeza que deseja excluir este nível?');"
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