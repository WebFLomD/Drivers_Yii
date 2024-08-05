<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "newpost".
 *
 * @property int $id
 * @property string $title_new
 * @property string $photo_new
 * @property string $description_new
 * @property string $content_new
 * @property string $date_register_new_post
 * @property int $viewed_new_post
 * @property int $like_new_post
 * @property int $id_user
 * @property int $id_category
 *
 * @property Category $category
 * @property Commentnew[] $commentnews
 * @property Like[] $likes
 * @property User $user
 */
class Newpost extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'newpost';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title_new', 'description_new', 'content_new', 'id_category'], 'required', 'message' => 'Заполните поля!'],
            [['description_new'], 'string'],
            [['date_register_new_post'], 'safe'],
            [['viewed_new_post', 'like_new_post', 'id_user', 'id_category'], 'integer'],
            [['title_new', 'photo_new', 'content_new'], 'string', 'max' => 255],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['id_user' => 'id']],
            [['id_category'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['id_category' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '',
            'title_new' => '',
            'photo_new' => '',
            'description_new' => '',
            'content_new' => '',
            'date_register_new_post' => '',
            'viewed_new_post' => '',
            'like_new_post' => '',
            'id_user' => '',
            'id_category' => '',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'id_category']);
    }

    /**
     * Gets query for [[Commentnews]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCommentnews()
    {
        return $this->hasMany(Commentnew::class, ['id_new_post' => 'id']);
    }

    /**
     * Gets query for [[Likes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLikes()
    {
        return $this->hasMany(Like::class, ['id_new_post' => 'id']);
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

    // Фото/изображение новости/новости-пост
    public function getImagePostNew()
    {
        return ($this->photo_new) ? '/all_img/new_post/' . $this->photo_new: '/all_img/logo_order/no_image.png';
    }

    public function getNewPostCount()
    {
        return $this->getUser()->count();
    }

    /**
     * Returns the total number of likes for this post.
     */

    // Счетчик лайка
    public function getLikesCount()
    {
        return Like::find()->where(['id_new_post' => $this->id])->count();
    }

    /**
     * Checks if the current user has liked this post.
     *
     * @param int $userId
     * @return bool
     */
    // Пользователь лайкнул пост
    public function userHasLikedPost($userId)
    {
        return Like::find()->where(['id_new_post' => $this->id, 'id_user' => $userId])->exists();
    }
}
