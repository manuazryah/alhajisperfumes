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
use common\components\SidemenuWidgetBrand;

if (isset($meta_title) && $meta_title != '')
    $this->title = $meta_title;
else
    $this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
$current_action = Yii::$app->controller->action->id; // controller action id
$gender_params = \yii::$app->getRequest()->getQueryParams();

?>


<div id="wpo-mainbody product" class="container wpo-mainbody">

    <nav class="woocommerce-breadcrumb"><a class="home" href="">Home</a>&nbsp;/&nbsp;<a href="">Brand</a>&nbsp;/&nbsp;<?= isset($breadcrumb)? ucfirst($breadcrumb):'' ?></nav>
    <section class="wpo-content-product content-product">

        <div class="row">
            <section id="product" class="col-xs-12 col-sm-8 col-sm-push-4 col-md-9 col-md-push-3 no-sidebar-right">
                <div id="wpo-main-content" class="wpo-content">

                    <div class="products">


                        <div class="row">
                            <?=
                            $dataProvider->totalcount > 0 ? ListView::widget([
                                        'dataProvider' => $dataProvider,
                                        'itemView' => '_view2',
                                        'pager' => [
                                            'firstPageLabel' => 'first',
                                            'lastPageLabel' => 'last',
                                            'prevPageLabel' => '<',
                                            'nextPageLabel' => '>',
                                            'maxButtonCount' => 5,
                                        ],
                                    ]) : $this->render('no_product');
                            ?>

                        </div>
                    </div>
                </div>
            </section>
            <?php
            $brand_list = common\models\Brand::find()->where(['status' => 1])->groupBy(['brand'])->all();
            ?>
            <?= SidemenuWidgetBrand::widget(['brand_list' => $brand_list, 'fragrance_filter' => $fragrance_filter]) ?>

        </div>
    </section>
</div>


