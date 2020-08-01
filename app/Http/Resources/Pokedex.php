<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Pokedex extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    //public static $wrap="pokemons";

    public function toArray($request)
    {
    
        return
        [
            'id'=>$this->id_pok,
            'name'=>$this->nom_pok,
            'types'=>['type1'=>$this->type1,'type2'=>$this->type2],
            'image'=> str_pad($this->id_pok, 3,"0" ,STR_PAD_LEFT).'.png',
        ];
    }
}
