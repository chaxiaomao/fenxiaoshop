@extends('shop.shopbase')

@section('title','个人中心')

@section('content')
    个人中心
@endsection

@section('m-js')
    <script>
        $("#home").removeClass("mui-active");
        $("#cart").removeClass("mui-active");
        $("#personal").addClass("mui-active");
        $("#personal").attr("href","#");
        $("#cart").attr("href","{{url('cart')}}");
        $("#home").attr("href","{{url('/home')}}");

    </script>
@endsection