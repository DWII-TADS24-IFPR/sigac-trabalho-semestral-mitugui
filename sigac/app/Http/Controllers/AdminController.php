<?php

namespace App\Http\Controllers;

use App\Models\Documento;

class AdminController extends Controller
{
    public function index()
    {
        $documentosAtivos = Documento::where('status', 'pendente')->get();
        return view('admin')->with('documentos', $documentosAtivos);
    }
}
