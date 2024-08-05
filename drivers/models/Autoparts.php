<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "autoparts".
 *
 * @property int $id ID
 * @property string $title_auto_parts Название АвтоЗапчасти
 * @property string $photo_auto_parts Фото АвтоЗапчасти
 * @property int $id_condition_auto_parts Состояние АвтоЗапчасти
 * @property int $id_originality_auto_parts Оригинальность АвтоЗапчасти
 * @property int $id_user Пользователь
 * @property int $id_manufacturer
 * @property string $part_number
 * @property int $id_for_models
 * @property int $id_product_availability
 * @property string $price_auto_parts
 * @property string $comments_user
 * @property string $mileage
 * @property int $views_auto_parts
 * @property string $date_of_registration_auto_parts
 * @property int $id_status
 *
 * @property ConditionAutoParts $conditionAutoParts
 * @property ForModels $forModels
 * @property Manufacturer $manufacturer
 * @property OriginalityAutoParts $originalityAutoParts
 * @property ProductAvailability $productAvailability
 * @property Status $status
 * @property User $user
 */
class Autoparts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'autoparts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title_auto_parts', 'photo_auto_parts', 'part_number', 'price_auto_parts', 'comments_user', 'mileage'], 'required'],
            [['id_condition_auto_parts', 'id_originality_auto_parts', 'id_user', 'id_manufacturer', 'id_for_models', 'id_product_availability', 'views_auto_parts', 'id_status'], 'integer'],
            [['comments_user'], 'string'],
            [['date_of_registration_auto_parts'], 'safe'],
            [['title_auto_parts', 'photo_auto_parts', 'part_number', 'price_auto_parts', 'mileage'], 'string', 'max' => 255],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['id_user' => 'id']],
            [['id_status'], 'exist', 'skipOnError' => true, 'targetClass' => Status::class, 'targetAttribute' => ['id_status' => 'id']],
            [['id_for_models'], 'exist', 'skipOnError' => true, 'targetClass' => ForModels::class, 'targetAttribute' => ['id_for_models' => 'id']],
            [['id_manufacturer'], 'exist', 'skipOnError' => true, 'targetClass' => Manufacturer::class, 'targetAttribute' => ['id_manufacturer' => 'id']],
            [['id_originality_auto_parts'], 'exist', 'skipOnError' => true, 'targetClass' => OriginalityAutoParts::class, 'targetAttribute' => ['id_originality_auto_parts' => 'id']],
            [['id_product_availability'], 'exist', 'skipOnError' => true, 'targetClass' => ProductAvailability::class, 'targetAttribute' => ['id_product_availability' => 'id']],
            [['id_condition_auto_parts'], 'exist', 'skipOnError' => true, 'targetClass' => ConditionAutoParts::class, 'targetAttribute' => ['id_condition_auto_parts' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title_auto_parts' => 'Title Auto Parts',
            'photo_auto_parts' => 'Photo Auto Parts',
            'id_condition_auto_parts' => 'Id Condition Auto Parts',
            'id_originality_auto_parts' => 'Id Originality Auto Parts',
            'id_user' => 'Id User',
            'id_manufacturer' => 'Id Manufacturer',
            'part_number' => 'Part Number',
            'id_for_models' => 'Id For Models',
            'id_product_availability' => 'Id Product Availability',
            'price_auto_parts' => 'Price Auto Parts',
            'comments_user' => 'Comments User',
            'mileage' => 'Mileage',
            'views_auto_parts' => 'Views Auto Parts',
            'date_of_registration_auto_parts' => 'Date Of Registration Auto Parts',
            'id_status' => 'Id Status',
        ];
    }

    /**
     * Gets query for [[ConditionAutoParts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConditionAutoParts()
    {
        return $this->hasOne(ConditionAutoParts::class, ['id' => 'id_condition_auto_parts']);
    }

    /**
     * Gets query for [[ForModels]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getForModels()
    {
        return $this->hasOne(ForModels::class, ['id' => 'id_for_models']);
    }

    /**
     * Gets query for [[Manufacturer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getManufacturer()
    {
        return $this->hasOne(Manufacturer::class, ['id' => 'id_manufacturer']);
    }

    /**
     * Gets query for [[OriginalityAutoParts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOriginalityAutoParts()
    {
        return $this->hasOne(OriginalityAutoParts::class, ['id' => 'id_originality_auto_parts']);
    }

    /**
     * Gets query for [[ProductAvailability]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductAvailability()
    {
        return $this->hasOne(ProductAvailability::class, ['id' => 'id_product_availability']);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::class, ['id' => 'id_status']);
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

    // Фото/изображение новости/новости-пост
    public function getImgAutoPart()
    {
        return ($this->photo_auto_parts) ? '/all_img/auto_parts/' . $this->photo_auto_parts : '/all_img/logo_order/no_image.png';
    }

    public function search($params)
    {
        $query = Autoparts::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'title_auto_parts', $this->title_auto_parts]);

        return $dataProvider;
    }
}
