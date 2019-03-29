<?php

use yii\helpers\Html;
?>

<html>

    <head>
        <title>Forgot Password</title>
        <style>
            .content{
                margin-left: 0px;
                color: #c5c2c2;
                padding: 35px 15px;
                background: rgba(249, 105, 0, 0.99);
            }
            .content img{
                margin-left: auto;
                margin-right: auto;
                text-align: center;
                display: table-cell;
                vertical-align: middle
            }
            .content a{
                display: inline-block;
                cursor: pointer;
                padding: 6px 12px;
                font-size: 14px;
                line-height: 1.42857143;
                text-decoration: none;
                color: #fff;
                border: 1px solid transparent;
                border-color: #f18920;
                background-color: #e4251e;
            }
            .content h2{
                text-align: center;
                font-size: 16px;
                color: #fff;
            }
            .content p{
                text-align: center;
                font-size: 12px;
                color: #fff;
            }
        </style>
    </head>

    <body>
        <div class="mail-body" style="margin: auto;width: 75%;border: 1px solid #9e9e9e;">
            <div class="content">
                <?php echo Html::img('http://' . Yii::$app->request->serverName . '/' . Yii::$app->homeUrl . 'images/logo.png', $options = ['width' => '200px']) ?>
                <h2>FORGOT YOUR PASSWORD ?</h2>
                <p>You are requested to reset your password for your Alhajis Perfumes User Login. Click the below button to reset it</p>
                <p style="margin-bottom: 0px;"><a href="http://<?= Yii::$app->request->serverName ?><?= Yii::$app->homeUrl ?>site/new-password?token=<?= $val ?>">Reset Password</a></p>
            </div>
        </div>



    </body>
</html>