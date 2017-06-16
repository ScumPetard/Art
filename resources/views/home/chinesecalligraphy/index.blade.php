@extends('home.layouts.app')

@section('title','中国国画')

@section('css')
    <style>
        .workdate-hover {
            color: #fff !important;
            background: url(/assets/images/pro_nav1.png) no-repeat left center !important;
        }
        .pro_nav1 a:hover,.pro_nav1 a.hover{
            color:#fff;
            background:url("/assets/images/pro_nav1.png") no-repeat left center;
        }
    </style>
@stop

@section('content')
    @include('home.layouts.head-v3')

    <!--banner 大轮播图-->
    <div class="banner">
        <div class="c_btn pre"></div>
        <div class="c_btn next"></div>
        <ul class="pics">
            @foreach($banners as $banner)
            <li>
                <span class="name">{{$banner->name}} - <em>{{$banner->intro}}</em></span>
                <a href="{{$banner->link}}" target="_blank">
                    <img src="{{$banner->url}}" />
                </a>
            </li>
            @endforeach
        </ul>
        <div class="btns">
            @foreach($banners as $banner)
                <span></span>
            @endforeach
        </div>

        <img src="/assets/images/banner_zw.jpg" class="banner_zw" />
    </div>
    <!--banner 大轮播图-->

    <div class="pro_cla pro_cla1">
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
                            <a href="?authorid={{$v['id']}}" @if(isset($where['authorid'])) class="{{ $v['id']==$where['authorid'] ? 'author-hover' : '' }}" @endif>{{ $v['is_english'] == 0 ? $v['china_name'] : $v['foreign_name'] }}</a>
                        @endforeach
                    </div>
                @endforeach

            </div>

            <div class="cla_right rt">
                <form action="" method="post">
                    <input type="text" class="text" name="keywords" placeholder="在本分类下检索" />
                    {{ csrf_field() }}
                    <button type="submit" class="sub" style="border: none;"></button>

                </form>
            </div>

            <div class="clear"></div>
        </div>
    </div>
    <div class="pro_zw"></div>
    <div class="pro_wrap">
        <div class="pro_nav pro_nav1">
            @foreach($workdates as $workdate)
                <a href="?workdate={{$workdate->id}}" @if(isset($where['workdate'])) class="{{ $workdate->id==$where['workdate'] ? 'workdate-hover' : '' }}" @endif>{{$workdate->name}}</a>
            @endforeach
        </div>
        <div class="pro_list">
            <div class="pro_items">
                @foreach($works as $work)
                    <a href="/work-detail/{{$work->id}}" class="item">
                        <span>{{$work->work_name}}</span>
                        <img src="{{$work->small_image}}" />
                    </a>
                @endforeach
                <div class="clear"></div>
            </div>
        </div>
        <div class="line20"></div>
        <div class="line20"></div>
        {!! $works->appends($where)->render() !!}
        <div class="clear"></div>
    </div>
    @include('home.layouts.footer')
@stop
@section('js')
    <script>
        $(function () {$('.in>.headName').hover(function () {var location = $(this).index();$('.cla_left>.listname').hide();$('.cla_left>.listname').eq(location).show();});})
    </script>
@stop
