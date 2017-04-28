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
Route::get('/', function () {
    return view('welcome');
});

Route::get('/detail/{gid}', 'View\CartController@detail');
Route::get('/buy/{gid}', 'Service\DarryCartController@buy');
Route::get('/cart', 'View\CartController@cart');

Route::get('/login', 'View\MemberController@toLogin');
Route::get('/register', 'View\MemberController@toRegister');

Route::group(['perfix' => 'service'], function () {
    Route::get('/service/validate_code/create', 'Service\ValidateController@create');
    Route::post('/service/validate_phone/send', 'Service\ValidateController@sendMSM');
    Route::any('/service/wx_menu', 'Service\WxMenuController@WxMenu');
    Route::post('/service/register', 'Service\MemberController@register');
    Route::post('/service/login', 'Service\MemberController@login');
    Route::any('/service/wechat', 'Service\WxController@serve');
    Route::any('/service/oauth_callback', 'Service\OauthController@OauthCallback');
    Route::get('/service/delete_product', 'Service\DarryCartController@deleteProduct');
    Route::get('/service/increase_item', 'Service\DarryCartController@increaseItem');
    Route::get('/service/decrease_item', 'Service\DarryCartController@decreaseItem');
    Route::post('/service/save_address', 'Service\AddressController@saveAddress');
    Route::get('/service/create_order', 'Service\OrderController@createOrder');
    Route::get('/service/storage_order', 'Service\OrderController@storageOrder');
    Route::get('/service/revise', 'Service\PersonalController@revise');
});

Route::group(['middleware' => 'wechat.oauth'], function () {
    Route::get('/personal', 'View\PersonalController@personal');
    Route::get('/home', 'View\HomeController@home');
    Route::get('/order/{ordsn}', 'View\OrderController@order');
});

Route::group(['perfix' => 'personal'], function() {
    Route::get('personal/revise', 'View\PersonalController@revise');
    Route::get('personal/orders', 'View\PersonalController@orders');
});