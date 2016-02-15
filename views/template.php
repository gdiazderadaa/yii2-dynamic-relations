<?php
	use synatree\dynamicrelations\SynatreeAsset;

	SynatreeAsset::register($this);
?>
<div class="panel">
    <div class="panel-heading">
        <h2 class="panel-title">
            <a data-toggle="collapse" href="#<?= $title ?>">
                <?= $title; ?>
            </a>
        </h2>
    </div>
    <div id="<?= $title ?>" class="panel-collapse collapse">
        <div class="panel-body">
            <a href="#" class="btn btn-success btn-sm add-dynamic-relation">
                <i class="glyphicon glyphicon-plus"></i> Add
            </a>
            <ul class="list-group" data-related-view="<?= $ajaxAddRoute; ?>">
            <?php 
                foreach($collection as $model)
                {
            ?>
                <li class="list-group-item">
                    <button type="button" class="close remove-dynamic-relation" aria-label="Remove"><span aria-hidden="true">&times;</span></button>		
                    <div class="dynamic-relation-container">
                        <?= $this->renderFile( $viewPath, [ 'model' => $model, 'params' => $params, ]); ?>
                    </div>
                </li>	
            <?php
                }
            ?>
            </ul>
        </div>
    </div>
</div>

