<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'tag',
        'contato_id'
    ]; 

    public function contato(){

        return $this->belongsTo('App\Contato', 'contato_id');
    }
}
