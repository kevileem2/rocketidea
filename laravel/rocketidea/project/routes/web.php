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

Route::name('shop.')->group(function () {
    Route::get('/shop', 'ShopController@getIndex')->name('index');
    Route::post('/shop/confirmed', 'ShopController@postPayment')->name('payment');
});

Route::get('/about', 'AboutController@getIndex')->name('about');

Route::get('/', 'HomeController@getIndex')->name('homePage');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
