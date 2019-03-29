<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Emirates;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<aside class="col-md-9 col-sm-8">

    <div class="section section--shipping-address" data-shipping-address="" data-update-order-summary="">
        <?php $form = ActiveForm::begin(); ?>

        <div class="section__header">
            <h3 class="title2">
                Address
            </h3>
        </div>

        <div class="section__content">
            <div class="fieldset" data-address-fields="">

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 padlft0 first-name">
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'class' => 'field__input input-width billing', 'placeholder' => 'First Name'])->label(FALSE) ?>
                </div>

                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 padlft0 address">
                    <?= $form->field($model, 'address')->textInput(['maxlength' => true, 'class' => 'field__input input-width billing', 'placeholder' => 'Address'])->label(FALSE) ?>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 padlft0 padright0 apt">
                    <?= $form->field($model, 'landmark')->textInput(['maxlength' => true, 'class' => 'field__input input-width billing', 'placeholder' => 'Apt, suite, etc. (optional)'])->label(FALSE) ?>
                </div>
                <div class="col-lg-6 col-md-4 col-sm-4 col-xs-4 padlft0 padright0 apt">
                    <?= $form->field($model, 'location')->textInput(['maxlength' => true, 'class' => 'field__input input-width billing', 'placeholder' => 'Location'])->label(FALSE) ?>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padlft0 padright0 city">
                    <div class="field__input-wrapper field__input-wrapper--select">
                        <label class="field__label field__label--visible label-helper" for="checkout_shipping_address_country">Country</label>
                        <?= $form->field($model, 'emirate')->dropDownList(ArrayHelper::map(Emirates::find()->all(), 'id', 'name'), ['prompt' => 'select'])->label(FALSE); ?>


                    </div>
                </div>


                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 padlft0 padright0">
                    <?= $form->field($model, 'post_code')->textInput(['maxlength' => true, 'class' => 'field__input field__input--zip input-width billing mobile', 'placeholder' => 'Pincode'])->label(FALSE) ?>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 padlft0 padright0">
                    <select class="day" style="position: absolute; border-right: 1px solid #d1d2d0;height: 45px;" id="useraddress-country_code" name="UserAddress[country_code]">
                        <?php foreach ($country_codes as $country_code) { ?>
                            <option value="<?= $country_code ?>" ><?= $country_code ?></option>
                        <?php }
                        ?>
                    </select>
                    <?= $form->field($model, 'mobile_number')->textInput(['class' => 'field__input field__input--zip input-width billing mobile', 'style' => 'width: 85%;padding-left: 70px;margin-left: 63px;'])->label(FALSE) ?>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 f-right">
            <div class="wc-proceed-to-checkout">
                <?= Html::submitButton('Save address', ['class' => 'checkout-button button alt wc-forward checkout']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</aside>
