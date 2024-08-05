<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "yearofrelease".
 *
 * @property int $id ID
 * @property string $name Наименование Год выпуска авто
 *
 * @property Car[] $cars
 */
class Yearofrelease extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'yearofrelease';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
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
        return $this->hasMany(Car::class, ['id_year_of_release' => 'id']);
    }
}
