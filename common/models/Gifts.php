<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "gifts".
 *
 * @property integer $id
 * @property integer $product_id
 * @property integer $sort_order
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 */
class Gifts extends \yii\db\ActiveRecord {

    public $category;
    public $subcategory;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'gifts';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['product_id', 'sort_order'], 'required'],
            [['product_id', 'sort_order', 'status', 'CB', 'UB'], 'integer'],
            [['DOC', 'DOU'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'sort_order' => 'Sort Order',
            'status' => 'Status',
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
        ];
    }

}
