<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_cite".
 *
 * @property int $id
 * @property string $name_cite
 *
 * @property User[] $users
 */
class UserCite extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_cite';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_cite'], 'required'],
            [['name_cite'], 'string', 'max' => 255],
            [['name_cite'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_cite' => 'Name Cite',
        ];
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::class, ['id_cite' => 'id']);
    }
}
