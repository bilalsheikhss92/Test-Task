<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VideoController;

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
    return redirect()->route('login');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::middleware('auth')->group(function () {
    Route::get('/home', 'VideoController@index')->name('home');
    Route::get('/create',  'VideoController@create')->name('create');
    Route::get('/edit/{edit}',  'VideoController@edit')->name('edit');
    Route::get('/show/{edit}',  'VideoController@show')->name('show');
    Route::post('/store',  'VideoController@store')->name('store');
    Route::put('/update/{update}',  'VideoController@update')->name('update');
    Route::get('/delete/{delete}',  'VideoController@delete')->name('delete');
});
