<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id ID пользователя
 * @property string $username Логин
 * @property string $fio ФИО
 * @property string $email Почта
 * @property string $phone Телефон
 * @property string $cite
 * @property string|null $img_user Фото пользователя
 * @property string|null $date_of_birth Дата рождения
 * @property string $date_of_registration Дата регистрации
 * @property string $password Пароль
 * @property int $id_role Роль
 *
 * @property Car[] $cars
 * @property Chatadmin[] $chatadmins
 * @property Chatadmin[] $chatadmins0
 * @property Commentnew[] $commentnews
 * @property Commentreviews[] $commentreviews
 * @property Favourites[] $favourites
 * @property Newpost[] $newposts
 * @property Reviewscarpost[] $reviewscarposts
 * @property Role $role
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'fio', 'email', 'phone', 'cite', 'password'], 'required'],
            [['date_of_birth', 'date_of_registration'], 'safe'],
            [['id_role'], 'integer'],
            [['username', 'fio', 'email', 'phone', 'cite', 'img_user', 'password'], 'string', 'max' => 255],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['phone'], 'unique'],
            [['id_role'], 'exist', 'skipOnError' => true, 'targetClass' => Role::class, 'targetAttribute' => ['id_role' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'fio' => 'Fio',
            'email' => 'Email',
            'phone' => 'Phone',
            'cite' => 'Cite',
            'img_user' => 'Img User',
            'date_of_birth' => 'Date Of Birth',
            'date_of_registration' => 'Date Of Registration',
            'password' => 'Password',
            'id_role' => 'Id Role',
        ];
    }

    /**
     * Gets query for [[Cars]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCars()
    {
        return $this->hasMany(Car::class, ['id_user' => 'id']);
    }

    /**
     * Gets query for [[Chatadmins]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChatadmins()
    {
        return $this->hasMany(Chatadmin::class, ['id_sender' => 'id']);
    }

    /**
     * Gets query for [[Chatadmins0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChatadmins0()
    {
        return $this->hasMany(Chatadmin::class, ['id_receiver' => 'id']);
    }

    /**
     * Gets query for [[Commentnews]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCommentnews()
    {
        return $this->hasMany(Commentnew::class, ['id_user' => 'id']);
    }

    /**
     * Gets query for [[Commentreviews]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCommentreviews()
    {
        return $this->hasMany(Commentreviews::class, ['id_user' => 'id']);
    }

    /**
     * Gets query for [[Favourites]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFavourites()
    {
        return $this->hasMany(Favourites::class, ['id_user' => 'id']);
    }

    /**
     * Gets query for [[Newposts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNewposts()
    {
        return $this->hasMany(Newpost::class, ['id_user' => 'id']);
    }

    /**
     * Gets query for [[Reviewscarposts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReviewscarposts()
    {
        return $this->hasMany(Reviewscarpost::class, ['id_user' => 'id']);
    }

    /**
     * Gets query for [[Role]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Role::class, ['id' => 'id_role']);
    }
}
