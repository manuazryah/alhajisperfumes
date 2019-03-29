<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<!--<form method="post" role="form" id="login" class="login-form fade-in-effect">-->
<?php
$form = ActiveForm::begin(
                [
                    'method' => 'post',
                    'options' => [
                        'class' => 'login-form fade-in-effect'
                    ]
                ]
);
?>
<div class="login-header">
    <a href="#" class="logo">
        <img src="<?= yii::$app->homeUrl; ?>images/logo.png" alt="logo" width="250" />
    </a>
    <p class="login-box-msg">Dear user, log in to access the admin area!</p>
</div>


<div class="form-group">
    <?php
    $fieldOptions2 = [
        'options' => ['class' => 'form-group has-feedback'],
        'inputTemplate' => "{input}<span class='glyphicon glyphicon-user form-control-feedback'></span>"
    ];
    ?>
    <?= $form->field($model, 'user_name', $fieldOptions2)->label('User Name')->textInput() ?>
</div>

<div class="form-group">
    <?php
    $fieldOptions3 = [
        'options' => ['class' => 'form-group has-feedback'],
        'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
    ];
    ?>
    <?= $form->field($model, 'password', $fieldOptions3)->label('Password')->passwordInput() ?>
</div>
<div class="form-group">
    <?= $form->field($model, 'rememberMe')->checkbox() ?>
</div>
<div class="form-group">
    <?= Html::submitButton('Log In', ['class' => 'btn btn-dark  btn-block text-left']) ?>
</div>
<div class="login-footer">
    <a href="<?= yii::$app->homeUrl; ?>forgot-password">Forgot your password?</a>

</div>

<?php ActiveForm::end(); ?>




