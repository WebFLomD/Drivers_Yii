<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Car;

/**
 * CarSearch represents the model behind the search form of `app\models\Car`.
 */
class CarSearch extends Car
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_user', 'id_bodywork', 'id_transmission_car', 'id_color', 'id_drive_car', 'id_brand_car', 'id_engine_car', 'id_owners', 'id_pts', 'id_year_of_release', 'id_type_of_car', 'id_used_or_new', 'views_post', 'id_status'], 'integer'],
            [['name_car', 'photo_car_1', 'photo_car_2', 'photo_car_3', 'modification_car', 'price', 'mileage', 'comments_user', 'date_of_registration_post_car'], 'safe'],
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
        $query = Car::find();

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
            'id_user' => $this->id_user,
            'id_bodywork' => $this->id_bodywork,
            'id_transmission_car' => $this->id_transmission_car,
            'id_color' => $this->id_color,
            'id_drive_car' => $this->id_drive_car,
            'id_brand_car' => $this->id_brand_car,
            'id_engine_car' => $this->id_engine_car,
            'id_owners' => $this->id_owners,
            'id_pts' => $this->id_pts,
            'id_year_of_release' => $this->id_year_of_release,
            'id_type_of_car' => $this->id_type_of_car,
            'id_used_or_new' => $this->id_used_or_new,
            'views_post' => $this->views_post,
            'date_of_registration_post_car' => $this->date_of_registration_post_car,
            'id_status' => $this->id_status,
        ]);

        $query->andFilterWhere(['like', 'name_car', $this->name_car])
            ->andFilterWhere(['like', 'photo_car_1', $this->photo_car_1])
            ->andFilterWhere(['like', 'photo_car_2', $this->photo_car_2])
            ->andFilterWhere(['like', 'photo_car_3', $this->photo_car_3])
            ->andFilterWhere(['like', 'modification_car', $this->modification_car])
            ->andFilterWhere(['like', 'price', $this->price])
            ->andFilterWhere(['like', 'mileage', $this->mileage])
            ->andFilterWhere(['like', 'comments_user', $this->comments_user]);

        return $dataProvider;
    }
}
