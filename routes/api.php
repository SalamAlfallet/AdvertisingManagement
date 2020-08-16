<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/Categories', 'ApiControllers\AdvsController@Categories')->name('Categories.all');
Route::get('/advsByCategory/{id}', 'ApiControllers\AdvsController@advsByCategory')->name('Categories.advsByCategory');

Route::get('/advById/{id}', 'ApiControllers\AdvsController@advById')->name('Categories.advById');
// Route::get('/advById/{id}', 'ApiControllers\AdvsController@advById')->name('Categories.advById');

Route::post('/create/advs', 'ApiControllers\AdvsController@storeAdv')->name('Adv.storeAdv');

Route::put('/update/advs/{id}', 'ApiControllers\AdvsController@updateAdv')->name('Adv.updateAdv');


Route::get('/getSearchResults', 'ApiControllers\AdvsController@getSearchResults');




Route::post('/register', 'ApiControllers\AuthController@register');
Route::post('/login', 'ApiControllers\AuthController@login');
Route::get('/profile/{id}', 'ApiControllers\AdvsController@profile');

Route::put('/update/Profile/{id}', 'ApiControllers\AdvsController@updateProfile');

Route::delete('/delete/profile/{id}', 'ApiControllers\AdvsController@deleteProfile');












