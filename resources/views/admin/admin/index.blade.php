@extends('admin.layouts.app')

@section('title','管理员')

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
                    <h3 class="box-title">管理员</h3>
                    <a href="javascript:;" class="btn btn-info pull-right" data-toggle="modal" data-target="#_create">添加管理员</a>
                </div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>头像</th>
                            <th>名称</th>
                            <th>账号</th>
                            <th>状态</th>
                            <th>添加时间</th>
                            <th>最后修改时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($admins as $admin)
                            <tr>
                                <td>{{ $admin->id }}</td>
                                <td><img src="{{ $admin->avatar }}" class="img-circle"></td>
                                <td><span class="label label-info">{{ $admin->name }}</span></td>
                                <td>{{ $admin->email }}</td>
                                <td>{{ $admin->isHidden() ? '禁用' : '启用' }}</td>
                                <td>{{ $admin->created_at }}</td>
                                <td>{{ $admin->updated_at }}</td>
                                <td>
                                    <a href="javascript:;" data-toggle="modal" data-target="#_edit{{ $admin->id }}"
                                       class="btn btn-info btn-sm">编辑</a>
                                    <a href="/admin/admin/destroy/{{ $admin->id }}"
                                       class="btn btn-warning btn-sm">删除</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('admin.admin.create_form',['_formId' => '_create'])
    @foreach($admins as $admin)
        @include('admin.admin.edit_form',['_formId' => '_edit'.$admin->id,'admin' => $admin])
    @endforeach
@stop