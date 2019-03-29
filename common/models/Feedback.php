<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "feedback".
 *
 * @property integer $id
 * @property string $user_id
 * @property string $title
 * @property string $content
 * @property string $DOC
 */
class Feedback extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'feedback';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'title', 'content'], 'required'],
            [['content'], 'string'],
            [['DOC'], 'safe'],
            [['title'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User',
            'title' => 'Title',
            'content' => 'Content',
            'DOC' => 'Doc',
        ];
    }
}
