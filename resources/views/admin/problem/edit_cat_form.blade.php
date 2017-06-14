<div class="modal fade" id="{{ $_formId }}">
    <div class="modal-dialog martop10">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">查看留言</h4>
                </div>
                <div class="modal-body">
                    <div class="box-body">
                        <p>{{ $problem->title }}</p>
                        <div>{{ $problem->body }}</div>
                    </div>
                </div>
            </div>
    </div>
</div>