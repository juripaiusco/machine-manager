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

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/users', 'User@index')->name('users');
Route::get('/users/create', 'User@create')->name('users.create');
Route::post('/users/store', 'User@store')->name('users.store');
Route::get('/users/edit/{id}', 'User@edit')->name('users.edit');
Route::post('/users/update/{id}', 'User@update')->name('users.update');
Route::get('/users/delete/{id}', 'User@destroy')->name('users.destroy');

Route::get('/products', 'Product@index')->name('products');
