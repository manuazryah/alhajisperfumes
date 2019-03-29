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
        <div class="main-heading">
            <h2 class="head-one">Our Blog</h2>
            <h3 class="head-small">Linea De Belle</h3>
        </div>
        <div class="row">
            <?php
            if (!empty($blog_datas)) {
                foreach ($blog_datas as $blog_data) {
                    if (!empty($blog_data)) {
                        ?>
                        <div class="col-lg-4">
                            <div class="blog-box">
                                <div class="img-box"><img src="<?= Yii::$app->homeUrl ?>uploads/cms/from-blog/<?= $blog_data->id ?>/large.<?= $blog_data->image ?>" alt="<?= $blog_data->title ?>" class="img-fluid"></div>
                                <?php
                                if(strlen($blog_data->title) > 24){
                                    $blog_title = substr($blog_data->title, 0, 28).'..';
                                }else{
                                    $blog_title = $blog_data->title;
                                }
                                ?>
                                <h4 class="head" title="<?= $blog_data->title ?>"><?= $blog_title ?></h4>
                                <p><?= $blog_data->content_for_home_page ?></p>
                                <?= Html::a('Read More', ['/site/blog-detail','id'=>yii::$app->EncryptDecrypt->Encrypt('encrypt', $blog_data->id)], ['class' => 'link']) ?>
                            </div>
                        </div>
                        <?php
                    }
                }
            }
            ?>
        </div>
    </div>
</section><!--in-blog-section-->

