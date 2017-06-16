@extends('admin.layouts.app')

@section('title','作者')

@section('css')
    <style>
        .img-circle {
            width: 70px;
            height: 70px;
        }

        td {
            line-height: 70px !important;
        }
    </style>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">作者</h3>
                    <a href="/admin/author/create" class="btn btn-info pull-right">添加作者</a>
                </div>
                <div class="box-body">
                    <table id="example1"  class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>头像</th>
                            <th>文件名称</th>
                            <th>中文名称</th>
                            <th>国籍</th>
                            <th>添加时间</th>
                            <th>最后修改时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($authors as $author)
                            <tr>
                                <td>{{ $author->id }}</td>
                                <td><img src="{{ $author->avatar }}" class="img-circle"></td>
                                <td>{{ $author->file_name }}</td>
                                <td>{{ $author->china_name }}</td>
                                <td>{{ $author->nationality }}</td>
                                <td>{{ $author->created_at }}</td>
                                <td>{{ $author->updated_at }}</td>
                                <td>
                                    <a href="/admin/author/edit/{{ $author->id }}" class="btn btn-info btn-sm">编辑</a>
                                    <a href="/admin/author/destroy/{{ $author->id }}" class="btn btn-warning btn-sm">删除</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $('#pageNum').change(function () {
            var num = $(this).val();
            $('#redirectA').attr('href', '/admin/author?page=' + num);
        });
    </script>
@stop