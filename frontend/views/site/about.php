<?php
/* @var $this yii\web\View */

use yii\helpers\Html;

if (isset($meta_title) && $meta_title != '')
    $this->title = $meta_title;
else
    $this->title = 'Linea De Bella';
?>
<div class="top-margin"></div>
<div class="breadcrumb">
    <div class="container">
        <ul>
            <li> <?= Html::a('Home', ['/site/index']) ?></li>
            <li><a class="current" href="javascript:void(0)">About</a></li>
        </ul>
    </div>
</div>

<section id="about-page">
    <div class="container">
        <div class="about-sec">
            <div class="row">
                <div class="col-12">
                    <div class="about-heading">
                        <h1 class="heading"><span>Al Hajis Perfumes L.L.C</span><?= $about->title ?></h1>
                    </div>
                </div>
                <div class="col-12">
                    <?= $about->description ?>
                </div>
                <div class="col-lg-7">
                    <?= $about->detailed_description ?>
                </div>
                <div class="col-lg-5">
                    <div class="about-sec-img">
                        <img src="<?= Yii::$app->homeUrl; ?>uploads/cms/about/<?= $about->id ?>/large.<?= $about->about_image ?>" class="img-fluid" alt="<?= $about->title ?>"/>
                    </div>
                </div>
                <div class="col-12">
                    <div class="vision">
                        <div class="heading">
                            <h4 class="subtitle">Vision of</h4>
                            <h3 class="title">Al Hajis group</h3>
                        </div>
                        <p><?= $about->vision ?></p>
                    </div>
                </div>
            </div>
        </div>
</section>
<section id="our_vision">
    <div class="container">
        <div class="row">
            <div class="col-8">
                <div class="ceo-message">
                    <h4 class="title">Chairman's Message</h4>

                    <div class="story-box">

                        <div class="content">
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="info">
                                        The Hajis Group's distribution arm has many networks in the UAE market. An extensive market reach and a comprehensive understanding of the market have made us the partner of choice for many of the world's leading brands that sought a stable market share in the region.We value relationships, and we look forward to establishing a long and fruitful relationship with our customers.
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="chairman-image">
                                        <img src="<?= Yii::$app->homeUrl ?>images/chairman.png" width="100"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="story-footer">
                            <h5>AL HAJIS GROUP</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="about-heading">
                    <h1 class="heading">Our Vision</h1>
                </div>
                <p>
                    To be the best in the retail sector for luxury goods and services and be recognized internationally for its professionalism, top quality products and distinguished services.
                </p>
                <div class="about-heading">
                    <h1 class="heading">Our Mission</h1>
                </div>
                <p>
                    To indulge our customers with an exceptional shopping experience by offering quality products and services through our people and business partners.
                </p>
            </div>
        </div>
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
                </div>
            </div>
        </div>
    </div>
</section>




