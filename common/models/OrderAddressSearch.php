<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\OrderAddress;

/**
 * OrderAddressSearch represents the model behind the search form about `common\models\OrderAddress`.
 */
class OrderAddressSearch extends OrderAddress
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'emirate', 'post_code', 'mobile_number'], 'integer'],
            [['order_id', 'name', 'address', 'landmark', 'location', 'country_code'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = OrderAddress::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'emirate' => $this->emirate,
            'post_code' => $this->post_code,
            'mobile_number' => $this->mobile_number,
        ]);

        $query->andFilterWhere(['like', 'order_id', $this->order_id])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'landmark', $this->landmark])
            ->andFilterWhere(['like', 'location', $this->location])
            ->andFilterWhere(['like', 'country_code', $this->country_code]);

        return $dataProvider;
    }
}
