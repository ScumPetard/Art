@extends('admin.layouts.app')

@section('title','轮播图')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">轮播图</h3>
                    <a href="javascript:;" class="btn btn-info pull-right" data-toggle="modal" data-target="#_create">添加栏目</a>
                </div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-hover table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>名称</th>
                            <th>介绍文字</th>
                            <th>添加时间</th>
                            <th>最后修改时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categorys as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td><span class="label label-info">{{ $category->name }}</span></td>
                                <td>{{ $category->intro }}</td>
                                <td>{{ $category->created_at }}</td>
                                <td>{{ $category->updated_at }}</td>
                                <td>
                                    <a href="/admin/banner/show/{{ $category->id }}"
                                       class="btn btn-success btn-sm">下级内容</a>
                                    <a href="javascript:;" data-toggle="modal" data-target="#_edit{{ $category->id }}" class="btn btn-info btn-sm">编辑</a>
                                    <a href="/admin/banner/destroycat/{{ $category->id }}"
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

    @include('admin.banner.create_cat_form',['_formId' => '_create'])

    @foreach($categorys as $category)
        @include('admin.banner.edit_cat_form',['_formId' => '_edit'.$category->id, 'category' => $category])
    @endforeach
@stop