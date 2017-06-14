@extends('home.layouts.app')

@section('title','艺术家')



@section('content')

    @include('home.layouts.head-v2')

    <div class="pro_cla pro_cla5">
        <div class="wrapin">
            <div class="cla_left lt">
                <div class="in" style="height: 36px;">
                    @foreach($takeSport as $key => $take)
                        <a href="javascript:;" class="headName">{{$key}}</a>
                    @endforeach
                </div>
                @foreach($takeSport as $key => $take)
                    <div class="in listname">
                        @foreach($take as $v)
                            <a href="?authorid={{$v['id']}}">{{ $v['is_english'] == 0 ? $v['china_name'] : $v['foreign_name'] }}</a>
                        @endforeach
                    </div>
                @endforeach
            </div>

            <div class="cla_right rt">
                <form action="" method="post">
                    <input type="text" class="text" name="keywords" value="在本分类下检索"/>
                    {{ csrf_field() }}
                    <input type="submit" class="sub" value="" title="点击搜索"/>
                </form>
            </div>

            <div class="clear"></div>
        </div>
    </div>
    <div class="pro_zw"></div>
    <div class="pro_wrap">
        <div class="pro_nav pro_nav5">
            <a href="?authorclass=0">外国艺术家</a>
            <a href="?authorclass=1">中国艺术家</a>
        </div>

        <div class="pro_list">
            <div class="pro_items">
                @foreach($authors as $author)
                    <a href="/artist/detail/{{$author->id}}" class="item">
                        <span>{{ $author->china_name }}</span>
                        <img src="{{ $author->avatar }}"/>
                    </a>
                @endforeach
                <div class="clear"></div>
            </div>
        </div>

        <div class="line20"></div>
        <div class="line20"></div>
        {!! $authors->appends($seachArray)->render() !!}
        <div class="clear"></div>
    </div>
    <img src="/assets/images/banner_zw.jpg" class="banner_zw" style="display:none;"/>
    @include('home.layouts.footer')
@stop

@section('js')
    <script>
        $(function () {
            $('.in>.headName').hover(function () {
                var location = $(this).index();
                $('.cla_left>.listname').hide();
                $('.cla_left>.listname').eq(location).show();
            });
        })
    </script>
@stop
