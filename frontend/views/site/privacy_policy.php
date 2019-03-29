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
            <li><a class="current" href="javascript:void(0)">Privacy Policy</a></li>
        </ul>
    </div>
</div>


<section id="about-page">
    <div class="container">
        <div class="about-sec">
            <div class="row">
               
                <div class="col-12">
                     <?= $model->privacy_policy ?>
                </div>
             
            </div>
        </div>
</section>

