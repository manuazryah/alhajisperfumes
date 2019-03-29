<?php

namespace common\models;

use Yii;
use yii\imagine\Image;
use Imagine\Image\Box;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property integer $main_category
 * @property integer $category
 * @property integer $subcategory
 * @property string $product_name
 * @property string $canonical_name
 * @property string $item_ean
 * @property string $brand
 * @property string $ean_type
 * @property string $ean_value
 * @property integer $gender_type
 * @property string $price
 * @property string $offer_price
 * @property string $offer_percentage
 * @property integer $currency
 * @property integer $stock
 * @property integer $stock_unit
 * @property integer $tax
 * @property integer $free_shipping
 * @property string $product_type
 * @property integer $size
 * @property integer $size_unit
 * @property string $main_description
 * @property string $product_detail
 * @property integer $condition
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 * @property integer $status
 * @property integer $featured_product
 * @property string $profile
 * @property string $sort
 */
class Product extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['main_category', 'category', 'subcategory', 'gender_type', 'currency', 'stock', 'stock_unit', 'free_shipping', 'size', 'size_unit', 'condition', 'CB', 'UB', 'status', 'featured_product'], 'integer'],
            [['main_category', 'product_name', 'canonical_name', 'item_ean', 'price', 'currency', 'stock', 'stock_unit', 'product_detail', 'brand'], 'required'],
            [['price', 'offer_price'], 'number'],
            [['main_description', 'product_detail'], 'string'],
            [['DOC', 'DOU', 'offer_percentage', 'tax', 'discount', 'type'], 'safe'],
            [['product_name', 'canonical_name'], 'string', 'max' => 100],
//            [['item_ean'], 'string', 'max' => 255],
            [['canonical_name'], 'unique'],
            [['item_ean'], 'unique'],
            [['other_image'], 'file', 'extensions' => 'png, jpg, jpeg', 'maxFiles' => 3],
            [['profile'], 'file', 'extensions' => 'png, jpg, jpeg', 'on' => 'create'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'main_category' => 'Main Category',
            'category' => 'Category',
            'subcategory' => 'Subcategory',
            'product_name' => 'Product Name',
            'canonical_name' => 'Canonical Name',
            'meta_title' => 'Meta Title',
            'meta_description' => 'Meta Description',
            'meta_keywords' => 'Meta Keywords',
            'search_tag' => 'Search Tag',
            'item_ean' => 'SKU',
            'brand' => 'Brand',
            'ean_type' => 'EAN/UPC',
            'ean_value' => 'Product Code',
            'gender_type' => 'Gender Type',
            'price' => 'Price',
            'offer_price' => 'Offer Price',
            'currency' => 'Currency',
            'stock' => 'Stock',
            'stock_unit' => 'Stock Unit',
            'stock_availability' => 'Stock Availability',
            'tax' => 'Tax',
            'free_shipping' => 'Free Shipping',
            'product_type' => 'Fragrance Type',
            'size' => 'Size',
            'size_unit' => 'Size Unit',
            'main_description' => 'Main Description',
            'product_detail' => 'Product Detail',
            'condition' => 'Condition',
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
            'status' => 'Status',
            'profile' => 'Profile Picture',
            'other_image' => 'Other Images',
            'profile_alt' => 'Profile Alt',
            'gallery_alt' => 'Gallery Alt',
            'related_product' => 'Related Products',
            'featured_product' => 'Featured Product',
            'sort' => 'Sort Number',
        ];
    }

    public function upload($file, $model) {
        if (\yii::$app->basePath . '/../uploads') {
            $path = yii::$app->basePath . '/../uploads/product/' . $model->id . '/profile/' . $model->canonical_name . '_big.' . $file->extension;
            $main_path = yii::$app->basePath . '/../uploads/product/' . $model->id;
            $name = $model->canonical_name . '.' . $file->extension;
            Image::thumbnail($path, 600, 600)
                    ->save($main_path . '/profile/' . $name, ['quality' => 80]);
            Image::thumbnail($path, 1080, 1080)
                    ->save(\yii::$app->basePath . '/../uploads/product/' . $model->id . '/profile/' . $model->canonical_name . '_big.' . $file->extension, ['quality' => 50]);
            Image::thumbnail($path, 250, 250)
                    ->save(\yii::$app->basePath . '/../uploads/product/' . $model->id . '/profile/' . $model->canonical_name . '_thumb.' . $file->extension, ['quality' => 50]);
            return true;
        }
    }

    public function uploadMultiple($file, $product_id, $canname, $i) {
        if (\yii::$app->basePath . '/../uploads') {
            chmod(\yii::$app->basePath . '/../uploads', 0777);

            if (!is_dir(\yii::$app->basePath . '/../uploads/product/')) {
                mkdir(\yii::$app->basePath . '/../uploads/product/');
                chmod(\yii::$app->basePath . '/../uploads/product/', 0777);
            }
            if (!is_dir(\yii::$app->basePath . '/../uploads/product/' . $product_id)) {
                mkdir(\yii::$app->basePath . '/../uploads/product/' . $product_id);
                chmod(\yii::$app->basePath . '/../uploads/product/' . $product_id, 0777);
            }
            if (!is_dir(\yii::$app->basePath . '/../uploads/product/' . $product_id . '/gallery')) {
                mkdir(\yii::$app->basePath . '/../uploads/product/' . $product_id . '/gallery');
                chmod(\yii::$app->basePath . '/../uploads/product/' . $product_id . '/gallery', 0777);
            }
            $path = yii::$app->basePath . '/../uploads/product/' . $product_id . '/gallery';
            $main_path = yii::$app->basePath . '/../uploads/product/' . $product_id;
            $name = $this->fileExists($path, $canname, $image_name = $canname, $file->extension, 1);
            if ($file->saveAs($path . '/' . $name)) {
                chmod($path . '/' . $name, 0777);
                if (!is_dir(\yii::$app->basePath . '/../uploads/product/' . $product_id . '/gallery_thumb/')) {
                    mkdir(\yii::$app->basePath . '/../uploads/product/' . $product_id . '/gallery_thumb/');
                    chmod(\yii::$app->basePath . '/../uploads/product/' . $product_id . '/gallery_thumb/', 0777);
                }
                if (!is_dir(\yii::$app->basePath . '/../uploads/product/' . $product_id . '/gallery_profile/')) {
                    mkdir(\yii::$app->basePath . '/../uploads/product/' . $product_id . '/gallery_profile/');
                    chmod(\yii::$app->basePath . '/../uploads/product/' . $product_id . '/gallery_profile/', 0777);
                }
                Image::thumbnail($path . '/' . $name, 250, 250)
                        ->save($main_path . '/gallery_thumb/' . $name, ['quality' => 80]);
                Image::thumbnail($path . '/' . $name, 1080, 1080)
                        ->save($main_path . '/gallery/' . $name, ['quality' => 80]);
                Image::thumbnail($path . '/' . $name, 600, 600)
                        ->save($main_path . '/gallery_profile/' . $name, ['quality' => 80]);
            }
            return true;
        }
    }

    public function fileExists($path, $canname, $image_name, $extension, $sufix) {
        if (file_exists($path . '/' . $image_name . '.' . $extension)) {
            $image_name = basename($path . '/' . $canname . '_' . $sufix);
            return $this->fileExists($path, $canname, $image_name, $extension, $sufix + 1);
        } else {
            return $image_name . '.' . $extension;
        }
    }

}
