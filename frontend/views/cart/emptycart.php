<?php

use yii\helpers\Html;

if (isset($meta_title) && $meta_title != '')
    $this->title = $meta_title;
else
    $this->title = 'Shopping Cart';
?>
<style>
    .emptycart h2{
        font-size: 16px;
        text-align: center;
        display: block;
        color: rgba(84, 82, 81, 0.57);
        margin-bottom: 10px;
    }
    .empty-img img{
        margin: 0 auto;
        display: block;
    }
</style>

<div class="top-margin"></div>
<div class="breadcrumb">
    <div class="container">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a class="current" href="javascript:void(0)">Cart</a></li>
        </ul>
    </div>
</div>
<section id="cart-page">
    <div class="container">
        <div class="empty-outer">
            <div class="empty-img">
                <img class="img-fluid" src="<?= Yii::$app->homeUrl; ?>images/cart-empty.png"/>
            </div>
            <h3 class="head">Your Shopping Cart is Empty !</h3>
            <a href="<?= Yii::$app->homeUrl ?>" class="link">Continue shopping</a>
        </div>
    </div>
</section>
