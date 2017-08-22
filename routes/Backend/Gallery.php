<?php
Route::group(['namespace' => 'Gallery'], function () {
    Route::get('gallery', 'AdminGalleryController@showAlbums')->name('gallery.index');
    Route::get('gallery/albums', 'AdminGalleryController@Albums')->name('gallery.albums');
    Route::get('gallery/create-album', 'AdminGalleryController@createAlbumView')->name('gallery.create-album');
    Route::get('gallery/edit-album/{id}', 'AdminGalleryController@createEditAlbumView')->name('gallery.edit-album');

    Route::post('gallery/ajax-create-album', 'AdminGalleryController@createAlbum')->name('gallery.ajax-create-album');
    Route::post('gallery/ajax-edit-album/{id}', 'AdminGalleryController@editAlbum')->name('gallery.ajax-edit-album');
    Route::get('gallery/ajax-delete-album/{id}', 'AdminGalleryController@deleteAlbum')->name('gallery.ajax-delete-album');

    Route::get('gallery/add-images', 'AdminGalleryController@addImagesView')->name('gallery.add-images');
    Route::post('gallery/ajax-add-images', 'AdminGalleryController@addImages')->name('gallery.ajax-add-images');
    Route::get('gallery/ajax-remove-images', 'AdminGalleryController@removeImages')->name('gallery.ajax-remove-images');
});