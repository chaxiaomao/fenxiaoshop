<?php
namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use App\Entity\Member;
use Illuminate\Http\Request;
use App\Models\M3Result;

class PersonalController extends Controller
{
    public function revise(Request $request)
    {
        $wechat_user = $request->session()->get('wechat_user');
        Member::where('openid', $wechat_user['id'])->update(['user_name' => $request->input('name', '')]);
        $m3_result = new M3Result;
        $m3_result->status = 0;
        $m3_result->message = "修改成功";
        return $m3_result->toJson();

    }
}