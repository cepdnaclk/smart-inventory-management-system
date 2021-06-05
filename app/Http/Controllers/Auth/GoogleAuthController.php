<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Socialite;
use Auth;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
//        dd( Socialite::driver('google')->user());

        try {
            $user = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect('/login')->withErrors($e->getMessage());
        }

        // only allow people with @eng.pdn.ac.lk to login
        if(explode("@", $user->email)[1] !== 'eng.pdn.ac.lk'){
            return redirect()->to('/')->with('error', 'Please user an email ends with @eng.pdn.ac.lk for access.');
        }

        // check if they're an existing user
        $existingUser = User::where('email', $user->email)->first();

        if($existingUser){
            // log them in
            auth()->login($existingUser, true);

        } else {
            // create a new user
            $newUser                  = new User;
            $newUser->name            = $user->name;
            $newUser->honorific       = null;
            $newUser->email           = $user->email;
            $newUser->google_id       = $user->id;
            $newUser->avatar          = $user->avatar;
            $newUser->email_verified_at = now();    // No need to verify emails

            $newUser->save();
            auth()->login($newUser, true);

        }
        return redirect()->route('welcome');
    }

}
