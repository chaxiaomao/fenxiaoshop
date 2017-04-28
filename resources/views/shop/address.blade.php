@extends('shop.master')

@section('title', '收货地址')

@section('m-style')
    <style type="text/css">
        body{background-color: rgb(229,229,229);padding-bottom:40px;}
        .mheader{width:100%;text-align: center;height:50px;background-color: #e50112;line-height:50px;color:#fff;}
        .mhead {font-weight:bold;letter-spacing:8px;height: 40px;background-color: rgb(244,244,244);color: #e50112;line-height: 40px;text-align: center;}
        .warp{background-color: #fff;height: auto;margin-bottom: 10px;color:gray}
        .content{height:100px;border-bottom: 1px solid rgb(229,229,229);margin:0 10px;}
        .content p{padding-top: 20px;}
        .c_buttom{height: 40px;margin:0 10px;line-height: 40px;position: relative;}
        .minput{height: 24px;width:24px;position:relative; top:8px;}
        .c_buttom span{float: right;padding-right: 20px;}
        .c_buttom span img{width: 24px;height: 24px;vertical-align: middle;padding-right: 5px;}
    </style>
@endsection

@section('content')
    <div class="mheader" onclick="createAddress()">新增一个收获地址</div>
    <!-- 显示地址层-->
    <div id="index1" class="">
        <div id="address_list">
            <ul id="address_content">
                {{--判断默认地址--}}
                @if($default)
                    <li class="warp" id="ali_{!! $default->aid !!}">
                        <div class="content">
                            <p><span id="rec_{!! $default->aid !!}">{!! $default->receiver !!}</span>&nbsp;&nbsp;&nbsp;&nbsp;<span
                                        id="tel_{!! $default->aid !!}">{!! $default->tel !!}</span></p>

                            <p id="address_{!! $default->aid !!}">{!! $default->city !!},{!! $default->location !!}</p>
                        </div>
                        <div class="c_buttom">
                            <input id="minput_{!! $default->aid !!}}" class="minput" checked="checked" type="radio" value=""
                                   name="moren"/>&nbsp;默认地址
                            <span id="del_{!! $default->aid !!}" class="shanchu" onClick="deleteAddress(this)"><img
                                        src="/imgs/cursh.png">删除</span>
                            <span id="xiugai_{!! $default->aid !!}" class="xiugai" onClick="editAddress(this)"><img
                                        src="/imgs/pen.png">修改</span>
                        </div>
                    </li>
                @else
                @endif
                @foreach($address as $addres)
                    <li class="warp" id="ali_{{$addres['aid']}}">
                        <div class="content">
                            <p><span id="rec_{{$addres['aid']}}">{{$addres['receiver']}}</span>&nbsp;&nbsp;&nbsp;&nbsp;<span
                                        id="tel_{{$addres['aid']}}">{{$addres['tel']}}</span></p>

                            <p id="address_{{$addres['aid']}}">{{$addres['city']}},{{$addres['location']}}</p>
                        </div>
                        <div class="c_buttom">
                            <input id="minput_{{$addres['aid']}}" class="minput" type="radio" name="moren" value=""/>&nbsp;默认地址
                            <span id="del_{{$addres['aid']}}" class="shanchu" onClick="deleteAddress(this)"><img
                                        src="/imgs/cursh.png">删除</span>
                            <span id="xiugai_{{$addres['aid']}}" class="xiugai" onClick="editAddress(this)"><img
                                        src="/imgs/pen.png">修改</span>
                        </div>
                    </li>
                @endforeach
            </ul>
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
            <ul id="cityAddress" class="myscroller"></ul>
            <buttom id="p1" class="pans">取消</buttom>
            <buttom id="p2" class="pans"> 重选</buttom>
        </div>
        <div class="mk">
            <input style="width:100%" id="dz" class="mi" name="dz" placeholder="请输入收货人详细地址" value="">
        </div>
        <div class="md">
            <input id="box" class="mo" type="checkbox" name="state" value="0">是否默认为收货地址
        </div>
        <div class="baocun">
            <div id="clean" class="adda" type="button">清空地址</div>
            <button id="save" class="adda" type="button" onClick="saveAddress()">保存地址</button>
        </div>
    </div>
    <!-- //end -->
    <!--BEGIN dialog1-->
    <div class="js_dialog" id="iosDialog1" style="display: none;">
        <div class="weui-mask"></div>
        <div class="weui-dialog">
            <div class="weui-dialog__hd"><strong class="weui-dialog__title">提示</strong></div>
            <div class="weui-dialog__bd">确定要删除此地址?</div>
            <div class="weui-dialog__ft">
                <div class="weui-dialog__btn weui-dialog__btn_default" onclick="hideDialog()">取消</div>
                <div class="weui-dialog__btn weui-dialog__btn_primary" onclick="commitDelete(this)">确认</div>
            </div>
        </div>
    </div>
    <!--END dialog1-->
@endsection

<script type="text/javascript" src="/js/CityArea.js"></script>
@section('m-js')
    <script type="text/javascript">
        $("#address_mash").hide();

        $("#back").click(function () {
            $("#index1").show();
            $("#address_mash").hide();
        });

        //////选择城市
        $("#address_xuan").click(function () {
            // $(".editA").show();
            $("#pop-contants").show();
            AddreessSart(this);
        });

        $("#p1").click(function () {
            $("#pop-contants").hide();
        });

        $('body').on('click', '#clean', function () {
            $("#aid").val("");
            $("#receiver").val("");
            $("#phone").val("");
            $("#agphone").val("");
            $("#city").html("");
            $("#box").val("");
            $("#dz").val("");
            //localStorage.clear();
        });

    </script>
    <script type="text/javascript">
        function createAddress() {
            $("#receiver").val("");
            $("#phone").val("");
            $("#agphone").val("");
            $("#city").html("");
            $("#box").val("");
            $("#dz").val("");
            $("#address_mash").show();
            $("#index1").hide();
        }

        function editAddress(obj) {
            $("#index1").hide();
            $("#address_mash").show();
            var eid = $(obj).attr("id");
            var tid = eid.slice(7);
            var dz = $("#" + "address_" + tid).html();
            var arr = new Array();
            arr = dz.split(',');
            $("#aid").val(tid);
//        console.log(arr);
            $("#receiver").val($("#" + "rec_" + tid).html());
            $("#agphone").val($("#" + "tel_" + tid).html());
            $("#phone").val($("#" + "tel_" + tid).html());
            $("#city").html(arr[0] + "," + arr[1] + "," + arr[2]);
            $("#dz").val(arr[3]);
        }

        function hideDialog() {
            $("#iosDialog1").css("display", "none");
        }

        function deleteAddress(obj) {
            var elm = $(obj).attr("id");
            var aid = elm.slice(4);
            $(".weui-dialog__btn_primary").attr("id", aid);
            $("#iosDialog1").css("display", "block");
        }

        function commitDelete(obj) {
            hideDialog();
            var aid = $(obj).attr("id");
            $.ajax({
                url: "{{url('/service/delete_address')}}",
                type: "get",
                data: {aid: aid},
                dataType: "json",
                time: 3000,
                beforeSend: function () {
                    $("#loadingToast").css("display", "block");
                },
                success: function (data) {
                    if(data == null) {
                        $(".wxc_toptips").show();
                        $(".wxc_toptips span").html("服务器错误");
                        setTimeout(function () {
                            $(".wxc_toptips").hide();
                        }, 2000);
                    }
                    $(".wxc_toptips").show();
                    $(".wxc_toptips span").html(data.message);
                    setTimeout(function () {
                        $(".wxc_toptips").hide();
                    }, 2000);
                },
                complete: function (XMLHttpRequest, Status) {
                    $("#" + "ali_" + aid).hide();
                    $("#loadingToast").css("display", "none");
                },
                error: function () {

                }
            });
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
                $("input[type='radio']").removeAttr('checked');
                $("#"+"minput_"+aid).attr("checked","checked");
            }
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
                    if (data == null) {
                        $(".wxc_toptips").show();
                        $(".wxc_toptips span").html("服务器错误");
                        setTimeout(function () {
                            $(".wxc_toptips").hide();
                        }, 2000);
                    }
                    $(".wxc_toptips").show();
                    $(".wxc_toptips span").html("添加成功");
                    setTimeout(function () {
                        $(".wxc_toptips").hide();
                    }, 2000);
//                    createAddress(data);
                },
                complete: function (XMLHttpRequest, Status) {
//                    $("#address_mash").hide();
//                    $("#index1").show();
//                    $("#loadingToast").css("display", "none");
                    location.reload("{{url('/personal/address')}}");
                },
                error: function (xhr, status, error) {
                    console.log(xhr);
                    console.log(status);
                    console.log(error);
                }
            });
        }

//        function createAddress() {
//            var aitem = $('<li class="warp"></li>');
//            var acontent = $('<div class="content"></div>');
//            aspan.attr("id", 'aitem_' + data);
//            var aimg = $('<div class="edit" onclick="editAddress(this)"><img src="/imgs/edit.png"></div>');
//            aimg.attr("id", 'edit_' + data);
//            aspan.appendTo(aitem);
//            aimg.appendTo(aitem);
//            aitem.appendTo("#aul");
//        }
    </script>
@endsection