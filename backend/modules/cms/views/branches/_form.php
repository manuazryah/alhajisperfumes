<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Branches */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="branches-form form-inline">

    <?php $form = ActiveForm::begin(); ?>

    <div class='col-md-12 col-sm-12 col-xs-12 left_padd'>    
        <?= $form->field($model, 'branch_name')->textInput(['maxlength' => true]) ?>

    </div>
    <div class='col-md-12 col-sm-12 col-xs-12 left_padd'>    
        <?= $form->field($model, 'branch_adress')->textarea(['rows' => 3]) ?>

    </div>
    <div class='col-md-12 col-sm-12 col-xs-12 left_padd'>    
        <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    </div>
    <div class='col-md-12 col-sm-12 col-xs-12 left_padd'>    
        <?= $form->field($model, 'map')->textInput(['maxlength' => true])->label('Map Url') ?>

    </div>
    <div class='col-md-12 col-sm-12 col-xs-12 left_padd'>    
        <?= $form->field($model, 'sort_order')->textInput() ?>

    </div>
    <div class='col-md-12 col-sm-12 col-xs-12 left_padd'>
        <?= $form->field($model, 'image')->fileInput()->label('Image (File Size : 200x200)') ?>
        <?php
        if (isset($model->image)) {
            ?>
            <img src="<?= Yii::$app->homeUrl ?>../uploads/cms/branches/<?= $model->id ?>/small.<?= $model->image; ?>?<?= rand() ?>" width="50" height="50"/>
            <?php
        }
        ?>
    </div>


    <div class='col-md-12 col-sm-12 col-xs-12'>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-success', 'style' => 'float:right;']) ?>
            <?= Html::a('Reset', ['index'], ['class' => 'btn btn-orange', 'style' => 'float:right;margin: 0px 10px;']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
