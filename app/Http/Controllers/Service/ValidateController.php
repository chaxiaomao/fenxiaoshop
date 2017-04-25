<?php
namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\M3Result;
use App\Tool\Validate\ValidateCode;
use App\Tool\SMS\SendTemplateSMS;
use App\Entity\TempPhone;

Class ValidateController extends Controller
{
    public function create($value = '')
    {
        $ValidateCode = new ValidateCode();
        return $ValidateCode->doimg();
    }

    public function sendMSM(Request $req)
    {
        $m3_result = new M3Result;
        $phone = $req->input('phone', '');
        if($phone == '') {
            $m3_result->status = 1;
            $m3_result->message = '手机号不能为空';
            return $m3_result->toJson();
        }
        if(strlen($phone) != 11 || $phone[0] != '1') {
            $m3_result->status = 2;
            $m3_result->message = '手机格式不正确';
            return $m3_result->toJson();
        }

        $sendTemplate = new SendTemplateSMS();
        $code = '';
        $charset = '1234567890';
        $_len = strlen($charset) - 1;
        for ($i = 0;$i < 6;++$i) {
            $code .= $charset[mt_rand(0, $_len)];
        }
        $sendTemplate->sendTemplateSMS($phone,array($code,60),1);
//        上线生效
//        判断是否有发送过
//        if($m3_result->status == 0) {
//            $tempPhone = TempPhone::where('phone', $phone)->first();
//            if($tempPhone == null) {
//                $tempPhone = new TempPhone;
//            }
//            $tempPhone->phone = $phone;
//            $tempPhone->code = $code;
//            $tempPhone->deadline = date('Y-m-d H-i-s', time() + 8*60*60);
//            $tempPhone->save();
//        }

//        测试使用
//        判断是否有发送过
        $tempPhone = TempPhone::where('tmp_phone', $phone)->first();
        if($tempPhone == null) {
            $tempPhone = new TempPhone;
        }
        $tempPhone->tmp_phone = $phone;
        $tempPhone->tmp_code = $code;
        $tempPhone->deadline = date('Y-m-d H-i-s', time() + 8*60*60);
        $tempPhone->save();
        $m3_result->status = 0;
        $m3_result->message = "发送成功";
        $m3_result->code = $code;
        return $m3_result->toJson();
    }

}