<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Newpost;

/**
 * NewpostSearch represents the model behind the search form of `app\models\Newpost`.
 */
class NewpostSearch extends Newpost
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'viewed_new_post', 'like_new_post', 'id_user', 'id_category'], 'integer'],
            [['title_new', 'photo_new', 'description_new', 'content_new', 'date_register_new_post'], 'safe'],
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
        $query = Newpost::find();

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
            'date_register_new_post' => $this->date_register_new_post,
            'viewed_new_post' => $this->viewed_new_post,
            'like_new_post' => $this->like_new_post,
            'id_user' => $this->id_user,
            'id_category' => $this->id_category,
        ]);

        $query->andFilterWhere(['like', 'title_new', $this->title_new])
            ->andFilterWhere(['like', 'photo_new', $this->photo_new])
            ->andFilterWhere(['like', 'description_new', $this->description_new])
            ->andFilterWhere(['like', 'content_new', $this->content_new]);

        return $dataProvider;
    }
}
