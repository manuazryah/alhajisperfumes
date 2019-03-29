<?php

use yii\helpers\Html;
use common\models\OrderDetails;
use common\models\OrderMaster;
use common\models\Product;
//use common\models\Fregrance;
use common\models\Settings;
use common\models\OrderPromotions;

//use common\models\Tax;

$order_products = OrderDetails::find()->where(['order_id' => $orderid])->all();

$order_master = OrderMaster::find()->where(['order_id' => $orderid])->one();
$promotions = OrderPromotions::find()->where(['order_master_id' => $order_master->id])->sum('promotion_discount');
$user_detail = common\models\User::findOne($order_master->user_id);
?>
<style>
    table td{
        padding: 5px 0px;
    }
</style>
<div style="margin: 10px 15px;">
    <h4>Dear <?= $user_detail->first_name . ' ' . $user_detail->last_name ?>,</h4>
    <p>Thank you for placing your order with Al Hajis Perfumes. Here is a summary of your purchase.</p>
    <div class="order-details">
        <hr style="border: .5px solid rgb(223, 223, 223);">
        <div style="width: 60%;display: inline-block;float: left;">
            <table>
                <tr>
                    <td>Order No</td>
                    <td> : </td>
                    <td>#<?= $order_master->order_id ?></td>
                </tr>
                <tr>
                    <td>Order Date</td>
                    <td> : </td>
                    <td><?= date('d-m-Y H:i:A', strtotime($order_master->order_date)) ?></td>
                </tr>
                <tr>
                    <td>Payment Method</td>
                    <td> : </td>
                    <td><?= $payment_status ?></td>
                </tr>
            </table>
        </div>
        <div style="width: 40%;display: inline-block;float: left;">
            <?php
            $bill_address = \common\models\OrderAddress::find()->where(['order_id' => $order_master->order_id])->one();
            if (!empty($bill_address)) {
                ?>
                <p>Your order will be sent to: </p>
                <table>
                    <tr>
                        <td><?= $bill_address->address ?></td>
                    </tr>
                    <tr>
                        <td><?= $bill_address->location ?></td>
                    </tr>
                    <tr>
                        <td><?= $bill_address->landmark ?></td>
                    </tr>
                    <tr>
                        <td>Tel : <?= $bill_address->mobile_number ?></td>
                    </tr>
                </table>
                <?php
            }
            ?>
        </div>
        <hr style="border: .5px solid rgb(223, 223, 223);">
        <div class="order-summery">
            <h4>Order Details</h4>
            <hr style="border: .5px solid rgb(223, 223, 223);">
            <?php
            $tax_amount = 0;
            $count = count($order_products);
            $total_amount = 0;
            $p = 0;
            foreach ($order_products as $order_product) {
                $p++;
                $tax = 0;

                $product_detail = Product::find()->where(['id' => $order_product->product_id])->one();
                $product_image = Yii::$app->basePath . '/../uploads/product/' . $product_detail->id . '/profile/' . $product_detail->canonical_name . '.' . $product_detail->profile;
                if (file_exists($product_image)) {
                    $image = 'http://' . Yii::$app->request->serverName . '/alhajis/uploads/product/' . $product_detail->id . '/profile/' . $product_detail->canonical_name . '_thumb.' . $product_detail->profile;
                } else {
                    $image = 'http://' . Yii::$app->request->serverName . '/alhajis/uploads/product/profile_thumb.png';
                }
                if ($product_detail->offer_price == '0' || $product_detail->offer_price == '') {
                    $price = $product_detail->price;
                } else {
                    $price = $product_detail->offer_price;
                }
                if (isset($order_product->tax))
                    $tax = $order_product->tax;
                $tax_amount += $tax;
                $amount_tax = ( $order_product->rate * 5) / 100;
                $total_amount += $order_product->rate;
                ?>
                <table style="width:100%;border-collapse:collapse" id="m_4570329663929504437itemDetails">
                    <tbody>
                        <tr>
                            <td style="width: 10%;"><img id="m_4570329663929504437asin" src="<?= $image ?>" style="border:0" class="CToWUd"></td>
                            <td style="width: 75%;"><<?= $product_detail->product_name; ?></td>
                            <td style="width: 5%;text-align: right;">AED</td>
                            <td style="width: 10%;text-align: right;"><?= sprintf('%0.2f', $order_product->rate) ?></td>
                        </tr>
                    </tbody>
                </table>
                <hr style="border: .5px solid rgb(223, 223, 223);">
                <table style="width:100%;border-collapse:collapse" id="m_4570329663929504437itemDetails">
                    <tbody>
                        <tr>
                            <td style="width: 85%;"><strong>Subtotal</strong></td>
                            <td style="width: 5%;text-align: right;">AED</td>
                            <td style="width: 10%;text-align: right;"><strong><?= sprintf('%0.2f', $total_amount) ?></strong></td>
                        </tr>
                        <?php
                        $promotion_disvount = 0;
                        if (isset($promotions) && $promotions > 0) {
                            $promotion_disvount = $promotions;
                            ?>
                            <tr>
                                <td style="width: 85%;"><strong>Coupon Code Added</strong></td>
                                <td style="width: 5%;text-align: right;">AED</td>
                                <td style="width: 10%;text-align: right;"><strong><?= sprintf('%0.2f', $promotions) ?></strong></td>
                            </tr>
                        <?php }
                        ?>
                        <?php
                        $shipping_limit = Settings::findOne('1')->value;
                        $shipextra = Settings::findOne('2')->value;
                        $ship_charge = $order_master->total_amount <= $shipping_limit ? $shipextra : 0.00
                        ?>
                        <tr>
                            <td style="width: 85%;"><strong>Shipping Charge</strong></td>
                            <td style="width: 5%;text-align: right;">AED</td>
                            <td style="width: 10%;text-align: right;"><strong><?= sprintf('%0.2f', $ship_charge) ?></strong></td>
                        </tr><tr>
                            <td style="width: 85%;"><strong>Grand Total (inclusive of VAT)</strong></td>
                            <td style="width: 5%;text-align: right;">AED</td>
                            <td style="width: 10%;text-align: right;"><strong><?= sprintf('%0.2f', $order_master->net_amount) ?></strong></td>
                        </tr>

                    </tbody>
                </table>
            <?php } ?>
        </div>
    </div>
</div>