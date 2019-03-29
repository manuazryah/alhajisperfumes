<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="col-xl-2 col-lg-3 col-md-3 col-sm-6 col-12">
    <div class="product-box">
        <div class="product">
            <?php
            if ($product_details->offer_price != "0" && isset($product_details->offer_price)) {
                $percentage = round(100 - (($product_details->offer_price / $product_details->price) * 100));
                $main_price = $product_details->offer_price;
                $price = 'AED ' . $product_details->price;
                ?>
                <div class="off-tag"><span><?= $percentage ?>%</span>off</div>
                <?php
            }else {
                $main_price = $product_details->price;
                $price = '.';
            }
            ?>
            <?php
            $product_image = Yii::$app->basePath . '/../uploads/product/' . $product_details->id . '/profile/' . $product_details->canonical_name . '_big.' . $product_details->profile;
            if (file_exists($product_image)) {
                $image_src = Yii::$app->homeUrl . 'uploads/product/' . $product_details->id . '/profile/' . $product_details->canonical_name . '_big.' . $product_details->profile;
            } else {
                $image_src = Yii::$app->homeUrl . 'uploads/product/gallery_dummy.png';
            }
            ?>
            <div class="img-box">
                <?= Html::a('<img  class="img-fluid" src="' . $image_src . '" alt="' . $product_details->canonical_name . '" />', ['product/product-detail', 'product' => $product_details->canonical_name], ['title' => $product_details->product_name]) ?>
            </div>
            <input type="hidden" id="quantity" value="1">
            <div class="product-info">
                <?php
                if (strlen($product_details->product_name) > 35) {
                    $pname = substr(strtolower($product_details->product_name), 0, 35) . "..";
                } else {
                    $pname = strtolower($product_details->product_name);
                }
                ?>
                <?= Html::a('<p class="product-name">' . ucwords($pname) . '</p>', ['product/product-detail', 'product' => $product_details->canonical_name], ['title' => $product_details->product_name]) ?>
                <h5 class="price">AED <?= $main_price; ?></h5>
                <?php
                if ($product_details->offer_price != "0" && isset($product_details->offer_price)) {
                    $percentage = round(100 - (($product_details->offer_price / $product_details->price) * 100));
                    ?>
                    <span class="actual-price">AED <?= $product_details->price; ?></span>
                    <?php
                }
                ?>
            </div>
            <div class="product-button">
                <button class="add-2-cart add-cart" type="button" data-placement="left" title="Buynow" pro_id="<?= $product_details->canonical_name ?>">Add to cart</button>
            </div>
        </div>
    </div>
</div>