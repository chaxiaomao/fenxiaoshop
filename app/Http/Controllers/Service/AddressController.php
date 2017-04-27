<?php
namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Entity\Address;

class AddressController extends Controller
{
    public function saveAddress(Request $request)
    {
        $openid = $request->session()->get('wechat_user');
        //先判断如果地址state==0,则把之前的默认地址改为1,
        if($request->input('state', '') == 0) {

            Address::where('openid', $openid['id'])->where('invalid', 0)->where('default' ,0)->update(['default' => 1]);
        }
        //aid不为0或者不为null时候，则为修改收货地址
        if (!empty($request->aid)) {
            Address::where('aid' ,$request->aid)->update([
                'receiver' => $request->input('rec',''),
                'city' => $request->input('city',''),
                'location' => $request->input('dz',''),
                'default' => $request->input('state',''),
                'tel' => $request->input('tel','')
            ]);
            exit();
        }
        //增加地址，返回aid
        $aid = Address::insertGetId([
            'receiver' => $request->input('rec',''),
            'city' => $request->input('city',''),
            'location' => $request->input('dz',''),
            'default' => $request->input('state',''),
            'tel' => $request->input('tel',''),
            'openid' => $openid['id']
        ]);
        return $aid;
    }
}