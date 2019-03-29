<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use common\models\User;
//use kartik\daterange\DateRangePicker;
//use kartik\datetime\DateTimePicker;
use common\models\OrderMaster;

/* @var $this yii\web\View */
/* @var $searchModel common\models\OrderMasterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Return Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-master-index">

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                </div>
                <div class="panel-body">



                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>



                    <?php // ech  Html::a('<i class="fa-th-list"></i><span> Create Order Master</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                    <div class="table-responsive" style="border: none">
                        <button class="btn btn-white" id="search-option" style="float: right;">
                            <i class="linecons-search"></i>
                            <span>Search</span>
                        </button>
                        <?=
                        GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'rowOptions' => function ($model, $key, $index, $grid) {
                                return ['id' => $model['id']];
                            },
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                                [
                                    'attribute' => 'order_id',
                                    'format' => 'raw',
                                    'value' => function ($data) {
                                        if (isset($data->order_id)) {
                                            return \yii\helpers\Html::a($data->order_id, ['/order/order-master/return-view', 'id' => $data->order_id], ['target' => '_blank']);
                                        } else {
                                            return '';
                                        }
                                    },
                                ],
                                [
                                    'attribute' => 'user_id',
                                    'format' => 'raw',
                                    'filter' => ArrayHelper::map(User::find()->all(), 'id', 'first_name'),
                                    'value' => function ($data) {
                                        $name = User::findOne($data->user_id);
                                        return \yii\helpers\Html::a($name->first_name . ' ' . $name->last_name, ['/user/user/update', 'id' => $data->user_id], ['target' => '_blank']);
                                    },
                                ],
                                'net_amount',
                                [
                                    // the attribute
                                    'attribute' => 'order_date',
                                    // format the value
                                    'value' => function ($data) {
                                        return date("Y-m-d", strtotime($data->order_date));
                                    },
                                    // some styling?
                                    'headerOptions' => [
                                        'class' => 'col-md-2'
                                    ],
                                    // here we render the widget
                                   
                                ],
                                [
                                    'attribute' => 'payment_status',
                                    'format' => 'raw',
                                    'filter' => ['0' => 'Pending', '1' => 'Success', '2' => 'Failed', '3' => 'COD'],
                                    'value' => function ($data) {
                                        if (isset($data->payment_status)) {
                                            if ($data->payment_status == '0')
                                                $status = 'Pending';
                                            if ($data->payment_status == '1')
                                                $status = 'Success';
                                            if ($data->payment_status == '2')
                                                $status = 'Failed';
                                            if ($data->payment_status == '3')
                                                $status = 'COD';
//                                            return $data->payment_status;
                                            return $status;
                                        } else {
                                            return '';
                                        }
                                    },
                                ],
                                [
                                    'attribute' => 'User status',
                                    'format' => 'raw',
                                    'filter' => ['4' => 'User Confirmed', '5' => 'User Cancelled'],
                                    'value' => function ($data) {
                                        $status = '';
                                        if (isset($data->status)) {
                                            if ($data->status == '4')
                                                $status = 'User Confirmed';
                                            if ($data->status == '5')
                                                $status = 'User Cancelled';
                                            return $status;
                                        } else {
                                            return '';
                                        }
                                    },
                                ],
                                [
                                    'attribute' => 'admin_status',
                                    'format' => 'raw',
                                    'value' => function ($data) {
                                        if (isset($data->admin_status)) {
                                            if ($data->admin_status == '0')
                                                $status = 'Pending';
                                            if ($data->admin_status == '1')
                                                $status = 'Order Placed';
                                            if ($data->admin_status == '2')
                                                $status = 'Order Packed';
                                            if ($data->admin_status == '3')
                                                $status = 'Order Dispatched';
                                            if ($data->admin_status == '4')
                                                $status = 'Order Delivered';
                                            if ($data->admin_status == '5')
                                                $status = 'Cancelled';
                                            if ($data->admin_status == '6')
                                                $status = 'Returned';
//                                            return $data->payment_status;
                                            return $status;
                                        } else {
                                            return '';
                                        }
//                                        '0' => 'Pending', '1' => 'Order Placed', '2' => 'Order Packed', '3' => 'Order Dispatched', '4' => 'Order Delivered', '5' => 'Cancelled'
                                    },
                                ],
                                [
                                    'attribute' => 'return_status',
                                    'format' => 'raw',
                                    'value' => function ($data) {
                                        if ($data->return_status == '1') {
                                            $return = "Returned";
                                        }
                                        if ($data->return_status == '2') {
                                            $return = "Admin Returned";
                                        }
                                        if ($data->return_status == '0') {
//                                          $return = '<button type="button" class="btn btn-danger admin_return" id="'.$data->order_id.'">Return</button>';
                                            $return = '';
                                        }
                                        return $return;
                                    },
                                ],
                                [
                                    'attribute' => 'return_approve',
                                    'format' => 'raw',
                                    'filter' => ['0' => 'Pending', '1' => 'Approved', '2' => 'Disapproved'],
                                    'value' => function ($data) {
                                        return \yii\helpers\Html::dropDownList('return_approve', null, ['0' => 'Pending', '1' => 'Approved', '2' => 'Disapproved'], ['options' => [$data->return_approve => ['Selected' => 'selected']], 'class' => 'form-control return_approve', 'id' => $data->order_id]);
                                    },
                                ],
                                [
                                    'class' => 'yii\grid\ActionColumn',
//                                    'contentOptions' => ['style' => 'width:100px;'],
                                    'header' => 'Actions',
                                    'template' => '{view}',
                                    'buttons' => [
                                        'view' => function ($url, $model) {
                                            return Html::a('<span><i class="fa fa-eye" aria-hidden="true"></i></span>', $url, [
                                                        'title' => Yii::t('app', 'view'),
                                                        'class' => '',
                                            ]);
                                        },
                                    ],
                                    'urlCreator' => function ($action, $model) {
                                        if ($action === 'view') {
                                            $url = Url::to(['return-view', 'id' => $model->order_id]);
                                            return $url;
                                        }
                                    }
                                ],
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
        $('.admin_status').on('change', function () {
            var change_id = $(this).attr('id_');
            var admin_status = $('#status_' + change_id).val();
            var delivered_date = $('.delivered_date_' + change_id).val();
            if (delivered_date === "" && admin_status !== '5') {
                alert('Set Expected Delivery date');
            } else {
                $.ajax({
                    url: homeUrl + 'order/order-master/change-admin-status',
                    type: "post",
                    data: {status: admin_status, id: change_id, date: delivered_date},
                    success: function (data) {
                        alert('Admin Status Changed Sucessfully');
                    }, error: function () {
                    }
                });
            }
        });
    });
</script>

