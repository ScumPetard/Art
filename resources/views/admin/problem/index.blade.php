@extends('admin.layouts.app')
@section('title','问题反馈')
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">问题反馈</h3>
                </div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-hover table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>标题</th>
                            <th>内容</th>
                            <th>提交时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($problems as $problem)
                            <tr>
                                <td>{{ $problem->id }}</td>
                                <td>{{ $problem->title }}</td>
                                <td>{{ $problem->body }}</td>
                                <td>{{ $problem->created_at }}</td>
                                <td>
                                    <a href="javascript:;" data-toggle="modal" data-target="#_edit{{ $problem->id }}" class="btn btn-info btn-sm">查看</a>
                                    <a href="/admin/problem/destroy/{{ $problem->id }}" class="btn btn-warning btn-sm">删除</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @foreach($problems as $problem)
        @include('admin.problem.edit_cat_form',['_formId' => '_edit'.$problem->id, 'problem' => $problem])
    @endforeach
@stop