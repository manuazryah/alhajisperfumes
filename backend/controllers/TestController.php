<?php

namespace backend\controllers;

use Yii;
use common\models\Test;
use common\models\TestSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TestController implements the CRUD actions for Test model.
 */
class TestController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Test models.
     * @return mixed
     */
    public function actionIndex()
    {
        
//               $orders = \common\models\OrderMaster::find()->where(['status' => 4])->orWhere(['status' => 4])->all();
//        $i = 0;
//        $j = 0;
//        foreach ($orders as $order) {
//            echo '////' . $i . '<br>';
//            $user_address = \common\models\UserAddress::findOne($order->bill_address_id);
//            if ($user_address) {
//                echo $order->order_id;
//                echo 'jjjj' . $j . '<br>';
//                $j++;
//                $model = new \common\models\OrderAddress();
//                $model->order_id = $order->order_id;
//                $model->address = $user_address->address;
//                $model->name = $user_address->name;
//                $model->landmark = !empty($user_address->landmark) ? $user_address->landmark : '';
//                $model->location = !empty($user_address->location) ? $user_address->location : '';
//                $model->emirate = $user_address->emirate;
//                $model->post_code = !empty($user_address->post_code) ? $user_address->post_code : '';
//                $model->country_code = !empty($user_address->country_code) ? $user_address->country_code : '';
//                $model->mobile_number = !empty($user_address->mobile_number) ? $user_address->mobile_number : '';
//                if ($model->save()) {
//                    
//                } else {
//                   echo '<br>---'.$order->order_id; var_dump($model->getErrors());
//                }
//            }
//            $i++;
//        }
    }

    /**
     * Displays a single Test model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Test model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Test();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Test model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Test model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Test model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Test the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Test::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
