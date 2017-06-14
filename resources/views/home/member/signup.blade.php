@extends('home.layouts.app')

@section('title','登录')

@section('content')

    @include('home.layouts.head-v2')
    <div class="reg_area" style="margin-top: 0;">
        <div class="wrapin">
                <div class="reg_bar">
                    <div class="title">用户注册</div>
                    @if(Session::has('memberSign_error'))
                        <div class="in" style="text-align: center;color: red;">
                            <p>{{Session::get('memberSign_error')}}</p>
                        </div>
                    @endif
                    <form action="/member/signup" method="post">
                        <div class="in">
                            <input type="text" class="text" name="account" placeholder="用户名" required maxlength="20"/>
                        </div>
                        <div class="line17"></div>
                        <div class="in">
                            <input type="password" class="text" name="password" placeholder="密码" required maxlength="20"/>
                        </div>
                        <div class="tip">2-6位字符，可输入英文、数字，不能输入特殊符号</div>
                        <div class="in">
                            <input type="password" class="text" name="confirmpassword" placeholder="确认密码" required maxlength="20"/>
                        </div>
                        <div class="tip">6-16位字符（字母、数字、特殊符号）</div>
                        <div class="in">
                            <input type="email" class="text" name="email" placeholder="邮箱" required maxlength="20"/>
                        </div>
                        <div class="tip">用于找回密码</div>
                        {{ csrf_field() }}
                        <input type="submit" class="sub" value="注册"/>
                    </form>
                </div>
            <div class="clear"></div>
        </div>
    </div>
    @include('home.layouts.footer')

@stop

@section('js')
    <script type="text/javascript" src="/assets/js/reg.js"></script>
@stop



