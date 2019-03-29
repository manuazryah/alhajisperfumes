<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property integer $main_category
 * @property string $category
 * @property string $category_code
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 * @property integer $status
 *
 * @property SubCategory[] $subCategories
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['main_category', 'CB', 'UB', 'status'], 'integer'],
            [['category','category_code'], 'required'],
            ['category', 'unique', 'targetAttribute' => ['category'], 'message' => 'Category must be unique.'],
            ['category_code', 'unique', 'targetAttribute' => ['category_code'], 'message' => 'Category code must be unique.'],
            [['main_category', 'CB', 'UB', 'status'], 'integer'],
            [['DOC', 'DOU'], 'safe'],
            [['category'], 'string', 'max' => 255],
            [['category'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'main_category' => 'Main Category',
            'category' => 'Category',
            'category_code' => 'Category Code',
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubCategories()
    {
        return $this->hasMany(SubCategory::className(), ['category_id' => 'id']);
    }
}
