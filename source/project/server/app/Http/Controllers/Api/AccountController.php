<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Credentials;

class AccountController extends Controller
{
    public function getInfo()
    {
        return response()->json(
            Credentials::getApiClient()->account()->getCurrent()->toArray()
        );
    }
}