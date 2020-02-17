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


Route::get('/teacher', 'DocentController@docent')
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

Route::get('gesprek/{id}', 'OpdrachtController@gesprek')->name('gesprek');
Route::resource('opdracht', 'OpdrachtController');
Route::get('gesprek/accept/{id}', 'DocentController@acceptInterview')->name('gesprek/accept');
Route::post('team/select/', 'DocentController@assignUsertoOpdracht')->name('team/select');

Route::post('offerte', 'OpdrachtController@offerte')->name('offerte');

Route::resource('team', 'TeamController');
