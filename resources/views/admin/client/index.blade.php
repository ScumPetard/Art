@extends('admin.layouts.app')

@section('title','机构客户设置')

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
                    <h3 class="box-title">机构客户设置</h3>
                    <a href="javascript:;" class="btn btn-info pull-right" data-toggle="modal" data-target="#_create">添加机构客户设置</a>
                </div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Logo</th>
                            <th>客户名称</th>
                            <th>账号</th>
                            <th>类型</th>
                            <th>版本</th>
                            <th>省份</th>
                            <th>开始时间</th>
                            <th>结束时间</th>
                            <th>是否开启购画车</th>
                            <th>添加时间</th>
                            <th>最后修改时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($clients as $client)
                            <tr>
                                <td>{{ $client->id }}</td>
                                <td><img src="{{ $client->logo }}" class="img-circle"></td>
                                <td>{{ $client->name }}</td>
                                <td>{{ $client->account }}</td>
                                <td>{{ $client->type }}</td>
                                <td>{{ $client->version }}</td>
                                <td>{{ $client->province }}</td>
                                <td>{{ $client->start_ip }}</td>
                                <td>{{ $client->end_ip }}</td>
                                <td><span class="label label-info">{{ $client->buy == 1 ? '是' : '否' }}</span></td>
                                <td>{{ $client->created_at }}</td>
                                <td>{{ $client->updated_at }}</td>
                                <td>
                                    <a href="javascript:;" data-toggle="modal" data-target="#_edit{{ $client->id }}"
                                       class="btn btn-info btn-sm">编辑</a>
                                    <a href="/admin/client/destroy/{{ $client->id }}"
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
    @include('admin.client.create_form',['_formId' => '_create'])
    @foreach($clients as $client)
        @include('admin.client.edit_form',['_formId' => '_edit'.$client->id,'client' => $client])
    @endforeach
@stop

@section('js')
    <script>
        window.onload = function () {
            var address = ['北京', '天津', '河北', '山西', '内蒙古', '辽宁', '吉林', '黑龙江', '上海', '江苏', '浙江省', '安徽', '福建', '江西', '山东', '河南', '湖北', '湖南', '广东', '广西', '海南', '重庆', '四川', '贵州', '云南', '西藏', '陕西', '甘肃省', '青海', '宁夏', '新疆', '台湾', '香港特别行政区', '澳门'];
            $(address).each(function (key, value) {
                var str = '<option value="' + value + '">' + value + '</option>';
                $('#_create_province').append(str);
            });
            $('._edit_province').each(function () {
                var obj = $(this);
                var ft = $(this).attr('default');
                $(address).each(function (key, value) {
                    if (value == ft) {
                        var str = '<option value="' + value + '" selected>' + value + '</option>';
                    } else {
                        var str = '<option value="' + value + '">' + value + '</option>';
                    }
                    obj.append(str);
                });
            });
        }
    </script>
@stop