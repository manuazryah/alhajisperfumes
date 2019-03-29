<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "today_offers".
 *
 * @property int $id
 * @property string $title
 * @property string $image
 * @property string $link
 * @property string $alt_tag
 * @property int $status
 * @property int $CB
 * @property int $UB
 * @property string $DOC
 * @property string $DOU
 */
class TodayOffers extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'today_offers';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['status', 'CB', 'UB'], 'integer'],
            [['title', 'link'], 'required'],
            [['DOC', 'DOU'], 'safe'],
            [['title'], 'string', 'max' => 100],
            [['image'], 'string', 'max' => 50],
            [['link', 'alt_tag'], 'string', 'max' => 500],
            [['image'], 'file', 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'image' => 'Image',
            'link' => 'Link',
            'alt_tag' => 'Alt Tag',
            'status' => 'Status',
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
        ];
    }

}
