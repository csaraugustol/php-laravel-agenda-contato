<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Contato;
use PDF;
use App\Exports\ContatosExport;


class PdfController extends Controller
{
    public function retornaContPdf()
    {


        $contatos = ContatosExport::query();


        $pdf = PDF::loadView('exportacao.pdf', ['contatos' => $contatos])->setOptions(['defaultFont' => 'sans-serif']);

        return $pdf->stream('contatos.pdf');
    }
}
