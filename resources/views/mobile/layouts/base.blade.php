<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="target-densitydpi=device-dpi, width=device-width,height=device-height, initial-scale=1, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="format-detection" content="telephone=no" />
    <script type="text/javascript">
        document.getElementsByTagName('html')[0].style.fontSize = Math.min(window.innerWidth*12/320,200)+"px";
    </script>
    <link type="text/css" rel="stylesheet" href="/mobiles/css/flexslider.css" />
    <link type="text/css" rel="stylesheet" href="/mobiles/css/css.css" />
    <title>@yield('title')</title>
</head>
@yield('css')
<body>
<div id="app">
    @yield('body')
</div>


<div style="height:1.5rem;clear:both;"></div>

<!--footer 底部-->
<div class="footer">
    <div class="footer_nav">
        <a href="/mobile" class="hover">
            <i class="ico ico1"></i>
            <span>首页</span>
        </a>
        <a href="#">
            <i class="ico ico2"></i>
            <span>艺术家</span>
        </a>
        <a href="#">
            <i class="ico ico3"></i>
            <span>我的收藏</span>
        </a>
        <a href="#">
            <i class="ico ico4"></i>
            <span>会员中心</span>
        </a>
    </div>
</div>
<div class="footer_zw"></div>
<!--footer 底部-->

</body>
<script type="text/javascript" src="/mobiles/js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="/mobiles/js/jquery.flexslider-min.js"></script>
<script type="text/javascript" src="/mobiles/js/base.js"></script>
<script type="text/javascript">

    //hm_banner 轮播图
    $(".hm_banner .flexslider").flexslider({
        animation : "slide"
    });

</script>
@yield('js')
</html>