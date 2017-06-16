<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="shortcut icon" href="/favicon.ico"/>
    <link rel="stylesheet" href="/system/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/ionicons/2.0.1/css/ionicons.css">
    <link rel="stylesheet" href="/system/plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="/system/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="/system/dist/css/skins/_all-skins.min.css">
    <style>
        * {
            font-family: "Lucida Grande", Lucida Sans Unicode, Hiragino Sans GB, WenQuanYi Micro Hei, Verdana, Aril, sans-serif;
        }

        body {
            height: auto;
        }

        .box {
            border-top: 0;
        }

        th {
            text-align: center;
        }

        tr {
            text-align: center;
        }

        td {
            text-align: center;
            max-width: 20rem;
            overflow: hidden;
            text-overflow: ellipsis;
            overflow: hidden;
            white-space: nowrap;
        }

        .table > tbody > tr > td {
            line-height: 30px;
        }

        .table > tbody > tr > td > .label {
            font-size: 1.4rem;
            font-weight: 300;
        }

        .mrenm {
            margin-right: 1rem;
        }

        .img-thumbnail {
            width: 120px;
            height: 60px;
        }

        .lh60 td {
            line-height: 60px !important;
        }

        .martop10 {
            margin-top: 5%;
        }

        .checkbox {
            width: 49%;
            display: inline-block;
        }
    </style>
    @yield('css')
</head>
<body class="sidebar-mini wysihtml5-supported fixed skin-black-light">
<div class="wrapper">
    <header class="main-header">
        <a href="/admin/index" class="logo">
            <span class="logo-mini"><b>L</b>ara</span>
            <span class="logo-lg"><b>Lara</b>dmin</span>
        </a>
        <nav class="navbar navbar-static-top">
            <a href="javascript:;" class="sidebar-toggle" data-toggle="offcanvas" role="button"></a>
        </nav>
    </header>
    @include('admin.layouts.nav')
    <div class="content-wrapper">
        <section class="content">
            @include('admin.layouts.notify')
            @yield('content')
        </section>
    </div>
    <div class="control-sidebar-bg"></div>
</div>
</body>
<script src="/system/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="https://cdn.bootcss.com/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script src="/system/bootstrap/js/bootstrap.min.js"></script>
<script src="/system/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/system/plugins/datatables/dataTables.bootstrap.js"></script>
<script src="/system/dist/js/app.min.js"></script>
<script>
    $('.treeview-menu li a').each(function () {
        if ($(this).attr('href') == window.location.pathname) {
            $(this).parent().addClass('active');
            $(this).parent().parent().parent().addClass('active');
        }
    });
    $('#example1').DataTable({
        language: {
            "sProcessing": "处理中...",
            "sLengthMenu": "显示 _MENU_ 项结果",
            "sZeroRecords": "没有匹配结果",
            "sInfo": "显示第 _START_ 至 _END_ 项结果，共 _TOTAL_ 项",
            "sInfoEmpty": "显示第 0 至 0 项结果，共 0 项",
            "sInfoFiltered": "(由 _MAX_ 项结果过滤)",
            "sInfoPostFix": "",
            "sSearch": "搜索:",
            "sUrl": "",
            "sEmptyTable": "表中数据为空",
            "sLoadingRecords": "载入中...",
            "sInfoThousands": ",",
            "oPaginate": {"sFirst": "首页", "sPrevious": "上页", "sNext": "下页", "sLast": "末页"},
            "oAria": {"sSortAscending": ": 以升序排列此列", "sSortDescending": ": 以降序排列此列"}
        },
        "fnDrawCallback": function(table) {

            $("#example1_paginate").append("<input type='text' id='changePage' class='input-text form-control' style='width:50px;height:27px;margin-top: -30px;margin-left: 15px;'>");
            var oTable = $("#example1").dataTable();
            $('#changePage').change(function(e){
                if($(this).val() && $(this).val()>0){
                    var redirectpage = $(this).val()-1;
                }else{
                    var redirectpage = 0;
                }
                oTable.fnPageChange( redirectpage );

            });

        }
    });

</script>
@yield('js')
</html>
