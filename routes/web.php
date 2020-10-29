<?php

use Illuminate\Support\Facades\Route;

Route::get('/location/city/{id}', 'Location\\CityController@index')->name('location.city');
Route::get('/location/country', 'Location\\CountryController@index')->name('location.country');
Route::get('/location/region/{id}', 'Location\\RegionController@index')->name('location.region');



Route::get('/test', function () {
    return view("home");
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'CabinetController@index')->name("home");
    Route::get('/cabinet/user-data', 'CabinetController@getUserData')->name('cabinet.user-data');
});

Auth::routes(['verify' => true]);
Auth::routes();


