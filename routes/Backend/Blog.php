<?php

use Illuminate\Support\Facades\Route;

/**
 * All route names are prefixed with 'admin.'.
 */


Route::group(['namespace' => 'Blog'], function () {
    Route::get('blog', 'AdminBlogController@index')->name('blog');
    Route::get('blog/blog-create', 'AdminBlogController@create')->name('blog.create');
    Route::get('blog/delete-post/{id}', 'AdminBlogController@destroy')->name('blog.delete-post');
    Route::get('blog/edit-post/{id}', 'AdminBlogController@update')->name('blog.edit-post');

    Route::post('blog/create-post', 'AdminBlogController@createPost')->name('blog.create-post');
    Route::post('blog/update-post/{id}', 'AdminBlogController@updatePost')->name('blog.update-post');
});
