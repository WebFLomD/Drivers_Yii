<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "commentnew".
 *
 * @property int $id
 * @property int $id_user
 * @property int $id_new_post
 * @property string $data_comment
 * @property string $text_new
 *
 * @property Newpost $newPost
 * @property User $user
 */
class Commentnew extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'commentnew';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'id_new_post', 'text_new'], 'required'],
            [['id_user', 'id_new_post'], 'integer'],
            [['data_comment'], 'safe'],
            [['text_new'], 'string'],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['id_user' => 'id']],
            [['id_new_post'], 'exist', 'skipOnError' => true, 'targetClass' => Newpost::class, 'targetAttribute' => ['id_new_post' => 'id']],
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
            'id_new_post' => 'Id New Post',
            'data_comment' => 'Data Comment',
            'text_new' => 'Text New',
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
