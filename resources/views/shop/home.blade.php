@extends('shop.shopbase')

@section('title','首页')

@section('content')
    <ul class="carousel" ontouchstart="">
        <li class="item">
            <img src="/imgs/b1.png">
        </li>
        <li class="item">
            <img src="/imgs/b2.png">
        </li>
        <li class="item">
            <img src="/imgs/b3.png">
        </li>
        <li class="item">
            <img src="/imgs/b4.png">
        </li>
    </ul>
    <ul class="page-number">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </ul>
    <div class="shell">
        @foreach($products as $product)
            <a><img src="{{$product->display}}"/></a>
        @endforeach
    </div>

@endsection

@section('m-js')
    <script src="/js/LinkList.js"></script>
    <script src="/js/carousel.js"></script>
    <script>
        $("#personal").attr("href", "{{url('personal')}}");
        $("#cart").attr("href", "{{url('cart')}}");
    </script>
    <script>
        var carousel = CreateCarousel("carousel", "item", true).bindTouchEvent().setItemChangedHandler(onPageChanged);
        var dots = document.querySelectorAll(".page-number li");
        var curDot = dots[0];
        curDot.className = "active";
        function onPageChanged(preIndex, curIndex) {
            curDot.className = "";
            curDot = dots[curIndex];
            curDot.className = "active";
        }
    </script>
@endsection