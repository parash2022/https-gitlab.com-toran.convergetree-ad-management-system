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


Auth::routes(['verify' => true]);

Route::get('/', 'HomeController@index')->name('home');
Route::get('/nepse', 'NepseController@index')->name('nepse.index');

Route::prefix('administrator')->middleware(['verified', 'auth', 'administrator'])->group(function () {

	Route::get('/', 'Admin\IndexController@index')->name('administrator.index');



	Route::prefix('taxonomies')->group(function () {
		Route::get('/', 'Admin\TaxonomyController@index')->name('administrator.taxonomies.index');
		Route::get('/create', 'Admin\TaxonomyController@create')->name('administrator.taxonomies.create');
		Route::post('/store', 'Admin\TaxonomyController@store')->name('administrator.taxonomies.store');
		Route::get('/edit/{id}', 'Admin\TaxonomyController@edit')->name('administrator.taxonomies.edit');
		Route::post('/update/{id}', 'Admin\TaxonomyController@update')->name('administrator.taxonomies.update');
		Route::post('/delete/{id}', 'Admin\TaxonomyController@delete')->name('administrator.taxonomies.delete');
	});
	Route::group(['prefix' => '{taxonomy}/terms'], function () {
		Route::get('/', 'Admin\TermController@index')->name('administrator.terms.index');
		Route::get('/create', 'Admin\TermController@create')->name('administrator.terms.create');
		Route::post('/store', 'Admin\TermController@store')->name('administrator.terms.store');
		Route::get('/edit/{id}', 'Admin\TermController@edit')->name('administrator.terms.edit');
		Route::post('/update/{id}', 'Admin\TermController@update')->name('administrator.terms.update');
		Route::post('/delete/{id}', 'Admin\TermController@delete')->name('administrator.terms.delete');
	});
	Route::prefix('users')->group(function () {
		Route::get('/', 'Admin\UserController@index')->name('administrator.users.index');
		Route::get('/create', 'Admin\UserController@create')->name('administrator.users.create');
		Route::post('/store', 'Admin\UserController@store')->name('administrator.users.store');
		Route::get('/edit/{id}', 'Admin\UserController@edit')->name('administrator.users.edit');
		Route::post('/update/{id}', 'Admin\UserController@update')->name('administrator.users.update');
		Route::post('/delete/{id}', 'Admin\UserController@delete')->name('administrator.users.delete');
	});
	Route::prefix('roles')->group(function () {
		Route::get('/', 'Admin\RoleController@index')->name('administrator.roles.index');
		Route::get('/create', 'Admin\RoleController@create')->name('administrator.roles.create');
		Route::post('/store', 'Admin\RoleController@store')->name('administrator.roles.store');
		Route::get('/edit/{id}', 'Admin\RoleController@edit')->name('administrator.roles.edit');
		Route::post('/update/{id}', 'Admin\RoleController@update')->name('administrator.roles.update');
		Route::post('/delete/{id}', 'Admin\RoleController@delete')->name('administrator.roles.delete');
	});
	Route::prefix('ads')->group(function () {
		Route::get('/', 'Admin\AdController@index')->name('administrator.ads.index');
		Route::get('/create', 'Admin\AdController@create')->name('administrator.ads.create');
		Route::post('/store', 'Admin\AdController@store')->name('administrator.ads.store');
		Route::get('/edit/{id}', 'Admin\AdController@edit')->name('administrator.ads.edit');
		Route::post('/update/{id}', 'Admin\AdController@update')->name('administrator.ads.update');
		Route::post('/delete/{id}', 'Admin\AdController@delete')->name('administrator.ads.delete');
		Route::get('/copy/{id}', 'Admin\AdController@copy')->name('administrator.ads.copy');
	});
	Route::prefix('clients')->group(function () {
		Route::get('/', 'Admin\ClientController@index')->name('administrator.clients.index');
		Route::get('/create', 'Admin\ClientController@create')->name('administrator.clients.create');
		Route::post('/store', 'Admin\ClientController@store')->name('administrator.clients.store');
		Route::get('/edit/{id}', 'Admin\ClientController@edit')->name('administrator.clients.edit');
		Route::post('/update/{id}', 'Admin\ClientController@update')->name('administrator.clients.update');
		Route::post('/delete/{id}', 'Admin\ClientController@delete')->name('administrator.clients.delete');
	});
	Route::prefix('push-notification')->group(function () {
		Route::get('/', 'Admin\NoticeController@index')->name('administrator.notification.index');
		Route::get('/create', 'Admin\NoticeController@create')->name('administrator.notification.create');
		Route::post('/store', 'Admin\NoticeController@store')->name('administrator.notification.store');
		// Route::get('/edit/{id}', 'Admin\NoticeController@edit')->name('administrator.notification.edit');
		// Route::post('/update/{id}', 'Admin\NoticeController@update')->name('administrator.notification.update');
		// Route::post('/delete/{id}', 'Admin\NoticeController@delete')->name('administrator.notification.delete');
	});
	Route::prefix('app-user')->group(function () {
		Route::get('/', 'Admin\NoticeController@appUser')->name('administrator.notification.appUser');
	});
});

Route::post('/ajax/getSubCats', 'Admin\CategoryController@getSubCats')->name('category.subcategory');
