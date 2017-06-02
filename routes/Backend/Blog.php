<?php

/**
 * All route names are prefixed with 'admin.'.
 */
Route::get('blog', 'Blog\BlogController@index')->name('blog');
Route::get('blog/blog-create', 'Blog\BlogController@create')->name('blog.create');
