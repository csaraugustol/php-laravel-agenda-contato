<?php

namespace App\Exports;

use App\Contato;
use Maatwebsite\Excel\Concerns\FromCollection;

class ContatosExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Contato::all();
    }
}
