@extends('home.layouts.app')

@section('title','登录')

@section('content')

        @include('home.layouts.head-v2')
        <div class="reg_area" style="margin-top: 0;">
            <div class="wrapin">
                <form action="" method="post">
                    <div class="reg_bar">
                        <div class="title">用户登录</div>
                        @if(Session::has('memberSign_error'))
                        <div class="in" style="text-align: center;color: red;">
                            <p>{{Session::get('memberSign_error')}}</p>
                        </div>
                        @endif
                        <div class="in">
                            <input type="text" class="text" name="account" value="用户名" required />
                        </div>
                        <div class="line17"></div>

                        <div class="in">
                            <input type="password" class="text" name="password" placeholder="密码" required />
                        </div>
                        {{ csrf_field() }}
                        <input type="submit" class="sub" value="登录" />
                    </div>
                </form>

                <div class="clear"></div>
            </div>
        </div>
        @include('home.layouts.footer')

    @stop

@section('js')
    <script type="text/javascript" src="/assets/js/reg.js"></script>
@stop



