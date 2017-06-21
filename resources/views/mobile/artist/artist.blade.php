@extends('mobile.layouts.base')

@section('title','艺术家')

@section('body')

    <!--header 顶部-->
    <div class="header">
        <div class="head_search">
            <form>
                <input type="submit" class="sub" value=""/>
                <input type="search" class="text" placeHolder="请输入搜索内容"/>
            </form>
        </div>
    </div>
    <div class="header_zw"></div>
    <!--header 顶部-->

    <div class="cla_tp">
        <div class="clatp_left lt">
            <div class="clatp_list">
                <a href="javascript:void(0);" data="1" @click="domesticandforeign(this)">国内艺术家</a>
                <a href="javascript:void(0);" data="0" @click="domesticandforeign(this)">国外艺术家</a>
                <div class="clear"></div>
            </div>
        </div>
        <div class="c_btn"></div>

        <div class="clatp_btn" @click="show"></div>

        <div class="clear"></div>
    </div>

    <!--筛选弹窗-->
    <div class="cla_win">
        <form action="" method="get">
            <div class="cla_sel clasel_handle">
                <input type="hidden" class="ipu" value=""/>
                <div class="cla_t1">
                    <span class="tit lt">按字母筛选</span>
                    <div class="name">全部</div>
                </div>
                <div class="clear"></div>
                @foreach($works as $key => $work)
                    <a href="javascript:;" class="item item1">{{ $key }}</a>
                @endforeach
                <div class="clear"></div>
            </div>

            @foreach($works as $key => $work)
                <div class="cla_sel clasel_con">
                    <div class="cla_t1">
                        <span class="tit lt">按名字筛选</span>
                        <div class="name">全部</div>
                    </div>
                    <div class="clear"></div>

                    @foreach($work as $artist)
                        <a href="javascript:;" class="item item2"
                           work="{{ $artist['id'] }}" v-bind:click="work(this)">{{ $artist['china_name'] }}</a>
                    @endforeach
                    <div class="clear"></div>
                </div>
            @endforeach

            <div class="cla_ctrl">
                <a href="javascript:;" class="reset_a" @click="hide">取消</a>
                <button type="button" class="ok_a">确定</button>
            </div>
            <div class="cla_zw"></div>

        </form>
    </div>
    <div class="cla_flog"></div>
    <!--筛选弹窗-->

    <div style="height:1rem;clear:both;"></div>

        <div class="cla_list">
            @foreach($artists as $artist)
                <a href="#" class="cla_item">
                    <div class="cm_photo">
                        <img src="{{ $artist->avatar }}" class="thumb"/><!--上传的图片放这里-->
                        <img src="/mobiles/images/cla_zw.png" class="zw"/><!--防止图片变形的占位符，不要删除！-->
                    </div>
                    <span class="name">{{ $artist->china_name }}</span>
                </a>
            @endforeach
                <a href="#" class="cla_item" v-for="artist in artists">
                    <div class="cm_photo">
                        <img :src="artist.avatar" class="thumb"/><!--上传的图片放这里-->
                        <img src="/mobiles/images/cla_zw.png" class="zw"/><!--防止图片变形的占位符，不要删除！-->
                    </div>
                    <span class="name" v-text="artist.china_name"></span>
                </a>
            <div class="clear"></div>
        </div>

        <a href="javascript:void(0);" class="see_more" @click="preview">
            <span>加载更多内容</span>
        </a>



@stop
@section('js')
    {{--<script type="text/javascript">--}}

        {{--new ChangeDiv({--}}
            {{--btns: $(".clasel_handle .item"),--}}
            {{--divs: $(".clasel_con"),--}}
            {{--type: "click"--}}
        {{--});--}}

        {{--//cla_tp 滚动--}}
        {{--var clatpW = 0;--}}
        {{--$(".clatp_list a").each(function () {--}}
            {{--clatpW += ($(this).width() + parseFloat($(this).css("padding-left")) * 2);--}}
        {{--});--}}
        {{--clatpW += (parseFloat($(".clatp_list").css("padding-left")) * 2 + 5);--}}

        {{--$(".clatp_list").width(clatpW);--}}

        {{--//cla_sel 选中--}}
        {{--$(".cla_sel .item").click(function () {--}}

            {{--var _par = $(this).parents(".cla_sel");--}}

            {{--$(".item", _par).removeClass("hover");--}}
            {{--$(this).addClass("hover");--}}

            {{--$(".name", _par).html($(this).html());--}}
            {{--$(".ipu", _par).val($(this).html());--}}
            {{--$(".name", _par).addClass("name_hover");--}}

        {{--});--}}

        {{--$(".cla_win .reset_a").click(function () {	//重置--}}
            {{--$(".clasel_con").removeClass("show");--}}
            {{--$($(".clasel_con")[0]).addClass("show");--}}
            {{--$(".ipu").val("");--}}
            {{--$(".cla_win .item").removeClass("hover");--}}
            {{--$(".cla_win .name").html("全部").removeClass("name_hover");--}}
        {{--});--}}

        {{--$(".cla_win .ok_a,.cla_flog").click(function () {	//确定--}}
            {{--$(".cla_win").hide();--}}
            {{--$(".cla_flog").hide();--}}
        {{--});--}}

        {{--$(".clatp_btn").click(function () {--}}
            {{--$(".cla_win").show();--}}
            {{--$(".cla_flog").show();--}}
        {{--});--}}

    {{--</script>--}}
    <script src="https://cdn.bootcss.com/vue/2.3.4/vue.js"></script>
    <script>
        new Vue({
            el:'#app',
            data:{
                page :1,
                artists:{},
                where:{
                    seach:'',
                    page:1,
                    domesticandforeign:'',
                    work_key:'',
                },
            },
            methods:{
                show : function() {
                    $('.cla_win').show();
                    $('.cla_flog').show();
                },
                hide : function () {
                    $('.cla_win').hide();
                    $('.cla_flog').hide();
                },
                preview : function() {
                    console.log(this.$data.where);
//                    this.$http.get('/mobile/artist',{'album':picture.id}).then(response => {
//
//                    });
                },
                work : function (object) {
//                    alert(2);
                    this.$data.where.work_key = $(object).attr('work');
                },
                domesticandforeign : function (object) {
//                    alert(1);
                    this.$data.where.domesticandforeign = $(object).attr('data');
                }
            }
        })
    </script>
@stop
