<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $fillable = [
        'cep',
        'endereco',
        'bairro',
        'cidade',
        'uf',
        'numero',
        'contato_id',
    ];

    public function contato()
    {
        return $this->belongsTo('App\Contato', 'contato_id');
    }
}
