<?php
namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Entity\Orders;
use Cart;

class CreateOrderController extends Controller
{
    public function createOrder(Request $request)
    {
        $total = Cart::getTotal();
        $openid = $request->session()->get('wechat_user');
        //生成订单
        $ordsn = date('Ymd') . mt_rand(100000, 999999);
        Orders::insert([
            'money' => $total,
            'openid' => $openid['id'],
            'ordsn' => $ordsn,
            'create_at' => date("Y-m-d H:i:s", time() + 8 * 60 * 60),
        ]);

        return $ordsn;
    }
}