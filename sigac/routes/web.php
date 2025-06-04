<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\AlunoDashboardController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ComprovanteController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\DeclaracaoController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\EixoController;
use App\Http\Controllers\NivelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TurmaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});


Route::get('/redirect-by-role', function () {
    $role = auth()->user()->role;

    return match ($role) {
        'admin' => redirect()->route('admin.dashboard'),
        'aluno' => redirect()->route('aluno.dashboard'),
        default => abort(403),
    };
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::resource('/alunos', AlunoController::class);
    Route::resource('/categorias', CategoriaController::class);
    Route::resource('/comprovantes', ComprovanteController::class);
    Route::resource('/cursos', CursoController::class);
    Route::resource('/declaracoes', DeclaracaoController::class);
    Route::patch('/documentos/{id}/aprovar', [DocumentoController::class, 'aprovar'])->name('documentos.aprovar');
    Route::patch('/documentos/{id}/rejeitar', [DocumentoController::class, 'rejeitar'])->name('documentos.rejeitar');
    Route::resource('/eixos', EixoController::class);
    Route::resource('/niveis', NivelController::class);
    Route::resource('/turmas', TurmaController::class);
});

Route::middleware(['auth', 'role:aluno'])->group(function () {
    Route::get('/aluno/dashboard', [AlunoDashboardController::class, 'index'])->name('aluno.dashboard');

    Route::get('/aluno', function () {
        return view('aluno');
    });

    Route::resource('/documentos', DocumentoController::class);

    Route::get('/aluno/declaracao', [AlunoDashboardController::class, 'gerarDeclaracao'])->name('aluno.declaracao');
});

require __DIR__.'/auth.php';
