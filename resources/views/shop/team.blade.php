@extends('shop.master')

@section('title', '我的团队')

@section('m-style')
<style type="text/css">
    .mtap{margin:0 auto; border-bottom:1px solid #eee;}
    .select,.tit{width: 100%;background-color: #fff;height: 50px;color:gray;text-align: center;line-height: 50px;}
    .select li.active{background-color: #e50112;color:#fff;}
    .select li{width:50%;height:50px;float: left;}
    .tit li{width:33%;float: left;font-size:12px;}
    .tit_dash{border-bottom: 1px solid #eee;}
</style>
@endsection

@section('content')
    <div class="mtap">
        <ul class="select">
            <li id="li_1" class="active">未购买</li>
            <li id="li_2">已购买</li>
        </ul>
    </div>
    <div>
        <div>
            <ul class="tit tit_dash">
                <li>昵称</li>
                <li>联系方式</li>
                <li>注册时间</li>
            </ul>
        </div>
        @foreach($agents as $agent)
        <div>
            <ul class="tit">
                <li>{{$agent->user_name}}</li>
                <li>{{$agent->phone}}</li>
                <li>{{$agent->register_at}}</li>
            </ul>
        </div>
        @endforeach
    </div>
@endsection

@section('m-js')
    <script type="text/javascript">
        $(function(){
            //绑定li
            for(var i=1;i<=2;i++){
                $("#li_"+i).bind("click",{index:i},clickHandler);
            }
            function clickHandler(event){
                var i = event.data.index;
                $(".active").removeClass("active");
                $("#li_"+i).addClass("active");
            }
        });
    </script>
@endsection