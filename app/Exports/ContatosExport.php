<?php

namespace App\Exports;

use App\Contato;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\Auth;

class ContatosExport implements FromCollection
{
    /**
     *Faz busca filtrada de contatos do usuários
     *para exportação
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $allContactsUser = Contato::with('telefones', 'enderecos')
            ->where("user_id", Auth::user()->id)
            ->orderBy('nome', 'asc')
            ->get();

        return $allContactsUser;
    }

    /**
     * Faz busca filtrada de contatos do usuários
     * para exportação
     * @return \Illuminate\Support\Collection
     */
    public static function findAllContactsUser()
    {
        $c = Contato::with('telefones', 'enderecos')
            ->where("user_id", Auth::user()->id)
            ->orderBy('nome', 'asc')
            ->get();

        return $c;
    }
}
