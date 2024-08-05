<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reviewscarpost".
 *
 * @property int $id
 * @property string $title
 * @property string $photo_reviews
 * @property string $description_reviews
 * @property string $content_reviews
 * @property string $date_register_reviews
 * @property int $viewed_reviews
 * @property int $like_reviews
 * @property int $id_user
 * @property int $id_category_reviews
 *
 * @property CategoryReviews $categoryReviews
 * @property Commentreviews[] $commentreviews
 * @property LikeReview[] $likeReviews
 * @property User $user
 */
class Reviewscarpost extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reviewscarpost';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description_reviews', 'content_reviews'], 'required', 'message' => 'Заполните поля!'],
            [['description_reviews', 'content_reviews'], 'string'],
            [['date_register_reviews'], 'safe'],
            [['viewed_reviews', 'like_reviews', 'id_user', 'id_category_reviews'], 'integer'],
            [['title', 'photo_reviews'], 'string', 'max' => 255],
            [['id_category_reviews'], 'exist', 'skipOnError' => true, 'targetClass' => CategoryReviews::class, 'targetAttribute' => ['id_category_reviews' => 'id']],
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
            'title' => 'Title',
            'photo_reviews' => 'Photo Reviews',
            'description_reviews' => 'Description Reviews',
            'content_reviews' => 'Content Reviews',
            'date_register_reviews' => 'Date Register Reviews',
            'viewed_reviews' => 'Viewed Reviews',
            'like_reviews' => 'Like Reviews',
            'id_user' => 'Id User',
            'id_category_reviews' => 'Id Category Reviews',
        ];
    }

    /**
     * Gets query for [[CategoryReviews]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryReviews()
    {
        return $this->hasOne(CategoryReviews::class, ['id' => 'id_category_reviews']);
    }

    /**
     * Gets query for [[Commentreviews]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCommentreviews()
    {
        return $this->hasMany(Commentreviews::class, ['id_reviews' => 'id']);
    }

    /**
     * Gets query for [[LikeReviews]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLikeReviews()
    {
        return $this->hasMany(LikeReview::class, ['id_reviewscarpost' => 'id']);
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

    public function getImagePostReviews()
    {
        return ($this->photo_reviews) ? '/all_img/post_reviews/' . $this->photo_reviews : '/all_img/logo_order/no_image.png';
    }

    public function getReviewsPostCount()
    {
        return $this->getUser()->count();
    }

    // Счетчик лайка
    public function getLikesCount()
    {
        return LikeReview::find()->where(['id_reviewscarpost' => $this->id])->count();
    }

    // Пользователь лайкнул пост
    public function userHasLikedPost($userId)
    {
        return LikeReview::find()->where(['id_reviewscarpost' => $this->id, 'id_user' => $userId])->exists();
    }
}
