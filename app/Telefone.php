<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Telefone extends Model
{


    protected $fillable = [
        'endereco',
        'contato_id'
    ]; 

    public function contato(){

        return $this->belongsTo('App\Contato', 'contato_id');
    }
}

