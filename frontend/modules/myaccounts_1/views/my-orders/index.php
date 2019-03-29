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
                </div>
            </div>
        </div>
    </div>
</section>
