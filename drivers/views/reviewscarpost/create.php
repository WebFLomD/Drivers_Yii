<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Reviewscarpost $model */

$this->title = 'Создать отзыв';
$this->params['breadcrumbs'][] = ['label' => 'Reviewscarposts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reviewscarpost-create">


    <?= $this->render('_formCreate', [
        'model' => $model,
        'categoryReview' => $categoryReview,
    ]) ?>

</div>
