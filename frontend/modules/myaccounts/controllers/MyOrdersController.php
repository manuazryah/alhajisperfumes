<?php

namespace frontend\modules\myaccounts\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use common\models\OrderMaster;
use common\models\OrderDetails;
use common\models\OrderMasterSearch;

class MyOrdersController extends Controller {

    public function beforeAction($action) {
        if (!parent::beforeAction($action)) {
            return false;
        }
        if (Yii::$app->user->isGuest) {
            $this->redirect(['/site/index']);
            return false;
        }
        return true;
    }

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex() {
        $searchModel = new OrderMasterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['user_id' => Yii::$app->user->identity->id]);
        $dataProvider->query->andWhere(['shipping_status' => 0]);
        $dataProvider->query->andWhere(['>=', 'status', 4]);
        $dataProvider->pagination->pageSize = 10;
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /*
     * This function will cancel order
     */

    public function actionCancelOrder() {
        if (yii::$app->request->isAjax) {
            $reason = Yii::$app->request->post()['reason'];
            $order_id = Yii::$app->request->post()['order_id'];
            $order = OrderMaster::find()->where(['order_id' => yii::$app->EncryptDecrypt->Encrypt('decrypt', $order_id), 'user_id' => Yii::$app->user->identity->id])->one();
            if ($order) {
                $order->status = 5;
                $order->cancel_reason = $reason;
                if ($order->save()) {
                    $subject = 'Order Cancelled';
                    $to = Yii::$app->params['adminEmail'];
                    $message = $this->renderPartial('cancel_mail', ['orderid' => $id]);
                    $headers = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n" .
                            "From: no-replay@perfumedunia.com";
//                    echo $message;
//                    mail($to, $subject, $message, $headers);
                    echo json_encode(array('msg' => 'success'));
                }
            }
        }
    }

    public function actionOrderDetails($orderid) {
        $model = OrderMaster::find()->where(['order_id' => $orderid])->one();
        $order_details = OrderDetails::find()->where(['order_id' => $orderid])->all();
        return $this->render('order-details', [
                    'model' => $model,
                    'order_details' => $order_details,
        ]);
    }

    public function actionReturnOrder() {
        if (yii::$app->request->isAjax) {
            $reason = Yii::$app->request->post()['reason'];
            $order_id = Yii::$app->request->post()['order_id'];
            $order = OrderMaster::find()->where(['order_id' => yii::$app->EncryptDecrypt->Encrypt('decrypt', $order_id), 'user_id' => Yii::$app->user->identity->id])->one();
            if ($order) {
                $order->return_status = 1;
                $order->return_reason = $reason;
                if ($order->save()) {
//                    OrderMaster::returnmail(yii::$app->EncryptDecrypt->Encrypt('decrypt', $order_id), Yii::$app->user->identity->id);
//                    OrderMaster::returnstock(yii::$app->EncryptDecrypt->Encrypt('decrypt', $order_id));
                    echo json_encode(array('msg' => 'success'));
                }
            }
        }
    }

}
