<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->title = 'Главная';
?>

<div class="index-main-info">

    <div class="car-brand">
        <?php foreach ($brand_cars as $brand_car): ?>
        <div class="brand">
            <?= Html::a(Html::encode($brand_car->name) .
                ' (' . $brand_car->getCarsCount() . ')',
                Url::toRoute(['site/brand_car', 'id' => $brand_car->id]),
                ['class' => 'kakoytoclass']); ?>
        </div>
        <?php endforeach;?>
    </div>

    <?php if (empty($cars)): ?>
        <div class="block-null-post">
            <p>Пусто...</p>
        </div>

    <?php else: ?>
        <div class="post-all-cars">

            <?php foreach ($cars as $car): ?>

            <div class="post-only-cars">
                <div class="photo-cars">
                    <img src="<?= $car -> getImage_1();?>" alt="post-only-cars">
                </div>
                <div class="info-car-post">
                    <div class="price-car-post-index">
                        <p class="kakoytoclass"><?= $car -> price ?> рублей</p>
                    </div>
                    <div class="title-car-index">
                        <p><?= $car -> name_car?></p>
                    </div>
                    <div class="additionally">
                        <p>2024 /</p>
                        <p class="kakoytoclass" id="probeg-text"><?= $car -> mileage?> км</p>
                    </div>
                </div>
                <div class="btn-post-car">
                    <a href="<?= Url::toRoute(['/car/post', 'id' => $car-> id]) ?>">Подробнее</a>
                </div>
            </div>

            <?php endforeach;?>

        </div>

        <!-- Пагинация -->
        <?= LinkPager::widget(['pagination' => $pagination]) ?>

    <?php endif; ?>
</div>
