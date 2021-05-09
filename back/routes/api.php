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

Route::group(['prefix' => '/auth', ['middleware' => 'throttle:20,5']], function() {
    Route::post('/register', 'Auth\RegisterController@register');
    Route::post('/login', 'Auth\LoginController@login');
});

Route::group(['middleware' => 'jwt.auth'], function() {
    Route::get('/me', 'MeController@index');

    Route::get('/auth/logout', 'MeController@logout');

});

Route::resource('/articles', 'ArticleController', ['except' => ['create', 'edit']]);

Route::get('articles/{article}/like', 'ArticleController@like');
Route::get('articles/{article}/unlike', 'ArticleController@unlike');
Route::get('articles/{article}/count', 'ArticleController@count');
Route::get('articles/{article}/hasfavorites', 'ArticleController@hasfavorite');

Route::resource('/profiles', 'ProfileController', ['except' => ['create', 'edit', 'destroy']]);

Route::put('/{name}/follow', 'UsersController@follow')->name('follow');
Route::delete('/{name}/follow', 'UsersController@unfollow')->name('unfollow');
Route::get('/{name}/follow', 'UsersController@isfollowed');
Route::get('follow/{name}/count', 'UsersController@count');

Route::get('/{name}/followings', 'UsersController@followings')->name('followings');
Route::get('/{name}/followers', 'UsersController@followers')->name('followers');
Route::get('/users', 'UsersController@index');
Route::put('/users/{users}', 'UsersController@update');
Route::get('/users/{users}', 'UsersController@show');

Route::put('/{password}/change','Auth\ChangePasswordController@update');

Route::resource('/messages', 'MessageController', ['except' => ['create', 'edit', 'destroy', 'index', 'update']]);

Route::post('/{message}/messages', 'MessageController@send');
