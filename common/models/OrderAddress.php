<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order_address".
 *
 * @property int $id
 * @property string $order_id
 * @property string $name
 * @property string $address
 * @property string $landmark
 * @property string $location
 * @property int $emirate
 * @property int $post_code
 * @property string $country_code
 * @property string $mobile_number
 */
class OrderAddress extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
     //       [['order_id', 'name', 'address', 'landmark', 'location', 'emirate', 'mobile_number'], 'required'],
            [['address'], 'string'],
      //      [['emirate', 'post_code', 'mobile_number'], 'integer'],
            [['order_id', 'name'], 'string', 'max' => 200],
            [['landmark'], 'string', 'max' => 250],
            [['location'], 'string', 'max' => 100],
            [['country_code'], 'string', 'max' => 15],
            [['street_number', 'country'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'name' => 'Name',
            'address' => 'Address',
            'landmark' => 'Landmark',
            'location' => 'Location',
            'emirate' => 'Emirate',
            'post_code' => 'Post Code',
            'country_code' => 'Country Code',
            'mobile_number' => 'Mobile Number',
        ];
    }
}
