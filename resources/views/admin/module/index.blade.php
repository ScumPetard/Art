@extends('admin.layouts.app')

@section('title','模块设置')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">模块设置</h3>
                    <a href="javascript:;" class="btn btn-info pull-right" data-toggle="modal" data-target="#_create">添加模块</a>
                </div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
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
                        @foreach($modules as $module)
                            <tr>
                                <td>{{ $module->id }}</td>
                                <td>{{ $module->name }}</td>
                                <td>{{ $module->created_at }}</td>
                                <td>{{ $module->updated_at }}</td>
                                <td>
                                    <a href="javascript:;" data-toggle="modal" data-target="#_edit{{ $module->id }}" class="btn btn-info btn-sm">编辑</a>
                                    <a href="/admin/module/destroy/{{ $module->id }}" class="btn btn-warning btn-sm">删除</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>

        </div>

    </div>

    @include('admin.module.create_form',['_formId' => '_create'])
    @foreach($modules as $module)
        @include('admin.module.edit_form',['_formId' => '_edit'.$module->id, 'module' => $module])
    @endforeach
@stop