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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();
// Logout get method
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles','RoleController');
    Route::resource('permissions','PermissionController');
    Route::resource('users','UserController');

    Route::get('/otherworks/export', 'OtherWorkController@export')
        ->name('otherworks.export');
    Route::get('/otherworks/download/{id}', 'OtherWorkController@downloadFile')
        ->name('otherworks.downloadFile')
        ->where('id', '[0-9]+');

    Route::resource('otherworks','OtherWorkController');

    Route::group(['prefix' => 'otherworks'], function () {

    });


    Route::get('otherworks-management','OtherWorkManagementController@index')
        ->name('otherworks-management.index');

    Route::group(['prefix' => 'otherworks-management'], function () {
        Route::get('report-user','OtherWorkManagementController@reportUser')
            ->name('otherworks-management.reportUser');
        Route::get('report-department','OtherWorkManagementController@reportDepartment')
            ->name('otherworks-management.reportDepartment');
        Route::post('search','OtherWorkManagementController@search')
            ->name('otherworks-management.search');
        Route::get('export', 'OtherWorkManagementController@export')
            ->name('otherworks-management.export');
    });



    /*
    Route::get('files', function () {
        return view('otherworks.file');
    });

    Route::get('/search/name', 'UserController@searchByName');

    */
});

