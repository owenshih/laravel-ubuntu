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

// PATCH
// Route::get('/auth', '');
// Route::post('/auth', '');
// Route::get('/auth', '');
// Route::post('/auth', '');
Route::post('/login', 'Auth\LoginController@login');
Route::post('/register', 'Auth\RegisterController@register');

// 官網API
Route::group(['prefix' => 'website'], function () {
	Route::resource('index_carousel', 'Website\IndexCarouselController');
	Route::resource('landspace', 'Website\LandspaceController');
	Route::resource('partner', 'Website\PartnerController');
	Route::resource('active_carousel', 'Website\ActiveCarouselController');
	Route::resource('active_card', 'Website\ActiveCardController');
	Route::resource('active_album', 'Website\ActiveAlbumController');
	Route::resource('diary', 'Website\DiaryController');
	Route::resource('industry', 'Website\IndustryController');
	Route::resource('faq', 'Website\FaqController');
	Route::resource('faq_type', 'Website\FaqTypeController');
});

// 簡訊API

Route::resource('short_message_service_example', 'ShortMessageServiceExampleController');
Route::resource('short_message_service_history', 'ShortMessageServiceHistoryController');
Route::get('get_message_quota','ShortMessageServiceExampleController@getMessageQuota');



// Route::resource('text_message_sample', 'TextMessage\SampleController');
// Route::post('text_message', 'TextMessage\ConsoleController@send');
// Route::get('text_message_history', 'TextMessage\HistoryController@index');
// Route::get('text_message_history/{text_message_history}', 'TextMessage\HistoryController@show');
// Route::resource('text_message_sample', 'TextMessage\SampleController');

// 旅宿管理API
Route::resource('hotel', 'HotelController');
Route::resource('hotel_cooperation', 'HotelCooperationController');
Route::resource('hotel_return', 'HotelReturnController');

// 地區API
Route::get('city', 'CityController@index');
Route::get('town/{id}', 'TownController@show');

//合約
Route::resource('hotel.contract', 'HotelContractController');

// 業務管理作業API
Route::group(['prefix' => 'business'], function () {
	Route::resource('return', 'Business\ReturnController'); // 回報
	Route::resource('track', 'Business\TrackController'); // 追蹤
});

//經費管理
Route::resource('funding', 'FundingController');