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
// Route::get('/{name}',function(){
//     return redirect('/');
// })->where('name','[A-Za-z]+');

/* Main section start */
Route::get('/', function () {
    return view('index');
});
Route::post('admin/getClildmenu','MenubarController@getClildmenu');
/* Main section end */

/*============================ Admin section start ======================================*/
Route::get('admin', function () {
    return view('admin');
})->middleware('auth');
// Route::get('/admin/{name}',function(){
//     return redirect('/admin');
// })->where('name','[A-Za-z]+');

/* Menu route start */
Route::resource('admin/menubar','MenubarController');
Route::post('admin/getMenu','MenubarController@getMenu');
Route::get('admin/editClildmenu/{id}','MenubarController@editClildmenu');
Route::delete('/childmenudelete/{id}','MenubarController@childmenudelete');
/* Menu route end */

/* Menu route start */
Route::resource('admin/banner','BannerController');
Route::post('admin/getBanner','BannerController@getBanner');

/* Menu route end */

/*============================== Admin section start ========================================*/

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
