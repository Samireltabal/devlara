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

// Main Route ( Home Page )
Route::get('/', 'HomeController@index');

// Authentication Routes 
Auth::routes();
// Change Language
Route::put('lang', 'HomeController@lang')->name('lang');

// MiddleWare Web 

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/dashboard', 'AdminController@index')->name('admin');

// Accounts Routes

Route::get('dashboard/accounts','AccountsController@index')->name('accounts.list');