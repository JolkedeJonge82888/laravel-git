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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/opdracht', 'OpdrachtController@index')->name('opdracht');

Route::get('/docent', 'DocentController@docent')
    ->middleware('is_docent')
    ->name('Docent');

Route::get('/admin', 'AdminController@admin')
    ->middleware('is_admin')
    ->name('Admin');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

Route::get('opdracht/create', 'OpdrachtController@create')
    ->middleware('is_docent')
    ->name('Create Opdracht');

Route::post('opdracht/create', 'OpdrachtController@store')
    ->middleware('is_docent')
    ->name('Create Opdracht');
