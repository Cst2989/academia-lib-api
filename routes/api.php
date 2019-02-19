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

Route::group(['prefix' => 'v1', 'middleware' => ['auth.basic']], function () {
    Route::get('authors/{email}', 'AuthorController@index');
    Route::get('authors/{email}/{authorId}', 'AuthorController@getAuthor');
    Route::put('authors/{email}/{authorId}', 'AuthorController@updateAuthor');
    Route::delete('authors/{email}/{authorId}', 'AuthorController@deleteAuthor');
    Route::post('authors/{email}', 'AuthorController@create');
});

Route::group(['prefix' => 'v1', 'middleware' => ['api','cors']], function () {
    Route::post('register', 'Auth\ApiRegisterController@register');
});

