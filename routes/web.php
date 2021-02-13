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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contact', 'App\Http\Controllers\ContactController@newContact');

Route::get('/listContacts', 'App\Http\Controllers\ContactController@listContacts');

/*Route::get('cvs','App\Http\Controllers\CvController@index');
Route::get('cvs/create','App\Http\Controllers\CvController@create');
Route::post('cvs','App\Http\Controllers\CvController@store');
Route::get('cvs/{id}/edit','App\Http\Controllers\CvController@edit');
Route::put('cvs/{id}','App\Http\Controllers\CvController@update');
Route::delete('cvs/{id}','App\Http\Controllers\CvController@destroy');*/

Route::resource('cvs', 'App\Http\Controllers\CvController');

//Experience
Route::get('getdata/{id}', 'App\Http\Controllers\CvController@getData');
Route::post('/addexperience', 'App\Http\Controllers\CvController@addExperience');
Route::put('/updateexperience', 'App\Http\Controllers\CvController@updateExperience');
Route::delete('/deleteexperience/{id}', 'App\Http\Controllers\CvController@deleteExperience');

//Projet
Route::post('/addprojet', 'App\Http\Controllers\CvController@addProjet');
Route::put('/updateprojet', 'App\Http\Controllers\CvController@updateProjet');
Route::delete('/deleteprojet/{id}', 'App\Http\Controllers\CvController@deleteProjet');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
