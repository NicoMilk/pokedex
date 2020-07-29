<?php

namespace App\Http\Controllers;

use App\Http\Resources\Pokedex as ResourcesPokedex;
use Illuminate\Http\Request;
use App\Pokedex;

class PokedexController extends Controller
{
    public function index(Request $request)
    {
        return ResourcesPokedex::collection(Pokedex::join('Types', 'Pokedex.id_pok', '=', 'Types.id_pok')
        ->select('Pokedex.*', 'Types.*')
        ->get());
        
        // tODO : remplacer "data" par "pokemons"
        
        
        /*pokemons = Pokedex::join('Types', 'Pokedex.id_pok', '=', 'Types.id_pok')
                    ->select('Pokedex.*', 'Types.*')
                    ->get();
        
        $response = (object) ["pokemons" => $pokemons];
        return response()->json() ;*/
    }
    
    public function show($id)
    {
        //$id=$request->id_pok;
        $pokemon =Pokedex::join('Types', 'Pokedex.id_pok', '=', 'Types.id_pok')
                    ->join('Stats', 'Pokedex.id_pok', '=', 'Stats.pokemon_id')
                    //->join('Evolutions', 'Pokedex.id_pok', '=', 'Evolutions.id_pok_base')
                    ->join('Description', 'Pokedex.id_pok', '=', 'Description.pokemon_id')
                    ->join('Weaknesses', 'Pokedex.id_pok', '=', 'Weaknesses.pokedex_id')
                    ->select('Pokedex.*','Types.*','Evolutions.*','Stats.*','Description.*','Weaknesses.*')
                    ->where ('Pokedex.id_pok',$id)
                    ->get();
        $response = (object) ["pokemon"=>$pokemon];
        return response()->json($pokemon);
        
    }

}