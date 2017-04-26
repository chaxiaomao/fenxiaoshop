@extends('shop.shopbase')

@section('title','购物篮')

@section('m-style')
    <style type="text/css">
        .kong{text-align:center;color:#ccc;height:400px;line-height:400px;font-size:20px;}
    </style>
@endsection

@section('content')
<div id="kong" class="kong">你的购物车空空如也</div>
@endsection

@section('m-js')
    <script type="text/javascript">
        $("#home").removeClass("mui-active");
        $("#personal").removeClass("mui-active");
        $("#cart").addClass("mui-active");
        $("#cart").attr("href","#");
        $("#personal").attr("href","{{url('personal')}}");
        $("#home").attr("href","{{url('/home')}}");
        $("#wxc_icon").removeClass("icon iconfont icon-qrcode-copy-copy");
        $("#wxc_icon").addClass("icon iconfont icon-shouye1");
    </script>
@endsection