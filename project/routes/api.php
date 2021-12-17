<?php

use App\Http\Controllers\ApiCrudController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\ApiRegisterController;
use App\Mail\UserApiMail;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Mail;

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

Route::apiResource('/data', ApiCrudController::class)
        ->only('store', 'update', 'index','show')->middleware('auth:sanctum');
        
Route::delete('/data/{id}', [ApiCrudController::class, 'destroy'])
        ->middleware('auth:sanctum');

//Auth Route    

Route::prefix('auth')->group(function(){
    Route::post('login', [ApiAuthController::class, 'login']);
    Route::post('logout', [ApiAuthController::class, 'logout'])->middleware('auth:sanctum');
    
});
 


