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
    Route::get('/profile','AdminController@profile');
    // Route::post('/','AdminController@register');
    Route::put('/','AdminController@update');
    Route::delete('/{id}','AdminController@delete');
});

Route::prefix('masyarakat')->group(function(){
    Route::middleware('auth:api-masyarakat')->group(function (){
        Route::get('/profile','MasyarakatController@profile');
        Route::put('/','MasyarakatController@update');
    });
    Route::middleware('auth:api-admin')->group(function(){
        Route::get('/','MasyarakatController@index');
        Route::get('/{id}','MasyarakatController@show');
        Route::delete('/{id}','MasyarakatController@delete');
    });
});

Route::prefix('petugas')->group(function (){
    Route::middleware('auth:api-petugas')->group(function () {
        Route::get('/profile','PetugasController@profile');
        Route::put('/','PetugasController@update');
    });
    Route::middleware('auth:api-admin')->group(function (){
        Route::get('/','PetugasController@index');
        Route::get('/{id}','PetugasController@show');
        Route::delete('/{id}','PetugasController@delete'); 
    });
});

Route::prefix('titik_banjir')->group(function(){
    Route::get('/','TitikBanjirController@index');
    Route::get('/{id}','TitikBanjirController@show');
    
    Route::middleware('auth:api-admin')->group(function(){
        Route::post('/','TitikBanjirController@create');
        Route::put('/{id}','TitikBanjirController@update');
        Route::delete('/{id}','TitikBanjirController@delete');
    });
});

Route::prefix('titik_tersumbat')->group(function(){
    Route::get('/','TitikTersumbatController@index');
    Route::get('/{id}','TitikTersumbatController@show');
    
    Route::middleware('auth:api-admin')->group(function(){
        Route::post('/','TitikTersumbatController@create');
        Route::put('/{id}','TitikTersumbatController@update');
        Route::delete('/{id}','TitikTersumbatController@delete');
    });
});

Route::prefix('drainase')->group(function (){
    Route::get('/','DrainaseController@index');
    Route::get('/{id}','DrainaseController@show');

    Route::middleware('auth:api-admin')->group(function (){
        Route::post('/','DrainaseController@create');
        Route::put('/{i}','DrainaseController@update');
        Route::delete('/{i}','DrainaseController@delete');
    });
});

Route::prefix('pengaduan')->group(function (){
    Route::get('/','PengaduanController@index');
    Route::get('/{id}','PengaduanController@index');
    
    Route::middleware('auth:api-masyarakat')->group(function (){
        Route::post('/','PengaduanController@create');
        
    });
    
    

    Route::middleware('auth:api-admin')->group(function (){
        
        Route::delete('/{id}','PengaduanController@delete');
    });
});

Route::prefix('update_pengaduan')->group(function(){
    Route::put('/admin/{id}','PengaduanController@updateAdmin')->middleware('auth:api-admin');
    Route::put('/petugas/{id}','PengaduanController@updatePetugas')->middleware('auth:api-petugas');
    Route::put('/masyarakat/{id}','PengaduanController@feedbackMasyarakat')->middleware('auth:api-masyarakat');
});





