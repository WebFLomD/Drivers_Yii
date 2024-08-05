<?php


use app\models\Bodywork;
use app\models\Car;
use app\models\ConditionAutoParts;
use app\models\Drivecar;
use app\models\Enginecar;
use app\models\Manufacturer;
use app\models\OriginalityAutoParts;
use app\models\ProductAvailability;
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

$this->title = 'Профиль - ' . $users -> username;
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
                    <a class="btn-favourites" href="<?= Url::toRoute(['/user/favourites', 'id' => Yii::$app->user->id]); ?>"><i class="fa-solid fa-bookmark"></i> Избранное</a>
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
        <div class="btn-profile-title">
            <h1 class="profile-title">Мои объявления</h1>
            <div class="btn-profile">
                <button class="btn-category-profile" onclick="showContent('content1')">Техники</button>
                <button class="btn-category-profile" onclick="showContent('content2')">АвтоЗапчасти</button>
            </div>
        </div>


        <div class="content" id = "content1">
            <?php if (empty($cars)): ?>
                <div class="block-null-post">
                    <p>Пусто...</p>
                </div>


            <?php else: ?>
                <?php foreach ($cars as $car): ?>

                    <div class="my-post-car-user-profile">
                        <div class="post-block-left-profile">
                            <img src="<?=$car -> getImage_1() ?>" alt="photo-car">
                        </div>

                        <div class="all-info-car-profile">
                            <div class="profile-info-name-car-post">
                                <p class="title-car-profile"><?= $car -> name_car ?></p>
                                <p class="status-post-car"><?= Status::findOne($car->id_status) ->name ?></p>
                            </div>
                            <p class="info-title-car-profile"><?= Bodywork::findOne($car->id_bodywork) -> name ?> • <?= Usedornew::findOne($car -> id_used_or_new) -> name ?> • <?= UserCite::findOne(User::findOne($car->id_user)->id_cite) -> name_cite ?> </p>
                            <div class="information-cars-profile">

                                <div class="text-info-auto-profile">
                                    <p class="title-info-car-profile">Мотор:</p>
                                    <p class="text-info-car-post-profile"><?= $car->modification_car ?> л.с. / <?= Enginecar::findOne($car->id_engine_car) -> name ?></p>
                                </div>

                                <div class="text-info-auto-profile">
                                    <p class="title-info-car-profile">Коробка:</p>
                                    <p class="text-info-car-post-profile"><?= Transmissioncar::findOne($car->id_transmission_car) -> name ?></p>
                                </div>

                                <div class="text-info-auto-profile">
                                    <p class="title-info-car-profile">Привод:</p>
                                    <p class="text-info-car-post-profile"><?= Drivecar::findOne($car->id_drive_car) -> name ?></p>
                                </div>

                                <div class="text-info-auto-profile">
                                    <p class="title-info-car-profile">Год выпуска:</p>
                                    <p class="text-info-car-post-profile"><?= Yearofrelease::findOne($car -> id_year_of_release) -> name ?></p>
                                </div>

                                <div class="text-info-auto-profile">
                                    <p class="title-info-car-profile">Пробег:</p>
                                    <p class="text-info-car-post-profile kakoytoclass"><?= $car -> mileage ?> км</p>
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
                            <div class="price-car-profile kakoytoclass"><?= $car -> price ?> рублей</div>

                            <div class="all-btn-management-post-profile">
                                <div class="btn-watch-car-post-profile" id="all-btn-management-post-profile">
                                    <a href="<?= Url::toRoute(['/car/post', 'id' => $car-> id]) ?>">Посмотреть</a>
                                </div>
                                <div class="btn-update-car-post-profile" id="all-btn-management-post-profile">
                                    <a href="<?= Url::toRoute(['/car/update', 'id' => $car-> id]) ?>">Редактировать</a>
                                </div>
                                <div class="btn-del-car-post-profile" id="all-btn-del-post-profile">
                                    <a href="<?= Url::toRoute(['site/delete', 'id' => $car->id], ['data' => ['method' => 'post',],]) ?>">Удалить</a>

                                </div>
                            </div>

                        </div>

                    </div>

                <?php endforeach; ?>

                <!-- Пагинация -->
                <?= LinkPager::widget(['pagination' => $paginationCars,'linkOptions' => ['href' => '#content1']]) ?>

            <?php endif; ?>
        </div>

        <div class="content" id = "content2">
            <?php if (empty($parts)): ?>
                <div class="block-null-post">
                    <p>Пусто...</p>
                </div>


            <?php else: ?>
                <?php foreach ($parts as $part): ?>

                    <div class="my-post-car-user-profile">
                        <div class="post-block-left-profile">
                            <img src="<?=$part -> getImgAutoPart() ?>" alt="photo-car">
                        </div>

                        <div class="all-info-car-profile">
                            <div class="profile-info-name-car-post">
                                <p class="title-car-profile"><?= $part -> title_auto_parts ?></p>
                            </div>
                            <p class="info-title-car-profile"><?= OriginalityAutoParts::findOne( $part->id_originality_auto_parts)->name ?> • <?= ConditionAutoParts::findOne( $part->id_condition_auto_parts)->name ?> • <?= UserCite::findOne(User::findOne($part->id_user)->id_cite) -> name_cite ?> </p>

                            <div class="information-cars-profile">

                                <div class="text-info-auto-profile">
                                    <p class="title-info-car-profile">Наличие товара:</p>
                                    <p class="text-info-car-post-profile"><?= ProductAvailability::findOne($part->id_product_availability )->name ?></p>
                                </div>

                                <div class="text-info-auto-profile">
                                    <p class="title-info-car-profile">Состояние:</p>
                                    <p class="text-info-car-post-profile"><?= ConditionAutoParts::findOne($part->id_condition_auto_parts)->name ?></p>
                                </div>

                                <div class="text-info-auto-profile">
                                    <p class="title-info-car-profile">Оригинальность:</p>
                                    <p class="text-info-car-post-profile"><?= OriginalityAutoParts::findOne($part->id_originality_auto_parts)->name ?></p>
                                </div>

                                <div class="text-info-auto-profile">
                                    <p class="title-info-car-profile">Производитель:</p>
                                    <p class="text-info-car-post-profile"><?= Manufacturer::findOne($part->id_manufacturer)->name ?></p>
                                </div>

                                <div class="text-info-auto-profile">
                                    <p class="title-info-car-profile">Номер запчасти:</p>
                                    <p class="text-info-car-post-profile kakoytoclass"><?= $part->part_number ?></p>
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

                            <div class="price-car-profile kakoytoclass"><?= $part -> price_auto_parts ?> рублей</div>

                            <div class="all-btn-management-post-profile">
                                <div class="btn-watch-car-post-profile" id="all-btn-management-post-profile">
                                    <a href="<?= Url::toRoute(['/autoparts/post/', 'id' => $part-> id]) ?>">Посмотреть</a>
                                </div>
                                <div class="btn-update-car-post-profile" id="all-btn-management-post-profile">
                                    <a href="<?= Url::toRoute(['/autoparts/update/', 'id' => $part-> id]) ?>">Редактировать</a>
                                </div>
                                <div class="btn-del-car-post-profile" id="all-btn-del-post-profile">
                                    <a href="<?= Url::toRoute(['/site/deleteparts', 'id' => $part->id], ['data' => ['method' => 'post']]) ?>">Удалить</a>
                                </div>
                            </div>

                        </div>

                    </div>

                <?php endforeach; ?>

                <!-- Пагинация -->
                <?= LinkPager::widget(['pagination' => $paginationParts,'linkOptions' => ['href' => '#content2']]) ?>

            <?php endif; ?>
        </div>




    </div>

</div>

<script>
    function showContent(contentId) {
        // Hide all content
        var contents = document.querySelectorAll('.content');
        contents.forEach(function(content) {
            content.classList.remove('active');
        });

        // Show the selected content
        document.getElementById(contentId).classList.add('active');
    }

    // Show the first content by default
    showContent('content1');
</script>
