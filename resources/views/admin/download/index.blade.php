@extends('admin.layouts.app')

@section('title','购画记录')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">购画记录</h3>
                </div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>购买机构</th>
                            <th>Excel</th>
                            <th>购买时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($downloads as $download)
                            <tr>
                                <td>{{ $download->id }}</td>
                                <td>{{ $download->client->name }}</td>
                                <td> <a href="{{ $download->file_path }}"
                                        class="btn btn-success btn-sm" download="购买记录.xls">点击下载</a></td>
                                <td>{{ $download->created_at }}</td>
                                <td>
                                    <a href="/admin/download/destroy/{{ $download->id }}"
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
@stop

