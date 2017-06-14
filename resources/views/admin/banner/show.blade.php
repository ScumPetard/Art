@extends('admin.layouts.app')

@section('title','轮播图')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{ $category->name }}</h3>
                    <a href="/admin/banner" class="btn btn-success pull-right ">返回上级</a>
                    <a href="javascript:;" data-toggle="modal" data-target="#_create" class="btn btn-info pull-right mrenm">添加轮播图</a>
                </div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-hover table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>略缩图</th>
                            <th>名称</th>
                            <th>介绍文字</th>
                            <th>状态</th>
                            <th>排序</th>
                            <th>链接地址</th>
                            <th>添加时间</th>
                            <th>最后修改时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($banners as $banner)
                            <tr class="lh60">
                                <td>{{ $banner->id }}</td>
                                <td><img src="{{ $banner->url }}" class="img-thumbnail"></td>
                                <td>{{ $banner->name }}</td>
                                <td>{{ $banner->intro }}</td>
                                <td>{{ $banner->isHidden() ? '启用' : '禁用' }}</td>
                                <td>{{ $banner->sort }}</td>
                                <td>{{ $banner->link }}</td>
                                <td>{{ $banner->created_at }}</td>
                                <td>{{ $banner->updated_at }}</td>
                                <td>
                                    <a href="javascript:;" data-toggle="modal" data-target="#_edit{{ $banner->id }}" class="btn btn-info btn-sm">编辑</a>
                                    <a href="/admin/banner/destroy/{{ $banner->id }}" class="btn btn-warning btn-sm">删除</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>

        </div>

    </div>

    @include('admin.banner.create_form',['_formId' => '_create', 'category' => $category])

    @foreach($banners as $banner)
        @include('admin.banner.edit_form',['_formId' => '_edit'.$banner->id, 'banner' => $banner, 'category' => $category])
    @endforeach

@stop