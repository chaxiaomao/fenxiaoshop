<?php
namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use App\Http\Requests\Request;
use App\Entity\Member;

class PersonalController extends Controller
{
    public function personal()
    {
        // 已经登录过
        $user = session()->get('wechat_user');
        Member::where('openid', $user['id'])->update(['user_avatar' => $user['avatar']]);
        $member = Member::where('openid', $user['id'])->first();
        $p1 = Member::where('uid', $member->p1)->value('user_name');
        if ($member->user_phone == null || $member->user_phone == "") {
            return view('shop.first');
        }
        return view('shop.personal')->with(['member' => $member, 'p1' => $p1]);
    }
}