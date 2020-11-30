<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pokedex extends Model
{

    protected $table = 'Pokedex';

    protected $primarykey='id_pok';
    protected $fillable = ['id_pok','nom_pok'];

    public function types()
    {
        return $this->hasMany(Types::class,'id_pok');
    }

    public function user()
    {
        return $this->belongsToMany(User::class);
    }

    public function stats()
    {
        return $this->hasOne(Stats::class);

    }

    public function evolutions()
    {
        return $this->hasMany(Evolutions::class);

    }

    /*public function evolutions23()
    {
        return $this->hasOne(Stats::class);

    }*/

    public function weakness()
    {
        return $this->hasOne(Weaknesses::class);

    }
    public function description()
    {
        return $this->hasOne(Description::class);

    }

    public function Teams()
    {
        return $this->hasOne(Teams::class);

    }

}


