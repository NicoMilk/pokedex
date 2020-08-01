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

    public function trade(Request $request, $rec_id)
    {
        $id_pok = $request->pokemon_id;
        $count = Team::where('user_id', $rec_id)->count();

        if($count < 6)
        {
            Team::insert(['user_id' => $rec_id, 'id_pok' => $id_pok]);    // add pokemon tp receiver's team

            Team::where('user_id', Auth::id())  // delete pokemon from current user's team
                ->where('id_pok', $id_pok)
                ->first()
                ->delete();

            return response()->json([], 201);
        }

        return response()->json(['error' => 'Could not create ressource'], 500);
    }
}
