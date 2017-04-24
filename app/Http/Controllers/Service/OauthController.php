<?php
namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use EasyWeChat\Foundation\Application;

class OauthController extends Controller
{
    public function OauthCallback()
    {
        $config = [
            'debug'     => true,
            'app_id'    => env('WX_ID'),
            'secret'    => env('WX_SEC'),
            'token'     => env('WX_TK'),
        ];
        $app = new Application($config);
        $oauth = $app->oauth;
        // 获取 OAuth 授权结果用户信息
        $user = $oauth->user();
        session()->put('wechat_user', $user->toArray());
        return redirect('/home');
    }

}