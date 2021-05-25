<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
	return $request->user();
});

Route::prefix('V1')->group(function () {
	Route::get('/platforms', 'API\V1\V1Controller@platforms');
	Route::get('/adTypes', 'API\V1\V1Controller@adTypes');
	Route::get('/adCategories', 'API\V1\V1Controller@adCategories');
	Route::get('/ads', 'API\V1\V1Controller@ads');
});

Route::prefix('V2')->group(function () {
	Route::get('/platforms', 'API\V2\ApiController@platforms');
	Route::get('/adTypes', 'API\V2\ApiController@adTypes');
	Route::get('/adCategories', 'API\V2\ApiController@adCategories');
	Route::get('/ads', 'API\V2\ApiController@ads');
	Route::post('/appUser', 'API\V2\ApiController@appUser');
});
