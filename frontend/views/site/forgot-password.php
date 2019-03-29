<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

if (isset($meta_title) && $meta_title != '')
    $this->title = $meta_title;
else
    $this->title = 'AL HAJIS';
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
                <h6 style="font-family: roboto-medium; font-size: 16px; color: #8c8c8c; margin-top: 25px">No Problem!</h6>
                <p class="sub-discrip">We will send you an email to reset your password. Just enter the same email address you used for registration on alhajia.com. We will send you an email with instructions for resetting your password.</p>
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
                    <label>E-Mail Address<span class="astric">*</span></label>
                    <?= $form->field($model, 'email')->textInput(['class' => 'form-control'])->label(FALSE) ?>
                </div>
                <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'submit']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</section>


