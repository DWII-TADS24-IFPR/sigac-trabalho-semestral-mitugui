<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Comprovante;
use App\Models\Declaracao;
use Illuminate\Http\Request;

class DeclaracaoController extends Controller
{
    protected $validationRules = [
        'hash' => 'required|string|max:255',
        'data' => 'required|date_format:Y-m-d',
        'aluno_id' => 'required|exists:alunos,id',
        'comprovante_id' => 'required|exists:comprovantes,id',
    ];
    
    protected $customMessages = [
        'hash.required' => 'O campo hash é obrigatório.',
        'hash.string' => 'O hash deve ser um texto válido.',
        'hash.max' => 'O hash deve ter no máximo 255 caracteres.',
    
        'data.required' => 'A data é obrigatória.',
        'data.date_format' => 'A data deve estar no formato válido (DD-MM-YYYY).',
    
        'aluno_id.required' => 'O aluno é obrigatório.',
        'aluno_id.exists' => 'O aluno selecionado não existe.',
    
        'comprovante_id.required' => 'O comprovante é obrigatório.',
        'comprovante_id.exists' => 'O comprovante selecionado não existe.',
    ];

    protected $uniqueHashValidationRules = [
        'hash' => 'unique:declaracoes,hash'
    ];

    protected $uniqueHashCustomMessage = [
        'hash.unique' => 'Este hash já foi utilizado em outra declaração.'
    ];

    public function index()
    {
        return view('declaracoes.index')->with(['declaracoes' => Declaracao::all()]);
    }

    public function create()
    {
        return view('declaracoes.create')->with(['alunos' => Aluno::all(), 'comprovantes' => Comprovante::all()]);
    }

    public function store(Request $request)
    {
        $request->validate($this->uniqueHashValidationRules, $this->uniqueHashCustomMessage);
        $request->validate($this->validationRules, $this->customMessages);

        Declaracao::create([
            'hash' => $request->hash,
            'data' => $request->data,
            'aluno_id' => $request->aluno_id,
            'comprovante_id' => $request->comprovante_id
        ]);

        return redirect()->route('declaracoes.index')->with(['success'=>'Declaração criada com sucesso!']);
    }

    public function show(string $id)
    {
        $declaracao = Declaracao::find($id);
        return view('declaracoes.show')->with(['declaracao' => $declaracao, 'declaracao_aluno' => $declaracao->aluno, 'declaracao_comprovante' => $declaracao->comprovante]);
    }

    public function edit(string $id)
    {
        return view('declaracoes.edit')->with(['declaracao' => Declaracao::find($id), 'comprovantes' => Comprovante::all(), 'alunos' => Aluno::all()]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate($this->validationRules, $this->customMessages);

        $declaracao = Declaracao::find($id);

        if ($declaracao) {
            $declaracao->hash = $request->hash;
            $declaracao->data = $request->data;
            $declaracao->aluno_id = $request->aluno_id;
            $declaracao->comprovante_id = $request->comprovante_id;

            $declaracao->save();
            return redirect()->route('declaracoes.index')->with(['success'=>'Declaração '.$declaracao->id.' atualizada com sucesso']);
        }
    }

    public function destroy(string $id)
    {
        $declaracao = Declaracao::find($id);

        if ($declaracao) {
            $declaracao->delete();
        }

        return redirect()->route('declaracoes.index')->with(['success'=>'Declaração '.$declaracao->id.' deletada com sucesso']);
    }
}
