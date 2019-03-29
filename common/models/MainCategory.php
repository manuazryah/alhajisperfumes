<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "main_category".
 *
 * @property integer $id
 * @property string $main_category
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 * @property integer $status
 */
class MainCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'main_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['main_category', 'CB', 'UB', 'DOC'], 'required'],
            [['CB', 'UB', 'status'], 'integer'],
            [['DOC', 'DOU','sort_order'], 'safe'],
            [['main_category'], 'string', 'max' => 200],
            [['main_category'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'main_category' => 'Main Category',
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
            'status' => 'Status',
        ];
    }
}
