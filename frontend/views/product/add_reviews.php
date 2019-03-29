<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Emirates;

$product_details = common\models\Product::findOne($product);
?>
<div class="modal-content" >
        <div class="modal-header">
                <h4 class="modal-title">Add reviews</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <div class="clearfix"></div>
        </div>


        <div class="form-box">
                <?php $form = ActiveForm::begin(['id' => 'submit-reviews']); ?>
                <div class="form-group">
                        <input type="text" class="form-control"  name="CustomerReviews[tittle]" required="" autocomplete="off" placeholder='Title'/>
                </div>

                <input type="hidden" class="form-control" name="CustomerReviews[product_id]" value="<?= $product ?>"/>

                <div class="form-group">
                        <textarea class="form-control"  name="CustomerReviews[description]" required="" autocomplete="off" placeholder='Description'></textarea>
                </div>

                <input name="" type="submit" value="SUBMIT" class="submit">
                <?php ActiveForm::end(); ?>
        </div>
</div>

