<?php

use Illuminate\Support\Facades\Route;

/**
 * All route names are prefixed with 'admin.'.
 */


Route::group(['namespace' => 'LodgeOfficers'], function () {
    Route::get('lodge-officers', 'AdminLodgeOfficerController@index')->name('officers');
    Route::get('lodge-officers/create', 'AdminLodgeOfficerController@create')->name('officers.create');
    Route::get('lodge-officers/delete/{id}', 'AdminLodgeOfficerController@destroy')->name('officers.delete-officer');
    Route::get('lodge-officers/edit/{id}', 'AdminLodgeOfficerController@update')->name('officers.edit-officer');

    Route::post('lodge-officers/create-officer', 'AdminLodgeOfficerController@createOfficer')->name('officers.create-officer');
    Route::post('lodge-officers/update-officer/{id}', 'AdminLodgeOfficerController@updateOfficer')->name('officers.update-officer');
});
