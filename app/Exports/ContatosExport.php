<?php

namespace App\Exports;

use App\Contato;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\Auth;

class ContatosExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $c = Contato::with('telefones','enderecos')->where("user_id", Auth::user()->id)
        ->orderBy('nome', 'asc')
        ->get();


        return $c;
    }


    public static function query()
    {
        $c = Contato::with('telefones','enderecos')->where("user_id", Auth::user()->id)
        ->orderBy('nome', 'asc')
        ->get();
        

        return $c;
    }

  
}

