<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(Request $request)
    {
        
        $users = User::all();
        // $users = DB::table('users')->get();
        
        $response = (object) ["users" => $users];
        
        return response()->json($response) ;
    }

}
