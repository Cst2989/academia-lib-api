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

    Route::get('authors/{sandbox}', 'AuthorController@index');
    Route::get('authors/{sandbox}/{authorId}', 'AuthorController@getAuthor');
    Route::put('authors/{sandbox}/{authorId}', 'AuthorController@updateAuthor');
    Route::delete('authors/{sandbox}/{authorId}', 'AuthorController@deleteAuthor');
    Route::post('authors/{sandbox}', 'AuthorController@create');


    Route::get('books/{sandbox}', 'BooksController@index');
    Route::get('books/{sandbox}/{bookId}', 'BooksController@getBook');
    Route::put('books/{sandbox}/{bookId}', 'BooksController@updateBook');
    Route::delete('books/{sandbox}/{bookId}', 'BooksController@deleteBook');
    Route::post('books/{sandbox}', 'BooksController@create');

    Route::post('books/{sandbox}/{bookId}/lend/{userId}', 'BooksController@lendBook');
    Route::post('books/{sandbox}/{bookId}/returned/{userId}', 'BooksController@returnBook');

    Route::put('users/update', 'UserController@update');

    Route::get('users/view/lent_books', 'UserController@getLentBooks');

    Route::get('users/view', function (Request $request) {
        return $request->user();
    });

});

Route::group(['prefix' => 'v1', 'middleware' => ['api','cors']], function () {
    Route::post('users/signup', 'Auth\ApiRegisterController@register');
});

