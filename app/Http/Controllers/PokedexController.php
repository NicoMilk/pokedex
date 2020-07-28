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
        
<<<<<<< HEAD
        return response()->json($pokemons) ;
=======
        return response()->json($response);
>>>>>>> 5deffc5a0e6c572c10675d8d451c56aac353f17b
    }

}
