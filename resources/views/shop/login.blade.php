@extends('shop.master')

@include('component.loading')
@section('title','登陆')
<style>
    p{text-align: center;margin-top:20px;}
    .weui-btn_primary{margin-top:40px;width:80%;}
</style>
@section('content')
    <div class="weui-cells__title">微小茶 - 注册</div>
    <div class="weui-cells weui-cells_form">
        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">手机</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="number" value="" placeholder="请输入手机号"/>
            </div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">密码</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="password" value="" placeholder="请输入密码"/>
            </div>
        </div>
    </div>
    <a href="javascript:;" class="weui-btn weui-btn_primary">登陆</a>
    <p><a href="{{url('register')}}">没有账号？立即注册</a></p>

@endsection

@section('m-js')
    <script>
    $(".weui-vcode-img").click(function () {
        $(this).attr("src",'service/validate_code/create?random=' + Math.random());
    })
    </script>
    @endsection