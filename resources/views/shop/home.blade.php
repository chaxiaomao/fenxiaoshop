@extends('shop.shopbase')

@section('title','首页')

@section('content')

    @endsection

@section('m-js')
<script>
    $("#personal").attr("href","{{url('personal')}}");
    $("#cart").attr("href","{{url('cart')}}");

</script>
    @endsection