@extends('layouts.app')

@section('title', 'Eixos')

@section('content')
<h1>Eixos</h1>

<button class="btn btn-primary" onclick="window.location.href='{{route('eixos.create')}}'">Adicionar</button>

@if(session('success'))
    <div id="alert-pop-up" class="alert alert-success my-3">
        {{ session('success') }}
    </div>
@endif

@if($eixos->isNotEmpty())
<table class="table table-white">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">NOME</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($eixos as $eixo)
            <tr>
                <td scope="col">{{ $eixo->id }}</td>
                <td scope="col">{{ $eixo->nome }}</td>
                <td>
                    <div class="d-flex gap-3 justify-content-end">
                        <form
                            action="{{ route('eixos.edit', $eixo->id) }}"
                            method="GET"
                        >
                            <button type="submit" class="btn btn-warning text-white">Atualizar</button>
                        </form>
                        <form
                            action="{{ route('eixos.destroy', $eixo->id) }}"
                            method="POST"
                            onsubmit="return confirm('Tem certeza que deseja excluir este curso?');"
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