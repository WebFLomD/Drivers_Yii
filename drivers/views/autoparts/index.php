<?php

use app\models\Autoparts;
use app\models\ConditionAutoParts;
use app\models\OriginalityAutoParts;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\LinkPager;

/** @var yii\web\View $this */
/** @var app\models\search\AutopartsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'АвтоЗапчасти';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="block-auto-parts">

    <?php if (empty($autoparts)): ?>

        <div class="block-null-post">
            <p>Пусто...</p>
        </div>
    <?php else: ?>

    <div class="posts-all-auto-parts">


            <?php foreach ($autoparts as $autopart): ?>

            <div class="post-only-auto-parts">
                <div class="photo-auto-parts">
                    <img src="<?= $autopart -> getImgAutoPart() ?>" alt="post-auto-parts">
                </div>
                <div class="info-auto-parts">
                    <div class="price-auto-parts-index">
                        <p class="kakoytoclass"><?= $autopart->	price_auto_parts ?> руб.</p>
                    </div>
                    <div class="title-auto-parts-index">
                        <p><?= $autopart->	title_auto_parts ?></p>
                    </div>
                    <div class="additionally-auto-parts">
                        <p><?= OriginalityAutoParts::findOne( $autopart->id_originality_auto_parts)->name ?> / <?= ConditionAutoParts::findOne( $autopart->id_condition_auto_parts)->name ?></p>
                    </div>
                </div>
                <div class="btn-post-auto-parts">
                    <a href="<?= Url::toRoute(['autoparts/post/', 'id' => $autopart -> id]) ?>">Подробнее</a>
                </div>
            </div>

            <?php endforeach; ?>


    </div>
        <!-- Пагинация -->
        <?= LinkPager::widget(['pagination' => $pagination]) ?>

    <?php endif; ?>


</div>