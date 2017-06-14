@if(Session::has('clientRealIp'))
<!-- header 开始 -->
<div class="header2">

    <a href="/" class="logo">
        <img src="{{ Session::get('clientLogo') ? Session::get('clientLogo') : '/assets/images/logo.png' }}" />
    </a>

    <div class="nav2">
        @include('home.layouts.navlist')
    </div>

    <div class="head_rt2 rt">
        <div class="lt">
            @if(Session::has('member') || Session::has('client'))
                <a href="/member/favorite">{{Session::get('member')? Session::get('member')->account : Session::get('client')->name}}</a>
                <a href="/member/signout">退出</a>
            @else
                <a href="/member/sign">登录</a>
                @if(Session::has('clientRealName'))
                    <a href="/member/signup">注册</a>
                @endif
            @endif
        </div>
        <div class="head_search2">
            <form>
                <input type="text" class="text" value="请输入搜索内容" />
                <input type="button" class="sub" value="" title="点击搜索" />
            </form>
        </div>
    </div>

</div>
<div class="clear"></div>
<div class="header2_zw"></div>
<!-- header 结束 -->
<style>
    .lt>a{
        color: #fff;
        margin-right: 15px;
    }
</style>
<script>
    $('.nav-petard').each(function () {
        if ($(this).attr('href') == location.pathname) {
            $(this).addClass('hover');
        }
    });
</script>
    @endif