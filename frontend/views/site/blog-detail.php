<?php
/* @var $this yii\web\View */

use yii\helpers\Html;

if (isset($meta_title) && $meta_title != '')
    $this->title = $meta_title;
else
    $this->title = 'Linea De Bella';
?>

<section class="in-banner"><img src="<?= Yii::$app->homeUrl ?>images/banner/in-banner.jpg" class="img-fluid"></section>
<!--banner-->
<section class="in-breadcrumb-section"><!--in-breadcrumb-section-->
    <div class="container">
        <div class="main-breadcrumb"><a href="<?= Yii::$app->homeUrl ?>">Home</a><i>//</i><span>Blog</span> </div>
    </div>
</section><!--in-breadcrumb-section-->

<section class="in-blog-section"><!--in-blog-section-->
    <div class="container">

        <div class="blog-details-box">
            <div class="row">
                <div class="col-lg-8"><!--col-md-8-->
                    <h2><?= $blog_details->title ?></h2>
                    <div class="date"><?= date("F d, Y", strtotime($blog_details->blog_date)); ?></div>
                    <div class="img-box"><img src="<?= Yii::$app->homeUrl ?>uploads/cms/from-blog/<?= $blog_details->id ?>/large.<?= $blog_details->image ?>" alt="<?= $blog_details->title ?>" alt="<?= $blog_details->title ?>" class="img-fluid"></div>
                    <?= $blog_details->content ?>
                </div>
                <!--col-md-8-->
                <div class="col-lg-4">


                    <div class="blog-category-box">

                        <h2>Recent Posts</h2>
                        <div class=" blog-recent-posts">
                            <?php
                            if (!empty($recent_blogs)) {
                                foreach ($recent_blogs as $recent_blog) {
                                    if (!empty($recent_blog)) {
                                        ?>
                                        <div class="posts"><!--posts-->
                                            <div class="row">
                                                <div class="col-sm-5"><img src="<?= Yii::$app->homeUrl ?>uploads/cms/from-blog/<?= $recent_blog->id ?>/large.<?= $recent_blog->image ?>" alt="<?= $recent_blog->title ?>" alt="<?= $blog_details->title ?>" class="img-fluid"> </div>
                                                <div class="col-sm-7">
                                                    <?= Html::a('<h3>'.$recent_blog->title.'</h3>', ['/site/blog-detail','id'=> yii::$app->EncryptDecrypt->Encrypt('encrypt', $recent_blog->id)], ['class' => '']) ?>
                                                    <small><?= date("F d, Y", strtotime($recent_blog->blog_date)); ?></small>
                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </div>


    </div>
</section><!--in-blog-section-->