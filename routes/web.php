<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routese
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/pages', 'PagesController@index');
Route::get('/bookclasses', 'PagesController@bookclasses');
Route::get('/products', 'Web\ProductController@index')->name('products');
//Route::get('/slots', 'Web\SlotController@index')->name('slots');

Route::get('/membership', 'Web\MembershipController@index')->name('membership');
Route::get('/profile', 'Web\ProfileController@index')->name('profile');
Route::get('/cancel', 'Web\SlotController@cancel')->name('cancel');


//Route::get('/check/{id}', 'Web\SlotController@check')->name('check');
Route::post('/book', 'Web\SlotController@book')->name('book');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/success', 'SlotController@success')->name('success');
