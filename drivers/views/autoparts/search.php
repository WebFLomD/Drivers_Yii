<?php

use app\models\Autoparts;
use app\models\ConditionAutoParts;
use app\models\OriginalityAutoParts;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\search\AutopartsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Поиск - АвтоЗапчасти';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="block-auto-parts">

    <?php $form = ActiveForm::begin([
        'id' => 'search-auto-parts',
        'class' => 'search-container',
        'method' => 'post',
        'action' => ['autoparts/search'],
    ]) ?>

        <div class="widht-input-search">
            <?= $form->field($model, 'title_auto_parts')->textInput(['maxlength' => true, 'id'=> 'autopartssearch-title_auto_parts', 'class' => 'input-search', 'placeholder' => 'Поиск...']) -> label(false); ?>
        </div>
        <button class="btn-search">Искать</button>

    <?php ActiveForm::end() ?>


    <div class="posts-all-auto-parts">
        <?php
        if (!empty($results)) {
            foreach ($results as $result) {
                $autoparts = ($result instanceof Autoparts) ? $result : new Autoparts($result); ?>

                <div class="post-only-auto-parts">
                    <div class="photo-auto-parts">
                        <img src="<?= $autoparts->getImgAutoPart() ?>" alt="post-auto-parts">
                    </div>
                    <div class="info-auto-parts">
                        <div class="price-auto-parts-index">
                            <p class="kakoytoclass"><?= $autoparts->price_auto_parts ?> руб.</p>
                        </div>
                        <div class="title-auto-parts-index">
                            <p><?= $autoparts->title_auto_parts ?></p>
                        </div>
                        <div class="additionally-auto-parts">
                            <p><?= OriginalityAutoParts::findOne($autoparts->id_originality_auto_parts)->name ?> / <?= ConditionAutoParts::findOne($autoparts->id_condition_auto_parts)->name ?></p>
                        </div>
                    </div>
                    <div class="btn-post-auto-parts">
                        <a href="<?= Url::toRoute(['autoparts/post/', 'id' => $autoparts -> id]) ?>">Подробнее</a>
                    </div>
                </div>

                <?php
            }
        } else {
            echo "<p class='title-search'>Результаты поиска не найдены</p>";
        }
        ?>
    </div>


</div>
