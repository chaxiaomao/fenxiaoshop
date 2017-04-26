<?php
namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use App\Tool\WechatMenu\WechatMenu;
use App\Models\M3Result;
//原生写法，不用，路由删掉中··
class WechatMenuController extends Controller
{
    public function setWechatMenu()
    {
        $menu = new WechatMenu();
        return $menu->createMenu();
    }

}