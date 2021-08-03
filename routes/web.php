<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register'=> false, 'reset'=>false]);

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('categories', 'CategoryController');
Route::resource('suplayer', 'SuplayerController');
Route::resource('product', 'ProductController');
Route::resource('productdetail', 'ProductDetailController');
Route::resource('client', 'ClientController');
Route::resource('project', 'ProjectController');
Route::post('/projectbarang/store/{id}', 'ProjectProductController@store')->name('projectbarang.store');
Route::get('/projectbarang/edit/{id}', 'ProjectProductController@edit')->name('projectbarang.edit');
Route::delete('/projectbarang/delete/{id}', 'ProjectProductController@destroy')->name('projectbarang.destroy');

Route::get('/laporan/barang/cetak_pdf', 'ProductController@cetak_pdf')->name('cetak.laporan');
Route::get('/laporan/unit/cetak_pdf', 'ProductDetailController@cetak_pdf')->name('cetak.unit');