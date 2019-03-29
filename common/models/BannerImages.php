<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "banner_images".
 *
 * @property integer $id
 * @property string $title
 * @property string $image
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 */
class BannerImages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'banner_images';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['status', 'CB', 'UB'], 'integer'],
            [['DOC', 'DOU'], 'safe'],
            [['title'], 'string', 'max' => 200],
            [['image'], 'required', 'on' => 'create'],
            [['image'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'image' => 'Image',
            'status' => 'Status',
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
        ];
    }
}
