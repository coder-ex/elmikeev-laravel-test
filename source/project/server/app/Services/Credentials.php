<?php

namespace App\Services;

use AmoCRM\Client\AmoCRMApiClient;
use League\OAuth2\Client\Token\AccessTokenInterface;

class Credentials
{
    public static function getAndSaveToken(string $code): void
    {
        $apiClient = self::makeApiClient();
        $token = $apiClient->getOAuthClient()->getAccessTokenByCode($code);
        TokenService::save($token);
    }

    public static function makeApiClient(): AmoCRMApiClient
    {
        $apiClient = new AmoCRMApiClient(
            config('services.amocrm.integration_id'),
            config('services.amocrm.secret_key'),
            config('services.amocrm.redirect_url')
        );
        //---
        return $apiClient->setAccountBaseDomain(
            config('services.amocrm.domain')
        );
    }

    public static function getApiClient(): AmoCRMApiClient
    {
        $apiClient = self::makeApiClient();
        $apiClient->setAccessToken(TokenService::get());
        $apiClient->onAccessTokenRefresh(
            function (AccessTokenInterface $accessToken) {
                TokenService::save($accessToken);
            }
        );
        //---
        return $apiClient;
    }
}
