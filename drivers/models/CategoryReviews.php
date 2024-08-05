<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "category_reviews".
 *
 * @property int $id
 * @property string $name_category_reviews
 *
 * @property Reviewscarpost[] $reviewscarposts
 */
class CategoryReviews extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category_reviews';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_category_reviews'], 'required'],
            [['name_category_reviews'], 'string', 'max' => 255],
            [['name_category_reviews'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_category_reviews' => 'Name Category Reviews',
        ];
    }

    /**
     * Gets query for [[Reviewscarposts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReviewscarposts()
    {
        return $this->hasMany(Reviewscarpost::class, ['id_category_reviews' => 'id']);
    }
}
