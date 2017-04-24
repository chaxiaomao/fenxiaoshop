@extends('shop.shopbase')

@section('title','个人中心')

@section('content')
    <a href="{{url('login')}}" class="weui-btn weui-btn_plain-primary">登陆</a>
    <a href="{{url('register')}}" class="weui-btn weui-btn_plain-primary weui-btn_plain-disabled">注册</a>
    @endsection

@section('m-js')
    <script>
        $("#home").removeClass("mui-active");
        $("#cart").removeClass("mui-active");
        $("#personal").addClass("mui-active");
        $("#personal").attr("href","#");
        $("#cart").attr("href","{{url('cart')}}");
        $("#home").attr("href","{{url('/home')}}");

    </script>
@endsection