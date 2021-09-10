<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contato extends Model
{
    protected $fillable = [
        'user_id',
        'nome',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function enderecos()
    {
        return $this->hasMany('App\Endereco');
    }

    public function telefones()
    {
        return $this->hasMany('App\Telefone');
    }

    public function tags()
    {
        return $this->hasMany('App\Tag');
    }
}
