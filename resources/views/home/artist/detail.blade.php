@extends('home.layouts.app')

@section('title','艺术家')

    @section('css')
        <style>
            .tit {
                font-weight: bold;
            }
        </style>
        @stop
@section('content')

    @include('home.layouts.head-v2')

    <div class="wrapin">

        <div class="now_pos">
            <a href="/">首页</a> &gt;
            <a href="/artist">艺术家</a> &gt;
            <span>{{$artist->china_name}}</span>
        </div>

        <div class="art_top">

            <div class="photo">
                <img src="{{$artist->avatar}}"/>
            </div>

            <div class="inf">
                <ul class="u1">
                    <li><span class="tit">中文名：</span>{{$artist->china_name}}</li>
                    <li><span class="tit">外文名：</span>{{$artist->foreign_name}}</li>
                    <li><span class="tit">别　名：</span>{{$artist->alias_name}}</li>
                </ul>

                <ul class="u2">
                    <li><span class="tit">性别：</span>{{$artist->gender==0?'女':'男'}}</li>
                    <li><span class="tit">国籍：</span>{{$artist->nationality}}</li>
                    <li><span class="tit">出生地：</span>{{$artist->born}}</li>
                    <li><span class="tit">出生日期：</span>{{$artist->birth_date}}</li>
                    <li><span class="tit">逝世地：</span>{{$artist->death_address}}</li>
                    <li><span class="tit">逝世日期：</span>{{$artist->death}}</li>
                </ul>
                <ul class="u2">
                    <li><span class="tit">艺术特点：</span>{{$artist->art_features}}</li>
                    <li><span class="tit">艺术流派：</span> {{$artist->art_genre}}</li>
                    <li><span class="tit">艺术时期：</span> {{$artist->art_date}}</li>
                    <li><span class="tit">影响：</span>{{$artist->impact}}</li>
                    <li><span class="tit">格言：</span>{{$artist->motto}}</li>
                    <li><span class="tit">主要成就：</span>{{$artist->achievement}}</li>
                </ul>

                <div class="clear"></div>
            </div>

            <div class="clear"></div>
        </div>

        <div class="det_case"><!--相关作品-->
            <div class="title">
                <span class="tit">相关艺术作品</span>
                <a href="{{ route('artist.work.list',['id' => $artist->id]) }}" class="more">赏析艺术家作品 &gt;</a>
            </div>

            <div class="det_slide">
                <div class="c_btn pre"></div>
                <div class="c_btn next"></div>

                <div class="s_wrap">
                    <ul>
                        @foreach($relatedWorks as $work)
                            <li><a href="/work-detail/{{$work->id}}"><img src="{{$work->small_image}}"/></a></li>
                        @endforeach
                    </ul>
                </div>

            </div>

        </div>

        <div class="art_intro">

            <div class="title">
                <span class="tit"><img src="/assets/images/art_ico1.png"/>历史评价</span>
            </div>
            <p>{{$artist->evaluation}}</p>
        </div>

        <div class="art_intro">

            <div class="title">
                <span class="tit"><img src="/assets/images/art_ico2.png"/>艺术家简介</span>
            </div>

            <p>{!! $artist->intro !!}</p>

        </div>

        <div class="clear"></div>
        <div style="height:110px;"></div>
    </div>

    @include('home.layouts.footer')

@stop

@section('js')
    <script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>
    <script type="text/javascript" src="/assets/js/jquery.carouFredSel.js"></script>
    <script type="text/javascript" src="/assets/js/art_detail.js"></script>
@stop


