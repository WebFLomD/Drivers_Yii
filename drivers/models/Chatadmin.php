<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "chatadmin".
 *
 * @property int $id ID чата
 * @property int $id_sender Отправитель (пользователь)
 * @property int $id_receiver Получатель (Админ)
 * @property string $chat Чат
 * @property string|null $img_chat Фото чата
 *
 * @property User $receiver
 * @property User $sender
 */
class Chatadmin extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'chatadmin';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_sender', 'chat'], 'required'],
            [['id_sender', 'id_receiver'], 'integer'],
            [['chat'], 'string'],
            [['img_chat'], 'string', 'max' => 255],
            [['id_sender'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['id_sender' => 'id']],
            [['id_receiver'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['id_receiver' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_sender' => 'Id Sender',
            'id_receiver' => 'Id Receiver',
            'chat' => 'Chat',
            'img_chat' => 'Img Chat',
        ];
    }

    /**
     * Gets query for [[Receiver]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReceiver()
    {
        return $this->hasOne(User::class, ['id' => 'id_receiver']);
    }

    /**
     * Gets query for [[Sender]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSender()
    {
        return $this->hasOne(User::class, ['id' => 'id_sender']);
    }
}
