<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

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
        $this->registerOrLogin($user);

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
        $this->registerOrLogin($user);

        return response()->json([
            'data' => $user,
        ]);
    }

    //github
    public function getGithubAuth()
    {
        return Socialite::driver('github')->redirect();
    }

    public function getGithubCallback()
    {
        $user = Socialite::driver('github')->user();
        $this->registerOrLogin($user);

        return response()->json([
            'data' => $user,
        ]);
    }

    public function getFacebookAuth(){
        return Socialite::driver('facebook')->redirect();
    }

    public function getFacebookCallback(){
        $userSocial = Socialite::driver('facebook')->user();
        $this->registerOrLogin($userSocial);
    }

    public function getVKAuth(){
        return Socialite::driver('vkontakte')->redirect();
    }

    public function getVKCallback(Request $request)
    {
        $userSocial = Socialite::driver('vkontakte')->user();
        $this->registerOrLogin($userSocial);
    }

    private function registerOrLogin($user = null)
    {
        // dd($user->email);
        abort_if(!$user->email, 403, 'В запросе отсутствует email');
        $user = User::where('email', $user->email)->first();
        if ($user) {
            $token    = $user->createToken('mytoken')->plainTextToken;
            $response = [
                'user'  => $user,
                'token' => $token,
            ];
            return response($response, 201);
        } else {
            $password = User::generatePassword();
            $new_user = User::create(
                [
                    'name'     => $request->name ?? '',
                    'surname'  => $request->surname ?? '',
                    'email'    => $request->email ?? '',
                    'password' => User::createPassword($password),
                ]
            );
            $token    = $new_user->createToken('mytoken')->plainTextToken;
            $response = [
                'user'  => $new_user,
                'token' => $token,
            ];

            return response($response, 201);
        }
    }
}
