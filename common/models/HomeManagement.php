<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "home_management".
 *
 * @property int $id
 * @property int $form_type
 * @property int $type
 * @property string $tittle
 * @property string $product_id
 * @property string $image_1
 * @property string $link_1
 * @property string $image_2
 * @property string $link_2
 * @property string $image_3
 * @property string $link_3
 * @property int $sort_order
 * @property int $status
 * @property int $CB
 * @property int $UB
 * @property string $DOC
 * @property string $DOU
 */
class HomeManagement extends \yii\db\ActiveRecord {

    public $category;
    public $subcategory;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'home_management';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['type', 'sort_order', 'status', 'CB', 'UB'], 'integer'],
            [['type'], 'required'],
            [['DOC', 'DOU'], 'safe'],
            [['tittle', 'product_id', 'link_1', 'link_2', 'link_3'], 'safe'],
            [['image_1', 'image_2', 'image_3'], 'string', 'max' => 50],
            [['image_1', 'image_2', 'image_3'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            [['image_1', 'link_1'], 'required', 'on' => 'create', 'when' => function ($model) {
//                    return $model->type == 1;
                }, 'whenClient' => "function (attribute, value) { return $('#homemanagement-type').val() == '1'; }"],
            [['image_1', 'image_2', 'link_1', 'link_2'], 'required', 'on' => 'create', 'when' => function ($model) {
//                    return $model->type == 2;
                }, 'whenClient' => "function (attribute, value) { return $('#homemanagement-type').val() == '2'; }"],
            [['image_1', 'image_2', 'image_3', 'link_1', 'link_2', 'link_3'], 'required', 'on' => 'create', 'when' => function ($model) {
//                     return $model->type == 3;
                }, 'whenClient' => "function (attribute, value) { return $('#homemanagement-type').val() == '3'; }"],
            [['tittle', 'product_id'], 'required', 'on' => 'create', 'when' => function ($model) {
//                    return $model->type == 4;
                }, 'whenClient' => "function (attribute, value) { return $('#homemanagement-type').val() == '4'; }"]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
//            'form_type' => 'Form Type',
            'type' => 'Type',
            'tittle' => 'Tittle',
            'product_id' => 'Products',
            'image_1' => 'Image 1',
            'link_1' => 'Link 1',
            'image_2' => 'Image 2',
            'link_2' => 'Link 2',
            'image_3' => 'Image 3',
            'link_3' => 'Link 3',
            'sort_order' => 'Sort Order',
            'status' => 'Status',
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
        ];
    }

    public function getProducts($id) {

        $product = explode(',', $id);
        $result = '';
        $i = 0;
        if (!empty($product)) {
            foreach ($product as $val) {

                if ($i != 0) {
                    $result .= ',';
                }
                $product_data = Product::findOne($val);
                $result .= $product_data->product_name;
                $i++;
            }
        }

        return $result;
    }

    public function getType($type) {
//'0' => 'Latest product', '1' => 'Todays Exclusive', '2' => 'Single banner', '3' => 'Double Banner', '4' => 'Tripple Banner'
        if ($type == 0) {
            return 'Latest Product';
        } elseif ($type == 1) {
            return 'Todays Exclusive';
        } elseif ($type == 2) {
            return 'Single banner';
        } elseif ($type == 3) {
            return 'Double banner';
        } elseif ($type == 4) {
            return 'Tripple banner';
        }
    }

}
