@extends('shop.master')

@section('title', '订单确认')

@section('m-style')
    <style type="text/css">
        body {
            background-color: rgb(229, 229, 229);
            padding-bottom: 0px;
        }
    </style>
@endsection

@section('content')
    <div id="order">
        <div class="mhead">红茶只喝微小茶</div>
        <div class="mstep"><img src="/imgs/l2.png"></div>
        <input id="oid" name="oid" type="hidden" value="{{$ordsn}}"/>
        <!-- 订单编辑层 -->
        <div class="warp">
            <div class="warp-0">
                <div id="abc">
                    {{--//判断默认地址--}}
                    @if($default)
                        <div id="a" class="a">
                            <div class="a-1"><img src="/imgs/location.png">
                                <input id="o_receiver" name="o_receiver" value="{!! $default->receiver !!}" readonly/>
                                <input id="o_dz" class="ex_inp" name="o_dz" value="{!! $default->city !!},{!!$default->location !!}" readonly/>
                                <input id="o_tel" name="o_tel" value="{!! $default->tel !!}" readonly/>
                            </div>
                        </div>
                    @else
                        <div id="a2" class="a">
                            <div class="a-1"><img src="/imgs/location.png">
                                <input id="o_receiver" name="o_receiver" value="" readonly/>
                                <input id="o_dz" class="ex_inp" name="o_dz" value="" readonly/>
                                <input id="o_tel" name="o_tel" value="" readonly/>
                            </div>
                        </div>
                    @endif
                    <div id="b">
                        <div class="b">
                            <div class="b-1">
                                <img src="/imgs/location.png">
                                <p>还没添加收获地址!</p>
                            </div>
                        </div>
                    </div>
                </div>
                {{--添加/修改地址层--}}
                <div id="c">
                    <div class="c">
                        <div class="c-1" id="address_container">
                            <div id="address_list" style="min-height:50px;">
                                <ul id="aul">
                                    @foreach($address as $addres)
                                    <li class="c-2"><span id="aitem_{{$addres['aid']}}" class="myspan"
                                    onClick="selectAddress(this)"> {{$addres['receiver']}}
                                    ,{{$addres['city']}},{{$addres['location']}},{{$addres['tel']}}</span>
                                    <div id="edit_{{$addres['aid']}}" class="edit" onClick="editAddress(this)"><img
                                    src="/imgs/edit.png"></div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="add-address"><span id="add_address">增加<img src="/imgs/add.png">地址</span></div>
                        </div>
                    </div>
                </div>
                <img src="/imgs/fengexian.png">

                <div class="warp-1">
                    <p>订单商品</p>
                    <a href="{{url('wxcshop/cart')}}">订单修改</a></div>
            </div>
            <div class="warp">
                <div class="warp-2">
                    @foreach($products as $product)
                    <div class="d"><img src="{{$product->attributes['product_preview']}}">
                        <p>{{$product->name}}<span class="ex_p">￥{{$product->price}}</span></p>
                        <p></p>
                        <p style="color:gray">x<span>{{$product->quantity}}</span></p>
                    </div>
                    @endforeach
                    <div class="e"><span>微信支付</span></div>
                    <div class="e"><span>包邮</span></div>
                    <div class="e"><span>商品金额</span><span><span class="wxc_red">￥{{$total}}</span></span></div>
                    <div class="e e-1"><span>运费金额</span><span>￥<span class="wxc_red">0.00</span></span></div>
                    <div class="e e-1"><span>应付总额</span><span><span class="wxc_red">￥{{$total}}</span></span></div>
                    <div class="g">
                        <p>备注:公司指定快递，少数偏远地区以及村，组快件需自提，快递物流有效位一个月，请在发货后7天内几时查询物流信息，新旧包装随机发货，不支持指定包装。</p>
                    </div>
                </div>
            </div>
            {{--<button id="pay" class="pay" type="submit">立即支付</button>--}}
            <button id="pay" class="wxc_btn" type="button" onclick="WXPayment()">立即支付</button>
        </div>
    </div>
    <!-- //编辑收获地址层 -->
    <div id="address_mash">
        <div class="mhead"><span id="back" style="float:left;padding-left:10px;">返回</span></div>
        <input id="aid" type="hidden" value="">
        <div class="mk">
            <lable>收货人</lable>
            <input id="receiver" class="mi" type="" name="receiver" placeholder="请输入真实姓名" value="">
        </div>
        <div class="mk">
            <lable>手机号码</lable>
            <input id="phone" class="mi" type="number" name="phone" placeholder="请输入手机号码" value="">
        </div>
        <div class="mk">
            <lable>确认手机号码</lable>
            <input id="agphone" class="mi" type="number" name="agphone" placeholder="请输入手机号码" value="">
        </div>
        <div class="mk" id="address_xuan">
            <lable>省市区</lable>
            <p id="city" class="mi"></p>
        </div>
        <div id="pop-contants">
            <p class="p_address"><span>请选择城市地址</span><em></em><em></em></p>
            <ul id="cityAddress" class="myscroller">
            </ul>
            <buttom id="p1" class="pans">取消</buttom>
            <buttom id="p2" class="pans"> 重选</buttom>
        </div>
        <div class="mk">
            <input style="width:100%" id="dz" class="mi" name="dz" placeholder="请输入收货人详细地址" value="">
        </div>
        <div class="md">
            <input id="box" class="mo" type="checkbox" name="state">
            是否默认为收货地址
        </div>
        <div class="baocun">
            <button id="clean" class="adda" type="button">清空地址</button>
            <button id="save" class="adda" type="button" onClick="saveAddress()">保存地址</button>
        </div>
    </div>

@endsection

<script type="text/javascript" src="/js/CityArea.js"></script>
@section('m-js')
    <script type="text/javascript">
        var flag = 0;
        $("#abc").click(function () {
            // $('#c').slideDown(300,function(){flag = 1;});
            if (flag == 0) {
                $('#c').show();
                flag = 1;
            } else {
                $('#c').hide();
                flag = 0;
            }
        });

        $("#add_address").click(function () {
            $("#receiver").val("");
            $("#phone").val("");
            $("#agphone").val("");
            $("#city").html("");
            $("#box").val("");
            $("#dz").val("");
            $("#aid").val("");
            $("#order").hide();
        });

        $("#back").click(function () {
            $("#orde").show();
            $("#c").hide();
        });

        //////选择城市
        $("#address_xuan").click(function () {
            // $(".editA").show();
            $("#pop-contants").show();
            AddreessSart(this);
        });

        $("#back").click(function () {
            $("#order").show();
            $("#c").hide();
        });

        function selectAddress(obj) {
            $("#b").hide();
            var content = $(obj).html();
            //console.log(content);
            var arr = new Array();
            arr = content.split(',');
            //console.log(arr);
            $("#o_receiver").val(arr[0]);
            $("#o_dz").val(arr[1] + "," + arr[2] + "," + arr[3] + "," + arr[4]);
            $("#o_tel").val(arr[5]);
            $("#c").hide();
        }

        function editAddress(obj) {
            var eid = $(obj).attr("id");
            var tid = eid.slice(5);
            var content = $("#" + "aitem_" + tid).html();
            var arr = new Array();
            arr = content.split(',');
//            console.log(arr);
            $("#aid").val(tid);//要修改的地址aid
            //console.log(tid);
            $("#receiver").val(arr[0]);
            $("#agphone").val(arr[5]);
            $("#phone").val(arr[5]);
            $("#city").html(arr[1] + "," + arr[2] + "," + arr[3]);
            $("#dz").val(arr[4]);
            $("#order").hide();
        }

        function saveAddress() {
            var tel = $("#phone").val();
            var receiver = $("#receiver").val();
            var city = $("#city").text();
            var dz = $("#dz").val();
            var state = 1;
            var aid = $("#aid").val();
            if (receiver == "") {
                $(".wxc_toptips").show();
                $(".wxc_toptips span").html('名字不能为空');
                setTimeout(function () {
                    $(".wxc_toptips").hide();
                }, 2000);
                return false;
            }
            if (!(/^1(3|4|5|7|8)\d{9}$/.test(tel))) {
                $(".wxc_toptips").show();
                $(".wxc_toptips span").html('手机格式不正确');
                setTimeout(function () {
                    $(".wxc_toptips").hide();
                }, 2000);
                return false;
            }
            if (tel == "") {
                $(".wxc_toptips").show();
                $(".wxc_toptips span").html('手机号码不能为空');
                setTimeout(function () {
                    $(".wxc_toptips").hide();
                }, 2000);
                return false;
            }
            if (tel !== $("#agphone").val()) {
                $(".wxc_toptips").show();
                $(".wxc_toptips span").html('两次手机号码不一致');
                setTimeout(function () {
                    $(".wxc_toptips").hide();
                }, 2000);
                return false;
            }
            if (city == "") {
                $(".wxc_toptips").show();
                $(".wxc_toptips span").html('请填写详细的地址');
                setTimeout(function () {
                    $(".wxc_toptips").hide();
                }, 2000);
                return false;
            }
            if (dz == "") {
                $(".wxc_toptips").show();
                $(".wxc_toptips span").html('请填写详细的地址');
                setTimeout(function () {
                    $(".wxc_toptips").hide();
                }, 2000);
                return false;
            }
            if ($("#box").is(':checked')) {
                state = 0;
                $("#b").hide();
                $("#o_receiver").val(receiver);
                $("#o_dz").val(city + dz);
                $("#o_tel").val(tel);
            }
//            else {
//                $("#b").hide();
//                $("#o_receiver").val("");
//                $("#o_dz").val("");
//                $("#o_tel").val("");
//            }
            $("#" + "aitem_" + aid).html(receiver + "," + city + "," + dz + "," + tel);
            $("#b").hide();
            $.ajax({
                url: "{{url('service/save_address')}}",
                type: "post",
                data: {tel: tel, rec: receiver, city: city, dz: dz, state: state, aid: aid, _token: "{{csrf_token()}}"},
                dataType: "json",
                time: 3000,
                beforeSend: function () {
                    $("#loadingToast").css("display", "block");
                },
                success: function (data) {
                    if (data) {
                        createAddressItem(data);
                        $("#" + 'aitem_' + data).html(receiver + "," + city + "," + dz + "," + tel);
                    }
                },
                complete: function (XMLHttpRequest, Status) {
                    $("#order").show();
                    $("#c").hide();
                    $("#loadingToast").css("display", "none");
                },
                error: function (xhr, status, error) {
                    console.log(xhr);
                    console.log(status);
                    console.log(error);
                }
            });
        }

        function createAddressItem(data) {
            var aitem = $('<li class="c-2"></li>');
            var aspan = $('<span class="myspan" onClick="javascript:selectAddress(this)"></span>');
            aspan.attr("id", 'aitem_' + data);
            var aimg = $('<div class="edit" onclick="editAddress(this)"><img src="/imgs/edit.png"></div>');
            aimg.attr("id", 'edit_' + data);
            aspan.appendTo(aitem);
            aimg.appendTo(aitem);
            aitem.appendTo("#aul");
        }
    </script>
@endsection