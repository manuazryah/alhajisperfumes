<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\components\CartSummaryWidget;
use common\models\Emirates;
use yii\helpers\ArrayHelper;
use common\models\UserAddress;

$this->title = 'Checkout';
?>
<div class="top-margin"></div>
<div class="breadcrumb">
    <div class="container">
        <ul>
            <li><?= Html::a('Home', ['/site/index']) ?></li>
            <li><a class="current" href="javascript:void(0)">Checkout</a></li>
        </ul>
    </div>
</div>
<?php
$form = ActiveForm::begin([
            'id' => 'chechout-form',
            'fieldConfig' => [
                'options' => [
                    'class' => 'login-form',
                ],
            ],
        ]);
?>
<section id="checkout-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 order-two">

                <div class="form-group">
                    <h2 class="head">Shipping Address</h2>
                    <a id="new-adders" class="new-adders"><i class="fa fa-plus-circle" aria-hidden="true"></i></i> Add A New Address</a>
                    <label>Choose Your Address</label>
                    <div class="form-group login-email required">
                        <select class="form-control" size="1" autocomplete="shipping country" data-backup="address" name="UserAddress[billing]" id="billing">
                            <option value=''>Select</option>
                            <?php
                            foreach ($addresses as $address) {
                                $selected = '';
                                if (isset($default_address)) {
                                    if ($address->id == $default_address->id) {
                                        $selected = 'selected';
                                    }
                                }
                                ?>
                                <option value="<?= $address->id ?>" <?= $selected ?>><?= $address->name . ', ' . $address->address . ', ' . $address->landmark . ', ' . $address->location ?></option>
                            <?php } ?>
                        </select>
                    </div>                               
                </div>
                <?php
                $address = UserAddress::find()->where(['user_id' => Yii::$app->user->identity->id, 'status' => 1])->one();
                if (isset($default_address) && $default_address != '') {
                    $model->name = $default_address->name;
                    $model->address = $default_address->address;
                    $model->landmark = $default_address->landmark;
                    $model->location = $default_address->location;
                    $model->emirate = $default_address->emirate;
                    $model->mobile_number = $default_address->mobile_number;
                    $model->country_code = $default_address->country_code;
                }
                ?>
                <div class="form-group">
                    <label>Name</label>
                    <?= $form->field($model, 'name')->textInput()->label(FALSE) ?>
                </div>
                <div class="form-group">
                    <label>Building Name/Number</label>
                    <?= $form->field($model, 'address')->textInput()->label(FALSE) ?>
                </div>
                <div class="form-group">
                    <label>Landmark</label>
                    <?= $form->field($model, 'landmark')->textInput()->label(FALSE) ?>
                </div>
                <div class="form-group">
                    <label>Location</label>
                    <?= $form->field($model, 'location')->textInput()->label(FALSE) ?>
                </div>
                <div class="form-group">
                    <label>Emirate</label>
                    <?= $form->field($model, 'emirate')->dropDownList(ArrayHelper::map(Emirates::find()->all(), 'id', 'name'), ['prompt' => 'select'])->label(FALSE) ?>
                </div>
                <div class="form-group">
                    <label>Mobile Number</label>
                    <div class="row">
                        <?php $countrie_codes = ArrayHelper::map(common\models\CountryCode::findAll(['status' => 1]), 'id', 'country_code'); ?>
                        <div class="col-xl-2 col-lg-3 col-md-3 col-sm-3 col-3">
                            <select id="useraddress-country_code" name="UserAddress[country_code]" class="form-control country-code">
                                <?php foreach ($country_codes as $country_code) { ?>
                                    <option value="<?= $country_code ?>" ><?= $country_code ?></option>
                                <?php }
                                ?>
                            </select>
                        </div>
                        <div class="col-xl-10 col-lg-9 col-md-9 col-sm-9 col-9 pl0">
                            <?= $form->field($model, 'mobile_number')->textInput()->label(FALSE) ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>User Comment</label>
                    <div class="form-group required">
                        <textarea cols="6" rows="5" class="form-control" name="user_comment"></textarea>
                    </div>    
                </div>
            </div>
            <div class="col-lg-5 order-one">
                <?= CartSummaryWidget::widget(); ?>
            </div>
        </div>
    </div>
</section>
<?php ActiveForm::end(); ?>
<script>
    jQuery('#new-adders').click(function () {
        $('#useraddress-name').val('');
        $('#useraddress-address').val('');
        $('#useraddress-landmark').val('');
        $('#useraddress-location').val('');
        $('#useraddress-emirate').val('');
        $('#useraddress-mobile_number').val('');
        $('#billing').val('');
    });
    jQuery('body').on('change', '#billing', function (e) {
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
                $('#' + formclass + '-emirate').val('');
                $('#' + formclass + '-post_code').val('');
                $('#' + formclass + '-mobile_number').val('');
            }
        });
    }
</script>