<div class="modal fade" id="{{ $_formId }}">
    <div class="modal-dialog martop10">
        <form role="form" action="{{ route('admin.client.create') }}" method="post" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">添加机构客户</h4>
                </div>
                <div class="modal-body">
                    <div class="box-body">
                        <div class="form-group">
                            <label>名称</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>账号</label>
                            <input type="text" name="account" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>密码</label>
                            <input type="text" name="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>省份</label>
                            <select name="province" class="form-control" id="_create_province">
                            </select>
                        </div>
                        <div class="form-group">
                            <label>类型</label>
                            <select name="type" class="form-control">
                                <option value="本科">本科</option>
                                <option value="高职高专">高职高专</option>
                                <option value="公图">公图</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>版本</label>
                            <select name="version" class="form-control">
                                <option value="正版">正版</option>
                                <option value="试用">试用</option>
                                <option value="赠送">赠送</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>开始时间</label>
                            <input type="date" name="start_ip" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>结束时间</label>
                            <input type="date" name="end_ip" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>账号单日下载量</label>
                            <input type="text" name="downloads" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Logo ( 图片大小 160x90 )</label>
                            <input type="file" name="logo" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>IP范围</label>
                            <textarea name="ips" class="form-control" cols="30" rows="6"></textarea>
                        </div>
                        <div class="form-group">
                            <label style="display: block">前台权限</label>
                            @foreach($modules as $module)
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="module[]" value="{{ $module->id }}">
                                        {{ $module->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <div class="form-group">
                            <div class="radio radio-inline">
                                <label>
                                    <input type="radio" name="buy" value="1">
                                    开启购画车权限
                                </label>
                            </div>
                            <div class="radio radio-inline" style="margin-top: 8px">
                                <label>
                                    <input type="radio" name="buy" value="0" checked>
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


