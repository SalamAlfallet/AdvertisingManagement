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

// Route::get('/', function () {
//     return view('backend.layouts.admin');
// });


Route::get('/', function () {
    return redirect('/login');
});

Route::post('uploadsFile' , 'HomeController@uploadsFile')->name('uploads.file');
Route::get('deleteFile' , 'HomeController@deleteFile');
Route::post('deleteMultiFile' , 'HomeController@deleteMultiFile');
Route::post('uploadMultiFile' , 'HomeController@uploadMultiFile')->name('uploads.multiFile');


/* .... route user ....  */
Route::namespace('backend')->prefix('/admin')->middleware(['auth','admin'])->group(function (){
    Route::get('/users', 'UsersController@index')->name('admin.users');

    Route::get('/profile/editprofile', 'UsersController@editProfile')->name('admin.profile.edit');
   Route::put('/profile/updateprofile', 'UsersController@updateProfile')->name('admin.profile.update');
   

});



/* .... route category ....  */
Route::namespace('backend')->prefix('/admin/category')->middleware(['auth','admin'])->group(function (){
    Route::get('/', 'CategoryController@index')->name('admin.category');
    Route::get('/create','CategoryController@create')->name('admin.category.create');
    Route::post('/store','CategoryController@store')->name('admin.category.store');
    Route::get('/delete/{id}', 'CategoryController@delete')->name('admin.category.delete');
    Route::get('/edit/{id}', 'CategoryController@editCategory')->name('admin.category.edit');
    Route::put('{id}', 'CategoryController@updateCategory')->name('admin.category.update');
    Route::post('uploadsFile' , 'CategoryController@uploadsFile')->name('uploads.category.file');


});
/* .... end category route .... */



// Auth::routes();





Auth::routes();
//Auth::routes(['verify' => true]);
Route::get('/admin/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('admin.logout');


