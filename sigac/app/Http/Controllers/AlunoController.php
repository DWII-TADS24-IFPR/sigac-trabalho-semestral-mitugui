<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Curso;
use App\Models\Turma;
use Illuminate\Http\Request;

class AlunoController extends Controller
{
    protected $validationRules = [
        'nome' => 'required|string|max:255',
        'cpf' => 'required|string|size:14|unique:alunos,cpf',
        'email' => 'required|email|unique:alunos,email',
        'senha' => 'required|string|min:6',
        'curso_id' => 'required|exists:cursos,id',
        'turma_id' => 'required|exists:turmas,id',
    ];

    protected $customMessages = [
        'nome.required' => 'O nome é obrigatório.',
        'cpf.required' => 'O CPF é obrigatório.',
        'cpf.size' => 'O CPF deve conter exatamente 11 números.',
        'cpf.unique' => 'Este CPF já está cadastrado.',
        'email.required' => 'O e-mail é obrigatório.',
        'email.email' => 'O e-mail deve ser válido.',
        'email.unique' => 'Este e-mail já está cadastrado.',
        'senha.required' => 'A senha é obrigatória.',
        'senha.min' => 'A senha deve ter pelo menos :min caracteres.',
        'curso_id.required' => 'O curso é obrigatório.',
        'curso_id.exists' => 'O curso selecionado é inválido.',
        'turma_id.required' => 'A turma é obrigatória.',
        'turma_id.exists' => 'A turma selecionada é inválida.',
    ];     
    protected $updateValidationRules = [
        'nome' => 'required|string|max:255',
        'cpf' => 'required|string|size:14',
        'email' => 'required|email',
        'senha' => 'required|string|min:6',
        'curso_id' => 'required|exists:cursos,id',
        'turma_id' => 'required|exists:turmas,id',
    ];

    protected $updateCustomMessages = [
        'nome.required' => 'O nome é obrigatório.',
        'cpf.required' => 'O CPF é obrigatório.',
        'cpf.size' => 'O CPF deve conter exatamente 11 números.',
        'email.required' => 'O e-mail é obrigatório.',
        'email.email' => 'O e-mail deve ser válido.',
        'senha.required' => 'A senha é obrigatória.',
        'senha.min' => 'A senha deve ter pelo menos :min caracteres.',
        'curso_id.required' => 'O curso é obrigatório.',
        'curso_id.exists' => 'O curso selecionado é inválido.',
        'turma_id.required' => 'A turma é obrigatória.',
        'turma_id.exists' => 'A turma selecionada é inválida.',
    ];     
    
    public function index()
    {
        return view('alunos.index')->with(['alunos' => Aluno::all()]);
    }

    public function create()
    {
        return view('alunos.create')->with(['cursos' => Curso::all(), 'turmas' => Turma::all()]);
    }

    public function store(Request $request)
    {
        $request->validate($this->validationRules, $this->customMessages);

        Aluno::create([
            'nome' => $request->nome,
            'cpf' => $request->cpf,
            'email' => $request->email,
            'senha' => $request->senha,
            'curso_id' => $request->curso_id,
            'turma_id' => $request->turma_id,
        ]);

        return redirect()->route('alunos.index')->with(['success'=>'Aluno (a) '.$request->nome.' criado (a) com sucesso!']);
    }

    public function show(string $id)
    {
        $aluno = Aluno::find($id);
        return view('alunos.show')->with(['aluno' => $aluno, 'aluno_curso' => $aluno->curso, 'aluno_turma' => $aluno->turma]);
    }

    public function edit(string $id)
    {
        return view('alunos.edit')->with(['aluno' => Aluno::find($id), 'cursos' => Curso::all(), 'turmas' => Turma::all()]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate($this->updateValidationRules, $this->updateCustomMessages);
        
        $aluno = Aluno::find($id);

        if ($aluno) {
            $aluno->nome = $request->nome;
            $aluno->cpf = $request->cpf;
            $aluno->email = $request->email;
            $aluno->senha = $request->senha;
            $aluno->curso_id = $request->curso_id;
            $aluno->turma_id = $request->turma_id;

            $aluno->save();
            return redirect()->route('alunos.index')->with(['success'=>'Aluno '.$aluno->id.' atualizado com sucesso']);
        }
    }

    public function destroy(string $id)
    {
        $aluno = Aluno::find($id);

        if ($aluno) {
            $aluno->delete();
        }

        return redirect()->route('alunos.index')->with(['success'=>'Aluno (a) '.$aluno->nome.' deletado (a) com sucesso']);
    }
}
