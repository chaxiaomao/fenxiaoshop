<?php
namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Entity\Member;
use App\Entity\Orders;

class PersonalController extends Controller
{
    public function personal()
    {
        // 已经登录过
        $user = session()->get('wechat_user');
        Member::where('openid', $user['id'])->update(['avatar' => $user['avatar']]);
        $member = Member::where('openid', $user['id'])->first();
        $p1 = Member::where('uid', $member->p1)->value('user_name');
        if ($member->phone == null || $member->phone == "") {
            return view('shop.first');
        }
        return view('shop.personal')->with(['member' => $member, 'p1' => $p1]);
    }

    public function revise(Request $request)
    {
        $info = $request->session()->get('wechat_user');
        $user = Member::where('openid', $info['id'])->first();
        return view('shop.revise')->with('user', $user);
    }

    public function orders(Request $request)
    {
        $openid = $request->session()->get('wechat_user');
        $orders = Orders::where('openid', $openid['id'])->where('invalid', 0)->get();
//        dd($orders->item)
        return view('shop.orders')->with('orders', $orders);

    }
}