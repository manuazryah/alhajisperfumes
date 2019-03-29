<?php

use yii\helpers\Html;
?>
<div class="my-account-category">
    <div class="account-top-details">
        <div class="img-box"><img src="<?= Yii::$app->homeUrl ?>images/icons/account-img.png" width="66" height="66"></div>
        <h2 class="account-name"><?= Yii::$app->user->identity->first_name ?></h2>
        <h3 class="account-mail"><?= Yii::$app->user->identity->email ?></h3>
    </div>
    <div class="category-list">
        <ul>
            <li><?= Html::a('My Orders', ['/myaccounts/my-orders/index']) ?></li>
            <li><?= Html::a('Shipping Addresses', ['/myaccounts/user/user-address']) ?></li>
            <li><?= Html::a('Wish Lists', ['/myaccounts/user/wish-list']) ?></li>
            <li><?= Html::a('Account Settings', ['/myaccounts/user/personal-info']) ?></li>
        </ul>
    </div>
</div>