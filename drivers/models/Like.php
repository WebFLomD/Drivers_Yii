<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "like".
 *
 * @property int $id
 * @property int $id_new_post
 * @property int $id_user
 * @property string $like_quantity
 *
 * @property Newpost $newPost
 * @property User $user
 */
class Like extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'like';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_new_post', 'id_user'], 'required'],
            [['id_new_post', 'id_user'], 'integer'],
            [['like_quantity'], 'string', 'max' => 255],
            [['id_new_post'], 'exist', 'skipOnError' => true, 'targetClass' => Newpost::class, 'targetAttribute' => ['id_new_post' => 'id']],
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
            'id_new_post' => 'Id New Post',
            'id_user' => 'Id User',
            'like_quantity' => 'Like Quantity',
        ];
    }

    /**
     * Gets query for [[NewPost]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNewPost()
    {
        return $this->hasOne(Newpost::class, ['id' => 'id_new_post']);
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
