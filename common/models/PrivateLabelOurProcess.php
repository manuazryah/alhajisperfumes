<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "private_label_our_process".
 *
 * @property integer $id
 * @property integer $step
 * @property string $content
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 */
class PrivateLabelOurProcess extends \yii\db\ActiveRecord {

	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'private_label_our_process';
	}

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[['step', 'status', 'CB', 'UB'], 'integer'],
			[['step', 'content'], 'required'],
			[['step'], 'unique'],
			[['content'], 'string'],
			[['DOC', 'DOU'], 'safe'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
		    'id' => 'ID',
		    'step' => 'Step',
		    'content' => 'Content',
		    'status' => 'Status',
		    'CB' => 'Cb',
		    'UB' => 'Ub',
		    'DOC' => 'Doc',
		    'DOU' => 'Dou',
		];
	}

}
