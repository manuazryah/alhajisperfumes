<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;

$action = Yii::$app->controller->id . '/' . Yii::$app->controller->action->id;
//echo $action;
//exit;
?>

<aside class="col-md-12 col-sm-4 prod-sidebar">
    <div class="widget-wrap">
        <h2 class="widget-title"> My Account </h2>

        <div class="widget-content">
            <ul class="category">
<!--                <li><a href=""> Account Information </a></li>
                <li class="active"><a href=""> My Account</a></li>     -->   
                
                <li><?= Html::a('Change Password', ['/myaccounts/user/change-password'], ['class' => '' . $action == 'user/change-password' ? 'list-group-item active' : '']) ?></li>
                <!--<li><a href=""> Change Password</a></li>-->
                <!--adresses-->
                <li><?= Html::a('Address Books', ['/myaccounts/user/user-address'], ['class' => '' . $action == 'user/user-address' ? 'list-group-item active' : '']) ?></li>
                <li><?= Html::a('Order History', ['/myaccounts/my-orders/index'], ['class' => '' . $action == 'my-orders/index' ? 'list-group-item active' : '']) ?></li>
                <li><?= Html::a('Reviews and Ratings', ['/myaccounts/user/my-reviews'], ['class' => '' . $action == 'user/my-reviews' ? 'list-group-item active' : '']) ?></li>
                <!--<li><a href=""> Reviews and Ratings</a></li>-->
                <!--<li><a href=""> Returns Requests</a></li>-->
                <!--<li><a href=""> Newsletter</a></li>-->
            </ul>
        </div>

    </div>
</aside>   