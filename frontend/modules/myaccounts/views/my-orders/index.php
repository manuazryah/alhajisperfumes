<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\widgets\ListView;
use common\components\EmptyDataWidget;
?>
<div class="top-margin"></div>
<section class="in-account-pages-section"><!--in-account-pages-section-->
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <?= \common\components\MyAccountMenuWidget::widget() ?>
            </div>
            <div class="col-lg-9" >
                <div class="in-track-your-orders">
                    <div class="head-main-box">
                        <h3 class="head">Track Your Orders</h3>
                    </div>
                    <?php
                    if ($dataProvider->totalCount > 0) {
                        ?>
                        <?=
                        ListView::widget([
                            'dataProvider' => $dataProvider,
                            'itemView' => 'my-orders',
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
                            <div class="img-box"><img src="<?= Yii::$app->homeUrl ?>images/empty_order.png" class="img-responsive"></div>
                            <div class="cont">
                                <h3 class="haed">Empty Order</h3>
                                <h4 class="sub-haed">You have not placed any orders</h4>
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
</section>
