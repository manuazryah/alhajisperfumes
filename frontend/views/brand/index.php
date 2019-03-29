<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Product;
use common\models\User;
?>
<div class="top-margin"></div>
<div class="breadcrumb">
    <div class="container">
        <ul>
            <li> <?= Html::a('Home', ['/site/index']) ?></li>
            <li><a class="current" href="javascript:void(0)">Brand</a></li>
        </ul>
    </div>
</div>
<div id="wpo-mainbody" class="container wpo-mainbody">
    <div class="row">
        <!-- MAIN CONTENT -->
        <div id="wpo-content" class="wpo-content col-xs-12 no-sidebar">
            <article id="post-8" class="post-8 page type-page status-publish hentry">
                <div class="content in-brand-section">
                    <div class="woocommerce">
                        <div class="brand-index"> <b>Brand Index:</b> 
                            <a class="index" data_l= "0" href="#0"> 0 - 9</a>    
                            <a class="index" data_l= "A" href="#A">A </a>  
                            <a class="index" data_l= "B" href="#B"> B </a>   
                            <a class="index" data_l= "C" href="#C">C </a>   
                            <a class="index" data_l= "D" href="#D">D</a>    
                            <a class="index" data_l= "E" href="#E">E</a>    
                            <a class="index" data_l= "F" href="#F">F </a>   
                            <a class="index" data_l= "G" href="#G">G</a>    
                            <a class="index" data_l= "H" href="#H">H</a>    
                            <a class="index" data_l= "I" href="#I">I</a>    
                            <a class="index" data_l= "J" href="#J">J</a>    
                            <a class="index" data_l= "K" href="#K">K</a>    
                            <a class="index" data_l= "L" href="#L">L</a>    
                            <a class="index" data_l= "M" href="#M">M</a>    
                            <a class="index" data_l= "N" href="#N">N</a>   
                            <a class="index" data_l= "O" href="#O">O</a>   
                            <a class="index" data_l= "P" href="#P">P </a>   
                            <a class="index" data_l= "Q" href="#q">Q </a>   
                            <a class="index" data_l= "R" href="#R">R</a>    
                            <a class="index" data_l= "S" href="#S">S</a>    
                            <a class="index" data_l= "T" href="#T">T</a>    
                            <a class="index" data_l= "U" href="#U">U</a>    
                            <a class="index" data_l= "V" href="#V">V</a>    
                            <a class="index" data_l= "W" href="#W">W</a>    
                            <a class="index" data_l= "X" href="#X">X </a>   
                            <a class="index" data_l= "Y" href="#Y">Y</a>    
                            <a class="index" data_l= "Z" href="#Z">Z</a>
                        </div>

                        <div class="barnd-box" id="0">
                            <div class="alpha-order">0 - 9</div>
                            <div class="row">
                                <?php
                                foreach ($brands as $brand) {
                                    $product_image = Yii::$app->basePath . '/../uploads/cms/brands/' . $brand->id . '/large.' . $brand->image;
                                    if (file_exists($product_image)) {
                                        $first_letter = substr($brand->brand, 0, 1);
                                        if (is_numeric($first_letter)) {
                                            ?>
                                            <div class="col-md-2 col-sm-3 brands" >

                                                <a class=" brand-logo" href="<?= Yii::$app->homeUrl . 'product/index?brand=' . $brand->brand ?>">
                                                    <img src="<?= Yii::$app->homeUrl . 'uploads/cms/brands/' . $brand->id . '/large.' . $brand->image ?>" class="attachment-shop_single wp-post-image" width="200px" height="110px" alt="product13"></a>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <?php
                        foreach (range('A', 'Z') as $char) {
                            $query = "SELECT * FROM `brand` WHERE `brand` LIKE '" . $char . "%'";
                            $brands = \common\models\Brand::findBySql($query)->all();
                            if (!empty($brands)) {
                                ?>
                                <section id="<?= $char ?>"></section>
                                <div class="brand-div sector_<?= $char ?>" >
                                    <div class="alpha-ordera"></div>
                                    <div class="row">
                                        <!--<h3>asdsds  dd dasd </h3>-->
                                    </div>
                                </div>
                                <div class="barnd-box" id="<?= $char ?>">
                                    <div class="alpha-order"><?= $char ?></div>
                                    <div class="row">
                                        <?php
                                        foreach ($brands as $brand) {
                                            $product_image = Yii::$app->basePath . '/../uploads/cms/brands/' . $brand->id . '/large.' . $brand->image;
                                            if (file_exists($product_image)) {
                                                $first_letter = substr($brand->brand, 0, 1);
                                                if ($first_letter == $char || $first_letter == strtolower($char)) {
                                                    ?>
                                                    <div class="col-md-2 col-sm-3 brands" >

                                                        <a class=" brand-logo" href="<?= Yii::$app->homeUrl . 'product/index?brand=' . $brand->brand ?>">
                                                            <img src="<?= Yii::$app->homeUrl . 'uploads/cms/brands/' . $brand->id . '/large.' . $brand->image ?>" class="attachment-shop_single wp-post-image" width="200px" height="110px" alt="product13"></a>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php
                        }
                        ?>


                    </div>
                </div>
            </article>
        </div>
    </div>
</div>
<script>
    $('.index').click(function () {
        var id = $(this).attr('data_l');
        $('.brand-div').css('display', 'none');
        $('.sector_' + id).css('display', 'block');
    });
</script>