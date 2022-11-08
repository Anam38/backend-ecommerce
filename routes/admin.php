<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Web\UserController;
use App\Http\Controllers\Web\CLientController;
use App\Http\Controllers\Web\ProductCategoriesController;
use App\Http\Controllers\Web\ProductCategoriesChildController;
use App\Http\Controllers\Web\ProductController;
use App\Http\Controllers\Web\BackIntegrationController;
use App\Http\Controllers\Web\FrontIntegrationController;

/*
|--------------------------------------------------------------------------
| API Routes TEST
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

Route::group(['prefix' => 'product-categories', 'middleware' => ['auth:api']], function () {
    Route::get('/', [ ProductCategoriesController::class, 'load' ]);
    Route::post('/store', [ ProductCategoriesController::class, 'store' ]);
    Route::post('/update', [ ProductCategoriesController::class, 'update' ]);
    Route::post('/destroy/{id}', [ ProductCategoriesController::class, 'destroy' ]);
});

Route::group(['prefix' => 'product-child-categories', 'middleware' => ['auth:api']], function () {
    Route::get('/', [ ProductCategoriesChildController::class, 'load' ]);
    Route::get('/findbycode/{code}', [ ProductCategoriesChildController::class, 'findByCode' ]);
    Route::post('/store', [ ProductCategoriesChildController::class, 'store' ]);
    Route::post('/update', [ ProductCategoriesChildController::class, 'update' ]);
    Route::post('/destroy/{id}', [ ProductCategoriesChildController::class, 'destroy' ]);
});

Route::group(['prefix' => 'products', 'middleware' => ['auth:api']], function () {
    Route::get('/', [ ProductController::class, 'load' ]);
    Route::post('/store', [ ProductController::class, 'store' ]);
    Route::get('/find/{id}', [ ProductController::class, 'find' ]);
    Route::post('/update', [ ProductController::class, 'update' ]);
    Route::post('/destroy/{id}', [ ProductController::class, 'destroy' ]);
});

Route::group(['prefix' => 'integration', 'middleware' => ['auth:api']], function () {
  Route::group(['prefix' => 'backend'], function () {
    Route::post('/', [ BackIntegrationController::class, 'generateSignatureToken' ]);
    Route::get('/get', [ BackIntegrationController::class, 'get' ]);
  });
  Route::group(['prefix' => 'frontend'], function () {
    Route::get('/get', [ FrontIntegrationController::class, 'getSignatureToken' ]);
    Route::get('/generate', [ FrontIntegrationController::class, 'generateSignatureToken' ]);
  });
});
