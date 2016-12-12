<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');
Route::get('/lojas/{titleslug}/{id}', 'StoreController@index');
Route::get('/lojas', 'StoreController@map');
Route::get('/cupons/{store_id}/{id}', 'OfferController@index');
Route::get('/cupons', 'OfferController@top_offers');
Route::get('/search', 'SearchController@index');
Route::get('/sitemap.xml', 'SitemapController@index');