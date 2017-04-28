@extends('shop.master')

@section('title', '我的订单')
<link rel="stylesheet" type="text/css" href="/css/bootstrap.css">
@section('m-style')
<style>
    *{padding:0px;margin:0px;font-family: "微软雅黑";}
    body{background-color:rgb(229,229,229);margin-bottom: 60px;}
    ul,li{list-style:none}
    #nul{height:auto;background-color: #fff;width:99%;margin:0 auto;color:gray;}
    #nul li{display:inline-block;line-height:60px;height: 60px;width:19%;text-align: center;}
    #nul li.active{border-bottom: 3px solid #e50112;}
    #sul{height: auto;width:99%;margin: 0 auto;color:gray;}
    #sul>li{margin-top:20px;background-color: #fff;}
    .sli-1{height: auto}
    .sli-1>li:first-child{border-bottom: 1px solid #ddd;line-height: 50px;font-size: 12px}
    .sli-1>li span{}
    .sli-2 img{width:90px;height: 75px;background-color: red;margin-top:20px;}
    .sli-2{height: auto;position: relative;}
    .sli-2 button{position: absolute;bottom:0px;height: 45px;border-radius: 5px;background-color: #e50112;color: #fff;border:none;padding:10px;letter-spacing: 2px;font-size: 13.33px}
    button:nth-last-child(1){right: 100px;}
    button:nth-last-child(2){right: 5px;}
    #none{text-align: center;font-size: 20px;color:gray;z-index: 99;position: absolute;top:100px;height: 100%;width: 100%;background-color: rgb(229,229,229);display: none;}
</style>
@endsection

@section('content')
    <div>
        <ul id="nul" >
            <li id="li_1" class="active">全部</li>
            <li id="li_2">待付款</li>
            <li id="li_3">待发货</li>
            <li id="li_4">待收货</li>
            <li id="li_5">退款</li>
        </ul>
    </div>
    <div id="have">
        <ul id="sul">
            @foreach($orders as $order)
                <li id="oitem_{{$order->oid}}">
                    <ul class="sli-1 container-fluid">
                        <li class="row">
                            <span id="ordsn_{{$order->oid}}" class="col-md-4">{{$order->ordsn}}</span>
                            <span class="col-md-4">￥{{$order->money}}</span>
                            <span class="col-md-4">{{$order->create_at}}</span>
                        </li>
                        <li>
                            <ul class="sli-2">
                                @foreach($order->item as $pre)
                                    <li><img src="{{$pre->preview}}"></li>
                                @endforeach
                                <button id="delete_{{$order->oid}}" class="shanchu" onclick="deOrdsn(this)">立即删除</button>
                                <button>立即支付</button>
                            </ul>
                        </li>
                        <li>
                            <p style="padding:20px 20px 0 0">待付款</p>
                        </li>
                    </ul>
                </li>
            @endforeach
        </ul>
    </div>
    <div id="none">
        暂无数据!
    </div>
@endsection

@section('m-js')
    <script type="text/javascript">
        $(function(){
            //绑定li
            for(var i=1;i<=5;i++){
                $("#li_"+i).bind("click",{index:i},clickHandler);
            }
            function clickHandler(event){
                var i = event.data.index;
                $(".active").removeClass("active");
                $("#li_"+i).addClass("active");
            }

        });

        function deOrdsn(obj) {
            $(".shanchu").click(function(){
                if(confirm("你确定要删除此订单?")){
                    var de_ordsn;
                    var elm = $(obj).attr("id");
                    de_ordsn = $("#"+"ordsn_"+elm.slice(7)).html();
                    $.ajax({
                        url:"{{url('wxcshop/personal/deleteOrdsn')}}",
                        type:"get",
                        data:{ordsn:de_ordsn},
                        time:3000,
                        success: function(){
                            $("#"+"oitem_"+elm.slice(7)).hide();
                        },
                        error: function(){
                            alert("出错了,请稍后再试");
                        }
                    });
                }else{
                    return;
                }
            });
        }
    </script>

@endsection