<div class="modal fade" id="{{ $_formId }}">
    <div class="modal-dialog martop10">
        <form role="form" action="/admin/client/edit/{{ $client->id }}" method="post" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">编辑机构客户</h4>
                </div>
                <div class="modal-body">
                    <div class="box-body">
                        <div class="form-group">
                            <label>名称</label>
                            <input type="text" name="name" class="form-control" value="{{ $client->name }}" required>
                        </div>
                        <div class="form-group">
                            <label>账号</label>
                            <input type="text" name="account" class="form-control" value="{{ $client->account }}"
                                   required>
                        </div>
                        <div class="form-group">
                            <label>密码</label>
                            <input type="text" name="password" class="form-control">
                            <p class="help-block">如不想更改密码请不要填写此项</p>
                        </div>
                        <div class="form-group">
                            <label>省份</label>
                            <select name="province" class="form-control _edit_province"
                                    default="{{ $client->province }}">
                            </select>
                        </div>
                        <div class="form-group">
                            <label>类型</label>
                            <select name="type" class="form-control">
                                <option {{ $client->type == '本科' ? 'selected' : '' }} value="本科">本科</option>
                                <option {{ $client->type == '高职高专' ? 'selected' : '' }} value="高职高专">高职高专</option>
                                <option {{ $client->type == '公图' ? 'selected' : '' }} value="公图">公图</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>版本</label>
                            <select name="version" class="form-control">
                                <option value="正版" {{ $client->version == '正版' ? 'selected' : ''}}>正版</option>
                                <option value="试用" {{ $client->version == '试用' ? 'selected' : ''}}>试用</option>
                                <option value="赠送" {{ $client->version == '赠送' ? 'selected' : ''}}>赠送</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>开始时间</label>
                            <input type="date" name="start_ip" value="{{ $client->start_ip }}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>结束时间</label>
                            <input type="date" name="end_ip" value="{{ $client->end_ip }}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>账号单日下载量</label>
                            <input type="text" name="downloads" class="form-control" value="{{ $client->downloads }}"
                                   required>
                        </div>
                        <div class="form-group">
                            <label>Logo ( 图片大小 160x90 )</label>
                            <input type="file" name="logo" class="form-control">
                            <p class="help-block">如不想更改Logo请不要上传文件</p>
                        </div>
                        <div class="form-group">
                            <label>IP范围</label>
                            <textarea name="ips" class="form-control" cols="30" rows="6">@foreach($client->getAllIp() as $value){!! $value->ip."\r\n" !!}@endforeach</textarea>
                        </div>
                        <div class="form-group">
                            <label style="display: block">前台权限</label>
                            @foreach($modules as $module)
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="module[]" value="{{ $module->id }}" {{ $client->canModule($module->id) ? 'checked' : '' }}>
                                        {{ $module->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <div class="form-group">
                            <div class="radio radio-inline">
                                <label>
                                    <input type="radio" name="buy" value="1" {{ $client->buy == 1 ? 'checked' : '' }}>
                                    开启购画车权限
                                </label>
                            </div>
                            <div class="radio radio-inline" style="margin-top: 8px">
                                <label>
                                    <input type="radio" name="buy" value="0" {{ $client->buy == 0 ? 'checked' : '' }}>
                                    关闭购画车权限
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    {{ csrf_field() }}
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">取消</button>
                    <button type="submit" class="btn btn-info">提交</button>
                </div>
            </div>
        </form>
    </div>
</div>


