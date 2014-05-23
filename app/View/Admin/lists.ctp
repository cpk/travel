

<div>
    <ul class="breadcrumb">
        <li>
            <a href="<?php echo $this->Html->url(array('controller' => 'admin', 'action' => 'index')); ?>">Administrator</a> <span class="divider">/</span>
        </li>
        <li>
            <?php echo $subcat ?>
        </li>
    </ul>
</div>

<a href="<?php echo $this->Html->url(array('controller' => 'admin', 'action' => 'create', $type)); ?>" class="cButton" ><img src="<?php echo $webroot; ?>img/icon/create-icon.png" class="icon24" /><span>New</span></a>

<div class="row-fluid sortable">		
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-user"></i> <g:message code="default.list.label" args="[entityName]" /></h2>
            <div class="box-icon">
                <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
            </div>
        </div>
        <div class="box-content">
            <?php echo $dataTable; ?>
        </div>
    </div>
    <div class="clear"></div>
</div>
