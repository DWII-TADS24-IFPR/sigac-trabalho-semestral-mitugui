<?php

namespace App\Http\Controllers;

use App\Models\Eixo;
use Illuminate\Http\Request;

class EixoController extends Controller
{
    protected $validationRules = [
        'nome' => 'required|string|min:3|max:255|unique:eixos,nome'
    ];
    
    protected $customMessages = [
        'nome.required' => 'O campo nome é obrigatório.',
        'nome.string' => 'O campo nome deve ser uma string.',
        'nome.min' => 'O campo nome deve ter pelo menos :min caracteres.',
        'nome.max' => 'O campo nome não pode ter mais que :max caracteres.',
        'nome.unique' => 'Já existe um eixo com esse nome.'
    ];
    
    public function index()
    {
        return view('eixos.index')->with(['eixos' => Eixo::all()]);
    }

    public function create()
    {
        return view('eixos.create');
    }

    public function store(Request $request)
    {
        $request->validate($this->validationRules, $this->customMessages);

        Eixo::create([
            'nome' => $request->nome
        ]);

        return redirect()->route('eixos.index')->with(['success'=>'Eixo '.$request->nome.' criado com sucesso!']);
    }

    public function show(string $id)
    {
        $eixo = Eixo::find($id);
        return view('eixos.show')->with(['eixo' => $eixo]);
    }

    public function edit(string $id)
    {
        return view('eixos.edit')->with(['eixo' => Eixo::find($id)]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate($this->validationRules, $this->customMessages);
        
        $eixo = Eixo::find($id);

        if ($eixo) {
            $eixo->nome = $request->nome;

            $eixo->save();
            return redirect()->route('eixos.index')->with(['success'=>'Eixo '.$eixo->id.' atualizado com sucesso']);
        }
    }

    public function destroy(string $id)
    {
        $eixo = Eixo::find($id);

        if ($eixo) {
            $eixo->delete();
        }

        return redirect()->route('eixos.index')->with(['success'=>'Eixo '.$eixo->nome.' deletado com sucesso']);
    }
}
