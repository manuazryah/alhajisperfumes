<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Product;
use common\models\User;

if (isset($meta_title) && $meta_title != '')
    $this->title = $meta_title;
else
    $this->title = 'Shopping Cart';
?>
<div class="top-margin"></div>
<div class="breadcrumb">
    <div class="container">
        <ul>
            <li><?= Html::a('Home', ['/site/index'], ['class' => '']) ?></li>
            <li><a class="current" href="javascript:void(0)">Cart</a></li>
        </ul>
    </div>
</div>

<section id="cart-page">
    <div class="container">
        <div class="row">
            <div class="mobile-cart-view">
                <?php
                foreach ($cart_items as $cart_item) {
                    $prod_details = Product::find()->where(['id' => $cart_item->product_id, 'status' => '1'])->one();
                    if ($prod_details->offer_price == '0' || $prod_details->offer_price == '') {
                        $price = $prod_details->price;
                    } else {
                        $price = $prod_details->offer_price;
                    }
                    $product_image = Yii::$app->basePath . '/../uploads/product/' . $prod_details->id . '/profile/' . $prod_details->canonical_name . '.' . $prod_details->profile;
                    if (file_exists($product_image)) {
                        $image_mob = '<img src="' . Yii::$app->homeUrl . 'uploads/product/' . $prod_details->id . '/profile/' . $prod_details->canonical_name . '.' . $prod_details->profile . '" alt="' . $prod_details->canonical_name . '" class="media-object img-fluid"/>';
                    } else {
                        $image_mob = '<img src="' . Yii::$app->homeUrl . 'uploads/product/profile_thumb.png" alt="" class="media-object img-fluid"/>';
                    }
                    ?>
                    <div class="media cart-table">
                        <div class="row">
                            <div class="col-12">
                                <div class="track">
                                    <a href="" class="remove_cart remove-cart" data-product_id="<?= yii::$app->EncryptDecrypt->Encrypt('encrypt', $cart_item->id); ?>"><i class="far fa-trash-alt"></i></a>
                                </div>
                            </div>
                            <a class="thumbnail pull-left col-4" href="#"> 
                                <?= $image_mob ?>
                            </a>
                            <div class="col-7">
                                <a class="product-name" href=""><?= $prod_details->product_name ?></a>
                                <div class="product-info">
                                    <div class="row">
                                        <div class="col-4 pad-0">
                                            <p><strong>Price</strong></p>
                                        </div>
                                        <div class="col-7">
                                            <?php if ($cart_item->quantity == 0) { ?>
                                                <p class="price-out-of-stock">Out of stock</p>
                                            <?php } else { ?>
                                                <p class="">AED <?= sprintf("%0.2f", $price) ?></p>
                                            <?php }
                                            ?>
                                        </div>
                                        <div class="col-4 pad-0">
                                            <p style="padding: 10px 0px;"><strong>Quantity</strong></p>
                                        </div>
                                        <div class="col-7 text-center">
                                            <div class="quantity">
                                                <input type="number" min="1" max="<?= $prod_details->stock ?>" step="1" id="quantity_<?= yii::$app->EncryptDecrypt->Encrypt('encrypt', $cart_item->id); ?>" class="cart_quantity quantity_<?= yii::$app->EncryptDecrypt->Encrypt('encrypt', $cart_item->id); ?>" value="<?= $cart_item->quantity ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="col-12">
                                <div class="item-total">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-4 pad-0 heading">
                                                <p><strong>Item Total</strong></p>
                                            </div>
                                            <div class="col-7 amount">
                                                <?php $total = $price * $cart_item->quantity; ?>
                                                <p class="text-right total_<?= yii::$app->EncryptDecrypt->Encrypt('encrypt', $cart_item->id) ?>" id="totals_<?= yii::$app->EncryptDecrypt->Encrypt('encrypt', $cart_item->id) ?>">AED <?= sprintf("%0.2f", $total) ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <input type="hidden" id="cart_count" value="<?= count($cart_items); ?>">
            <table class="table cart-table desktop-cart-view">
                <thead>
                    <tr>
                        <th><div class="head-text">Product</div></th>
                        <th><div class="head-text">Price</div></th>
                        <th><div class="head-text">QTY</div></th>
                        <th><div class="head-text">Total</div></th>
                        <th><div class="head-text">Remove</div></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($cart_items as $cart_item) {
                        $prod_details = Product::find()->where(['id' => $cart_item->product_id, 'status' => '1'])->one();
                        if ($prod_details->offer_price == '0' || $prod_details->offer_price == '') {
                            $price = $prod_details->price;
                        } else {
                            $price = $prod_details->offer_price;
                        }
                        $product_image = Yii::$app->basePath . '/../uploads/product/' . $prod_details->id . '/profile/' . $prod_details->canonical_name . '.' . $prod_details->profile;
                        if (file_exists($product_image)) {
                            $image = '<img src="' . Yii::$app->homeUrl . 'uploads/product/' . $prod_details->id . '/profile/' . $prod_details->canonical_name . '.' . $prod_details->profile . '" alt="' . $prod_details->canonical_name . '" width="90"/>';
                        } else {
                            $image = '<img src="' . Yii::$app->homeUrl . 'uploads/product/profile_thumb.png" alt="" width="90"/>';
                        }
                        ?>
                        <tr class="cart_item tr_<?= yii::$app->EncryptDecrypt->Encrypt('encrypt', $cart_item->id); ?>">
                            <td class="td">
                                <div class="row">
                                    <div class="col-sm-4"> <?= $image ?> </div>
                                    <div class="col-sm-8">
                                        <a class="product-name"><?= $prod_details->product_name ?></a>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <?php if ($cart_item->quantity == 0) { ?>
                                    <h3  class="price-out-of-stock">Out of stock</h3 >
                                <?php } else { ?>
                                    <h3  class="price">AED <?= sprintf("%0.2f", $price) ?></h3 >    
                                <?php }
                                ?>
                            </td>
                            <td>
                                <div class="quantity">
                                    <input type="number" min="1" max="<?= $prod_details->stock ?>" step="1" id="quantity_<?= yii::$app->EncryptDecrypt->Encrypt('encrypt', $cart_item->id); ?>" class="cart_quantity quantity_<?= yii::$app->EncryptDecrypt->Encrypt('encrypt', $cart_item->id); ?>" value="<?= $cart_item->quantity ?>">
                                </div>
                            </td>
                            <td>
                                <?php $total = $price * $cart_item->quantity; ?>
                                <h3 class="price total_<?= yii::$app->EncryptDecrypt->Encrypt('encrypt', $cart_item->id) ?>" id="total_<?= yii::$app->EncryptDecrypt->Encrypt('encrypt', $cart_item->id) ?>">AED <?= sprintf("%0.2f", $total) ?></h3>
                            </td>
                            <td><a href="" class="remove_cart remove-cart" data-product_id="<?= yii::$app->EncryptDecrypt->Encrypt('encrypt', $cart_item->id); ?>"><i class="far fa-trash-alt"></i></a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <div class="total-price-section">
                <div class="fright">
                    <div class="row">
                        <div class="col-lg-12">
                            <h4 class="price-head">Subtotal:<span class="cart_subtotal">AED <?= sprintf("%0.2f", $subtotal) ?></span></h4>
                            <?php $shipping_minimum = common\models\Settings::findOne(1)->value; ?>
                            <span class="min_ship_amount" style="display:none"><?= $shipping_minimum ?></span>
                            <?php
                            $balance = '';
                            if ($shipping_minimum > $subtotal) {
                                $balance = $shipping_minimum - $subtotal;
                                $class = '';
                            } else {
                                $class = 'hide';
                            }
                            ?>
                            <h4 class="price-head ">SHIPPING:<span class="amount shipping-cost">AED <?= sprintf("%0.2f", $shipping) ?></span></h4>
                            <h4 class="price-head">GIFT WRAP:<span><input type="checkbox" name="gift-wrap" id="gift-wrap" class="gift-wrap"></span></h4>
                            <h4 class="price-head ">TOTAL:<span class="grand_total">AED <?= sprintf("%0.2f", $grand_total) ?></span></h4>
                            <input type="hidden" class="grand_total_value" value="<?= $grand_total ?>">
                            <input type="hidden" name="subb_total" id="subb_total" value="<?= $subtotal ?>">
                        </div>
                    </div>
                    <div class="button-section ">                                     
                        <?php if (empty(Yii::$app->user->identity)) { ?>
                            <a href="<?= Yii::$app->homeUrl . 'site/login?go=' . Yii::$app->request->hostInfo . Yii::$app->request->url ?>" class="check-utton" id="loginCheckout">Login to Checkout</a>
                        <?php } else { ?>
                            <a href="<?= Yii::$app->homeUrl . 'cart/proceed' ?>" class="check-utton">check out</a>
                        <?php } ?>
                        <?= Html::a('continue shopping', ['/site/index'], ['class' => 'check-utton']) ?>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $giftwrap = \common\models\Settings::findOne(5)->value; ?>
<span class="giftwrap_value" style="display:none"><?= $giftwrap ?></span>
<script>
    $(document).ready(function () {
        $('.gift-wrap').change(function () {
            var id = $(this).attr('id');
            var giftwrap = $('.giftwrap_value').html();
            var ship_charge_gift = $('.min_ship_amount').html();
            var grand = $('.grand_total_value').val();
            if ($("#" + id).prop('checked') == true) {
                $('.gift-wrap').prop('checked', true);
                var value = 1;
            } else {
                $('.gift-wrap').prop('checked', false);
                var value = 0;
            }

            var subtotal = $('#subb_total').val();
            jQuery.ajax({
                url: homeUrl + 'cart/set-gift-wrap',
                type: "post",
                data: {value: value},
                success: function (data) {
                    if (data === '1') {
                        var result = parseFloat(subtotal) + parseFloat(giftwrap);
                        var grand_total = parseFloat(grand) + parseFloat(giftwrap);
                        $('.gift_wrapp').val(1);
                        $('#subb_total').val(result);
                        $('.grand_total').html('AED ' + grand_total.toFixed(2));
                        $('.grand_total_value').val(grand_total);

                    } else {
                        var result = subtotal - parseFloat(giftwrap);
                        var grand_total = parseFloat(grand) - parseFloat(giftwrap);
                        $('.gift_wrapp').val(0);
                        $('#subb_total').val(result);
                        $('.grand_total').html('AED ' + grand_total.toFixed(2));
                        $('.grand_total_value').val(grand_total);
                    }

                }, error: function () {
                }
            });
        });
    });

</script>