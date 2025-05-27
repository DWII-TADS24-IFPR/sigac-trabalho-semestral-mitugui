<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Categoria;
use App\Models\Comprovante;
use Illuminate\Http\Request;

class ComprovanteController extends Controller
{
    protected $validationRules = [
        'horas' => 'required|numeric|min:1',
        'atividade' => 'required|string|max:255',
        'aluno_id' => 'required|exists:alunos,id',
        'categoria_id' => 'required|exists:categorias,id'
    ];

    protected $customMessages = [
        'horas.required' => 'O campo horas é obrigatório.',
        'horas.numeric' => 'O campo horas deve ser um número.',
        'horas.min' => 'O valor mínimo para horas é 1.',
    
        'atividade.required' => 'O campo atividade é obrigatório.',
        'atividade.string' => 'A atividade deve ser um texto.',
        'atividade.max' => 'A atividade deve ter no máximo 255 caracteres.',
    
        'aluno_id.required' => 'O campo aluno é obrigatório.',
        'aluno_id.exists' => 'O aluno selecionado não é válido.',
    
        'categoria_id.required' => 'O campo categoria é obrigatório.',
        'categoria_id.exists' => 'A categoria selecionada não é válida.'
    ];

    public function index()
    {
        return view('comprovantes.index')->with(['comprovantes' => Comprovante::all()]);
    }

    public function create()
    {
        return view('comprovantes.create')->with(['categorias' => Categoria::all(), 'alunos' => Aluno::all()]);
    }

    public function store(Request $request)
    {
        $request->validate($this->validationRules, $this->customMessages);

        $categoria = Categoria::find($request->categoria_id);
    
        if ($request->horas > $categoria->maximo_horas) {
            return redirect()->back()
                ->withErrors(['horas' => 'A quantidade de horas excede o máximo permitido para esta categoria (' . $categoria->maximo_horas . 'h).'])
                ->withInput();
        }

        Comprovante::create([
            'horas' => $request->horas,
            'atividade' => $request->atividade,
            'aluno_id' => $request->aluno_id,
            'categoria_id' => $request->categoria_id
        ]);

        return redirect()->route('comprovantes.index')->with(['success'=>'Comprovante para "'.$request->atividade.'" criado com sucesso!']);
    }

    public function show(string $id)
    {
        $comprovante = Comprovante::find($id);
        return view('comprovantes.show')->with(['comprovante' => $comprovante, 'comprovante_categoria' => $comprovante->categoria, 'comprovante_aluno' => $comprovante->aluno]);
    }

    public function edit(string $id)
    {
        return view('comprovantes.edit')->with(['comprovante' => Comprovante::find($id), 'categorias' => Categoria::all(), 'alunos' => Aluno::all()]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate($this->validationRules, $this->customMessages);

        $categoria = Categoria::find($request->categoria_id);
    
        if ($request->horas > $categoria->maximo_horas) {
            return redirect()->back()
                ->withErrors(['horas' => 'A quantidade de horas excede o máximo permitido para esta categoria (' . $categoria->maximo_horas . 'h).'])
                ->withInput();
        }

        $comprovante = Comprovante::find($id);

        if ($comprovante) {
            $comprovante->horas = $request->horas;
            $comprovante->atividade = $request->atividade;
            $comprovante->categoria_id = $request->categoria_id;
            $comprovante->aluno_id = $request->aluno_id;

            $comprovante->save();
            return redirect()->route('comprovantes.index')->with(['success'=>'Comprovante '.$comprovante->id.' atualizado com sucesso']);
        }
    }

    public function destroy(string $id)
    {
        $comprovante = Comprovante::find($id);

        if ($comprovante) {
            $comprovante->delete();
        }

        return redirect()->route('comprovantes.index')->with(['success'=>'Comprovante "'.$comprovante->atividade.'" deletado com sucesso']);
    }
}
