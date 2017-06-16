@if(Session::has('clientRealIp'))
<!-- header 开始 -->
<div class="header">
    <a href="/" class="logo">
        <img src="{{ Session::get('clientLogo') ? Session::get('clientLogo') : '/assets/images/logo.png' }}"/>
    </a>
    <div class="nav">
        @include('home.layouts.navlist')
    </div>
    <div class="head_rt rt">
        <div class="tp">
            @if(Session::has('clientRealName'))
                <span class="wel">{{Session::get('clientRealName')}} 欢迎您！ </span>
            @endif
            @if(Session::has('member') || Session::has('client'))
                    <a href="/member/favorite">{{Session::get('member')? Session::get('member')->account : Session::get('client')->name}}</a>
                    <a href="/member/signout">退出</a>
            @else
                    <a href="/member/sign">登录</a>
                    @if(Session::has('clientRealName'))
                        <a href="/member/signup">注册</a>
                    @endif
            @endif
            <a href="/about">关于我们</a>
            <a href="/about/problem">问题反馈</a>
        </div>
        @include('home.layouts.seach',['version' => 1])
    </div>
</div>
<div class="clear"></div>
<script>
    $('.nav-petard').each(function () {
        if ($(this).attr('href') == location.pathname) {
            $(this).addClass('hover');
        }
    });
</script>
@endif
