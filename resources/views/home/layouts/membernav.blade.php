<div class="us_nav">
    <a href="/member/favorite">我的收藏</a>
    <a href="/member/resetpassword">修改密码</a>
    @if((Session::has('client') && Session::get('client')->buy == 1))
    <a href="/member/cart">购画车</a>
    @endif

    <div class="head_search1" style="float:right">
        <form>
            <input type="text" class="text" value="请输入搜索内容"/>
            <input type="submit" class="sub" value="" title="点击搜索"/>
        </form>
    </div>
</div>
<div class="clear"></div>
<script>
    window.onload = function () {
        $('.us_nav>a').each(function () {
            if ($(this).attr('href') == location.pathname) {
                $(this).addClass('hover');
            }
        });
    }
</script>