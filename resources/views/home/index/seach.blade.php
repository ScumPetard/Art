@extends('home.layouts.app')

@section('title','搜索结果')

@section('content')

    @include('home.layouts.head-v2')

    <div class="pro_cla pro_cla5">
        <div class="wrapin">
            <div class="cla_left lt" style="height: 65px;">
                <h1 style="font-weight: 300;line-height: 65px;">[ {{ $key }} ] 搜索结果</h1>
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
        <div class="pro_list" style="float: inherit">
            <div class="pro_items">
                @foreach($works as $work)
                    <a href="/work-detail/{{$work->id}}" class="item">
                        <span>{{ $work->work_name }}</span>
                        <img src="{{ $work->small_image }}"/>
                    </a>
                @endforeach
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
        <div class="clear"></div>
    </div>
    <img src="/assets/images/banner_zw.jpg" class="banner_zw" style="display:none;"/>
    @include('home.layouts.footer')
@stop
