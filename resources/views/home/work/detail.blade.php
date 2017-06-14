@extends('home.layouts.app')

@section('title',$work->work_name)

@section('content')

    @include('home.layouts.head-v2')
    <div class="wrapin">
        <div style="height:32px;"></div>

        <div class="det_banner">
            <img src="{{$work->big_image}}"/>
        </div>
        <div class="det_tabs">

            <div class="handle">
                <a href="javascript:;" class="hover">作品简介</a>
                <a href="javascript:;">作品详情</a>
            </div>
            <div class="con show">
                <ul>
                    <li>作品名称：<span>{{$work->work_name}}</span></li>
                    @if(isset($work->author))
                    <li>作者：<a href="/artist/detail/{{$work->author->id}}" class="name"><i></i>{{$work->author->china_name}}</a></li>
                    @endif
                    <li>国家：<span>{{$work->countries}}</span></li>
                    <li>创作时间：<span>{{$work->creation_time}}</span></li>
                    <li>材质：<span>{{$work->material}}</span></li>
                    <li>大小：<span>{{$work->size}}</span></li>
                    <li>作品类型：<span>{{$work->worktype->name}}</span></li>
                    <li>创作地点：<span>{{$work->creating_location}}</span></li>
                    <li>收藏机构： <span>{{$work->collection_location}}</span></li>
                    <li>艺术时期： <span>{{$work->author->art_date}}</span></li>
                    @if(Session::has('member') || Session::has('client'))
                        <li>下载图片： <span><a href="/api/down/big-image/{{$work->id}}" target="_blank" style="color: inherit">高清图</a></span>
                        </li>
                    @endif
                </ul>
                @if(Session::has('member') || Session::has('client'))
                    <span style="margin-left: 75px;">{!! QrCode::size(150)->generate(Request::root()."/api/down/image/".$work->id) !!}</span>
                @endif
            </div>

            <div class="con">
                <ul>
                    <li><span>{{$work->intro}}</span></li>
                </ul>
            </div>
        </div>
        <div class="clear"></div>
        @if(Session::has('member') || Session::has('client'))
            <div class="det_ctrl">
                <a href="javascript:;" class="btn collect_a" onclick="favorite(this);" data-id="{{$work->id}}">收藏</a>
                <a href="javascript:;" class="btn share_a">分享</a>
                <div class="share_area">
                    <!-- JiaThis Button BEGIN -->
                    <div class="jiathis_style_24x24">
                        <a class="jiathis_button_qzone"></a>
                        <a class="jiathis_button_tsina"></a>
                        <a class="jiathis_button_tqq"></a>
                        <a class="jiathis_button_weixin"></a>
                        <a class="jiathis_button_renren"></a>
                    </div>
                    <!-- JiaThis Button END -->
                </div>
                {{--@if((Session::has('member') && Session::get('member')->canCat()) || (Session::has('client') && Session::get('client')->buy == 1))--}}
                @if((Session::has('client') && Session::get('client')->buy == 1))
                    <a href="javascript:;" onclick="addCreateCart(this);" data-id="{{$work->id}}" class="det_cart">加入购画车</a>
                    <div class="num_ctrl rt">
                        <div class="c_btn pre"></div>
                        <input type="text" class="num" id="worknum" value="1"/>
                        <div class="c_btn next"></div>
                    </div>
                @endif

                <div class="clear"></div>
            </div>
        @endif
        <div class="det_case"><!--相关作品-->
            <div class="title">
                <span class="tit">相关作品</span>
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
        <div class="clear"></div>
        <div style="height:110px;"></div>
    </div>
    @include('home.layouts.footer')
@stop

@section('js')
    <script type="text/javascript" src="/assets/js/jquery.carouFredSel.js"></script>
    <script type="text/javascript" src="/assets/js/detail.js"></script>
    <script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>
    <script src="https://cdn.bootcss.com/layer/3.0.1/layer.min.js"></script>
    <script>
        /**
         * 用户收藏
         */
        function favorite(object) {
            layer.load(2);
            var work_id = $(object).attr('data-id');
            if (!work_id) {
                return layer.msg('服务器错误!',{time:500},function () {
                    location.reload();
                });
            }
            $.post(
                '/api/favorite',
                {'work_id':work_id,'_token':'{{csrf_token()}}'},
                function (result) {
                    layer.closeAll('loading');
                    return layer.msg(result['message']);
                },'json');
        }

        /**
         * 添加购画车
         */
        function addCreateCart(object) {
            var work_id = $(object).attr('data-id');
            var work_num = $('#worknum').val();
            layer.load(2);
            $.post(
                '/api/createcart',
                {'work_id':work_id,'work_num':work_num,'_token':'{{ csrf_token() }}'},
                function (result) {
                    layer.closeAll('loading');
                    return layer.msg(result['message']);
                },'json');
        }
    </script>
@stop
