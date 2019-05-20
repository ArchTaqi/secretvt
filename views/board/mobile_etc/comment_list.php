<div class="alert alert-auto-close alert-dismissible alert-comment-list-message" style="display:none;"><button type="button" class="close alertclose">×</button><span class="alert-comment-list-message-content"></span></div>
<?php
if (element('best_list', $view)) {
    foreach (element('best_list', $view) as $result) {
?>
    <div class="media best" id="comment_<?php echo element('cmt_id', $result); ?>">
        <?php if (element('use_comment_profile', element('board', $view))) { ?>
            <div class="media-left">
                <img class="media-object member-photo" src="<?php echo element('member_photo_url', $result); ?>" width="64" height="64" alt="<?php echo html_escape(element('cmt_nickname', $result)); ?>" title="<?php echo html_escape(element('cmt_nickname', $result)); ?>" />
            </div>
        <?php } ?>
        <div class="media-body">
            <?php if (element('is_admin', $view)) { ?><input type="checkbox" name="chk_comment_id[]" value="<?php echo element('cmt_id', $result); ?>" /><?php } ?>
            <div class="nick">
                <?php if(element('cmt_reply', $result)) {?>
                    <i class="fa fa-reply fa-rotate-180" aria-hidden="true" style="font-size: 1.5em;"></i>
                <?php } ?>
                <?php echo element('cmt_secret', $result) ? '<i class="fa fa-lock"></i>':'';  ?>
                <?php if (element('lucky', $result)) { ?><div class="lucky"><i class="fa fa-star"></i> <?php echo element('lucky', $result); ?></div><?php } ?>
                <button class="btn_nick"><?php echo element('display_name', $result); ?></button> <span class="lab_hot">BEST</span>
                <!-- <ul class="click_nick">
                    <li class=""><a href="">쪽지보내기</a></li>
                    <li class=""><a href="" onclick="addfriends('뱅뱅');">친구등록</a></li>
                </ul>  -->
            </div>
            <div class="comment-content">
            
            <?php echo element('content', $result); ?>
             
            </div>
            <div class="media_bottom">
                <span class="date"><?php echo element('display_datetime', $result); ?></span>
                <div class="btn_box pull-right">
                    <?php if (element('use_comment_like', element('board', $view))) { ?>
                        <a class="btn btn-default btn-xs good" href="javascript:;" id="btn-comment-like-<?php echo element('cmt_id', $result); ?>" onClick="comment_like('<?php echo element('cmt_id', $result); ?>', '1', 'comment-like-<?php echo element('cmt_id', $result); ?>');" title="추천하기"><i class="fa fa-thumbs-o-up fa-xs"></i> <span class="comment-like-<?php echo element('cmt_id', $result); ?>"><?php echo number_format(element('cmt_like', $result)); ?></span></a>
                    <?php } ?>
                    <?php if (element('use_comment_dislike', element('board', $view))) { ?>
                        <a class="btn btn-default btn-xs bad" href="javascript:;" id="btn-comment-dislike-<?php echo element('cmt_id', $result); ?>" onClick="comment_like('<?php echo element('cmt_id', $result); ?>', '2', 'comment-dislike-<?php echo element('cmt_id', $result); ?>');" title="비추하기"><i class="fa fa-thumbs-o-down fa-xs"></i>  <span class="comment-dislike-<?php echo element('cmt_id', $result); ?>"><?php echo number_format(element('cmt_dislike', $result)); ?></span></a>
                    <?php } ?>
                    <?php if (element('use_comment_blame', element('board', $view)) && ( ! element('comment_blame_blind_count', element('board', $view)) OR element('cmt_blame', $result) < element('comment_blame_blind_count', element('board', $view)))) { ?>
                        <a href="javascript:;" id="btn-blame" onClick="comment_blame('<?php echo element('cmt_id', $result); ?>', 'comment-blame-<?php echo element('cmt_id', $result); ?>');" title="신고하기"><i class="fa fa-bell fa-xs"></i><span class="comment-blame-<?php echo element('cmt_id', $result); ?>"><?php echo element('cmt_blame', $result) ? '+' . number_format(element('cmt_blame', $result)) : ''; ?></span></a>
                    <?php } ?>

                    <?php if (element('can_reply', $result)) { ?>
                        <a href="javascript:;" class="btn btn-success btn-sm" onClick="comment_box('<?php echo element('cmt_id', $result); ?>', 'c'); return false;">답변</a>
                    <?php } ?>
                    <?php if (element('can_update', $result)) { ?>
                        <a href="javascript:;" class="btn btn-info btn-sm" onClick="comment_box('<?php echo element('cmt_id', $result); ?>', 'cu'); return false;">수정</a>
                    <?php } ?>
                    <?php if (element('can_delete', $result)) { ?>
                        <a href="javascript:;" class="btn btn-silver btn-sm"  onClick="delete_comment('<?php echo element('cmt_id', $result); ?>', '<?php echo element('post_id', $result); ?>', '<?php echo element('page', $view); ?>');">삭제</a>
                    <?php } ?>
                    <?php
                    if (element('is_admin', $view) && element('use_comment_secret', element('board', $view))) {
                        if (element('cmt_secret', $result)) {
                    ?>
                        <a href="javascript:;" onClick="post_action('comment_secret', '<?php echo element('cmt_id', $result); ?>', '0');"><i class="fa fa-lock"></i></a>
                    <?php } else { ?>
                        <a href="javascript:;" onClick="post_action('comment_secret', '<?php echo element('cmt_id', $result); ?>', '1');"><i class="fa fa-unlock"></i></a>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
            
            <span id="edit_<?php echo element('cmt_id', $result); ?>"></span><!-- 수정 -->
            <span id="reply_<?php echo element('cmt_id', $result); ?>"></span><!-- 답변 -->
            <input type="hidden" value="<?php echo element('cmt_secret', $result); ?>" id="secret_comment_<?php echo element('cmt_id', $result); ?>" />
            <textarea id="save_comment_<?php echo element('cmt_id', $result); ?>" style="display:none"><?php echo html_escape(element('cmt_content', $result)); ?></textarea>
        </div>
    </div>
<?php
    }
}

if (element('list', element('data', $view))) {
    foreach (element('list', element('data', $view)) as $result) {
?>
    <div class="media" id="comment_<?php echo element('cmt_id', $result); ?>" >
        <?php if (element('use_comment_profile', element('board', $view))) { ?>
            <div class="media-left">
                <img class="media-object member-photo" src="<?php echo element('member_photo_url', $result); ?>" width="64" height="64" alt="<?php echo html_escape(element('cmt_nickname', $result)); ?>" title="<?php echo html_escape(element('cmt_nickname', $result)); ?>" />
            </div>
        <?php } ?>
        <div class="media-body" style="padding-left:<?php echo element('cmt_depth', $result); ?>px;">
            <div>
                <?php if (element('is_admin', $view)) { ?><input type="checkbox" name="chk_comment_id[]" value="<?php echo element('cmt_id', $result); ?>" /><?php } ?>
                └ <?php echo element('content', $result); ?>
            </div>
            <h4 class="media-heading">
                <?php echo element('display_name', $result); ?> | 
                <span class="time"><i class="fa fa-clock-o"></i> <?php echo element('display_datetime', $result); ?></span>
                <?php if (element('display_ip', $result)) { ?>
                    <span class="ip"><i class="fa fa-map-marker"></i> <?php echo element('display_ip', $result); ?></span>
                <?php } ?>
                
                <?php
                if ( ! element('post_del', element('post', $view)) && ! element('cmt_del', $result)) {
                ?>
                    <span class="reply">
                        <?php if (element('use_comment_like', element('board', $view))) { ?>
                            <a class="btn btn-default btn-xs good" href="javascript:;" id="btn-comment-like-<?php echo element('cmt_id', $result); ?>" onClick="comment_like('<?php echo element('cmt_id', $result); ?>', '1', 'comment-like-<?php echo element('cmt_id', $result); ?>');" title="추천하기"><i class="fa fa-thumbs-o-up fa-xs"></i>  <span class="comment-like-<?php echo element('cmt_id', $result); ?>"><?php echo number_format(element('cmt_like', $result)); ?></span></a>
                        <?php } ?>
                        <?php if (element('use_comment_dislike', element('board', $view))) { ?>
                            <a class="btn btn-default btn-xs bad" href="javascript:;" id="btn-comment-dislike-<?php echo element('cmt_id', $result); ?>" onClick="comment_like('<?php echo element('cmt_id', $result); ?>', '2', 'comment-dislike-<?php echo element('cmt_id', $result); ?>');" title="비추하기"><i class="fa fa-thumbs-o-down fa-xs"></i>  <span class="comment-dislike-<?php echo element('cmt_id', $result); ?>"><?php echo number_format(element('cmt_dislike', $result)); ?></span></a>
                        <?php } ?>
                        <?php if (element('use_comment_blame', element('board', $view)) && ( ! element('comment_blame_blind_count', element('board', $view)) OR element('cmt_blame', $result) < element('comment_blame_blind_count', element('board', $view)))) { ?>
                            <a href="javascript:;" id="btn-blame" onClick="comment_blame('<?php echo element('cmt_id', $result); ?>', 'comment-blame-<?php echo element('cmt_id', $result); ?>');" title="신고하기"><i class="fa fa-bell fa-xs"></i><span class="comment-blame-<?php echo element('cmt_id', $result); ?>"><?php echo element('cmt_blame', $result) ? '+' . number_format(element('cmt_blame', $result)) : ''; ?></span></a>
                        <?php } ?>

                        <?php if (element('can_reply', $result)) { ?>
                            <a href="javascript:;" onClick="comment_box('<?php echo element('cmt_id', $result); ?>', 'c'); return false;">답변</a>
                        <?php } ?>
                        <?php if (element('can_update', $result)) { ?>
                            <a href="javascript:;" onClick="comment_box('<?php echo element('cmt_id', $result); ?>', 'cu'); return false;">수정</a>
                        <?php } ?>
                        <?php if (element('can_delete', $result)) { ?>
                            <a href="javascript:;" onClick="delete_comment('<?php echo element('cmt_id', $result); ?>', '<?php echo element('post_id', $result); ?>', '<?php echo element('page', $view); ?>');">삭제</a>
                        <?php } ?>
                        <?php
                        if (element('is_admin', $view) && element('use_comment_secret', element('board', $view))) {
                            if (element('cmt_secret', $result)) {
                        ?>
                            <a href="javascript:;" onClick="post_action('comment_secret', '<?php echo element('cmt_id', $result); ?>', '0');"><i class="fa fa-lock"></i></a>
                        <?php } else { ?>
                            <a href="javascript:;" onClick="post_action('comment_secret', '<?php echo element('cmt_id', $result); ?>', '1');"><i class="fa fa-unlock"></i></a>
                        <?php
                            }
                        }
                        ?>
                    </span>
                <?php
                }
                ?>
            </h4>
            
            <span id="edit_<?php echo element('cmt_id', $result); ?>"></span><!-- 수정 -->
            <span id="reply_<?php echo element('cmt_id', $result); ?>"></span><!-- 답변 -->
            <input type="hidden" value="<?php echo element('cmt_secret', $result); ?>" id="secret_comment_<?php echo element('cmt_id', $result); ?>" />
            <textarea id="save_comment_<?php echo element('cmt_id', $result); ?>" style="display:none"><?php echo html_escape(element('cmt_content', $result)); ?></textarea>
        </div>
    </div>
<?php
    }
}
?>
<nav><?php echo element('paging', $view); ?></nav>
