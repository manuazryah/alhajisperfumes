<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\widgets\ListView;
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
                    <aside class="col-md-9 col-sm-8">

                        <div id="reviews-ratings">

                            <h3 class="title2">Reviews</h3>
                            <br/>

                            <?=
                            ListView::widget([
                                'dataProvider' => $dataProvider,
                                'itemView' => 'my_reviews',
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

                    </aside>
                    <!-- Product Details Ends --> 
                </div>
                <!-- / My Account Ends -->
            </div>

        </section>
    </div>

</div>