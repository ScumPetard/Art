@extends('home.layouts.app')

@section('title','意见反馈')


@section('content')


    @include('home.layouts.head-v2')

    <div class="opi_wrap">
        <img src="/assets/images/opi_banner.jpg" class="opi_banner"/>
        <form action="" method="post">
            <div class="in">
                <span class="tit">标题</span>
                <input type="text" class="text" name="title" value="请输入4-30个字符"/>
                <div class="clear"></div>
            </div>
            <div class="in">
                <span class="tit">内容</span>
                <textarea placeholder="请输入反馈意见" name="body"></textarea>
                <div class="clear"></div>
            </div>
            {{ csrf_field() }}
            <input type="button" class="sub" value="确定" onclick="option();"/>
        </form>
        <div class="clear"></div>
    </div>

    @include('home.layouts.footer')

@stop
@section('js')
    <script src="https://cdn.bootcss.com/layer/3.0.1/layer.min.js"></script>
    <script>
        function option() {
            var title = $('input[name=title]').val();
            var body = $('textarea[name=body]').val();
            if (!title || !body) {
                return layer.msg('请输入完整信息');
            }
            $.post(
                '/about/problem',
                {'title': title, 'body': body, '_token': '{{ csrf_token() }}'},
                function (result) {
                    layer.msg(result['message'], {time: 500}, function () {
                        location.reload();
                    });
                }, 'json');
        }
    </script>
@stop
