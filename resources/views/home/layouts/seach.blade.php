<div class="head_search{{ $version }}">
    <form action="/seach" method="post">
        <input type="text" class="text" name="key" placeholder="请输入搜索内容"/>
        {{ csrf_field() }}
        <input type="submit" class="sub" value="" title="点击搜索"/>
    </form>
</div>