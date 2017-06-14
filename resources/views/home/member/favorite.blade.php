@extends('home.layouts.app')

@section('title','个人收藏')

@section('content')
    @include('home.layouts.head-v2')

    <div class="wrapin">

        <div class="now_pos">
            <a href="/">首页</a> &gt;
            <span>我的收藏</span>
        </div>

        @include('home.layouts.membernav')

    </div>

    <div class="pro_cart">

        <div class="pro_list">
            <div class="pro_items">
                @foreach($favorites as $favorite)
                    <a href="/work-detail/{{$favorite->id}}" class="item">
                        <span>{{$favorite->work_name}}</span>
                        <img src="{{$favorite->small_image}}"/>
                    </a>
                @endforeach

                <div class="clear"></div>
            </div>
        </div>

        <div class="line20"></div>
        <div class="line20"></div>
        {!! $favorites->render() !!}

        <div class="clear"></div>
    </div>
    @include('home.layouts.footer')
@stop