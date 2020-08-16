<?php

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

Route::get('/sitemap', 'SitemapController@sitemap')->name('sitemap');







/* .... Start Front end ...*/


Route::get('/', 'frontend\HomeController@index')->name('home');
Route::get('/contact_us', 'frontend\ContactUsController@index')->name('contactUs');
Route::get('/about', 'frontend\AboutController@index')->name('about');


/////////////////////////// Email route ////////////////
Route::post('/send_email', 'frontend\ContactUsController@docontactus')->name('sendEmail');
Route::post('/send_email/QuickContactus', 'frontend\ContactUsController@QuickContactus')->name('sendEmail.QuickContactus');
Route::post('/send_email/GetAQuoteNow', 'frontend\ContactUsController@GetAQuoteNow')->name('sendEmail.GetAQuoteNow');

Route::get('refreshcaptcha', 'frontend\ContactUsController@refreshCaptcha')->name('refreshcaptcha');

//////////////////////  service route  //////////////////
Route::get('/service/{id}', 'frontend\ServicesController@viewById')->name('details');
Route::get('ecatalogues/{id}/download', 'frontend\ServicesController@downloads')->name('downloads.download');



////////////////////// end service route //////////////////


//////////////////////  Product route  //////////////////
Route::get('/product', 'frontend\ProductController@index')->name('product_details');

Route::post('/getSupCat', 'frontend\ProductController@getSupCat')->name('products.getSupCat');
Route::get('/productsByCat/{id}', 'frontend\ProductController@viewByCat')->name('products.productsByCat');
Route::get('/productsByBraCat', 'frontend\ProductController@viewByBraAndCat')->name('products.productsByBraCat');
Route::post('/products', 'frontend\ProductController@SearchProductByName')->name('products.productsByName');
Route::get('/productDetailes', 'frontend\ProductController@productDetailes')->name('products.productDetailes');

////////////////////// end Product route //////////////////






//////////////////////  Brand route  //////////////////

Route::get('/brands', 'frontend\BrandsController@index')->name('brands');
Route::get('/brands/{id}', 'frontend\BrandsController@viewById')->name('brand-details');

Route::get('/post/{id}', 'frontend\PostsController@viewById')->name('post-details');


////////////////////// end Brand route //////////////////

//////////////////////  Blog route  //////////////////

 Route::get('/blog', 'frontend\PostsController@index')->name('blog');

Route::get('/post/{id}', 'frontend\PostsController@viewById')->name('post-details');


////////////////////// end Blog route //////////////////

//////////////////////  News route  //////////////////

 Route::get('/news', 'frontend\newsController@index')->name('news');

Route::get('/new/{id}', 'frontend\newsController@viewById')->name('new-details');

////////////////////// end News route //////////////////

//////////////////////  ecatalog route  //////////////////

Route::get('/ecatalog', 'frontend\EcalalogController@index')->name('ecatalog');
Route::get('/ecatalog/{id}/download', 'frontend\EcalalogController@viewById')->name('download');

////////////////////// end ecatalog route //////////////////


/////// Sitemap  route //////

Route::get('/sitemapPage', 'SitemapController@index')->name('sitemapPage');


///////////// enf sitemap route //////////


// Route::get('/brands', function () {
//     return view('frontend.brands');
// })->name('brands');





  


/* .... end Front end ...*/

/* .... Dashboard .... */
// Route::get('/dashboard', 'backend\HomeController@index')->middleware(['auth']);
// Route::get('/dashboard', 'backend\SettingController@index')->middleware(['auth','admin']);
Route::get('/dashboard', 'backend\UsersController@editProfile')->middleware(['auth']);

// Route::get('/dashboard', 'backend\UsersController@editUser')->middleware(['auth']);

/* .... route news ....  */
Route::namespace('backend')->prefix('/admin/news')->middleware(['auth'])->group(function (){
    Route::get('/', 'NewsController@index')->name('admin.news');
    Route::get('/create','NewsController@create')->name('admin.news.create');
    Route::post('/store','NewsController@store')->name('admin.news.store');
    Route::get('/delete/{id}', 'NewsController@delete')->name('admin.news.delete');
    Route::get('/edit/{id}', 'NewsController@editNews')->name('admin.news.edit');
    Route::put('{id}', 'NewsController@updateNews')->name('admin.news.update');

});
/* .... end news route .... */

/* .... route posts ....  */
Route::namespace('backend')->prefix('/admin/posts')->middleware(['auth'])->group(function (){
    Route::get('/', 'PostsController@index')->name('admin.posts');
    Route::get('/create','PostsController@create')->name('admin.posts.create');
    Route::post('/store','PostsController@store')->name('admin.posts.store');
    Route::get('/delete/{id}', 'PostsController@delete')->name('admin.posts.delete');
    Route::get('/edit/{id}', 'PostsController@editPost')->name('admin.posts.edit');
    Route::put('{id}', 'PostsController@updatePost')->name('admin.posts.update');

});
/* .... end posts route .... */

/* .... route services ....  */
Route::namespace('backend')->prefix('/admin/services')->middleware(['auth'])->group(function (){
    Route::get('/', 'ServicesController@index')->name('admin.services');
    Route::get('/create','ServicesController@create')->name('admin.services.create');
    Route::post('/store','ServicesController@store')->name('admin.services.store');
    Route::get('/delete/{id}', 'ServicesController@delete')->name('admin.services.delete');
    Route::get('/edit/{id}', 'ServicesController@editService')->name('admin.services.edit');
    Route::put('{id}', 'ServicesController@updateService')->name('admin.services.update');
});
/* .... end services route .... */

/* .... route brands ....  */
Route::namespace('backend')->prefix('/admin/brands')->middleware(['auth'])->group(function (){
    Route::get('/', 'BrandsController@index')->name('admin.brands');
    Route::get('/delete/{id}', 'BrandsController@delete')->name('admin.brands.delete');
    Route::get('/create','BrandsController@create')->name('admin.brands.create');
    Route::post('/store','BrandsController@store')->name('admin.brands.store');
    Route::get('/edit/{id}', 'BrandsController@editBrand')->name('admin.brands.edit');
    Route::put('{id}', 'BrandsController@updateBrand')->name('admin.brands.update');
});
/* .... end brands route .... */

/* .... route Products ....  */
Route::namespace('backend')->prefix('/admin/products')->middleware(['auth'])->group(function (){
    Route::get('/', 'ProductsController@index')->name('admin.products');
    Route::get('/create','ProductsController@create')->name('admin.products.create');
    Route::post('/store','ProductsController@store')->name('admin.products.store');
    Route::get('/getSupCat', 'ProductsController@getSupCat')->name('admin.products.getSupCat');
    Route::get('/delete/{id}', 'ProductsController@delete')->name('admin.products.delete');
    Route::put('{id}', 'ProductsController@updateProduct')->name('admin.products.update');
    Route::get('/edit/{id}', 'ProductsController@editProduct')->name('admin.products.edit');
});
/* .... end Products route .... */

/* .... route catalogues ....  */
Route::namespace('backend')->prefix('/admin/ecatalogues')->middleware(['auth'])->group(function (){
    Route::get('/', 'EcataloguesController@index')->name('admin.ecatalogues');
    Route::get('/create','EcataloguesController@create')->name('admin.ecatalogues.create');
    Route::post('/store','EcataloguesController@store')->name('admin.ecatalogues.store');
    Route::get('/delete/{id}', 'EcataloguesController@delete')->name('admin.ecatalogues.delete');
    Route::get('/edit/{id}', 'EcataloguesController@editECatalogues')->name('admin.ecatalogues.edit');
    Route::put('{id}', 'EcataloguesController@updateECatalogues')->name('admin.ecatalogues.update');
});
/* .... end catalogues route .... */

/* .... route about us ....  */
Route::namespace('backend')->prefix('/admin/aboutUs')->middleware(['auth'])->group(function (){
    Route::get('/', 'AboutController@index')->name('admin.aboutUs');
    Route::get('/create', 'AboutController@create')->name('admin.aboutUs.create');
    Route::post('/store','AboutController@store')->name('admin.aboutUs.store');
    Route::get('/delete/{id}', 'AboutController@delete')->name('admin.aboutUs.delete');
    Route::get('/edit/{id}', 'AboutController@editAbout')->name('admin.aboutUs.edit');
    Route::put('{id}', 'AboutController@updateAbout')->name('admin.aboutUs.update');



});
/* .... end about us route .... */


/* .... route category ....  */
Route::namespace('backend')->prefix('/admin/category')->middleware(['auth'])->group(function (){
    Route::get('/', 'CategoryController@index')->name('admin.category');
    Route::get('/create','CategoryController@create')->name('admin.category.create');
    Route::post('/store','CategoryController@store')->name('admin.category.store');
    Route::get('/delete/{id}', 'CategoryController@delete')->name('admin.category.delete');
    Route::get('/edit/{id}', 'CategoryController@editCategory')->name('admin.category.edit');
    Route::put('{id}', 'CategoryController@updateCategory')->name('admin.category.update');

});
/* .... end category route .... */


/* .... route Settings ....  */
Route::namespace('backend')->prefix('/admin/setting')->middleware(['auth','admin'])->group(function (){
    Route::get('/', 'SettingController@index')->name('admin.settings');
    Route::post('update','SettingController@update')->name('admin.setting.update');
    Route::post('uploadsFileConstant' , 'SettingController@uploadsFile')->name('uploads.constant.file');
    Route::post('uploadsImageConstant' , 'SettingController@uploadsImage')->name('uploads.constant.image');

    




});
/* .... end Settings route .... */

/* .... route User ....  */
Route::namespace('backend')->prefix('/admin/user')->middleware(['auth','admin'])->group(function (){
    Route::get('/', 'UsersController@index')->name('admin.users');
    // Route::get('/', function () {
    //         return view('backend.users.adduser');
    //     })->name('admin.user.create');
    Route::get('/create','UsersController@create')->name('admin.user.create');
    Route::post('/store','UsersController@store')->name('admin.user.store');
    Route::get('/delete/{id}', 'UsersController@delete')->name('admin.user.delete');
    Route::get('/edit/{id}', 'UsersController@editUser')->name('admin.user.edit');
    Route::put('{id}', 'UsersController@updateUser')->name('admin.user.update');

});
/* .... end user route .... */
Route::namespace('backend')->prefix('/admin/profile')->middleware(['auth'])->group(function (){
     Route::get('/editprofile', 'UsersController@editProfile')->name('admin.profile.edit');
    Route::put('/updateprofile', 'UsersController@updateProfile')->name('admin.profile.update');

});
/* .... route Slider ....  */

Route::namespace('backend')->prefix('/admin/slider')->middleware(['auth'])->group(function (){
   Route::get('/', 'SliderController@index')->name('slider');
    Route::get('create', 'SliderController@create')->name('slider.create');
    Route::put('{id}', 'SliderController@updateSlide')->name('admin.slider.update');
    Route::post('storeSlider','SliderController@store')->name('uploads.store');
     Route::post('uploadsImageConstant' , 'SliderController@uploadsImage')->name('uploads.constant.image');
     Route::post('uploadSlide' , 'SliderController@uploadSlide')->name('slider.uploadSlide');
     Route::get('/delete/{id}', 'SliderController@delete')->name('admin.slider.delete');
      Route::get('/edit/{id}', 'SliderController@editSlide')->name('admin.slider.edit');
 

    




});
/* .... end Slider route .... */



  // ******************** Auth route For Admin **********************************
//   Route::group(['prefix' => 'admin'], function() {
//     Auth::routes();

//Auth::routes(['verify' => true]);

//     Route::get('logout', function () {
//         Auth::logout();
//         return redirect('login');
//     })->name('admin.logout');

// });



Auth::routes();
//Auth::routes(['verify' => true]);
Route::get('/admin/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('admin.logout');


/* .... End Dashboard ... */
