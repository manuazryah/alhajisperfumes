<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\components\CartSummaryWidget;
use yii\helpers\ArrayHelper;
use common\models\Product;

$this->title = 'Checkout';
?>
<section class="in-check-out-section"><!--in-orders-section-->
        <div class="container">

                <div class="row">
                        <div class="col-lg-7">
                                <?= CartSummaryWidget::widget(); ?>
                        </div>
                        <div class="col-lg-7">

                                <div class="check-out-box-left check-comment-box">
                                        <!--<form class="in-main-form">-->
                                        <?php $form = ActiveForm::begin(['options' => ['class' => 'in-main-form']]); ?>
                                        <div class="form-group">
                                                <label>User comment</label>
                                                <textarea name="user_comment" class="form-control"></textarea>
                                        </div>
                                        <div class="form-group">
                                                <label > <div class="radio-account ">
                                                                <input type="radio" name="payment_method" value="1" data-waschecked="true">
                                                                <span></span> </div><span class="span">Cash On delivery</span></label>

                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="form-group">
                                                <label > <div class="radio-account ">
                                                                <input type="radio" name="payment_method" value="2" data-waschecked="true">
                                                                <span></span> </div><span class="span">Payment Gateway</span></label>

                                        </div>

                                        <div class="clearfix"></div>

                                        <div class="form-group">
                                                <?= Html::submitButton('Confirm Order', ['class' => 'submit', 'id' => 'confirm']) ?>
                                        </div>

                                        <!--                                        </form>-->
                                        <?php ActiveForm::end(); ?>
                                </div>

                        </div>

                </div>
        </div>
</section>
