<?php

use App\Http\Controllers\Api\AccountController;
use App\Http\Controllers\Api\AmoController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\CredentialsController;
use App\Http\Controllers\Api\LeadController;
use App\Http\Controllers\SoloCredentialsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('credentials', CredentialsController::class);
Route::get('account-get-info', [AccountController::class, 'getInfo']);

Route::get('contacts-get-info', [ContactController::class, 'getInfo']);
Route::post('contacts-set-one', [ContactController::class, 'setOne']);

Route::get('lead-get-info', [LeadController::class, 'getInfo']);
Route::post('lead-set-one', [LeadController::class, 'setLeadOne']);
Route::get('lead-up-one', [LeadController::class, 'oneUpdate']);

Route::post('amo-crm', [LeadController::class, 'amoCRM']);
