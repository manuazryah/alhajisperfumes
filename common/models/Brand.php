<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "brand".
 *
 * @property integer $id
 * @property string $brand
 * @property string $image
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 * @property integer $status
 */
class Brand extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'brand';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['brand'], 'required'],
            [['brand'], 'unique'],
            [['CB', 'UB', 'status'], 'integer'],
            [['DOC', 'DOU', 'show_menu','favourite_brand'], 'safe'],
            [['brand'], 'string', 'max' => 200],
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
            'brand' => 'Brand',
            'image' => 'Logo',
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
            'status' => 'Status',
        ];
    }

    public static function checkBrand($brand) {
        $brand_name = Brand::find()->where(['brand' => $brand])->one();
        if ($brand_name) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
    public static function Brand_id($brands_name) {
        $brand_id = array();
		foreach ($brands_name as $brand) {
			$dat = str_replace('_', " ", $brand);
			$brands = Brand::find()->where(['brand' => $dat])->one();
			$brand_id[] = $brands->id;
		}
		return $brand_id;
    }
    public static function Fragrance_id($fragrance_name) {
       $fragrance_id = array();
		foreach ($fragrance_name as $fragrance) {
			$dat = str_replace('_', " ", $fragrance);
			$fragrances = Fregrance::find()->where(['name' => $dat])->one();
			$fragrance_id[] = $fragrances->id;
		}
		return $fragrance_id;
    }

    public static function Gender_type($type_filter) {
        $type_id = array();
        foreach ($type_filter as $type) {
            if ($type == 'men')
                $gender = 0;
            if ($type == 'women')
                $gender = 1;
            if ($type == 'unisex')
                $gender = 2;
            if ($type == 'oriental')
                $gender = 3;
            $type_id[] = $gender;
        }
        return $type_id;
    }
}
