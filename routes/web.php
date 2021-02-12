<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/notes', 'NoteController@index')->name('notes');
Route::get('note/create', 'NoteController@create')->name('note.create');
Route::post('/note/store', 'NoteController@store')->name('note.store');
Route::get('/note/show/{id}', 'NoteController@show')->name('note.show');
Route::get('note/edit/{id}', 'NoteController@edit')->name('note.edit');
Route::post('/note/update/{id}', 'NoteController@update')->name('note.update');
Route::get('/note/destroy/{id}', 'NoteController@destroy')->name('note.destroy');
Route::get('note/hdelete/{id}', 'NoteController@hdelete')->name('note.hdelete');
Route::get('/notes/trashed', 'NoteController@notesTrashed')->name('notes.trashed');
Route::get('note/restore/{id}', 'NoteController@restore')->name('note.restore');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
