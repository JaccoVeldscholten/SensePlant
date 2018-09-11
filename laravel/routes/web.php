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

Route::get('/', 'PageController@index');

Route::get('/dashboard', 'PageController@dashboard');

Route::get('/api/plantdata/{id}', 'PageController@plantdata');

Route::get('/api/plantdefault/{id}', 'PageController@plantdefault');

Route::get('/api/insert/{token}/{plantId}/{temp}/{humidity}', 'SenseController@insertPlantData');
