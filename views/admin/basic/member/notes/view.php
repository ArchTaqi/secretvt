<?php $this->managelayout->add_css(element('view_skin_url', $layout) . '/css/style.css'); ?>

<div class="box">
    
      
        
        <div class="box-table">
            <div class="form-horizontal">
                <div class="form-group">
                    <label class="col-sm-2 control-label">제목</label>
                    <div class="col-sm-10 form-inline">
                        <div class="form-control" style="border:0px;"><?php echo html_escape(element('nte_title', element('data', $view))); ?></div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">보낸 사람</label>
                    <div class="col-sm-10">
                        <div class="form-control" style="border:0px;"><?php echo (element('display_name', element('data', $view))); ?></div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">보낸 날짜</label>
                    <div class="col-sm-10">
                        <div class="form-control" style="border:0px;"><?php echo (element('nte_datetime', element('data', $view))); ?></div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">읽은 시간</label>
                    <div class="col-sm-10">
                        <div class="form-control" style="border:0px;"><td><?php echo element('nte_read_datetime', element('data', $view)) > '0000-00-00 00:00:00' ? display_datetime(element('nte_read_datetime', element('data', $view)), 'full') : '<span style="color:#a94442;">아직 읽지 않음</span>'; ?></td></div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">내용</label>
                    <div class="col-sm-10">
                        <div class="form-control" style="border:0px;"><?php echo (element('content', element('data', $view))); ?></div>
                    </div>
                </div>
                
            </div>
        </div>
        
    
</div>


<div class="modal-body">
    <div class="pull-right" aria-label="...">
        <button type="button" class="btn btn-success " onClick="history.back();">이전페이지</button>
        <button class="btn btn-danger  btn-one-delete" data-one-delete-url = "<?php echo element('delete_url',  $view); ?>">삭제</button>
        
    </div>
</div>
