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

Route::get('/', 'CatalogueController@showAll')->name('home');
Route::get('{catalogueAlias}', 'CatalogueController@showCatalogue')->name('catalogue');
Route::get('{catalogueAlias}/{itemAlias}', 'CatalogueController@showItem')->name('item');

Route::get('admin4k/item', 'AdminController@item');
Route::post('admin4k/item', 'AdminController@addItem');