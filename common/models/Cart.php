<?php

namespace common\models;

use Yii;
use common\models\OrderMaster;
use common\models\OrderAddress;

/**
 * This is the model class for table "cart".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $session_id
 * @property integer $product_id
 * @property integer $quantity
 * @property integer $options
 * @property string $date
 * @property integer $gift_option
 * @property double $rate
 */
class Cart extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'cart';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
//            [['user_id', 'product_id', 'quantity', 'options', 'date', 'gift_option', 'rate'], 'required'],
//            [['user_id', 'product_id', 'quantity', 'options', 'gift_option'], 'integer'],
//            [['date'], 'safe'],
//            [['rate'], 'number'],
//            [['session_id'], 'string', 'max' => 225],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'session_id' => 'Session ID',
            'product_id' => 'Product ID',
            'quantity' => 'Quantity',
            'options' => 'Options',
            'date' => 'Date',
            'gift_option' => 'Gift Option',
            'rate' => 'Rate',
            'item_type' => 'Item Type',
        ];
    }

    /*     * *************************** */

    public static function usercheck() {
        if (isset(Yii::$app->user->identity->id)) {
            $user_id = Yii::$app->user->identity->id;
            $condition = ['user_id' => $user_id];
        } else {
            if (!isset(Yii::$app->session['temp_user'])) {
                $milliseconds = round(microtime(true) * 1000);
                Yii::$app->session['temp_user'] = $milliseconds;
            }
            $sessonid = Yii::$app->session['temp_user'];
            $condition = ['session_id' => $sessonid];
        }
        return $condition;
    }

    public static function add_to_cart($user_id, $temp_session, $product_id, $qty) {
        $model = new cart;
        $model->user_id = $user_id;
        $model->session_id = $temp_session;
        $model->product_id = $product_id;
        $model->quantity = $qty;
        $model->date = date('Y-m-d H:i:s');
        if ($model->save()) {
            return TRUE;
        }
    }

    public static function cart_content() {
        $condition = Cart::usercheck();
        $cart_contents = Cart::find()->where($condition)->all();
        $cart_total = Cart::total($cart_contents);
        if (!empty($cart_contents)) {
            $cart_content = Cart::content($cart_contents);
            echo $cart_content;
        }
    }

    public static function Content($cart_contents) {
        $content = '';
        $i = 0;
        foreach ($cart_contents as $cart_content) {
            $i++;
            $prod_details = Product::find()->where(['id' => $cart_content->product_id, 'status' => '1'])->one();
            $unit = Unit::findOne($prod_details->size_unit)->unit_name;
            if ($prod_details->offer_price == '0' || $prod_details->offer_price == '') {
                $price = $prod_details->price;
            } else {
                $price = $prod_details->offer_price;
            }
            $product_image = Yii::$app->basePath . '/../uploads/product/' . $prod_details->id . '/profile/' . $prod_details->canonical_name . '.' . $prod_details->profile;
            if (file_exists($product_image)) {
                $image = '<img class="" src="' . yii::$app->homeUrl . 'uploads/product/' . $prod_details->id . '/profile/' . $prod_details->canonical_name . '_thumb.' . $prod_details->profile . '" alt="' . $prod_details->product_name . '" title="">';
//                $image = '<img src="' . Yii::$app->homeUrl . 'uploads/product/' . $prod_details->id . '/profile/' . $prod_details->canonical_name . '_thumb.' . $prod_details->profile . '" alt="' . $prod_details->canonical_name . '" />';
            } else {
                $image = '<img src="' . Yii::$app->homeUrl . 'uploads/product/profile_thumb.png" alt="' . $prod_details->product_name . '"/>';
            }
            $product_name = $prod_details->product_name;
            if (strlen($product_name) > 25) {
                $str = substr($product_name, 0, 25) . '...';
            } else {
                $str = $product_name;
            }
            if ($prod_details->stock == 0) {
                $pro_info = ' <h5 class="price-out-of-stock">Out of stock</h5>';
            } else {
                $pro_info = '<span class="item-price"> ' . sprintf("%0.2f", $price) . '</span><span class="item-quantity">Quantity: ' . $cart_content->quantity . '</span>';
            }
            $content .= '<li class="clearfix">
                <a class="item-remove remove_cart_product" href="" data-link-action="remove-from-cart" title="Remove from cart" data-product_id="' . yii::$app->EncryptDecrypt->Encrypt('encrypt', $cart_content->id) . '">
                                                    <i class="far fa-times-circle"></i>
                                                </a>
                                                <a href="' . Yii::$app->homeUrl . 'product-detail/' . $prod_details->canonical_name . '">'
                    . $image . ' </a>
                                                <a href="' . Yii::$app->homeUrl . 'product-detail/' . $prod_details->canonical_name . '"><span class="item-name">' . $str . '</span></a>
                                                ' . $pro_info . '
                                            </li>';
        }
        return $content;
    }

    public static function total($cart) {
        $subtotal = '0';
        foreach ($cart as $cart_item) {
            $product = Product::find()->where(['id' => $cart_item->product_id, 'status' => '1'])->one();
            if ($product->offer_price == '0' || $product->offer_price == '') {
                $price = $product->price;
            } else {
                $price = $product->offer_price;
            }
            $subtotal += ($price * $cart_item->quantity);
        }
        return $subtotal;
    }

    public static function tax($carts) {
        $subtotal = '0';
        foreach ($carts as $cart) {
            $product = Product::findOne($cart->product_id);
            $tax = Tax::find()->where(['id' => $product->tax])->one();
            if ($product->offer_price == '0' || $product->offer_price == '') {
                $price = $product->price;
            } else {
                $price = $product->offer_price;
            }
            if (!empty($tax)) {
                if ($tax->type == 1) {
                    $rate = $price * $cart->quantity;
                    $product_price = ($rate * 100) / (100 + $tax->value); /* equation given for tax calculation ie:total*100(100+5) */
                    $subtotal += $product_price * $tax->value / 100;
                } else {
                    $subtotal += ($tax->value * $cart->quantity);
                }
            }
        }
        return $subtotal;
    }

    public static function productTax($product, $quantity) {
        $subtotal = 0;
        $tax = Tax::find()->where(['id' => $product->tax])->one();
        if ($product->offer_price == '0' || $product->offer_price == '') {
            $price = $product->price;
        } else {
            $price = $product->offer_price;
        }
        $tot_price = $quantity * $price;
        if (!empty($tax)) {
            if ($tax->type == 1) {
                $product_price = ($tot_price * 100) / (100 + $tax->value); /* equation given for tax calculation ie:total*100(100+5) */
                $subtotal = $product_price * $tax->value / 100;
            } else {
                $subtotal = ($quantity * $tax->value);
            }
        }
        return $subtotal;
    }

    public static function cart_count() {
        $condition = Cart::usercheck();
        $cart_items = Cart::find()->where($condition)->all();
        if (!empty($cart_items)) {
            return count($cart_items);
        } else {
            return '0';
        }
    }

    public static function changecart($tempuser) {
        if (isset($tempuser)) {
            $models = Cart::find()->where(['session_id' => Yii::$app->session['temp_user']])->all();
            foreach ($models as $msd) {
                $product_allready = Cart::find()->where(['user_id' => Yii::$app->user->identity->id, 'product_id' => $msd->product_id])
//                                        ->andWhere(['<>', 'session_id', Yii::$app->session['temp_user']])
//                                        ->orWhere(['session_id' => 'NULL'])
                        ->one();

                if ($product_allready) {
//                                        $product_allready->quantity = $product_allready->quantity + $msd->quantity;
                    $product_allready->quantity = $msd->quantity;
                    $product_allready->save();
                    $msd->delete();
                    unset($product_allready);
                } else {
                    $msd->user_id = Yii::$app->user->identity->id;
                    $msd->save();
                }
            }
            unset(Yii::$app->session['temp_user']);
        }
    }

    public static function check_cart($condition) {
        $cart_items = Cart::find()->where($condition)->all();
        foreach ($cart_items as $cart) {
            $check_product = Product::find()->where(['id' => $cart->product_id, 'status' => '1'])->one();

            if (empty($check_product)) {
                Yii::$app->response->redirect(['cart/mycart'])->send();
                return;
            }
        }
    }

    public static function ProductStock($product_id) {
        $product = Product::find()->where(['id' => $product_id, 'status' => '1'])->one();
        return $product->stock;
    }

    public static function check_product() {
        $condition = Cart::usercheck();
        $cart_items = Cart::find()->where($condition)->all();
        foreach ($cart_items as $cart) {
            $check_product = Product::find()->where(['id' => $cart->product_id])->one();
            if (empty($check_product)) {
                $cart->delete();
            }
        }
    }

    public static function Checkout() {
        Cart::check_product();
        $cart = Cart::find()->where(['user_id' => Yii::$app->user->identity->id])->all();
        if ($cart) {
            $orders = Cart::addOrder($cart);
            if (Cart::orderProducts($orders, $cart)) {
                Cart::Addpromotions($orders);
                return $orders['order_id'];
            } else {
                Yii::$app->response->redirect(['cart/mycart'])->send();
                return false;
            }
        } else {
            Yii::$app->response->redirect(['cart/mycart'])->send();
            return false;
        }
    }

    public static function addOrder($cart) {
        $order_exist = OrderMaster::find()->where(['user_id' => Yii::$app->user->identity->id, 'payment_status' => 0])->orderBy(['id' => SORT_DESC])->one();
        if (empty($order_exist)) {
            $model = new OrderMaster;
            $serial_no = Settings::findOne(4)->value;
            $prefix = Settings::findOne(4)->prefix;
            $model->order_id = Cart::generateProductEan($prefix, $serial_no);
            $model->user_id = Yii::$app->user->identity->id;
        } else {
            $model = OrderMaster::find()->where(['user_id' => Yii::$app->user->identity->id, 'payment_status' => 0])->orderBy(['id' => SORT_DESC])->one();
        }

        $gift_wrap_value = Settings::findOne(5)->value;
        $total_amt = Cart::total($cart);

        if (Yii::$app->session['gift_wrap'] == 1) {
            $model->gift_wrap = 1;
            $model->gift_wrap_value = $gift_wrap_value;
        } else {
            $model->gift_wrap = 0;
            $model->gift_wrap_value = 0;
        }
        $model->total_amount = $total_amt;
        $model->shipping_charge = Cart::shippingcharge($total_amt);
        $model->tax = Cart::tax($cart);
        $model->net_amount = Cart::net_amount($total_amt, $model->gift_wrap);
        $model->order_date = date('Y-m-d H:i:s');
        $model->doc = date('Y-m-d');
        if ($model->save()) {
            return ['master_id' => $model->id, 'order_id' => $model->order_id];
        }
    }

    public static function orderProducts($orders, $carts) {
        foreach ($carts as $cart) {
            $prod_details = Product::findOne($cart->product_id);
            $order_exist = OrderDetails::find()->where(['master_id' => $orders['master_id'], 'product_id' => $cart->product_id])->one();
            if ($order_exist) {
                $model_prod = OrderDetails::find()->where(['master_id' => $orders['master_id'], 'product_id' => $cart->product_id])->one();
            } else {
                $model_prod = new OrderDetails;
            }
            $model_prod->master_id = $orders['master_id'];
            $model_prod->order_id = $orders['order_id'];
            $model_prod->product_id = $cart->product_id;
            $model_prod->quantity = $cart->quantity;
            if ($prod_details->offer_price == '0' || $prod_details->offer_price == '') {
                $price = $prod_details->price;
            } else {
                $price = $prod_details->offer_price;
            }
            $model_prod->item_type = $cart->item_type;
            $model_prod->amount = $price;
            $model_prod->tax = Cart::productTax($prod_details, $cart->quantity);
            $model_prod->rate = ($cart->quantity) * ($price);
            $model_prod->status = '0';
            $model_prod->save();
        }
        return TRUE;
    }

    public static function Addpromotions($orders) {
        $coupons = \common\models\TempSession::find()->where(['user_id' => Yii::$app->user->identity->id, 'type_id' => 3])->all();
        $cart_products = Cart::find()->where(['user_id' => Yii::$app->user->identity->id])->all();
        $cart_amount = Cart::total($cart_products);
        $total_promotion_discount = 0;
        foreach ($coupons as $coupons) {
            $add_promption = new \common\models\OrderPromotions();
            $add_promption->order_master_id = $orders['master_id'];
            $add_promption->promotion_id = $coupons->value;
            $promotion = \common\models\Promotions::findOne($coupons->value);
            if ($promotion->promotion_type == 1) {
                $condition = Cart::usercheck();
                $cart_items = Cart::find()->where($condition)->all();
                $price = Cart::Promotionuniqueproduct($code_exists, $code, $cart_items);
            } else {
                $price = $cart_amount;
            }

            if ($promotion->type == 1) {
                $promotion_discount = ($price * $promotion->price) / 100;
            } else {
                $promotion_discount = $promotion->price;
            }
            $total_promotion_discount += $promotion_discount;
            $add_promption->promotion_discount = $promotion_discount;
            $add_promption->save();

            if ($promotion->code_usage == 1) {
                //  Cart::AddUsed($promotion);
            }
        }
        $order_master_detail = OrderMaster::findOne($orders['master_id']);
        $order_master_detail->net_amount = $order_master_detail->net_amount - $total_promotion_discount;
        $order_master_detail->update();
    }

    public static function AddUsed($code_exists) {

        $code_exists->code_used = $code_exists->code_used . ',' . Yii::$app->user->identity->id;
        $code_exists->save();
    }

    public static function generateProductEan($prefix, $serial_no) {
        $orderid_exist = OrderMaster::find()->where(['order_id' => $prefix . $serial_no])->one();
        if (!empty($orderid_exist)) {
            return Cart::generateProductEan($prefix, $serial_no + 1);
        } else {
            Cart::Updateorderid($serial_no);
            return $prefix . $serial_no;
        }
    }

    public static function Updateorderid($id) {
//        echo $id;
        $orderid = \common\models\Settings::findOne(4);
        $orderid->value = $id;
        $orderid->save();
        return;
    }

    public static function net_amount($total_amt, $gift_wrap) {
        $limit = Settings::findOne(1)->value;
        $net_amnt = $total_amt;
        if ($limit > $total_amt) {
            $extra = Settings::findOne(2)->value;
            $net_amnt = $extra + $total_amt;
        }
        if ($gift_wrap == 1) {
            $wrap = Settings::findOne(5)->value;
            $net_amnt = $net_amnt + $wrap;
        }
        return $net_amnt;
    }

    public static function shippingcharge($total_amt) {
        $limit = Settings::findOne(1)->value;
        $ship_amnt = 0;
        if ($limit > $total_amt) {
            $extra = Settings::findOne(2)->value;
            $ship_amnt = $extra;
        }
        return $ship_amnt;
    }

    public static function orderbilling($bill_address) {
        $model1 = OrderMaster::find()->where(['order_id' => Yii::$app->session['orderid']])->one();
        $model1->bill_address_id = $bill_address;
        $model1->status = 2;
        $model1->save();
        // Yii::$app->response->redirect(['checkout/confirm'])->send();
        //      Yii::$app->response->redirect(['checkout/confirm-order'])->send();
    }

    public static function orderaddress($bill_address) {
        $model = new OrderAddress();
        $user_address = UserAddress::findOne($bill_address);
        $model->order_id = Yii::$app->session['orderid'];
        $model->address = $user_address->address;
        $model->name = $user_address->name;
        $model->landmark = $user_address->landmark;
        $model->location = $user_address->location;
        $model->emirate = $user_address->emirate;
        $model->post_code = $user_address->post_code;
        $model->country_code = $user_address->country_code;
        $model->mobile_number = $user_address->mobile_number;
        $model->save();
    }

    public static function ordershipping($bill_address) {
        $model1 = OrderMaster::find()->where(['order_id' => Yii::$app->session['orderid']])->one();
        $model1->ship_address_id = $bill_address;
        $model1->status = 3;
        if ($model1->save()) {

            Yii::$app->response->redirect(['checkout/confirm-order'])->send();
        }
    }

    public static function clearcart($models) {
        foreach ($models as $model) {
            $model->delete();
        }
    }

    public static function stock_clear($orders) {
        $order_details = OrderDetails::find()->where(['order_id' => $orders['order_id']])->all();
        foreach ($order_details as $order) {
            $product = Product::findOne($order->product_id);
//            $old_qty = $product->stock;
            $stock = $product->stock - $order->quantity;
            $product->stock = $stock > 0 ? $stock : 0;
            if ($product->stock == 0) {

                $this->stockOutMail($product);
            }
            $product->save();
//            StockHistory::stockhistory($product->qty, '3', $product->id, '3', $old_qty);
        }
    }

    public function stockOutMail($model) {
        echo 'dggdg';
        exit;

        $message = Yii::$app->mailer->compose('stockout-mail', ['model' => $model]) // a view rendering result becomes the message body here
                ->setFrom('no-replay@perfumedunia.com')
                ->setTo(Yii::$app->params['adminEmail'])
                ->setSubject('Stock Out');
        if ($message->send()) {
            echo 'sdjfkh';
            exit;
        } else {
            echo '40950';
            exit;
        }
        //return TRUE;
    }

    public static function orderdetails() {
        $order_details = OrderDetails::find()->where(['order_id' => Yii::$app->session['orderid']])->all();
        if (!empty($order_details)) {
            foreach ($order_details as $order_detail) {
                if ($order_detail->quantity < 1) {
                    $order_detail->delete();
                }
            }
        }
        $existing_order_details = OrderDetails::find()->where(['order_id' => Yii::$app->session['orderid']])->all();
        return $existing_order_details;
    }

    public static function addUser_address($model, $data) {
        Yii::$app->SetValues->Attributes($model);
        $model->user_id = Yii::$app->user->identity->id;
        $model->name = $data['UserAddress']['name'];
        $model->address = $data['UserAddress']['address'];
        $model->landmark = $data['UserAddress']['landmark'];
        $model->location = $data['UserAddress']['location'];
        $model->emirate = $data['UserAddress']['emirate'];
        $model->post_code = $data['UserAddress']['post_code'];
        $model->country_code = $data['UserAddress']['country_code'];
        $model->mobile_number = $data['UserAddress']['mobile_number'];
        if ($model->save()) {
            return $model->id;
        }
    }

    /*     * *******Checkout***************** */

    public static function updatedetails($details) {
        $product = Product::findOne($details->product_id);

        if ($product->stock == '0' || $product->stock_availability == '0') {
            $details->delete();
        } elseif ($product->stock > '0' && $product->stock < $details->quantity) {
            $quantity = $product->stock;
        } elseif ($product->stock >= $details->quantity) {
            $quantity = $details->quantity;
        }
        if ($product->offer_price == '0' || $product->offer_price == '') {
            $price = $product->price;
        } else {
            $price = $product->offer_price;
        }
        $details->quantity = $quantity;
        $details->amount = $price;
        $details->rate = ($price * $quantity);
        if ($details->save()) {
            return TRUE;
        }
    }

    public static function updatemaster($order_id, $subtotal) {
        $ordermaster = OrderMaster::find()->where(['order_id' => $order_id])->one();
        $limit = Settings::findOne(1)->value;
        $net_amnt = $subtotal;
        if ($limit > $subtotal) {
            $extra = Settings::findOne(2)->value;
            $net_amnt = $extra + $subtotal;
        }
        $ordermaster->total_amount = $subtotal;
        $ordermaster->net_amount = $net_amnt;
        $ordermaster->save();
    }

    /*     * *********admin mail**************************** */

    public static function purchasemail($orderid, $payment_status) {
        $ordermaster = OrderMaster::find()->where(['order_id' => $orderid])->one();
        $user = \common\models\User::findOne($ordermaster->user_id);
        $mail = \common\models\User::findOne(Yii::$app->user->identity->id)->email;
        $to1 = $mail;
        $to = Yii::$app->params['adminEmail'];
        $message = Yii::$app->mailer->compose('confirm_mail', ['orderid' => $orderid, 'payment_status' => $payment_status])
                ->setFrom('noreply@alhajisperfumes.ae')
                ->setTo([
                    $to1,
                    $to,
                ])
                ->setSubject('New Purchase Order');
        $message->send();
    }

    /*     * ******************* */

    public static function CodeUsedSingle($orderid) {
        $promotions = OrderPromotions::find()->where(['order_master_id' => $orderid])->all();
        foreach ($promotions as $promotion) {
            $promotion_code = \common\models\Promotions::findOne($promotion->promotion_id);
            if ($promotion_code->code_usage == 1) {
                Cart::AddUsed($promotion_code);
            }
        }
    }

    public static function date() {
        $date = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' - 8 days'));
        return $date;
    }

    public static function AmountRange($code_exists, $cart_amount) {
        $amount_range = 0;
        if (isset($code_exists->amount_range) && $code_exists->amount_range != '') {
            if ($cart_amount > $code_exists->amount_range)
                $amount_range = 0;
            else
                $amount_range = 1;
        }
        return $amount_range;
    }

    public static function PromotionProduct($code_exists, $code) {
        $products = explode(',', $code_exists->product_id);
        $users = explode(',', $code_exists->user_id);
        $oreder_setails = Cart::find()->where(['user_id' => Yii::$app->user->identity->id])->all();
        $exist = 0;
        if ($code_exists->promotion_type == 1 || $code_exists->promotion_type == 3) {
            foreach ($oreder_setails as $value) {
                if (in_array($value->product_id, $products)) {
                    $exist = 1;
                }
            }
        }
        if ($code_exists->promotion_type == 2 || $code_exists->promotion_type == 3) {
            if (in_array(Yii::$app->user->identity->id, $users))
                $exist = 1;
        }
        return $exist;
    }

    public static function CodeUsed($code_exists) {
        $code_used_list = explode(',', $code_exists->code_used);
        if (($code_exists->code_usage == 1)) {
            if (!in_array(Yii::$app->user->identity->id, $code_used_list)) {
                $permision = 0;
            } else {
                $permision = 1;
            }
        } else {
            $permision = 0;
        }

        return $permision;
    }

    public static function CheckDate($code_exists) {
        $date_from_user = date('Y-m-d');
        $start_ts = strtotime($code_exists->starting_date);
        $end_ts = strtotime($code_exists->expiry_date);
        $user_ts = strtotime($date_from_user);
        return (($user_ts >= $start_ts) && ($user_ts <= $end_ts));
    }

    public static function UsedCode($code) {
        $existss = 0;
        $code_details = \common\models\Promotions::find()->where(['promotion_code' => $code])->one();
        $temp_session = \common\models\TempSession::find()->where(['value' => $code_details->id])->exists();
        if ($temp_session) {
            $existss = 1;
        }
        return $existss;
    }

    public static function SaveTemp($type_id, $value) {

        $temp_promotion = new \common\models\TempSession;
        $temp_promotion->user_id = Yii::$app->user->identity->id;
        $temp_promotion->type_id = $type_id;
        $temp_promotion->value = $value;
        $temp_promotion->save();
        return $temp_promotion;
    }

    public static function Promotionuniqueproduct($code_exists, $code, $cart_items) {
        $products = explode(',', $code_exists->product_id);




        foreach ($cart_items as $value) {
            if (in_array($value->product_id, $products)) {
                $product = \common\models\Product::findOne($value->product_id);
                if ($product->offer_price != "0" && isset($product->offer_price)) {
                    $price = $product->offer_price;
                } else {
                    $price = $product->price;
                }
                $tot_price = $price * $value->quantity;
            }
        }


        return $tot_price;
    }

    public static function productPrice($product_id) {
        $product = Product::findOne($product_id);
        if ($product->offer_price == '0' || $product->offer_price == '') {
            $price = $product->price;
        } else {
            $price = $product->offer_price;
        }
        return $price;
    }

}
