<?php
Route::group(['namespace' => 'Event'], function () {
    Route::get('events', 'AdminEventController@index')->name('events.index');
    Route::get('events/create-event', 'AdminEventController@create')->name('events.create-event');

    Route::post('events/ajax-create-event', 'AdminEventController@ajaxCreateEvent')->name('events.ajax.create-event');
    Route::post('events/ajax-update-event', 'AdminEventController@ajaxUpdateEvent')->name('events.ajax.update-event');
    Route::post('events/ajax-delete-event', 'AdminEventController@ajaxDeleteEvent')->name('events.ajax.delete-event');

});