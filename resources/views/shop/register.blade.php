@extends('shop.master')

@section('title','登陆')

<style>
    p {
        text-align: center;
        margin-top: 20px;
    }

    .weui-btn_primary {
        margin-top: 40px;
        width: 80%;
    }
</style>

@section('content')
    <div class="weui-cells__title">微小茶 - 注册</div>
    <div class="weui-cells weui-cells_form">
        <div class="weui-cell weui-cell_vcode">
            <div class="weui-cell__hd"><label class="weui-label">手机</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="tel" name="phone" placeholder="请输入手机号"/>
            </div>
            <div class="weui-cell__ft">
                <button id="wxc_duanxin_send" class="weui-vcode-btn">获取验证码</button>
            </div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">短信验证码</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="" value="" name="phone_code" placeholder="请输入短信验证码"/>
            </div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">密码</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="password" value="" name="passwd_phone" placeholder="请输入密码"/>
            </div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">请确认密码</label></div>
            <div class="weui-cell__bd">
                <input class="weui-input" type="password" value="" name="passwd_phone_cfm" placeholder="请确认密码"/>
            </div>
        </div>
        {{--手机注册并不需要随机验证码--}}
        {{--<div class="weui-cell weui-cell_vcode">--}}
        {{--<div class="weui-cell__hd"><label class="weui-label">验证码</label></div>--}}
        {{--<div class="weui-cell__bd">--}}
        {{--<input class="weui-input" type="number" placeholder="请输入验证码"/>--}}
        {{--</div>--}}
        {{--<div class="weui-cell__ft">--}}
        {{--<img class="weui-vcode-img" src="service/validate_code/create" />--}}
        {{--</div>--}}
        {{--</div>--}}
    </div>
    <a href="javascript:;" class="weui-btn weui-btn_primary" onclick="onRegisterClick()">注册</a>

@endsection

@section('m-js')
    <script type="text/javascript">
        $(".weui-vcode-img").click(function () {
            $(this).attr("src", 'service/validate_code/create?random=' + Math.random());
        })
    </script>

    <script type="text/javascript">
        var enable = true;
        $("#wxc_duanxin_send").click(function (event) {
            if (enable == false) {
                return;
            }

            var phone = $("input[name=phone]").val();
            // 手机号不为空
            if (phone == '') {
                $(".wxc_toptips").show();
                $(".wxc_toptips span").html('请输入手机号');
                setTimeout(function () {
                    $(".wxc_toptips").hide();
                }, 2000);
                return;
            }
            // 手机号格式
            if (phone.length != 11 || phone[0] != '1') {
                $(".wxc_toptips").show();
                $(".wxc_toptips span").html('手机格式不正确');
                setTimeout(function () {
                    $(".wxc_toptips").hide();
                }, 2000);
                return;
            }

//            $(this).removeClass('bk_important');
//            $(this).addClass('bk_summary');
            enable = false;
            var num = 60;
            var interval = window.setInterval(function () {
                $("#wxc_duanxin_send").html(--num + 's 重新发送');
                if (num == 0) {
//                    $('.bk_phone_code_send').removeClass('bk_summary');
//                    $('.bk_phone_code_send').addClass('bk_important');
                    enable = true;
                    window.clearInterval(interval);
                    $('#wxc_duanxin_send').html('重新发送');
                }
            }, 1000);

            $.ajax({
                url: "/service/validate_phone/send",
                type: "POST",
                dataType: "json",
                cache: false,
                data: {phone: phone, _token: "{{csrf_token()}}"},
                success: function (data) {
                    if (data == null) {
                        $(".wxc_toptips").show();
                        $(".wxc_toptips span").html('服务端错误');
                        setTimeout(function () {
                            $(".wxc_toptips").hide();
                        }, 2000);
                        return;
                    }
                    if (data.status != 0) {
                        $(".wxc_toptips").show();
                        $(".wxc_toptips span").html(data.message);
                        setTimeout(function () {
                            $(".wxc_toptips").hide();
                        }, 2000);
                        return;
                    }
                    $(".wxc_toptips").show();
                    $(".wxc_toptips span").html('发送成功');
                    alert("测试短信验证码:" + data.code);
                    setTimeout(function () {
                        $(".wxc_toptips").hide();
                    }, 2000);
                },
                error: function (xhr, status, error) {
                    console.log(xhr);
                    console.log(status);
                    console.log(error);
                }
            });
        });
    </script>

    <script type="text/javascript">
        function onRegisterClick() {
            phone = $("input[name=phone]").val();
            password = $("input[name=passwd_phone]").val();
            confirm = $("input[name=passwd_phone_cfm]").val();
            phone_code = $("input[name=phone_code]").val();
            if (verifyPhone(phone, password, confirm, phone_code) == false) {
                return;
            }
            $.ajax({
                type: "POST",
                url: "/service/register",
                dataType: "json",
                cache: false,
                data: {
                    phone: phone, password: password, confirm: confirm,
                    phone_code: phone_code, _token: "{{csrf_token()}}"
                },
                beforeSend: function () {
                    $("#loadingToast").css("display", "block");
                },
                success: function (data) {
                    if (data == null) {
                        $(".wxc_toptips").show();
                        $(".wxc_toptips span").html('服务端错误');
                        setTimeout(function () {
                            $(".wxc_toptips").hide();
                        }, 2000);
                        return;
                    }
                    if (data.status != 0) {
                        $(".wxc_toptips").show();
                        $(".wxc_toptips span").html(data.message);
                        setTimeout(function () {
                            $(".wxc_toptips").hide();
                        }, 2000);
                        return;
                    }
                    $(".wxc_toptips").show();
                    $(".wxc_toptips span").html('注册成功');
                    setTimeout(function () {
                        $(".wxc_toptips").hide();
                    }, 2000);
                    location.reload("{{ url('/personal') }}");
                },
                error: function (xhr, status, error) {
                    console.log(xhr);
                    console.log(status);
                    console.log(error);
                }
            });
        }

        function verifyPhone(phone, password, confirm, phone_code) {
            // 手机号不为空
            if (phone == '') {
                $(".wxc_toptips").show();
                $(".wxc_toptips span").html('请输入手机号');
                setTimeout(function () {
                    $(".wxc_toptips").hide();
                }, 2000);
                return false;
            }
            // 手机号格式
            if (phone.length != 11 || phone[0] != '1') {
                $(".wxc_toptips").show();
                $(".wxc_toptips span").html('手机格式不正确');
                setTimeout(function () {
                    $(".wxc_toptips").hide();
                }, 2000);
                return false;
            }
            if (password == '' || confirm == '') {
                $(".wxc_toptips").show();
                $(".wxc_toptips span").html('密码不能为空');
                setTimeout(function () {
                    $(".wxc_toptips").hide();
                }, 2000);
                return false;
            }
            if (password.length < 6 || confirm.length < 6) {
                $(".wxc_toptips").show();
                $(".wxc_toptips span").html('密码不能少于6位');
                setTimeout(function () {
                    $(".wxc_toptips").hide();
                }, 2000);
                return false;
            }
            if (password != confirm) {
                $(".wxc_toptips").show();
                $(".wxc_toptips span").html('两次密码不相同!');
                setTimeout(function () {
                    $(".wxc_toptips").hide();
                }, 2000);
                return false;
            }
            if (phone_code == '') {
                $(".wxc_toptips").show();
                $(".wxc_toptips span").html('手机验证码不能为空!');
                setTimeout(function () {
                    $(".wxc_toptips").hide();
                }, 2000);
                return false;
            }
            if (phone_code.length != 6) {
                $(".wxc_toptips").show();
                $(".wxc_toptips span").html('手机验证码为6位!');
                setTimeout(function () {
                    $(".wxc_toptips").hide();
                }, 2000);
                return false;
            }
            return true;
        }
    </script>
@endsection