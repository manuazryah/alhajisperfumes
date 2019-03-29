<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Testimonials */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="testimonials-form form-inline">

    <?php $form = ActiveForm::begin(); ?>

    <div class='col-md-12 col-sm-12 col-xs-12 left_padd'>    
        <?= $form->field($model, 'name')->textInput() ?>

    </div>
    <div class='col-md-12 col-sm-12 col-xs-12 left_padd'>    
        <?= $form->field($model, 'content')->textarea(['rows' => 3]) ?>

    </div>
    <div class='col-md-12 col-sm-12 col-xs-12 left_padd'>
        <?= $form->field($model, 'status')->dropDownList(['1' => 'Enable', '0' => 'Disable']) ?>

    </div>
    <div class='col-md-12 col-sm-12 col-xs-12 left_padd'>
        <?= $form->field($model, 'image')->fileInput()->label('Image<i> (122x122)</i>') ?>
        <?php
        if (!$model->isNewRecord) {
            ?>
            <img src="<?= Yii::$app->homeUrl . '../uploads/cms/testimonials/' . $model->id . '/small.' . $model->image ?>" >
        <?php } ?>

    </div>
    <div class='col-md-12 col-sm-12 col-xs-12'>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-success', 'style' => 'float:right;']) ?>
            <?= Html::a('Reset', ['index'], ['class' => 'btn btn-orange', 'style' => 'float:right;margin: 0px 10px;']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
