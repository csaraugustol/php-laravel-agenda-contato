<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Contato;
use App\Telefone;
use App\Endereco;
use PDF;


class PdfController extends Controller
{
    public function retornaContPdf()
    {

        $id =  Auth::user()->id;

        $contatos = Contato::with('telefones','enderecos')->where("user_id", $id)
            ->orderBy('nome', 'asc')
            ->get();


        $pdf = PDF::loadView('exportacao.pdf', ['contatos' => $contatos])->setOptions(['defaultFont' => 'sans-serif']);

        return $pdf->stream('contatos.pdf');
    }
}
