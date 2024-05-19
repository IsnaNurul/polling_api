<?php

use App\Http\Controllers\API\PollController;
use App\Http\Controllers\API\ResultPollController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\VotingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(UserController::class)->group(function(){
    Route::post('login','login');
    Route::post('register','register');
    Route::post('logout','logout');
    Route::post('refresh','refresh');
    Route::post('reset','reset');
    Route::get('show','show');
});

Route::controller(PollController::class)->group(function(){
    Route::post('pollcreate','create');
    Route::get('pollshow', 'show');
    Route::post('showvote', 'showvote');
    Route::get('polldelete/{id_poll}','delete');
});

Route::controller(VotingController::class)->group(function(){
    Route::post('voting','create');
});

Route::controller(ResultPollController::class)->group(function(){
    Route::post('result', 'create');
    Route::post('cek', 'cek');
    Route::get('resultshow', 'resultshow');
});
