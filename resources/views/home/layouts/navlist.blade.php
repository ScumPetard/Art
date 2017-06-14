@if(Session::has('client'))
    @if(Session::get('client')->canModule(1))
        <a class="nav-petard" href="/">首页</a>
    @endif
    @if(Session::get('client')->canModule(3))
        <a class="nav-petard" href="/westernoilpainting">西方油画</a>
    @endif
    @if(Session::get('client')->canModule(4))
        <a class="nav-petard" href="/chinesepainting">中国国画</a>
    @endif
    @if(Session::get('client')->canModule(5))
        <a class="nav-petard" href="/mural">唐卡壁画</a>
    @endif
    @if(Session::get('client')->canModule(6))
        <a class="nav-petard" href="/chinesecalligraphy">中国书法</a>
    @endif
    @if(Session::get('client')->canModule(7))
        <a class="nav-petard" href="/seal">印章印谱</a>
    @endif
    @if(Session::get('client')->canModule(8))
        <a class="nav-petard" href="/fellancientbooks">碑帖古籍</a>
    @endif
    @if(Session::get('client')->canModule(9))
        <a class="nav-petard" href="/japan">日本版画</a>
    @endif
    @if(Session::get('client')->canModule(10))
        <a class="nav-petard" href="/artist">艺术家</a>
    @endif

@elseif(Session::has('member'))

    @if(Session::get('member')->client->canModule(1))
        <a class="nav-petard" href="/">首页</a>
    @endif
    @if(Session::get('member')->client->canModule(3))
        <a class="nav-petard" href="/westernoilpainting">西方油画</a>
    @endif
    @if(Session::get('member')->client->canModule(4))
        <a class="nav-petard" href="/chinesepainting">中国国画</a>
    @endif
    @if(Session::get('member')->client->canModule(5))
        <a class="nav-petard" href="/mural">唐卡壁画</a>
    @endif
    @if(Session::get('member')->client->canModule(6))
        <a class="nav-petard" href="/chinesecalligraphy">中国书法</a>
    @endif
    @if(Session::get('member')->client->canModule(7))
        <a class="nav-petard" href="/seal">印章印谱</a>
    @endif
    @if(Session::get('member')->client->canModule(8))
        <a class="nav-petard" href="/fellancientbooks">碑帖古籍</a>
    @endif
    @if(Session::get('member')->client->canModule(9))
        <a class="nav-petard" href="/japan">日本版画</a>
    @endif
    @if(Session::get('member')->client->canModule(10))
        <a class="nav-petard" href="/artist">艺术家</a>
    @endif
@elseif(Session::has('navclient'))
    @if(Session::get('navclient')->canModule(1))
        <a class="nav-petard" href="/">首页</a>
    @endif
    @if(Session::get('navclient')->canModule(3))
        <a class="nav-petard" href="/westernoilpainting">西方油画</a>
    @endif
    @if(Session::get('navclient')->canModule(4))
        <a class="nav-petard" href="/chinesepainting">中国国画</a>
    @endif
    @if(Session::get('navclient')->canModule(5))
        <a class="nav-petard" href="/mural">唐卡壁画</a>
    @endif
    @if(Session::get('navclient')->canModule(6))
        <a class="nav-petard" href="/chinesecalligraphy">中国书法</a>
    @endif
    @if(Session::get('navclient')->canModule(7))
        <a class="nav-petard" href="/seal">印章印谱</a>
    @endif
    @if(Session::get('navclient')->canModule(8))
        <a class="nav-petard" href="/fellancientbooks">碑帖古籍</a>
    @endif
    @if(Session::get('navclient')->canModule(9))
        <a class="nav-petard" href="/japan">日本版画</a>
    @endif
    @if(Session::get('navclient')->canModule(10))
        <a class="nav-petard" href="/artist">艺术家</a>
    @endif
@endif








