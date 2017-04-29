@extends('shop.shopbase')

@section('title','个人中心')

@section('m-style')
    <style>
        .mui-content,.mui-grid-view.mui-grid-9{background-color:#fff !important;}
        .mui-content > .mui-table-view:first-child{margin-top: 0px;}
        .mui-bar-tab .mui-tab-item.mui-active{color:#e50112;}
        .mui-navigate-right:after, .mui-push-right:after{content: none !important}
        .mui-navigate-right img{float: left;width:72px;height: 72px;border-radius: 50%;}
        .mui-navigate-right .xinxi{float: left;height:72px;padding-left: 10px;line-height: 25px;}
        .jiantou{float: right;height: 72px;line-height: 72px;}
        .mui-grid-view.mui-grid-9 .mui-table-view-cell{padding: 0 15px; line-height: 30px;}
        .more{margin-top:10px;}
        .more span {display: inline-block;color: gray;float: right;}
        .mui-table-view-cell > a:not(.mui-btn){color:gray;}
        .huiyuan{width:100%;height:40px;text-align:center;margin-top:10px;background-color:#FFF}
        .huiyuan a{color:gray;line-height:40px;padding:40px;}
        .mui-bar-tab ~ .mui-content {padding-bottom: 0px;}
        .mui-table-view.mui-grid-view .mui-table-view-cell .mui-media-body {color:gray;line-height:12px;font-size:12px;display: block;width: 100%;height: 15px;margin-top: 0px;text-overflow: ellipsis;color: gray;}
        .icon-chanpinxiangqingqianwang{color:gray;top:0px;font-size:12px;float: right;}
    </style>
@endsection

@section('content')
    <div class="mhead">红茶只喝微小茶</div>
    <div id="genggai" class="mui-content">
        <div class="mui-row">
            <div class="mui-col-sm-11 mui-col-xs-12">
                <li class="mui-table-view-cell">
                    <a class="mui-navigate-right" href="{{url('/personal/revise')}}">
                        <img src="{{$member->avatar}}">

                        <div class="xinxi">
                            <p>会员号:{{$member->user_id}}</p>

                            <p>会员昵称:{{$member->user_name}}</p>

                            <p>推荐人:{{$p1}}</p>
                        </div>
                        <div class="jiantou"><span class="icon iconfont icon-chanpinxiangqingqianwang"></span></div>
                    </a>
                </li>
            </div>
        </div>
    </div>
    <div class="mui-content">
        <!--触发字符：mgrid-->
        <ul class="mui-table-view mui-grid-view mui-grid-9">
            <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-3">
                <a href="#">
                    {{--<span style="color:#e50112;">0<span>元</span></span>--}}
                    <span class="icon iconfont wxc_red">0元</span>

                    <div class="mspan mui-media-body">我的业绩</div>
                </a>
            </li>
            <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-3">
                <a href="{{url('/personal/team')}}">
                    <span class="icon iconfont icon-hexintuandui"></span>

                    <div class="mspan mui-media-body">我的团队</div>
                </a>
            </li>
            <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-3">
                <a href="#">
                    <span class="icon iconfont icon-icon"></span>

                    <div class="mui-media-body">现金管理</div>
                </a>
            </li>
            <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-3">
                <a href="#">
                    <span class="icon iconfont icon-qrcode-copy-copy"></span>

                    <div class="mui-media-body">我的二维码</div>
                </a>
            </li>
            <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-3">
                <a href="{{url("/personal/orders")}}">
                    <span class="icon iconfont icon-wodedingdan"></span>

                    <div class="mui-media-body">我的订单</div>
                </a>
            </li>
            <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-3">
                <a href="#">
                    <span class="icon iconfont icon-tuiguangjilu-copy"></span>

                    <div class="mui-media-body">产品推广</div>
                </a>
            </li>
        </ul>
    </div>
    <div class="huiyuan">
        <a href="{{url('/personal/team')}}">未购买会员</a><span style="color:gray">|</span>
        <a href="{{url('/personal/team')}}">已购买会员</a>
    </div>
    <div class="more mui-content">
        <div class="mui-row">
            <div class="mui-col-sm-11 mui-col-xs-12">
                <li class="mui-table-view-cell">
                    <a href="{{url('/personal/team')}}">
                        我的会员
                        <span class="icon iconfont icon-chanpinxiangqingqianwang"></span>
                    </a>
                </li>
            </div>
        </div>
    </div>
    <div class="more mui-content">
        <div class="mui-row">
            <div class="mui-col-sm-11 mui-col-xs-12">
                <li class="mui-table-view-cell">
                    <a href="{{url('/personal/address')}}">
                        收货地址
                        <span class="icon iconfont icon-chanpinxiangqingqianwang"></span>
                    </a>
                </li>
            </div>
        </div>
    </div>
    <div class="more mui-content">
        <div class="mui-row">
            <div class="mui-col-sm-11 mui-col-xs-12">
                <li class="mui-table-view-cell">
                    <a>
                        我的消费额度 <span class="wxc_red">0</span>
                    </a>
                </li>
            </div>
        </div>
    </div>
@endsection

@section('m-js')
    <script>
        $("#home").removeClass("mui-active");
        $("#cart").removeClass("mui-active");
        $("#personal").addClass("mui-active");
        $("#personal").attr("href", "#");
        $("#cart").attr("href", "{{url('cart')}}");
        $("#home").attr("href", "{{url('/home')}}");
        $("#wxc_icon").removeClass("icon iconfont icon-qrcode-copy-copy");
        $("#wxc_icon").addClass("icon iconfont icon-shouye1");
    </script>
@endsection