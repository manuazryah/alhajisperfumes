<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "private_label_how_it_works".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 */
class PrivateLabelHowItWorks extends \yii\db\ActiveRecord {

	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'private_label_how_it_works';
	}

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[['content'], 'string'],
			[['content', 'title'], 'required'],
			[['status', 'CB', 'UB'], 'integer'],
			[['DOC', 'DOU'], 'safe'],
			[['title'], 'string', 'max' => 200],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
		    'id' => 'ID',
		    'title' => 'Title',
		    'content' => 'Content',
		    'status' => 'Status',
		    'CB' => 'Cb',
		    'UB' => 'Ub',
		    'DOC' => 'Doc',
		    'DOU' => 'Dou',
		];
	}

}
