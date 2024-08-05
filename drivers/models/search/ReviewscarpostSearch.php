<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Reviewscarpost;

/**
 * ReviewscarpostSearch represents the model behind the search form of `app\models\Reviewscarpost`.
 */
class ReviewscarpostSearch extends Reviewscarpost
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'viewed_reviews', 'like_reviews', 'id_user', 'id_category_reviews'], 'integer'],
            [['title', 'photo_reviews', 'description_reviews', 'content_reviews', 'date_register_reviews'], 'safe'],
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
        $query = Reviewscarpost::find();

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
            'date_register_reviews' => $this->date_register_reviews,
            'viewed_reviews' => $this->viewed_reviews,
            'like_reviews' => $this->like_reviews,
            'id_user' => $this->id_user,
            'id_category_reviews' => $this->id_category_reviews,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'photo_reviews', $this->photo_reviews])
            ->andFilterWhere(['like', 'description_reviews', $this->description_reviews])
            ->andFilterWhere(['like', 'content_reviews', $this->content_reviews]);

        return $dataProvider;
    }
}
