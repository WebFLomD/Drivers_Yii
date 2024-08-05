<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id ID пользователя
 * @property string $username Логин
 * @property string $fio ФИО
 * @property string $email Почта
 * @property string $phone Телефон
 * @property int $id_cite
 * @property string|null $img_user Фото пользователя
 * @property string|null $date_of_birth Дата рождения
 * @property string $date_of_registration Дата регистрации
 * @property string $password Пароль
 * @property int $id_role Роль
 *
 * @property Autoparts[] $autoparts
 * @property Car[] $cars
 * @property Chatadmin[] $chatadmins
 * @property Chatadmin[] $chatadmins0
 * @property UserCite $cite
 * @property Commentnew[] $commentnews
 * @property Commentreviews[] $commentreviews
 * @property Favourites[] $favourites
 * @property LikeReview[] $likeReviews
 * @property Like[] $likes
 * @property Newpost[] $newposts
 * @property Reviewscarpost[] $reviewscarposts
 * @property Role $role
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    public $passwordRepeat;
    public $check;
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
            [['username', 'fio', 'email', 'phone', 'id_cite', 'password'], 'required', 'message' => 'Заполните поля!'],
            [['id_cite', 'id_role'], 'integer'],
            [['date_of_birth', 'date_of_registration'], 'safe'],
            [['username', 'fio', 'email', 'phone', 'img_user', 'password'], 'string', 'max' => 255],
            [['id_role'], 'exist', 'skipOnError' => true, 'targetClass' => Role::class, 'targetAttribute' => ['id_role' => 'id']],
            [['id_cite'], 'exist', 'skipOnError' => true, 'targetClass' => UserCite::class, 'targetAttribute' => ['id_cite' => 'id']],

            # Зарегистрированые данные в БД
            [['username'], 'unique', 'message' => 'Такой логин зарегистрирован!'],
            [['email'], 'unique', 'message' => 'Такая почта зарегистрирована!'],
            [['phone'], 'unique', 'message' => 'Такой телефон зарегистрирован!'],

            # Валлидация
            ['username', 'match', 'pattern' => '/^[A-Za-z0-9]{3,}$/u', 'message' => 'Только латиница'], # Валлидация на "Логин"
            ['fio', 'match', 'pattern' => '/^[А-Яа-я\s\-]{5,}$/u', 'message' => 'Только кириллица,и пробел'], # Валлидация на "ФИО"
            ['email', 'email', 'message' => 'Почта должен содержать латинские буквы, @ и точку'], # Валлидация на "Email"
            # Валлидация на "Телефон"
            ['phone', 'string', 'max' => 18], // Максимальная длина номера телефона +7 (999) 999-99-99
            ['phone', 'match', 'pattern' => '/^\+7 \(\d{3}\) \d{3}-\d{2}-\d{2}$/', 'message' => 'Некорректный формат номера телефона. Используйте формат: +7 (999) 999-99-99.'],
            ['password', 'match', 'pattern' => '/^[A-Za-z0-9_-]{6,}$/u', 'message' => 'Пароль должен содержать не менее 6 символов и литница'], # Валлидация на "Пароль"
            ['passwordRepeat', 'compare', 'compareAttribute' => 'password', 'message' => 'Пароли не совпадают!'], # Валлидация на "Подтверждение пароля"
            # Валлидация на "Чек-Бокс"
            ['check', 'boolean'],
            ['check', 'compare', 'compareValue' => true, 'message' => 'Необходимо выше согасие!'],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '',
            'username' => '',
            'fio' => '',
            'email' => '',
            'phone' => '',
            'id_cite' => '',
            'img_user' => '',
            'date_of_birth' => '',
            'date_of_registration' => '',
            'password' => '',
            'passwordRepeat' => '',
            'check' => 'Согласен на обр.персон данных',
            'id_role' => '',
        ];
    }

    /**
     * Gets query for [[Autoparts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAutoparts()
    {
        return $this->hasMany(Autoparts::class, ['id_user' => 'id']);
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
     * Gets query for [[Cite]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCite()
    {
        return $this->hasOne(UserCite::class, ['id' => 'id_cite']);
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
     * Gets query for [[LikeReviews]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLikeReviews()
    {
        return $this->hasMany(LikeReview::class, ['id_user' => 'id']);
    }

    /**
     * Gets query for [[Likes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLikes()
    {
        return $this->hasMany(Like::class, ['id_user' => 'id']);
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

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    # Находит нужный пользователь по ID
    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return null;
    }

    public function validateAuthKey($authKey)
    {
        return null;
    }

    # Поиск пользователя по логину
    public static function findByUsername($username){
        return static::findOne(['username' => $username]);
    }

    # Поиск пользователя по почту
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }

    # Из md5 делает пароль читаемым и проверка пароля
    public function validatePassword($password){
        return $this->password === md5($password);
    }

    # Роль администратор
    public function isAdmin()
    {
        return $this->id_role === 2;
    }

    # Защита пароля (превращает пароль в md5) при регистрации нового пользователя
    public function beforeSave($insert)
    {
        if ($this->isNewRecord)
        {
            $this->password = md5($this->password);
        }

        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

    # Фото/аватарка пользователя
    public function getImageUser()
    {
        return ($this->img_user) ? '/all_img/user/' . $this->img_user: '/all_img/logo_order/no_imagea_user.png';
    }
}
