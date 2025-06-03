<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Documento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocumentoController extends Controller
{
    protected $validationRules = [
        'url' => 'required|file|mimes:pdf',
        'descricao' => 'required|string|max:255',
        'horas_in' => 'required|numeric|min:1',
        'comentario' => 'nullable|string|max:1000',
        'horas_out' => 'nullable|numeric|min:0',
        'categoria_id' => 'required|exists:categorias,id',
    ];

    protected $customMessages = [
        'url.required' => 'O envio do documento é obrigatório.',
        'url.file' => 'O arquivo enviado deve ser um documento válido.',
        'url.mimes' => 'O documento deve estar no formato PDF (.pdf).',
    
        'descricao.required' => 'A descrição é obrigatória.',
        'descricao.string' => 'A descrição deve ser um texto válido.',
        'descricao.max' => 'A descrição deve ter no máximo 255 caracteres.',
    
        'horas_in.required' => 'O campo de horas inseridas é obrigatório.',
        'horas_in.numeric' => 'As horas inseridas devem ser numéricas.',
        'horas_in.min' => 'As horas inseridas devem ser maiores que 0.',
    
        'comentario.string' => 'O comentário deve ser um texto válido.',
        'comentario.max' => 'O comentário deve ter no máximo 1000 caracteres.',
    
        'horas_out.numeric' => 'As horas validadas devem ser numéricas.',
        'horas_out.min' => 'As horas validadas devem ser iguais ou maiores que 0.',
    
        'categoria_id.required' => 'A categoria é obrigatória.',
        'categoria_id.exists' => 'A categoria selecionada é inválida.',
    ];
    
    public function index()
    {
        return view('documentos.index')->with(['documentos' => Documento::all()]);
    }

    public function create()
    {
        return view('documentos.create')->with(['categorias' => Categoria::all()]);
    }

    public function store(Request $request)
    {
        $request->validate($this->validationRules, $this->customMessages);

        $urlPath = env('APP_URL').':8000/storage/'.$request->file('url')->store('documentos', 'public');

        Documento::create([
            'url' => $urlPath,
            'descricao' => $request->descricao,
            'horas_in' => $request->horas_in,
            'status' => 'pendente',
            'comentario' => $request->comentario,
            'horas_out' => $request->horas_out,
            'categoria_id' => $request->categoria_id,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('documentos.index')->with(['success'=>'Documento criado com sucesso!']);
    }

    public function show(string $id)
    {
        $documento = Documento::find($id);
        return view('documentos.show')->with(['documento' => $documento]);
    }

    public function destroy(string $id)
    {
        $documento = Documento::find($id);

        if ($documento) {
            $documento->delete();
        }

        return redirect()->route('documentos.index')->with(['success'=>'Documento '.$documento->id.' deletado com sucesso']);
    }
    
    public function aprovar($id)
    {
        $documento = Documento::find($id);
        $documento->status = 'aprovado';
        $documento->save();
    
        return redirect()->back()->with('success', 'Documento aprovado com sucesso!');
    }
    
    public function rejeitar($id)
    {
        $documento = Documento::find($id);
        $documento->status = 'rejeitado';
        $documento->save();
    
        return redirect()->back()->with('success', 'Documento rejeitado com sucesso!');
    }
}
