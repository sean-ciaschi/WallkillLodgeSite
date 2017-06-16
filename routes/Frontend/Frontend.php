<?php

/**
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */
Route::get('/', 'FrontendController@index')->name('index');
Route::get('macros', 'FrontendController@macros')->name('macros');

/*
 * These frontend controllers require the user to be logged in
 * All route names are prefixed with 'frontend.'
 */
Route::group(['middleware' => 'auth'], function () {
    Route::group(['namespace' => 'User', 'as' => 'user.'], function () {
        /*
         * User Dashboard Specific
         */
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');

        /*
         * User Account Specific
         */
        Route::get('account', 'AccountController@index')->name('account');

        /*
         * User Profile Specific
         */
        Route::patch('profile/update', 'ProfileController@update')->name('profile.update');
    });
});


Route::get('/calendar', function()
{
    return view('frontend.calendar.calendar');
})->name('calendar');

Route::get('/trestle-board','Blog\BlogController@index')->name('trestle-board.index');
Route::get('/trestle-board/get-posts','Blog\BlogController@getPosts')->name('trestle-board.get-posts');
Route::get('/trestle-board/delete-post/{id}','Blog\BlogController@deletePost')->name('trestle-board.delete-post');
Route::get('/trestle-board/download-attachment/{fileName}','Blog\BlogController@downloadAttachment')->name('trestle-board.download-attachment');

Route::get('/album/{id}', array('as' => 'show_album','uses' => 'AlbumsController@getAlbum'));

Route::get('/addimage/{id}', array('as' => 'add_image','uses' => 'ImagesController@getForm'));
Route::post('/addimage', array('as' => 'add_image_to_album','uses' => 'ImagesController@postAdd'));
Route::get('/deleteimage/{id}', array('as' => 'delete_image','uses' => 'ImagesController@getDelete'));
