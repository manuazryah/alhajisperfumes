<?php

use yii\helpers\Html;
?>

<html>

    <head>
        <title>Newsletter Subscription Enquiry From Linea De Bella</title>
    </head>

    <body>
        <div class="mail-body" style="margin: auto;width: 70%;border: 1px solid #9e9e9e;">
            <div class="content" style="margin: 40px;">
                <?php echo Html::img('http://' . Yii::$app->request->serverName . '/images/logo.png', $options = ['width' => '']) ?>
                <h2 style="color: #264894;">Newsletter Subscription Enquiry From emperor.ae</h2>

                <table style="border-collapse: collapse;width: 100%;text-align: left;margin-bottom: 30px;border: 1px solid black;">
                    <tr>
                        <th style="border: 1px solid black;text-align: left;padding: 5px 10px;">Email</th>
                        <td style="border: 1px solid black;text-align: left;padding: 5px 10px;"><?= $email ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </body>
</html>