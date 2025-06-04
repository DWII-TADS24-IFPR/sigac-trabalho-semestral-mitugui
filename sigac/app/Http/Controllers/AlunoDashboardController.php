<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Documento;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlunoDashboardController extends Controller
{

public function index()
{
    $user = Auth::user();

    $aluno = Aluno::where('user_id', $user->id)->first();

    if (!$aluno) {
        return redirect()->route('/')->with('error', 'Aluno não encontrado.');
    }

    $curso = $aluno->curso;
    $totalHorasNecessarias = $curso->total_horas;

    $horasCumpridas = Documento::where('user_id', $user->id)
        ->where('status', 'aprovado')
        ->sum('horas_out');

    $podeEmitirCertificado = $horasCumpridas >= $totalHorasNecessarias;

    return view('aluno')
        ->with('podeEmitirCertificado', $podeEmitirCertificado)
        ->with('horasCumpridas', $horasCumpridas)
        ->with('totalHorasNecessarias', $totalHorasNecessarias);
}


public function gerarDeclaracao()
{

    $user = Auth::user();

    $aluno = Aluno::where('user_id', $user->id)->first();

    if (!$aluno) {
        return redirect()->route('/')->with('error', 'Aluno não encontrado.');
    }

    $curso = $aluno->curso;
    $totalHorasNecessarias = $curso->total_horas;

    $horasCumpridas = Documento::where('user_id', $user->id)
        ->where('status', 'aprovado')
        ->sum('horas_out');

    if ($horasCumpridas < $totalHorasNecessarias) {
        return redirect()->route('aluno.dashboard')->with('error', 'Horas insuficientes para emitir a declaração.');
    }

    $html = view('certificado')
        ->with('aluno', $aluno)
        ->with('horasCumpridas', $horasCumpridas)
        ->render();

    $options = new Options();
    $dompdf = new Dompdf($options);
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    return response($dompdf->output(), 200)
        ->header('Content-Type', 'application/pdf')
        ->header('Content-Disposition', 'attachment; filename="certificado_horas_complementares.pdf"');
}
}
