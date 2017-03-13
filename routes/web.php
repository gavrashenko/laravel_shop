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

use Illuminate\Http\Request;

Route::post('/image/get-main-images', 'ImageController@getMainImages');
Route::get('/order', 'OrderController@showOrder')->name('order');
Route::get('/', 'CatalogueController@showAll')->name('home');
Route::get('/contacts', 'StaticPagesController@contacts')->name('contacts');
Route::get('/delivery', 'StaticPagesController@delivery')->name('delivery');
Route::get('/about', 'StaticPagesController@about')->name('about');
Route::get('{catalogueAlias}', 'CatalogueController@showCatalogue')->name('catalogue');
Route::get('{catalogueAlias}/{itemAlias}', 'CatalogueController@showItem')->name('item');

Route::get('admin4k/item', 'AdminController@item');
Route::post('admin4k/item', 'AdminController@addItem');
