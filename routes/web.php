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
Route::get('/', 'HomeController@index')->name('dashboard');

// Authentication Routes 
Auth::routes();
// Change Language
Route::put('lang', 'HomeController@lang')->name('lang');

// MiddleWare Web 

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/dashboard', 'AdminController@index')->name('admin');


// Super Admin Area
    // Accounts
        Route::group(['prefix' => 'accounts', 'middleware' => ['auth','role:admin']], function() {
            // Prevent User From Deleting Or Suspending His Account
            Route::group(['middleware'=>'SecureYourSelf'], function() {
                Route::post('/toggle','AccountsController@toggle')->name('toggleState');
                Route::delete('/delete','AccountsController@delete')->name('deleteAccount');
            });
            Route::get('/','AccountsController@index')->name('accounts.list');
            Route::get('/create','AccountsController@create')->name('accounts.create');
            Route::post('/addUser','AccountsController@doAdd')->name('accounts.createAdd');

        
            });