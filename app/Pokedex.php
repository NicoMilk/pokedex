<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pokedex extends Model
{

    protected $table = 'Pokedex';

    protected $fillable = [
        
    ];

    public function types()
    {
        return $this->hasOne(Types::class);
    }

    public function user()
    {
        return $this->belongsToMany(User::class);
    }

    public function stats()
    {
        return $this->hasOne(Stats::class);

    }

    public function evolutions12()
    {
        return $this->hasOne(Stats::class);

    }

    public function evolutions23()
    {
        return $this->hasOne(Stats::class);

    }

    public function weakness()
    {
        return $this->hasOne(Stats::class);

    }


}


