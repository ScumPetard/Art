@extends('home.layouts.app')

@section('title','个人收藏')

@section('content')
    @include('home.layouts.head-v2')

    <div class="wrapin">

        <div class="now_pos">
            <a href="/">首页</a> &gt;
            <span>修改密码</span>
        </div>

        @include('home.layouts.membernav')

    </div>

    <form action="/member/resetpassword" method="post">
        <div class="reg_bar" style="margin: 0 auto;background: none;border: none;float: inherit;margin-top: 35px;">
            @if(Session::has('memberReset_error'))
                <div class="in" style="text-align: center;color: red;">
                    <p>{{Session::get('memberReset_error')}}</p>
                </div>
            @endif
            <div class="in">
                <p>请输入新密码</p>
                <input type="password" class="text" name="newpassword" value="" required />
            </div>
            <div class="line17"></div>
            <div class="in">
                <p>请输入旧密码</p>
                <input type="password" class="text" name="passworded" placeholder="" required />
            </div>
            {{ csrf_field() }}
            <input type="submit" class="sub" value="确定修改" />
        </div>
    </form>

    <div class="clear"></div>

    @include('home.layouts.footer')
@stop