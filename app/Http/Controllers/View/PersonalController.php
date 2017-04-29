<?php
namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Entity\Member;
use App\Entity\Orders;
use App\Entity\Address;

class PersonalController extends Controller
{
    public function personal()
    {
        // 已经登录过
        $wechat_user = session()->get('wechat_user');
        //更新用户头像
        Member::where('openid', $wechat_user['id'])->update(['avatar' => $wechat_user['avatar']]);
        $member = Member::where('openid', $wechat_user['id'])->first();
        $p1 = Member::where('uid', $member->p1)->value('user_name'); //找出上一级推荐人
        if ($member->phone == null || $member->phone == "") {
            return view('shop.first');
        }
        return view('shop.personal')->with(['member' => $member, 'p1' => $p1]);
    }

    public function revise(Request $request)
    {
        $wechat_user = session()->get('wechat_user');
        $user = Member::where('openid', $wechat_user['id'])->first();
        return view('shop.revise')->with('user', $user);
    }

    public function orders(Request $request)
    {
        $wechat_user = session()->get('wechat_user');
        $orders = Orders::where('openid', $wechat_user['id'])->where('invalid', 0)->get();
//        dd($orders->item)
        return view('shop.orders')->with('orders', $orders);

    }

    public function address(Request $request)
    {
        $wechat_user = session()->get('wechat_user');
        //找出所有地址
        $address = Address::where('openid', $wechat_user['id'])->where('invalid', 0)->where('default', 1)->get();
        //默认地址
        $default = Address::where('openid', $wechat_user['id'])->where('invalid', 0)->where('default', 0)->first();

        return view('shop.address')->with(['address' => $address, 'default' => $default]);
    }

    public function team(Request $request)
    {
        $wechat_user = session()->get('wechat_user');
        $user = Member::where('openid', $wechat_user['id'])->first();
//        dd($user);
        $agents = Array();
        foreach ([$user->p1, $user->p2, $user->p3] as $k => $p) {
            if ($p > 0) {
                $agents[$k] = Member::where('uid', $p)->first();
            }
        }
//        dd($agents);
        return view('shop.team')->with('agents', $agents);
    }
}