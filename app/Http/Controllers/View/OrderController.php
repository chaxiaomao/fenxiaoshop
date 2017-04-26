<?php
namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cart;
use App\Entity\Address;

class OrderController extends Controller
{
    public function order(Request $request)
    {
        $dz;
        $products = Cart::getContent();
        $total = Cart::getTotal();
        $openid = $request->session()->get('wechat_user');
        //找出所有地址
        $address = Address::where('openid', $openid['id'])->where('invalid', 0)->get();
        $default_addres = Address::where('openid', $openid['id'])->where('invalid', 0)->where('default', 1)->first();
        if($default_addres == null) {
            $dz = 0;
        }
        return view('shop.order_commit')->with(['products' => $products, 'total' => $total, 'address' => $address, 'default_addres' => $default_addres->toArray()]);
    }
}