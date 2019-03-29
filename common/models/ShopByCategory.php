<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "shop_by_category".
 *
 * @property integer $id
 * @property string $title
 * @property string $link
 * @property string $image
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 */
class ShopByCategory extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'shop_by_category';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['link'], 'required'],
                        [['status', 'CB', 'UB'], 'integer'],
                        [['DOC', 'DOU'], 'safe'],
                        [['title', 'link', 'image'], 'string', 'max' => 250],
                        [['image'], 'file', 'extensions' => 'png, jpg, jpeg'],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'title' => 'Title',
                    'link' => 'Link',
                    'image' => 'Image',
                    'status' => 'Status',
                    'CB' => 'Cb',
                    'UB' => 'Ub',
                    'DOC' => 'Doc',
                    'DOU' => 'Dou',
                ];
        }

}
