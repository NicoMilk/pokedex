<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Team;
use Auth;   //added for users/me/team

class TeamController extends Controller
{
    public function team($id)
    {
        if($id == "me")
        {
            $id = Auth::user()->id;
        }

            $team = Team::select('teams.id_pok as pokemon_id')
                ->where('teams.user_id',$id)
                ->get();

            $response = (object) ["team" => $team];
            return response()->json($response);

    }

    public function update(request $request)
    {

    }

}
