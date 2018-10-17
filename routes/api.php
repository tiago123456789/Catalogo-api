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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix("/categories")
    ->middleware(["auth:api", "handler.exception"])
    ->group(function() {
        Route::get("/", "CategoryController@findAll");
        Route::get("/{id}", "CategoryController@findById");
        Route::post("/", "CategoryController@create");
        Route::put("/{id}", "CategoryController@update");
        Route::delete("/{id}", "CategoryController@destroy");
     });

Route::prefix("/products")
    ->middleware(["auth:api", "handler.exception"])
    ->group(function() {
        Route::get("/", "ProductController@findAll");
        Route::get("/{id}", "ProductController@findById");
        Route::post("/", "ProductController@create");
        Route::put("/{id}", "ProductController@update");
        Route::delete("/{id}", "ProductController@destroy");

        Route::post("/{idProduct}/prices", "ProductController@createPriceProduct");
        Route::put("/{idProduct}/prices/{idPrice}", "ProductController@updatePriceProduct");
        Route::delete("/{idProduct}/prices/{idPrice}", "ProductController@destroyPriceProduct");
    });


Route::prefix("/auth")
    ->group(function() {
        Route::post("/login", "AuthController@login");
        Route::get("/logout", "AuthController@logout");
        Route::get("/token/refresh", "AuthController@refresh");
    });