<?php


Route::get('/', 'HomeController@index')->name('welcome');

Auth::routes();


Route::group(['prefix'=>'inventario','as'=>'inventario.'],function () {

    Route::get('marca', 'MarcaController@index')->name('marca.index');
    Route::get('marca/tabla', 'MarcaController@tabla')->name('marca.tabla');
    Route::get('marca/create', 'MarcaController@create')->name('marca.create');
    Route::post('marca/store', 'MarcaController@store')->name('marca.store');
    Route::post('marca/edit', 'MarcaController@edit')->name('marca.edit');
    Route::put('marca/{marca}', 'MarcaController@update')->name('marca.update');


});

?>
