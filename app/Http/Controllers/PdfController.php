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

        $contatos = Contato::where("user_id", $id)
            ->orderBy('nome', 'asc')
            ->get();


        //    dd($contatos);

        $tels = Telefone::where("contato_id",  130)->get();


        $enderecos = Endereco::where("contato_id",  130)->get();



        $pdf = PDF::loadView('exportacao.pdf', ['contatos' => $contatos, 'tels' => $tels, 'enderecos' => $enderecos])->setOptions(['defaultFont' => 'sans-serif']);

        return $pdf->stream('contatos.pdf');
    }
}
