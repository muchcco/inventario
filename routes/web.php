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
    Route::delete('marca/{marca}', 'MarcaController@destroy')->name('marca.destroy');


    Route::get('tipo', 'TipoController@index')->name('tipo.index');
    Route::get('tipo/tabla', 'TipoController@tabla')->name('tipo.tabla');
    Route::get('tipo/create', 'TipoController@create')->name('tipo.create');
    Route::post('tipo/store', 'TipoController@store')->name('tipo.store');
    Route::post('tipo/edit', 'TipoController@edit')->name('tipo.edit');
    Route::put('tipo/{tipo}', 'TipoController@update')->name('tipo.update');
    Route::delete('tipo/{tipo}', 'TipoController@destroy')->name('tipo.destroy');


    Route::get('subtipo', 'SubtipoController@index')->name('subtipo.index');
    Route::get('subtipo/tabla', 'SubtipoController@tabla')->name('subtipo.tabla');
    Route::get('subtipo/create', 'SubtipoController@create')->name('subtipo.create');
    Route::post('subtipo/store', 'SubtipoController@store')->name('subtipo.store');
    Route::post('subtipo/edit', 'SubtipoController@edit')->name('subtipo.edit');
    Route::put('subtipo/{tipo}', 'SubtipoController@update')->name('subtipo.update');
    Route::delete('subtipo/{tipo}', 'SubtipoController@destroy')->name('subtipo.destroy');

});

    Route::get('usuarios', 'UsuarioController@index')->name('usuarios.index');
    Route::get('usuarios/tabla', 'UsuarioController@tabla')->name('usuarios.tabla');
    Route::get('usuarios/create', 'UsuarioController@create')->name('usuarios.create');
    Route::post('usuarios/store', 'UsuarioController@store')->name('usuarios.store');
    Route::post('usuarios/edit', 'UsuarioController@edit')->name('usuarios.edit');
    Route::put('usuarios/{usuarios}', 'UsuarioController@update')->name('usuarios.update');
    Route::delete('usuarios/{usuarios}', 'UsuarioController@destroy')->name('usuarios.destroy');


?>
