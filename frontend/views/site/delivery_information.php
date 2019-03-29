<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;

if (isset($meta_title) && $meta_title != '')
    $this->title = $meta_title;
else
    $this->title = 'Alhajis Perfumes';
?>

<div class="top-margin"></div>
<div class="breadcrumb">
    <div class="container">
        <ul>
            <li> <?= Html::a('Home', ['/site/index']) ?></li>
            <li><a class="current" href="javascript:void(0)">Delivery Information</a></li>
        </ul>
    </div>
</div>


<section id="delivery-info">
    <div class="container">
        <div class="info-sec">
            <div class="row">
                <div class="col-12">
                    <div class="sec-title">
                        <h4 class="heading">Delivery Information</h4>
                        <span class="title">Al Hajis Group</span>
                    </div>
<?= $model->delivery_information ?>
                </div>

            </div>
        </div>
</section>

