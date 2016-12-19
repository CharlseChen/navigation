<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="siteapp">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no">
    <title>@yield('title')</title>
    @yield('css')
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" charset="utf-8">
        wx.config({!! $wxjs->config(array('onMenuShareTimeline', 'onMenuShareAppMessage','onMenuShareQQ','onMenuShareQZone'), false) !!});
    </script>
</head>
<body>
@yield('content')
</body>

<script src="{{ asset('js/game/jquery.min.js') }}"></script>

@yield('script')
</script>