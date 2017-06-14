<div class="modal fade" id="{{ $_formId }}">
    <div class="modal-dialog martop10">
        <form role="form" action="/admin/banner/create/{{ $category->id }}" method="post" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">添加轮播图</h4>
                </div>
                <div class="modal-body">
                    <div class="box-body">
                        <div class="form-group">
                            <label >文件名称</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label >介绍文字</label>
                            <textarea name="intro"  cols="30" rows="3" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>排序</label>
                            <input type="text" name="sort" class="form-control" value="0" required>
                        </div>
                        <div class="form-group">
                            <label>链接地址</label>
                            <input type="text" name="link" class="form-control" value="http://" required>
                        </div>
                        <div class="form-group">
                            <label>图片文件 ( 图片大小 1920x1200 )</label>
                            <input type="file" name="url" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <div class="radio radio-inline">
                                <label>
                                    <input type="radio" name="is_hidden"  value="0" checked>
                                    启用
                                </label>
                            </div>
                            <div class="radio radio-inline" style="margin-top: 8px">
                                <label>
                                    <input type="radio" name="is_hidden"  value="1">
                                    禁用
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