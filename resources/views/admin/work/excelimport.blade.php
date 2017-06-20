@extends('admin.layouts.app')

@section('title','导入作品信息')

@section('css')
    <style>
        .box {border-top: 3px solid #00c0ef !important;}
        .box-success {box-shadow: 0px 0px 10px -2px rgba(10, 10, 10, 1);}
        .preview-image {width: 100%;height: 12rem;}
        .box-footer {text-align: center;}
    </style>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12 ">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Excel 导入作品信息</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="" role="form" method="post" enctype="multipart/form-data">
                            <div class="form-group text-center">
                                <div class="col-md-2">
                                    <label>请选择Excel</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="file" class="form-control" name="excel">
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <div class="col-md-6"  style="margin-top: 40px;">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-success"><i class="fa fa-upload"></i> 上传Excel</button>
                                </div>
                                <div class="col-md-6"  style="margin-top: 40px;">
                                    <a  download="Excel模板.xls" href="/Excel模板.xls" class="btn btn-danger"><i class="fa fa-download" aria-hidden="true"></i> 下载Excel模板</a>
                                </div>
                            </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
