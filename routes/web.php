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
    return view('welcome');
});

Route::get('links', ['as' => 'links.store', 'uses' => 'LinkController@index' ]);
Route::post('links', ['as' => 'links.store', 'uses' => 'LinkController@store' ]);
Route::put('links/{id}', ['as' => 'link.update', 'uses' => 'LinkController@update']);
Route::delete('links/{id}', ['as' => 'link.destroy', 'uses' => 'LinkController@destroy']);

