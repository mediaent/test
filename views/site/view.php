<?php
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\helpers\Html;
?>
<h1><?=$model->name?></h1>
<div class="row">
    <div class="col-sm-12">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'summaryOptions' => ['class' => 'well'],
            'columns' => [
                //['class' => 'yii\grid\SerialColumn'],
                'tag_name',
                'count'
            ],
        ]);
            ?>
        </div>
    </div>        
