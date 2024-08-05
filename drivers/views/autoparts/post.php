<?php

use app\models\ConditionAutoParts;
use app\models\ForModels;
use app\models\Manufacturer;
use app\models\OriginalityAutoParts;
use app\models\ProductAvailability;
use app\models\User;
use app\models\UserCite;
use yii\helpers\Url;

$this->title = $autoparts -> title_auto_parts;
?>

<div class="auto-parts-post">

    <div class="auto-parts-lvl-1">
        <div class="text-title-and-price-auto-parts-post">
            <p class="title-price-auto-parts-post"><?= $autoparts -> title_auto_parts ?></p>
            <p class="title-price-auto-parts-post kakoytoclass"><?= $autoparts -> price_auto_parts ?> руб.</p>
        </div>
        <p class="data-and-order-auto-parts-post"><?= ConditionAutoParts::findOne($autoparts->id_condition_auto_parts )->name ?> 🞄
            <?= Yii::$app->formatter->asDate($autoparts->date_of_registration_auto_parts, 'php:d.m.Y') ?> 🞄
            <i class="fa-solid fa-eye"></i> <?= $autoparts -> views_auto_parts ?> 🞄
            №<?= $autoparts -> id ?>
        </p>
    </div>

    <div class="auto-parts-lvl-2">
        <div class="inform-auto-parts">
            <div class="all-text-inform-auto-parts-left" id="text-info-auto-parts">
                <p>Наличие товара</p>
                <p>Состояние</p>
                <p>Оригинальность</p>
                <p>Производитель</p>
                <p>Номер запчасти</p>
<!--                <p>Для моделей</p>-->
<!--                <p>Номера замен</p>-->
            </div>
            <div class="all-text-inform-auto-parts-rigth" id="text-info-auto-parts">
                <p><?= ProductAvailability::findOne($autoparts->id_product_availability )->name ?></p>
                <p><?= ConditionAutoParts::findOne($autoparts->id_condition_auto_parts)->name ?></p>
                <p><?= OriginalityAutoParts::findOne($autoparts->id_originality_auto_parts)->name ?></p>
                <p><?= Manufacturer::findOne($autoparts->id_manufacturer)->name ?></p>
                <p><?= $autoparts->part_number ?></p>
<!--                <p>--><?php //= ForModels::findOne($autoparts->id_for_models)->name ?><!--</p>-->
<!--                <p>2834188, 3773121, 3773122</p>-->
            </div>
        </div>
        <div class="photo-auto-parts-post">
            <img src="<?= $autoparts -> getImgAutoPart() ?>" alt="photo-auto-parts">
        </div>
    </div>
    <div class="title-contact-comments-seller-auto-parts">
        <p>Контакты продавца</p>
    </div>
    <div class="contact-seller-auto-parts">
        <div class="info-contact-seller-auto-parts">
            <div class="img-name-adres-seller-auto-parts" id="left-contact-seller">
                <img src="<?= User::findOne($autoparts -> id_user) -> getImageUser() ?>" alt="#">
                <div class="name-adres-seller-auto-parts">
                    <p class="name-seller-auto-parts"><?= User::findOne($autoparts -> id_user) -> fio ?></p>
                    <p class="adres-seller-auto-parts"><?= UserCite::findOne(User::findOne($autoparts->id_user)->id_cite) -> name_cite ?></p>
                </div>
            </div>
            <div id="rigth-contact-seller-auto-parts">
                <div class="phone-seller-auto-parts">
                    <?php if (!Yii::$app->user->isGuest): ?>
                        <p class="translationTel"><?= User::findOne($autoparts->id_user)->phone ?></p>
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

    <div class="title-contact-comments-seller-auto-parts">
        <p>Комметарии продавца</p>
    </div>

    <div class="comment-seller-auto-parts">
        <p><?= nl2br(htmlentities($autoparts->comments_user)) ?></p>
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