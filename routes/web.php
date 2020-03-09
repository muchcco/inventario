<?php


Route::get('/', 'HomeController@index')->name('welcome');

Auth::routes();


Route::group(['prefix'=>'inventario','as'=>'inventario.'],function () {

    Route::get('equipo', 'EquipoController@index')->name('equipo.index');
    Route::get('equipo/tabla', 'EquipoController@tabla')->name('equipo.tabla');
    Route::get('equipo/create', 'EquipoController@create')->name('equipo.create');
    Route::post('equipo/store', 'EquipoController@store')->name('equipo.store');
    Route::post('equipo/edit', 'EquipoController@edit')->name('equipo.edit');
    Route::put('equipo/{equipo}', 'EquipoController@update')->name('equipo.update');
    Route::delete('equipo/{equipo}', 'EquipoController@destroy')->name('equipo.destroy');

    Route::get('marca', 'MarcaController@index')->name('marca.index');
    Route::get('marca/tabla', 'MarcaController@tabla')->name('marca.tabla');
    Route::get('marca/create', 'MarcaController@create')->name('marca.create');
    Route::post('marca/store', 'MarcaController@store')->name('marca.store');
    Route::post('marca/edit', 'MarcaController@edit')->name('marca.edit');
    Route::put('marca/{marca}', 'MarcaController@update')->name('marca.update');
    Route::delete('marca/{marca}', 'MarcaController@destroy')->name('marca.destroy');


    Route::get('modelo', 'ModeloController@index')->name('modelo.index');
    Route::get('modelo/tabla', 'ModeloController@tabla')->name('modelo.tabla');
    Route::get('modelo/create', 'ModeloController@create')->name('modelo.create');
    Route::post('modelo/store', 'ModeloController@store')->name('modelo.store');
    Route::post('modelo/subtipos', 'ModeloController@subtipos')->name('modelo.subtipos');
    Route::post('modelo/edit', 'ModeloController@edit')->name('modelo.edit');
    Route::put('modelo/{modelo}', 'ModeloController@update')->name('modelo.update');
    Route::delete('modelo/{modelo}', 'ModeloController@destroy')->name('modelo.destroy');


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


    Route::get('subtipo', 'SubtipoController@index')->name('subtipo.index');
    Route::get('subtipo/tabla', 'SubtipoController@tabla')->name('subtipo.tabla');
    Route::get('subtipo/create', 'SubtipoController@create')->name('subtipo.create');
    Route::post('subtipo/store', 'SubtipoController@store')->name('subtipo.store');
    Route::post('subtipo/edit', 'SubtipoController@edit')->name('subtipo.edit');
    Route::put('subtipo/{tipo}', 'SubtipoController@update')->name('subtipo.update');
    Route::delete('subtipo/{tipo}', 'SubtipoController@destroy')->name('subtipo.destroy');


});


Route::group(['prefix'=>'generales','as'=>'generales.'],function () {

    Route::get('dependencia', 'DependenciaController@index')->name('dependencia.index');
    Route::get('dependencia/tabla', 'DependenciaController@tabla')->name('dependencia.tabla');
    Route::get('dependencia/create', 'DependenciaController@create')->name('dependencia.create');
    Route::post('dependencia/store', 'DependenciaController@store')->name('dependencia.store');
    Route::post('dependencia/edit', 'DependenciaController@edit')->name('dependencia.edit');
    Route::put('dependencia/{dependencia}', 'DependenciaController@update')->name('dependencia.update');
    Route::delete('dependencia/{dependencia}', 'DependenciaController@destroy')->name('dependencia.destroy');



    Route::get('personal', 'PersonalController@index')->name('personal.index');
    Route::get('personal/tabla', 'PersonalController@tabla')->name('personal.tabla');
    Route::get('personal/create', 'PersonalController@create')->name('personal.create');
    Route::get('personal/dependencia', 'PersonalController@dependencia')->name('personal.dependencia');
    Route::post('personal/store', 'PersonalController@store')->name('personal.store');
    Route::post('personal/buscar', 'PersonalController@buscar')->name('personal.buscar');
    Route::get('personal/edit/{personal}', 'PersonalController@edit')->name('personal.edit');
    Route::put('personal/{personal}', 'PersonalController@update')->name('personal.update');
    Route::delete('personal/{personal}', 'PersonalController@destroy')->name('personal.destroy');
});

    Route::get('usuarios', 'UsuarioController@index')->name('usuarios.index');
    Route::get('usuarios/tabla', 'UsuarioController@tabla')->name('usuarios.tabla');
    Route::get('usuarios/create', 'UsuarioController@create')->name('usuarios.create');
    Route::post('usuarios/store', 'UsuarioController@store')->name('usuarios.store');
    Route::post('usuarios/edit', 'UsuarioController@edit')->name('usuarios.edit');
    Route::put('usuarios/{usuarios}', 'UsuarioController@update')->name('usuarios.update');
    Route::delete('usuarios/{usuarios}', 'UsuarioController@destroy')->name('usuarios.destroy');


?>
