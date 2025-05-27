<?php

namespace App\Http\Controllers;

use App\Models\Nivel;
use Illuminate\Http\Request;

class NivelController extends Controller
{
    protected $validationRules = [
        'nome' => 'required|min:3'
    ];

    protected $customMessages = [
        'nome.required' => 'O nome é obrigatório.',
        'nome.min' => 'O nome deve ter pelo menos 3 caracteres'
    ];

    public function index()
    {
        return view('niveis.index')->with(['niveis' => Nivel::all()]);
    }
    
    public function create()
    {
        return view('niveis.create');
    }
    
    public function store(Request $request)
    {
        $request->validate($this->validationRules, $this->customMessages);

        Nivel::create($request->all());
        return redirect()->route('niveis.index')->with(['success'=>'Nivel '.$request->nome.' criado com sucesso!']);
    }
    
    public function show(string $id)
    {
        return view('niveis.show')->with(['nivel' => Nivel::find($id)]);
    }
    
    public function edit(string $id)
    {
        return view('niveis.edit')->with(['nivel' => Nivel::find($id)]);
    }
    
    public function update(Request $request, string $id)
    {
        $request->validate($this->validationRules, $this->customMessages);
        
        $nivel = Nivel::find($id);

        if ($nivel) {
            $nivel->nome = $request->nome;

            $nivel->save();
            return redirect()->route('niveis.index')->with(['success'=>'Nivel '.$nivel->id.' atualizado com sucesso']);
        }
    }
    
    public function destroy(string $id)
    {
        $nivel = Nivel::find($id);

        if ($nivel) {
            $nivel->delete();
        }

        return redirect()->route('niveis.index')->with(['success'=>'Nivel '.$nivel->nome.' deletado com sucesso']);
    }
}
