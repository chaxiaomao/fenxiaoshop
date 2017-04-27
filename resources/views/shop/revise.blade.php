@extends('shop.master')

@section('title', '修改信息')

@section('m-style')
    <style type="text/css">
        .mul{background-color:#fff;color:#CCC;font-size:14px;font-family:"微软雅黑";}
        .mul li img{width:80px;height:80px;border-radius:50%;}
        .mul li{/*height:60px;*/padding:25px 40px 30px 25px;border-bottom:1px solid #eee;}
        .mul li:first-child{line-height:80px;padding:10px 40px 10px 25px}
        .mul li span:nth-child(2),.mul li img,.minput{float:right;}
        .mul li:last-child{margin-bottom: 90px;}
        .minput{border:none;text-align:right;}
    </style>
    @endsection

@section('content')
    <ul class="mul">
        <li>修改头像<img src="{{$user['avatar']}}"></li>
        <li><span>会员号</span><span>{{$user['user_id']}}</span></li>
        <li><span>修改昵称</span><input name="name" class="minput" value="{{$user['user_name']}}" /></li>
        <li><span>关注时间</span><span>{{$user['register_at']}}</span></li>
    </ul>
    <button class="wxc_btn" type="button" onclick="resive()">保&nbsp;&nbsp;存</button>
    @endsection

@section('m-js')
<script type="text/javascript">
    function resive() {
        $.ajax({
            type: "get",
            url: "{{ url('service/revise') }}",
            data: {name : $("input[name=name]").val()},
            dataType: "json",
            beforeSend: function() {
                $("#loadingToast").css("display", "block");
            },
            success: function(data) {
                if (data == null) {
                    $(".wxc_toptips").show();
                    $(".wxc_toptips span").html('服务端错误');
                    setTimeout(function () {
                        $(".wxc_toptips").hide();
                    }, 2000);
                    return;
                }
                $(".wxc_toptips").show();
                $(".wxc_toptips span").html(data.message);
                setTimeout(function () {
                    $(".wxc_toptips").hide();
                }, 2000);
                location.replace("{{ url('personal') }}");
            },
            error: function (xhr, status, error) {
                console.log(xhr);
                console.log(status);
                console.log(error);
            }

        })
    }

</script>
    @endsection