@extends('admin.layouts.app')

@section('title','个人用户设置')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">个人用户设置</h3>
                </div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>账号</th>
                            <th>Email</th>
                            <th>所属机构</th>
                            <th>添加时间</th>
                            <th>最后修改时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($members as $member)
                            <tr>
                                <td>{{ $member->id }}</td>
                                <td>{{ $member->account }}</td>
                                <td>{{ $member->email }}</td>
                                <td>{{ $member->client->name }}</td>
                                <td>{{ $member->created_at }}</td>
                                <td>{{ $member->updated_at }}</td>
                                <td>
                                    <a href="javascript:;" data-toggle="modal" data-target="#_edit{{ $member->id }}" class="btn btn-info btn-sm">编辑</a>
                                    <a href="/admin/member/destroy/{{ $member->id }}" class="btn btn-warning btn-sm">删除</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>

        </div>

    </div>
    {{--@include('admin.member.create_form',['_formId' => '_create'])--}}
    @foreach($members as $member)
        @include('admin.member.edit_form',['_formId' => '_edit'.$member->id, 'member' => $member])
    @endforeach
@stop