<?php
Route::group(['namespace' => 'Gallery'], function () {
    Route::get('gallery', 'AdminGalleryController@showAlbums')->name('gallery.index');
    Route::get('gallery/albums', 'AdminGalleryController@Albums')->name('gallery.albums');
    Route::get('gallery/create-album', 'AdminGalleryController@createAlbumView')->name('gallery.create-album');
    Route::get('gallery/edit-album/{id}', 'AdminGalleryController@createEditAlbumView')->name('gallery.edit-album');


    Route::get('gallery/ajax-delete-album/{id}', 'AdminGalleryController@deleteAlbum')->name('gallery.ajax-delete-album');

    Route::post('gallery/ajax-create-album', 'AdminGalleryController@createAlbum')->name('gallery.ajax-create-album');
    Route::post('gallery/ajax-edit-album/{id}', 'AdminGalleryController@editAlbum')->name('gallery.ajax-edit-album');

    Route::post('gallery/ajax-add-images', 'AdminGalleryController@addImages')->name('gallery.ajax-add-images');
    Route::post('gallery/ajax-remove-image', 'AdminGalleryController@removeImage')->name('gallery.ajax-remove-images');
});