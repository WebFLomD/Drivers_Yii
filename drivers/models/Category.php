<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property int $id ID Категория
 * @property string $name_category Наименование категории
 *
 * @property Newpost[] $newposts
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_category'], 'required'],
            [['name_category'], 'string', 'max' => 255],
            [['name_category'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_category' => 'Name Category',
        ];
    }

    /**
     * Gets query for [[Newposts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNewposts()
    {
        return $this->hasMany(Newpost::class, ['id_category' => 'id']);
    }
}
