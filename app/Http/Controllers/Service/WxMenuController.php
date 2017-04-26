<?php
namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use EasyWeChat\Foundation\Application;
use App\Models\M3Result;

class WxMenuController extends Controller
{
    public $menu;

    function __construct(Application $app)
    {
        $this->menu = $app->menu;
    }

    public function WxMenu()
    {
        $m3_result = new M3Result();
        $buttons = [
            [
                "type" => "click",
                "name" => "微小茶",
                "key"  => "V1001_TODAY_MUSIC"
            ],
            [
                "name"       => "商城",
                "sub_button" => [
                    [
                        "type" => "view",
                        "name" => "微小茶",
                        "url"  => "http://fenxiaoshop.tunnel.2bdata.com/home"
                    ],
                    [
                        "type" => "view",
                        "name" => "视频",
                        "url"  => "http://v.qq.com/"
                    ],
                    [
                        "type" => "click",
                        "name" => "赞一下我们",
                        "key" => "V1001_GOOD"
                    ],
                ],
            ],
        ];
        $this->menu->add($buttons);
        $m3_result->status = 0;
        $m3_result->message = "更新菜单成功";
        return $m3_result->toJson();
    }

}