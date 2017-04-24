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
        $members = new Member();
        $member = $members->where('openid', $user['id'])->first();
        if($member->phone == null || $member->phone == "") {
            return view('shop.first');
        }
        return view('shop.personal');
    }
}