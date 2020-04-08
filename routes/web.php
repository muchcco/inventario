<?php




Auth::routes();


Route::group(['prefix'=>'inventario','as'=>'inventario.'],function () {

    Route::get('equipo', 'EquipoController@index')->name('equipo.index');
    Route::get('equipo/dashboard', 'EquipoController@dashboard')->name('equipo.dashboard');
    Route::post('equipo/tabla', 'EquipoController@tabla')->name('equipo.tabla');
    Route::get('equipo/listar', 'EquipoController@listar')->name('equipo.listar');
    Route::get('equipo/create', 'EquipoController@create')->name('equipo.create');
    Route::post('equipo/store', 'EquipoController@store')->name('equipo.store');
    Route::post('equipo/edit', 'EquipoController@edit')->name('equipo.edit');
    Route::put('equipo/{equipo}', 'EquipoController@update')->name('equipo.update');
    Route::delete('equipo/{equipo}', 'EquipoController@destroy')->name('equipo.destroy');
    Route::post('equipo/modalbaja', 'EquipoController@modalbaja')->name('equipo.modalbaja');
    Route::post('equipo/baja', 'EquipoController@baja')->name('equipo.baja');


    //Software
    Route::get('software/so', 'SoftwareController@so')->name('software.so');
    Route::get('software/create_so', 'SoftwareController@create_so')->name('software.create_so');
    Route::post('software/store_so', 'SoftwareController@store_so')->name('software.store_so');

    Route::get('software/sw', 'SoftwareController@sw')->name('software.sw');
    Route::get('software/create_sw', 'SoftwareController@create_sw')->name('software.create_sw');
    Route::post('software/store_sw', 'SoftwareController@store_sw')->name('software.store_sw');

    Route::get('software/av', 'SoftwareController@av')->name('software.av');
    Route::get('software/create_av', 'SoftwareController@create_av')->name('software.create_av');
    Route::post('software/store_av', 'SoftwareController@store_av')->name('software.store_av');



    //Subtipo
    Route::get('equipo/subtipo/{subtipo}', 'EquipoController@subtipo')->name('equipo.subtipo');
    Route::get('equipo/subtipo/{subtipo}/create', 'EquipoController@subtipo_create')->name('equipo.subtipo_create');
    Route::post('equipo/subtipo/subtipo_store', 'EquipoController@subtipo_store')->name('equipo.subtipo_store');
    Route::get('equipo/subtipo/{subtipo}/edit/{Equipo}', 'EquipoController@subtipo_edit')->name('equipo.subtipo_edit');
    Route::put('equipo/subtipo/subtipo_update/{Equipo}', 'EquipoController@subtipo_update')->name('equipo.subtipo_update');
    Route::post('equipo/subtipo/delete', 'EquipoController@subtipo_delete')->name('equipo.subtipo_delete');
    Route::delete('equipo/subtipo/{equipo}', 'EquipoController@subtipo_destroy')->name('equipo.subtipo_destroy');
    //Route::get('equipo/subtipo/{subtipo}/create/{id}', 'EquipoController@subtipo_crtudp')->name('equipo.subtipo.crtudp');

//lista de equipos y sus asignaciones
    Route::get('equipo/asignacion/{Equipo}', 'AsignacionController@create')->name('asignacion.create');
    Route::post('equipo/asignacion/store', 'AsignacionController@store')->name('asignacion.store');
    Route::get('equipo/asignacion/edit/{asignacion}', 'AsignacionController@edit')->name('asignacion.edit');
    Route::put('equipo/asignacion/{asignacion}', 'AsignacionController@update')->name('asignacion.update');
    Route::post('equipo/asignacion/desasignar', 'AsignacionController@desasignar')->name('asignacion.desasignar');
    Route::post('equipo/asignacion/desasignado', 'AsignacionController@desasignado')->name('asignacion.desasignado');
    Route::get('equipo/asignacion/reasignar/{asignacion}', 'AsignacionController@reasignar')->name('asignacion.reasignar');
    Route::put('equipo/asignacion/reasignado/{asignacion}', 'AsignacionController@reasignado')->name('asignacion.reasignado');

//asignacion historico
    Route::get('asignacionhistorico', 'AsignacionHistoricoController@index')->name('asignacionhistorico.index');
    Route::any('asignacionhistorico/tabla', 'AsignacionHistoricoController@tabla')->name('asignacionhistorico.tabla');
    Route::get('asignacionhistorico/buscar_personal', 'AsignacionHistoricoController@buscar_personal')->name('asignacionhistorico.buscar_personal');

//buscar por usuario
    Route::get('busquedaxusuario', 'BusquedaxUsuarioController@buscarusuario')->name('busquedaxusuario.buscarusuario');
    Route::any('busquedaxusuario/tabla', 'BusquedaxUsuarioController@tabla')->name('busquedaxusuario.tabla');
    Route::any('busquedaxusuario/cantidades', 'BusquedaxUsuarioController@cantidades')->name('busquedaxusuario.cantidades');
    Route::any('busquedaxusuario/reasignar', 'BusquedaxUsuarioController@modal_reasignar')->name('busquedaxusuario.modal_reasignar');
    Route::put('busquedaxusuario/reasignado/{asignacion}', 'BusquedaxUsuarioController@modal_reasignado')->name('busquedaxusuario.modal_reasignado');
    Route::get('busquedaxusuario/asignacion/{Equipo}', 'BusquedaxUsuarioController@modal_create')->name('busquedaxusuario.modal_create');
    Route::post('busquedaxusuario/asignacion/moda_store', 'BusquedaxUsuarioController@modal_store')->name('busquedaxusuario.modal_store');




    Route::group(['prefix'=>'parametro'],function () {
        Route::get('marca', 'MarcaController@index')->name('marca.index');
        Route::get('marca/tabla', 'MarcaController@tabla')->name('marca.tabla');
        Route::get('marca/create', 'MarcaController@create')->name('marca.create');
        Route::post('marca/store', 'MarcaController@store')->name('marca.store');
        Route::any('marca/edit', 'MarcaController@edit')->name('marca.edit');
        Route::put('marca/{marca}', 'MarcaController@update')->name('marca.update');
        Route::delete('marca/{marca}', 'MarcaController@destroy')->name('marca.destroy');


        Route::get('modelo', 'ModeloController@index')->name('modelo.index');
        Route::get('modelo/tabla', 'ModeloController@tabla')->name('modelo.tabla');
        Route::get('modelo/create', 'ModeloController@create')->name('modelo.create');
        Route::post('modelo/store', 'ModeloController@store')->name('modelo.store');
        Route::post('modelo/subtipos', 'ModeloController@subtipos')->name('modelo.subtipos');
        Route::post('modelo/modelos', 'ModeloController@modelos')->name('modelo.modelos');
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


        Route::get('subtipo', 'SubTipoController@index')->name('subtipo.index');
        Route::get('subtipo/tabla', 'SubTipoController@tabla')->name('subtipo.tabla');
        Route::get('subtipo/create', 'SubTipoController@create')->name('subtipo.create');
        Route::post('subtipo/store', 'SubTipoController@store')->name('subtipo.store');
        Route::post('subtipo/edit', 'SubTipoController@edit')->name('subtipo.edit');
        Route::put('subtipo/{tipo}', 'SubTipoController@update')->name('subtipo.update');
        Route::delete('subtipo/{tipo}', 'SubTipoController@destroy')->name('subtipo.destroy');
    });


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
    Route::post('personal/busqueda', 'PersonalController@busqueda')->name('personal.busqueda');
    Route::post('personal/agregarmodal', 'PersonalController@agregarmodal')->name('personal.agregarmodal');
    Route::post('personal/guardarmodal', 'PersonalController@guardarmodal')->name('personal.guardarmodal');
});

Route::group(['prefix'=>'graficos','as'=>'graficos.'],function () {
    Route::any('equiposPorOrganosDesconcentrados', 'HomeController@equiposPorOrganosDesconcentrados')->name('equiposPorOrganosDesconcentrados');
    Route::any('equiposPorTipo', 'HomeController@equiposPorTipo')->name('equiposPorTipo');



});
    Route::get('/', 'HomeController@index')->name('welcome');
    Route::get('usuarios', 'UsuarioController@index')->name('usuarios.index');
    Route::get('usuarios/tabla', 'UsuarioController@tabla')->name('usuarios.tabla');
    Route::get('usuarios/create', 'UsuarioController@create')->name('usuarios.create');
    Route::post('usuarios/store', 'UsuarioController@store')->name('usuarios.store');
    Route::any('usuarios/dependencia', 'UsuarioController@dependencia')->name('usuarios.dependencia');
    Route::post('usuarios/edit', 'UsuarioController@edit')->name('usuarios.edit');
    Route::put('usuarios/{usuarios}', 'UsuarioController@update')->name('usuarios.update');
    Route::delete('usuarios/{usuarios}', 'UsuarioController@destroy')->name('usuarios.destroy');




    Route::any('logout', 'Auth\LoginController@logout')->name('logout');
?>
