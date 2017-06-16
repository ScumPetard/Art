@extends('admin.layouts.app')

@section('title','批量添加作品')

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
                    <h3 class="box-title">批量添加作品 ( 图片大小 874x640 )</h3>
                </div>
                <div class="box-body">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="form-group text-center">
                            <a id="picker"><i class="fa fa-upload" aria-hidden="true"></i> 上传文件</a>
                        </div>
                    </div>
                    <div class="col-md-12 ">
                        <div class="row" id="file-upload-content">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')

    {{--fileUpload Package --}}

    <link rel="stylesheet" href="/system/plugins/webupload/webuploader.css">
    <script src="/system/plugins/webupload/webuploader.js"></script>
    <script>

        // 初始化fileUpload
        var uploader = WebUploader.create({
            auto: true,
            swf: '/system/plugins/webupload/Uploader.swf',
            server: window.location.href,
            pick: '#picker',
            compress:false,
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/*'
            }
        });

        //选择文件后预览
        uploader.on('fileQueued', function (file) {
            var $div = $('<div class="col-md-3"  id="' + file.id + '"> ' +
                '<div class="box box-success"> ' +
                '<div class="box-header with-border text-center"> ' +
                '<h3 class="box-title ">' + file.name + '</h3> ' +
                '</div> <div class="box-body"> ' +
                '<img class="preview-image"> ' +
                '</div>' +
                '<div class="box-footer"> ' +
                '<div class="progress progress-sm active">' +
                '<div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width:0%">' +
                '<span class="sr-only">20% Complete</span>' +
                '</div>' +
                '</div>' +
                '</div> ' +
                '</div> ' +
                '</div>');
            var $img = $div.find('.preview-image');
            $('#file-upload-content').append($div);
            uploader.makeThumb(file, function (error, src) {
                if (error) {
                    $img.replaceWith('<span>不能预览</span>');
                    return;
                }
                $img.attr('src', src);
            });
        });

        // 进度条
        uploader.on('uploadProgress', function (file, percentage) {
            var $li = $('#' + file.id);
            $percent = $li.find('.progress-bar-success');
            $percent.css('width', percentage * 100 + '%');
        });

        // 文件上传成功，给item添加成功class, 用样式标记上传成功。
        uploader.on('uploadSuccess', function (file) {
            $('#' + file.id).find('.box-footer').append('<p class="text-green"><i class="fa fa-check" aria-hidden="true"></i> 上传成功</p>');
        });

        // 文件上传失败，显示上传出错。
        uploader.on('uploadError', function (file) {
            $('#' + file.id).find('.box-footer').append('<p class="text-red"><i class="fa fa-times" aria-hidden="true"></i> 上传失败</p>');
        });

        // 完成上传完了，成功或者失败，先删除进度条。
        uploader.on('uploadComplete', function (file) {
            $('#' + file.id).find('.progress').remove();
        });

    </script>
    {{--fileUpload end--}}

@stop
