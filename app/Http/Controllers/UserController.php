<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::select('users.id as user_id', 'users.name as username', 'users.avatar as profile-icon_id')
            ->get();
        $response = (object) ["users" => $users];
        return response()->json($response) ;
    }

    public function show($id)
    {
        $user = User::select('users.id as user_id', 'users.name as username', 'users.avatar as profile-icon_id')
            ->where('users.id',$id)
            ->get();
        $response = (object) ["user" => $user];
        return response()->json($response) ;
    }


}
