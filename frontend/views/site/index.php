<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use common\components\ProductLinksWidget;
use common\models\Product;

if (isset($meta_title) && $meta_title != '')
    $this->title = $meta_title;
else
    $this->title = 'AL HAJIS';
?>
<div id="bootstrap-touch-slider" class="bs-slider carousel-fade carousel slide control-round indicators-line"  data-ride="carousel" data-pause="hover" data-interval="5000">
    <ol class="carousel-indicators">
        <?php
        if (!empty($sliders)) {
            $ol = 0;
            foreach ($sliders as $slider) {
                if (!empty($slider)) {
                    ?>
                    <li data-target="#bootstrap-touch-slider" data-slide-to="<?= $ol ?>" class="<?= $ol == 0 ? 'active' : '' ?>"></li>
                    <?php
                    $ol++;
                }
            }
        }
        ?>
    </ol>
    <div class="carousel-inner">
        <?php
        if (!empty($sliders)) {
            $oll = 0;
            foreach ($sliders as $slider) {
                if (!empty($slider)) {
                    ?>
                    <div class="carousel-item <?= $oll == 0 ? 'active' : '' ?>">
                        <img class="d-block img-fluid" src="<?= Yii::$app->homeUrl; ?>uploads/cms/slider/<?= $slider->id ?>/large.<?= $slider->img ?>" alt="<?= $slider->alt_tag_content != '' ? $slider->alt_tag_content : 'Slider' ?>">
                    </div>
                    <?php
                    $oll++;
                }
            }
        }
        ?>
        <a class="carousel-control-prev" href="#bootstrap-touch-slider" data-slide="prev"> <span class="fa fa-angle-left"></span> </a> <a class="carousel-control-next" href="#bootstrap-touch-slider" data-slide="next"> <span class="fa fa-angle-right"></span> </a>
    </div>
</div>
<div id="content">
    <section id="about">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="main-title">
                        <span class="title">Welcome to</span>
                        <h1 class="heading">Al Hajis Perfumes L.L.C</h1>
                        <h4 class="subtitle">UAE & Oman</h4>
                    </div>
                    <?= $about->description ?>
                </div>
                <div class="col-md-5">
                    <div class="about-sec-vid">
                        <a target="_blank" href="https://www.youtube.com/embed/jjYD6sxdF-I"><img src="<?= Yii::$app->homeUrl; ?>images/about-sec-vid.png" class="img-fluid"></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="product-sec">
        <div id="product-sec-title">
            <div class="container">
                <div class="heading">
                    <h4 class="subtitle">New</h4>
                    <h3 class="title">Arrivals</h3>
                </div>
                <div class="discrp">
                    <p class="text">Hit yourselves with these new fragrances</p>
                    <span class="company-name">Al Hajis Perfumes L.L.C</span>
                </div>
            </div>
        </div>
        <div class="product-grid">
            <!--<div class="container">-->
            <div class="row">
                <?php
                if (!empty($our_latest_products)) {
                    $latest_products_lists = explode(',', $our_latest_products->product_id);

                    $i = 0;
                    foreach ($latest_products_lists as $latest_product) {

                        if (!empty($latest_product) && $latest_product != '') {
                            $product_exist = Product::findOne($latest_product);
                            if (isset($product_exist)) {
                                if ($product_exist->stock > 0) {
                                    $i++;
                                    ?>
                                    <?= ProductLinksWidget::widget(['id' => $latest_product]) ?>
                                    <?php
                                }
                            }
                        }
                        if ($i == 12) {
                            break;
                        }
                    }
                }
                ?>
            </div>
            <!--</div>-->
        </div>
    </section>

    <section id="special-off">
        <div class="container">
            <div class="special-off-box">
                <div class="row">
                    <div class="col-12">
                        <div class="sec-title">
                            <h4 class="heading">Todays offer</h4>
                            <span class="title">Al Hajis Group</span>
                        </div>
                    </div>
                    <?php
                    $offer1 = common\models\TodayOffers::findOne(1);
                    $offer2 = common\models\TodayOffers::findOne(2);
                    $offer3 = common\models\TodayOffers::findOne(3);
                    $offer4 = common\models\TodayOffers::findOne(4);
                    $offer5 = common\models\TodayOffers::findOne(5);
                    ?>
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <div class="row">
                            <a href="<?= $offer1->link ?>" class="col-xl-12 col-lg-12 col-md-6 col-sm-6 col-12 pad0">
                                <div class="img-box">
                                    <img src="<?= Yii::$app->homeUrl; ?>uploads/cms/today-offers/<?= $offer1->id ?>/large.<?= $offer1->image ?>" class="img-fluid" alt="<?= $offer1->alt_tag != '' ? $offer1->alt_tag : $offer1->title ?>"/>
                                </div>
                            </a>
                            <a href="<?= $offer2->link ?>" class="col-xl-12 col-lg-12 col-md-6 col-sm-6 col-12 pad0">
                                <div class="off-detail orange">
                                    <h5 class="heading"><?= $offer2->title ?></h5>
                                    <span class="title">New Arrivals</span>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 full-width">
                        <div class="row">
                            <a href="<?= $offer3->link ?>" class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 md-xl-pad0">
                                <div class="img-box">
                                    <img src="<?= Yii::$app->homeUrl; ?>uploads/cms/today-offers/<?= $offer3->id ?>/large.<?= $offer3->image ?>" class="img-fluid" alt="<?= $offer3->alt_tag != '' ? $offer3->alt_tag : $offer3->title ?>"/>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <div class="row">
                            <a href="<?= $offer4->link ?>" class="col-xl-12 col-lg-12 col-md-6 col-sm-6 col-12 pad0">
                                <div class="off-detail blue">
                                    <h5 class="heading"><?= $offer4->title ?></h5>
                                    <span class="title">New Arrivals</span>
                                </div>
                            </a>
                            <a href="<?= $offer5->link ?>" class="col-xl-12 col-lg-12 col-md-6 col-sm-6 col-12 pad0">
                                <div class="img-box">
                                    <img src="<?= Yii::$app->homeUrl; ?>uploads/cms/today-offers/<?= $offer5->id ?>/large.<?= $offer5->image ?>" class="img-fluid" alt="<?= $offer5->alt_tag != '' ? $offer5->alt_tag : $offer5->title ?>"/>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <a class="scroll-down" href="javascript:void(0)"></a>
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
                        <a href="<?= Yii::$app->homeUrl ?>site/branches" class="cristal-btn">View All UAE & Oman Branches</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="product-sec">
        <div id="product-sec-title">
            <div class="container">
                <div class="heading">
                    <h4 class="subtitle">Our Featured</h4>
                    <h3 class="title">Collections</h3>
                </div>
                <div class="discrp">
                    <p class="text">The Best Online Sales To Shop This Weekend</p>
                    <span class="company-name">Al Hajis Perfumes L.L.C</span>
                </div>
            </div>
        </div>
        <div class="product-grid">
            <!--<div class="container">-->
            <div class="row">
                <?php
                if (!empty($our_featured_products)) {
                    $featured_products_lists = explode(',', $our_featured_products->product_id);
                    $j = 0;
                    foreach ($featured_products_lists as $featured_product) {
                        if (!empty($featured_product) && $featured_product != '') {

                            $product_exist = Product::findOne($featured_product);
                            if (isset($product_exist)) {
                                if ($product_exist->stock > 0) {
                                    $j++;
                                    ?>
                                    <?= ProductLinksWidget::widget(['id' => $featured_product]) ?>
                                    <?php
                                }
                            }
                        }
                        if ($j == 12) {
                            break;
                        }
                    }
                }
                ?>
            </div>
            <!--</div>-->
        </div>
    </section>

    <section id="featured">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                    <div class="icon-box">
                        <icon><i class="fas fa fa-truck"></i></icon>
                        <div class="info">
                            <h5 class="title">Free Shipping</h5>
                            <p class="text">Free shipping for local customers</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                    <div class="icon-box">
                        <icon><i class="fas fa-hand-holding-usd"></i></icon>
                        <div class="info">
                            <h5 class="title">Money Back Guarantee</h5>
                            <p class="text">Refund or change item within 24 hours</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                    <div class="icon-box">
                        <icon><i class="fas fa-user-clock"></i></icon>
                        <div class="info">
                            <h5 class="title">24/7 support</h5>
                            <p class="text">Answer all your questions with an hour</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="brands">
        <div class="gradient-sec">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="sec-title">
                            <h4 class="heading">Brands</h4>
                            <span class="title">Al Hajis Group</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="brands-slider">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="carousel-controls brands-carousel-controls">
                            <div class="brands-carousel">
                                <?php
                                if (!empty($fav_brands)) {
                                    foreach ($fav_brands as $each_brand) {
                                        if (!empty($each_brand)) {
                                            ?>
                                            <?php
                                            $brand_image = Yii::$app->basePath . '/../uploads/cms/brands/' . $each_brand->id . '/small.' . $each_brand->image;
                                            if (file_exists($brand_image)) {
                                                ?>
                                                <div class="one-slide mx-auto">
                                                    <div class="brands text-center d-flex flex-direction-column justify-content-center flex-wrap align-items-center">
                                                        <a href="<?= Yii::$app->homeUrl ?>product/index?brand=<?= $each_brand->brand ?>"><img src="<?= yii::$app->homeUrl; ?>uploads/cms/brands/<?= $each_brand->id ?>/large.<?= $each_brand->image ?>" class="img-fluid"/></a>
                                                    </div>
                                                </div>
                                                <?php
                                            }
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

</div>