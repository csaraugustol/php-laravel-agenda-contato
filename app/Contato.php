<?php

namespace App;

use App\User;
use App\Endereco;
use App\Telefone;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Contato extends Model
{

    protected $fillable = [
        'user_id',
        'nome'
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
