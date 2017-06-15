@extends('admin.layouts.app')

@section('title','作者')

@section('content')
    <div class="row">
        <div class="col-md-8 col-lg-offset-2">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">添加作者</h3>
                </div>
                <form role="form" action="/admin/author/create" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="form-group">
                            <label>文件名称 <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" maxlength="15" name="file_name" required>
                        </div>
                        <div class="form-group">
                            <label>中文名 <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" maxlength="15" name="china_name" required>
                        </div>
                        <div class="form-group">
                            <label>外文名</label>
                            <input type="text" class="form-control" maxlength="15" name="foreign_name">
                        </div>
                        <div class="form-group">
                            <label>别名</label>
                            <input type="text" class="form-control " maxlength="15" name="alias_name">
                        </div>
                        <div class="form-group">
                            <label>作品类型</label>
                            <select name="worktype_id" class="form-control">
                                @foreach($worktypes as $worktype)
                                <option value="{{$worktype->id}}">{{$worktype->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>作品分类/时期</label>
                            <select name="workdate_id" class="form-control">
                                @foreach($workdates as $workdate)
                                    <option value="{{$workdate->id}}" worktype_id="{{ $workdate->worktype->id }}">{{$workdate->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="radio radio-inline">
                                <label>
                                    <input type="radio" name="gender" value="1" checked>
                                    男
                                </label>
                            </div>
                            <div class="radio radio-inline" style="margin-top: 8px">
                                <label>
                                    <input type="radio" name="gender" value="0">
                                    女
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="radio radio-inline">
                                <label>
                                    <input type="radio" name="domesticandforeign" value="1" checked>
                                    国内艺术家
                                </label>
                            </div>
                            <div class="radio radio-inline" style="margin-top: 8px">
                                <label>
                                    <input type="radio" name="domesticandforeign" value="0">
                                    国外艺术家
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>国籍</label>
                            <input type="text" class="form-control" maxlength="15" name="nationality">
                        </div>
                        <div class="form-group">
                            <label>出生地</label>
                            <input type="text" class="form-control" maxlength="15" name="born">
                        </div>
                        <div class="form-group">
                            <label>出生日期</label>
                            <input type="text" class="form-control" name="birth_date">
                        </div>
                        <div class="form-group">
                            <label>逝世地</label>
                            <input type="text" class="form-control" maxlength="15" name="death_address">
                        </div>
                        <div class="form-group">
                            <label>逝世时间</label>
                            <input type="text" class="form-control" name="death">
                        </div>
                        <div class="form-group">
                            <label>艺术特点</label>
                            <input type="text" class="form-control" maxlength="15" name="art_features">
                        </div>
                        <div class="form-group">
                            <label>艺术流派</label>
                            <input type="text" class="form-control" maxlength="15" name="art_genre">
                        </div>
                        <div class="form-group">
                            <label>艺术时期</label>
                            <input type="text" class="form-control" maxlength="15" name="art_date">
                        </div>
                        <div class="form-group">
                            <label>影响</label>
                            <textarea name="impact" cols="30" rows="3" class="form-control" maxlength="30" ></textarea>
                        </div>
                        <div class="form-group">
                            <label>格言</label>
                            <textarea name="motto" cols="30" rows="3" maxlength="30" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label>头像 ( 图片大小 442x305 ) <span style="color: red;">*</span></label>
                            <input type="file" class="form-control" name="avatar" required>
                        </div>
                        <div class="form-group">
                            <label>成就</label>
                            <textarea name="achievement" cols="30" rows="5" maxlength="60" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label>评价</label>
                            <textarea name="evaluation" cols="30" rows="5" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label>简介</label>
                            <textarea name="intro" id="wangEditor1" cols="30" rows="30" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="box-footer">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-info">提交</button>
                        <a href="javascript:history.go(-1);" class="btn btn-default">取消</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('js')
    @include('admin.layouts.WangEditor')
    <script>
        window.onload = function () {
            screening();
        }
        $('select[name=worktype_id]').change(function () {
            screening();
        });
        function screening() {
            var worktype_id = $('select[name=worktype_id]').val();
            $('select[name=workdate_id]>option').each(function () {
                if ($(this).attr('worktype_id') == worktype_id) {
                    $(this).show();
                }
                else {
                    $(this).hide();
                }
            });
        }
    </script>
@stop