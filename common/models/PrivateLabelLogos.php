<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "private_label_logos".
 *
 * @property integer $id
 * @property string $name
 * @property string $image
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 */
class PrivateLabelLogos extends \yii\db\ActiveRecord {

	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'private_label_logos';
	}

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[['name', 'image'], 'required', 'on' => 'create'],
			[['status', 'CB', 'UB'], 'integer'],
			[['DOC', 'DOU'], 'safe'],
			[['name', 'image'], 'string', 'max' => 100],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
		    'id' => 'ID',
		    'name' => 'Name',
		    'image' => 'Image',
		    'status' => 'Status',
		    'CB' => 'Cb',
		    'UB' => 'Ub',
		    'DOC' => 'Doc',
		    'DOU' => 'Dou',
		];
	}

}
