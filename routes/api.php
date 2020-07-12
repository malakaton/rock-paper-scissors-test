<?php

use Illuminate\Http\Request;

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

Route::group([
     'prefix' => 'rock-paper-scissors',
     'namespace'     => 'App\RockPaperScissors\UI\Api\Controllers\Components'
     ], static function () {
        Route::post('/play', 'GameController@play')->name('rock-paper-scissors.play');
    }
);