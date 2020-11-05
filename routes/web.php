<?php

use Illuminate\Support\Facades\Route;

Route::get('/location/city/{id}', 'Location\\CityController@index')->name('location.city');
Route::get('/location/country', 'Location\\CountryController@index')->name('location.country');
Route::get('/location/region/{id}', 'Location\\RegionController@index')->name('location.region');



Route::get('/test', function () {
    return view("home");
});

Route::group(['middleware' => 'auth'], function () {
    //api cabinet
    Route::get('/cabinet/user-data', 'CabinetController@getUserData')->name('cabinet.user.data');
    Route::get('/cabinet/user-update', 'UserUpdateController@getUpdateData')->name('get.update.data');
    Route::post('/cabinet/update/user', 'UserUpdateController@PostUpdateData');
    Route::post('/cabinet/update/password', 'UserUpdateController@PostUpdatePassword');
    Route::post('/cabinet/update/image', 'UserUpdateController@PostUpdateImage');
    //api comment
    Route::get('/comments/read', 'CommentsController@getCommentsList');
    Route::post('/comments/create', 'CommentsController@create');
    Route::post('/comments/update', 'CommentsController@update');
    Route::get('/comments/delete/{id}', 'CommentsController@delete');

    //pages
    Route::get('/', 'CabinetController@index')->name("home");
    Route::get('/comments', 'CommentsController@index')->name("comments");
    Route::get('/user/update', 'UserUpdateController@index')->name('user.update');
    Route::get('/logout', function () {
        Auth::logout();
        return Redirect::route('login');
    })->name('user.logout');
});

Auth::routes(['verify' => true]);
Auth::routes();


