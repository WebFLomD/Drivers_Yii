<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "brandcar".
 *
 * @property int $id ID
 * @property string $name Наименование марки авто
 *
 * @property Car[] $cars
 */
class Brandcar extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'brandcar';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required', 'message' => 'Заполните поля!'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
            ['name', 'match', 'pattern' => '/^[A-Z a-zА-Яа-я]{3,}/u', 'message' => 'Не менее 3-х символов!']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[Cars]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCars()
    {
        return $this->hasMany(Car::class, ['id_brand_car' => 'id']);
    }

    public function getCarsCount()
    {
        return $this->getCars()->where(['id_status' => 2])->count();
    }
}
