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

Route::get('/', 'HomeController@index')->name('home.index');
Route::post('/kostlist', 'HomeController@kostList')->name('home.listKost');
Route::post('/availableRoom', 'HomeController@availableRoom')->name('home.availableRoom');
Route::post('/detailKost', 'HomeController@detailKost')->name('home.detailKost');
Route::get('/register', 'RegisterController@index')->name('register.index');
Route::post('/register', 'RegisterController@store')->name('register.store');
Route::get('/login', 'LoginController@index')->name('login');
Route::post('/login', 'LoginController@check_login')->name('login.check_login');
Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');
Route::get('/logout', 'DashboardController@logout')->name('dashboard.logout');
Route::resource('kosts', 'KostController');