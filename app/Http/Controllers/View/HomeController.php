<?php
namespace App\Http\Controllers\View;

use Illuminate\Routing\Controller;
use App\Entity\Product;

class HomeController extends Controller
{
    public function home()
    {
        $products = Product::where('num', '>', '0')->get();
        return view('shop.home')->with('products', $products);
    }
}