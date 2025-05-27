<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Curso;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    protected $validationRules = [
        'nome' => 'required|string|max:255',
        'maximo_horas' => 'required|numeric|min:1',
        'curso_id' => 'required|exists:cursos,id',
    ];

    protected $customMessages = [
        'nome.required' => 'O campo nome é obrigatório.',
        'nome.string' => 'O nome deve ser uma string válida.',
        'nome.max' => 'O nome deve ter no máximo 255 caracteres.',
    
        'maximo_horas.required' => 'O campo máximo de horas é obrigatório.',
        'maximo_horas.numeric' => 'O valor de horas deve ser um número.',
        'maximo_horas.min' => 'O valor mínimo permitido para as horas é 1.',
    
        'curso_id.required' => 'O campo curso é obrigatório.',
        'curso_id.exists' => 'O curso selecionado é inválido.',
    ];

    public function index()
    {
        return view('categorias.index')->with(['categorias' => Categoria::all()]);
    }

    public function create()
    {
        return view('categorias.create')->with(['cursos' => Curso::all()]);
    }

    public function store(Request $request)
    {
        $request->validate($this->validationRules, $this->customMessages);

        Categoria::create([
            'nome' => $request->nome,
            'maximo_horas' => $request->maximo_horas,
            'curso_id' => $request->curso_id,
        ]);

        return redirect()->route('categorias.index')->with(['success'=>'Categoria '.$request->nome.' criada com sucesso!']);
    }

    public function show(string $id)
    {
        $categoria = Categoria::find($id);
        return view('categorias.show')->with(['categoria' => $categoria, 'categoria_curso' => $categoria->curso]);
    }

    public function edit(string $id)
    {
        return view('categorias.edit')->with(['categoria' => Categoria::find($id), 'cursos' => Curso::all()]); 
    }

    public function update(Request $request, string $id)
    {
        $request->validate($this->validationRules, $this->customMessages);
        
        $categoria = Categoria::find($id);

        if ($categoria) {
            $categoria->nome = $request->nome;
            $categoria->maximo_horas = $request->maximo_horas;
            $categoria->curso_id = $request->curso_id;

            $categoria->save();
            return redirect()->route('categorias.index')->with(['success'=>'Categoria '.$categoria->id.' atualizada com sucesso']);
        }
    }

    public function destroy(string $id)
    {
        $categoria = Categoria::find($id);

        if ($categoria) {
            $categoria->delete();
        }

        return redirect()->route('categorias.index')->with(['success'=>'Categoria '.$categoria->nome.' deletada com sucesso']);
    }
}
