<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "branches".
 *
 * @property integer $id
 * @property string $branch_name
 * @property string $branch_adress
 * @property string $phone
 * @property string $image
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 */
class Branches extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'branches';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['branch_adress'], 'string'],
            [['status', 'CB', 'UB','sort_order'], 'integer'],
            [['DOC', 'DOU','map'], 'safe'],
            [['branch_name', 'image'], 'string', 'max' => 100],
            [['phone'], 'string', 'max' => 25],
            [['branch_adress', 'branch_name'], 'required'],
            [['image'], 'required', 'on' => 'create'],
            [['image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'branch_name' => 'Branch Name',
            'branch_adress' => 'Branch Address',
            'phone' => 'Phone',
            'image' => 'Image',
            'status' => 'Status',
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
        ];
    }

}
