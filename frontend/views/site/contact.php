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
    $this->title = 'Alhajis Perfumes';
?>

<div class="top-margin"></div>
<div class="breadcrumb">
    <div class="container">
        <ul>
            <li>
                <?= Html::a('Home', ['/site/index']) ?>
            </li>
            <li><a class="current" href="javascript:void(0)">Contact</a></li>
        </ul>
    </div>
</div>
<section class="in-contact-section">
    <div class="container">
        <div class="sec-title">
            <h4 class="heading">Contact Us</h4>
            <span class="title">Al Hajis Group</span> </div>
        <p class="top-text">Welcome to the different world of freshness to go away to be the centre of attractions. </p>
        <div class="contact-box">
            <div class="row">
                <div class="col-md-4">
                    <div class="box border-right-sd">
                        <div class="icon-box "></div>
                        <small class="small">Address</small>
                        <p class="text">Al hajis Perfumes ,Abuhail Centre GR9 
                            Hor al Anz East ,PB No 14448 Dubai ,
                            United Arab Emirates</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="box border-right-sd">
                        <div class="icon-box icon-box2"></div>
                        <small class="small">Phone No</small>
                        <p class="text">+971-4-2692067</p>
                        <p class="text">+971-55-1267733</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="box ">
                        <div class="icon-box icon-box3"></div>
                        <small class="small">E-mail</small>
                        <a href="mailto:alhajisperfumes.marketing@gmail.com" class="text">alhajisperfumes.marketing@gmail.com</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="in-map">
    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d925128.4105226778!2d55.227747!3d25.075348!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f43496ad9c645%3A0xbde66e5084295162!2sDubai+-+United+Arab+Emirates!5e0!3m2!1sen!2sin!4v1542966778917" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
</section>
<section class="in-contact-form">
    <div class="container">
        <h5 class="heading-form">Get in Touch</h5>
        <p>Fill in the form below, and we'll get back to you within 24 hours.</p>
        <?= common\widgets\Alert::widget() ?>
        <?php $form = ActiveForm::begin(['options' => ['class' => 'form-box']]); ?>
        <!--<form class="form-box">-->
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Name</label>
                    <input  type="text" class="form-control" name="ContactUs[first_name]" required>

                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input  type="text" class="form-control" name="ContactUs[email]"  required>
                </div>
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="text" class="form-control" name="ContactUs[mobile_no]"  required>
                </div>

            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Message</label>
                    <textarea  cols="" rows="" class="form-control" name="ContactUs[reason]"></textarea>
                </div>
                <div class="form-group">
                    <input name="" type="submit" value="Send Request!" class="submit">
                </div>
            </div>
        </div>
        <!--</form>-->
        <?php ActiveForm::end(); ?>
    </div>
</section>

<section id="branches">
    <div class="gradient-sec">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="sec-title">
                        <h4 class="heading">Our branches</h4>
                        <span class="title">Al Hajis Group</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="branch-slider">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="carousel-controls branch-carousel-controls">
                        <div class="control d-flex align-items-center justify-content-center prev mt-3"><img src="images/icons/back.png" class="img-fluid"/></div>
                        <div class="control d-flex align-items-center justify-content-center next mt-3"><img src="images/icons/next.png" class="img-fluid"/></div>

                        <div class="branch-carousel">
                            <?php
                            if (!empty($branches)) {
                                foreach ($branches as $branch) {
                                    if (!empty($branch)) {
                                        ?>
                                        <div class="one-slide mx-auto">
                                            <div class="branchs text-center d-flex flex-direction-column justify-content-center flex-wrap align-items-center">
                                                <div class="branch-image">
                                                    <img src="<?= yii::$app->homeUrl; ?>uploads/cms/branches/<?= $branch->id ?>/large.<?= $branch->image ?>" class="img-fluid"/>
                                                </div>
                                                <div class="branch-address"><?= $branch->branch_adress ?></div>
                                                <div class="branch-contact-id">Phone: <?= $branch->phone ?></div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <a href="<?= Yii::$app->homeUrl ?>site/branches" class="cristal-btn">Al Hajis Group All Branches</a>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function () {
        $('.close').click(function () {
            $('#w0-success-0').hide();
        });
    });
</script>
