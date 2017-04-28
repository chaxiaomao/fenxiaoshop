<?php
namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cart;
use App\Entity\Address;

class OrderController extends Controller
{
    public function order(Request $request, $ordsn)
    {
        $products = Cart::getContent();
        $total = Cart::getTotal();
//        dd(json_encode($products));
        $wechat_user = $request->session()->get('wechat_user');
        //找出所有地址
        $address = Address::where('openid', $wechat_user['id'])->where('invalid', 0)->get();
        //默认地址
        $default = Address::where('openid', $wechat_user['id'])->where('invalid', 0)->where('default', 0)->first();

        return view('shop.order_commit')->with([
            'products' => $products,
            'total' => $total,
            'address' => $address,
            'default' => $default,
            'ordsn' => $ordsn
        ]);
    }

}