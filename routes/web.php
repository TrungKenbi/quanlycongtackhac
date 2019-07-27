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

Route::get('/', function () {
    // Redicrect user if no sign in
    return redirect('/login');
});

Auth::routes();
// Logout get method
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');

Route::get('home', 'HomeController@index')->name('home');

Route::get('list-user', 'Administrator@listUser')->name('listUser');

