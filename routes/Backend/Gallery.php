<?php
Route::get('gallery', 'Gallery\AdminGalleryController@showAlbums')->name('gallery.index');
Route::get('gallery/albums', 'Gallery\AdminGalleryController@Albums')->name('gallery.albums');
Route::get('gallery/create-album', 'Gallery\AdminGalleryController@createAlbumView')->name('gallery.create-album');
Route::get('gallery/edit-album/{id}', 'Gallery\AdminGalleryController@createEditAlbumView')->name('gallery.edit-album');

Route::post('gallery/ajax-create-album', 'Gallery\AdminGalleryController@createAlbum')->name('gallery.ajax-create-album');
Route::post('gallery/ajax-edit-album/{id}', 'Gallery\AdminGalleryController@editAlbum')->name('gallery.ajax-edit-album');
Route::post('gallery/ajax-delete-album/{id}', 'Gallery\AdminGalleryController@deleteAlbum')->name('gallery.ajax-delete-album');

Route::get('gallery/add-images', 'Gallery\AdminGalleryController@addImagesView')->name('gallery.add-images');
Route::post('gallery/ajax-add-images', 'Gallery\AdminGalleryController@addImages')->name('gallery.ajax-add-images');