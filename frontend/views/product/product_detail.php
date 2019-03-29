<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use common\models\Unit;
use common\models\Product;

if (isset($product_details->meta_title) && $product_details->meta_title != '')
    $this->title = $product_details->meta_title;
else
    $this->title = $product_details->canonical_name;
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="top-margin"></div>
<div class="breadcrumb">
    <div class="container">
        <ul>
            <?php
            $catag = common\models\Category::find()->one();
            ?>
            <li><?= Html::a('Home', ['/site/index']) ?></li>
            <li class="active">Product Detail</li>
        </ul>
    </div>
</div>

<section id="detail-page">
    <div class="container">
        <div class="product-view">
            <div class="alert alert-success alert-dismissible hide">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Success!</strong> Product successfully added to cart.
			</div>
			
			<div class="alert alert-success alert-dismissible wishlist_hide wishlist_message">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Success!</strong> Product successfully added to your wishlist.
            </div>
			
            <div class="row">
                <div class="col-md-12  hidden-xl">
                    <div class="head">
                        <h2 class="heading"><?= $product_details->product_name ?></h2>
                        <?php $fregrance = \common\models\Fregrance::findOne($product_details->product_type); ?>
<!--                        <p>Fragrance Type:	<span><?php
                                if (isset($fregrance->name) && $fregrance->name != '') {
                                    echo $fregrance->name;
                                }
                                ?></span></p>-->
                        <ul>
                            <li>
                                <div class="rating">
                                    <span class="fas fa-star checked"></span>
                                    <span class="fas fa-star checked"></span>
                                    <span class="fas fa-star checked"></span>
                                    <span class="fas fa-star"></span>
                                    <span class="fas fa-star"></span>
                                </div> 
                            </li>
                            <li>(3.0)  reviews</li>
                            <li><a href="">Write a review</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="product-view-zoom">
                        <!--<div class="row">-->
                        <div class="col-12 pad0">
                            <div class="app-figure" id="zoom-fig">
                                <?php
                                $product_image = Yii::$app->basePath . '/../uploads/product/' . $product_details->id . '/profile/' . $product_details->canonical_name . '.' . $product_details->profile;
                                if (file_exists($product_image)) {
                                    ?>
                                    <a id="Zoom-1" class="MagicZoom" title="" href="<?= Yii::$app->homeUrl . 'uploads/product/' . $product_details->id . '/profile/' . $product_details->canonical_name . '_big.' . $product_details->profile ?>">
                                        <img src="<?= Yii::$app->homeUrl . 'uploads/product/' . $product_details->id . '/profile/' . $product_details->canonical_name . '_big.' . $product_details->profile ?>?scale.height='400'" alt=""/>
                                    </a>
                                    <?php
                                } else {
                                    ?>
                                    <a>
                                        <img src="<?= Yii::$app->homeUrl . 'uploads/product/gallery_dummy.png' ?>?scale.height='400'" alt=""/>
                                    </a>
                                <?php }
                                ?>
                                <div class="selectors">
                                    <?php
                                    if (file_exists($product_image)) {
                                        ?>
                                        <a data-zoom-id = "Zoom-1" href = "<?= Yii::$app->homeUrl . 'uploads/product/' . $product_details->id . '/profile/' . $product_details->canonical_name . '_big.' . $product_details->profile ?>">
                                            <img srcset = "<?= Yii::$app->homeUrl . 'uploads/product/' . $product_details->id . '/profile/' . $product_details->canonical_name . '_big.' . $product_details->profile ?>" width = "94px" height = "93px" class = "thumb-style"/>
                                        </a>
                                    <?php }
                                    ?>


                                    <?php
                                    $path = Yii::getAlias('@paths') . '/product/' . $product_details->id . '/gallery_thumb';
                                    if (file_exists($product_image)) {
                                        if (count(glob("{$path}/*")) > 0) {

                                            $k = 0;
                                            foreach (glob("{$path}/*") as $file) {
                                                if ($k <= '2') {
                                                    $k++;
                                                    $arry = explode('/', $file);
                                                    $img_nmee = end($arry);
                                                    $img_nmees = explode('.', $img_nmee);
                                                    if ($img_nmees['1'] != '') {
                                                        ?>
                                                        <a data-zoom-id="Zoom-1" href="<?= Yii::$app->homeUrl . 'uploads/product/' . $product_details->id . '/gallery/' . end($arry) ?>">
                                                            <img srcset="<?= Yii::$app->homeUrl . 'uploads/product/' . $product_details->id . '/gallery/' . end($arry) ?>" width="94px" height="93px" class="thumb-style"/>
                                                        </a>
                                                        <?php
                                                    }
                                                }
                                            }
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <!--</div>-->
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="head hidden-md hidden-sm hidden-xs">
                        <h2 class="heading"><?= $product_details->product_name ?></h2>
                        <ul>
                            <li>
                                <div class="rating">
                                    <span class="fas fa-star checked"></span>
                                    <span class="fas fa-star checked"></span>
                                    <span class="fas fa-star checked"></span>
                                    <span class="fas fa-star"></span>
                                    <span class="fas fa-star"></span>
                                </div> 
                            </li>
                            <li>(3.0)  reviews</li>
                            <li><a href="">Write a review</a></li>
                        </ul>
                    </div>
                    <div class="product-details">
                        <div class="row">
                            <div class="col-md-6 lft-box">
                                <div class="price-details">
                                    <?php
                                    if ($product_details->offer_price != "0" && isset($product_details->offer_price)) {
                                        $percentage = round(100 - (($product_details->offer_price / $product_details->price) * 100));
                                        $main_price = $product_details->offer_price;
                                        $price = 'AED ' . $product_details->price;
                                        ?>
                                        <?php
                                    } else {
                                        $main_price = $product_details->price;
                                        $price = '';
                                    }
                                    ?>
                                    <p class="current-price"><span>AED <?= $main_price ?></span></p>
                                    <?php if ($product_details->offer_price != "0" && isset($product_details->offer_price)) { ?>
                                        <p class="actual-price">was <span><?= $price ?></span> <span class="off-price"><?= $percentage ?>% OFF</span></p>
                                    <?php } ?>
                                    <p class="cash-delivery-tag">Inclusive of VAT</p>
                                </div>
                                <div class="item-detail">
                                    <?php
                                    if (isset($product_details->brand)) {
                                        $brand = common\models\Brand::findOne($product_details->brand);
                                        ?>
                                    <?php }
                                    ?>

                                    <p>Brand: <a href="<?= Yii::$app->homeUrl . 'product/index?brand=' . $brand->brand ?>"><?= $brand->brand ?>.</a></p>
                                    
                                    <?php
                                                                        if (isset($product_details->gender_type)) {

                                                                                if ($product_details->gender_type == 0) {
                                                                                        $targeted = 'Men';
                                                                                } else if ($product_details->gender_type == 1) {
                                                                                        $targeted = 'Women';
                                                                                } else if ($product_details->gender_type == 2) {
                                                                                        $targeted = 'Unisex';
                                                                                } else if ($product_details->gender_type == 3) {
                                                                                        $targeted = 'Oriental';
                                                                                }
                                                                                ?>
                                                                                <p>Targeted Group: <span><?= $targeted ?>.</span></p>
                                                                        <?php } ?>
                                    
                                    <?php if (isset($fregrance->name) && $fregrance->name != '') { ?>
                                        <p>Fragrance type: <span><?= $fregrance->name ?></span></p>
                                    <?php } ?>
                                    <?php
                                    $unit = Unit::findOne($product_details->size_unit);
                                    $unit_name = '';
                                    if (isset($unit->unit_name) && $unit->unit_name != '') {
                                        $unit_name = $unit->unit_name;
                                    }
                                    ?>
                                    <p>Sizes: <span><?= $product_details->size . $unit_name ?></span></p>
                                    <p>Product Code: <span><?= $product_details->ean_value ?></span></p>
                                </div>
                            </div>
                            <div class="col-md-6 rit-box">
                                <div class="action-details">
                                    <?php if ($product_details->stock > 0) { ?>
                                        <p class="stock-detail">In stock online</p>
                                    <?php } ?>
                                    <div class="form-group quantity">
                                        <label>Quantity</label>
                                        <select class="form-control  quantity_" id="quantity_" name="Quantity">
                                            <?php
                                            for ($i = 1; $i <= $product_details->stock; $i++) {
                                                ?>
                                                <option value="<?= $i ?>"><?= $i ?></option>
                                            <?php } ?>
                                        </select>                      
                                    </div>
                                    <?= Html::a('<i class="fas fa-heart"></i>wishlist', 'javascript:void(0)', ['class' => 'wish-list-btn add_to_wish_list', 'id' => $product_details->canonical_name, 'title' => 'save to wish list']) ?>
                                    <!--<a href="" class="wish-list-btn"><i class="fas fa-heart"></i>wishlist</a>-->
                                    <div class="clear"></div>
                                    <div class="spcl-delivery">
                                        Enjoy Next Business Day Delivery Order Before <span class="time">2: 00 PM</span>
                                    </div>
                                    <div class="button-box"> 
                                        <a href="javascript:void(0)" class="add-2-bag add_cart added-msg" pro_id="<?= $product_details->canonical_name ?>"><icon><img class="img-fluid" src="<?= yii::$app->homeUrl; ?>images/icons/bag2.png"/></icon>Add to bag</a>
                                        <a href="javascript:void(0)" class="buy-now" pro_id="<?= $product_details->canonical_name ?>">Buy now</a>
                                    </div>
                                    <div class="payment-optns">
                                        <p>Ways you can pay</p>
                                        <ul>
                                            <li><img src="<?= Yii::$app->homeUrl ?>images/icons/visa-pay.png" class="img-fluid"/></li>
                                            <li><img src="<?= Yii::$app->homeUrl ?>images/icons/master-pay.png" class="img-fluid"/></li>
                                            <li><img src="<?= Yii::$app->homeUrl ?>images/icons/cod-pay.png" class="img-fluid"/></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="special-details">
                        <ul>
                            <li><icon><img src="<?= Yii::$app->homeUrl ?>images/icons/cod.png" class="img-fluid" width="46" height="46"/></icon>Cash On Delivery <span>Receive products in amazing time</span></li>
                            <li><icon><img src="<?= Yii::$app->homeUrl ?>images/icons/freeshipping.png" class="img-fluid" width="46" height="46"/></icon>Free SHIPPING <span>Receive products in amazing time</span></li>
                            <li><icon><img src="<?= Yii::$app->homeUrl ?>images/icons/authentic.png" class="img-fluid" width="46" height="46"/></icon>100%  AUTHENTIC <span>We only sell 100% authentic products</span></li>
                            <li><icon><img src="<?= Yii::$app->homeUrl ?>images/icons/secure.png" class="img-fluid" width="46" height="46"/></icon>SECURE SHOPPING <span>Your data is always protected</span></li>
                        </ul>
                    </div>
                    <div class="clear"></div>
                </div>
                
            </div>
        </div>

        <section id="reviews-section">
            <div class="product-info-tab">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#info" aria-expanded="false" class="active">Item Details</a></li>
                    <li class=""><a data-toggle="tab" href="#reviews" aria-expanded="true" class="">Reviews & Ratings</a></li>
                </ul>

                <div class="tab-content">
                    <div id="info" class="tab-pane fade active show">
                        <p><?= $product_details->product_detail ?></p>
                    </div>
                    <div id="reviews" class="tab-pane fade">
                        <div class="review-adding-sec">
                            <h4>Customer Reviews</h4>
                            <div class="ratings">
                                <div class="stars">
                                    <fieldset class="rating">
                                        <input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                                        <input type="radio" id="star4half" name="rating" value="4 and a half" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                                        <input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                                        <input type="radio" id="star3half" name="rating" value="3 and a half" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
                                        <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
                                        <input type="radio" id="star2half" name="rating" value="2 and a half" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                                        <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                                        <input type="radio" id="star1half" name="rating" value="1 and a half" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                                        <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                                        <input type="radio" id="starhalf" name="rating" value="half" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
                                    </fieldset>
                                    <?php
                                    if (count($product_reveiws) > 0) {
                                        $review_count = '( ' . count($product_reveiws) . ' )';
                                    } else {
                                        $review_count = '';
                                    }
                                    ?>
                                    <p class="review-base">Based on <?= $review_count ?> Reviews</p>
                                </div>
                                <?php if (isset(Yii::$app->user->identity->id)) { ?>
                                    <a class="add-review" id="add-review" href="#" val="<?= $product_details->id ?>">add review</a>
                                <?php } ?>
                            </div>
                        </div>
                        <?php
                        foreach ($product_reveiws as $reveiws) {
                            ?>
                            <div class="customer-reviews">
                                <p class="subject"><?= date("M d , Y", strtotime($reveiws->review_date)) ?></p>
                                <p class="message"><?= $reveiws->description ?></p>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </section>

        <?php
        if (!empty($related_poduct)) {
            ?>
            <section id="branches">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="sec-title">
                                <h4 class="heading">Related products</h4>
                                <span class="title">Al Hajis Group</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="related-products-slider">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="carousel-controls related-products-carousel-controls">

                                    <div class="related-products-carousel">
                                        <?php
                                        foreach ($related_poduct as $latest_product) {
                                            if (!empty($latest_product) && $latest_product != '') {
                                                $product_exist = Product::findOne($latest_product->id);
                                                if ($product_exist->stock > 0) {
                                                    ?>
                                                    <?= \common\components\InnerProductWidget::widget(['id' => $latest_product->id]) ?>
                                                    <?php
                                                }
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php } ?>
        <?php
        if (isset(Yii::$app->user->identity->id)) {
            $recently_viewed = \common\models\RecentlyViewed::find()->where(['user_id' => Yii::$app->user->identity->id])->orderBy(['id' => SORT_DESC])->offset(1)->all();
        } else if (isset(Yii::$app->session['temp_user_product']) || Yii::$app->session['temp_user_product'] != '') {
            $recently_viewed = \common\models\RecentlyViewed::find()->where(['session_id' => Yii::$app->session['temp_user_product']])->orderBy(['id' => SORT_DESC])->offset(1)->all();
        }
        ?>
        <?php if (!empty($recently_viewed)) { ?>
            <section id="branches">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="sec-title">
                                <h4 class="heading">Recently Viewed products</h4>
                                <span class="title">Al Hajis Group</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="related-products-slider">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="carousel-controls related-products-carousel-controls">

                                    <div class="related-products-carousel">
                                        <?php
                                        foreach ($recently_viewed as $recent) {
                                            if (!empty($recent) && $recent != '') {
                                                
                                                $product_exist = Product::findOne($recent->product_id);
                                                if(isset($product_exist)){
                                                
                                                if ($product_exist->stock > 0) {
                                                    ?>
                                                    <?= \common\components\InnerProductWidget::widget(['id' => $recent->product_id]) ?>
                                                    <?php
                                                }
                                            }
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php } ?>
    </div>
</section>
<div class="settings-edit-popup">
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-md" role="document" id="data-content">


        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $(document).on('click', '.added-msg', function (e) {
			$('.alert-success').removeClass('hide');
			setTimeout(function () {
				$('.alert-success').remove();
			}, 2000);
		});
        $(document).on('click', '#add-review', function (e) {
            e.preventDefault();
            var product = $(this).attr('val');
            $.ajax({
                type: 'POST',
                url: homeUrl + 'product/review',
                data: {product: product},
                success: function (data) {
                    $("#data-content").html(data);
                    $('#exampleModal').modal('show', {backdrop: 'static'});
                }
            });
        });


        $(document).on('submit', '#submit-reviews', function (e) {
            e.preventDefault();
            var str = jQuery(this).serialize();
            $.ajax({
                url: '<?= Yii::$app->homeUrl; ?>product/submit-review',
                type: "POST",
                data: str,
                success: function (data) {
                    var obj = JSON.parse(data);
                    $('#submit-reviews')[0].reset();
                    if (obj.result == 1) {
                        $(".modal-header").after("<p class='contact-sucess-mag'>Review added successfully</p>");
                    }
                    setTimeout(function () {
                        $('#exampleModal').modal('hide');
                    }, 3000);
                }
            });
            return false;
        });
    });
</script>
