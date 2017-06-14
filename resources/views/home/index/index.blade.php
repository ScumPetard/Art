@extends('home.layouts.app')

@section('title','北京盛世奇才')

@section('content')

    {{--头部--}}
    @include('home.layouts.head-v1')
    {{--头部End--}}

    {{--banner 大轮播图--}}
    <div class="banner">
        <div class="c_btn pre"></div>
        <div class="c_btn next"></div>
        <ul class="pics">
            @foreach($banners as $banner)
                <li>
                    <span class="name">{{$banner->name}} - <em>{{$banner->intro}}</em></span>
                    <a href="{{$banner->link}}" target="_blank">
                        <img src="{{$banner->url}}"/>
                    </a>
                </li>
            @endforeach
        </ul>
        <div class="btns">
            @foreach($banners as $banner)
                <span></span>
            @endforeach
        </div>

        <img src="/assets/images/banner_zw.jpg" class="banner_zw"/>
    </div>
    {{--banner 大轮播图--}}

    {{--内容--}}
    <div class="hm_wrap">
        <div class="hm_wrapin">

            <a href="/westernoilpainting" class="item item1">
                <div class="inf">
                    <dl>
                        <dt>{{ $pictures[0]->title }}</dt>
                        <dd>
                            {{ $pictures[0]->intro }}
                        </dd>
                    </dl>
                    <span class="btn">浏览全部西方油画</span>
                </div>
                <span class="name">{{ $pictures[0]->title }}</span>
                <img src="{{ $pictures[0]->cover }}"/>
            </a>
            <a href="/chinesepainting" class="item item1">
                <div class="inf">
                    <dl>
                        <dt>{{ $pictures[1]->title }}</dt>
                        <dd>
                            {{ $pictures[1]->intro }}
                        </dd>
                    </dl>
                    <span class="btn">浏览全部中国国画</span>
                </div>
                <span class="name">{{ $pictures[1]->title }}</span>
                <img src="{{ $pictures[1]->cover }}"/>
            </a>
            <a href="/mural" class="item item2">
                <div class="inf">
                    <dl>
                        <dt>{{ $pictures[2]->title }}</dt>
                        <dd>{{ $pictures[2]->intro }}</dd>
                    </dl>
                    <span class="btn">浏览全部唐卡壁画</span>
                </div>
                <span class="name">{{ $pictures[2]->title }}</span>
                <img src="{{ $pictures[2]->cover }}"/>
            </a>
            <a href="/artist" class="item item3">
                <img src="/assets/images/hm_item4.jpg"/>
            </a>
            <a href="/chinesecalligraphy" class="item item2">
                <div class="inf">
                    <dl>
                        <dt>{{ $pictures[3]->title }}</dt>
                        <dd>{{ $pictures[3]->intro }}</dd>
                    </dl>
                    <span class="btn">浏览全部中国书法</span>
                </div>
                <span class="name">{{ $pictures[3]->title }}</span>
                <img src="{{ $pictures[3]->cover }}"/>
            </a>
            <a href="/seal" class="item item2">
                <div class="inf">
                    <dl>
                        <dt>{{ $pictures[4]->title }}</dt>
                        <dd>{{ $pictures[4]->intro }}</dd>
                    </dl>
                    <span class="btn">浏览全部印章印谱</span>
                </div>
                <span class="name">{{ $pictures[4]->title }}</span>
                <img src="{{ $pictures[4]->cover }}"/>
            </a>
            <a href="/fellancientbooks" class="item item2">
                <div class="inf">
                    <dl>
                        <dt>{{ $pictures[5]->title }}</dt>
                        <dd>{{ $pictures[5]->intro }}</dd>
                    </dl>
                    <span class="btn">浏览全部碑帖古籍</span>
                </div>
                <span class="name">{{ $pictures[5]->title }}</span>
                <img src="{{ $pictures[5]->cover }}"/>
            </a>
            <a href="/japan" class="item item3">
                <div class="inf">
                    <dl>
                        <dt>{{ $pictures[6]->title }}</dt>
                        <dd>{{ $pictures[6]->intro }}</dd>
                    </dl>
                    <span class="btn">浏览全部日本版画</span>
                </div>
                <span class="name">{{ $pictures[6]->title }}</span>
                <img src="{{ $pictures[6]->cover }}"/>
            </a>
            <div class="clear"></div>
        </div>
    </div>
    {{--内容End--}}

    {{--尾部--}}
    @include('home.layouts.footer')
    {{--尾部End--}}
@stop

@section('js')
    <script type="text/javascript" src="/assets/js/index.js"></script>
@stop