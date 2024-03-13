<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', "Backend\DashboardController@index");

Route::get('/sanpham', "Backend\ProductsController@index");

Route::get('/sanpham/create', "Backend\ProductsController@create");

Route::get('/sanpham/edit/{id}', "Backend\ProductsController@edit");

Route::get('/sanpham/delete/{id}', "Backend\ProductsController@delete");

Route::post('/sanpham/store','Backend\ProductsController@store');

Route::post('/sanpham/update/{id}','Backend\ProductsController@update');

Route::post('/sanpham/destroy/{id}','Backend\ProductsController@destroy');

Route::get('/category','Backend\CategoryController@index');

Route::get('/category/add','Backend\CategoryController@create');

Route::post('/category/store','Backend\CategoryController@store');

Route::get('/category/edit/{id}','Backend\CategoryController@edit');

Route::post('/category/update/{id}','Backend\CategoryController@update');

Route::get('/category/delete/{id}','Backend\CategoryController@delete');

Route::post('/category/destroy/{id}','Backend\CategoryController@destroy');

http://localhost/laravel7x/crud/public/sanpham