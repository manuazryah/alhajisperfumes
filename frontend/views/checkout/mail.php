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
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Order Confirmation</title>
    </head>

    <body>
        <table cellpadding="0" cellspacing="0" border="0">
            <tbody>
                <tr>
                    <td>

                        <div style="font-family: Arial, Helvetica, sans-serif; font-weight: normal; margin: 0; padding: 0; color: rgb(0, 0, 0);  font-size: 14px">
                            <table width="100%" cellpadding="0" cellspacing="0" border="0"  style="border-collapse: collapse; font-size: 12px; padding: 0; margin: 0 auto; ">
                                <tbody>
                                    <tr>
                                        <td valign="top"  align="center" style="font-family: Arial, Helvetica, sans-serif; font-weight: normal; border-collapse: collapse; font-size: 12px; vertical-align: top; padding: 0; margin: 0; width: 100%">
                                            <table cellpadding="0" cellspacing="0" border="0" align="center"  style="border-collapse: collapse; font-size: 12px; padding: 0; margin: 70px auto; width: 700px; border: 1px solid rgb(199, 199, 199); ">
                                                <tbody>
                                                    <tr style="background: black;">
                                                        <td style="font-family: Arial, Helvetica, sans-serif; font-weight: normal; border-collapse: collapse; font-size: 12px; vertical-align: top; padding: 0; margin: 0">
                                                            <table cellpadding="0" cellspacing="0" border="0" class="x_902363135m_-4486764198706722540logo-container" style="border-collapse: collapse; font-size: 12px;   width: 100%; text-align: center;background:#fff;border-bottom: 1px solid rgb(223, 223, 223);">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="x_902363135m_-4486764198706722540logo" style="font-family: Arial, Helvetica, sans-serif; font-weight: normal; border-collapse: collapse; font-size: 12px; vertical-align: top; padding:15px 15px; margin: 0;background: #e8471f;">
                                                                            <a href="#" style="color: rgb(0, 0, 0)" target="_blank">
                                                                                <?php echo Html::img('http://' . Yii::$app->request->serverName . '/alhajis/images/logo.png', $options = ['width' => '100', 'border' => '0', 'style' => 'height: auto; display: inline-block; outline: none; text-decoration: none; width: 180px; max-width: 100%']) ?>
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table></td>
                                                    </tr>
                                                    <tr>
                                                        <td valign="top" class="x_902363135m_-4486764198706722540top-content" style="font-family: Arial, Helvetica, sans-serif; font-weight: normal; border-collapse: collapse; font-size: 12px; vertical-align: top; padding: 0; margin: 0; background: rgb(255, 255, 255)"><table cellpadding="0" cellspacing="0" border="0" style="width: 100%; border-collapse: collapse; font-size: 12px; padding: 0; margin: 0">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="x_902363135m_-4486764198706722540action-content" style="font-family: Arial, Helvetica, sans-serif; font-weight: normal; border-collapse: collapse; font-size: 12px; vertical-align: top; padding: 40px 20px 40px 20px; margin: 0; line-height: 18px"><p style="font-family: Arial, Helvetica, sans-serif; font-weight: normal; text-align: left">Dear <?= $user_detail->first_name . ' ' . $user_detail->last_name ?>,</p>
                                                                            <p style="font-family: Arial, Helvetica, sans-serif; font-weight: normal; text-align: left">Thank you for placing your order with Perfume Dunia. Here is a summary of your purchase.</p>
                                                                    </tr>
                                                                </tbody>
                                                            </table></td>
                                                    </tr>

                                                    <tr>
                                                        <td style="vertical-align:top;font-size:12px;line-height:16px;font-family:Arial,sans-serif">
                                                            <table style="width:100%;border-top: 1px solid rgb(199, 199, 199);border-collapse:collapse" id="m_4570329663929504437criticalInfo">
                                                                <tbody>
                                                                    <tr>
                                                                        <td style="font-size:14px;padding:11px 18px 18px 18px;background-color:rgba(239, 239, 239, 0.58);width:50%;vertical-align:top;line-height:16px;font-family:Arial,sans-serif">
                                                                            <p style="margin:2px 0 9px 0;font:12px/16px Arial,sans-serif">
                                                                                <span style="color:rgb(102,102,102)">Order No:</span>
                                                                                <b style="color:#009900"> #<?= $order_master->order_id ?> </b><br>
                                                                                    <span style="color:rgb(102,102,102)">Order Date:</span>
                                                                                    <b> <?= date('d-m-Y H:i:A', strtotime($order_master->order_date)) ?> </b><br>
                                                                                        <span style="color:rgb(102,102,102)">Payment Method:</span>
                                                                                        <b><?= $payment_status ?> </b><br>
                                                                                            </p>
                                                                                            </td>
                                                                                            <?php
                                                                                            $bill_address = \common\models\OrderAddress::find()->where(['order_id' => $order_master->order_id])->one();
                                                                                            if (!empty($bill_address)) {
                                                                                                ?>
                                                                                                <td style="font-size:14px;padding:11px 18px 18px 18px;background-color:rgba(239, 239, 239, 0.58);width:50%;vertical-align:top;line-height:16px;font-family:Arial,sans-serif">
                                                                                                    <p style="margin:2px 0 9px 0;font:12px/16px Arial,sans-serif">
                                                                                                        <span style="color:rgb(102,102,102)">Your order will be sent to:</span> <br>
                                                                                                            <b>
                                                                                                                <?= $bill_address->name ?> <br>
                                                                                                                    <?= $bill_address->address ?> <br>
                                                                                                                        <?= $bill_address->location ?> <br>
                                                                                                                            <?= $bill_address->landmark ?> <br>
                                                                                                                                Tel : <?= $bill_address->mobile_number ?> <br>

                                                                                                                                    </b>
                                                                                                                                    </p>
                                                                                                                                    </td>
                                                                                                                                <?php } ?>
                                                                                                                                </tr>
                                                                                                                                </tbody>
                                                                                                                                </table>
                                                                                                                                </td>
                                                                                                                                </tr>

                                                                                                                                <tr>
                                                                                                                                    <td style="border-bottom:1px solid rgb(204,204,204);vertical-align:top;font-size:12px;line-height:16px;font-family:Arial,sans-serif"> <h3 style="font-size:18px;color:#FF9800;margin:15px 0 0 0;font-weight:normal;margin: 10px 0px 5px 15px;">Order Details</h3> </td>
                                                                                                                                </tr>
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
                                                                                                                                    <tr>
                                                                                                                                        <td style="padding-left:32px;vertical-align:top;font-size:12px;line-height:16px;font-family:Arial,sans-serif">
                                                                                                                                            <table style="width:95%;border-collapse:collapse" id="m_4570329663929504437itemDetails">
                                                                                                                                                <tbody>
                                                                                                                                                    <tr>
                                                                                                                                                        <td class="m_4570329663929504437photo" style="width:150px;text-align:center;padding:16px 0 10px 0;vertical-align:top;font-size:12px;line-height:16px;font-family:Arial,sans-serif">
                                                                                                                                                            <img id="m_4570329663929504437asin" src="<?= $image ?>" style="border:0" class="CToWUd"> </a> </td>
                                                                                                                                                        <td class="m_4570329663929504437name" style="color:rgb(102,102,102);padding:10px 0 0 0;vertical-align:top;font-size:12px;line-height:16px;font-family:Arial,sans-serif">
                                                                                                                                                            <a  style="text-decoration:none;color:rgb(0,102,153);font:12px/16px Arial,sans-serif;vertical-align: middle;margin-top: 25px;display: inline-block"  > <?= $product_detail->product_name; ?> </a><br>
                                                                                                                                                                <span>Quantity : <?= $order_product->quantity ?></span>
                                                                                                                                                        </td>
                                                                                                                                                        <td class="m_4570329663929504437price" style="text-align:right;font-size:14px;padding:10px 10px 0 10px;white-space:nowrap;vertical-align:top;line-height:16px;font-family:Arial,sans-serif;margin-top: 25px;display: inline-block"> <strong>AED <?= sprintf('%0.2f', $order_product->rate) ?></strong> <br> </td>
                                                                                                                                                    </tr>
                                                                                                                                                </tbody>
                                                                                                                                            </table>
                                                                                                                                        </td>
                                                                                                                                    </tr>
                                                                                                                                <?php } ?>






                                                                                                                                <tr>
                                                                                                                                    <td style="font-family: Arial, Helvetica, sans-serif; font-weight: normal; border-collapse: collapse; font-size: 12px; vertical-align: top; padding: 0; margin: 0">
                                                                                                                                        <table cellspacing="0" cellpadding="0" border="0" class="x_902363135m_-4486764198706722540bottom-content" style="border-collapse: collapse; font-size: 12px; padding: 0; margin: 0; width: 100% !important">
                                                                                                                                            <tbody>
                                                                                                                                                <tr>
                                                                                                                                                    <td  style="font-family: Arial, Helvetica, sans-serif; font-weight: normal; border-collapse: collapse; font-size: 12px; vertical-align: top; padding: 15px; margin: 0; border: 1px solid rgb(223, 223, 223); border-left: none; border-right: none">
                                                                                                                                                        <table cellspacing="0" cellpadding="0" border="0"  style="border-collapse: collapse; font-size: 12px; padding: 0; margin: 0; width: 100%">
                                                                                                                                                            <tbody>
                                                                                                                                                                <tr>
                                                                                                                                                                    <td  style=""><a href="" style="color: rgb(0, 0, 0); text-decoration: none !important"> </a>
                                                                                                                                                                        <table cellspacing="0" cellpadding="0"  style="border-collapse: collapse; font-size: 12px; padding: 0; margin: 0;width: 100%;">
                                                                                                                                                                            <tbody>
                                                                                                                                                                                <tr>
                                                                                                                                                                                    <td class="x_902363135m_-4486764198706722540item-details" style="font-family: Arial, Helvetica, sans-serif; font-weight: normal; border-collapse: collapse; font-size: 12px; vertical-align: top; padding: 0; margin: 0">
                                                                                                                                                                                        <table cellspacing="0" cellpadding="0" style="border-collapse: collapse; font-size: 12px; padding: 0; margin: 0;width: 100%;">
                                                                                                                                                                                            <tbody>

                                                                                                                                                                                                <tr >
                                                                                                                                                                                                    <td style="font-family: Arial, Helvetica, sans-serif; font-weight: normal; border-collapse: collapse; font-size: 12px; vertical-align: top; padding: 0; margin: 0">
                                                                                                                                                                                                        <div class="invoice-details"style="margin-top: 10px;">
                                                                                                                                                                                                        <table style="width:100%;border-collapse: collapse;text-align: left;">




                                                                                                                                                                                                        <tr>
                                                                                                                                                                                                        <td colspan="2" style="padding-bottom: 1em;font-size: 14px;padding-top: 1em;"><b>Subtotal</b></td>
                                                                                                                                                                                                        <td style="padding-bottom: 1em;font-size: 14px;padding-top: 1em;">AED <?= sprintf('%0.2f', $total_amount) ?></td>
                                                                                                                                                                                                        </tr>
                                                                                                                                                                                                                <?php
                                                                                                                                                                                                                $promotion_disvount = 0;
                                                                                                                                                                                                                if (isset($promotions) && $promotions > 0) {
                                                                                                                                                                                                                    $promotion_disvount = $promotions;
                                                                                                                                                                                                                    ?>
                                                                                                                                                                                                            <tr>
                                                                                                                                                                                                            <td colspan="2" style="padding-bottom: 1em;font-size: 14px;"><b>Coupon Code Added</b></td>
                                                                                                                                                                                                            <td style="padding-bottom: 1em;font-size: 14px;">AED <?= sprintf('%0.2f', $promotions) ?></td>
                                                                                                                                                                                                            </tr>
                                                                                                                                                                                                                <?php }
                                                                                                                                                                                                                ?>




                                                                                                                                                                                                        <tr>
                                                                                                                                                                                                                    <?php
                                                                                                                                                                                                                    $shipping_limit = Settings::findOne('1')->value;
                                                                                                                                                                                                                    $shipextra = Settings::findOne('2')->value;
                                                                                                                                                                                                                    $ship_charge = $order_master->total_amount <= $shipping_limit ? $shipextra : 0.00
                                                                                                                                                                                                                    ?>
                                                                                                                                                                                                        <td colspan="2" style="padding-bottom: 1em;font-size: 14px;"><b>Shipping Charge</b></td>
                                                                                                                                                                                                        <td style="padding-bottom: 1em;font-size: 14px;">AED <?= sprintf('%0.2f', $ship_charge) ?></td>
                                                                                                                                                                                                        </tr>
                                                                                                                                                                                                                <?php if ($order_master->gift_wrap == '1') { ?>
                                                                                                                                                                                                            <tr>
                                                                                                                                                                                                            <td colspan="2" style="padding-bottom: 1em;font-size: 14px;"><b>Gift Wrap Charges</b></td>
                                                                                                                                                                                                            <td style="padding-bottom: 1em;font-size: 14px;">AED <?= sprintf('%0.2f', $order_master->gift_wrap_value) ?></td>
                                                                                                                                                                                                            </tr>
                                                                                                                                                                                                                <?php } ?>
                                                                                                                                                                                                                <?php $grand_total = $total_amount + $ship_charge - $promotion_disvount + $tax_amount; ?>
                                                                                                                                                                                                        <tr>
                                                                                                                                                                                                        <td colspan="2" style="padding-bottom: 1em;font-size: 14px;"><b>Grand Total (inclusive of VAT)</b></td>
                                                                                                                                                                                                        <td style="padding-bottom: 1em;font-size: 14px;"><b>AED <?= sprintf('%0.2f', $order_master->net_amount) ?></b></td>
                                                                                                                                                                                                        </tr>

                                                                                                                                                                                                        </table>
                                                                                                                                                                                                        </div>
                                                                                                                                                                                                    </td>
                                                                                                                                                                                                </tr>
                                                                                                                                                                                            </tbody>
                                                                                                                                                                                        </table>
                                                                                                                                                                                    </td>
                                                                                                                                                                                </tr>
                                                                                                                                                                            </tbody>
                                                                                                                                                                        </table>
                                                                                                                                                                    </td>
                                                                                                                                                                </tr>
                                                                                                                                                            </tbody>
                                                                                                                                                        </table>
                                                                                                                                                    </td>
                                                                                                                                                </tr>
                                                                                                                                            </tbody>
                                                                                                                                        </table></td>
                                                                                                                                </tr>
                                                                                                                                <tr>
                                                                                                                                    <td style="font-family: Arial, Helvetica, sans-serif; font-weight: normal; border-collapse: collapse; font-size: 12px; vertical-align: top; padding: 0; margin: 0">
                                                                                                                                        <table cellspacing="0" cellpadding="0" border="0" class="x_902363135m_-4486764198706722540bottom-content" style="border-collapse: collapse; font-size: 12px; padding: 0; margin: 0; width: 100% !important">
                                                                                                                                            <tbody>
                                                                                                                                                <tr>
                                                                                                                                                    <td align="center" style="font-family: Arial, Helvetica, sans-serif; font-weight: normal; border-collapse: collapse; font-size: 12px; vertical-align: top; padding: 15px; margin: 0; background: #e8471f; text-align: center"><span style="color: rgb(255, 255, 255); text-transform: uppercase; font-size: 24px; letter-spacing: 5px">AL HAJIS</span></td>
                                                                                                                                                </tr>
                                                                                                                                                <tr style="background:#e8471f;">
                                                                                                                                                    <td style="font-family: Arial, Helvetica, sans-serif; font-weight: normal; border-collapse: collapse; font-size: 10px; vertical-align: top; padding: 0 15px 40px; margin: 0; text-align: center; color:#fff;"> Visit AL HAJIS to read the "<a href="http://coralepitome.com/alhajis" style="color:#fff" target="_blank">Terms and Conditions</a>" and "<a href="http://coralepitome.com/alhajis" style="color:#da9c07" target="_blank">Privacy Policy</a>". </td>
                                                                                                                                                </tr>
                                                                                                                                            </tbody>
                                                                                                                                        </table></td>
                                                                                                                                </tr>
                                                                                                                                </tbody>
                                                                                                                                </table></td>
                                                                                                                                </tr>
                                                                                                                                </tbody>
                                                                                                                                </table>
                                                                                                                                </div>
                                                                                                                                </td>
                                                                                                                                </tr>
                                                                                                                                </tbody>
                                                                                                                                </table>
                                                                                                                                </body>
                                                                                                                                </html>
