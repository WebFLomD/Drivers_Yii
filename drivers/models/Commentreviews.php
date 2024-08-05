<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "commentreviews".
 *
 * @property int $id
 * @property int $id_user
 * @property int $id_reviews
 * @property string $data_comment_reviews
 * @property string $text_reviews
 *
 * @property Reviewscarpost $reviews
 * @property User $user
 */
class Commentreviews extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'commentreviews';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'id_reviews', 'text_reviews'], 'required'],
            [['id_user', 'id_reviews'], 'integer'],
            [['data_comment_reviews'], 'safe'],
            [['text_reviews'], 'string', 'max' => 255],
            [['id_reviews'], 'exist', 'skipOnError' => true, 'targetClass' => Reviewscarpost::class, 'targetAttribute' => ['id_reviews' => 'id']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Id User',
            'id_reviews' => 'Id Reviews',
            'data_comment_reviews' => 'Data Comment Reviews',
            'text_reviews' => 'Text Reviews',
        ];
    }

    /**
     * Gets query for [[Reviews]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReviews()
    {
        return $this->hasOne(Reviewscarpost::class, ['id' => 'id_reviews']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'id_user']);
    }
}
