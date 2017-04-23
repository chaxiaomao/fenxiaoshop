<?php
namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;

class MemberController extends Controller
{
    public function toLogin() {
        return View('shop.login');
    }

    public function toRegister() {
        return View('shop.register');
    }
}