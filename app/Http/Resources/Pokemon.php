<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Pokemon extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return (object)
        ['Pokemon'=>
            [
                'id'=>$this->id_pok,
                'name'=>$this->nom_pok,
                'types'=>   ['type1'=>$this->type1,'type2'=>$this->type2],
                'image'=> str_pad($this->id_pok, 3,'0' ,STR_PAD_LEFT).'.png',
                'description'=>$this->description,
                'stats'=>   ['hp'=>$this->hp,
                            'attack'=>$this->attack,
                            'defense'=>$this->defense,
                            'special_attack'=>$this->sp_attack,
                            'special_defense'=>$this->sp_defense,
                            'speed'=>$this->speed],
            'weaknesses'=> [
                'bug'=>$this->bug,
                'dark'=>$this->dark,
                'dragon'=>$this->dragon ,
                'electric'=>$this->electric,
                'fairy'=>$this->fairy ,
                'fight'=>$this->fight ,
                'fire'=>$this->fire ,
                'flying'=>$this->flying ,
                'ghost'=>$this->ghost ,
                'grass'=>$this->grass ,
                'ground'=>$this->ground ,
                'ice'=>$this->ice ,
                'normal'=>$this->normal ,
                'poison'=>$this->poison ,
                'psychic'=>$this->psychic ,
                'rock'=>$this->rock,
                'steel'=>$this->steel ,
                'water'=>$this->water,
            ],            
            'evolutions'=>
                [
                'base_id'=>$this->id_pok_base,
                'evolution_id'=>$this->id_pok_evol,
                'required_lvl'=>$this->lvl_evol_pok
                ]
            ],
        
            
        ];}
}