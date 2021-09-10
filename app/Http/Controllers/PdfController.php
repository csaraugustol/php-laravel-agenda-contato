<?php

namespace App\Http\Controllers;

use PDF;
use App\Exports\ContatosExport;

class PdfController extends Controller
{
    public function retornaContPdf()
    {
        $contatos = ContatosExport::findAllContactsUser();

        $pdf = PDF::loadView('exportacao.pdf', ['contatos' => $contatos])
            ->setOptions(['defaultFont' => 'sans-serif']);

        return $pdf->stream('contatos.pdf');
    }
}
