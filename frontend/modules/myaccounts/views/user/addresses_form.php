<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Emirates;
?>
<div id="wpo-mainbody" class="container wpo-mainbody">

    <nav class="woocommerce-breadcrumb"><a class="home" href="">Home</a>&nbsp;/&nbsp;My Account</nav>

    <div id="my-aacount">
        <section class="wrapper sec-space my-account">                  
            <div class="container">
                <!-- My Account Starts -->
                <div class="row">  
                    <!-- Sidebar Starts --> 
                    <div class="col-md-3">
                        <?= Yii::$app->controller->renderPartial('_leftside_menu'); ?>
                    </div>

                    <!-- Sidebar Ends --> 

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