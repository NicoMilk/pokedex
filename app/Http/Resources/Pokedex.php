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
        //return parent::toArray($request);
    
        return
        [
            'id'=>$this->id_pok,
            'name'=>$this->nom_pok,
            'types'=>['type 1'=>$this->type1,'type 2'=>$this->type2],
            'image'=>$this->id_pok.'.png',
        ];
    }
}
