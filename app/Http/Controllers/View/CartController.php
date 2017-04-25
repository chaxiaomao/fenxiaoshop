<?php
namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use App\Entity\Product;
use Cart;

class CartController extends Controller
{
    public function cart()
    {
        if(Cart::isEmpty()) {
            return view('shop.blank_cart');
        }
        $products = Cart::getContent();
        $total = Cart::getTotal();
        return view('shop.cart')->with(['products' => $products->toArray(), 'total' => $total]);
    }

    public function detail($gid)
    {
        return view('shop.detail')->with('gid', $gid);
    }

}