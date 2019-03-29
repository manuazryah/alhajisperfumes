<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
?>
<div class="pad-20 hide-xs"></div>

<div class="container">
    <div class="breadcrumb">
        <span class="current-page">My orders</span>
        <ol class="path">
            <li><?= Html::a('<span>Home</span>', ['/site/index'], ['class' => '']) ?></li>
            <li><?= Html::a('<span>My account</span>', ['/myaccounts/user/index'], ['class' => '']) ?></li>
            <li class="active">My orders</li>
        </ol>
    </div>
</div>

<div id="our-product" class="my-account">
    <div class="container">
        <?= Yii::$app->controller->renderPartial('_leftside_menu'); ?>

        <div class="col-lg-8 col-md-8 col-sm-12 hidden-xs my-account-cntnt">
            <div class="orders-box">
                <div class="track">
                    <button class="product-id">0D508055878917637000</button>
                    <button class="track-btn"><i class="fa fa-map-marker" aria-hidden="true"></i>Track</button>
                </div>
                <div class="ordered-pro-dtls">
                    <div class="pro-img-box col-lg-2 col-md-2 col-sm-2 col-xs-2">
                        <img src="images/products/escape2tumb.png"/>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <p class="cart-pro-heading">WAVES</p>
                        <p class="cart-pro-subheading">David of coolwater </p>
                        <p class="product-discp">Sed ut perspiciatis unde omnis iste natus error sit voluptatem.</p>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 price">AED 200</div>
                    <div class=" col-lg-4 col-md-4 col-sm-4 col-xs-4 delivered-date">Delivered on Tue, Aug 10th ‘17
                        <span>Your item has been delivered</span>
                    </div>
                </div>
                <div class="pro-order-detail">
                    <p class="ordered-date">Ordered on Fri, Jul 25th ’17 </p>
                    <p class="order-total">Order Total: AED 200</p>
                </div>
            </div>


            <div class="orders-box">
                <div class="track">
                    <button class="product-id">0D508055878917637000</button>
                    <button class="track-btn"><i class="fa fa-map-marker" aria-hidden="true"></i>Track</button>
                </div>
                <div class="ordered-pro-dtls">
                    <div class="pro-img-box col-lg-2 col-md-2 col-sm-2 col-xs-2">
                        <img src="images/products/escape2tumb.png"/>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <p class="cart-pro-heading">WAVES</p>
                        <p class="cart-pro-subheading">David of coolwater </p>
                        <p class="product-discp">Sed ut perspiciatis unde omnis iste natus error sit voluptatem.</p>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 price">AED 200</div>
                    <div class=" col-lg-4 col-md-4 col-sm-4 col-xs-4 delivered-date">Delivered on Tue, Aug 10th ‘17
                        <span>Your item has been delivered</span>
                    </div>
                </div>
                <div class="pro-order-detail">
                    <p class="ordered-date">Ordered on Fri, Jul 25th ’17 </p>
                    <p class="order-total">Order Total: AED 200</p>
                </div>
            </div>
        </div>

        <div class="hidden-lg hidden-md hidden-sm col-xs-12 my-account-cntnt">
            <div class="orders-box col-xs-12">
                <div class="track">
                    <button class="product-id">0D508055878917637000</button>
                    <button class="track-btn hidden-xs"><i class="fa fa-map-marker" aria-hidden="true"></i>Track</button>
                    <button title="Track Your Product" class="track-btn"><i class="fa fa-map-marker" aria-hidden="true"></i></button>
                </div>
                <div class="ordered-pro-dtls">
                    <div class="pro-img-box col-xs-3">
                        <img src="images/products/escape2tumb.png"/>
                    </div>
                    <div class="col-xs-9">
                        <p class="cart-pro-heading">WAVES</p>
                        <p class="cart-pro-subheading">David of coolwater </p>
                        <p class="product-discp">Sed ut perspiciatis unde omnis iste natus error sit voluptatem.</p>
                    </div>
                    <div class="col-xs-12 price">AED 200</div>
                    <div class="col-xs-12 delivered-date">Delivered on Tue, Aug 10th ‘17
                        <span>Your item has been delivered</span>
                    </div>
                </div>
                <div class="pro-order-detail">
                    <p class="ordered-date">Ordered on Fri, Jul 25th ’17 </p>
                    <p class="order-total">Order Total: AED 200</p>
                </div>
            </div>

            <div class="orders-box col-xs-12">
                <div class="track">
                    <button class="product-id">0D508055878917637000</button>
                    <button class="track-btn hidden-xs"><i class="fa fa-map-marker" aria-hidden="true"></i>Track</button>
                    <button title="Track Your Product" class="track-btn"><i class="fa fa-map-marker" aria-hidden="true"></i></button>
                </div>
                <div class="ordered-pro-dtls">
                    <div class="pro-img-box col-xs-3">
                        <img src="images/products/escape2tumb.png"/>
                    </div>
                    <div class="col-xs-9">
                        <p class="cart-pro-heading">WAVES</p>
                        <p class="cart-pro-subheading">David of coolwater </p>
                        <p class="product-discp">Sed ut perspiciatis unde omnis iste natus error sit voluptatem.</p>
                    </div>
                    <div class="col-xs-12 price">AED 200</div>
                    <div class="col-xs-12 delivered-date">Delivered on Tue, Aug 10th ‘17
                        <span>Your item has been delivered</span>
                    </div>
                </div>
                <div class="pro-order-detail">
                    <p class="ordered-date">Ordered on Fri, Jul 25th ’17 </p>
                    <p class="order-total">Order Total: AED 200</p>
                </div>
            </div>

        </div>


    </div>
</div>

<div class="pad-20"></div>
