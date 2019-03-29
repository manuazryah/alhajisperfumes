<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
//use yii\grid\GridView;
use yii\widgets\ListView;
use yii\helpers\ArrayHelper;
use common\models\Category;
use common\models\SubCategory;
use yii\helpers\Url;

$this->title = 'Product';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>This is the Product page. You may modify the following file to customize its content:</p>
    <div class="row">
        <div class="col-sm-3">
            <h3>Other Products</h3>
            <?php foreach ($category as $catgry) { ?>
                <li><a href="<?= Yii::$app->homeUrl . 'product/category?id=' . $catgry->id ?>"><?= $catgry->category ?></a></li>
            <?php } ?>
        </div>
        <div class="col-sm-8">
            <h3>Featured Products</h3>
            <ul class="nav nav-tabs">
                <li class="active"><a href="#women">Women</a></li>
                <li><a href="#men">Men</a></li>
            </ul>

            <?=
            ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => '_view2',
            ]);
            ?>
        </div>
    </div>

</div>
