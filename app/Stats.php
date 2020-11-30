<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stats extends Model
{

    protected $table = 'Stats';
    
    public function pokedex()
    {
        return $this->hasOne(Pokedex::class);
    }
}
