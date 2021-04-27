<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GlobalController;

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

Route::post('/rut', [GlobalController::class, 'rut']);

Route::post('/nombrecompleto', [GlobalController::class, 'nombre']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
