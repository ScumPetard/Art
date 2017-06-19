@extends('admin.layouts.app')

@section('title','作品')

@section('css')
    <style>
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
                    <h3 class="box-title">作品</h3>
                    <a href="/admin/work/create" class="btn btn-success pull-right">添加单个作品</a>
                    {{--<a href="/admin/work/batchcreate" class="btn btn-info pull-right"--}}
                    {{--style="margin-right: 20px;">批量添加作品</a>--}}
                    <a href="javascript:void(0);" onclick="selectall();" class="btn btn-default" style="margin-left: 25px;">全选/反选</a>
                    <a href="javascript:void(0);" onclick="tijiao();" class="btn btn-default" style="margin-left: 25px;">删除所选</a>
                </div>
                <div class="box-body">
                    <form name="sbform" action="/admin/work/delete" method="post" id="deleteForm">

                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>略缩图</th>
                            <th>文件名称</th>
                            <th>状态</th>
                            <th>作品类型</th>
                            <th>作品时期</th>
                            <th>添加时间</th>
                            <th>最后修改时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($works as $work)
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="workid[]" value="{{ $work->id }}">
                                            {{ $work->id }}
                                        </label>
                                    </div>
                                </td>
                                <td><img src="{{ $work->small_image }}" class="img-thumbnail"></td>
                                <td>{{ $work->file_name }}</td>
                                <td>
                                    <span class="label label-{{ $work->is_complete == 0 ? 'danger' : 'info' }}">{{ $work->is_complete == 0 ? '未完成' : '已完成' }}</span>
                                </td>
                                <td>{{ $work->worktype->name or '' }}</td>
                                <td>
                                    @if(!is_null($work->workdate()))
                                        @foreach($work->workdate() as $workdate)
                                            {{ $workdate->name }}
                                        @endforeach
                                    @endif
                                </td>
                                <td>{{ $work->created_at }}</td>
                                <td>{{ $work->updated_at }}</td>
                                <td>
                                    <a href="/admin/work/edit/{{ $work->id }}" class="btn btn-info btn-sm">编辑</a>
                                    <a href="/admin/work/destroy/{{ $work->id }}" class="btn btn-warning btn-sm">删除</a>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    </form>
                </div>

            </div>
        </div>

    </div>
@stop


@section('js')
    <script>
        $('#pageNum').change(function () {
            var num = $(this).val();
            $('#redirectA').attr('href', '/admin/work?page=' + num);
        });
        function selectall() {
            $('.checkbox>label').click();
        }
        function tijiao() {

            $('form[name=sbform]').submit();

        }
    </script>
@stop