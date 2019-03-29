<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Brand */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="brand-form form-inline">

    <?php $form = ActiveForm::begin(); ?>
    <div class="">
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'brand')->textInput(['maxlength' => true]) ?>

        </div>

        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'status')->dropDownList(['1' => 'Enable', '0' => 'Disable']) ?>
        </div>

         <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                        <?= $form->field($model, 'show_menu')->dropDownList(['1' => 'Yes', '0' => 'No'])->label('Show menu ( Show this brand on main menu )') ?>
                </div>
                
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'favourite_brand')->dropDownList(['' => '--Select--','1' => 'Yes', '0' => 'No'])->label('Favourite Brand (Show this brand on favourite brands list)') ?>
        </div>

                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                        <?= $form->field($model, 'image')->fileInput()->label('Logo<i> (210*110)</i>') ?>
                        <?php if (isset($model->image) && $model->image != '') { ?>
                                <img src="<?= Yii::$app->homeUrl ?>../uploads/cms/brands/<?= $model->id ?>/small.<?= $model->image ?>">
                        <?php } ?>
                </div>
    </div>
    <div class="row">
        <div class='col-md-12 col-sm-12 col-xs-12'>
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-success', 'style' => 'float:right;']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
