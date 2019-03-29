<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\CountryCode;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;

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
                <h4>SIGN UP</h4>
                <?= Html::a('Login', ['/site/login-signup'], ['class' => '']) ?>
            </div>
            <div class="box-content">
                <?php
                $form = ActiveForm::begin(['id' => 'sign_up_form', 'options' => [
                                'class' => 'login-form'
                ]]);
                ?>
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                        <label>First Name<span class="astric">*</span></label>
                        <div class="form-group">
                            <?= $form->field($model, 'first_name')->textInput(['placeholder' => ''])->label(FALSE) ?>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                        <label>Last Name<span class="astric">*</span></label>
                        <div class="form-group">
                            <?= $form->field($model, 'last_name')->textInput(['placeholder' => ''])->label(FALSE) ?>
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <label>Email<span class="astric">*</span></label>
                        <div class="form-group">
                            <?= $form->field($model, 'email')->textInput(['placeholder' => ''])->label(FALSE) ?>
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <label>Mobile<span class="astric">*</span></label>
                            <div class="row">
                                <?php $countrie_code = ArrayHelper::map(CountryCode::findAll(['status' => 1]), 'id', 'country_code'); ?>
                                <div class="col-xl-2 col-lg-3 col-md-3 col-sm-3 col-3">
                                    <select id="cntry_code_id" name="SignupForm[country_code]" class="country-code">
                                        <?php
                                        foreach ($countrie_code as $key => $countrie_cod) {
                                            ?>
                                            <option value="<?= $key ?>"><?= $countrie_cod ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-xl-10 col-lg-9 col-md-9 col-sm-9 col-9 pl0">
                                    <?= $form->field($model, 'mobile_no')->textInput()->label(FALSE) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <div class="form-group required gender">
                                                        <?=
                                                        $form->field($model, 'gender')->radioList([1 => 'Male', 0 => 'Female'], ['item' => function($index, $label, $name, $checked, $value) {
                                                                    $return = '<div class="fleft">';
                                                                    $return .= '<input class="form-control option-input" type="radio" name="' . $name . '" value="' . $value . '" tabindex="3">';
                                                                    $return .= '<label for="male">' . ucwords($label) . '</label>';
                                                                    $return .= '</div>';
                                                                    return $return;
                                                            }])->label(false);
                                                        ?>


                                                </div>
                                        </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <label>Date of Birth</label>
                            <?php
                            $model->dob = date('d-M-Y');
                            ?>
                            <?=
                            $form->field($model, 'dob')->widget(DatePicker::classname(), [
                                'type' => DatePicker::TYPE_INPUT,
                                'pluginOptions' => [
                                    'autoclose' => true,
                                    'format' => 'dd-M-yyyy',
                                ]
                            ])->label(FALSE);
                            ?>
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <label>Password<span class="astric">*</span></label>
                            <?= $form->field($model, 'password')->passwordInput()->label(FALSE) ?>
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <label>Confirm Password<span class="astric">*</span></label>
                            <?= $form->field($model, 'password_repeat')->passwordInput(['placeholder' => ''])->label(FALSE) ?>
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <?= Html::submitButton('Submit', ['class' => 'submit']) ?>
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="box-footer">
                            <small>By clicking the 'Sign Up' button, you confirm that you accept our <a href="#">Terms of use and Privacy Policy </a></small>
                            <p>Have an account? <?= Html::a('Log In', ['/site/login-signup'], ['class' => '']) ?></p>
                        </div>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</section>
