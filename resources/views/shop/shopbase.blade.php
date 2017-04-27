<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="stylesheet" type="text/css" href="/css/weui.css">
    <link rel="stylesheet" type="text/css" href="/css/mui.css">
    <link rel="stylesheet" type="text/css" href="/css/wxc.css">
    <link rel="stylesheet" href="/css/iconfont.css">
</head>
@yield('m-style')
<body>
    <!-- tooltips -->
    @include('component.toasting')
    @include('component.loading')
    <div>
        @yield('content')
    </div>
    <nav class="mui-bar mui-bar-tab">
        <a class="mui-tab-item mui-active" id="home" href="#">
            <span id="wxc_icon" style="position:relative;top:2px;" class="icon iconfont icon-qrcode-copy-copy" aria-hidden="true"></span><br>
            <span class="mui-tab-label ex_icon_font">我的二维码</span>
        </a>
        <a class="mui-tab-item" id="cart" href="#">
            <span class="icon iconfont icon-gouwuche01"></span><br>
            <span class="mui-tab-label ex_icon_font">购物车</span>
        </a>
        <a class="mui-tab-item" id="personal" href="#">
            <span class="icon iconfont icon-geren"></span><br>
            <span class="mui-tab-label ex_icon_font">个人中心</span>
        </a>
    </nav>
    <img id="kefu" src="/imgs/kf.png">
</body>
<script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
@yield('m-js')
</html>