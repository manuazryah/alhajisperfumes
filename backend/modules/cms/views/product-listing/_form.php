<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\HomeManagement */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="home-management-form form-inline">

    <?php $form = ActiveForm::begin(); ?>

</div><div class='col-md-12 col-sm-12 col-xs-12 left_padd'>
    <?php
    if (isset($model->product_id) && $model->product_id != '')
        $model->product_id = explode(',', $model->product_id);
    ?>
    <?= $form->field($model, 'product_id')->dropDownList(ArrayHelper::map(common\models\Product::find()->all(), 'id', 'product_name'), ['prompt' => 'select Product', 'class' => 'form-control', 'multiple' => 'multiple']) ?>

</div>
<div class='col-md-12 col-sm-12 col-xs-12'>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-success', 'style' => 'float:right;']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>

</div>

<script>
    $(document).ready(function () {
        $("#productlisting-product_id").select2({
            placeholder: 'Select',
            allowClear: true
        }).on('select2-open', function ()
        {
            // Adding Custom Scrollbar
            $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });
    });
</script>