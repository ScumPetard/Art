@extends('admin.layouts.app')

@section('title','单页')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">编辑单页</h3>
                </div>
                <form role="form" action="/admin/page/edit/{{$page->id}}" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="form-group">
                            <label>标题</label>
                            <input type="text" class="form-control" name="title" value="{{$page->title}}" required>
                        </div>
                        <div class="form-group">
                            <label>内容</label>
                            <textarea name="body" id="wangEditor1" cols="30" rows="30" class="form-control" required>{{$page->body}}</textarea>
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
@stop