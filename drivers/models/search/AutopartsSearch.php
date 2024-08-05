<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Autoparts;

/**
 * AutopartsSearch represents the model behind the search form of `app\models\Autoparts`.
 */
class AutopartsSearch extends Autoparts
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_condition_auto_parts', 'id_originality_auto_parts', 'id_user', 'id_manufacturer', 'id_for_models', 'id_product_availability', 'views_auto_parts', 'id_status'], 'integer'],
            [['title_auto_parts', 'photo_auto_parts', 'part_number', 'price_auto_parts', 'comments_user', 'mileage', 'date_of_registration_auto_parts'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Autoparts::find();

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
//        $query->andFilterWhere([
//            'id' => $this->id,
//            'id_condition_auto_parts' => $this->id_condition_auto_parts,
//            'id_originality_auto_parts' => $this->id_originality_auto_parts,
//            'id_user' => $this->id_user,
//            'id_manufacturer' => $this->id_manufacturer,
//            'id_for_models' => $this->id_for_models,
//            'id_product_availability' => $this->id_product_availability,
//            'views_auto_parts' => $this->views_auto_parts,
//            'date_of_registration_auto_parts' => $this->date_of_registration_auto_parts,
//            'id_status' => $this->id_status,
//        ]);

        $query->andFilterWhere(['like', 'title_auto_parts', $this->title_auto_parts]);
//            ->andFilterWhere(['like', 'photo_auto_parts', $this->photo_auto_parts])
//            ->andFilterWhere(['like', 'part_number', $this->part_number])
//            ->andFilterWhere(['like', 'price_auto_parts', $this->price_auto_parts])
//            ->andFilterWhere(['like', 'comments_user', $this->comments_user])
//            ->andFilterWhere(['like', 'mileage', $this->mileage]);

        return $dataProvider;
    }

//    public function search($params)
//    {
//        $query = Autoparts::find();
//
//        $this->load($params);
//
//        if (!$this->validate()) {
//            return new ActiveDataProvider([
//                'query' => $query,
//            ]);
//        }
//
//        $query->andFilterWhere(['like', 'title_auto_parts', $this->title_auto_parts]);
//
//        return new ActiveDataProvider([
//            'query' => $query,
//        ]);
//    }
}
