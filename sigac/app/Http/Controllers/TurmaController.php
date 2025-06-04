<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Documento;
use App\Models\Turma;
use Illuminate\Http\Request;

class TurmaController extends Controller
{
    protected $validationRules = [
        'ano' => 'required|digits:4|integer',
        'curso_id' => 'required|exists:cursos,id',
    ];
    
    protected $customMessages = [
        'ano.required' => 'O ano é obrigatório.',
        'ano.digits' => 'O ano deve conter 4 números.',
        'ano.integer' => 'O ano deve ser um número inteiro.',
        'curso_id.required' => 'O curso é obrigatório.',
        'curso_id.exists' => 'O curso selecionado é inválido.',
    ];

    public function index()
    {
        return view('turmas.index')->with(['turmas' => Turma::all()]);
    }

    public function create()
    {
        return view('turmas.create')->with(['cursos' => Curso::all()]);
    }

    public function store(Request $request)
    {
        $request->validate($this->validationRules, $this->customMessages);

        Turma::create([
            'ano' => $request->ano,
            'curso_id' => $request->curso_id,
        ]);

        return redirect()->route('turmas.index')->with(['success'=>'Turma '.$request->ano.' criada com sucesso!']);
    }

    public function show(string $id)
    {
        $turma = Turma::with('alunos.user')->find($id);
        $turma_curso = $turma->curso;

        $dadosGrafico = [];

        foreach ($turma->alunos as $aluno) {
            $user = $aluno->user;

            if ($user) {
                $horasAprovadas = Documento::where('user_id', $user->id)
                    ->where('status', 'aprovado')
                    ->sum('horas_out');

                $dadosGrafico[] = [
                    'nome' => $user->name,
                    'horas' => $horasAprovadas
                ];
            }
    }

    return view('turmas.show', compact('turma', 'turma_curso', 'dadosGrafico'));
    }

    public function edit(string $id)
    {
        return view('turmas.edit')->with(['turma' => Turma::find($id), 'cursos' => Curso::all()]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate($this->validationRules, $this->customMessages);
        
        $turma = Turma::find($id);

        if ($turma) {
            $turma->ano = $request->ano;
            $turma->curso_id = $request->curso_id;

            $turma->save();
            return redirect()->route('turmas.index')->with(['success'=>'Turma '.$turma->id.' atualizada com sucesso']);
        }
    }

    public function destroy(string $id)
    {
        $turma = Turma::find($id);

        if ($turma) {
            $turma->delete();
        }

        return redirect()->route('turmas.index')->with(['success'=>'Turma '.$turma->ano.' deletada com sucesso']);
    }
}
