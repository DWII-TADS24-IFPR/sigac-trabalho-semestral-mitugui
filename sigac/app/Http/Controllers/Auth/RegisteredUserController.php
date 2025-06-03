<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Aluno;
use App\Models\Curso;
use App\Models\Turma;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        
        return view('auth.register')->with(['cursos' => Curso::all(), 'turmas' => Turma::all()]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $validationRules = [
            'name' => 'required|string|max:255',
            'cpf' => 'required|string|size:14|unique:alunos,cpf',
            'email' => 'required|string|lowercase|email|max:255|unique:users,email',
            'password' => 'required|confirmed|string|min:8',
            'curso_id' => 'required|exists:cursos,id',
            'turma_id' => 'required|exists:turmas,id',
        ];

        $customMessages = [
            'name.required' => 'O nome é obrigatório.',
            'name.string' => 'O nome deve ser uma string.',
            'name.max' => 'O nome não pode exceder :max caracteres.',

            'cpf.required' => 'O CPF é obrigatório.',
            'cpf.string' => 'O CPF deve ser uma string.',
            'cpf.size' => 'O CPF deve conter exatamente 11 dígitos.',
            'cpf.unique' => 'Este CPF já está cadastrado.',

            'email.required' => 'O e-mail é obrigatório.',
            'email.string' => 'O e-mail deve ser uma string.',
            'email.lowercase' => 'O e-mail deve estar em letras minúsculas.',
            'email.email' => 'O e-mail deve ser válido.',
            'email.max' => 'O e-mail não pode exceder :max caracteres.',
            'email.unique' => 'Este e-mail já está cadastrado.',

            'password.required' => 'A senha é obrigatória.',
            'password.confirmed' => 'A confirmação da senha não coincide.',
            'password.min' => 'A senha deve ter pelo menos :min caracteres.',

            'curso_id.required' => 'O curso é obrigatório.',
            'curso_id.exists' => 'O curso selecionado é inválido.',

            'turma_id.required' => 'A turma é obrigatória.',
            'turma_id.exists' => 'A turma selecionada é inválida.',
        ];

        $request->validate($validationRules, $customMessages);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'aluno'
        ]);

        Aluno::create([
            'nome' => $request->name,
            'cpf' => $request->cpf,
            'email' => $request->email,
            'senha' => Hash::make($request->password),
            'user_id' => $user->id,
            'curso_id' => $request->curso_id,
            'turma_id' => $request->turma_id,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
