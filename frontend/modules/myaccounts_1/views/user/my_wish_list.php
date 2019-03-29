<?php

use yii\helpers\Html;

$product = \common\models\Product::findOne($model->product);
?>
<div class="wish-list-product">
    <div class="remove-button">
        <?= Html::a('', 'javascript:void(0)', ['class' => 'remove-cart remove-wish-list link', 'id' => $product->canonical_name, 'data-val' => $model->id, 'title' => 'Remove From Wish List']) ?>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <?php
            $product_image = Yii::$app->basePath . '/../uploads/product/' . $product->id . '/profile/' . $product->canonical_name . '.' . $product->profile;
            if (file_exists($product_image)) {
                $image = Yii::$app->homeUrl . 'uploads/product/' . $product->id . '/profile/' . $product->canonical_name . '.' . $product->profile;
            } else {
                $image = Yii::$app->homeUrl . 'uploads/product/profile_thumb.png';
            }
            ?>
            <div class="product-img"><img src="<?= $image ?>" width="130" ></div>
        </div>
        <div class="col-sm-9">
            <div class="cont">
                <?= Html::a(substr($product->product_name, 0, 20), ['/product/product_detail', 'product' => $product->canonical_name], ['target' => '_blank', 'title' => $product->product_name, 'class' => 'head']) ?>
                <ul>
                    <?php
                    if ($product->offer_price > "0") {
                        ?>
                        <li class="price">AED <?= $product->offer_price; ?></li>
                    <?php } else { ?>
                        <li class="price">AED <?= $product->price; ?></li>
                    <?php } ?>
                    <?php if ($product->stock_availability == 1 && $product->stock > 0) { ?>
                        <input type="hidden" id="quantity" value="1">
                        <li> <?= Html::a('Add to cart', 'javascript:void(0)', ['class' => 'add-cart add-to-cart', 'id' => $product->canonical_name, 'data-val' => $model->id]) ?></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<style>
    .summary{
        display: none;
    }
</style>