<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="stylesheet" type="text/css" href="/css/weui.css">
    <link rel="stylesheet" type="text/css" href="/css/wxc.css">
    <script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
</head>

@yield('m-style')

<body>
    <!-- tooltips -->
    @include('component.toasting')
    @include('component.loading')
    <div>
        @yield('content')
    </div>
</body>
@yield('m-js')
</html>