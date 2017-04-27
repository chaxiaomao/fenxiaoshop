<?php
namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Entity\Member;

class ReviseController extends Controller
{
    public function revise(Request $request)
    {
        $info = $request->session()->get('wechat_user');
        $user = Member::where('openid', $info['id'])->first();
        return view('shop.revise')->with('user', $user);
    }
}