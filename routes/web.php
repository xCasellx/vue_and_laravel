<?php

use Illuminate\Support\Facades\Route;

Route::get('/location/city/{id}', 'Location\\CityController@index')->name('location.city');
Route::get('/location/country', 'Location\\CountryController@index')->name('location.country');
Route::get('/location/region/{id}', 'Location\\RegionController@index')->name('location.region');



Route::group(['middleware' => 'auth'], function () {
    //api user
    Route::get('/user/user-data/', 'UserController@getAuthUserData')->name('user.auth.data');
    Route::get('/test', 'UserController@test')->name('user.test');
    Route::get('/user/user-data/{id}', 'UserController@getUserData')->name('user.data');
    Route::get('/cabinet/user-update', 'UserUpdateController@getUpdateData')->name('get.update.data');
    Route::post('/cabinet/update/user', 'UserUpdateController@PostUpdateData');
    Route::post('/cabinet/update/password', 'UserUpdateController@PostUpdatePassword');
    Route::post('/cabinet/update/image', 'UserUpdateController@PostUpdateImage');
    Route::get('/tweets/{user}/{count}', "TwitterController@getTweetsUser");

    //api comment
    Route::get('/comments/read/{coll}', 'CommentsController@getCommentsList');
    Route::post('/comments/create', 'CommentsController@create');
    Route::post('/comments/update', 'CommentsController@update');
    Route::get('/comments/delete/{id}', 'CommentsController@delete');

    //pages
    Route::get('/', 'CabinetController@index')->name("home");
    Route::get('/comments', 'CommentsController@index')->name("comments");
    Route::get('/user/update', 'UserUpdateController@index')->name('user.update');
    Route::get('/user/{id}', 'CabinetController@userCabinet')->name('user.id');
    Route::get('/logout', function () {
        Auth::logout();
        return Redirect::route('login');
    })->name('user.logout');
});

Auth::routes(['verify' => true]);
Auth::routes();


