<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Certificado de Horas</title>
    <style>
        body {
            font-family: Times, serif;
            text-align: center;
            margin-top: 100px;
        }
    </style>
</head>
<body>
    <div class="center">
        <h1>Certificado de Cumprimento de Horas</h1>
        <p>Certificamos que <strong>{{ $aluno->nome }}</strong>, matriculado no curso de <strong>{{ $aluno->curso->nome }}</strong>, cumpriu o total de <strong>{{ $horasCumpridas }}</strong> horas complementares.</p>
    </div>
</body>
</html>
