<?php
namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Entity\Orders;
use App\Entity\OrderItem;
use Cart;
use App\Models\M3Result;

class OrderController extends Controller
{
    public function createOrder(Request $request)
    {
        $total = Cart::getTotal();
        $wechat_user = $request->session()->get('wechat_user');
//        生成订单
        $ordsn = "E" . date('Ymd') . mt_rand(100000, 999999);
        $oid = Orders::insertGetId([
            'money' => $total,
            'openid' => $wechat_user['id'],
            'ordsn' => $ordsn,
            'invalid' => 1,
            'create_at' => date("Y-m-d H:i:s", time() + 8 * 60 * 60),
        ]);

        return $oid;
    }

    public function storageOrder(Request $request)
    {
//        支付前的更新订单
        Orders::where('oid', $request->input('oid', ''))->update([
            'receiver' => $request->input('rec', ''),
            'address' => $request->input('dz', ''),
            'tel' => $request->input('tel', ''),
            'invalid' => 0
        ]);
//        订单入库
        $gs = Cart::getContent();
        foreach ($gs as $g) {
            $item = new OrderItem();
            $item->product_id = $g['id'];
//            $item->ordsn = $request->input('oid', '');
            $item->oid = $request->input('oid', '');
            $item->name = $g['name'];
            $item->count = $g['quantity'];
//            $item->pdt_snapshot = json_encode($gs);
            $item->price = $g['price'];
            $item->preview = $g['attributes']['product_preview'];
            $item->save();
        }

    }

    public function deleteOrder(Request $request)
    {
        $dorder = Orders::where('oid', $request->input('oid', ''))->update(['invalid' => 1]);
        $m3_result = new M3Result();
        $m3_result->status = 0;
        $m3_result->message = "删除成功";
        return $m3_result->toJson();
    }
}