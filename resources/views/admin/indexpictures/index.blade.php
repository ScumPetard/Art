@extends('admin.layouts.app')

@section('title','首页信息')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">首页信息设置</h3>
                    <a href="javascript:;" data-toggle="modal" data-target="#_create" class="btn btn-info pull-right mrenm">添加首页信息</a>
                </div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-hover table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>略缩图</th>
                            <th>名称</th>
                            <th>介绍文字</th>
                            <th>添加时间</th>
                            <th>最后修改时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($indexpicturess as $indexpictures)
                            <tr class="lh60">
                                <td>{{ $indexpictures->id }}</td>
                                <td><img src="{{ $indexpictures->cover }}" class="img-thumbnail"></td>
                                <td>{{ $indexpictures->title }}</td>
                                <td>{{ $indexpictures->intro }}</td>
                                <td>{{ $indexpictures->created_at }}</td>
                                <td>{{ $indexpictures->updated_at }}</td>
                                <td>
                                    <a href="javascript:;" data-toggle="modal" data-target="#_edit{{ $indexpictures->id }}" class="btn btn-info btn-sm">编辑</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>

        </div>

    </div>

    @include('admin.indexpictures.create_form',['_formId' => '_create'])

    @foreach($indexpicturess as $indexpictures)
        @include('admin.indexpictures.edit_form',['_formId' => '_edit'.$indexpictures->id, 'indexpictures' => $indexpictures])
    @endforeach

@stop