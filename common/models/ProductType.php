<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product_type".
 *
 * @property int $id
 * @property string $product_type
 * @property int $status
 * @property int $CB
 * @property int $UB
 * @property string $DOC
 * @property string $DOU
 */
class ProductType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'CB', 'UB'], 'integer'],
            [['DOC', 'DOU'], 'safe'],
            [['product_type'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_type' => 'Product Type',
            'status' => 'Status',
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
        ];
    }
}
