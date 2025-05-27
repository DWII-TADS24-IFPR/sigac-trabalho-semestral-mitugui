<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Eixo;
use App\Models\Nivel;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    protected $validationRules = [
        'nome' => 'required|min:3',
        'sigla' => 'required|min:2|max:10',
        'total_horas' => 'required|integer|min:1',
        'nivel_id' => 'required|exists:nivels,id',
        'eixo_id' => 'required|exists:eixos,id'
    ];
    
    protected $customMessages = [
        'nome.required' => 'O nome é obrigatório.',
        'nome.min' => 'O nome deve ter pelo menos 3 caracteres.',
        'sigla.required' => 'A sigla é obrigatória.',
        'sigla.min' => 'A sigla deve ter pelo menos 2 caracteres.',
        'sigla.max' => 'A sigla deve ter no máximo 10 caracteres.',
        'total_horas.required' => 'O total de horas é obrigatório.',
        'total_horas.integer' => 'O total de horas deve ser um número inteiro.',
        'nivel_id.required' => 'O nível é obrigatório.',
        'nivel_id.exists' => 'O nível selecionado é inválido.',
        'eixo_id.required' => 'O eixo é obrigatório.',
        'eixo_id.exists' => 'O eixo selecionado é inválido.'
    ];

    public function index()
    {
        return view('cursos.index')->with(['cursos' => Curso::all()]);
    }

    public function create()
    {
        return view('cursos.create')->with(['niveis' => Nivel::all(), 'eixos' => Eixo::all()]);
    }

    public function store(Request $request)
    {
        $request->validate($this->validationRules, $this->customMessages);

        Curso::create([
            'nome' => $request->nome,
            'sigla' => $request->sigla,
            'total_horas' => $request->total_horas,
            'nivel_id' => $request->nivel_id,
            'eixo_id' => $request->eixo_id
        ]);

        return redirect()->route('cursos.index')->with(['success'=>'Curso '.$request->nome.' criado com sucesso!']);
    }

    public function show(string $id)
    {
        $curso = Curso::find($id);
        return view('cursos.show')->with(['curso' => $curso, 'curso_nivel' => $curso->nivel]);
    }

    public function edit(string $id)
    {
        return view('cursos.edit')->with(['curso' => Curso::find($id), 'niveis' => Nivel::all()]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate($this->validationRules, $this->customMessages);
        
        $curso = Curso::find($id);

        if ($curso) {
            $curso->nome = $request->nome;
            $curso->sigla = $request->sigla;
            $curso->total_horas = $request->total_horas;
            $curso->nivel_id = $request->nivel_id;

            $curso->save();
            return redirect()->route('cursos.index')->with(['success'=>'Curso '.$curso->id.' atualizado com sucesso']);
        }
    }

    public function destroy(string $id)
    {
        $curso = Curso::find($id);

        if ($curso) {
            $curso->delete();
        }

        return redirect()->route('cursos.index')->with(['success'=>'Curso '.$curso->nome.' deletado com sucesso']);
    }
}
