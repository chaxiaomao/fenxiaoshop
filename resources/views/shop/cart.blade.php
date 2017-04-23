@extends('shop.shopbase')

@section('title','购物车')

@section('content')
    "购物车"
    @endsection

@section('m-js')
    <script>
        $("#home").removeClass("mui-active");
        $("#personal").removeClass("mui-active");
        $("#cart").addClass("mui-active");
        $("#cart").attr("href","#");
        $("#personal").attr("href","{{url('personal')}}");
        $("#home").attr("href","{{url('/')}}");

    </script>
    @endsection