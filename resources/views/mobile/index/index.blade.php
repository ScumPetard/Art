@extends('mobile.layouts.base')

@section('title','首页')

@section('body')
    @include('mobile.layouts.seach')
    <!--hm_banner 轮播图-->
    <div class="hm_banner">
        <div class="flexslider">
            <ul class="slides">
                @foreach($banners as $banner)
                    <li>
                    <a href="{{$banner->link}}" target="_blank">
                        <span class="name">{{$banner->name}} - <em>{{$banner->intro}}</em></span>
                        <img src="{{$banner->url}}"/>
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    <!--hm_banner 轮播图-->

    <!--hm_nav 导航-->
    <div class="hm_nav">
        <a href="#">
            <div class="ico"><img src="/mobiles/images/hm_nav1.png"/></div>
            <span>西方油画</span>
        </a>
        <a href="#">
            <div class="ico"><img src="/mobiles/images/hm_nav2.png"/></div>
            <span>中国国画</span>
        </a>
        <a href="#">
            <div class="ico"><img src="/mobiles/images/hm_nav3.png"/></div>
            <span>唐卡壁画</span>
        </a>
        <a href="#">
            <div class="ico"><img src="/mobiles/images/hm_nav4.png"/></div>
            <span>中国书法</span>
        </a>
        <a href="#">
            <div class="ico"><img src="/mobiles/images/hm_nav5.png"/></div>
            <span>印章印谱</span>
        </a>
        <a href="#">
            <div class="ico"><img src="/mobiles/images/hm_nav6.png"/></div>
            <span>碑帖古籍</span>
        </a>
        <a href="#">
            <div class="ico"><img src="/mobiles/images/hm_nav7.png"/></div>
            <span>日本版画</span>
        </a>
        <a href="#">
            <div class="ico"><img src="/mobiles/images/hm_nav8.png"/></div>
            <span>艺术家</span>
        </a>

        <div class="clear"></div>
    </div>
    <!--hm_nav 导航-->

    <div class="hm_pro"><!--西方油画-->

        <div class="title">
            <span class="tit">西方油画</span>
            <a href="#" class="more">更多&gt;</a>
        </div>

        <a href="#" class="cm_photo big">
            <div class="name"><span>伏尔加河上的纤夫<em>-梵高</em></span></div>
            <img src="/mobiles/images/test/hm_big1.jpg" class="thumb"/><!--上传的图片放这里-->
            <img src="/mobiles/images/hmbig_zw.png" class="zw"/><!--防止图片变形的占位符，不要删除！-->
        </a>

        <div class="c_right">
            <a href="#" class="cm_photo small">
                <img src="/mobiles/images/test/hm_s1.jpg" class="thumb"/><!--上传的图片放这里-->
                <img src="/mobiles/images/hms_zw.png" class="zw"/><!--防止图片变形的占位符，不要删除！-->
            </a>
            <a href="#" class="cm_photo small">
                <img src="/mobiles/images/test/hm_s2.jpg" class="thumb"/><!--上传的图片放这里-->
                <img src="/mobiles/images/hms_zw.png" class="zw"/><!--防止图片变形的占位符，不要删除！-->
            </a>
        </div>

        <div class="clear"></div>
    </div>

    <div class="hm_pro"><!--中国国画-->

        <div class="title">
            <span class="tit">中国国画</span>
            <a href="#" class="more">更多&gt;</a>
        </div>

        <a href="#" class="cm_photo big">
            <div class="name"><span>伏尔加河上的纤夫<em>-梵高</em></span></div>
            <img src="/mobiles/images/test/hm_big2.jpg" class="thumb"/><!--上传的图片放这里-->
            <img src="/mobiles/images/hmbig_zw.png" class="zw"/><!--防止图片变形的占位符，不要删除！-->
        </a>

        <div class="c_right">
            <a href="#" class="cm_photo small">
                <img src="/mobiles/images/test/hm_s3.jpg" class="thumb"/><!--上传的图片放这里-->
                <img src="/mobiles/images/hms_zw.png" class="zw"/><!--防止图片变形的占位符，不要删除！-->
            </a>
            <a href="#" class="cm_photo small">
                <img src="/mobiles/images/test/hm_s4.jpg" class="thumb"/><!--上传的图片放这里-->
                <img src="/mobiles/images/hms_zw.png" class="zw"/><!--防止图片变形的占位符，不要删除！-->
            </a>
        </div>

        <div class="clear"></div>
    </div>

    <div class="hm_pro"><!--唐卡壁画-->

        <div class="title">
            <span class="tit">唐卡壁画</span>
            <a href="#" class="more">更多&gt;</a>
        </div>

        <a href="#" class="cm_photo big">
            <div class="name"><span>伏尔加河上的纤夫<em>-梵高</em></span></div>
            <img src="/mobiles/images/test/hm_big1.jpg" class="thumb"/><!--上传的图片放这里-->
            <img src="/mobiles/images/hmbig_zw.png" class="zw"/><!--防止图片变形的占位符，不要删除！-->
        </a>

        <div class="c_right">
            <a href="#" class="cm_photo small">
                <img src="/mobiles/images/test/hm_s1.jpg" class="thumb"/><!--上传的图片放这里-->
                <img src="/mobiles/images/hms_zw.png" class="zw"/><!--防止图片变形的占位符，不要删除！-->
            </a>
            <a href="#" class="cm_photo small">
                <img src="/mobiles/images/test/hm_s2.jpg" class="thumb"/><!--上传的图片放这里-->
                <img src="/mobiles/images/hms_zw.png" class="zw"/><!--防止图片变形的占位符，不要删除！-->
            </a>
        </div>

        <div class="clear"></div>
    </div>

    <div class="hm_pro"><!--中国书法-->

        <div class="title">
            <span class="tit">中国书法</span>
            <a href="#" class="more">更多&gt;</a>
        </div>

        <a href="#" class="cm_photo big">
            <div class="name"><span>伏尔加河上的纤夫<em>-梵高</em></span></div>
            <img src="/mobiles/images/test/hm_big1.jpg" class="thumb"/><!--上传的图片放这里-->
            <img src="/mobiles/images/hmbig_zw.png" class="zw"/><!--防止图片变形的占位符，不要删除！-->
        </a>

        <div class="c_right">
            <a href="#" class="cm_photo small">
                <img src="/mobiles/images/test/hm_s1.jpg" class="thumb"/><!--上传的图片放这里-->
                <img src="/mobiles/images/hms_zw.png" class="zw"/><!--防止图片变形的占位符，不要删除！-->
            </a>
            <a href="#" class="cm_photo small">
                <img src="/mobiles/images/test/hm_s2.jpg" class="thumb"/><!--上传的图片放这里-->
                <img src="/mobiles/images/hms_zw.png" class="zw"/><!--防止图片变形的占位符，不要删除！-->
            </a>
        </div>

        <div class="clear"></div>
    </div>

    <div class="hm_pro"><!--印章印谱-->

        <div class="title">
            <span class="tit">印章印谱</span>
            <a href="#" class="more">更多&gt;</a>
        </div>

        <a href="#" class="cm_photo big">
            <div class="name"><span>伏尔加河上的纤夫<em>-梵高</em></span></div>
            <img src="/mobiles/images/test/hm_big1.jpg" class="thumb"/><!--上传的图片放这里-->
            <img src="/mobiles/images/hmbig_zw.png" class="zw"/><!--防止图片变形的占位符，不要删除！-->
        </a>

        <div class="c_right">
            <a href="#" class="cm_photo small">
                <img src="/mobiles/images/test/hm_s1.jpg" class="thumb"/><!--上传的图片放这里-->
                <img src="/mobiles/images/hms_zw.png" class="zw"/><!--防止图片变形的占位符，不要删除！-->
            </a>
            <a href="#" class="cm_photo small">
                <img src="/mobiles/images/test/hm_s2.jpg" class="thumb"/><!--上传的图片放这里-->
                <img src="/mobiles/images/hms_zw.png" class="zw"/><!--防止图片变形的占位符，不要删除！-->
            </a>
        </div>

        <div class="clear"></div>
    </div>

    <div class="hm_pro"><!--碑帖古籍-->

        <div class="title">
            <span class="tit">碑帖古籍</span>
            <a href="#" class="more">更多&gt;</a>
        </div>

        <a href="#" class="cm_photo big">
            <div class="name"><span>伏尔加河上的纤夫<em>-梵高</em></span></div>
            <img src="/mobiles/images/test/hm_big1.jpg" class="thumb"/><!--上传的图片放这里-->
            <img src="/mobiles/images/hmbig_zw.png" class="zw"/><!--防止图片变形的占位符，不要删除！-->
        </a>

        <div class="c_right">
            <a href="#" class="cm_photo small">
                <img src="/mobiles/images/test/hm_s1.jpg" class="thumb"/><!--上传的图片放这里-->
                <img src="/mobiles/images/hms_zw.png" class="zw"/><!--防止图片变形的占位符，不要删除！-->
            </a>
            <a href="#" class="cm_photo small">
                <img src="/mobiles/images/test/hm_s2.jpg" class="thumb"/><!--上传的图片放这里-->
                <img src="/mobiles/images/hms_zw.png" class="zw"/><!--防止图片变形的占位符，不要删除！-->
            </a>
        </div>

        <div class="clear"></div>
    </div>

    <div class="hm_pro"><!--日本版画-->

        <div class="title">
            <span class="tit">日本版画</span>
            <a href="#" class="more">更多&gt;</a>
        </div>

        <a href="#" class="cm_photo big">
            <div class="name"><span>伏尔加河上的纤夫<em>-梵高</em></span></div>
            <img src="/mobiles/images/test/hm_big1.jpg" class="thumb"/><!--上传的图片放这里-->
            <img src="/mobiles/images/hmbig_zw.png" class="zw"/><!--防止图片变形的占位符，不要删除！-->
        </a>

        <div class="c_right">
            <a href="#" class="cm_photo small">
                <img src="/mobiles/images/test/hm_s1.jpg" class="thumb"/><!--上传的图片放这里-->
                <img src="/mobiles/images/hms_zw.png" class="zw"/><!--防止图片变形的占位符，不要删除！-->
            </a>
            <a href="#" class="cm_photo small">
                <img src="/mobiles/images/test/hm_s2.jpg" class="thumb"/><!--上传的图片放这里-->
                <img src="/mobiles/images/hms_zw.png" class="zw"/><!--防止图片变形的占位符，不要删除！-->
            </a>
        </div>

        <div class="clear"></div>
    </div>

    <div class="hm_pro"><!--艺术家-->

        <div class="title">
            <span class="tit">艺术家</span>
            <a href="#" class="more">更多&gt;</a>
        </div>

        <a href="#" class="cm_photo big">
            <div class="name"><span>伏尔加河上的纤夫<em>-梵高</em></span></div>
            <img src="/mobiles/images/test/hm_big1.jpg" class="thumb"/><!--上传的图片放这里-->
            <img src="/mobiles/images/hmbig_zw.png" class="zw"/><!--防止图片变形的占位符，不要删除！-->
        </a>

        <div class="c_right">
            <a href="#" class="cm_photo small">
                <img src="/mobiles/images/test/hm_s1.jpg" class="thumb"/><!--上传的图片放这里-->
                <img src="/mobiles/images/hms_zw.png" class="zw"/><!--防止图片变形的占位符，不要删除！-->
            </a>
            <a href="#" class="cm_photo small">
                <img src="/mobiles/images/test/hm_s2.jpg" class="thumb"/><!--上传的图片放这里-->
                <img src="/mobiles/images/hms_zw.png" class="zw"/><!--防止图片变形的占位符，不要删除！-->
            </a>
        </div>

        <div class="clear"></div>
    </div>
@stop