<?php

namespace App\Http\Controllers;

use App\Contato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Exibe todos os contatos do usuário logado.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contatos = Contato::where("user_id", Auth::user()
        ->id)
        ->orderBy('nome', 'asc')
        ->get();
        return view('contato.index', ['contatos' =>  $contatos]);
    }   
}
