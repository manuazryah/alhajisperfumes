<?php

use yii\helpers\Html;
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 customer-reviews orders-box active">
    <div class="pro-img-box col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <?php
        $product = \common\models\Product::findOne($model->product_id);
        $product_image = Yii::$app->basePath . '/../uploads/product/' . $product->id . '/profile/' . $product->canonical_name . '_thumb.' . $product->profile;
        if (file_exists($product_image)) {
            ?>
            <img src="<?= Yii::$app->homeUrl . 'uploads/product/' . $product->id . '/profile/' . $product->canonical_name . '_thumb.' . $product->profile ?>" width="90" height="90" alt="1" />
            <?php
        } else {
            ?>
            <img src="<?= Yii::$app->homeUrl . 'uploads/product/profile_thumb.png' ?>" width="90" height="90" alt="1" />
        <?php }
        ?>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
        <p class="subject"> <?= $model->tittle ?></p>
        <i><?= \common\models\User::findOne($model->user_id)->first_name ?> on <?= date("M d , Y", strtotime($model->review_date)) ?></i>
        <p class="message"><?= $model->description ?></p>
    </div>
</div>


