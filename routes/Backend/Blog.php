<?php

/**
 * All route names are prefixed with 'admin.'.
 */
Route::get('blog', 'Blog\BlogController@index')->name('blog');
