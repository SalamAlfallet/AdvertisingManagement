<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('backend.layouts.admin');
});

Route::post('uploadsFile' , 'HomeController@uploadsFile')->name('uploads.file');
Route::get('deleteFile' , 'HomeController@deleteFile');
Route::post('deleteMultiFile' , 'HomeController@deleteMultiFile');
Route::post('uploadMultiFile' , 'HomeController@uploadMultiFile')->name('uploads.multiFile');



/* .... route category ....  */
Route::namespace('backend')->prefix('/admin/category')->group(function (){
    Route::get('/', 'CategoryController@index')->name('admin.category');
    Route::get('/create','CategoryController@create')->name('admin.category.create');
    Route::post('/store','CategoryController@store')->name('admin.category.store');
    Route::get('/delete/{id}', 'CategoryController@delete')->name('admin.category.delete');
    Route::get('/edit/{id}', 'CategoryController@editCategory')->name('admin.category.edit');
    Route::put('{id}', 'CategoryController@updateCategory')->name('admin.category.update');
    Route::post('uploadsFile' , 'CategoryController@uploadsFile')->name('uploads.category.file');


});
/* .... end category route .... */


