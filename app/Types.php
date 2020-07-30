<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Types extends Model
{
    protected $table = 'Types';
    protected $primarykey ='id';
    protected $fillable = ['id','id_pok','type1','type2'];

    public function pokedex()
    {
        return $this->belongstoMany(Pokedex::class,'id_pok');
    }
}
