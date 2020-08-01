<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;   //added for users/me

class UserController extends Controller
{
    public function index(Request $request)
    {
        //$this->middleware('auth');
        $users = User::select('users.id as user_id', 'users.name as username', 'users.avatar as profile_icon_id')
            ->get();
        $response = (object) ["users" => $users];
        return response()->json($response) ;     
    }

    public function show($id)
    {
        if($id == "me")
        {
            $id = Auth::user()->id;
        }

            $user = User::select('users.id as user_id', 'users.name as username', 'users.avatar as profile_icon_id')
                ->where('users.id',$id)
                ->get();
            $response = (object) ["user" => $user];
            return response()->json($response);
    }

    public function update(Request $request)
    {
        $userId = Auth::id();
        $user = User::findOrFail($userId);

        $request->validate([
            'name' => ['required', 'string', 'min:1', 'max:255'],    // TODO: check name unique ?
            'avatar' => ['required', 'string', 'min:1', 'max:2'],   // TODO: turn avatar type into integer
        ]);

        $user->fill([
            'name' => $request->name,
            'avatar' => $request->avatar
        ]);

        $user->save();

        $response = (object) ["username" => $user->name, "profile-icon_id" => $user->avatar];
        return response()->json($response);
    }

}
