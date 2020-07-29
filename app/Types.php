<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Types extends Model
{
    protected $table = 'Types';
    public function pokedex()
    {
        return $this->hasOne(Pokedex::class,'id_pok');
    }
}
