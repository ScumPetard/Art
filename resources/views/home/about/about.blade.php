@extends('home.layouts.app')

@section('title',$page->title)

@section('content')

    {{--头部--}}
    @include('home.layouts.head-v2')
    {{--头部End--}}

    {{--内容--}}
    <div class="wrapin">

        <div class="now_pos">
            <a href="#">首页</a> &gt;
            <span>{{ $page->name or '' }}</span>
        </div>

    </div>
    <div class="about">
        <ul class="ab_nav">
            <li><a href="/about">关于我们</a></li>
            <li><a href="/about/statement">免责申明</a></li>
            <li><a href="/about/contact">联系我们</a></li>
            <li><a href="/about/cooperation">商务合作</a></li>
        </ul>
        <div class="ab_wrap">
            {!! $page->body or '' !!}
        </div>
    </div>
    {{--内容End--}}

    {{--尾部--}}
    @include('home.layouts.footer')
    {{--尾部End--}}
@stop

@section('js')
    <script>
        $('.ab_nav>li>a').each(function () {
            if ($(this).attr('href') == location.pathname) {
                $(this).addClass('hover');
            }
        });
    </script>
@stop




