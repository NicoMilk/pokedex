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
        
        // tODO : remplacer "data" par "pokemons"
        
        /*$response = (object) ["pokemons" => $pokemons];
        return response()->json() ;*/
    }
    
    public function show($id)
    {
        /*return ResourcesPokemon::collection(Pokedex::join('Types', 'Pokedex.id_pok', '=', 'Types.id_pok')
                ->join('Stats', 'Pokedex.id_pok', '=', 'Stats.pokemon_id')
                //->join('Evolutions', 'Pokedex.id_pok', '=', 'Evolutions.id_pok_base')
                ->join('Description', 'Pokedex.id_pok', '=', 'Description.pokemon_id')
                ->join('Weaknesses', 'Pokedex.id_pok', '=', 'Weaknesses.pokedex_id')
                ->select('Pokedex.*','Types.*','Stats.*','Description.*','Weaknesses.*')
                ->where ('Pokedex.id_pok',$id)
                ->get());*/
                $requeteEvolutions=Pokedex::join('Evolutions','Pokedex.id_pok','=','Evolutions.id_pok_base')
                                    ->where('Pokedex.id_pok',$id)
                                    ->get();
                //dd($requeteEvolutions);
                
                if (count($requeteEvolutions)!=0)
                {
                    $request= ResourcesPokemon::collection(Pokedex::join('Types', 'Pokedex.id_pok', '=', 'Types.id_pok')
                    ->join('Stats', 'Pokedex.id_pok', '=', 'Stats.pokemon_id')
                    ->join('Evolutions', 'Pokedex.id_pok', '=', 'Evolutions.id_pok_base')
                    ->join('Description', 'Pokedex.id_pok', '=', 'Description.pokemon_id')
                    ->join('Weaknesses', 'Pokedex.id_pok', '=', 'Weaknesses.pokedex_id')
                    //->join('Evolutions', function ($join) {$join->on('Pokedex.id_pok','=','Evolutions.id_pok_base');})
                        //->orOn('Pokedex.id_pok','=','Evolutions.id_pok_evol');})              
                    ->select('Pokedex.*','Types.*','Stats.*','Description.*','Weaknesses.*','Evolutions.*')
                    ->where ('Pokedex.id_pok',$id)
                    ->get());    
                     
                }
                else 
                {
                    $request=ResourcesPokemon::collection(Pokedex::join('Types', 'Pokedex.id_pok', '=', 'Types.id_pok')
                    ->join('Stats', 'Pokedex.id_pok', '=', 'Stats.pokemon_id')
                    ->join('Description', 'Pokedex.id_pok', '=', 'Description.pokemon_id')
                    ->join('Weaknesses', 'Pokedex.id_pok', '=', 'Weaknesses.pokedex_id')             
                    ->select('Pokedex.*','Types.*','Stats.*','Description.*','Weaknesses.*',)
                    ->where ('Pokedex.id_pok',$id)
                    ->get());    
                }
                return $request;



                /*return ResourcesPokemon::collection(Pokedex::join('Types', 'Pokedex.id_pok', '=', 'Types.id_pok')
                ->join('Stats', 'Pokedex.id_pok', '=', 'Stats.pokemon_id')
                //->join('Evolutions', 'Pokedex.id_pok', '=', 'Evolutions.id_pok_base')
                ->join('Description', 'Pokedex.id_pok', '=', 'Description.pokemon_id')
                ->join('Weaknesses', 'Pokedex.id_pok', '=', 'Weaknesses.pokedex_id')
                ->join('Evolutions', function ($join) {$join->on('Pokedex.id_pok','=','Evolutions.id_pok_base');})
                    //->orOn('Pokedex.id_pok','=','Evolutions.id_pok_evol');})              
                ->select('Pokedex.*','Types.*','Stats.*','Description.*','Weaknesses.*','Evolutions.*')
                ->where ()
                ->get()
            );     
         */
    }

}