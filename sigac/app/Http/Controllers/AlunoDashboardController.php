<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AlunoDashboardController extends Controller
{
    public function index()
    {
        return view('aluno');
    }
}
