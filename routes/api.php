<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\PropertyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
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


Route::get('/countries/{q}', [AddressController::class, 'countries']);
Route::get("/states", [AddressController::class, 'states']);
Route::get("/cities", [AddressController::class, 'cities']);

Route::resources([
    '/properties' => PropertyController::class
]);


Route::get('/test', function(){
    return User::take(10)->get();
});