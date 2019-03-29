<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Forgot-password';
?>

<div class="top-margin"></div>
<section id="login-signup">
    <div class="container">
        <div class="login-box">
            <div class="box-head">
                <h4>FORGOT YOUR PASSWORD</h4>
                <?= Html::a('Login', ['/site/login-signup'], ['class' => '']) ?>
            </div>
            <div class="box-content">
                <?= \common\components\AlertMessageWidget::widget() ?>
                <?php
                $form = ActiveForm::begin(
                                [
                                    'id' => 'forgot-email',
                                    'method' => 'post',
                                    'options' => [
                                        'class' => 'login-form fade-in-effect forgot-form'
                                    ]
                                ]
                );
                ?>
                <div class="form-group">
                    <label>New Password<span class="astric">*</span></label>
                    <?= $form->field($model_form, 'new_password')->passwordInput(['class' => 'form-control'])->label(FALSE) ?>
                </div>
                <div class="form-group">
                    <label>Confirm Password<span class="astric">*</span></label>
                    <?= $form->field($model_form, 'confirm_password')->passwordInput(['class' => 'form-control'])->label(FALSE) ?>
                </div>
                <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'submit']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</section>
<script>
    $('#confirm-password').on('keyup', function () {
        CheckConfirmPasswordMatch();
    });
    function CheckConfirmPasswordMatch() {
        if (($("#confirm-password").val()) !== ($("#new-password").val())) {
            $(".confirm_password").addClass('has-error');
            if ($(".confirm_password p").text() === "") {
                $(".confirm_password p").prepend("Password Mismatch");
            }


        } else {
            $(".confirm_password").removeClass('has-error');
            $(".confirm_password p").text("");
            $(".confirm_password").addClass('has-success');
        }
    }
</script>

