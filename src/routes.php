<?php

use Illuminate\Support\Facades\Route;
// Back-End Views
Route::group(['prefix' => 'admin', 'middleware' => ['web', 'can:admin_access']], function(){
    //Catalog
    Route::resource('posts', Nowyouwerkn\WeBlog\Controllers\ProductController::class); //
    Route::resource('categories', Nowyouwerkn\WeBlog\Controllers\CategoryController::class); //

    Route::get('/reviews/aprobar/{id}',[
        'uses' => 'Nowyouwerkn\WeBlog\Controllers\ReviewController@approve',
        'as' => 'review.approve',
    ]);
});

// RSS Feed
Route::get('/rss-feed', [
    'uses' => 'Nowyouwerkn\WeBlog\Controllers\FrontController@rssFeed',
    'as' => 'rss.feed',
]);

/* 
 * FRONT VIEWS
 *
*/
Route::get('/blog', [
	'uses' => 'Nowyouwerkn\WeBlog\Controllers\FrontController@index',
	'as' => 'blog.index',
]);

Route::get('/blog/{slug}', [
	'uses' => 'Nowyouwerkn\WeBlog\Controllers\FrontController@detail',
	'as' => 'blog.detail',
])->where('slug', '[\w\d\-\_]+');

Route::get('/blog/archive/{autor}', [
	'uses' => 'Nowyouwerkn\WeBlog\Controllers\FrontController@authorList',
	'as' => 'blog.author.list',
])->where('slug', '[\w\d\-\_]+');


/* Search Functions */
Route::get('/busqueda-general', [
    'uses' => 'Nowyouwerkn\WeBlog\Controllers\SearchController@query',
    'as' => 'search.query',
]);