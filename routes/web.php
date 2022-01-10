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

Auth::routes();

Route::get('/', 'Dashboard@index');
Route::get('/home', 'Dashboard@index')->name('home');

Route::get('/machines', 'Machine@index')->name('machines');
Route::get('/machines/create', 'Machine@create')->name('machines.create');
Route::post('/machines/store', 'Machine@store')->name('machines.store');
Route::get('/machines/edit/{id}', 'Machine@edit')->name('machines.edit');
Route::post('/machines/update/{id}', 'Machine@update')->name('machines.update');
Route::get('/machines/delete/{id}', 'Machine@destroy')->name('machines.destroy');
Route::get('/machines/search', 'Machine@search')->name('machines.search');

Route::get('/machines/dynamic-field/{type}/{id?}', 'Machine@dynamicField');

Route::get('/users', 'User@index')->name('users');
Route::get('/users/create', 'User@create')->name('users.create');
Route::post('/users/store', 'User@store')->name('users.store');
Route::get('/users/edit/{id}', 'User@edit')->name('users.edit');
Route::post('/users/update/{id}', 'User@update')->name('users.update');
Route::get('/users/delete/{id}', 'User@destroy')->name('users.destroy');

Route::get('/products', 'Product@index')->name('products');
Route::get('/products/create', 'Product@create')->name('products.create');
Route::post('/products/store', 'Product@store')->name('products.store');
Route::get('/products/edit/{id}', 'Product@edit')->name('products.edit');
Route::post('/products/update/{id}', 'Product@update')->name('products.update');
Route::get('/products/delete/{id}', 'Product@destroy')->name('products.destroy');
