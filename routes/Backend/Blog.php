<?php

/**
 * All route names are prefixed with 'admin.'.
 */
Route::get('blog', 'Blog\AdminBlogController@index')->name('blog');
Route::get('blog/blog-create', 'Blog\AdminBlogController@create')->name('blog.create');
Route::post('blog/create-post', 'Blog\AdminBlogController@createPost')->name('blog.create-post');
