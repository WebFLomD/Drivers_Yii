<?php

/** @var yii\web\View $this */

use app\models\Typeofcar;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

//$this->title = 'Марки авто';
$this->title = $technics->name;
?>
<?php if(empty($cars)): ?>
    <div class="block-null-post" style="margin: 22.5px auto;">
        <p>Пусто...</p>
    </div>
<?php else: ?>
    <div class="index-main-info">

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
    </div>
<?php endif; ?>
