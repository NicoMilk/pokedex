<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use App\Team;
use Auth;   //added for users/me/team



class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home'; //RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated()
    {
        $user = Auth::user();

        $now = new \DateTime();
        $today = $now->format('Y-m-d');
        
        if ($user->last_gift_at) {
        
            $lastGifted = (new \DateTime($user->last_gift_at))->format('Y-m-d');
            $isElligible = ($today != $lastGifted);

        } else {
            
            $isElligible = true;
        }
        

        if ( $isElligible ) {

            $team = Team::select('teams.id_pok as pokemon_id')
            ->where('teams.user_id',$user->id)
            ->get();

            $count = Team::where('user_id', $user->id)->count();

            if($count < 6) {

                $gift = random_int(1, 151);
                Team::insert(['user_id' => $user->id, 'id_pok' => $gift]);

                $user->fill(['last_gift_at' => $today]);
                $user->save();
            }

        }
    }
}


