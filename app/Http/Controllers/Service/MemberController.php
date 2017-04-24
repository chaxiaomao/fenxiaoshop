<?php
namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\M3Result;
use App\Entity\TempPhone;
use App\Entity\Member;

class MemberController extends Controller
{
    public function login()
    {

    }

    public function register(Request $req)
    {
        $phone = $req->input('phone', '');
        $password = $req->input('password', '');
        $confirm = $req->input('confirm', '');
        $phone_code = $req->input('phone_code', '');
//        $phone = $req->phone;
//        $password = $req->password;
//        $confirm = $req->confirm;
//        $phone_code = $req->phone_code;

        $m3_result = new M3Result;

        if ($password == '' || strlen($password) < 6) {
            $m3_result->status = 2;
            $m3_result->message = '密码不少于6位';
            return $m3_result->toJson();
        }
        if ($confirm == '' || strlen($confirm) < 6) {
            $m3_result->status = 3;
            $m3_result->message = '确认密码不少于6位';
            return $m3_result->toJson();
        }
        if ($password != $confirm) {
            $m3_result->status = 4;
            $m3_result->message = '两次密码不相同';
            return $m3_result->toJson();
        }

        // 手机号注册
        if ($phone != '') {
            if ($phone_code == '' || strlen($phone_code) != 6) {
                $m3_result->status = 5;
                $m3_result->message = '手机验证码为6位';
                return $m3_result->toJson();
            }
            $tempPhone = TempPhone::where('phone', $phone)->first();
            if ($tempPhone->code == $phone_code) {
                if (time() > strtotime($tempPhone->deadline)) {
                    $m3_result->status = 7;
                    $m3_result->message = '手机验证码不正确';
                    return $m3_result->toJson();
                }
                $user = $req->session()->get('wechat_user');
                Member::where('openid', $user['id'])->update(['phone' => $phone, 'password' => md5('wxc' . $password)]);
                $m3_result->status = 0;
                $m3_result->message = '注册成功';
                return $m3_result->toJson();
            } else {
                $m3_result->status = 7;
                $m3_result->message = '手机验证码不正确';
                return $m3_result->toJson();
            }
        }
    }
}