<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "favourites".
 *
 * @property int $id ID Вкладка избранное
 * @property int $id_user Пользователь
 * @property int $id_car_post Пост авто
 *
 * @property Car $carPost
 * @property User $user
 */
class Favourites extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'favourites';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'id_car_post'], 'required'],
            [['id_user', 'id_car_post'], 'integer'],
            [['id_car_post'], 'exist', 'skipOnError' => true, 'targetClass' => Car::class, 'targetAttribute' => ['id_car_post' => 'id']],
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
            'id_car_post' => 'Id Car Post',
        ];
    }

    /**
     * Gets query for [[CarPost]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarPost()
    {
        return $this->hasOne(Car::class, ['id' => 'id_car_post']);
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
