@extends('admin.layouts.app')

@section('title','作品分类/时期')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">作品分类/时期</h3>
                    <a href="javascript:;" class="btn btn-info pull-right" data-toggle="modal" data-target="#_create">添加作品分类/时期</a>
                </div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-hover ">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>名称</th>
                            <th>所属类型</th>
                            <th>添加时间</th>
                            <th>最后修改时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($workdates as $workdate)
                            <tr>
                                <td>{{ $workdate->id }}</td>
                                <td><span class="label label-info">{{ $workdate->name }}</span></td>
                                <td><span class="label label-warning">{{ $workdate->worktype->name }}</span></td>
                                <td>{{ $workdate->created_at }}</td>
                                <td>{{ $workdate->updated_at }}</td>
                                <td>
                                    <a href="/admin/work/batchcreate/{{ $workdate->id }}" class="btn btn-success btn-sm">批量添加作品</a>
                                    <a href="javascript:;" data-toggle="modal" data-target="#_edit{{ $workdate->id }}" class="btn btn-info btn-sm">编辑</a>
                                    <a href="/admin/workdate/destroy/{{ $workdate->id }}" class="btn btn-warning btn-sm">删除</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('admin.workdate.create_form',['_formId' => '_create'])

    @foreach($workdates as $workdate)
        @include('admin.workdate.edit_form',['_formId' => '_edit'.$workdate->id, 'workdate' => $workdate])
    @endforeach
@stop