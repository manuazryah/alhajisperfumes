<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PrivateLabelOurProcess;

/**
 * PrivateLabelOurProcessSearch represents the model behind the search form about `common\models\PrivateLabelOurProcess`.
 */
class PrivateLabelOurProcessSearch extends PrivateLabelOurProcess
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'step', 'status', 'CB', 'UB'], 'integer'],
            [['content', 'DOC', 'DOU'], 'safe'],
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
        $query = PrivateLabelOurProcess::find();

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
            'step' => $this->step,
            'status' => $this->status,
            'CB' => $this->CB,
            'UB' => $this->UB,
            'DOC' => $this->DOC,
            'DOU' => $this->DOU,
        ]);

        $query->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
}
