@extends('layouts.app')

@section('title', 'Turmas')

@section('content')
<h1>Turmas</h1>

<table class="table table-white mt-5">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">ANO</th>
            <th scope="col">CURSO</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td scope="col">{{ $turma->id }}</td>
            <td scope="col">{{ $turma->ano }}</td>
            <td scope="col">{{ $turma_curso->nome }}</td>
        </tr>
    </tbody>
</table>

<div id="grafico-turma" style="width: 100%; height: 500px;"></div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        const dados = @json($dadosGrafico);

        if (!dados.length) {
            document.getElementById('grafico-turma').innerHTML = '<p class="text-danger">Nenhum aluno da turma possui horas complementares aprovadas.</p>';
            return;
        }

        const dataArray = [['Aluno', 'Horas']];
        dados.forEach(item => {
            dataArray.push([item.nome, item.horas]);
        });

        var data = google.visualization.arrayToDataTable(dataArray);

        var options = {
            title: 'Horas complementares por aluno',
            hAxis: { title: 'Aluno' },
            vAxis: { title: 'Horas' },
            legend: { position: 'none' }
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('grafico-turma'));
        chart.draw(data, options);
    }
</script>

<button class="btn btn-primary mt-3" onclick="window.location.href='{{route('turmas.index')}}'">Voltar</button>
@endsection
