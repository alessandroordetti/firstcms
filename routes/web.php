<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\LoginController;
use App\Http\Controllers\Auth\LogoutController;


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

/* PER IL LOGIN DELL'UTENTE */
Route::get('/login', 'LoginController@login')->name('login');
Route::post('/login', 'LoginController@checkPassword');
Route::get('/logout', 'LogoutController@logout')->name('logout');

/* PER LA CREAZIONE DEL COOKIE DOPO IL LOGIN DELL'UTENTE CON SCADENZA +3 GIORNI */
Route::get('/cookie/set','CookieController@setCookie');
Route::get('/cookie/get','CookieController@getCookie'); 

/* PER LA GESTIONE DELLE PAGINE INTERNE AL CMS */
Route::middleware(['jwt.cookie'])->group(function () {
    
    Route::get('/landing', 'LandingController@dashboard')->name('landing');

    /* PER LA REGISTRAZIONE DELL'UTENTE */
    Route::get('/user/register', 'CmsMultiversityUserController@getRegisterPage')->name('register');

    /* CRUD PER LA GESTIONE DEGLI UTENTI */
    Route::get('/user', 'CmsMultiversityUserController@index')->name('user-index');
    Route::post('/user/store', 'CmsMultiversityUserController@store')->name('user-store');
    Route::get('/user/{id}', 'CmsMultiversityUserController@show')->name('user-show');
    Route::get('/user/{id}/edit', 'CmsMultiversityUserController@edit')->name('user-edit');
    Route::post('user/{id}', 'CmsMultiversityUserController@update')->name('user-update');
    Route::post('user/{id}/delete', 'CmsMultiversityUserController@delete')->name('user-delete');

    /* CRUD PER LA GESTIONE DELLE NUOVE PAGINE */
    Route::get('/pagina', 'CmsMultiversityPageController@index')->name('pagina-index');
    Route::get('/pagina/create', 'CmsMultiversityPageController@create')->name('pagina-create');
    Route::post('/pagina/store', 'CmsMultiversityPageController@store')->name('pagina-store');
    Route::get('/pagina/{id}/edit', 'CmsMultiversityPageController@edit')->name('pagina-edit');
    Route::post('pagina/{id}', 'CmsMultiversityPageController@update')->name('pagina-update');
    Route::post('pagina/{id}/delete', 'CmsMultiversityPageController@delete')->name('pagina-delete');

    /* CRUF PER LA GESTIONE DELLE PAGINE */
    Route::get('/cdl', 'CmsMultiversityCdlController@index')->name('cdl-index');
    Route::get('/cdl/create', 'CmsMultiversityCdlController@create')->name('cdl-create');
    Route::post('/cdl/store', 'CmsMultiversityCdlController@store')->name('cdl-store');
    Route::get('/cdl/{id}/edit', 'CmsMultiversityCdlController@edit')->name('cdl-edit');
    Route::post('/cdl/{id}', 'CmsMultiversityCdlController@update')->name('cdl-update');
    Route::post('/cdl/{id}/delete', 'CmsMultiversityCdlController@delete')->name('cdl-delete');
});

