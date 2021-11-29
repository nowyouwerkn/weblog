<?php

use Illuminate\Support\Facades\Route;
// Back-End Views
Route::group(['prefix' => 'admin/blog', 'middleware' => ['web', 'can:admin_access']], function(){
    //Catalog
    Route::resource('posts', Nowyouwerkn\WeBlog\Controllers\PostController::class);
    Route::resource('categories', Nowyouwerkn\WeBlog\Controllers\CategoryController::class);
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
	'as' => 'wb-blog.index',
]);

Route::get('/blog/{slug}', [
	'uses' => 'Nowyouwerkn\WeBlog\Controllers\FrontController@detail',
	'as' => 'wb-blog.detail',
])->where('slug', '[\w\d\-\_]+');

Route::get('/blog/archive/{autor}', [
	'uses' => 'Nowyouwerkn\WeBlog\Controllers\FrontController@authorList',
	'as' => 'wb-blog.author.list',
])->where('slug', '[\w\d\-\_]+');


/* Search Functions */
Route::get('/busqueda-general', [
    'uses' => 'Nowyouwerkn\WeBlog\Controllers\SearchController@query',
    'as' => 'wb-blog-search.query',
]);