<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Emirates;
use yii\helpers\ArrayHelper;
use yii\widgets\ListView;
use common\components\EmptyDataWidget;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="top-margin"></div>
<section class="in-account-pages-section"><!--in-account-pages-section-->
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <?= \common\components\MyAccountMenuWidget::widget() ?>
            </div>
            <div class="col-lg-9">
                <div class="in-track-your-orders">
                    <div class="head-main-box">
                        <h3 class="head">Wish Lists</h3>
                    </div>
                    <div class="in-wish-list-details">
                        <?php
                        if ($dataProvider->totalCount > 0) {
                            ?>
                            <?=
                            ListView::widget([
                                'dataProvider' => $dataProvider,
                                'itemView' => 'my_wish_list',
                                'pager' => [
                                    'firstPageLabel' => 'first',
                                    'lastPageLabel' => 'last',
                                    'prevPageLabel' => '<',
                                    'nextPageLabel' => '>',
                                    'maxButtonCount' => 3,
                                ],
                            ]);
                            ?>


                            <?php
                        } else {
                            ?>
                            <div class="in-your-wishlist-empty">
                                <div class="img-box"><img src="<?= Yii::$app->homeUrl ?>images/your-wishlist-empty.png" class="img-responsive"></div>
                                <div class="cont">
                                    <h3 class="haed">Your Wishlist Empty</h3>
                                    <h4 class="sub-haed">There are no items in your wishlist</h4>
                                    <?= Html::a('Continue shopping', ['/site/index'], ['class' => 'link']) ?>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>