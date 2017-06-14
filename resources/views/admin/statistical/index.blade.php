@extends('admin.layouts.app')

@section('title','访问统计')

@section('content')
    {{--<div class="row">--}}
    {{--<div class="col-md-6 col-md-offset-3">--}}
    {{--<div class="box box-primary">--}}
    {{--<div class="box-header with-border">--}}
    {{--<i class="fa fa-bar-chart-o"></i>--}}
    {{--<h3 class="box-title">浏览统计</h3>--}}
    {{--<div class="box-tools pull-right">--}}
    {{--<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>--}}
    {{--</button>--}}
    {{--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="box-body">--}}
    {{--<div id="donut-chart" style="height: 300px;"></div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
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
                        <div class="col-md-10">
                            <form action="{{ route('admin.statistical.seach') }}" method="post">
                                <div class="form-group pull-right">
                                    <select name="client_id" class="form-control"
                                            style="display: inline-block;width: 25%;">
                                        @foreach($clients as $client)
                                            <option value="{{ $client->id }}">{{ $client->name }}</option>
                                        @endforeach
                                    </select>
                                    <input name="start" type="text" class="form-control timepicker"
                                           style="display: inline-block;width: 29%;" placeholder="请选择起始时间">
                                    <input name="end" type="text" class="form-control timepicker"
                                           style="display: inline-block;width: 29%;" placeholder="请选择结束时间">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-info pull-right" style="margin-left: 35px;">
                                        查询
                                    </button>
                                </div>
                            </form>
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
                        @foreach($click_groups as $key => $item)
                            <tr>
                                <td>{{ $key }}月</td>
                                <td>{{ $item['首页'] }}</td>
                                <td>{{ $item['中国国画'] }}</td>
                                <td>{{ $item['中国书法'] }}</td>
                                <td>{{ $item['唐卡壁画'] }}</td>
                                <td>{{ $item['日本版画'] }}</td>
                                <td>{{ $item['印章印谱'] }}</td>
                                <td>{{ $item['碑帖古籍'] }}</td>
                                <td>{{ $item['汇总'] }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td>汇总</td>
                            <td>{{ $huizong['首页'] }}</td>
                            <td>{{ $huizong['中国国画'] }}</td>
                            <td>{{ $huizong['中国书法'] }}</td>
                            <td>{{ $huizong['唐卡壁画'] }}</td>
                            <td>{{ $huizong['日本版画'] }}</td>
                            <td>{{ $huizong['印章印谱'] }}</td>
                            <td>{{ $huizong['碑帖古籍'] }}</td>
                            <td>{{ $huizong['汇总'] }}</td>
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