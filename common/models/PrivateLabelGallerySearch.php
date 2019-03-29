<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PrivateLabelGallery;

/**
 * PrivateLabelGallerySearch represents the model behind the search form about `common\models\PrivateLabelGallery`.
 */
class PrivateLabelGallerySearch extends PrivateLabelGallery {

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[['id', 'CB', 'UB'], 'integer'],
			[['banner_image', 'image', 'our_process_title', 'other_title', 'about_title', 'about_content', 'index_title', 'index_content', 'DOC', 'DOU'], 'safe'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function scenarios() {
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
	public function search($params) {
		$query = PrivateLabelGallery::find();

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
		    'CB' => $this->CB,
		    'UB' => $this->UB,
		    'DOC' => $this->DOC,
		    'DOU' => $this->DOU,
		]);

		$query->andFilterWhere(['like', 'banner_image', $this->banner_image])
			->andFilterWhere(['like', 'image', $this->image])
			->andFilterWhere(['like', 'our_process_title', $this->our_process_title])
			->andFilterWhere(['like', 'other_title', $this->other_title])
			->andFilterWhere(['like', 'about_title', $this->about_title])
			->andFilterWhere(['like', 'about_content', $this->about_content])
			->andFilterWhere(['like', 'index_title', $this->index_title])
			->andFilterWhere(['like', 'index_title', $this->index_title]);
		return $dataProvider;
	}

}
