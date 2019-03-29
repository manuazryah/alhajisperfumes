<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "footer_content".
 *
 * @property int $id
 * @property string $title
 * @property string $link
 * @property string $content
 * @property int $status
 */
class FooterContent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'footer_content';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'link', 'content'], 'required'],
            [['content'], 'string'],
            [['status'], 'integer'],
            [['title'], 'string', 'max' => 200],
            [['link'], 'string', 'max' => 500],
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
            'link' => 'Link',
            'content' => 'Content',
            'status' => 'Status',
        ];
    }
}
