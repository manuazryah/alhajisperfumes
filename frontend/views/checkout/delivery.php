<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\components\CartSummaryWidget;
use common\models\Emirates;
use yii\helpers\ArrayHelper;
use common\models\UserAddress;

$this->title = 'Checkout';
?>
<!--<style>
    .new_address_area{
        display: none;
    }
</style>-->
<div id="wpo-mainbody" class="container wpo-mainbody">
    <!--<nav class="woocommerce-breadcrumb" itemprop="breadcrumb"><a class="home" href="index.php">Home</a>&nbsp;/&nbsp;Cart&nbsp;/&nbsp;Checkout</nav>-->
    <div class="row">
        <!-- MAIN CONTENT -->
        <div id="wpo-content" class="wpo-content col-xs-12 no-sidebar checkout">
            <article id="post-8" class="post-8 page type-page status-publish hentry">

                <div class="content" data-content="">
                    <div class="wrap">
                        <div class="sidebar" role="complementary">
                            <?= CartSummaryWidget::widget(); ?>
                        </div>
                        <div class="main" role="main">
                            <div class="main__header">



                                <div data-alternative-payments="">
                                </div>

                            </div>
                            <div class="main__content">

                                <div class="step" data-step="contact_information">
                                    <!--<form novalidate="novalidate" class="edit_checkout animate-floating-labels" data-customer-information-form="true" data-email-or-phone="false" action="" accept-charset="UTF-8" method="post">-->
                                    <input name="utf8" type="hidden" value="✓">
                                    <input type="hidden" name="_method" value="patch">
                                    <input type="hidden" name="authenticity_token" value="">

                                    <input type="hidden" name="previous_step" id="previous_step" value="contact_information">
                                    <input type="hidden" name="step" value="shipping_method">

                                    <div class="step__sections">

                                        <div class="section section--contact-information">
                                            <?php
                                            $form = ActiveForm::begin([
                                                        'id' => 'address-form',
                                                        'fieldConfig' => [
                                                            'options' => [
//                                                                'tag' => false,
                                                            ],
                                                        ],
                                            ]);
                                            ?>

                                            <div class="section__content" data-section="customer-information" data-shopify-pay-validate-on-load="false">
                                                <div class="section section--shipping-address" data-shipping-address="" data-update-order-summary="">

                                                    <div class="section__header">
                                                        <h2 class="section__title">
                                                            Shipping address
                                                        </h2>
                                                    </div>

                                                    <div class="section__content">
                                                        <div class="fieldset" data-address-fields="">
                                                            <div class="row">
                                                                <div class="field field--required field--show-floating-label field--eights-eights ptop10" data-address-field="country" data-google-places="true">
                                                                    <div class="field__input-wrapper field__input-wrapper--select">
                                                                        <label class="field__label field__label--visible label-helper" for="checkout_shipping_address_country">Address</label>
                                                                        <select size="1" autocomplete="shipping country" data-backup="address" class="field__input field__input--select" aria-required="true" name="UserAddress[billing]" id="billing">
                                                                            <option value=''>Select</option>
                                                                            <?php
                                                                            foreach ($addresses as $address) {
                                                                                $status = $address->status == 1 ? "" : "";
                                                                                ?>
                                                                                <option value="<?= $address->id ?>" <?= $status ?>><?= $address->name . ', ' .$address->address . ', ' . $address->landmark . ', ' . $address->location ?></option>
                                                                            <?php } ?>

                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div>OR ADD A NEW ADDRESS</div>

                                                            <?php
                                                            $address = UserAddress::find()->where(['user_id' => Yii::$app->user->identity->id, 'status' => 1])->one();
                                                            ?>

                                                            <div class="new_address_area">

                                                                <h2 class="section__title">Address</h2>
                                                                <div class="row">
                                                                    <div class="field field--optional field--half" data-address-field="name">

                                                                        <div class="form-row">
                                                                            <?= Html::activeTextInput($model, 'name', ['placeholder' => 'Name', 'class' => 'input-text billing']); ?>
                                                                            <label class="label-helper" for="input">Name</label>
                                                                            <label class="error name_error"></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="field field--optional field--half" data-address-field="address">

                                                                        <div class="form-row">
                                                                            <?= Html::activeTextInput($model, 'address', ['placeholder' => 'Address', 'class' => 'input-text billing']); ?>
                                                                            <label class="label-helper" for="input">Address</label>
                                                                            <label class="error address_error"></label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="field field--optional field--half" data-address-field="landmark">

                                                                        <div class="form-row">
                                                                            <?= Html::activeTextInput($model, 'landmark', ['placeholder' => 'Landmark', 'class' => 'input-text billing']); ?>
                                                                            <label class="label-helper" for="input">Landmark</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="field field--optional field--half" data-address-field="location">

                                                                        <div class="form-row">
                                                                            <?= Html::activeTextInput($model, 'location', ['placeholder' => 'Location', 'class' => 'input-text billing']); ?>
                                                                            <label class="label-helper" for="input">Location</label>
                                                                            <label class="error location_error"></label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="field field--required field--show-floating-label field--eights-eights ptop10" data-address-field="country" data-google-places="true">
                                                                        <div class="field__input-wrapper field__input-wrapper--select">
                                                                            <label class="field__label field__label--visible label-helper" for="checkout_shipping_address_country">Emirates</label>
                                                                            <?=
                                                                            Html::activeDropDownList($model, 'emirate', ArrayHelper::map(Emirates::find()->all(), 'id', 'name'), [
                                                                                'class' => 'field__input field__input--select', 'prompt' => 'select'
                                                                            ])
                                                                            ?>
                                                                            <label class="error emirate_error"></label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    
                                                                    <div class="field field--optional field--half" data-address-field="post_code">

                                                                        <div class="form-row">
                                                                            <select class="day" style="position: absolute; border-right: 1px solid #d1d2d0;height: 45px;" id="useraddress-country_code" name="UserAddress[country_code]">
                                                                                <?php foreach ($country_codes as $country_code) { ?>
                                                                                    <option value="<?= $country_code ?>" ><?= $country_code ?></option>
                                                                                <?php }
                                                                                ?>
                                                                            </select>
                                                                            <?= Html::activeTextInput($model, 'mobile_number', ['placeholder' => 'Mobile Number', 'class' => 'input-text billing mobile']); ?>
                                                                            <label class="label-helper label-mobile" for="input">Mobile Number</label>
                                                                            <label class="error mobile_number_error"></label>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <!--                                    <div class="clearfix"></div>
                                                                                                    <input class="input-checkbox" data-backup="" type="checkbox" value="1" name="" id="save-info"><label class="checkbox__label" for="save-info">Save this information for next time</label>-->
                                                                <div class="clearfix"></div>
                                                                <div class="clearfix"></div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <br/>
                                                <br/>
                                                <br/>
                                                <div class="clearfix"></div>
                                                <div class="step__footer" data-step-footer="">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <div class="col-lg-6 col-md-6 hidden-sm hidden-xs">
                                                            <a class="step__footer__previous-link" href="cart.php">
                                                                <svg class="icon-svg icon-svg--color-accent icon-svg--size-10 previous-link__icon rtl-flip" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 10">
                                                                <path d="M8 1L7 0 3 4 2 5l1 1 4 4 1-1-4-4"></path>
                                                                </svg>
                                                                <!--<span class="step__footer__previous-link-content">Return to cart</span>-->
                                                            </a>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="wc-proceed-to-checkout" style="float: right;">
                                                                <?= Html::submitButton('Confirm Order', ['class' => 'btn btn-success checkout']) ?>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                </form>

                                            </div>

                                            <?php ActiveForm::end(); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- .entry-content -->
                            </article>
                            <!-- #post -->
                        </div>
                        <!-- //MAIN CONTENT -->

                    </div>
                </div>
                <script>
                    $('#billing').on('change', function () {
                        var id = $(this).val();
                        if (id === '') {
                            $('.billing').prop('disabled', false);
                            $('#useraddress-emirate').prop('disabled', false);
                            $('#useraddress-country_code').prop('disabled', false);
                        } else {
                            $('.billing').prop('disabled', true);
                            $('#useraddress-emirate').prop('disabled', true);
                            $('#useraddress-country_code').prop('disabled', true);
                        }
                        changeaddress('useraddress', id);
                    });

                    function changeaddress(formclass, id) {
                        jQuery.ajax({
                            type: "POST",
                            cache: 'false',
                            async: false,
                            url: homeUrl + 'checkout/getadress',
                            data: {id: id}
                        }).done(function (data) {
                            var $data = JSON.parse(data);
                            if ($data.rslt === "success") {
                                $('#' + formclass + '-name').val($data.name);
                                $('#' + formclass + '-address').val($data.address);
                                $('#' + formclass + '-landmark').val($data.landmark);
                                $('#' + formclass + '-location').val($data.location);
                                $('#' + formclass + '-emirate').val($data.emirate);
                                $('#' + formclass + '-post_code').val($data.post_code);
                                $('#' + formclass + '-mobile_number').val($data.mobile_number);
                                $('#' + formclass + '-country_code').val($data.country_code);

                            } else {
                                $('#' + formclass + '-name').val('');
                                $('#' + formclass + '-address').val('');
                                $('#' + formclass + '-landmark').val('');
                                $('#' + formclass + '-location').val('');
                                $('#' + formclass + '-emirate').val('1');
                                $('#' + formclass + '-post_code').val('');
                                $('#' + formclass + '-mobile_number').val('');
                            }
                        });
                    }
                </script>