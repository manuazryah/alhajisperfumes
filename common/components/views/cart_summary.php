<?php

use yii\helpers\Html;
use common\models\Product;
use common\models\Fregrance;
use common\models\OrderMaster;
use common\models\Settings;
use common\models\Tax;
?>
<div class="checkout-right-box">
    <div class="cart-promotion">
        <div class="coupon">
            <div class="apply-promotion-code">
                <div class="coupon-info">Unlock Offers or Apply promotion</div>
                <div class="code-form">
                    <input type="hidden" name="master_order_id" id="master_order_id" value="<?= $master->id ?>">
                    <input type="text" name="coupon_code" class="input-text" placeholder="Coupon code" id="coupon_code" value="">
                </div>
                <input name="search_keyword-send" type="submit" class="apply apply-coupen" id="search-keyword-submit" value="Apply Promotion">
                <input type="hidden" id="promotion-codes" name="promotion_codes" value="">
                <input type="hidden" id="promotion-code-amount" name="promotion-code-amount" value="">
                <div class="coupon-code-error-msg">
                    <p id="coupon-code-error" style="text-align:left;margin-top:5px;"></p>

                </div>
                <div id="promotions-listing">
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <?php
    $tax_amount = 0;
    foreach ($cart_items as $cart) {
        $tax = 0;
        ?>
        <?php
        $product = Product::findOne($cart->product_id);
        $product_image = Yii::$app->basePath . '/../uploads/product/' . $product->id . '/profile/' . $product->canonical_name . '.' . $product->profile;
        if (file_exists($product_image)) {
            $image = Yii::$app->homeUrl . 'uploads/product/' . $product->id . '/profile/' . $product->canonical_name . '.' . $product->profile;
        } else {
            $image = Yii::$app->homeUrl . 'uploads/product/profile_thumb.png';
        }
        if ($product->offer_price == '0' || $product->offer_price == '') {
            $price = $product->price;
        } else {
            $price = $product->offer_price;
        }
        $total = $price * $cart->quantity;
        $tax = $cart->tax;
        $tax_amount += $tax;
        ?>
        <div class="media cart-table">
            <div class="row">
                <a class="thumbnail pull-left col-xl-3 col-lg-4 col-md-3 col-sm-3 col-3" href=""> 
                    <img class="media-object img-fluid" src="<?= $image ?>">
                </a>
                <div class=" col-xl-9 col-lg-8 col-md-9 col-sm-9 col-9">
                    <div class="product-info">
                        <a class="product-name" href=""><?= $product->product_name ?></a>
                        <div class="row">
                            <div class="col-12">
                                <p class="price">AED <?= sprintf("%0.2f", $cart->rate - $tax) ?></p>
                            </div>
                            <div class="col-12 pad-0">
                                <p>Quantity: <span class="quantity"><?= $cart->quantity ?></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    <?php } ?>
    <div class="total-price-section">
        <div class="row">
            <div class="col-lg-12">
                <div class="col-lg-12">
                    <h4 class="price-head">Subtotal:<span class="cart_subtotal">AED <?= sprintf("%0.2f", $subtotal - $tax_amount) ?></span></h4>
                    <span class="min_ship_amount" style="display:none">99</span>
                    <h4 class="price-head ">SHIPPING:<span class="amount shipping-cost">AED <?= sprintf("%0.2f", $shipping) ?></span></h4>
                    <?php
                    $promotion_disvount = 0;
                    if (isset($promotions) && $promotions > 0) {
                        $promotion_disvount = $promotions;
                        ?>
                        <h4 class="price-head">PROMOTION:<span>AED <?= sprintf("%0.2f", $promotions) ?></span></h4>
                    <?php } ?>
                    <h4 class="price-head">Tax:<span>AED <?= sprintf("%0.2f", $tax_amount) ?></span></h4>
                    <?php
                    if ($master->gift_wrap == 1) {
                        ?>
                        <h4 class="price-head">GIFT WRAP:<span>AED <?= sprintf("%0.2f", $master->gift_wrap_value) ?></span></h4>
                    <?php } ?>
                    <div class="cart-promotions" style="display: none">
                        <h4 class="price-head">Coupon Code:<span class="promotion_discount"></span></h4>
                    </div>
                    <h4 class="price-head total-price">TOTAL:<span class="grand_total checkout-total">AED <?= sprintf("%0.2f", $master->net_amount) ?></span></h4>
                </div>
            </div>
        </div>
    </div>
    <div class="payment-optns">
        <p>Ways you can pay</p>
        <ul>
            <li><img src="<?= Yii::$app->homeUrl ?>images/icons/payment-optns.png" class="img-fluid"></li>
        </ul>
    </div>

    <div class="payment-method">
        <div class="head">Select a Payment Method</div>
        <div class="options">
            <label class="input-style-box">
                <input name="payment_method" checked="" type="radio" value="1" required="">
                <span class="checkmark"></span> <img src="<?= Yii::$app->homeUrl ?>images/icons/cod-pay.png" class="img-fluid">
            </label>
            <div class="cod">
                <div class="title">Cash On Delivery</div>
            </div>
        </div>
        <!--
            <div class="options">
                <label class="input-style-box">
                    <input name="payment_method" type="radio" value="2" required="">
                    <span class="checkmark"></span> <img src="<?= Yii::$app->homeUrl ?>images/icons/master-pay.png" class="img-fluid"> <img src="<?= Yii::$app->homeUrl ?>images/icons/visa-pay.png" class="img-fluid">
                </label>
                <div class="cod">
                    <div class="title">Payment Gateway</div>
                    <div class="info">Lorem Ipsum is simply dummy text of the printing</div>
                </div>
            </div>-->

    </div>
    <div class="form-group">
        <?= Html::submitButton('Confirm Order', ['class' => 'submit bg-blue']) ?>
    </div>
</div>