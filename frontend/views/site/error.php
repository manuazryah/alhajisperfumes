<?php
/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = 'Al Hajis Perfumes';
?>
<div class="top-margin"></div>
<section class="in-not-found-section"><!--in-download-section-->
        <div class="container">
                <h2 class="head-one">404</h2>
                <h3 class="head-two">PAGE NOT FOUND</h3>
                <h4 class="head-three">the page you are looking for is not found</h4>
                <p>The page you are looking for does not exist. It may have been moved, or removed altogether. Perhaps you can return back to the site’s homepage and see if you can find what you are looking for.</p>
                <a href="<?= Yii::$app->homeUrl ?>" class="link"> Back to homepage </a>
        </div>
</section>
