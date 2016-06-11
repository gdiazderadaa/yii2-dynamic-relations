<?php
	use synatree\dynamicrelations\SynatreeAsset;
    use yii\web\View;

	SynatreeAsset::register($this);

?>
<div class="box box-<?= $boxClass ?>">
    <div class="box-header with-border">
        <<?= $header ?> class="box-title"><?= $title ?></<?= $header ?>>
        <div class="box-tools pull-right">
            <button class="btn btn-box-tool" type="button" data-widget="collapse" >
                <i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">

        <ul class="list-group" data-related-view="<?= $ajaxAddRoute; ?>">
            <?php 
                foreach($collection as $model)
                {
            ?>
                <li class="form-group">
                    <button type="button" class="close remove-dynamic-relation" aria-label="Remove"><span aria-hidden="true">&times;</span></button>		
                    <div class="dynamic-relation-container">
                        <?= $this->renderFile( $viewPath, [ 'model' => $model, 'params' => $params, 'panel-id' => $panelId, 'header' => $header, 'boxClass' => $boxClass ]); ?>
                    </div>
                </li>	
            <?php
                }
            ?>
        </ul>
    </div>
    <div class="box-footer">
        <div class="form-group">
            <button class="btn btn-<?= $boxClass ?> btn-flat btn-sm add-dynamic-relation">
                <i class="glyphicon glyphicon-plus"></i> <?= Yii::t('app','Add'); ?>
            </button>
        </div>
    </div>
</div>


