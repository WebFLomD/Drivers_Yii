<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "forModels".
 *
 * @property int $id
 * @property string $name
 *
 * @property Autoparts[] $autoparts
 */
class ForModels extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'forModels';
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
     * Gets query for [[Autoparts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAutoparts()
    {
        return $this->hasMany(Autoparts::class, ['id_for_models' => 'id']);
    }
}
