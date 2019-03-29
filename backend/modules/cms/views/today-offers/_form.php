<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TodayOffers */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
$label = '';
if ($model->id == 1) {
    $label = 'Image (File Size : 300x300)';
} elseif ($model->id == 3) {
    $stat = 'Image (File Size : 555x555)';
} elseif ($model->id == 5) {
    $stat = 'Image (File Size : 300x300)';
}
?>
<div class="today-offers-form form-inline">

    <?php $form = ActiveForm::begin(); ?>

    <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    
        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    </div>
    <div class='col-md-8 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>

    </div>
    <?php
    if ($model->id == 1 || $model->id == 3 || $model->id == 5) {
        ?>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>  
            <?= $form->field($model, 'image')->fileInput()->label($label) ?>
            <?php if (isset($model->image)) { ?>
                <img src="<?= Yii::$app->homeUrl ?>../uploads/cms/today-offers/<?= $model->id ?>/small.<?= $model->image; ?>?<?= rand() ?>" width="300" height="110"/>

                <?php
            } elseif (!empty($model->image)) {
                echo "";
            }
            ?>
        </div>
        <div class='col-md-8 col-sm-6 col-xs-12 left_padd'>    
            <?= $form->field($model, 'alt_tag')->textInput(['maxlength' => true]) ?>

        </div>
        <?php
    }
    ?>
    <div class='col-md-12 col-sm-12 col-xs-12'>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-success', 'style' => 'float:right;']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
