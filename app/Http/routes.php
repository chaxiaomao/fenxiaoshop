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

Route::get('/cart', function () {
    return view('shop.cart');
});

Route::get('/personal', 'View\PersonalController@personal');
Route::any('/home', 'View\HomeController@home');

Route::get('/login', 'View\MemberController@toLogin');
Route::get('/register', 'View\MemberController@toRegister');

Route::group(['perfix' => 'service'], function () {
    Route::get('/service/validate_code/create', 'Service\ValidateController@create');
    Route::post('/service/validate_phone/send', 'Service\ValidateController@sendMSM');
    Route::any('/service/wechat_menu', 'Service\WechatMenuController@setWechatMenu');
    Route::post('/service/register', 'Service\MemberController@register');
    Route::post('/service/login', 'Service\MemberController@login');
    Route::any('/service/wechat', 'Service\WxController@serve');
    Route::any('/service/oauth_callback', 'Service\OauthController@OauthCallback');
});