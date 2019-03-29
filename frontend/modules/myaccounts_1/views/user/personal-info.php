<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

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
                <div class="settings-edit-popup">
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                        <div class="modal-dialog modal-md" role="document" id="data-content">


                        </div>
                    </div>
                </div>
                <div class="in-track-your-orders">
                    <div class="head-main-box">
                        <h3 class="head">Account Settings</h3>
                    </div>

                    <div class="in-account-settings">
                        <div class="settings-box">
                            <h2 class="head">Account Information</h2>
                            <p class="contact-sucess-mag email-verification-successs" style="display: none"> A verification mail has been sent to your email. </p>
                            <?php
                            $user = common\models\User::findOne(Yii::$app->user->identity->id);
                            if (!empty($user)) {
                                if ($user->email_verification == 0) {
                                    ?>

                                    <p>( <span style="color:red">Your email id is not verified.</span> <a style="color: #109f40;" id="email-id-verification">Click here to verify</a> )</p>
                                    <?php
                                } else {
                                    echo '<p style="color: #109f40;">(Your email id is verified)</p>';
                                }
                            }
                            ?>

                            <ul class="list">
                                <li>Email: <?= $model->email ?></li>
                                <li>Password: ********</li>
                            </ul>
                            <div class="edit-button"><a href="" class="link" id="acccount-info-edit" data-toggle="modal">EDIT</a></div>

                            <div class="settings-edit-popup">
                                <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                                    <div class="modal-dialog modal-md" role="document" >
                                        <div class="modal-content" >
                                            <div class="modal-header">

                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                <h4 class="modal-title" style="font-size: 12px;text-transform: none;">A verification mail has been sent to your email.</h4>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="settings-box">
                            <h2 class="head">Personal Information</h2>
                            <ul class="list">
                                <li>Name: <?= $model->first_name ?> <?= $model->last_name ?></li>
                                <?php
                                $gender = '';
                                if (isset($model->gender) && $model->gender != '') {
                                    if ($model->gender == 1)
                                        $gender = 'Male';
                                    else
                                        $gender = 'Female';
                                }
                                ?>
                                <li>Gender:<?= $gender ?></li>
                                <?php
                                if (isset($model->dob) && $model->dob != '') {
                                    ?>
                                    <li>Birthdate: <?= $model->dob ?></li>
                                <?php } ?>
                                <li>Mobile:<?= $model->mobile_no ?></li>
                            </ul>
                            <div class="edit-button"><a href="" id="personal-info-edit" class="link">EDIT</a></div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</section>


<script>
    $(document).ready(function () {

        $('.account-info-success').hide();
        $(document).on('click', '#acccount-info-edit', function (e) {
            $.ajax({
                type: 'POST',
                url: homeUrl + 'myaccounts/user/account-info',
                success: function (data) {
                    $("#data-content").html(data);
                    $('#exampleModal').modal('show', {backdrop: 'static'});
                }
            });
        });
        $(document).on('blur', '#change-password', function (e) {
            CheckOldPassword();
        });
        $(document).on('blur', '#change-new-password', function (e) {
            CheckNewPassword();
            CheckMatching();
        });
        $(document).on('blur', '#change-confirm-password', function (e) {
            CheckConfirmPassword();
            CheckMatching();
        });
        $(document).on('submit', '#change-password', function (e) {
            e.preventDefault();
            var old_validation = CheckOldPassword();
            var new_validation = CheckNewPassword();
            var confirm_validation = CheckConfirmPassword();
            var match_validation = CheckMatching();
            if (old_validation == 1 && new_validation == 1 && confirm_validation == 1 && match_validation == 1) {
                var cnfm_pwd = $('#change-confirm-password').val();
                jQuery.ajax({
                    type: 'POST',
                    cache: false,
                    url: homeUrl + 'myaccounts/user/update-password',
                    data: {cnfm_pwd: cnfm_pwd},
                    success: function (data) {
                        $('#change-old-password').val('');
                        $('#change-new-password').val('');
                        $('#change-confirm-password').val('');
                        $('.account-info-success').show();
                        setTimeout(function () {
                            $('#exampleModal').modal('hide');
                        }, 4000);
                    }
                });
            }
        });

        $(document).on('click', '#personal-info-edit', function (e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: homeUrl + 'myaccounts/user/profile-info',
                success: function (data) {
                    $("#data-content").html(data);
                    $('#exampleModal').modal('show', {backdrop: 'static'});
                }
            });
        });

        $(document).on('submit', '#update-profile', function (e) {
            e.preventDefault();
            var data = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: homeUrl + 'myaccounts/user/update-profile-info',
                data: data,
                success: function (data) {
                    $('#update-profile')[0].reset();
                    $('.account-info-success').show();
                    setTimeout(function () {
                        $('#exampleModal').modal('hide');
                    }, 4000);
                    location.reload();
                }
            });
        });


        $(document).on('click', '#email-id-verification', function (e) {
            $.ajax({
                type: 'POST',
                url: homeUrl + 'myaccounts/user/email-verify',
                success: function (data) {
                    if (data == 1) {
                        $('.email-verification-successs').show();
                        setTimeout(function () {
                            $('.email-verification-successs').hide();
                        }, 3000);
                    }
                }
            });
        });
    });
    function CheckOldPassword() {
        var valid = 1;
        var old_pwd = $('#change-old-password').val();
        if (!$('#change-old-password').val()) {
            var valid = 0;
            if ($("#change-old-password").parent().next(".validation").length == 0) // only add if not added
            {
                $("#change-old-password").parent().after("<div class='validation' style='color:#e2e20c;margin-bottom: 8px;font-size:11px;'>Old password cannot be blank.</div>");
            }
        } else {
            if (old_pwd) {
                jQuery.ajax({
                    type: 'POST',
                    cache: false,
                    data: {old_pwd: old_pwd},
                    url: homeUrl + 'myaccounts/user/check-password',
                    success: function (data) {
                        if (data == 1) {
                            $("#change-old-password").parent().next(".validation").remove(); // remove it
                        } else {
                            $("#change-old-password").parent().next(".validation").remove(); // remove it
                            if ($("#change-old-password").parent().next(".validation").length == 0) // only add if not added
                            {
                                $("#change-old-password").parent().after("<div class='validation' style='color:#e2e20c;margin-bottom: 8px;font-size:11px;'>Incorrect password</div>");
                            }
                        }
                    }
                });
            }
        }
        return valid;
    }
    function CheckNewPassword() {
        var valid = 1;
        if (!$('#change-new-password').val()) {
            var valid = 0;
            if ($("#change-new-password").parent().next(".validation").length == 0) // only add if not added
            {
                $("#change-new-password").parent().after("<div class='validation' style='color:#e2e20c;margin-bottom: 8px;font-size:11px;'>New password cannot be blank.</div>");
            }
        } else {
            $("#change-new-password").parent().next(".validation").remove(); // remove it
        }
        return valid;
    }
    function CheckConfirmPassword() {
        var valid = 1;
        if (!$('#change-confirm-password').val()) {
            var valid = 0;
            if ($("#change-confirm-password").parent().next(".validation").length == 0) // only add if not added
            {
                $("#change-confirm-password").parent().after("<div class='validation' style='color:#e2e20c;margin-bottom: 8px;font-size:11px;'>New password cannot be blank.</div>");
            }
        } else {
            $("#change-confirm-password").parent().next(".validation").remove(); // remove it
        }
        return valid;
    }


    function CheckMatching() {
        var valid = 1;
        var new_pwd = $('#change-new-password').val();
        var confirm_pwd = $('#change-confirm-password').val();
        if (new_pwd && confirm_pwd) {
            if (new_pwd == confirm_pwd) {
                $("#change-confirm-password").parent().next(".validation").remove(); // remove it
            } else {
                var valid = 0;
                $("#change-confirm-password").parent().next(".validation").remove(); // remove it
                if ($("#change-confirm-password").parent().next(".validation").length == 0) // only add if not added
                {
                    $("#change-confirm-password").parent().after("<div class='validation' style='color:#e2e20c;margin-bottom: 8px;font-size:11px;'>Password mismatch.</div>");
                }
            }
        } else {
            var valid = 0;
        }
        return valid;
    }

</script>

