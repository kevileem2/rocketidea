<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::name('news.')->group(function () {
    Route::get('/news', 'NewsController@getIndex')->name('index');
    Route::get('/news/new', 'NewsController@getCreate')->name('create');
    Route::post('/news/save', 'NewsController@postSave')->name('save');
    Route::get('/news/edit/{news_id}', 'NewsController@getEdit')->name('edit');
    Route::get('/news/detail/{news_id}', 'NewsController@getDetail')->name('detail');
    Route::get('/news/delete/{news_id}', 'NewsController@destroy')->name('delete');
});

Route::name('projects.')->group(function () {
    Route::get('/projects', 'ProjectsController@getIndex')->name('index');
    Route::get('/myprojects', 'ProjectsController@getMyProjects')->name('myprojects');
    Route::get('/projects/new', 'ProjectsController@getCreate')->name('create');
    Route::get('/projects/edit/{projectId}', 'ProjectsController@getEdit')->name('edit');
    Route::get('/projects/detail/{projectId}', 'ProjectsController@getDetail')->name('detail');
    Route::post('/projects/save', 'ProjectsController@postSave')->name('save');
    Route::get('/projects/delete/{projectId}', 'ProjectsController@destroy')->name('delete');
    Route::get('/promote/projectId={projectId}/promotionId={promotionId}', 'ProjectsController@getPromote')->name('promote');
});

Route::name('categories.')->group(function () {
    Route::get('/projects/{category}', 'CategoryController@getIndex')->name('index');
});

Route::name('donators.')->group(/*['middleware' => ['auth']], */function () {
    Route::post('/projects/savefund', 'DonatorsController@postDonator')->name('save');
});

Route::name('comments.')->group(function () {
    Route::post('/projects/savecomment', 'CommentsController@postComment')->name('save');
});
Route::name('shop.')->group(function () {
    Route::get('/shop', 'ShopController@getIndex')->name('index');
    Route::post('/shop/confirmed', 'ShopController@postPayment')->name('payment');
});

Route::get('/about', 'AboutController@getIndex')->name('about');

Route::get('/', 'HomeController@getIndex')->name('homePage');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
