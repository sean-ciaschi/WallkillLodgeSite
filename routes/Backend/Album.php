<?php

/**
 * All route names are prefixed with 'admin.'.
 */
Route::get('/createalbum', array('as' => 'create_album_form','uses' => 'Gallery\AlbumsController@getForm'))->name('create_album');
Route::get('/deletealbum/{id}', array('as' => 'delete_album','uses' => 'Gallery\AlbumsController@getDelete'));

Route::post('/createalbum', array('as' => 'create_album','uses' => 'Gallery\AlbumsController@postCreate'));
