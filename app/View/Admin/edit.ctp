<a href="<?php echo $this->Html->url(array('controller' => 'admin', 'action' => 'lists', $type)); ?>" class="cButton" ><img src="<?php echo $webroot; ?>img/icon/list-icon.png" class="icon24" /><span>List <?php echo $type; ?></span></a>
<div id="show-account" class="content scaffold-show" role="main">
    <h1 class="pageTitle"><?php echo $page_title; ?></h1>
    <g:if test="${flash.message}">
        <div class="message" role="status"></div>
         <?php echo $dataTable; ?>
</div>