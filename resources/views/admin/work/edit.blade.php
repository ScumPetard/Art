@extends('admin.layouts.app')

@section('title','作品')
@section('css')
    <link rel="stylesheet" href="/system/plugins/select2/select2.min.css">
@stop
@section('content')
    <div class="row">
        <div class="col-md-8 col-lg-offset-2">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">编辑作品</h3>
                </div>
                <form role="form" action="/admin/work/edit/{{ $work->id }}" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="form-group">
                            <label>文件名称</label>
                            <input type="text" class="form-control" name="file_name"
                                   value="{{ $work->file_name or '' }}" disabled="" required>
                        </div>
                        <div class="form-group">
                            <label>作品名称</label>
                            <input type="text" class="form-control" name="work_name"
                                   value="{{ $work->work_name or '' }}" maxlength="12" required>
                        </div>
                        <div class="form-group">
                            <label>作者</label>
                            <select name="author_id" class="form-control" id="createauhtor">
                                <option >未选择</option>
                                @foreach($authors as $author)
                                    <option value="{{ $author->id }}"
                                            {{ $author->id == $work->author_id ? 'selected' : '' }} worktype_id="{{ $author->worktype_id }}">{{ $author->china_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>国家</label>
                            <input type="text" class="form-control" maxlength="12" name="countries"
                                   value="{{ $work->countries or '' }}">
                        </div>
                        <div class="form-group">
                            <label>创作时间</label>
                            <input type="date" class="form-control" name="creation_time"
                                   value="{{ $work->creation_time or '' }}">
                        </div>
                        <div class="form-group">
                            <label>材质</label>
                            <input type="text" class="form-control" maxlength="12" name="material"
                                   value="{{ $work->material or '' }}">
                        </div>
                        <div class=" form-group">
                            <label>大小</label>
                            <input type="text" class="form-control" maxlength="12" name="size"
                                   value="{{ $work->size or '' }}">
                        </div>
                        <div class=" form-group">
                            <label>作品类型</label>
                            <select name="worktype_id" class="form-control" id="createWorkType"
                                    onchange="createScreening();authorScreening();">
                                @foreach($worktypes as $worktype)
                                    <option value="{{$worktype->id}}" {{ $worktype->id == $work->worktype_id ? 'selected' : '' }}>{{$worktype->name}}</option>
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
                            <input type="text" class="form-control" maxlength="12" name="creating_location"
                                   value="{{ $work->creating_location or '' }}">
                        </div>
                        <div class="form-group">
                            <label>收藏地址</label>
                            <input type="text" class="form-control" maxlength="12" name="collection_location"
                                   value="{{ $work->collection_location or '' }}">
                        </div>
                        <div class="form-group">
                            <label>高清图 ( 图片大小 874x640 )</label>
                            <input type="file" class="form-control" name="big_image">
                            <p class="help-block">如不想更换高清图请不要上传文件</p>
                        </div>
                        <div class="form-group">
                            <label>简介</label>
                            <textarea name="intro" cols="30" rows="3"
                                      class="form-control"
                                      >{{ $work->intro or '' }}</textarea>
                        </div>
                        <div class="form-group">
                            <div class="radio radio-inline">
                                <label>
                                    <input type="radio" name="is_complete"
                                           value="1" {{ $work->is_complete == 1 ? 'checked' : '' }} >
                                    已完成
                                </label>
                            </div>
                            <div class="radio radio-inline" style="margin-top: 8px">
                                <label>
                                    <input type="radio" name="is_complete"
                                           value="1" {{ $work->is_complete == 0 ? 'checked' : '' }}>
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
    <link href="https://cdn.bootcss.com/select2/4.0.3/css/select2.min.css" rel="stylesheet">
    <script src="/system/plugins/select2/select2.full.min.js"></script>
    <script>
        $(".select2").select2();
        var work_id = {{ $work->worktype_id }};
        var workData = {!! $workdates !!};
        window.onload = function () {
            selecteScreening();
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
        function selecteScreening() {
            $('#createSelect2>option').remove();
            for (var i in workData) {
                if (workData[i]['worktype_id'] == work_id) {
                    if (workData[i]['selected'] == 1) {
                        var str = '<option value="' + workData[i]['id'] + '"  selected>' + workData[i]['name'] + '</option>';
                    }
                    else {
                        var str = '<option value="' + workData[i]['id'] + '">' + workData[i]['name'] + '</option>';
                    }
                    $('#createSelect2').append(str);
                }
            }
        }

        function authorScreening() {
            var dataType = $('#createWorkType').val();
            $('#createauhtor>option').each(function () {
                if ($(this).attr('worktype_id') == dataType) {
                    $(this).show();
                }
                else {
                    $(this).hide();
                }
            });
        }
    </script>
@stop