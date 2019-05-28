<div class="box">
    <div class="box-table">
        <?php
        echo show_alert_message($this->session->flashdata('message'), '<div class="alert alert-auto-close alert-dismissible alert-info"><button type="button" class="close alertclose" >&times;</button>', '</div>');
        
        ?>
            <div class="box-table-header">
            <?php
            ob_start();
            ?>
                <div class="btn-group pull-right" role="group" aria-label="...">
                    <a href="<?php echo element('listall_url', $view); ?>" class="btn btn-outline btn-default btn-sm">전체목록</a>
                </div>
            <?php
            $buttons = ob_get_contents();
            ob_end_flush();
            ?>
            </div>
            <div class="row">전체 : <?php echo element('total_rows', element('data', $view), 0); ?>건</div>
            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>보낸사람</th>
                            <th>제목</th>
                            <th>받는사람</th>
                            <th>보낸시간</th>
                            <th>읽은시간</th>
                            <th>관리</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (element('list', element('data', $view))) {
                        foreach (element('list', element('data', $view)) as $result) {
                    ?>
                        <tr>
                        <td><?php echo element('display_name', $result); ?></td>
                        <td><a href="<?php echo admin_url($this->pagedir.'/view/' . element('nte_id', $result)); ?>"><?php echo html_escape(element('nte_title', $result)); ?></a></td>
                        <td><?php echo element('target_display_name', $result); ?></td>
                        <td><?php echo display_datetime(element('nte_datetime', $result), 'full'); ?></td>
                        <td><?php echo element('nte_read_datetime', $result) > '0000-00-00 00:00:00' ? display_datetime(element('nte_read_datetime', $result), 'full') : '<span style="color:#a94442;">아직 읽지 않음</span>'; ?></td>
                        <td><button class="btn-link btn-one-delete" data-one-delete-url = "<?php echo element('delete_url', $result); ?>">삭제</button></td>
                    </tr>
                    <?php
                        }
                    }
                    if ( ! element('list', element('data', $view))) {
                    ?>
                        <tr>
                            <td colspan="6" class="nopost">자료가 없습니다</td>
                        </tr>
                    <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <div class="box-info">
                <?php echo element('paging', $view); ?>
                <div class="pull-left ml20"><?php echo admin_listnum_selectbox();?></div>
                <?php echo $buttons; ?>
            </div>
        
    </div>
    <form name="fsearch" id="fsearch" action="<?php echo current_full_url(); ?>" method="get">
        <div class="box-search">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <select class="form-control" name="sfield" >
                        <?php echo element('search_option', $view); ?>
                    </select>
                    <div class="input-group">
                        <input type="text" class="form-control" name="skeyword" value="<?php echo html_escape(element('skeyword', $view)); ?>" placeholder="Search for..." />
                        <span class="input-group-btn">
                            <button class="btn btn-default btn-sm" name="search_submit" type="submit">검색!</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
