<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "homemanagement_type".
 *
 * @property integer $id
 * @property integer $form_type
 * @property string $type
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 * @property integer $status
 */
class HomemanagementType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'homemanagement_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'CB', 'UB', 'DOC'], 'required'],
            [['form_type','CB', 'UB', 'status'], 'integer'],
            [['DOC', 'DOU'], 'safe'],
            [['type'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
            'status' => 'Status',
        ];
    }
}
