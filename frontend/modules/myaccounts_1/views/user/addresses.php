<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Emirates;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="top-margin"></div>
<section class="in-account-pages-section"><!--in-account-pages-section-->
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <?= \common\components\MyAccountMenuWidget::widget() ?>
            </div>
            <div class="col-lg-9">
                <div class="in-track-your-orders">
                    <div class="head-main-box">
                        <h3 class="head">Shipping Addresses</h3>
                    </div>
                    <div class="in-shipping-addresses"> <a href="#" class="link-box" id="add-address-form">CREATE A NEW ADDRESS</a>
                        <div class="row">
                            <?php foreach ($user_address as $value) { ?>
                                <div class="col-sm-6" id="useraddress-<?= $value->id ?>">
                                    <div class="addresses-box">
                                        <div class="radio-button">
                                            <div class="radio-account ">
                                                <input type="radio" name="default-address" value="<?= $value->id ?>" <?php
                                                if ($value->status == 1) {
                                                    echo ' checked';
                                                }
                                                ?> data-waschecked="true" >
                                                <span></span> </div>
                                        </div>
                                        <ul>
                                            <li><?= $value->name ?>
                                            <li><?= $value->address ?></li>
                                            <li><?= $value->landmark ?></li>
                                            <li><?= $value->location ?></li>
                                            <li><?= $value->post_code ?></li>
                                            <li><?= $value->mobile_number ?></li>
                                        </ul>
                                        <div class="sub-link"> <a href="#" class='edit-user-address' id="<?= $value->id ?>">Edit</a> <span>|</span> <a href="" class="delete-address" data-val="<?= $value->id ?>">Delete </a> </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="settings-edit-popup">
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-md" role="document" id="data-content">


        </div>
    </div>
</div>



<script>
    $(document).ready(function () {
        $(document).on('click', '#add-address-form', function (e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: homeUrl + 'myaccounts/user/add-address-form',
                success: function (data) {
                    $("#data-content").html(data);
                    $('#exampleModal').modal('show', {backdrop: 'static'});
                }
            });
        });

        $(document).on('submit', '#add-address', function (e) {
            e.preventDefault();
            var data = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: homeUrl + 'myaccounts/user/add-address',
                data: data,
                success: function (data) {
                    $('#add-address')[0].reset();
                    $('.account-info-success').show();
                    setTimeout(function () {
                        $('#exampleModal').modal('hide');
                        location.reload();
                    }, 1000);
                    setTimeout(function () {
                        location.reload();
                    }, 5000);
                }
            });
        });

        $('input[type=radio][name=default-address]').change(function () {
            showLoader();
            var idd = $(this).val();
            jQuery.ajax({
                url: '<?= Yii::$app->homeUrl; ?>myaccounts/user/change-status',
                type: "POST",
                data: {id: idd},
                success: function (data) {
                    if (data == 1) {
                    }
                    hideLoader();
                }
            });
        });
        $('.delete-address').on('click', function (e) {

            if (confirm("Are you sure you want to delete this?"))
            {
                e.preventDefault();
                var idd = $(this).attr('data-val');
                jQuery.ajax({
                    url: '<?= Yii::$app->homeUrl; ?>myaccounts/user/remove-address',
                    type: "POST",
                    data: {id: idd},
                    success: function (data) {
                        if (data == 1) {
                            $("#useraddress-" + idd).remove();
                        }
                    }
                });
            }
        });

        $(document).on('click', '.edit-user-address', function (e) {
            e.preventDefault();
            var id = $(this).attr('id');
            $.ajax({
                type: 'POST',
                url: homeUrl + 'myaccounts/user/edit-address',
                data: {id: id},
                success: function (data) {
                    $("#data-content").html(data);
                    $('#exampleModal').modal('show', {backdrop: 'static'});
                }
            });
        });

        $(document).on('submit', '#update-address', function (e) {
            e.preventDefault();
            var data = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: homeUrl + 'myaccounts/user/update-address',
                data: data,
                success: function (data) {
                    $('#update-address')[0].reset();
                    $('.account-info-success').show();
                    setTimeout(function () {
                        $('#exampleModal').modal('hide');
                    }, 4000);
                    setTimeout(function () {
                        location.reload();
                    }, 5000);
                }
            });
        });
    });
</script>