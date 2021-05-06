<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('list',[RegisterController::class,'list']);
Route::post('add',[RegisterController::class,'add']);
Route::get('edit/{id}',[RegisterController::class,'edit']);
Route::post('update/{id}',[RegisterController::class,'update']);
Route::get('delete/{id}',[RegisterController::class,'delete']);

// Route::get('/users',[RegisterController::class,'index']);


