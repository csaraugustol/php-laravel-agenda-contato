<?php

namespace App\Http\Controllers;

use App\Exports\ContatosExport;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public function export()
    {
        $contatosExcel =  ContatosExport::findAllContactsUser();

        return   Excel::download(new ContatosExport, 'contatos.xlsx');
    }
}
