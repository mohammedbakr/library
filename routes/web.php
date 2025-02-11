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

// Book routes
Route::post('/books', 'BookController@store');
Route::patch('/books/{book}-{slug}', 'BookController@update');
Route::delete('/books/{book}-{slug}', 'BookController@destroy');

// Author routes
Route::get('/authors/create', 'AuthorController@create');
Route::post('/authors', 'AuthorController@store');
// Route::patch('/author/{author}', 'AuthorController@update');
// Route::delete('/author/{author}', 'AuthorController@destroy');

// checkout routes
Route::post('/checkout/{book}', 'CheckoutBookController@store');

// checkin routes
Route::post('/checkin/{book}', 'CheckinBookController@store');

// Route::resource('/books', 'BookController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
