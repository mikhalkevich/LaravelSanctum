<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    //google
    public function getGoogleAuth()
    {
        return Socialite::driver('google')->redirect();
    }

    public function getGoogleCallback()
    {
        $user = Socialite::driver('google')->user();

        return response()->json([
            'data' => $user,
        ]);
    }

    //linkedIn
    public function getLinkedInAuth()
    {
        return Socialite::driver('linkedin')->redirect();
    }

    public function getLinkedInCallback()
    {

            $user = Socialite::driver('linkedin')->user();
        return response()->json([
            'data' => $user,
        ]);
    }
}
