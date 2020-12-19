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


Route::prefix('login')->group(function (){
    Route::post('admin','AdminController@login')->name('login.admin');
    Route::post('petugas','PetugasController@login')->name('login.petugas');
    Route::post('masyarakat','MasyarakatController@login')->name('login.masyarakat');
});

Route::prefix('register')->group(function(){
    Route::post('admin','AdminController@register')->name('register.admin');
    Route::middleware('auth:api-admin')->group(function (){
        // Route::post('admin','AdminController@register')->name('register.admin');
        Route::post('petugas','PetugasController@register')->name('register.petugas');
    });
    Route::post('masyarakat','MasyarakatController@register')->name('register.masyarakat');
});

Route::middleware('auth:api-admin')->prefix('admin')->group(function () {
    Route::get('/','AdminController@index')->name('get.admin');
    Route::get('/{id}','AdminController@show')->name('get_by_id.admin');
    Route::get('/profile','AdminController@profile')->name('get_loged_in_user.admin');
    Route::put('/','AdminController@update')->name('update.admin');
    Route::delete('/{id}','AdminController@delete')->name('delete.admin');
});

Route::prefix('masyarakat')->group(function(){
    Route::middleware('auth:api-masyarakat')->group(function (){
        Route::get('/profile','MasyarakatController@profile')->name('get_loged_in_user.masyarakat');;
        Route::put('/','MasyarakatController@update')->name('update.masyarakat');
    });
    Route::middleware('auth:api-admin')->group(function(){
        Route::get('/','MasyarakatController@index')->name('get.masyarakat');
        Route::get('/{id}','MasyarakatController@show')->name('get_by_id.masyarakat');
        Route::delete('/{id}','MasyarakatController@delete')->name('delete.masyarakat');
    });
});

Route::prefix('petugas')->group(function (){
    Route::middleware('auth:api-petugas')->group(function () {
        Route::get('/profile','PetugasController@profile')->name('get_loged_in_user.petugas');
        Route::put('/','PetugasController@update')->name('update.petugas');
    });
    Route::middleware('auth:api-admin')->group(function (){
        Route::get('/','PetugasController@index')->name('get.petugas');
        Route::get('/{id}','PetugasController@show')->name('get_by_id.petugas');
        Route::delete('/{id}','PetugasController@delete')->name('delete.petugas');
    });
});

Route::prefix('titik_banjir')->group(function(){
    Route::get('/','TitikBanjirController@index')->name('get.titk_banjir');
    Route::get('/{id}','TitikBanjirController@show')->name('get_by_id.titik_banjir');

    Route::middleware('auth:api-admin')->group(function(){
        Route::post('/','TitikBanjirController@create')->name('create.titik_bajir');
        Route::put('/{id}','TitikBanjirController@update')->name('update.titik_bajir');
        Route::delete('/{id}','TitikBanjirController@delete')->name('delete.titik_banjir');
    });
});

Route::prefix('titik_tersumbat')->group(function(){
    Route::get('/','TitikTersumbatController@index')->name('get.titik_tersumbat');
    Route::get('/{id}','TitikTersumbatController@show')->name('get_by_id.titik_tersumbat');
    
    Route::middleware('auth:api-admin')->group(function(){
        Route::post('/','TitikTersumbatController@create')->name('create.titik_tersumbat');
        Route::put('/{id}','TitikTersumbatController@update')->name('update.titik_tersumbat');
        Route::delete('/{id}','TitikTersumbatController@delete')->name('delete.titik_tersumbat');
    });
});

Route::prefix('drainase')->group(function (){
    Route::get('/','DrainaseController@index')->name('get.drainase');
    Route::get('/{id}','DrainaseController@show')->name('get_by_id.drainase');

    Route::middleware('auth:api-admin')->group(function (){
        Route::post('/','DrainaseController@create')->name('create.drainase');
        Route::put('/{i}','DrainaseController@update')->name('update.drainase');
        Route::delete('/{i}','DrainaseController@delete')->name('delete.drainase');
    });
});

Route::prefix('pengaduan')->group(function (){  
    Route::get('/','PengaduanController@index')->name('get.pengaduan');
    Route::get('/{id}','PengaduanController@index')->name('get_by_id.pengaduan');
    
    Route::middleware('auth:api-masyarakat')->group(function (){
        Route::post('/','PengaduanController@create')->name('create.pengaduan'); 
    });

    Route::middleware('auth:api-admin')->group(function (){ 
        Route::delete('/{id}','PengaduanController@delete')->name('delete.pengaduan');;
    });
});

Route::prefix('update_pengaduan')->group(function(){
    Route::put('/admin/{id}','PengaduanController@updateAdmin')->middleware('auth:api-admin')->name('update_pengaduan.admin');
    Route::put('/petugas/{id}','PengaduanController@updatePetugas')->middleware('auth:api-petugas')->name('update_pengaduan.petugas');
    Route::put('/masyarakat/{id}','PengaduanController@feedbackMasyarakat')->middleware('auth:api-masyarakat')->name('feedback_pengaduan.masyarakat');;
});





