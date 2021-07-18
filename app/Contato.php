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
        'nome',
        'endereco' => 'array',
        'telefone' => 'array'
    ];

   
    

    public function user()
    {

        return $this->belongsTo(User::class);
    }

    public function enderecos()
    {
        return $this->hasMany(Endereco::class);
    }

    public function telefones()
    {
        return $this->hasMany(Telefone::class);
    }

    
}
