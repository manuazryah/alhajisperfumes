<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
?>
<div id="wpo-mainbody" class="container wpo-mainbody">

    <nav class="woocommerce-breadcrumb"><a class="home" href="">Home</a>&nbsp;/&nbsp;My Account</nav>

    <div id="my-aacount">
        <section class="wrapper sec-space my-account">                  
            <div class="container">
                <!-- My Account Starts -->
                <div class="row">  
                    <div class="col-md-3">
                        <?= Yii::$app->controller->renderPartial('_leftside_menu'); ?>
                    </div>

                    <!-- Product Details Starts--> 
                    <?=
                    Yii::$app->controller->renderPartial('_form', [
                        'model' => $model,
                        'country_codes' => $country_codes,
                    ]);
                    ?>
                    <!-- Product Details Ends --> 
                </div>
                <!-- / My Account Ends -->
            </div>

        </section>
    </div>

</div>
