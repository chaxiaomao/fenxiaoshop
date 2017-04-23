<?php
namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use App\Tool\WechatMenu\WechatMenu;
use App\Models\M3Result;

class WechatMenuController extends Controller
{
    public function setWechatMenu()
    {
        $menu = new WechatMenu();
        return $menu->createMenu();
    }

}