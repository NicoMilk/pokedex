<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {        
        
        $this->authorize ('manage', $user);
        return view ('profile.edit', compact ('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        
        $this->authorize ('manage', $user);
        
        $request->validate ([
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'name' => ['required', 'string', 'max:255'],
            'avatar' => ['required', 'string', 'max:20'],
            
        ]);
        
        $user->update ([
            'email' => $request->email,
            'name' => $request->name,
            'avatar' => $request->avatar
        ]);
        
        return back ()->with ('status', __ ('Profile has been updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
