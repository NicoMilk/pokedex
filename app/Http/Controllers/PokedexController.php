<?php

namespace App\Http\Controllers;

use App\Http\Resources\Pokedex as ResourcesPokedex;
use App\Http\Resources\Pokemon as ResourcesPokemon;
use Illuminate\Http\Request;
use App\Pokedex;

class PokedexController extends Controller
{
    public function index(Request $request)
    {
        return ResourcesPokedex::collection(Pokedex::join('Types', 'Pokedex.id_pok', '=', 'Types.id_pok')
        ->select('Pokedex.*', 'Types.*')
        ->get());
    }
    
    public function show($id)
    {
        $request=ResourcesPokemon::collection(Pokedex::join('Types', 'Pokedex.id_pok', '=', 'Types.id_pok')
        ->join('Stats', 'Pokedex.id_pok', '=', 'Stats.pokemon_id')
        ->join('Description', 'Pokedex.id_pok', '=', 'Description.pokemon_id')
        ->join('Weaknesses', 'Pokedex.id_pok', '=', 'Weaknesses.pokedex_id')  
        ->leftJoin('Evolutions','Pokedex.id_pok','=','Evolutions.id_pok_base')    
        ->select('Pokedex.*','Types.*','Stats.*','Description.*','Weaknesses.*','Evolutions.*')
        ->where ('Pokedex.id_pok',$id)
        ->get()); 
        
        return $request;
    }
}