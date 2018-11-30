<?php $this->managelayout->add_css(element('view_skin_url', $layout) . '/css/style.css'); ?>

<!-- <div class="modal-header">
    <h4 class="modal-title">채팅창</h4>
</div> -->
<div>
    <script async src="//client.uchat.io/uchat.js"></script>
    <u-chat room='secretvt' style="display:inline-block; width:100%; height:<?php echo element('height', $view); ?>px;"></u-chat>
</div>

<script type="text/javascript">
//<![CDATA[

//]]>
</script>
