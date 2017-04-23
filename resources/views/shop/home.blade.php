@extends('shop.shopbase')

@section('title','首页')

@section('content')

    @foreach($products as $product)
        <img src="{{$product->display}}" />
    @endforeach
@endsection

@section('m-js')
<script>
    $("#personal").attr("href","{{url('personal')}}");
    $("#cart").attr("href","{{url('cart')}}");

</script>
@endsection