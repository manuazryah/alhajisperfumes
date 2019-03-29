<?php

use common\components\RecentlyViewedWidget;
use common\components\ProductLinksWidget;
use common\models\Product;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use common\models\RecentlyViewed;
?>
<div id="wpo-mainbody" class="container wpo-mainbody">

    <nav class="woocommerce-breadcrumb" itemprop="breadcrumb"><?= Html::a('Home', ['/site/index']) ?>&nbsp;/&nbsp;Product&nbsp;/&nbsp;<?= $product_details->product_name ?></nav>
    <div class="row">
        <section id="product" class="col-md-12  no-sidebar-right">



            <div class="alerts alert-success success-alert-product-detail alert_<?= $product_details->canonical_name ?> hide">
                <div class="col-md-8"><p class="text-success"> <?= $product_details->product_name ?></p></div>
                <div class="col-md-4"><a href="<?= Yii::$app->homeUrl . 'cart/proceed' ?>" class="button wc-forward">  Proceed To Checkout</a></div>
                <a class="close-alert"><i class="fa fa-close"></i></a>
                <div class="clearfix"></div>
            </div>

            <div itemscope="" itemtype="h" id="product-page" class="product-info post-113 product type-product status-publish has-post-thumbnail product_cat-men product_cat-shirt product_cat-top product_tag-dummy featured shipping-taxable product-type-external product-cat-men product-cat-shirt product-cat-top product-tag-dummy instock">
                <div id="single-product" class="row box-element">
                    <div class="col-md-5">
                        <div class="images">

                            <div class="yith_magnifier_zoom_wrap"><div class="yith_magnifier_zoom_wrap"><div class="yith_magnifier_zoom_wrap"><div class="yith_magnifier_zoom_wrap"><div class="yith_magnifier_zoom_wrap"><div class="yith_magnifier_zoom_wrap"><div class="yith_magnifier_zoom_wrap"><div class="yith_magnifier_zoom_wrap"><div class="yith_magnifier_zoom_wrap"><div class="yith_magnifier_zoom_wrap"><div class="yith_magnifier_zoom_wrap"><div class="yith_magnifier_zoom_wrap">
                                                                            <?php
                                                                            $product_image = Yii::$app->basePath . '/../uploads/product/' . $product_details->id . '/profile/' . $product_details->canonical_name . '.' . $product_details->profile;

                                                                            if (file_exists($product_image)) {
                                                                                ?>
                                                                                <a href="<?= Yii::$app->homeUrl . 'uploads/product/' . $product_details->id . '/profile/' . $product_details->canonical_name . '_big.' . $product_details->profile ?>" itemprop="image" class="yith_magnifier_zoom woocommerce-main-image" title="product1">
                                                                                    <img src="<?= Yii::$app->homeUrl . 'uploads/product/' . $product_details->id . '/profile/' . $product_details->canonical_name . '_big.' . $product_details->profile ?>" class="attachment-shop_single wp-post-image" alt="product13"></a>
                                                                            <?php } else { ?>
                                                                                <a href="<?= Yii::$app->homeUrl . 'uploads/product/gallery_dummy.png' ?>?scale.height='400'" itemprop="image" class="yith_magnifier_zoom woocommerce-main-image" title="product1">
                                                                                    <img src="<?= Yii::$app->homeUrl . 'uploads/product/gallery_dummy.png' ?>?scale.height='400'" class="attachment-shop_single wp-post-image" alt="product13"></a>
                                                                            <?php } ?>
                                                                            <div class="yith_magnifier_mousetrap" style="width: 100%; height: 100%; top: 0px; left: 0px;"></div><div class="yith_magnifier_mousetrap" style="width: 100%; height: 100%; top: 0px; left: 0px;"></div><div class="yith_magnifier_mousetrap" style="width: 100%; height: 100%; top: 0px; left: 0px;"></div><div class="yith_magnifier_mousetrap" style="width: 100%; height: 100%; top: 0px; left: 0px;"></div><div class="yith_magnifier_mousetrap" style="width: 100%; height: 100%; top: 0px; left: 0px;"></div><div class="yith_magnifier_mousetrap" style="width: 100%; height: 100%; top: 0px; left: 0px; cursor: pointer;"></div></div></div></div></div></div></div></div></div></div></div></div></div>
                            <div class="thumbnails slider">
                                <div class="caroufredsel_wrapper" style="display: block; text-align: center; float: none; position: relative; top: auto; right: auto; bottom: auto; left: auto; z-index: auto; height: 150px; margin: 0px; overflow: hidden;">
                                    <ul class="yith_magnifier_gallery" style="text-align: left; float: none; position: absolute; top: 0px; right: auto; bottom: auto; left: 0px; margin: 0px; width: 2130px; height: 150px; z-index: auto;">
                                        <?php if (file_exists($product_image)) { ?>
                                            <li class="yith_magnifier_thumbnail" style="width: 142px;"><a href="<?= Yii::$app->homeUrl . 'uploads/product/' . $product_details->id . '/profile/' . $product_details->canonical_name . '_big.' . $product_details->profile ?>" class="yith_magnifier_thumbnail first" title="product1" data-small="<?= Yii::$app->homeUrl . 'uploads/product/' . $product_details->id . '/profile/' . $product_details->canonical_name . '_big.' . $product_details->profile ?>"><img src="<?= Yii::$app->homeUrl . 'uploads/product/' . $product_details->id . '/profile/' . $product_details->canonical_name . '_big.' . $product_details->profile ?>" class="attachment-shop_thumbnail gallery_thumb" alt="product1"></a></li>

                                            <?php
                                        }
                                        $path = Yii::getAlias('@paths') . '/product/' . $product_details->id . '/gallery_thumb';
                                        if (count(glob("{$path}/*")) > 0) {
                                            foreach (glob("{$path}/*") as $file) {

                                                $arry = explode('/', $file);
                                                $img_nmee = end($arry);
                                                $img_nmees = explode('.', $img_nmee);
                                                if ($img_nmees['1'] != '') {
                                                    ?>
                                                    <li class="yith_magnifier_thumbnail first" style="width: 142px;">
                                                        <a href="<?= Yii::$app->homeUrl . 'uploads/product/' . $product_details->id . '/gallery/' . end($arry) ?>" class="yith_magnifier_thumbnail first" title="product1" data-small="<?= Yii::$app->homeUrl . 'uploads/product/' . $product_details->id . '/gallery/' . end($arry) ?>">
                                                            <img  src="<?= Yii::$app->homeUrl . 'uploads/product/' . $product_details->id . '/gallery/' . end($arry) ?>" class="attachment-shop_thumbnail gallery_thumb" alt="product1">
                                                        </a>
                                                    </li>
                                                    <?php
                                                }
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>

                                <div id="slider-prev" class="" style="display: block;"></div>
                                <div id="slider-next" class="" style="display: block;"></div>
                            </div>

                        </div>


                        <script type="text/javascript" charset="utf-8">
                            var yith_magnifier_options = {

                                enableSlider: true,
                                sliderOptions: {
                                    responsive: true,
                                    circular: true,
                                    infinite: true,
                                    direction: 'left',
                                    debug: false,
                                    auto: false,
                                    align: 'left',
                                    prev: {
                                        button: "#slider-prev",
                                        key: "left"
                                    },
                                    next: {
                                        button: "#slider-next",
                                        key: "right"
                                    },
                                    //width   : 618,
                                    scroll: {
                                        items: 1,
                                        pauseOnHover: true
                                    },
                                    items: {
                                        //width: 104,
                                        visible: 3}
                                },
                                showTitle: false,
                                zoomWidth: 'auto',
                                zoomHeight: 'auto',
                                position: 'right',
                                //tint: ,
                                //tintOpacity: ,
                                lensOpacity: 0.5,
                                softFocus: false,
                                //smoothMove: ,
                                adjustY: 0,
                                disableRightClick: false,
                                phoneBehavior: 'default',
                                loadingLabel: 'Loading...'
                            };
                        </script>        </div>
                    <div class="col-md-7">
                        <div>
                            <h1 itemprop="name" class="heading_title product_title entry-title detail_title"><?= $product_details->product_name ?></h1>
                            <div class="col-md-7 ">
                                <div class="summary entry-summary">

                                    <div class="woocommerce-product-rating" itemprop="aggregateRating" itemscope="" itemtype="">
                                        <div class="product_meta">
                                            <?php
                                            if (isset($product_details->brand)) {
                                                $brand = common\models\Brand::findOne($product_details->brand);
                                                ?>
                                                <div class="posted_in">Brand: <a href="<?= Yii::$app->homeUrl . 'product/brand?brand=' . $brand->brand ?>"><?= $brand->brand ?>.</a></div>
                                            <?php }
                                            ?>
                                            <!--<div class="tagged_as">Tag: <a href="" rel="tag">Dummy</a>.</div>-->

                                        </div>

                                        <?php if (isset($product_details->product_type)) { ?>
                                            <div class="product_meta">
                                                <?php
                                                $fregrance = \common\models\Fregrance::findOne($product_details->product_type);
                                                ?>
                                                <div class="posted_in">Fragrance Type: <a href="<?= Yii::$app->homeUrl . 'product/fragrance?fragrance=' . $fregrance->name ?>"><?= $fregrance->name; ?>.</a></div>

                                                <!--<div class="tagged_as">Tag: <a href="" rel="tag">Dummy</a>.</div>-->

                                            </div>
                                        <?php } ?>

                                        <?php if (isset($product_details->size)) { ?>
                                            <div class="product_meta">
                                                <?php
                                                $unit = \common\models\Unit::findOne($product_details->size_unit);
                                                ?>
                                                <div class="posted_in">Size: <?= $product_details->size . ' ' . $unit->unit_name ?></div>

                                                <!--<div class="tagged_as">Tag: <a href="" rel="tag">Dummy</a>.</div>-->

                                            </div>
                                        <?php } ?>
                                        <?php if (isset($product_details->ean_type)) { ?>
                                            <div class="product_meta">
                                                <?php $head = $product_details->ean_type == '1' ? 'Product Code' : 'Product Code'; ?>
                                                <div class="posted_in"><?= $head ?>: <?= $product_details->ean_value ?></div>
                                            </div>
                                        <?php } ?>
                                        <?php if (isset($product_details->gender_type)) { ?>
                                            <div class="product_meta">
                                                <?php
                                                if ($product_details->gender_type == '0') {
                                                    $head = 'Men';
                                                } elseif ($product_details->gender_type == '1') {
                                                    $head = 'Women';
                                                } elseif ($product_details->gender_type == '2') {
                                                    $head = 'Unisex';
                                                } elseif ($product_details->gender_type == '3') {
                                                    $head = 'Oriental';
                                                }
                                                ?>
                                                <div class="posted_in">Targeted Group: <?= $head ?></div>
                                            </div>
                                        <?php } ?>

                                        <!--                                <div class="star-rating" title="Rated 4.00 out of 5">
                                        <?php $stock_color = 'color:red' ?>
                                                                            <span style="font-size: 11px;width:80%; <?= $product_details->stock > 0 ? '' : $stock_color ?>">
                                                                                <strong itemprop="ratingValue" class="rating"><?= $product_details->stock > 0 ? $product_details->stock : 'No Stock' ?></strong> Available
                                                                            </span>
                                                                        </div>-->
                                        <?php // if (!empty($product_reveiws)) {    ?>
                                            <!--<a href="#reviews" class="woocommerce-review-link" rel="nofollow">(<span itemprop="ratingCount" class="count"><?= count($product_reveiws) ?></span> customer reviews)</a>-->
                                        <?php // }    ?>
                                    </div>

                                    <div>

                                        <?php
                                        if ($product_details->offer_price != "0" && isset($product_details->offer_price)) {
                                            $percentage = round(100 - (($product_details->offer_price / $product_details->price) * 100));
                                            $main_price = $product_details->offer_price;
                                            $price = 'AED ' . $product_details->price;
                                            ?>
                                                                                                                <!--<div class="product-off"><b><? $percentage ?>%</b><br />off</div>-->
                                            <?php
                                        } else {
                                            $main_price = $product_details->price;
                                            $price = '';
                                        }
                                        ?>
                                        <div class="mobile-view-price-section">
                                            <p class="price product_detail_price ">
                                                <span class="amount">AED <?= $main_price ?></span>
                                            </p>
                                            <p>
                                                <?php if ($product_details->offer_price != "0" && isset($product_details->offer_price)) { ?>
                                                    <label>
                                                        <span class="was">was</span><small class="small-price amount"><?= $price ?></small>
                                                        <label class="product_percentage"><?= $percentage ?>% OFF</label>
                                                    </label>
                                                <?php } ?>
                                            </p>
                                        </div>


                                        <p class="price product_detail_price hidden-xs"><span class="amount">AED <?= $main_price ?></span> <?php if ($product_details->offer_price != "0" && isset($product_details->offer_price)) { ?><span class="was">was</span><small class="small-price amount"><?= $price ?></small><label class="product_percentage"><?= $percentage ?>% OFF</label><?php } ?></p>
                                        <span class="vat">Inclusive of VAT</span>

                                        <meta itemprop="price" content="35">
                                        <meta itemprop="priceCurrency" content="GBP">
                                        <link itemprop="availability" href="">

                                    </div>

                                    <div class="wish-list-popup alert-success alert_<?= $model->canonical_name ?> hide" >
                                    </div>
                                    <div class="action">
                                        <?php if ($product_details->stock > 0) { ?>
                                            <select  class="q_ty" name="quantity" id="quantity">
                                                <?php
                                                for ($i = 1; $i <= $product_details->stock; $i++) {
                                                    ?>
                                                    <option value="<?= $i ?>"><?= $i ?></option>
                                                <?php } ?>




                                            </select>
                                        <?php } ?>
                                        <?= Html::a('', '#', ['class' => 'wish-list-button add_to_wish_list', 'id' => $product_details->canonical_name]) ?>
                                        <div class="clearfix"></div>

                                    </div>
                                    <?php if ($product_details->stock > 0) { ?>
                                        <div class="enjoy-next-day">
                                            <p>Enjoy Next Business Day Delivery <br />Order Before <span>2: 00 PM</span></p>
                                        </div>
                                        <div class="product-details-button">

                                            <?= Html::a('Add <i class="fa fa-cart-plus" aria-hidden="true" style="font-size: 16px;"></i>', '#', ['class' => 'button_shop add-cart mobile-buy-now', 'id' => $product_details->canonical_name]) ?>

                                            <?= Html::a('buy now', 'javascript:void(0)', ['class' => 'button_shop buy_now mobile-buy-now', 'id' => $product_details->canonical_name]) ?>
                                        </div>
                                    <?php } ?>

                                    <div class="clear"></div>



                                    <!--<a href="" class="compare button add-cart" data-product_id="113">Add To Cart</a>-->

                                </div><!-- .summary -->


                            </div>
                            <div class="col-md-5 ">
                                <ul class="in-product-components">
                                    <li>
                                        <div class="icon-components"> </div>
                                        <span>Fast Shipping</span><small>Receive products in amazing time</small>

                                    </li>
                                    <li>
                                        <div class="icon-components icon-2"></div>
                                        <span>Always Authentic</span><small>We only sell 100% authentic products</small>

                                    </li>
                                    <li>
                                        <div class="icon-components icon-3"></div>
                                        <span>SECURE SHOPPING</span><small>Your data is always protected</small>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>







            </div>
        </section>
        <!--/*////////////////////////*-->
        <?php if (!empty($product_details->related_product)) { ?>
            <section class=" box-element">
                <div class="container">
                    <div class="row">
                        <div class="vc_col-sm-12 wpb_column vc_column_container">
                            <div class="wpb_wrapper">
                                <div class="woocommerce">
                                    <div class="box-heading">
                                        <span>Related Products</span>
                                    </div>

                                    <div class="box-content">
                                        <div class="box-products slide" id="category_related">
                                            <div class="carousel-controls">
                                                <a class="carousel-control left" href="#category_related" data-slide="prev">Prev</a>
                                                <a class="carousel-control right" href="#category_related" data-slide="next">Next</a>
                                            </div>
                                            <div class="carousel-inner">
                                                <div class="item active">
                                                    <div class="row">
                                                        <!-- Product Item -->
                                                        <?php
                                                        $related_products = explode(',', $product_details->related_product);
                                                        $l = 0;
                                                        $count = count($related_products);
                                                        foreach ($related_products as $latest_arrive) {
                                                            $l++;
//                                                            foreach ($latest as $latest_arrive) {
                                                            $model = \common\models\Product::findOne($latest_arrive);
                                                            if (isset($model->stock) && $model->stock != '')
                                                                $stock = $model->stock;
                                                            else
                                                                $stock = '';
                                                            if ($latest_arrive != '' && $stock > 0) {
                                                                if ($l % 5 == 1) {
                                                                    $class = 1;
                                                                } else if ($l == $count) {
                                                                    $class = 0;
                                                                } else {
                                                                    $class = '';
                                                                }
                                                                ?>

                                                                <?= ProductLinksWidget::widget(['id' => $latest_arrive, 'first' => $class]) ?>
                                                                <?php
                                                                if ($l % 5 == 0) {
                                                                    if ($l != $count) {
//
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="item">

                                                                    <div class="row">
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

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php } ?>

        <!--/*////////////////////////*-->


        <?php
        if (isset(Yii::$app->user->identity->id)) {
            $recently_viewed = RecentlyViewed::find()->where(['user_id' => Yii::$app->user->identity->id])->orderBy(['id' => SORT_DESC])->offset(1)->limit(10)->all();
        } else if (isset(Yii::$app->session['temp_user_product']) || Yii::$app->session['temp_user_product'] != '') {
            $recently_viewed = RecentlyViewed::find()->where(['session_id' => Yii::$app->session['temp_user_product']])->orderBy(['id' => SORT_DESC])->offset(1)->limit(10)->all();
        }
        ?>
        <?php if (!empty($recently_viewed)) { ?>
            <section class=" box-element">
                <div class="container">
                    <div class="row">
                        <div class="vc_col-sm-12 wpb_column vc_column_container">
                            <div class="wpb_wrapper">
                                <div class="woocommerce">
                                    <div class="box-heading">
                                        <span>Recently Viewed</span>
                                    </div>

                                    <div class="box-content">
                                        <div class="box-products slide" id="category_related">
                                            <div class="carousel-controls">
                                                <a class="carousel-control left" href="#category_related" data-slide="prev">Prev</a>
                                                <a class="carousel-control right" href="#category_related" data-slide="next">Next</a>
                                            </div>
                                            <div class="carousel-inner">
                                                <div class="item active">
                                                    <div class="row">
                                                        <!-- Product Item -->
                                                        <?php
                                                        $f = 0;
                                                        $k = 1;
                                                        $l = 0;
                                                        $count = count($recently_viewed);
                                                        foreach ($recently_viewed as $latest_arrive) {
                                                            $l++;
//                                                            foreach ($latest as $latest_arrive) {
                                                            $model = \common\models\Product::findOne($latest_arrive);
                                                            if ($latest_arrive != '' && $model->stock > 0) {
                                                                if ($l % 5 == 1) {
                                                                    $class = 1;
                                                                } else if ($l == $count) {
                                                                    $class = 0;
                                                                } else {
                                                                    $class = '';
                                                                }
                                                                ?>

                                                                <?= ProductLinksWidget::widget(['id' => $latest_arrive, 'first' => $class]) ?>
                                                                <?php
                                                                if ($l % 5 == 0) {
                                                                    if ($l != $count) {
//
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="item">

                                                                    <div class="row">
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

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php } ?>
    </div>
</div>


<script>
    jQuery(document).on('submit', '#commentform', function (e) {

        var str = jQuery(this).serialize();
        jQuery.ajax({
            url: '<?= Yii::$app->homeUrl; ?>product/save-review',
            type: "POST",
            data: str,
            success: function (data) {
                jQuery('#comment').val('');
                $('#review-flash').show();
            }
        });
        return false;

    });
</script>
