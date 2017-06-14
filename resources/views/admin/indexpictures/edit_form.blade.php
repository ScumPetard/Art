<div class="modal fade" id="{{ $_formId }}">
    <div class="modal-dialog martop10">
        <form role="form" action="/admin/indexpictures/edit/{{ $indexpictures->id }}" method="post" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">编辑首页信息</h4>
                </div>
                <div class="modal-body">
                    <div class="box-body">
                        <div class="form-group">
                            <label >文件名称</label>
                            <input type="text" name="title" class="form-control" value="{{ $indexpictures->title }}" required>
                        </div>
                        <div class="form-group">
                            <label >介绍文字</label>
                            <textarea name="intro"  cols="30" rows="3" class="form-control" required>{{ $indexpictures->intro }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>图片文件</label>
                            <input type="file" name="cover" class="form-control" >
                            <p class="help-block">如不想更换图片请不要上传文件</p>
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