<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CredentialsRequest;
use App\Services\Credentials;

class CredentialsController extends Controller
{
    public function __invoke(CredentialsRequest $request)
    {
        Credentials::getAndSaveToken($request->code);
        return response()->json(['message' => 'Токен получен успешно.']);
    }
}
