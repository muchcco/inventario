<?php


Route::get('/', 'HomeController@index')->name('welcome');

Auth::routes();


Route::group(['middleware' => ['auth']], function () {
    Route::get('home', [ 'as' => 'home', 'uses' => 'PagesController@home' ]);

});

?>
