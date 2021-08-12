<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\SocialUser;

class SocialController extends Controller
{
    //linkedIn
    public function getLinkedInAuth()
    {
        return Socialite::driver('linkedin')->redirect();
    }

    public function getLinkedInCallback()
    {
        $user = Socialite::driver('linkedin')->user();
        return $this->registerOrLogin($user, 1);
    }

    //github
    public function getGithubAuth()
    {
        return Socialite::driver('github')->redirect();
    }

    public function getGithubCallback()
    {
        $user = Socialite::driver('github')->user();
        return $this->registerOrLogin($user, 2);
    }

    //google
    public function getGoogleAuth()
    {
        return Socialite::driver('google')->redirect();
    }

    public function getGoogleCallback()
    {
        $user = Socialite::driver('google')->user();
        return $this->registerOrLogin($user, 3);
    }

    public function getVKAuth()
    {
        return Socialite::driver('vkontakte')->redirect();
    }

    public function getVKCallback(Request $request)
    {
        $userSocial = Socialite::driver('vkontakte')->user();
        return $this->registerOrLogin($userSocial, 4);
    }

    public function getFacebookAuth()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function getFacebookCallback()
    {
        $userSocial = Socialite::driver('facebook')->user();
        return $this->registerOrLogin($userSocial, 5);
    }

    public function getOKAuth()
    {
        return Socialite::driver('odnoklassniki')->redirect();
    }

    public function getOKCallback(Request $request)
    {
        $userSocial = Socialite::driver('odnoklassniki')->user();
        return $this->registerOrLogin($userSocial, 6);
    }

    private function registerOrLogin($userSocial = null, $social_id = null)
    {
        abort_if(!$userSocial->email, 403, 'В запросе отсутствует email');
        $user = User::where('email', $userSocial->email)->first();
        if ($user) {
            $token = $user->createToken('mytoken')->plainTextToken;
        } else {
            $password = User::generatePassword();
            $user     = User::create(
                [
                    'name'     => $userSocial->name ?? '',
                    //'surname'  => $request->surname ?? '',
                    'email'    => $userSocial->email ?? '',
                    'password' => User::createPassword($password),
                ]
            );
            $token    = $user->createToken('mytoken')->plainTextToken;
        }
        $social_info = SocialUser::updateOrCreate(
            [
                'user_id'        => $user->id,
                'social_id'      => $social_id,
                'social_user_id' => $userSocial->id ?? 0,
                'name'           => $userSocial->name ?? '',
                'email'          => $userSocial->email ?? '',
                'avatar'         => $userSocial->avatar ?? '',
                //'code' => $request->code ?? ''
            ],
            [
                'token'       => $userSocial->token,
                'expires_in'     => $userSocial->expiresIn ?? '',
                'user_object' => (isset($userSocial->user)) ? serialize($userSocial->user) : '',
            ]
        );
        $response    = [
            'token'       => $token,
            'user'        => $user,
            'social_info' => $social_info,
        ];

        return response()->json($response, 201);
    }
}
