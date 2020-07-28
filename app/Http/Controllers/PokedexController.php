<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pokedex;

class PokedexController extends Controller
{
    public function index(Request $request)
    {
        
        $pokemons = Pokedex::join('Types', 'Pokedex.id_pok', '=', 'Types.id_pok')
                    ->select('Pokedex.*', 'Types.*')
                    ->get();
                

        $response = (object) ["pokemons" => $pokemons];
        
        return response()->json($pokemons) ;
    }

}
