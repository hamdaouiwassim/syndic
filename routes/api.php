<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::post('login','AuthController@login');
Route::group(['middleware' => 'auth:api'], function () {
        Route::get('logout','AuthController@logout');
        Route::get('profile','AuthController@profile');

});
Route::post('coproprietaire/add','CoproprietaireController@store');
Route::get('admin/{id}/coproprietaires','CoproprietaireController@index');
//Route::post('coproprietaire/update','CoproprietaireController@update');
Route::get('coproprietaire/{id}/delete','CoproprietaireController@destroy');



Route::post('transaction/add','TransactionController@store');
Route::get('transactions/{appid}','TransactionController@index');
Route::get('users/{appid}','AuthController@getusers');
Route::post('transaction/update','TransactionController@update');
Route::get('transaction/{id}/delete','TransactionController@destroy');
Route::get('user/{id}/changePaiment','AuthController@ChangePaiment');
Route::post('user/update','AuthController@update');
Route::get('user/{id}','AuthController@get');


Route::post('event/add','EventController@store');
Route::get('events/{appid}','EventController@index');
Route::post('event/update','EventController@update');
Route::get('event/{id}/delete','EventController@destroy');


