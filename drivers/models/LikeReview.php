<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "likeReview".
 *
 * @property int $id
 * @property int $id_user
 * @property int $id_reviewscarpost
 *
 * @property Reviewscarpost $reviewscarpost
 * @property User $user
 */
class LikeReview extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'likeReview';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'id_reviewscarpost'], 'required'],
            [['id_user', 'id_reviewscarpost'], 'integer'],
            [['id_reviewscarpost'], 'exist', 'skipOnError' => true, 'targetClass' => Reviewscarpost::class, 'targetAttribute' => ['id_reviewscarpost' => 'id']],
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
            'id_reviewscarpost' => 'Id Reviewscarpost',
        ];
    }

    /**
     * Gets query for [[Reviewscarpost]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReviewscarpost()
    {
        return $this->hasOne(Reviewscarpost::class, ['id' => 'id_reviewscarpost']);
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
