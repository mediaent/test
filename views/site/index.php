<?php
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\helpers\Html;
?>
<div class="row">
    <div class="col-sm-12">
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

        <?= $form->field($model, 'XMLfiles')->fileInput() ?>
        <div class="form-group">
            <?= Html::submitButton('Отправить', ['class' =>'btn btn-primary']) ?>
        </div>
        <?php ActiveForm::end() ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'summaryOptions' => ['class' => 'well'],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'create_at',
                [
                    'attribute' => 'name',
                    'format' => 'html',
                    'value' => function ($data) {
                        return Html::a($data->name, ['/site/view','id'=>$data->id]);
                    }
                ],
            ],
        ]);
            ?>
        </div>
    </div>        
