@extends('home.layouts.app')

@section('title','无权访问')

@section('content')

    @include('home.layouts.head-v2')


    <div class="pro_zw"></div>
    <div class="pro_wrap">
        <div class="pro_list" style="float: inherit;height: 300px;text-align: center;    background: #fff;margin-top: 100px;box-shadow: 0 1px 5px #c3c3c3;border-radius: 5px;">
            <p style="    margin: 100px auto;font-size: 30px;font-weight: 300;">您现在还无权观看该分类内容，请选择其他分类查看！</p>
            <a href="javascript:history.go(-1)" style="padding: 15px 20px;background: #de6a36;color: #fff;border-radius: 5px;">返回</a>
        </div>

        <div class="line20"></div>
        <div class="line20"></div>

        <div class="clear"></div>
    </div>
    <img src="/assets/images/banner_zw.jpg" class="banner_zw" style="display:none;"/>
    @include('home.layouts.footer')
@stop
