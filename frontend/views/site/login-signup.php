<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\CountryCode;

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
                <h4>LOGIN</h4>
                <?= Html::a('Sign up', ['/site/signup'], ['class' => '']) ?>
            </div>
            <div class="box-content">
                <?= \common\components\AlertMessageWidget::widget() ?>
                <?php $form = ActiveForm::begin(['action' => ['site/login', 'go' => $go], 'options' => ['method' => 'post', 'class' => 'login-form']]) ?>
                <?= $form->field($model_login, 'email')->textInput(['class' => 'form-control'], ['autofocus' => true]) ?>
                <?= $form->field($model_login, 'password')->passwordInput(['class' => 'form-control']) ?>
                <div class="form-group remember">
                    <input type="checkbox" id="remember" class="form-control" name="LoginForm[rememberMe]" value="1" checked aria-required="true">
                    <label for="remember">Remember me</label>
                </div>
                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'submit']) ?>
                </div>
                <div class="box-footer">
                    <?= Html::a('Forgot password?', ['/forgot-password'], ['class' => 'forgot-link text-center']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</section>

