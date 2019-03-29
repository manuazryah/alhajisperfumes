<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Emirates;
?>
<div class="modal-content" >
    <div class="modal-header">
        <h4 class="modal-title">Add Address</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <div class="clearfix"></div>
    </div>
    <p class="contact-sucess-mag account-info-success" style="display: none"><i class="fa fa-check"></i> Address added successfully. </p>
    <?php
    $form = ActiveForm::begin(
                    [
                        'id' => 'add-address',
                        'method' => 'post',
                    ]
    );
    ?>
    <div class="form-box">
        <div class="form-group">
            <label>First Name</label>
            <input type="text" class="form-control"  name="UserAddress[name]" placeholder="First Name" required="" autocomplete="off"/>
        </div>

        <div class="form-group">
            <label>Address</label>
            <input type="text" class="form-control"  name="UserAddress[address]" placeholder="Address" required=""/>
        </div>

        <div class="form-group">
            <label>Landmark</label>
            <input type="text" class="form-control"  name="UserAddress[landmark]" placeholder="Landmark" />
        </div>

        <div class="form-group">
            <label>Location</label>
            <input type="text" class="form-control"  name="UserAddress[location]" placeholder="location" />
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <label>Emirate</label>
                    <?php
                    $emirates = Emirates::find()->all();
                    ?>

                    <select class="form-control"  name="UserAddress[emirate]">
                        <?php foreach ($emirates as $emirate) { ?>
                            <option value="<?= $emirate->id ?>" ><?= $emirate->name ?></option>
                        <?php }
                        ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label>Post Code</label>
                    <input type="text" class="form-control"  name="UserAddress[post_code]" placeholder="Post Code" />
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="form-group">
                        <label>Mobile Number</label>
                        <div class="row">
                            <?php
                            $country_codes = ArrayHelper::map(\common\models\CountryCode::find()->where(['status' => 1])->orderBy(['id' => SORT_ASC])->all(), 'id', 'country_code');
                            ?>
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-3">
                                <select id="useraddress-country_code" name="UserAddress[country_code]" class="form-control country-code">
                                    <?php foreach ($country_codes as $country_code) { ?>
                                        <option value="<?= $country_code ?>" ><?= $country_code ?></option>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-9 pl0">
                                <input type="text" class="form-control"  name="UserAddress[mobile_number]" placeholder="Mobile Number" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <input name="" type="submit" value="SUBMIT" class="submit">
    </div>
    <?php ActiveForm::end(); ?>
</div>

