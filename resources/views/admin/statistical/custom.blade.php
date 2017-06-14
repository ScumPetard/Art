@extends('admin.layouts.app')

@section('title','自定义访问量')

@section('content')
    <div class="row">
        <div class="col-md-8 col-lg-offset-2">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">自定义访问量</h3>
                </div>
                <form role="form" action="{{ route('admin.statistical.custom') }}" method="post"
                      enctype="multipart/form-data">
                    <div class="box-body">
                        @foreach($modules as $module)
                            <div class="form-group">
                                <label>{{ $module->name }}</label>
                                <input type="text" class="form-control" name="{{ $module->id }}" maxlength="15" value="">
                            </div>
                        @endforeach
                    </div>
                    <div class="box-footer">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-info">提交</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
