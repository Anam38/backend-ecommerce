<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Api\CLientController;
use App\Http\Controllers\Api\ProductCategoriesController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\BackIntegrationController;

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
Route::group(['prefix' => 'auth', 'middleware' => ['auth:client']], function () {
  Route::get('/', function(){
      return response()->json(auth()->user());
  });
  Route::post('/logout', [ LoginController::class, 'logout' ]);
});

Route::group(['prefix' => 'clients', 'middleware' => ['client']], function () {
    Route::get('/registration', [ CLientController::class, 'registration' ]);
});

Route::group(['prefix' => 'product-categories', 'middleware' => ['client']], function () {
    Route::get('/', [ ProductCategoriesController::class, 'load' ]);
    Route::get('/category-child-join', [ ProductCategoriesController::class, 'joinCategoryChildTable' ]);
});

Route::group(['prefix' => 'products'], function () {
    Route::get('/', [ ProductController::class, 'load' ])->middleware('client');
    Route::get('/f/{id}', [ ProductController::class, 'find' ])->middleware('client');
    Route::get('/new', [ ProductController::class, 'new' ])->middleware('client');
    Route::get('/popular', [ ProductController::class, 'popular' ])->middleware('client');
    Route::get('/bycategories', [ ProductController::class, 'bycategories' ])->middleware('client');
    Route::get('/related', [ ProductController::class, 'randomeByCategories' ])->middleware('client');
});

Route::group(['prefix' => 'integration'], function () {
    Route::get('/client_token', [ BackIntegrationController::class, 'credentialToken' ])->middleware('client_access');
});
