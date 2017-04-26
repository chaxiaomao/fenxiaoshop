@extends('shop.shopbase')

@section('title','购物篮')

@section('m-style')
    <style>
        .mother{height: auto;padding: 20px;}
        .father{padding-left:20px;}
        .sister{height: 100px; background-color: #fff;border-radius:10px;margin:0 auto;padding:5px;margin-bottom: 20px;position:relative;}
        .s_left,.s_right,.chacha{display: inline-block;}
        .sister img{width:90px;height:90px;}
        .s_left{float:left;}
        .s_right{position:absolute;overflow: hidden;white-space: nowrap;left: 90px; line-height: 1.6;}
        .s_right p{font-size: 14px;}
        .chacha{width:18px;height: 18px;line-height: 18px; border-radius: 50%;color:#e50112; border:1px solid #e50112;right:5px;top:5px;position: absolute;}
        input[type='button'], input[type='submit'], input[type='reset'], button, .mui-btn{padding: 0px;}
        .bother{display: inline-block;float: right;position: absolute;top:70px;right: 10px;}
        .sum{text-align: center;clear:both}
        .mui-numbox {height: 20px;border:none;background-color: rgba(0,0,0,0);}
        .mui-numbox .mui-numbox-btn-minus,.mui-numbox .mui-numbox-btn-plus{border-radius: 50% !important;}
        .mui-numbox .mui-numbox-btn-minus{left:10px;}
        .mui-numbox .mui-numbox-btn-plus{right:10px;}
        .mui-numbox .mui-numbox-input, .mui-numbox .mui-input-numbox{border:1px solid #ccc !important;}
        .mui-numbox [class*=numbox-btn]{width: 20px;color: #fff;background-color: #e50112;}
        .btn {position: relative;top:20px;width: 360px;height: 60px;margin:0 auto;}
        .lbtn,.rbtn{position:absolute;display:inline-block;width:40%;height:40px;}
        .lbtn {left:20px;}
        .rbtn {right:20px;}
        .mui-bar-tab .mui-tab-item.mui-active{color:#e50112;}
        .mui-btn-negative, .mui-btn-danger, .mui-btn-red {border:1px solid #e50112;background-color:#e50112;}
        .mui-numbox .mui-numbox-input, .mui-numbox .mui-input-numbox{font-size: 14px;}
        #you{z-index: 99;}
        #kong{display: none;}
        .kong{text-align:center;color:#ccc;height:400px;line-height:400px;font-size:20px;}
    </style>
@endsection

@section('content')
    <div class="mhead">红茶只喝微小茶</div>
    <div id="you">
        <div class="mstep">
            <img src="/imgs/l1.png">
        </div>
        <div class="mother">
            @foreach($products as $product)
                <div id="item_{{$product['id']}}" class="sister">
                    <div class="s_left"><img src="{{$product['attributes']['product_preview']}}"></div>
                    <div class="s_right">
                        <!-- <p>微小茶古树儒香红茶(20包/箱)</p> -->
                        <p id="goods_name">{{$product['name']}}</p>
                        <p>￥<input id="price_{{$product['id']}}" class="wxc_red" value="{{$product['price']}}" readonly></p>
                    </div>
                    <!-- <div class="chacha"></div> -->
                    <button id="chacha_{{$product['id']}}" type="button" class="chacha" onclick="clearItem(this)">×</button>
                    <div class="bother">
                        <div id="{{$product['id']}}" class="mui-numbox">
                            <button class="mui-btn mui-numbox-btn-minus" type="button" onclick="decItem(this)">-</button>
                            <input id="inp_{{$product['id']}}" class="mui-numbox-input" type="number" value="{{$product['quantity']}}" readonly/>
                            <button class="mui-btn mui-numbox-btn-plus" type="button" onclick="incItem(this)">+</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div style="padding-bottom:60px;">
            <p class="sum">商品总额:￥<span id="sum" class="wxc_red">{{$total}}</span></p>
            <div class="btn">
                <a href="{{url('/home')}}"><button type="button" class="lbtn mui-btn mui-btn-danger">继续逛逛</button></a>
                <a href="{{url('/order')}}"><button type="button" class="rbtn mui-btn mui-btn-danger">&nbsp;去结算&nbsp;</button></a>
            </div>
        </div>
    </div>
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
    <script type="text/javascript">
        function clearItem(obj)
        {
            var elemID = $(obj).attr("id");
            // var gval = $("#"+gid+'inp');
            var gid = elemID.slice(7);
            $.ajax({
                type:'get',
                url:"{{url('service/delete_product')}}",
                data:{gid:gid},
                success:function(data){
                    $('#'+"item_"+gid).hide();
                    //console.log(data);
                    if(data == 0){
                        $("#you").hide();
                        $("#kong").show();
                    }
                    $("#sum").html(data);
                },
                error:function(xhr,state){
                    alert("出错了,请稍后试试");
                }
            });
        }

        function incItem(obj)
        {
            var count = 1;
            var newcount = 0;
            //Wert holen + Rechnen
            var elemID = $(obj).parent().attr("id");
            var countField = $("#"+'inp_'+elemID);
            var count = $("#"+'inp_'+elemID).val();
            var newcount = parseInt(count) + 1;
            $.ajax({
                type:'get',
                url:"{{url('service/increase_item')}}",
                data:{gid:elemID},
                success:function(data){
                    $("#sum").html(data);
                },
                error:function(){

                }
            });
            //Neuen Wert setzen
            $("#"+'inp_'+elemID).val(newcount);
        }

        function decItem(obj)
        {
            var count = 1;
            var newcount = 0;
            //Wert holen + Rechnen
            var elemID = $(obj).parent().attr("id");
            var countField = $("#"+'inp_'+elemID);
            var count = $("#"+'inp_'+elemID).val();
            var newcount = parseInt(count) - 1;
            if(newcount < 1){
                $("#"+'inp_'+elemID).val(1);
                return false;
            }
            $.ajax({
                type:'get',
                url:"{{url('service/decrease_item')}}",
                data:{gid:elemID},
                success:function(data){
                    $("#sum").html(data);
                },
                error:function(){

                }
            });
            //Neuen Wert setzen
            $("#"+'inp_'+elemID).val(newcount);
        }
    </script>
@endsection