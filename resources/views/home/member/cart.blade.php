@extends('home.layouts.app')

@section('title','购画车')

@section('content')
    @include('home.layouts.head-v2')

    <div class="wrapin">

        <div class="now_pos">
            <a href="#">首页</a> &gt;
            <span>个人空间</span>
        </div>

        @include('home.layouts.membernav')

    </div>

    <div class="pro_cart" style="margin-top:0;">

        <div class="cart_tp">

            <label class="lt"> <a href="javascript:;"  class="btn" id="selectAll"  style="background: #f4645f;width: 80px;    font-size: 14px;">全选/反选</a></label>
            <a href="javascript:;"  class="btn" id="carFrmButton">导出已选作品</a>
            <dl>
                <dt>已选作品：<span class="yx1"></span>个，共<span class="yx2"></span>副</dt>
                <dd>每次最多可选择200副作品</dd>
            </dl>
            <div class="clear"></div>
        </div>

        <div class="cart_items">
            <form action="/member/cart/excel" method="post" id="cartForm">
            @foreach($carts as $cart)
                <div class="cart_item">
                    <label class="label-item">
                        <span class="chk" num="{{ $cart->num }}"></span>
                        <input type="checkbox" class="ck_d" name="xls[]" value="{{ $cart->id }}">
                    </label>
                    <a href="#" class="photo">
                        <img src="{{$cart->work->small_image}}"/>
                    </a>
                    <ul>
                        <li>名称：{{$cart->work->work_name}}</li>
                        <li>作者：{{$cart->work->author->china_name}}</li>
                        <li>大小：{{$cart->work->size}}</li>
                        <li>类型：{{$cart->work->worktype->name}}</li>
                    </ul>
                    <div class="mof rt">
                        <div class="num_ctrl">
                            <a href="/member/cart/detach/{{$cart->work->id}}"><div class="c_btn pre"></div></a>
                            <input type="text" class="num" value="{{$cart->num}}"/>
                            <a href="/member/cart/attach/{{$cart->work->id}}"><div class="c_btn next"></div></a>
                        </div>
                        <dl>
                            <dt><a href="#" class="collect_a" onclick="favorite(this);" data-id="{{$cart->work->id}}">移入收藏夹</a></dt>
                            <dd><a href="#" class="del_a" onclick="addCreateCart(this)" data-id="{{$cart->work->id}}">删除</a></dd>
                        </dl>
                    </div>
                    <div class="clear"></div>
                </div>
            @endforeach
                {{ csrf_field() }}
            </form>
            <div class="clear"></div>
        </div>

        <div class="line20"></div>
        <div class="line20"></div>
        {{--<div class="page">--}}
            {{--<form>--}}
                {{--<div class="rt">--}}
                    {{--<a href="#">上一页</a>--}}
                    {{--<span>1</span>--}}
                    {{--<a href="#">2</a>--}}
                    {{--<a href="#">3</a>--}}
                    {{--<a href="#">4</a>--}}
                    {{--<a href="#">5</a>--}}
                    {{--<a href="#">6</a>--}}
                    {{--<a href="#">7</a>--}}
                    {{--<a href="#">8</a>--}}
                    {{--<a href="#">下一页</a>--}}
                    {{--<input type="text" class="text"/>--}}
                    {{--<input type="submit" class="sub" value="跳转"/>--}}
                {{--</div>--}}
            {{--</form>--}}
        {{--</div>--}}

        <div class="clear"></div>
    </div>

    @include('home.layouts.footer')
@stop

@section('js')
    <script type="text/javascript" src="/assets/js/cart.js"></script>
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

        function addCreateCart(object) {
            var work_id = $(object).attr('data-id');
            layer.load(2);
            $.post(
                '/api/detachcart',
                {'work_id':work_id,'_token':'{{ csrf_token() }}'},
                function (result) {
                    layer.closeAll('loading');
                    if (result['code']) {
                        return layer.msg(result['message'],{time:500},function () {
                            location.reload();
                        });
                    }
                    return layer.msg(result['message'],{time:500});
                },'json');
        }
        $('#carFrmButton').click(function () {
            $('#cartForm').submit();
        });

        $('#selectAll').click(function () {
            $('.chk').click();
        });
        $('.label-item').click(function () {
            suns();
        });

        function suns() {
            var num1 = 0;
            var num2 = 0;
            $(".chk").each(function(num){
                if($(this).hasClass("chk_hover")){
                    num1++;
                    num2 += parseInt($(this).attr('num'));
                }
            });
            $('.yx1').text(num1);
            $('.yx2').text(num2);
        }
    </script>
@stop
