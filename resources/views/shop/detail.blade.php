@extends('shop.master')

@section('title','商品详情')
<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
@section('m-style')
    <style type="text/css">
        *{
            padding: 0px;
            margin:0px;
        }
        a:link{text-decoration:none;}
        .content {
            width: 100%;
            text-align: center;
        }
        .content img {
            width: 100%;
        }
        .di {
            display: block;
            position: fixed;
            bottom: 0;
            width: 100%;
            height: 60px;
            color: #474747;
            background-color: #fff;
        }
        .row {
            background-color: red;
            font-size: 16px;
            line-height: 60px;
            text-align: center;
        }
        .row a {
            color: #fff;
        }
        .row a:first-child{
            border-right: 1px solid #fff;
        }
    </style>
@endsection

@section('content')
    <div class="content">
        <img src="/imgs/goods.png">
    </div>
    <div class="di">
        <div class="container-fluid">
            <div class="row">
                <a class="col-md-6" href="{{url('/service/buy',$gid)}}">加入购物车</a>
                <a class="col-md-6" href="{{url('/service/buy',$gid)}}">立即购买</a>
            </div>
        </div>
    </div>
@endsection