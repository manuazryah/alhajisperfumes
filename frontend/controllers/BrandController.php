<?php

namespace frontend\controllers;

use yii;
use common\models\Brand;

class BrandController extends \yii\web\Controller {

    public function init() {
        date_default_timezone_set('Asia/Kolkata');
    }

    public function actionIndex() {
        $brand = Brand::find()->where(['status' => 1])->orderBy(['brand'=>SORT_ASC])->all();
        return $this->render('index', ['brands' => $brand]);
    }

}
