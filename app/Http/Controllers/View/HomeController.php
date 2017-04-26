<?php
namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use App\Entity\Product;
use EasyWeChat\Foundation\Application;

class HomeController extends Controller
{
    public function home()
    {
        $products = Product::where('product_num', '>', '0')->get();
        return view('shop.home')->with('products', $products);
    }

}