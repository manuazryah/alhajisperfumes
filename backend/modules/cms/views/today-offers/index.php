<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TodayOffersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Today Offers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="today-offers-index">

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                </div>
                <div class="panel-body">
                    <div class="table-responsive" style="border: none">
                        <button class="btn btn-white" id="search-option" style="float: right;">
                            <i class="linecons-search"></i>
                            <span>Search</span>
                        </button>
                        <?=
                        GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                                'title',
                                'link',
                                'image',
                                ['class' => 'yii\grid\ActionColumn',
                                    'template' => '{update}'],
                            ],
                        ]);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $(".filters").slideToggle();
        $("#search-option").click(function () {
            $(".filters").slideToggle();
        });
    });
</script>

