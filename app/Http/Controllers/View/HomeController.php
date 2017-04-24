<?php
namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use App\Entity\Product;
use EasyWeChat\Foundation\Application;

class HomeController extends Controller
{
    public function home()
    {
        $config = [
            'debug'     => true,
            'app_id'    => env('WX_ID'),
            'secret'    => env('WX_SEC'),
            'token'     => env('WX_TK'),
            'oauth' => [
                'scopes'   => ['snsapi_userinfo'],
                //回调地址
                'callback' => '/service/oauth_callback',
            ],
        ];
        //使用配置初始化一个项目实例
        $app = new Application($config);
        //从项目实例中得到一个oauth应用实例
        $oauth = $app->oauth;
        // 未登录
        if (empty(session()->get('wechat_user'))) {
            return $oauth->redirect();
            // 这里不一定是return，如果你的框架action不是返回内容的话你就得使用
            // $oauth->redirect()->send();
        }
        $products = Product::where('num', '>', '0')->get();
        return view('shop.home')->with('products', $products);
    }

}