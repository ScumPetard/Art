@extends('admin.layouts.app')

@section('title','作者')
@section('css')
    <link rel="stylesheet" href="/system/plugins/select2/select2.min.css">
@stop
@section('content')
    <div class="row">
        <div class="col-md-8 col-lg-offset-2">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">添加作品</h3>
                </div>
                <form role="form" action="/admin/work/create" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="form-group">
                            <label>文件名称</label>
                            <input type="text" class="form-control" name="file_name" required>
                        </div>
                        <div class="form-group">
                            <label>作品名称</label>
                            <input type="text" class="form-control" name="work_name" maxlength="12" required>
                        </div>
                        <div class="form-group">
                            <label>作者</label>
                            <select name="author_id" class="form-control" id="createauhtor">
                                @foreach($authors as $author)
                                    <option value="{{ $author->id }}" worktype_id="{{ $author->worktype_id }}">{{ $author->file_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>国家</label>
                            <input type="text" class="form-control" maxlength="12" name="countries">
                        </div>
                        <div class="form-group">
                            <label>创作时间</label>
                            <input type="date" class="form-control" name="creation_time">
                        </div>
                        <div class="form-group">
                            <label>材质</label>
                            <input type="text" class="form-control" maxlength="12" name="material">
                        </div>
                        <div class="form-group">
                            <label>大小</label>
                            <input type="text" class="form-control" maxlength="12" name="size">
                        </div>
                        <div class="form-group">
                            <label>作品类型</label>
                            <select name="worktype_id" class="form-control" id="createWorkType"
                                    onchange="createScreening();authorScreening();">
                                @foreach($worktypes as $worktype)
                                    <option value="{{$worktype->id}}">{{$worktype->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group" id="createWorkDate">
                            <label style="display: block">作品分类/时期</label>
                            <select class="form-control select2" id="createSelect2" name="workdate_id[]"
                                    multiple="multiple" data-placeholder="请选择作品分类" style="width: 100%;" required>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>创作地点</label>
                            <input type="text" class="form-control" maxlength="12" name="creating_location">
                        </div>
                        <div class="form-group">
                            <label>收藏地址</label>
                            <input type="text" class="form-control" maxlength="12" name="collection_location">
                        </div>
                        <div class="form-group">
                            <label>高清图 ( 图片大小 874x640 )</label>
                            <input type="file" class="form-control" name="big_image" required>
                        </div>
                        <div class="form-group">
                            <label>简介</label>
                            <textarea name="intro" cols="30" rows="3" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <div class="radio radio-inline">
                                <label>
                                    <input type="radio" name="is_complete" value="1" checked>
                                    已完成
                                </label>
                            </div>
                            <div class="radio radio-inline" style="margin-top: 8px">
                                <label>
                                    <input type="radio" name="is_complete" value="0">
                                    未完成
                                </label>
                            </div>
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
    <script src="/system/plugins/select2/select2.full.min.js"></script>
    <script>
        $(".select2").select2();
        var workData = {!! $workdates !!};
        window.onload = function () {
            createScreening();
            authorScreening();
        }
        function createScreening() {
            var dataType = $('#createWorkType').val();
            $('#createSelect2>option').remove();
            for (var i in workData) {
                if (workData[i]['worktype_id'] == dataType) {
                    var str = '<option value="' + workData[i]['id'] + '">' + workData[i]['name'] + '</option>';
                    $('#createSelect2').append(str);
                }
            }
        }

        function authorScreening() {
            var dataType = $('#createWorkType').val();
            $('#createauhtor>option').each(function () {
                if($(this).attr('worktype_id') == dataType) {
                    $(this).show();
                    $('#createauhtor').val($(this).val());
                }
                else {
                    $(this).hide();
                }
            });
        }
    </script>
@stop