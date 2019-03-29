<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use common\models\OrderDetails;
use common\models\Product;
use common\models\Fregrance;
use common\models\Settings;

$bill_address = common\models\UserAddress::findOne($model->bill_address_id);
$promotions = \common\models\OrderPromotions::find()->where(['order_master_id' => $model->id])->sum('promotion_discount');
?>
<section class="in-account-pages-section"><!--in-account-pages-section-->
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="my-account-category">
                    <div class="account-top-details">
                        <div class="img-box"><img src="<?= Yii::$app->homeUrl ?>images/icons/account-img.png" width="66" height="66"></div>
                        <h2 class="account-name"><?= Yii::$app->user->identity->first_name ?></h2>
                        <h3 class="account-mail"><?= Yii::$app->user->identity->email ?></h3>
                    </div>
                    <div class="category-list-left">
                        <ul>
                            <li><a href="<?= yii::$app->homeUrl . 'my-account' ?>">My Orders</a></li>
                            <li><a href="<?= yii::$app->homeUrl . 'adresses' ?>">Shipping Addresses</a></li>
                            <li><a href="<?= yii::$app->homeUrl . 'myaccounts/user/wish-list' ?>">Wish Lists</a></li>
                            <li><a href="<?= yii::$app->homeUrl . 'myaccounts/user/personal-info' ?>">Account Settings</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="in-track-your-orders">
                    <div class="head-main-box">
                        <h3 class="head">Order details</h3>
                    </div>
                    <div class="in-order-details">
                        <div class="orders-top-section">
                            <ul>
                                <li class="list">Order ID: <?= $model->order_id ?></li>
                                <li class="list">Order placed on:<b> <?= date('d M Y', strtotime($model->order_date)) ?></b></li>
                                <?php if ($model->admin_status == 4 || $model->admin_status == 6) { ?>
                                    <li class="list">Order Delivered on:<b> <?= date('d M Y', strtotime($model->delivered_date)) ?></b></li>
                                <?php } ?>


                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="sub-order-details">
                            <div class="row">
                                <?php if (!empty($bill_address)) { ?>
                                    <div class="col-md-4">
                                        <h2 class="haed">Receipient</h2>
                                        <ul class="list">
                                            <li><?= $bill_address->name ?></li>
                                            <li><?= $bill_address->address ?></li>
                                            <li><?= $bill_address->landmark ?> </li>
                                            <li><?= $bill_address->location ?> </li>
                                            <li><?= $bill_address->post_code ?></li>
                                            <li><?= $bill_address->country_code ?> - <?= $bill_address->mobile_number ?></li>
                                        </ul>
                                    </div>
                                <?php } ?>
                                <div class="col-md-4">
                                    <h2 class="haed">Order Summary</h2>
                                    <ul class="list">
                                        <li>Subtotal (<?= count($order_details) ?> Items): <?= sprintf('%0.2f', $model->total_amount) ?> AED</li>
                                        <li>Shipping Fees: <?= sprintf('%0.2f', $model->shipping_charge) ?> AED</li>
                                        <?php if (isset($promotions) && $promotions > 0) {
                                            ?>
                                            <li>Promotion Code: <?= sprintf('%0.2f', $promotions) ?> AED</li>
                                        <?php } ?>
                                        <li><b>Grand Total: <?= sprintf('%0.2f', $model->net_amount) ?> AED</b></li>
                                        <li>Order total includes any applicable VAT</li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <h2 class="haed">Payment method</h2>
                                    <ul class="list">
                                        <li><?php
                                            if ($model->payment_mode == '1')
                                                echo $status = 'COD';
                                            else if ($model->payment_mode == '2')
                                                echo $status = 'Credit or Debit Card';
                                            ?></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="in-order-details-product">
                        <div class="head-box">
                            <h3 class="haed">Shipment 1 of 1</h3>
                            <?php
                            if ($model->admin_status == 1) {
                                $order_status = 'Order Placed';
                            } else if ($model->admin_status == 2) {
                                $order_status = 'Order Packed';
                            } else if ($model->admin_status == 3) {
                                $order_status = 'Order Dispatched';
                            } else if ($model->admin_status == 4) {
                                $order_status = 'Order Delivered';
                            } else if ($model->admin_status == 5) {
                                $order_status = 'Cancelled';
                            } else if ($model->admin_status == 0) {
                                $order_status = 'Pending';
                            }
                            if ($model->return_approve == 1 || $model->return_status == 2) {
                                $order_status = 'Returned';
                            }
                            ?>

                            <span class="haed-sub"><?= $order_status ?></span>
                            <div class="clearfix"></div>
                        </div>

                        <?php
                        foreach ($order_details as $order_product) {

                            $product_detail = Product::find()->where(['id' => $order_product->product_id])->one();
                            $product_image = Yii::$app->basePath . '/../uploads/product/' . $product_detail->id . '/profile/' . $product_detail->canonical_name . '.' . $product_detail->profile;
                            if (file_exists($product_image)) {
                                $image = Yii::$app->homeUrl . 'uploads/product/' . $product_detail->id . '/profile/' . $product_detail->canonical_name . '.' . $product_detail->profile;
                            } else {
                                $image = Yii::$app->homeUrl . 'uploads/product/profile_thumb.png';
                            }
                            $fregrance = \common\models\Fregrance::findOne($product_detail->product_type);
                            ?>
                            <div class="order-shipment-product">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <div class="product-img"><img src="<?= $image ?>" width="130" ></div>
                                    </div>
                                    <div class="col-xs-9">
                                        <div class="cont">
                                            <h3 class="head"><?= $product_detail->product_name ?></h3>
                                            <ul>
                                                <li class="quantity">Quantity: <?= $order_product->quantity ?></li>
                                                <?php
                                                if ($product_detail->offer_price > "0") {
                                                    ?>
                                                    <li><span>AED <?= $product_detail->price; ?></span></li>
                                                    <li class="price">AED <?= $product_detail->offer_price; ?></li>
                                                <?php } else { ?>
                                                    <li class="price">AED <?= $product_detail->price; ?></li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php
                        }
                        ?>

                        <div class="total-price-section">
                            <ul class="list">
                                <li>Item(s) Subtotal:	<?= sprintf('%0.2f', $model->total_amount) ?> AED</li>
                                <li>Shipping Fees:	<?= sprintf('%0.2f', $model->shipping_charge) ?> AED</li>
                                <?php if (isset($promotions) && $promotions > 0) {
                                    ?>
                                    <li>Promotion Code: <?= sprintf('%0.2f', $promotions) ?> AED</li>
                                <?php } ?>
                                <li> Amount to be Paid:	<?= sprintf('%0.2f', $model->net_amount) ?> AED</li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>