@extends('admin.layouts.app')

@section('title','作品类型')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">作品类型</h3>
                    <a href="javascript:;" class="btn btn-info pull-right" data-toggle="modal" data-target="#_create">添加作品类型</a>
                </div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-hover ">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>名称</th>
                            <th>添加时间</th>
                            <th>最后修改时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($worktypes as $worktype)
                            <tr>
                                <td>{{ $worktype->id }}</td>
                                <td><span class="label label-info">{{ $worktype->name }}</span></td>
                                <td>{{ $worktype->created_at }}</td>
                                <td>{{ $worktype->updated_at }}</td>
                                <td>
                                    <a href="javascript:;" data-toggle="modal" data-target="#_edit{{ $worktype->id }}" class="btn btn-info btn-sm">编辑</a>
                                    <a href="/admin/worktype/destroy/{{ $worktype->id }}" class="btn btn-warning btn-sm">删除</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('admin.worktype.create_form',['_formId' => '_create'])

    @foreach($worktypes as $worktype)
        @include('admin.worktype.edit_form',['_formId' => '_edit'.$worktype->id, 'worktype' => $worktype])
    @endforeach
@stop