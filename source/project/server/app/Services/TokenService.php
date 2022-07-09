<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use League\OAuth2\Client\Token\AccessToken;

class TokenService
{
    public static function get(): AccessToken
    {
        $token = json_decode(File::get(storage_path('app/token.json')), 1);
        //---
        return new AccessToken($token);
    }

    public static function save(AccessToken $token): void {
        $array = [
            'access_token' => $token->getToken(),
            'refresh_token' => $token->getRefreshToken(),
            'expires' => $token->getExpires()
        ];

        File::put(
            storage_path('app/token.json'),
            json_encode($array, JSON_PRETTY_PRINT)
        );
    }
}
