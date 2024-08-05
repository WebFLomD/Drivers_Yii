<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "car".
 *
 * @property int $id ID автомобиля
 * @property string $name_car Название авто
 * @property string $photo_car_1 Фото авто 1
 * @property string $photo_car_2 Фото авто 2
 * @property string $photo_car_3 Фото авто 3
 * @property int $id_user Владелец авто
 * @property int $id_bodywork Кузов авто
 * @property int $id_transmission_car Коробка авто
 * @property int $id_color Цвет авто
 * @property int $id_drive_car Привод авто
 * @property int $id_brand_car Модель/марка авто
 * @property int $id_engine_car Двигатель авто
 * @property string $modification_car Модификация
 * @property int $id_owners Кол-во владельцев авто
 * @property int $id_pts ПТС авто
 * @property int $id_year_of_release Год выпуска авто
 * @property int $id_type_of_car Тип авто
 * @property int $id_used_or_new
 * @property string $price Цена
 * @property string $mileage Пробег
 * @property string $comments_user Комментарии от владельца
 * @property int $views_post
 * @property string $date_of_registration_post_car Дата публикации авто
 * @property int $id_status Статус
 *
 * @property Bodywork $bodywork
 * @property Brandcar $brandCar
 * @property Color $color
 * @property Drivecar $driveCar
 * @property Enginecar $engineCar
 * @property Favourites[] $favourites
 * @property Owners $owners
 * @property Pts $pts
 * @property Status $status
 * @property Transmissioncar $transmissionCar
 * @property Typeofcar $typeOfCar
 * @property Usedornew $usedOrNew
 * @property User $user
 * @property Yearofrelease $yearOfRelease
 */
class Car extends \yii\db\ActiveRecord
{
    public $old_photo_car_1;
    public $old_photo_car_2;
    public $old_photo_car_3;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'car';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_car', 'photo_car_1', 'photo_car_2', 'photo_car_3', 'id_user', 'id_bodywork', 'id_transmission_car', 'id_color', 'id_drive_car', 'id_brand_car', 'id_engine_car', 'modification_car', 'id_owners', 'id_pts', 'id_year_of_release', 'id_type_of_car', 'id_used_or_new', 'price', 'mileage', 'comments_user'], 'required', 'message' => 'Заполните поля!'],
            [['id_user', 'id_bodywork', 'id_transmission_car', 'id_color', 'id_drive_car', 'id_brand_car', 'id_engine_car', 'id_owners', 'id_pts', 'id_year_of_release', 'id_type_of_car', 'id_used_or_new', 'views_post', 'id_status'], 'integer'],
            [['comments_user'], 'string'],
            [['date_of_registration_post_car'], 'safe'],
            [['name_car', 'photo_car_1', 'photo_car_2', 'photo_car_3', 'price', 'mileage'], 'string', 'max' => 255],
            [['modification_car'], 'string', 'max' => 3],
            [['id_status'], 'exist', 'skipOnError' => true, 'targetClass' => Status::class, 'targetAttribute' => ['id_status' => 'id']],
            [['id_transmission_car'], 'exist', 'skipOnError' => true, 'targetClass' => Transmissioncar::class, 'targetAttribute' => ['id_transmission_car' => 'id']],
            [['id_year_of_release'], 'exist', 'skipOnError' => true, 'targetClass' => Yearofrelease::class, 'targetAttribute' => ['id_year_of_release' => 'id']],
            [['id_type_of_car'], 'exist', 'skipOnError' => true, 'targetClass' => Typeofcar::class, 'targetAttribute' => ['id_type_of_car' => 'id']],
            [['id_used_or_new'], 'exist', 'skipOnError' => true, 'targetClass' => Usedornew::class, 'targetAttribute' => ['id_used_or_new' => 'id']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['id_user' => 'id']],
            [['id_bodywork'], 'exist', 'skipOnError' => true, 'targetClass' => Bodywork::class, 'targetAttribute' => ['id_bodywork' => 'id']],
            [['id_brand_car'], 'exist', 'skipOnError' => true, 'targetClass' => Brandcar::class, 'targetAttribute' => ['id_brand_car' => 'id']],
            [['id_color'], 'exist', 'skipOnError' => true, 'targetClass' => Color::class, 'targetAttribute' => ['id_color' => 'id']],
            [['id_drive_car'], 'exist', 'skipOnError' => true, 'targetClass' => Drivecar::class, 'targetAttribute' => ['id_drive_car' => 'id']],
            [['id_engine_car'], 'exist', 'skipOnError' => true, 'targetClass' => Enginecar::class, 'targetAttribute' => ['id_engine_car' => 'id']],
            [['id_owners'], 'exist', 'skipOnError' => true, 'targetClass' => Owners::class, 'targetAttribute' => ['id_owners' => 'id']],
            [['id_pts'], 'exist', 'skipOnError' => true, 'targetClass' => Pts::class, 'targetAttribute' => ['id_pts' => 'id']],


            ['mileage', 'match', 'pattern' => '/^[0-9]{1,}$/u', 'message' => 'Введите пробег авто (без пробелов и букв)'],
            ['price', 'match', 'pattern' => '/^[0-9]{1,}$/u', 'message' => 'Введите сумму (без пробелов и букв)'],
            ['modification_car', 'match', 'pattern' => '/^[0-9]{1,}$/u', 'message' => 'Введите модификацию (л.с.,без пробелов и букв)'],

            [['photo_car_1'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg', 'maxSize' => 1024 * 1024 * 2, 'wrongExtension' => 'Разрешены только файлы с такими расширениями: png, jpg, jpeg.', 'tooBig' => 'Размер файла не должен превышать 2MB.'],
            [['photo_car_2'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg', 'maxSize' => 1024 * 1024 * 2, 'wrongExtension' => 'Разрешены только файлы с такими расширениями: png, jpg, jpeg.', 'tooBig' => 'Размер файла не должен превышать 2MB.'],
            [['photo_car_3'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg', 'maxSize' => 1024 * 1024 * 2, 'wrongExtension' => 'Разрешены только файлы с такими расширениями: png, jpg, jpeg.', 'tooBig' => 'Размер файла не должен превышать 2MB.'],
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            // Check if new files are uploaded, if not, keep the old ones
            if ($this->isNewRecord || $this->photo_car_1) {
                $this->photo_car_1 = $this->photo_car_1 ?: $this->old_photo_car_1;
            }
            if ($this->isNewRecord || $this->photo_car_2) {
                $this->photo_car_2 = $this->photo_car_2 ?: $this->old_photo_car_2;
            }
            if ($this->isNewRecord || $this->photo_car_3) {
                $this->photo_car_3 = $this->photo_car_3 ?: $this->old_photo_car_3;
            }
            return true;
        }
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '',
            'name_car' => '',
            'photo_car_1' => '',
            'photo_car_2' => '',
            'photo_car_3' => '',
            'id_user' => '',
            'id_bodywork' => '',
            'id_transmission_car' => '',
            'id_color' => '',
            'id_drive_car' => '',
            'id_brand_car' => '',
            'id_engine_car' => '',
            'modification_car' => '',
            'id_owners' => '',
            'id_pts' => '',
            'id_year_of_release' => '',
            'id_type_of_car' => '',
            'id_used_or_new' => '',
            'price' => '',
            'mileage' => '',
            'comments_user' => '',
            'views_post' => '',
            'date_of_registration_post_car' => '',
            'id_status' => '',
        ];
    }

    /**
     * Gets query for [[Bodywork]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBodywork()
    {
        return $this->hasOne(Bodywork::class, ['id' => 'id_bodywork']);
    }

    /**
     * Gets query for [[BrandCar]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBrandCar()
    {
        return $this->hasOne(Brandcar::class, ['id' => 'id_brand_car']);
    }

    /**
     * Gets query for [[Color]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getColor()
    {
        return $this->hasOne(Color::class, ['id' => 'id_color']);
    }

    /**
     * Gets query for [[DriveCar]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDriveCar()
    {
        return $this->hasOne(Drivecar::class, ['id' => 'id_drive_car']);
    }

    /**
     * Gets query for [[EngineCar]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEngineCar()
    {
        return $this->hasOne(Enginecar::class, ['id' => 'id_engine_car']);
    }

    /**
     * Gets query for [[Favourites]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFavourites()
    {
        return $this->hasMany(Favourites::class, ['id_car_post' => 'id']);
    }

    /**
     * Gets query for [[Owners]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOwners()
    {
        return $this->hasOne(Owners::class, ['id' => 'id_owners']);
    }

    /**
     * Gets query for [[Pts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPts()
    {
        return $this->hasOne(Pts::class, ['id' => 'id_pts']);
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
     * Gets query for [[TransmissionCar]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTransmissionCar()
    {
        return $this->hasOne(Transmissioncar::class, ['id' => 'id_transmission_car']);
    }

    /**
     * Gets query for [[TypeOfCar]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTypeOfCar()
    {
        return $this->hasOne(Typeofcar::class, ['id' => 'id_type_of_car']);
    }

    /**
     * Gets query for [[UsedOrNew]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsedOrNew()
    {
        return $this->hasOne(Usedornew::class, ['id' => 'id_used_or_new']);
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

    /**
     * Gets query for [[YearOfRelease]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getYearOfRelease()
    {
        return $this->hasOne(Yearofrelease::class, ['id' => 'id_year_of_release']);
    }

    public function getImage_1()
    {
        return ($this->photo_car_1) ? '/all_img/post_car/' . $this->photo_car_1: '/all_img/logo_order/no_image.png';
    }

    public function getImage_2()
    {
        return ($this->photo_car_1) ? '/all_img/post_car/' . $this->photo_car_2: '/all_img/logo_order/no_image.png';
    }

    public function getImage_3()
    {
        return ($this->photo_car_1) ? '/all_img/post_car/' . $this->photo_car_3: '/all_img/logo_order/no_image.png';
    }

    // Счетчик лайка
    public function getFavouritesCount()
    {
        return Favourites::find()->where(['id_car_post' => $this->id])->count();
    }

    /**
     * Checks if the current user has liked this post.
     *
     * @param int $userId
     * @return bool
     */

    // Добавление в избранное
    public function userHasFavouritPost($userId)
    {
        return Favourites::find()->where(['id_car_post' => $this->id, 'id_user' => $userId])->exists();
    }
}
