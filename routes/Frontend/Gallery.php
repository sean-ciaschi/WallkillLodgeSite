<?php
Route::get('gallery/albums', 'Gallery\GalleryController@albumView')->name('gallery.albums');
Route::get('gallery/album/{id}', 'Gallery\GalleryController@imageView')->name('gallery.images');
