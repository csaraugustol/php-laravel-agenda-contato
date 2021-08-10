<?php

namespace App\Http\Controllers;

use App\Contato;
use App\Exports\ContatosExport;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public function export() 
    {

      

        
       $contatosExcel =  ContatosExport::query();

      // dd($contatosExcel);

        //return Excel::download(new ContatosExport, 'contatos.xlsx');

        return   Excel::download(new ContatosExport, 'contatos.xlsx');

      
    }
}
