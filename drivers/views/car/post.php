<?php

use app\models\Bodywork;
use app\models\Color;
use app\models\Drivecar;
use app\models\Enginecar;
use app\models\Owners;
use app\models\Pts;
use app\models\Transmissioncar;
use app\models\Usedornew;
use app\models\User;
use app\models\UserCite;
use app\models\Yearofrelease;
use yii\helpers\Url;

$this->title = $cars -> name_car;
?>
<div class="post">

        <div class="lvl-1">
            <div class="text-title-and-price-post">
                <div class="title-favourites">
                    <p class="title-price-car-post"><?= $cars -> name_car ?></p>

                    <!-- Если пользователь не добавил в Избранное, иконка стандартный -->
                    <?php if (!$cars-> userHasFavouritPost(Yii::$app->user->id)): ?>
                    <a href="<?= Url::toRoute(['/car/favourites', 'postId' => $cars->id]) ?>"
                       title="Добавить в избранное"
                       class="col-favourites">
                        <i class="fa-solid fa-bookmark"></i>
                    </a>

                    <!-- Если пользователь добавил в Избранное иконка красного цвета -->
                    <?php else: ?>
                    <a href="<?= Url::toRoute(['/car/unfavourites', 'postId' => $cars->id]) ?>"
                       class="col-favourites active-favourites"
                       title="Удалить с избранного">
                        <i class="fa-solid fa-bookmark"></i>
                    </a>

                    <?php endif; ?>

                </div>
                <p class="title-price-car-post kakoytoclass"><?= $cars -> price ?> руб.</p>
            </div>
            <p class="data-and-order-post">
                <?= Usedornew::findOne($cars->id_used_or_new) -> name ?> 🞄
                <?= Yii::$app->formatter->asDate($cars->date_of_registration_post_car, 'php:d.m.Y') ?> 🞄
                <i class="fa-solid fa-eye"></i> <?= $cars -> views_post ?> 🞄
                №<?= $cars -> id ?>
            </p>
        </div>

        <div class="lvl-2">
            <div class="inform-cars">
                <div class="all-text-inform-car-left" id="text-info">
                    <p>Год выпуска</p>
                    <p>Пробег</p>
                    <p>Кузов</p>
                    <p>Цвет</p>
                    <p>Двигатель</p>
                    <p>Коробка</p>
                    <p>Привод</p>
                    <p>Владельцы</p>
                    <p>ПТС</p>
                </div>
                <div class="all-text-inform-car-rigth" id="text-info">
                    <p><?= Yearofrelease::findOne($cars -> id_year_of_release) -> name ?></p>
                    <p class="kakoytoclass"><?= $cars -> mileage ?> км</p>
                    <p><?= Bodywork::findOne($cars->id_bodywork) -> name ?></p>
                    <p><?= Color::findOne($cars->id_color) -> name ?></p>
                    <p><?= $cars->modification_car ?> л.с. / <?= Enginecar::findOne($cars->id_engine_car) -> name ?></p>
                    <p><?= Transmissioncar::findOne($cars->id_transmission_car) -> name ?></p>
                    <p><?= Drivecar::findOne($cars->id_drive_car) -> name ?></p>
                    <p><?= Owners::findOne($cars->id_owners) -> name ?></p>
                    <p><?= Pts::findOne($cars->id_pts) -> name ?></p>
                </div>
            </div>
            <div class="photo-car-post">
                <div class="slider">
                    <a class="prev controlls"><i class="fa-solid fa-chevron-left"></i></a>
                </div>

                <div class="img-slider-post-car">
                    <img class="image-car-post" src="<?= $cars -> getImage_1();?>" alt="photo-car">
                    <img class="image-car-post" src="<?= $cars -> getImage_2();?>" alt="photo-car">
                    <img class="image-car-post" src="<?= $cars -> getImage_3();?>" alt="photo-car">
                </div>


                <div class="slider">
                    <a class="next controlls"><i class="fa-solid fa-chevron-right"></i></a>
                </div>
            </div>
        </div>
        <div class="title-contact-comments-seller">
            <p>Контакты продавца</p>
        </div>
        <div class="contact-seller">
            <div class="info-contact-seller">
                <div class="img-name-adres-seller" id="left-contact-seller">
                    <img src="<?= User::findOne($cars -> id_user) -> getImageUser() ?>" alt="#">
                    <div class="name-adres-seller">
                        <p class="name-seller"><?= User::findOne($cars -> id_user) -> fio ?></p>
                        <p class="adres-seller"><?= UserCite::findOne(User::findOne($cars->id_user)->id_cite) -> name_cite ?></p>
                    </div>
                </div>
                <div id="rigth-contact-seller">
                    <div class="phone-seller">
                        <?php if (!Yii::$app->user->isGuest): ?>
                            <p class="translationTel"><?= User::findOne($cars->id_user)->phone ?></p>
                        <?php else: ?>
                            <p class="translationTel">+7****************</p>
                        <?php endif; ?>
                        <p class="text-time-phone">C 8:00 до 20:00</p>
                    </div>
                    <div class="icons-btn-seller">
                        <?php if (!Yii::$app->user->isGuest): ?>
                            <button class="btn-seller show">Показать</button>
                        <?php else: ?>
                            <button class="btn-seller" onclick="window.location.href = '<?= Url::toRoute(['/site/login'])?>';">Показать</button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="title-contact-comments-seller">
            <p>Комметарии продавца</p>
        </div>

        <div class="comment-seller">
            <p><?=nl2br(htmlspecialchars($cars->comments_user))?></p>
        </div>

    </div>

<?php
if (!Yii::$app->user->isGuest){
    $this->registerJsFile(
        '@web/public/js/translationTel.js',
        ['depends' => [\yii\web\JqueryAsset::class]]
    );
}
?>