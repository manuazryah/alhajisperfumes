<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use common\models\OrderDetails;
use common\models\Product;
use common\models\Fregrance;
use common\models\Settings;

$order_products = OrderDetails::find()->where(['order_id' => $model->order_id])->all();
$bill_address = common\models\UserAddress::findOne($model->bill_address_id);
?>
<?php if (isset($model->return_status) && $model->return_status == 1 || $model->return_status == 2) { ?>
    <div class="orders-main-box">
        <div class="orders-top-section">
            <div class="row">
                <div class="col-md-6">
                    <ul>
                        <li class="list">Order placed on:<b> <?= date('d M Y', strtotime($model->order_date)) ?></b></li>
                        <li class="list">Order ID: <?= $model->order_id ?></li>
                        <li class="list"> <?= Html::a('Order details', ['/myaccounts/my-orders/order-details', 'orderid' => $model->order_id], ['class' => 'link']) ?></li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <ul>
                        <?php if (!empty($bill_address)) { ?>
                            <li class="list">Recipient: <?= $bill_address->name ?></li>
                        <?php } ?>
                        <li class="list">Payment method: <?php
                            if ($model->payment_mode == '1')
                                echo $status = 'COD';
                            else if ($model->payment_mode == '2')
                                echo $status = 'Credit or Debit Card';
                            ?></li>
                        <li class="list">Total: <b><?= sprintf('%0.2f', $model->net_amount) ?>  AED</b></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="order-shipment">
            <h2 class="sub-head">SHIPMENT 1 OF 1</h2>
            <div class="order-tracker-box">
                <div class="row">
                    <div class="col-4">
                        <div class="no-box">01</div>
                        <h4 class="text-box">Ready for Shipping</h4>
                    </div>
                    <div class="col-4">
                        <div class="no-box return-box"></div>
                        <h4 class="text-box">
                            <?php
                            if ($model->return_approve == 1 && $model->return_status == 1) {
                                $return_status = 'Returned';
                            } else if ($model->return_approve == 2 && $model->return_status == 1) {
                                $return_status = 'Return Disapproved';
                            } else if ($model->return_approve == 0 && $model->return_status == 1) {
                                $return_status = 'Wait for Return Approve';
                            } else if ($model->return_status == 2) {
                                $return_status = 'Admin Returned';
                            }
                            ?>
                            <?= $return_status ?></h4>
                        </h4>
                    </div>
                    <div class="col-4">
                        <div class="no-box">03</div>
                        <h4 class="text-box">Delivered</h4>
                    </div>
                </div>
            </div>
        </div>
        <?php
        foreach ($order_products as $order_product) {

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
                        <div class="product-img"><img src="<?= $image ?>" width="60" ></div>
                    </div>
                    <div class="col-xs-9">
                        <div class="cont">
                            <h3 class="head"><?= $product_detail->product_name ?></h3>
                            <ul>
                                <?php if (isset($fregrance) && $fregrance->name != '') { ?>
                                    <li>Fragrance: <?= $fregrance->name; ?></li>
                                <?php } ?>
                            </ul>
                            <h4 class="canceled-text"><?= ($model->return_approve == 1 || $model->return_status == 2) ? 'Returned' : '' ?></h4>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
    <?php
}
?>
<?php if ($model->return_status == 0 && $model->admin_status !== 5) { ?>
    <div class="orders-main-box">
        <div class="orders-top-section">
            <div class="row">
                <div class="col-md-6">
                    <ul>
                        <li class="list">Order placed on:<b> <?= date('d M Y', strtotime($model->order_date)) ?></b></li>
                        <li class="list">Order ID: <?= $model->order_id ?></li>
                        <li class="list"> <?= Html::a('Order details', ['/myaccounts/my-orders/order-details', 'orderid' => $model->order_id], ['class' => 'link']) ?></li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <ul>
                        <?php if (!empty($bill_address)) { ?>
                            <li class="list">Recipient: <?= $bill_address->name ?></li>
                        <?php } ?>
                        <li class="list">Payment method: <?php
                            if ($model->payment_mode == '1')
                                echo $status = 'COD';
                            else if ($model->payment_mode == '2')
                                echo $status = 'Credit or Debit Card';
                            ?></li>
                        <li class="list">Total: <b><?= sprintf('%0.2f', $model->net_amount) ?>  AED</b></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="order-shipment">
            <h2 class="sub-head">SHIPMENT 1 OF 1</h2>
            <div class="order-tracker-box">
                <div class="row">
                    <div class="col-4">
                        <div class="no-box <?= ($model->admin_status == 0 || $model->admin_status == 1 || $model->admin_status == 2) ? 'active' : '' ?>">01</div>
                        <h4 class="text-box">Ready for Shipping</h4>
                    </div>
                    <div class="col-4">
                        <div class="no-box <?= $model->admin_status == 3 ? 'active' : '' ?>">02</div>
                        <h4 class="text-box">Out for delivery</h4>
                    </div>
                    <div class="col-4">
                        <div class="no-box <?= $model->admin_status == 4 ? 'active' : '' ?>">03</div>
                        <h4 class="text-box">Delivered</h4>
                    </div>
                </div>
            </div>
        </div>
       
            <?php
            foreach ($order_products as $order_product) {
                $product_detail = Product::find()->where(['id' => $order_product->product_id])->one();
                if ($product_detail) {
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
                            <div class="product-img"><img src="<?= $image ?>"></div>
                        </div>
                        <div class="col-xs-9">
                            <div class="cont">
                                <h3 class="head"><?= $product_detail->product_name ?></h3>
                                <ul>
                                    <?php if (isset($fregrance) && $fregrance->name != '') { ?>
                                        <li>Fragrance: <?= $fregrance->name; ?></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
 <?php } ?>
                <?php
            }
            ?>
            
        <div class="more-box-order-button">
            <ul>
                <?php if ($model->admin_status == 4 && $model->return_status == 0) { ?>
                    <?php
                    $now = time(); // or your date as well
                    $your_date = strtotime($model->delivered_date);
                    $datediff = $now - $your_date;
                    $diff = round($datediff / (60 * 60 * 24));
                    if ($diff < 14) {
                        ?>
                        <li><a href="#returnModal" class="button-box order_return" id="<?= $model->order_id ?>" ordr="<?= yii::$app->EncryptDecrypt->Encrypt('encrypt', $model->order_id) ?>" data-toggle="modal">Return Order</a></li>
                        <?php
                    }
                }
                ?>
                <?php if ($model->status != 5 && $model->admin_status != 4 && $model->admin_status != 5) { ?>
                    <li><?= Html::a('Cancel', ['/myaccounts/my-orders/cancel-order', 'id' => $model->order_id], ['class' => 'button-box button-box-red', 'onclick' => "return confirm('Are you sure want to cancel the Order?');"]) ?></li>
                <?php } ?>
            </ul>
            <div class="clearfix"></div>
        </div>
    </div>
    <?php
}
?>
<?php if ($model->admin_status == 5) { ?>
    <div class="orders-main-box">
        <div class="orders-top-section">
            <div class="row">
                <div class="col-md-6">
                    <ul>
                        <li class="list">Order placed on:<b> <?= date('d M Y', strtotime($model->order_date)) ?></b></li>
                        <li class="list">Order ID: <?= $model->order_id ?></li>
                        <li class="list"> <?= Html::a('Order details', ['/myaccounts/my-orders/order-details', 'orderid' => $model->order_id], ['class' => 'link']) ?></li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <ul>
                        <?php if (!empty($bill_address)) { ?>
                            <li class="list">Recipient: <?= $bill_address->name ?></li>
                        <?php } ?>
                        <li class="list">Payment method: <?php
                            if ($model->payment_mode == '1')
                                echo $status = 'COD';
                            else if ($model->payment_mode == '2')
                                echo $status = 'Credit or Debit Card';
                            ?></li>
                        <li class="list">Total: <b><?= sprintf('%0.2f', $model->net_amount) ?>  AED</b></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="order-shipment">
            <h2 class="sub-head">SHIPMENT 1 OF 1</h2>
            <div class="order-tracker-box">
                <div class="row">
                    <div class="col-4">
                        <div class="no-box active-canceled">01</div>
                        <h4 class="text-box">Canceled</h4>
                    </div>
                    <div class="col-4">
                        <div class="no-box">02</div>
                    </div>
                    <div class="col-4">
                        <div class="no-box">03</div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        foreach ($order_products as $order_product) {

            $product_detail = Product::find()->where(['id' => $order_product->product_id])->one();
            if ($product_detail) {
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
                        <div class="product-img"><img src="<?= $image ?>"></div>
                    </div>
                    <div class="col-xs-9">
                        <div class="cont">
                            <h3 class="head"><?= $product_detail->product_name ?></h3>
                            <ul>
                                <?php if (isset($fregrance) && $fregrance->name != '') { ?>
                                    <li>Fragrance: <?= $fregrance->name; ?></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
          <?php }?>
            <?php
        }
        ?>
        <div class="more-box-order-button">
            <ul>
                <!--<li><a href="#exampleModal" class="button-box" data-toggle="modal">Leave a feedback</a></li>-->
                <li><a href="#" class="button-box button-box-red">Canceled</a></li>
            </ul>
            <div class="clearfix"></div>
        </div>
    </div>
<?php } ?>
<div class="feedback-popup">
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h4 class="modal-title">Leave a feedback</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <form>
                    <div class="form-box">
                        <input name="" type="text" class="form-control" placeholder="Title">
                        <textarea name="" cols="" rows="" class="form-control" placeholder="Your Review"></textarea>
                        <input name="" type="submit" value="SEND" class="submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="returnModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Return Order - <span class="order_id"></span></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form class="form">
                    <textarea class="form-control return_reason" rows="6" placeholder="Reason for return" required></textarea>
                    <input type="hidden" class="return-order_id" >
                    <span class="return_error error"></span>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary return_confirm" >Return</button>
            </div>
        </div>

    </div>
</div>
<style>
    .summary{
        display: none;
    }
</style>
