@extends('admin.layouts.app')

@section('title','访问统计')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="row">
                        <div class="col-md-2">
                            <h3 class="box-title">访问统计</h3>
                            <button class="btn btn-info pull-right"
                                    onClick="$('#ExcelTab').tableExport({ type: 'excel', escape: 'false' })">导出
                            </button>
                        </div>
                    </div>

                </div>
                <div class="box-body">
                    <table class="table table-bordered table-hover table-striped" id="ExcelTab">
                        <thead>
                        <tr>
                            <th>日期</th>
                            <th>首页</th>
                            <th>中国国画</th>
                            <th>中国书法</th>
                            <th>唐卡壁画</th>
                            <th>日本版画</th>
                            <th>印章印谱</th>
                            <th>碑帖古籍</th>
                            <th>汇总</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>汇总</td>
                            <td>{{ $data['首页'] }}</td>
                            <td>{{ $data['中国国画'] }}</td>
                            <td>{{ $data['中国书法'] }}</td>
                            <td>{{ $data['唐卡壁画'] }}</td>
                            <td>{{ $data['日本版画'] }}</td>
                            <td>{{ $data['印章印谱'] }}</td>
                            <td>{{ $data['碑帖古籍'] }}</td>
                            <td>{{ $data['total'] }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="/FileSaver.min.js"></script>
    <script src="/tableexport.js"></script>
    <link rel="stylesheet" href="//cdn.bootcss.com/flatpickr/2.4.4/flatpickr.min.css">
    <script src="//cdn.bootcss.com/flatpickr/2.4.4/flatpickr.min.js"></script>
    <script>
        $(".timepicker").flatpickr({enableTime: true});
    </script>
@stop