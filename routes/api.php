<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Web\UserController;
use App\Http\Controllers\Web\CLientController;

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
Route::group(['prefix' => 'auth', 'middleware' => ['auth:api']], function () {
  Route::get('/', function(){
      return response()->json(auth()->user());
  });
});

Route::group(['prefix' => 'admin'], function () {
  Route::post('/login', [ LoginController::class, 'login' ]);
  Route::post('/logout', [ LoginController::class, 'logout' ])->middleware('auth:api');
});

Route::group(['prefix' => 'users', 'middleware' => ['auth:api']], function () {
    Route::get('/', [ UserController::class, 'load' ]);
    Route::post('/store', [ UserController::class, 'store' ]);
    Route::get('/update/{id}', [ UserController::class, 'find' ]);
    Route::post('/update', [ UserController::class, 'update' ]);
    Route::get('/destroy/{id}', [ UserController::class, 'destroy' ]);
});

Route::group(['prefix' => 'clients', 'middleware' => ['auth:api']], function () {
    Route::get('/', [ CLientController::class, 'load' ]);
    Route::post('/store', [ CLientController::class, 'store' ]);
    Route::get('/update/{id}', [ CLientController::class, 'find' ]);
    Route::post('/update', [ CLientController::class, 'update' ]);
    Route::get('/destroy/{id}', [ CLientController::class, 'destroy' ]);
});
