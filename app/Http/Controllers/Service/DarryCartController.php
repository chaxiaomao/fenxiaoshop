<?php
namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use Cart;
use App\Entity\Product;

class DarryCartController extends Controller
{
    public function buy($gid)
    {
        $product = Product::where('product_id', $gid)->first();
        Cart::add($gid, $product->product_name, $product->product_price, 1, array('product_preview' => $product->product_preview));
        return redirect('/cart');
    }

    public function deleteProduct()
    {
        Cart::remove($_GET['gid']);
        return Cart::getTotal();
    }

    public function increaseItem()
    {
        $product = Product::where('product_id', $_GET['gid'])->first();
        Cart::add($_GET['gid'], $product->product_name, $product->product_price, 1, array('product_preview' => $product->product_preview));
        return Cart::getTotal();
    }

    public function decreaseItem()
    {
        Cart::update($_GET['gid'], array('quantity' => -1));
        return Cart::getTotal();
    }

}