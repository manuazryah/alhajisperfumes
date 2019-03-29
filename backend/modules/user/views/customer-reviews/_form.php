<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CustomerReviews */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-reviews-form form-inline">

    <?php $form = ActiveForm::begin(); ?>
    <div class="col-xs-12">
        <div class='col-md-6 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'tittle')->textInput() ?>

        </div>
    </div>
    <div class="col-xs-12">
        <div class='col-md-6 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

        </div>
    </div>
    <div class="col-xs-12">
        <div class='col-md-6 col-sm-6 col-xs-12'>
            <div class="form-group" style="">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-success', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
            </div>
        </div>
        <div class='col-md-6 col-sm-6 col-xs-12'></div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
