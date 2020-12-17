<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api-admin')->get('/user', function (Request $request) {
    return auth()->user();
});

// Route::post('login','Api\AuthController@login');
// Route::post('register','Api\AuthController@register');


Route::prefix('login')->group(function (){
    Route::post('admin','AdminController@login');
    Route::post('petugas','PetugasController@login');
    Route::post('masyarakat','MasyarakatController@login');
});

Route::prefix('register')->group(function(){
    Route::post('admin','AdminController@register');
    Route::post('petugas','PetugasController@register')->middleware('auth:api-admin');
    Route::post('masyarakat','MasyarakatController@register');

});

Route::middleware('auth:api-admin')->prefix('admin')->group(function () {
    Route::get('/','AdminController@index');
    Route::get('/{id}','AdminController@show');
    // Route::post('/','AdminController@register');
    Route::put('/','AdminController@update');
    Route::delete('/{id}','AdminController@delete');
});

Route::middleware('auth:api-admin')->group(function (){
    Route::get('get_petugas','PetugasController@index');
    Route::get('get_petugas/{id}','PetugasController@show');
    Route::delete('delete_petugas/{id}','PetugasController@delete');

    # Masyarakat
    Route::get('get_masyarakat','MasyarakatController@index');
    Route::get('get_masyarakat/{id}','MasyarakatController@show');
    Route::delete('delete_masyarakat/{id}','MasyarakatController@delete');

});

Route::middleware('auth:api-masyarakat')->prefix('masyarakat')->group(function (){
    Route::get('/','MasyarakatController@user');
    Route::put('/','MasyarakatController@update');
});

Route::middleware('auth:api-petugas')->prefix('petugas')->group(function () {
    Route::get('/','PetugasController@user');
    Route::put('/','PetugasController@update');
});