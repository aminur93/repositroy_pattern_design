<?php

//repository pattern design routes
Route::get('user','Api\UserController@index');
Route::post('user/create','Api\UserController@create');
Route::get('user/edit/{id}','Api\UserController@edit');
Route::post('user/update/{id}','Api\UserController@update');
Route::delete('user/destroy/{id}','Api\UserController@destroy');

//service class use for category crud
Route::get('category', 'Api\CategoryController@index');
Route::post('category/store', 'Api\CategoryController@store');
Route::get('category/edit/{id}', 'Api\CategoryController@edit');
Route::post('category/update/{id}','Api\CategoryController@update');
Route::delete('category/destroy/{id}','Api\CategoryController@destroy');
