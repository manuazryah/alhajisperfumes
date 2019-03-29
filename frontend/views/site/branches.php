<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

if (isset($meta_title) && $meta_title != '')
    $this->title = $meta_title;
else
    $this->title = 'Branches';
?>

<div class="top-margin"></div>
<div class="breadcrumb">
    <div class="container">
        <ul>
            <li>
                <?= Html::a('Home', ['/site/index']) ?>
            </li>
            <li><a class="current" href="javascript:void(0)">Branches</a></li>
        </ul>
    </div>
</div>
<section class="in-branches-section">
    <div class="container">
        <div class="sec-title">
            <h4 class="heading">Our Branches</h4>
            <span class="title">Al Hajis Group</span> </div>
        <div class="branches-main">
            <div class="row">

                <?php foreach ($branches as $branch) { ?>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="branches-box">
                            <div class="logo-box">
                                <img src="<?= yii::$app->homeUrl; ?>uploads/cms/branches/<?= $branch->id ?>/large.<?= $branch->image ?>" class="img-fluid"/></div>
                            <iframe src="<?= $branch->map ?>" width="100%" height="260" frameborder="0" style="border:0" allowfullscreen></iframe>
                            <div class="text-box">
                                <h5 class="location"><?= $branch->branch_adress ?> </h5>
                                <h6 class="phone">Phone: <?= $branch->phone ?></h6>
                            </div>
                        </div>
                    </div>
                <?php } ?>



            </div>
        </div>
    </div>
</section>
