<?php


use app\models\Bodywork;
use app\models\Car;
use app\models\Drivecar;
use app\models\Enginecar;
use app\models\Status;
use app\models\Transmissioncar;
use app\models\Usedornew;
use app\models\User;
use app\models\UserCite;
use app\models\Yearofrelease;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

// Get the CSRF token

$this->title = 'Избранное - ' . $users -> username;
?>

<div class="block-profile">

    <div class="profile-lvl-1">
        <div class="btn-img-user-profile">
            <div class="img-profile-user">
                <img src="<?= $users -> getImageUser() ?>" alt="photo-user">
            </div>
            <div class="profile-all-btn">
                <div id="profile-all-btn">
                    <a class="btn-update-user" href="<?= Url::toRoute(['/user/update', 'id' => Yii::$app->user->id]); ?>"><i class="fa-solid fa-pen"></i> Редактировать</a>
                </div>
                <div id="profile-all-btn">
                    <a class="btn-favourites" href=""><i class="fa-solid fa-bookmark"></i> Избранное</a>
                </div>
                <div id="profile-all-btn">
                    <a class="btn-exit" href="<?= Url::to(['/site/logout']) ?>"
                       data-method="post"
                       onclick="
                           event.preventDefault();
                           var form = document.createElement('form');
                           form.setAttribute('method', 'post');
                           form.setAttribute('action', this.getAttribute('href'));

                           var hiddenField = document.createElement('input');
                           hiddenField.setAttribute('type', 'hidden');
                           hiddenField.setAttribute('name', '_csrf');
                           hiddenField.setAttribute('value', '<?= Yii::$app->request->getCsrfToken() ?>');

                           form.appendChild(hiddenField);

                           document.body.appendChild(form);
                           form.submit();">
                        <i class="fa-solid fa-door-open"></i> Выйти
                    </a>
                </div>


            </div>
        </div>

        <div class="info-user-profile">
            <p class="username-user-profile"><?= $users -> username ?></p>
            <div class="all-info-user-profile">
                <p class="text-info-user-profile">Информация пользователя:</p>

                <div class="only-info-user-profile">
                    <p>Номер аккаунта:</p>
                    <p><?= $users -> id ?></p>
                </div>

                <div class="only-info-user-profile">
                    <p>ФИО:</p>
                    <p><?= $users -> fio ?></p>
                </div>

                <div class="only-info-user-profile">
                    <p>Почта:</p>
                    <p><?= $users -> email ?></p>
                </div>

                <div class="only-info-user-profile">
                    <p>Телефон:</p>
                    <p><?= $users -> phone ?></p>
                </div>

                <div class="only-info-user-profile">
                    <p>Дата рождения:</p>
                    <p><?= ($users->date_of_birth !== null) ? Yii::$app->formatter->asDate($users->date_of_birth, 'php:d.m.Y') : '-' ?></p>
                </div>

                <div class="only-info-user-profile">
                    <p>Дата регистрации:</p>
                    <p><?= Yii::$app->formatter->asDate($users->date_of_registration, 'php:d.m.Y') ?></p>
                </div>

                <div class="only-info-user-profile">
                    <p>Город:</p>
                    <p><?= UserCite::findOne($users->id_cite) -> name_cite ?></p>
                </div>
                <div class="info-user-profile-right"></div>
            </div>
        </div>
    </div>

    <div class="profile-lvl-2">
        <h1 class="profile-title">Мои избранные</h1>

        <?php if (empty($cars)): ?>
            <div class="block-null-post">
                <p>Пусто...</p>
            </div>


        <?php else: ?>
            <?php foreach ($cars as $car): ?>

                <div class="my-post-car-user-profile">
                    <div class="post-block-left-profile">
                        <img src="<?=Car::findOne($car->id_car_post) -> getImage_1() ?>" alt="photo-car">
                    </div>

                    <div class="all-info-car-profile">
                        <p class="title-car-profile"><?= Car::findOne($car->id_car_post) -> name_car ?></p>
                        <p class="info-title-car-profile"><?= Bodywork::findOne(Car::findOne($car->id_car_post)->id_bodywork) -> name ?> • <?= Usedornew::findOne(Car::findOne($car->id_car_post) -> id_used_or_new) -> name ?> • <?= UserCite::findOne(User::findOne($car->id_user)->id_cite) -> name_cite ?> </p>
                        <div class="information-cars-profile">

                            <div class="text-info-auto-profile">
                                <p class="title-info-car-profile">Мотор:</p>
                                <p class="text-info-car-post-profile"><?= Car::findOne($car->id_car_post)->modification_car ?> л.с. / <?= Enginecar::findOne(Car::findOne($car->id_car_post)->id_engine_car) -> name ?></p>
                            </div>

                            <div class="text-info-auto-profile">
                                <p class="title-info-car-profile">Коробка:</p>
                                <p class="text-info-car-post-profile"><?= Transmissioncar::findOne(Car::findOne($car->id_car_post)->id_transmission_car) -> name ?></p>
                            </div>

                            <div class="text-info-auto-profile">
                                <p class="title-info-car-profile">Привод:</p>
                                <p class="text-info-car-post-profile"><?= Drivecar::findOne(Car::findOne($car->id_car_post)->id_drive_car) -> name ?></p>
                            </div>

                            <div class="text-info-auto-profile">
                                <p class="title-info-car-profile">Год выпуска:</p>
                                <p class="text-info-car-post-profile"><?= Yearofrelease::findOne(Car::findOne($car->id_car_post) -> id_year_of_release) -> name ?></p>
                            </div>

                            <div class="text-info-auto-profile">
                                <p class="title-info-car-profile">Пробег:</p>
                                <p class="text-info-car-post-profile kakoytoclass"><?= Car::findOne($car->id_car_post) -> mileage ?> км</p>
                            </div>

                            <!-- <div class="text-info-auto-profile">
                                <p>Мотор</p>
                                <p>Коробка</p>
                                <p>Привод</p>
                                <p>Год выпуска</p>
                                <p>Пробег</p>
                            </div>
                            <div class="text-info-auto-profile-2">
                                <p></p>
                                <p></p>
                                <p></p>
                                <p>2023</p>
                                <p>0 км</p>
                            </div> -->
                        </div>
                        <div class="price-car-profile kakoytoclass"><?= Car::findOne($car->id_car_post) -> price ?> рублей</div>

                        <div class="all-btn-management-post-profile">
                            <div class="btn-watch-car-post-profile" id="all-btn-management-post-profile">
                                <a href="<?= Url::toRoute(['/car/post', 'id' => Car::findOne($car->id_car_post)-> id]) ?>">Открыть пост</a>


                            </div>
                        </div>

                    </div>

                </div>

            <?php endforeach; ?>

            <!-- Пагинация -->
            <?= LinkPager::widget(['pagination' => $pagination]) ?>

        <?php endif; ?>




    </div>

</div>
