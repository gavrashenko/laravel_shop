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

Route::get('admin4k', 'AdminController@index');
Route::get('admin4k/order/all', 'AdminController@allOrders')->name('all_orders');
//Route::get('admin4k/item', 'AdminController@item');
//Route::post('admin4k/item', 'AdminController@addItem');

Route::post('/image/get-main-images', 'ImageController@getMainImages');
Route::get('/order', 'OrderController@showOrder')->name('show_order');
Route::get('/order/{code}', 'OrderController@showPersonalOrder')->name('show_personal_order');
Route::post('/order', 'OrderController@makeOrder')->name('make_order');
Route::post('/quick-order', 'OrderController@makeQuickOrder')->name('make_quick_order');
Route::get('/', 'CatalogueController@showAll')->name('home');
Route::get('/contacts', 'StaticPagesController@contacts')->name('contacts');
Route::get('/delivery', 'StaticPagesController@delivery')->name('delivery');
Route::get('/about', 'StaticPagesController@about')->name('about');
Route::get('/test', 'CatalogueController@test')->name('test');
Route::get('{catalogueAlias}', 'CatalogueController@showCatalogue')->name('catalogue');
Route::get('{catalogueAlias}/{itemAlias}', 'CatalogueController@showItem')->name('item');


