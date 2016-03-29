<?php
	use synatree\dynamicrelations\SynatreeAsset;
    use yii\web\View; 

	SynatreeAsset::register($this);
    $this->registerCSS(
        "h2.panel-title a{text-decoration:none; color:inherit;font-size:26px}
        h2.panel-title a i{font-size:14px;}"
    );
    $this->registerJs(
        "$('h2.panel-title a').on('click',function (){
            $(this).children('i').toggleClass('glyphicon-chevron-down glyphicon-chevron-up');
        });"
        , View::POS_READY
        ,"template"
    );
?>
<div class="panel">
    <div class="panel-heading">
        <h2 class="panel-title">
            <a data-toggle="collapse" href="#<?= $title ?>">
                <?= $title; ?> <i class="glyphicon glyphicon-chevron-down"></i>
            </a>
        </h2>
    </div>
    <div id="<?= $title ?>" class="panel-collapse collapse">
        <div class="panel-body">
            <a href="#" class="btn btn-success btn-sm add-dynamic-relation">
                <i class="glyphicon glyphicon-plus"></i> <?= Yii::t('app','Add'); ?>
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