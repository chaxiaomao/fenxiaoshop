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
        Member::where('openid', $user['id'])->update(['avatar' => $user['avatar']]);
        $member = Member::where('openid', $user['id'])->first();
        $p1 = Member::where('uid', $member->p1)->value('user_name');
        if ($member->phone == null || $member->phone == "") {
            return view('shop.first');
        }
        return view('shop.personal')->with(['member' => $member, 'p1' => $p1]);
    }
}