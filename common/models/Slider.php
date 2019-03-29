<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "slider".
 *
 * @property integer $id
 * @property string $img
 * @property string $content
 * @property string $slider_first_tittle
 * @property string $slider_second_tittle
 * @property string $slider_link
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 */
class Slider extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'slider';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['content'], 'string'],
            [['status', 'CB', 'UB'], 'integer'],
            [['img'], 'required', 'on' => 'create'],
            [['status', 'CB', 'UB'], 'integer'],
            [['DOC', 'DOU'], 'safe'],
            [['img'], 'string', 'max' => 100],
            [['slider_first_tittle', 'slider_second_tittle'], 'string', 'max' => 200],
            [['slider_link'], 'string', 'max' => 500],
            [['img'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'img' => 'Img',
            'content' => 'Content',
            'slider_first_tittle' => 'Slider First Tittle',
            'slider_second_tittle' => 'Slider Second Tittle',
            'slider_link' => 'Slider Link',
            'status' => 'Status',
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
        ];
    }

}
